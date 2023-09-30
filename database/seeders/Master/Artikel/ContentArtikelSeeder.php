<?php

namespace Database\Seeders\Master\Artikel;

use App\Models\Artikel\DataArtikel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContentArtikelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DataArtikel::create([
            "id_artikel" => "ART-12345678",
            "judul_artikel" => "Mata Sering Sakit saat Berkedip, Ini Cara Mengatasinya",
            "slug_artikel" => "mata-sering-sakit-saat-berkedip-ini-cara-mengatasinya",
            "deskripsi" => "Banyak hal yang menyebabkan mata terasa sakit saat berkedip. Mata terasa sakit saat berkedip dapat terjadi di seluruh mata atau di daerah tertentu saja, seperti sudut mata atau di kelopak mata. Umumnya, mata sakit saat berkedip jarang disebabkan oleh kondisi serius dan dapat sembuh dengan sendirinya atau dengan pengobatan sederhana. 
            Namun, kamu tetap harus waspada bila sakit mata yang kamu alami disertai dengan gejala lain. Pasalnya, hal tersebut bisa menjadi pertanda kondisi yang lebih serius dan memerlukan perhatian medis darurat.",
            "user_id" => 2
        ]);

        DataArtikel::create([
            "id_artikel" => "ART-12345679",
            "judul_artikel" => "Perut Kembung",
            "slug_artikel" => "perut-kembung",
            "deskripsi" => "Perut kembung adalah sensasi rasa tertekan atau kepenuhan di perut dan terkadang disertai dengan perut yang terlihat buncit. Kondisi tersebut menimbulkan rasa tidak nyaman hingga menyakitkan. Kembung bisa hilang dalam beberapa saat dan bisa saja terjadi secara berulang. 
            Masalah pencernaan hingga fluktuasi hormon dalam tubuh menjadi penyebab siklus kembung datang kembali. Kamu perlu mencari perawatan medis untuk menentukan penyebabnya jika gejala yang dialami tidak kunjung membaik. Kondisi tersebut bisa jadi pertanda adanya gangguan kesehatan tertentu.",
            "user_id" => 2
        ]);

        DataArtikel::create([
            "id_artikel" => "ART-12345680",
            "judul_artikel" => "Henti Jantung Tak Sama dengan Serangan Jantung, Ini Perbedaannya",
            "slug_artikel" => "henti-jantung-tak-sama-dengan-serangan-jantung-ini-perbedaannya",
            "deskripsi" => "Henti jantung, atau cardiac arrest, terjadi ketika detak jantung tiba-tiba berhenti. Ini berarti jantung tidak lagi memompa darah ke seluruh tubuh. Ini merupakan kondisi darurat yang mengancam nyawa dan memerlukan tindakan medis segera, seperti resusitasi jantung paru (CPR) dan defibrilasi.",
            "user_id" => 2
        ]);
        DataArtikel::create([
            "id_artikel" => "ART-12345681",
            "judul_artikel" => "Henti Jantung Tak Sama dengan Serangan Jantung, Ini Perbedaannya",
            "slug_artikel" => "henti-jantung-tak-sama-dengan-serangan-jantung-ini-perbedaannya",
            "deskripsi" => "Henti jantung, atau cardiac arrest, terjadi ketika detak jantung tiba-tiba berhenti. Ini berarti jantung tidak lagi memompa darah ke seluruh tubuh. Ini merupakan kondisi darurat yang mengancam nyawa dan memerlukan tindakan medis segera, seperti resusitasi jantung paru (CPR) dan defibrilasi.",
            "user_id" => 2
        ]);
        DataArtikel::create([
            "id_artikel" => "ART-12345682",
            "judul_artikel" => "Tak Sama dengan Serangan Jantung, Ini Perbedaannya",
            "slug_artikel" => "tak-sama-dengan-serangan-jantung-ini-perbedaannya",
            "deskripsi" => "Henti jantung, atau cardiac arrest, terjadi ketika detak jantung tiba-tiba berhenti. Ini berarti jantung tidak lagi memompa darah ke seluruh tubuh. Ini merupakan kondisi darurat yang mengancam nyawa dan memerlukan tindakan medis segera, seperti resusitasi jantung paru (CPR) dan defibrilasi.",
            "user_id" => 2
        ]);
        DataArtikel::create([
            "id_artikel" => "ART-12345683",
            "judul_artikel" => "Henti Jantung",
            "slug_artikel" => "henti-jantung",
            "deskripsi" => "Henti jantung, atau cardiac arrest, terjadi ketika detak jantung tiba-tiba berhenti. Ini berarti jantung tidak lagi memompa darah ke seluruh tubuh. Ini merupakan kondisi darurat yang mengancam nyawa dan memerlukan tindakan medis segera, seperti resusitasi jantung paru (CPR) dan defibrilasi.",
            "user_id" => 2
        ]);
    }
}
