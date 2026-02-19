<?php

namespace App\Traits;

use App\Models\TahunAkademik;
use Illuminate\Database\Eloquent\Builder;

trait HasActiveAcademicYear
{
    /**
     * The "booted" method of the trait.
     */
    protected static function bootHasActiveAcademicYear(): void
    {
        static::addGlobalScope('activeAcademicYear', function (Builder $builder) {
            $model = $builder->getModel();

            if (method_exists($model, 'tahunAkademik')) {
                $builder->whereHas('tahunAkademik', function (Builder $query) {
                    $query->where('status', 'Y');
                });
            } elseif (method_exists($model, 'kelas')) {
                $builder->whereHas('kelas.tahunAkademik', function (Builder $query) {
                    $query->where('status', 'Y');
                });
            } elseif (method_exists($model, 'mataPelajaranKelas')) {
                $builder->whereHas('mataPelajaranKelas.kelas.tahunAkademik', function (Builder $query) {
                    $query->where('status', 'Y');
                });
            } elseif (method_exists($model, 'kurikulum')) {
                $builder->whereHas('kurikulum.tahunAkademik', function (Builder $query) {
                    $query->where('status', 'Y');
                });
            }
        });
    }

    /**
     * Scope to bypass the active academic year filter if needed.
     */
    public function scopeWithInactiveAcademicYear(Builder $query): Builder
    {
        return $query->withoutGlobalScope('activeAcademicYear');
    }
}
