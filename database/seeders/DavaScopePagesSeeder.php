<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class DavaScopePagesSeeder extends Seeder
{
    public function run(): void
    {
        $this->upsertPage(
            'akademik',
            'Akademik',
            '<h2>Informasi Akademik</h2>
<p>Halaman akademik menyediakan informasi terkait kegiatan akademik Jurusan Teknik Komputer dan Informatika Politeknik Negeri Bandung.</p>
<p>Informasi yang tersedia meliputi kalender akademik, peraturan akademik, jadwal kegiatan perkuliahan, ujian, libur akademik, dan informasi akademik penting lainnya.</p>
<h3>Kalender Akademik</h3>
<p>Kalender akademik berisi jadwal kegiatan akademik setiap semester, seperti perkuliahan, ujian, libur akademik, dan agenda penting lainnya.</p>
<h3>Peraturan Akademik</h3>
<p>Peraturan akademik berisi ketentuan resmi yang menjadi acuan pelaksanaan kegiatan akademik di Politeknik Negeri Bandung.</p>'
        );

        $this->upsertPage(
            'akreditasi',
            'Akreditasi',
            '<h2>Akreditasi Program Studi</h2>
<p>Halaman akreditasi berisi informasi status akreditasi program studi di Jurusan Teknik Komputer dan Informatika Politeknik Negeri Bandung.</p>
<h3>D3 Teknik Informatika</h3>
<p>Status akreditasi: <strong>UNGGUL</strong>.</p>
<p>Terakreditasi tahun 2023 dan berlaku hingga 2028-08-07.</p>
<p>No. SK: 0753/SK/LAM-INFOKOM/Ak/D3/VII/2023.</p>
<h3>Sarjana Terapan Teknik Informatika</h3>
<p>Status akreditasi: <strong>UNGGUL</strong>.</p>
<p>Terakreditasi tahun 2025 dan berlaku hingga 2030-08-15.</p>
<p>No. SK: 145/SK/LAM-INFOKOM/Ak/STT/VIII/2025.</p>
<p>Sertifikat akreditasi dapat diakses melalui LAM INFOKOM atau sumber resmi terkait.</p>'
        );

        $this->upsertPage(
            'visi-dan-misi',
            'Visi dan Misi',
            '<h2>Visi</h2>
<p>Menjadi jurusan di bidang informatika yang unggul, bermutu, inovatif, serta adaptif terhadap perkembangan teknologi, berorientasi pada pendidikan vokasional, dan dikenal di tingkat nasional maupun internasional.</p>
<h2>Misi</h2>
<ol>
<li>Menyelenggarakan pendidikan vokasional di bidang informatika yang berkualitas dan relevan dengan kebutuhan industri.</li>
<li>Mengembangkan penelitian terapan berbasis produk dan jasa di bidang informatika yang bermanfaat bagi masyarakat dan industri.</li>
<li>Melaksanakan pengabdian kepada masyarakat melalui pemanfaatan teknologi informatika yang relevan dan berdampak nyata.</li>
<li>Memperkuat kerja sama strategis dengan dunia usaha, dunia industri, pemerintah, dan institusi pendidikan.</li>
<li>Melaksanakan tata kelola organisasi yang profesional, akuntabel, dan berorientasi pada peningkatan berkelanjutan.</li>
</ol>
<h2>Tujuan</h2>
<ol>
<li>Menghasilkan lulusan pendidikan vokasional yang relevan dengan kebutuhan industri.</li>
<li>Meningkatkan kualitas penelitian terapan dan pengabdian masyarakat di bidang informatika.</li>
<li>Meningkatkan kualitas layanan akademik dan non-akademik kepada seluruh stakeholder.</li>
</ol>'
        );
    }

    private function upsertPage(string $slug, string $title, string $content): void
    {
        if (!Schema::hasTable('pages')) {
            return;
        }

        $existing = DB::table('pages')->where('slug', $slug)->first();

        $data = [];

        if (!$existing && Schema::hasColumn('pages', 'id')) {
            $maxId = DB::table('pages')->max('id') ?? 0;
            $data['id'] = $maxId + 1;
        }

        if (Schema::hasColumn('pages', 'title')) {
            $data['title'] = $title;
        }

        if (Schema::hasColumn('pages', 'slug')) {
            $data['slug'] = $slug;
        }

        if (Schema::hasColumn('pages', 'content')) {
            $data['content'] = $content;
        }

        if (Schema::hasColumn('pages', 'excerpt')) {
            $data['excerpt'] = Str::limit(strip_tags($content), 180);
        }

        if (Schema::hasColumn('pages', 'status')) {
            $data['status'] = 'publish';
        }

        if (Schema::hasColumn('pages', 'published_at')) {
            $data['published_at'] = now();
        }

        if (!$existing && Schema::hasColumn('pages', 'created_at')) {
            $data['created_at'] = now();
        }

        if (Schema::hasColumn('pages', 'updated_at')) {
            $data['updated_at'] = now();
        }

        DB::table('pages')->updateOrInsert(
            ['slug' => $slug],
            $data
        );
    }
}
