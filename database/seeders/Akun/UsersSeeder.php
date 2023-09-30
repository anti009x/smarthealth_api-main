<?php

namespace Database\Seeders\Akun;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "nama" => "Ahmad Fauzi",
            "email" => "ahmad_fauzi@gmail.com",
            "password" => bcrypt("password"),
            "nomor_hp" => "085324237299",
            "alamat" => "Bandung",
            "id_role" => "RO-2003061",
            "jenis_kelamin" => "L",
            "usia" => "21",
            "berat_badan" => "50",
            "tinggi_badan" => "21",
            "tempat_lahir" => "Jakarta",
            "tanggal_lahir" => "2023-02-02",
            "status" => "1"
        ]);

        User::create([
            "nama" => "Ahmad Dahlan",
            "email" => "ahmad_dahlan@gmail.com",
            "password" => bcrypt("password"),
            "nomor_hp" => "085324237292",
            "alamat" => "Jakarta",
            "id_role" => "RO-2003062",
            "jenis_kelamin" => "L",
            "usia" => "20",
            "created_by" => 1,
            "berat_badan" => "40",
            "tinggi_badan" => "22",
            "tempat_lahir" => "Jakarta",
            "tanggal_lahir" => "2023-02-02",
            "status" => "1"
        ]);

        User::create([
            "nama" => "Ahmad Heryawan",
            "email" => "ahmad_heryawan@gmail.com",
            "password" => bcrypt("password"),
            "nomor_hp" => "085324237291",
            "alamat" => "Cirebon",
            "id_role" => "RO-2003063",
            "jenis_kelamin" => "L",
            "usia" => "20",
            "created_by" => 2,
            "berat_badan" => "40",
            "tinggi_badan" => "22",
            "tempat_lahir" => "Jakarta",
            "tanggal_lahir" => "2023-02-02",
            "status" => "1"
        ]);

        User::create([
            "nama" => "Ahmad Rizki Pratama",
            "email" => "ahmad_rizki_pratama@gmail.com",
            "password" => bcrypt("password"),
            "nomor_hp" => "085324237225",
            "alamat" => "Solo",
            "id_role" => "RO-2003063",
            "jenis_kelamin" => "L",
            "usia" => "20",
            "created_by" => 2,
            "berat_badan" => "40.5",
            "tinggi_badan" => "161.5",
            "tempat_lahir" => "Bandung",
            "tanggal_lahir" => "2023-02-02",
            "status" => "1"
        ]);

        User::create([
            "nama" => "Ahmad Rizki Rapli",
            "email" => "ahmad_rizki_rapli@gmail.com",
            "password" => bcrypt("password"),
            "nomor_hp" => "085324237228",
            "alamat" => "Amerika",
            "id_role" => "RO-2003063",
            "jenis_kelamin" => "L",
            "usia" => "20",
            "berat_badan" => "40.5",
            "tinggi_badan" => "161.5",
            "tempat_lahir" => "Bandung",
            "tanggal_lahir" => "2023-02-02",
            "status" => "1"
        ]);

        User::create([
            "nama" => "Ahmad Ilham",
            "email" => "ahmad_ilham@gmail.com",
            "password" => bcrypt("password"),
            "nomor_hp" => "085324237266",
            "alamat" => "Banyuwangi",
            "id_role" => "RO-2003062",
            "jenis_kelamin" => "L",
            "usia" => "20",
            "created_by" => 1,
            "berat_badan" => "40.5",
            "tinggi_badan" => "161.5",
            "tempat_lahir" => "Bandung",
            "tanggal_lahir" => "2023-02-02",
            "status" => "1"
        ]);

        User::create([
            "nama" => "Ahmad Bajuri",
            "email" => "ahmad_bajuri@gmail.com",
            "password" => bcrypt("password"),
            "nomor_hp" => "0853242372671",
            "alamat" => "Palembang",
            "id_role" => "RO-2003064",
            "jenis_kelamin" => "L",
            "usia" => "20",
            "berat_badan" => "40.5",
            "tinggi_badan" => "161.5",
            "tempat_lahir" => "Bandung",
            "tanggal_lahir" => "2023-02-02",
            "status" => "1"
        ]);

        User::create([
            "nama" => "Mohammad Prasetya",
            "email" => "prasetya@gmail.com",
            "password" => bcrypt("password"),
            "nomor_hp" => "08532423726759",
            "alamat" => "Brazil",
            "id_role" => "RO-2003065",
            "created_by" => 1,
            "status" => 1
        ]);

        User::create([
            "nama" => "Mohammad Septian",
            "email" => "septian@gmail.com",
            "password" => bcrypt("password"),
            "nomor_hp" => "08532423726780",
            "alamat" => "Konghucu",
            "id_role" => "RO-2003065",
            "status" => 1
        ]);

        User::create([
            "nama" => "Abdul Rahman",
            "email" => "abdul123@gmail.com",
            "password" => bcrypt("password"),
            "nomor_hp" => "085324237267812",
            "alamat" => "Bandung",
            "id_role" => "RO-2003062",
            "status" => 1
        ]);

        User::create([
            "nama" => "Syarifudin",
            "email" => "syarifudin@gmail.com",
            "password" => bcrypt("owner_rs"),
            "nomor_hp" => "1234567891011",
            "alamat" => "Cirebon",
            "id_role" => "RO-2003066",
            "status" => 1
        ]);

        User::create([
            "nama" => "Dimas Prayogo",
            "email" => "dimas_prayogo@gmail.com",
            "password" => bcrypt("owner_rs"),
            "nomor_hp" => "121212",
            "alamat" => "Cirebon",
            "id_role" => "RO-2003066",
            "status" => 1
        ]);

        User::create([
            "nama" => "Rizi Dimas",
            "email" => "rizkidimas@gmail.com",
            "password" => bcrypt("perawat"),
            "nomor_hp" => "08373737",
            "alamat" => "Cirebon",
            "id_role" => "RO-2003063",
            "status" => 1
        ]);

        User::create([
            "nama" => "Rizki Anugrah",
            "email" => "rizkianugrah@gmail.com",
            "password" => bcrypt("perawat123"),
            "nomor_hp" => "2839232398",
            "alamat" => "Cirebon",
            "id_role" => "RO-2003063",
            "status" => 1
        ]);

        User::create([
            "nama" => "Fyou",
            "email" => "fyou@gmail.com",
            "password" => bcrypt("perawat123"),
            "nomor_hp" => "33384938493",
            "alamat" => "Cirebon",
            "id_role" => "RO-2003063",
            "status" => 1
        ]);

        User::create([
            "nama" => "Harry Poter",
            "email" => "harry@gmail.com",
            "password" => bcrypt("dokter"),
            "nomor_hp" => "529302930",
            "alamat" => "Jakarta Raya",
            "id_role" => "RO-2003062",
            "status" => 1
        ]);

        User::create([
            "nama" => "Maguire",
            "email" => "maguire@gmail.com",
            "password" => bcrypt("dokter"),
            "nomor_hp" => "999999",
            "alamat" => "Batvia",
            "id_role" => "RO-2003062",
            "status" => 1
        ]);

        User::create([
            "nama" => "Aisyah",
            "email" => "aisyah@gmail.com",
            "password" => bcrypt("perawat123"),
            "nomor_hp" => "99239020",
            "alamat" => "Solo",
            "id_role" => "RO-2003063",
            "status" => 1
        ]);

        User::create([
            "nama" => "Tri",
            "email" => "tri@gmail.com",
            "password" => bcrypt("perawat123"),
            "nomor_hp" => "9923892",
            "alamat" => "Magelang",
            "id_role" => "RO-2003063",
            "status" => 1
        ]);

        User::create([
            "nama" => "Penanggung Jawab 1",
            "email" => "pj_1@gmail.com",
            "password" => bcrypt("penanggung_jawab"),
            "nomor_hp" => "2839238292998",
            "alamat" => "Banyuwangi",
            "id_role" => "RO-2003067",
            "status" => 1
        ]);

        User::create([
            "nama" => "Penanggung Jawab 2",
            "email" => "pj_2@gmail.com",
            "password" => bcrypt("penanggung_jawab"),
            "nomor_hp" => "2839238292999",
            "alamat" => "Padang",
            "id_role" => "RO-2003067",
            "status" => 1
        ]);
    }
}
