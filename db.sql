
        Schema::create('jenjang_pendidikan', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 50)->nullable();
            $table->string('deskripsi', 50)->nullable();
            $table->timestamps();
        });
        Schema::create('fakultas', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 50)->nullable();
            $table->timestamps();
        });
        Schema::create('jurusan', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 50)->nullable();
            $table->foreignId('id_fakultas')->nullable()
                ->constrained('fakultas', 'id');
            $table->timestamps();
        });
        Schema::create('tahun_akadmeik', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 50)->nullable();
            $table->enum('periode', ['Genap', 'Ganjil'])->nullable();
            $table->enum('status', ['Y', 'N'])->nullable();
            $table->timestamps();
        });
        Schema::create('program_kelas', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 50)->nullable();
            $table->timestamps();
        });
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_program_kelas')->nullable()
                ->constrained('program_kelas', 'id');
            $table->integer('semester')->nullable();
            $table->foreignId('id_jenjang_pendidikan')->nullable()
                ->constrained('jenjang_pendidikan', 'id');
            $table->foreignId('id_tahun_akademik')->nullable()
                ->constrained('tahun_akadmeik', 'id');
            $table->enum('status_aktif', ['Y', 'N'])->nullable();
            $table->timestamps();
        });
        Schema::create('siswa_data', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 50)->nullable();
            $table->string('nomor_induk', 50)->nullable();
            $table->timestamps();
        });
        Schema::create('riwayat_pendidikan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_siswa_data')->nullable()
                ->constrained('siswa_data', 'id');
            $table->foreignId('id_jenjang_pendidikan')->nullable()
                ->constrained('jenjang_pendidikan', 'id');
            $table->foreignId('id_jurusan')->nullable()
                ->constrained('jurusan', 'id');
            $table->enum('status_siswa', ['DO', 'Aktif'])->nullable();
            $table->year('angkatan')->nullable();
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->timestamps();
        });
        Schema::create('akademik_krs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_riwayat_pendidikan')->nullable()
                ->constrained('riwayat_pendidikan', 'id');
            $table->foreignId('id_kelas')->nullable()
                ->constrained('kelas', 'id');
            $table->integer('semester')->nullable();
            $table->enum('status_bayar', ['Y', 'N'])->nullable();
            $table->integer('jumlah_sks')->nullable();
            $table->enum('status_aktif', ['Y', 'N'])->nullable();
            $table->timestamps();
        });
        Schema::create('siswa_data_pendaftar', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 50)->nullable();
            $table->foreignId('id_siswa_data')->nullable()
                ->constrained('siswa_data', 'id');
            $table->timestamps();
        });
        Schema::create('siswa_data_orang_tua', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 50)->nullable();
            $table->foreignId('id_siswa_data')->nullable()
                ->constrained('siswa_data', 'id');
            $table->timestamps();
        });
        Schema::create('mata_pelajaran_master', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->foreignId('id_jurusan')->nullable()
                ->constrained('jurusan', 'id');
            $table->integer('bobot')->nullable();
            $table->enum('jenis', ['wajib', 'peminatan'])->nullable();
            $table->timestamps();
        });
        Schema::create('kurikulum', function (Blueprint $table) {
            $table->id();
            $table->string('name',50)->nullable();
            $table->foreignId('id_jurusan')->nullable()
                ->constrained('jurusan', 'id');
            $table->foreignId('id_tahun_akademik')->nullable()
                ->constrained('tahun_akadmeik', 'id');
            $table->foreignId('id_jenjang_pendidikan')->nullable()
                ->constrained('jenjang_pendidikan', 'id');
            $table->enum('status_aktif', ['Y', 'N'])->nullable();
            $table->timestamps();
        });
        Schema::create('mata_pelajaran_kurikulum', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kurikulum')->nullable()
                ->constrained('kurikulum', 'id');
            $table->foreignId('id_mata_pelajaran_master')->nullable()
                ->constrained('mata_pelajaran_master', 'id');
            $table->integer('semester')->nullable();
            $table->timestamps();
        });
        Schema::create('ruang_kelas', function (Blueprint $table) {
            $table->id();
            $table->string('nama',50)->nullable();
            $table->string('deskripsi',200)->nullable();
            $table->timestamps();
        });
        Schema::create('dosen_data', function (Blueprint $table) {
            $table->id();
            $table->string('nama',50)->nullable();
            $table->timestamps();
        });
        Schema::create('mata_pelajaran_kelas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_mata_pelajaran_kurikulum')->nullable()
                ->constrained('mata_pelajaran_kurikulum', 'id');
            $table->foreignId('id_kelas')->nullable()
                ->constrained('kelas', 'id');
            $table->foreignId('id_dosen_data')->nullable()
                ->constrained('dosen_data', 'id');
            $table->date('uts')->nullable();
            $table->date('uas')->nullable();
            $table->foreignId('id_ruang_kelas')->nullable()
                ->constrained('ruang_kelas', 'id');
            $table->timestamps();
        });
        Schema::create('siswa_jenis_evaluasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('deskrispsi');
            $table->timestamps();
        });
        Schema::create('siswa_evaluasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_mata_pelajaran_kelas')->nullable()
                ->constrained('mata_pelajaran_kelas', 'id');
            $table->foreignId('id_siswa_jenis_evaluasi')->nullable()
                ->constrained('siswa_jenis_evaluasi', 'id');
            $table->date('tanggal')->nullable();
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
        Schema::create('siswa_soal_evaluasi', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_soal_evaluasi')->default(true);

            $table->foreignId('id_siswa_data')
                ->constrained('siswa_data', 'id')
                ->cascadeOnDelete();

            $table->text('pertanyaan');

            $table->string('tipe', 50);
            // contoh: pilihan_ganda, essay, true_false

            $table->integer('skor')->default(0);

            $table->string('kunci_jawaban')->nullable();
            $table->timestamps();
        });
        Schema::create('siswa_jawaban', function (Blueprint $table) {
            $table->id();

            // Foreign Key ke siswa_soal_evaluasi
            $table->foreignId('id_soal_evaluasi')
                ->constrained('siswa_soal_evaluasi', 'id')
                ->cascadeOnDelete();

            // Foreign Key ke KRS
            $table->foreignId('id_akademik_krs')
                ->constrained('akademik_krs', 'id')
                ->cascadeOnDelete();

            // Jawaban mahasiswa
            $table->text('jawaban')->nullable();

            // Skor jawaban
            $table->integer('skor')->default(0);

            // Waktu submit
            $table->timestamp('waktu_submit')->nullable();
            $table->timestamps();
        });
        Schema::create('siswa_data_ljk', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_akademik_krs')
                ->constrained('akademik_krs', 'id')
                ->cascadeOnDelete();

            $table->foreignId('id_mata_pelajaran_kelas')
                ->constrained('mata_pelajaran_kelas', 'id')
                ->cascadeOnDelete();

            $table->decimal('nilai', 5, 2)->nullable();
            // contoh: 85.50

            $table->timestamps();
        });
        Schema::create('pertemuan_kelas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_mata_pelajaran_kelas')->nullable()
                ->constrained('mata_pelajaran_kelas', 'id');
            $table->integer('pertemuan_ke')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('materi', 100)->nullable();
            $table->timestamps();
        });
        Schema::create('absensi_siswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pertemuan')->nullable()
                ->constrained('pertemuan_kelas', 'id');
            $table->foreignId('id_krs')->nullable()
                ->constrained('akademik_krs', 'id');
            $table->enum('status', ['Hadir', 'Izin', 'Sakit', 'Alpa'])->nullable();
            $table->dateTime('waktu_absen')->nullable();
            $table->timestamps();
        });