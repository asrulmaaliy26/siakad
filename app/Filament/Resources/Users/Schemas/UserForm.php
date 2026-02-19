<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                DateTimePicker::make('email_verified_at'),
                TextInput::make('password')
                    ->password()
                    ->dehydrated(fn($state) => filled($state))
                    ->required(fn($operation) => $operation === 'create'),
                \Filament\Forms\Components\Select::make('roles')
                    ->relationship('roles', 'name', function ($query) {
                        $user = \Filament\Facades\Filament::auth()->user();
                        $activeJenjangId = \Illuminate\Support\Facades\Session::get('active_jenjang_id');
                        $jenjang = \App\Models\JenjangPendidikan::find($activeJenjangId);

                        // Jika bukan super_admin, dilarang melihat/memberikan role super_admin
                        if ($user && !$user->hasRole(\App\Helpers\SiakadRole::SUPER_ADMIN)) {
                            $query->where('name', '!=', \App\Helpers\SiakadRole::SUPER_ADMIN);
                        }

                        // Jika jenjang UMUM atau tidak ada jenjang aktif (dan user adalah super_admin), tampilkan semua role sisa
                        if (!$jenjang || strtoupper($jenjang->nama) === 'UMUM' || strtoupper($jenjang->type) === 'UMUM') {
                            return $query;
                        }

                        // Filter: Sembunyikan role yang tidak sesuai dengan jenjang aktif, 
                        // TAPI tetap tampilkan role Global (NULL) dan role jenjang UMUM.
                        return $query->where(function ($q) use ($activeJenjangId) {
                            $q->whereNull('jenjang_id')
                                ->orWhere('jenjang_id', $activeJenjangId)
                                ->orWhereHas('jenjang', function ($jq) {
                                    $jq->where('nama', 'UMUM')->orWhere('type', 'UMUM');
                                });
                        });
                    })
                    ->getOptionLabelFromRecordUsing(fn($record) => $record->display_name)
                    ->multiple()
                    ->preload()
                    ->searchable(),
            ]);
    }
}
