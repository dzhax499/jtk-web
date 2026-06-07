<?php

namespace Database\Seeders;

use App\Models\StudyProgram;
use Illuminate\Database\Seeder;

class UpdateStudyProgramsSeeder extends Seeder
{
    public function run(): void
    {
        StudyProgram::updateOrCreate(
            ['slug' => 'd3-teknik-informatika'],
            [
                'name' => 'D3 Teknik Informatika',
                'degree' => 'D3',
                'description' => 'Program Diploma 3 Teknik Informatika yang menghasilkan lulusan kompeten, siap kerja, dan berdaya saing nasional maupun internasional.',
                'vision' => 'Menjadi Program Studi unggulan dan terdepan dalam program pendidikan Diploma III Teknik Informatika yang diakui baik di tingkat nasional maupun internasional pada tahun 2025.',
                'mission' => "Menyelenggarakan program pendidikan Diploma III Teknik Informatika yang diakui baik di tingkat nasional maupun internasional.\nMelakukan penelitian terapan yang dapat digunakan oleh Industri, Institusi atau Masyarakat baik ditingkat nasional maupun internasional.\nMelaksanakan pengabdian kepada masyarakat pada lingkup lokal, regional dan nasional.",
                'objectives' => [
                    'Menghasikan tenaga di bidang perancangan dan implementasi perangkat lunak bisnis serta perancangan solusi bisnis berbasis teknologi informasi untuk menunjang kebutuhan masyarakat dan industri di lingkup nasional dan internasional, yang memiliki sikap dan kemampuan sebagai berikut: <ul class="list-disc pl-6 mt-3 space-y-1.5 text-gray-600 font-normal"><li>beradaptasi terhadap perkembangan teknologi informasi</li><li>belajar sepanjang hayat dan ulet</li><li>berpikir kreatif, analitis dan sistematis</li><li>berwirausaha</li><li>bermoral</li><li>berkomunikasi dalam bahasa internasional</li></ul>',
                    'Menghasilkan lulusan dengan kompetensi yang diakui pada tingkat nasional maupun internasional.',
                    'Mendorong mahasiswa untuk menghasilkan produk terapan di bidang perangkat lunak bisnis yang bermanfaat bagi masyarakat dan industri baik nasional maupun internasional.',
                    'Menghasikan produk pelayanan dan produk penelitian terapan di bidang teknologi informasi yang bermanfaat bagi masyarakat dan industri baik di tingkat nasional maupun internasional.'
                ],
                'graduate_profiles' => [
                    'Pengembangan Perangkat Lunak dan aplikasi',
                    'Konsultan Industri Teknologi Informasi',
                    'Pengembangan Perangkat Lunak multimedia',
                    'Pemeliharaan Teknologi Jaringan'
                ],
                'job_positions' => [
                    [
                        'category' => 'OPERATOR',
                        'items' => ['Drafter', 'Tester', 'Office Automation']
                    ],
                    [
                        'category' => 'PROGRAMMER',
                        'items' => ['Documenter', 'Administrator', 'Programmer']
                    ],
                    [
                        'category' => 'ANALIS & DESIGNER',
                        'items' => ['Testing Engineer', 'Requirement Analyst', 'Designer']
                    ]
                ],
                'accreditation_text' => 'Terakreditasi "Unggul" tahun 2023. Berlaku hingga 2028-08-07, berdasarkan No. SK. 073/SK/LAM-INFOKOM/Ak/D3/VIII/2023. Sertifikat Akreditasi dapat di unduh melalui tautan ini. Informasi lebih lanjut dapat dilihat melalui Web LAM INFOKOM.',
                'accreditation_certificate_url' => 'https://www.polban.ac.id/wp-content/uploads/2024/01/24.-Sertifikat-Akreditasi-D3-Teknik-Informatika_073-2023-2028.pdf',
                'accreditation_website_url' => 'https://laminfokom.or.id/official/data-akreditasi-1.html',
                'is_active' => true,
            ]
        );

        StudyProgram::updateOrCreate(
            ['slug' => 'sarjana-terapan-teknik-informatika'],
            [
                'name' => 'Sarjana Terapan Teknik Informatika',
                'degree' => 'D4',
                'description' => 'Program Diploma 4 (Sarjana Terapan) Teknik Informatika yang menghasilkan pengembang sistem yang kompeten, adaptif, dan berdaya saing global',
                'vision' => 'Dalam satu dekade ke depan, menjadi pusat unggulan pendidikan Sarjana Terapan (Diploma 4) bidang Teknik Informatika yang menghasilkan pengembang sistem yang mampu memahami isu global, serta memberikan solusi bagi permasalahan masyarakat.',
                'mission' => 'Menyelenggarakan program pendidikan di bidang rekayasa perangkat lunak (software engineering) yang menghasilkan tenaga profesional yang dapat menjadi penggagas (trendsetter), mampu berkolaborasi, bermoral, berkomunikasi baik, adaptif, berjiwa wirausaha, berwawasan lingkungan, dan memiliki kompetensi bidang pengembangan perangkat lunak untuk menyelesaikan permasalahan bisnis masa kini dan masa yang akan datang dengan dukungan sistem cerdas dan big data, di tingkat nasional maupun internasional.',
                'objectives' => [
                    'Menunjukkan keunggulan keahlian dan pengetahuan, serta memiliki sikap profesionalisme yang dibutuhkan untuk menjadi seorang software engineer.',
                    'Bekerja secara individu dan menjadi bagian dari suatu tim untuk membangun, menyajikan dan memelihara perangkat lunak yang berkualitas.',
                    'Mengelola proyek pembangunan perangkat lunak.'
                ],
                'graduate_profiles' => [
                    'Rekayasa Perangkat Lunak Enterprise',
                    'Pengembangan Sistem Cerdas & AI',
                    'Analis Sistem & Arsitek Perangkat Lunak',
                    'Manajemen Proyek TI & Konsultan'
                ],
                'job_positions' => [
                    [
                        'category' => 'ANALIS',
                        'items' => ['System Analyst', 'Data Analyst', 'Quality Assurance Analyst']
                    ],
                    [
                        'category' => 'DEVELOPER',
                        'items' => ['Full-stack Developer', 'AI/Machine Learning Engineer', 'Database Engineer']
                    ],
                    [
                        'category' => 'MANAGER/ARCHITECT',
                        'items' => ['Software Architect', 'IT Project Manager', 'DevOps Engineer']
                    ]
                ],
                'about' => "Perkembangan perekonomian global secara positif telah menjadi tantangan dan peluang bagi semua negara termasuk Indonesia. Selaras dengan perkembangan industri khususnya dibidang Teknologi Informasi dan Komunikasi, serta kebijakan otonomi daerah di Indonesia, setiap institusi dituntut untuk mampu memanfaatkan teknologi dan kebijakan ini secara optimal. Oleh karena itu setiap institusi secara maksimal perlu mempersiapkan sumber daya manusianya sehingga memadai, baik dari segi kuantitas maupun kualitasnya.\n\nInstitusi pendidikan tinggi merupakan lembaga utama dalam menciptakan para calon praktisi dalam di industri.\n\nSalah satu program pendidikan yang turut berperan adalah program pendidikan jalur vokasi, Politeknik Negeri Bandung sebagai lembaga pendidikan jalur vokasi memiliki potensi dan kesempatan yang memadai dalam mendukung tuntutan penyediaan sumber daya manusia (SDM) dibidang Teknologi Informasi dan Komunikasi.\n\nSeiring dengan pemanfaatan perangkat lunak diberbagai bidang kehidupan dan KEPMEN 232/U/2000, maka Indonesia banyak memerlukan tenaga ahli yang mampu melaksanakan pekerjaan yang kompleks berdasarkan kemampuan profesional dibidang informatika.\n\nUntuk itu, pada Juli 2009 didirikanlah program pendidikan D IV (Sarjana Terapan) bidang informatika di Jurusan Teknik Komputer dan Informatika untuk menjawab kebutuhan terhadap penyediaan SDM yang berkaitan dengan produksi dan pemanfaatan perangkat lunak. Program studi ini dikukuhkan melalui SK Penyelenggaraan Program Studi dari Dikti dengan nomor 1265/D/T/2009.",
                'lecturer_qualification' => 'Dosen program studi ini berkualifikasi S2 dan S3 dari perguruan tinggi ternama dari dalam negeri (ITB, UI), maupun dari luar negeri (Inggris, Jepang, Amerika, Australia). Mayoritas dosen telah tersertifikasi (sertifikasi dosen).',
                'facilities' => [
                    'Laboratorium Rekayasa Perangkat Lunak',
                    'Laboratorium Sistem Informasi dan Basis Data',
                    'Laboratorium Multimedia',
                    'Laboratorium Project-Based Learning',
                    'Laboratorium Artificial Intelligence',
                    'Laboratorium Teknologi Informasi'
                ],
                'career_prospects' => 'Lulusan dari program studi ini berpotensi untuk bekerja pada kelompok bidang pekerjaan berikut:',
                'career_prospects_list' => [
                    'Senior Analyst',
                    'System Developer',
                    'Software Testing Professional',
                    'Manager IT'
                ],
                'accreditation_text' => 'Terakreditasi "Unggul" tahun 2025. Berlaku hingga 2030-08-15, berdasarkan No. SK. 146/SK/LAM-INFOKOM/Ak/STr/VIII/2025. Sertifikat Akreditasi dapat di unduh melalui tautan ini. Informasi lebih lanjut dapat dilihat melalui Web LAM INFOKOM.',
                'accreditation_certificate_url' => 'https://www.polban.ac.id/wp-content/uploads/2025/08/file_sertifikat_25051520395200500455301_1755423415.pdf',
                'accreditation_website_url' => 'https://laminfokom.or.id/official/data-akreditasi-1.html',
                'is_active' => true,
            ]
        );
    }
}
