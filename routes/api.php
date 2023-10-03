<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\DiagnosaController;
use App\Http\Controllers\API\GejalaController;
use App\Http\Controllers\API\PenyakitController;
use App\Http\Controllers\API\RiwayatController;


use App\Http\Controllers\API\Akun\AllAccountController;
use App\Http\Controllers\API\Akun\ChangePasswordController;
use App\Http\Controllers\API\Akun\CompanyController;
use App\Http\Controllers\API\Akun\DokterController;
use App\Http\Controllers\API\Akun\KonsumenController;
use App\Http\Controllers\API\Akun\OwnerApotekController;
use App\Http\Controllers\API\Akun\OwnerRumahSakitController;
use App\Http\Controllers\API\Akun\PerawatController;
use App\Http\Controllers\API\Akun\Profile\Konsumen\ProfileController;
use App\Http\Controllers\API\Akun\Public\ActivateAccountController;
use App\Http\Controllers\API\Akun\Public\PictureController;
use App\Http\Controllers\API\Autentikasi\LoginController;
use App\Http\Controllers\API\DashboardController;
use App\Http\Controllers\API\Konsumen\PembayaranController;
use App\Http\Controllers\API\Konsumen\CheckoutController;
use App\Http\Controllers\API\Konsumen\RiwayatTransaksiBuatJanjiController;
use App\Http\Controllers\API\Master\Ahli\JadwalAntrianController;
use App\Http\Controllers\API\Master\Ahli\KeahlianController;
use App\Http\Controllers\API\Master\Alamat\AlamatUserController;
use App\Http\Controllers\API\Master\Artikel\DataArtikelController;
use App\Http\Controllers\API\Master\Artikel\DetailArtikelController;
use App\Http\Controllers\API\Master\Artikel\GroupingArtikelController;
use App\Http\Controllers\API\Master\Artikel\KategoriArtikelController;
use App\Http\Controllers\API\Master\CariKeahlianController;
use App\Http\Controllers\API\Master\CariRumahSakitController;
use App\Http\Controllers\API\Master\Obat\GolonganObatController;
use App\Http\Controllers\API\Master\Obat\Transaksi\TransaksiObatKeluarController;
use App\Http\Controllers\API\Master\Obat\Transaksi\TransaksiObatMasukController;
use App\Http\Controllers\API\Master\Pengaturan\ProfilController;
use App\Http\Controllers\API\Master\Penyakit\SpesialisPenyakitController;
use App\Http\Controllers\API\Master\Produk\KategoriProdukController;
use App\Http\Controllers\API\Master\RoleController;
use App\Http\Controllers\API\Master\RumahSakit\GetSpesialisDokterController;
use App\Http\Controllers\API\Master\RumahSakit\SpesialisRumahSakitController;
use App\Http\Controllers\API\Produk\DataProdukController;
use App\Http\Controllers\API\Produk\ProdukKategoriController;
use App\Http\Controllers\API\Tes\CekResiController;
use App\Http\Controllers\API\Tes\RajaOngkirController;
use App\Http\Controllers\API\Transaksi\PesanPerawatController;
use App\Http\Controllers\API\Transaksi\PlottingResepProdukController;
use App\Http\Controllers\Apotek\Pengaturan\ProfilApotekController;
use App\Http\Controllers\ChatingController;
use App\Http\Controllers\Midtrans\NotificationController;
use App\Http\Controllers\Midtrans\PaymentController;
use App\Http\Controllers\Midtrans\TokenController;
use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/








// Route::get("/send-message", [ChatingController::class, "handle"]);

Route::post("/notification", [NotificationController::class, "post"]);

Route::get("/qr/{code}", [DashboardController::class, "qr"]);
Route::post("/tes_ongkir", [RajaOngkirController::class, "index"]);

Route::get("/create-api", [DashboardController::class, "create_api"]);
Route::get("/resi", [CekResiController::class, "index"]);

require __DIR__ . '/auth/login.php';

Route::prefix("akun")->group(function () {
    Route::put("/user/uid", [ProfileController::class, "update_uid"]);
    Route::resource("/konsumen", KonsumenController::class);
});




Route::middleware("auth:sanctum")->group(function () {

    Route::post('diagnosa', [DiagnosaController::class, 'diagnosa']);
    // Diagnosa routes
Route::get('/diagnosa', [DiagnosaController::class, 'index']);



// Gejala routes
Route::get('gejala', [GejalaController::class, 'index']);
Route::post('gejala', [GejalaController::class, 'store']);
Route::get('gejala/{gejala}', [GejalaController::class, 'show']);
Route::put('gejala/{gejala}', [GejalaController::class, 'update']);
Route::delete('gejala/{gejala}', [GejalaController::class, 'destroy']);


// Penyakit routes
    Route::get('penyakit', [PenyakitController::class, 'index']);
    Route::post('penyakit', [PenyakitController::class, 'store']);
    Route::get('penyakit/{penyakit}', [PenyakitController::class, 'show']);
    Route::put('penyakit/{penyakit}', [PenyakitController::class, 'update']);
    Route::delete('penyakit/{penyakit}', [PenyakitController::class, 'destroy']);

// Riwayat routes
    Route::get('riwayat', [RiwayatController::class, 'index']);
    Route::get('riwayat/{riwayat}', [RiwayatController::class, 'show']);

    Route::get("/midtrans/get_token/{id_keranjang}", [TokenController::class, "get_token"]);

    Route::get("/plotting", [PlottingResepProdukController::class, "index"]);

    require __DIR__ . '/midtrans/bank/list_bank.php';

    require __DIR__ . '/ahli/resep/resep_obat.php';

    Route::prefix("akun")->group(function () {

        Route::put("/update-picture", [PictureController::class, "update_picture"]);

        Route::get("/all_account", [AllAccountController::class, "index"]);
        Route::get("/data_register", [AllAccountController::class, "data_register"]);
        Route::get("/data_praktek_dokter", [AllAccountController::class, "data_praktek_dokter"]);
        Route::put("/update_praktek_dokter/{id_praktek_ahli}/update", [AllAccountController::class, "update"]);

        Route::resource("/company", CompanyController::class);

        Route::get("/dokter/data", [DokterController::class, "data"]);
        Route::get("/dokter/{uid_partner}", [DokterController::class, "uid_partner"]);
        Route::resource("/dokter", DokterController::class);

        Route::get("/perawat/data", [PerawatController::class, "data"]);
        Route::resource("/perawat", PerawatController::class);

        Route::resource("/apotek", OwnerApotekController::class);
        Route::resource("/owner_rs", OwnerRumahSakitController::class);

        Route::prefix("profil")->group(function () {

            require __DIR__ . '/account/profil/admin/profil.php';

            require __DIR__ . '/account/profil/apotek/login.php';

            require __DIR__ . '/account/profil/perawat/profil.php';

            require __DIR__ . '/account/profil/konsumen/profil.php';

            require __DIR__ . '/account/profil/dokter/profil.php';
        });

        Route::put("/active_account/{id_user}", [ActivateAccountController::class, "active_account"]);

        Route::put("/active_account/{id_user}/account", [ActivateAccountController::class, "active_account_status"]);

        Route::put("/change_password", [ChangePasswordController::class, "change_password"]);
    });

    Route::prefix("master")->group(function () {

        require __DIR__ . '/ahli/rating/rating.php';
        require __DIR__ . '/ahli/praktek/praktek_ahli.php';
        require __DIR__ . '/ahli/jadwal/antrian.php';
        require __DIR__ . '/ahli/jadwal/praktek.php';
        require __DIR__ . '/ahli/detail/praktek.php';
        require __DIR__ . '/ahli/keahlian/master_keahlian.php';
        require __DIR__ . '/master/pembelian/pembelian.php';

        Route::prefix("cari")->group(function() {
            Route::post("/keahlian", [CariKeahlianController::class, "index"]);
            Route::post("/rumah_sakit", [CariRumahSakitController::class, "index"]);
        });

        Route::resource("alamat_user", AlamatUserController::class);

        Route::prefix("produk")->group(function () {
            Route::resource("kategori_produk", KategoriProdukController::class);
        });

        Route::get("/artikel/{id_artikel}/ambil_kategori", [DataArtikelController::class, "get"]);
        Route::get("/artikel/{user_id}/get", [DataArtikelController::class, "get_by_id"]);
        Route::get("/artikel/{slug}", [DetailArtikelController::class, "index"]);
        Route::resource("role", RoleController::class);
        Route::resource("kategori_artikel", KategoriArtikelController::class);
        Route::resource("artikel", DataArtikelController::class);
        Route::get("/grouping_artikel/{id_artikel}/get", [GroupingArtikelController::class, "list_by_artikel"]);
        Route::get("/grouping_artikel/{id_kategori_artikel}/kategori", [GroupingArtikelController::class, "list_artikel_kategori"]);
        Route::resource("grouping_artikel", GroupingArtikelController::class);

        Route::prefix("obat")->group(function () {
            Route::resource("golongan_obat", GolonganObatController::class);
            Route::resource("transaksi_obat_masuk", TransaksiObatMasukController::class);
            Route::resource("transaksi_obat_keluar", TransaksiObatKeluarController::class);
        });

        Route::prefix("pengaturan")->group(function () {
            Route::resource("profil", ProfilController::class);
        });

        Route::resource("keahlian", KeahlianController::class);

        Route::prefix("rumah_sakit")->group(function () {

            require __DIR__ . '/master/rumah_sakit/data.php';

            Route::prefix("spesialis")->group(function() {
                Route::get("/{id_rumah_sakit}", [SpesialisRumahSakitController::class, "index"]);
                Route::post("/{id_rumah_sakit}", [SpesialisRumahSakitController::class, "store"]);
                Route::get("/{id_rumah_sakit}/{id_spesialis}", [SpesialisRumahSakitController::class, "edit"]);
                Route::put("/{id_spesialis}", [SpesialisRumahSakitController::class, "update"]);
                Route::delete("/{id_spesialis}", [SpesialisRumahSakitController::class, "destroy"]);
            });

            require __DIR__ . '/master/rumah_sakit/fasilitas.php';
        });
        Route::prefix("spesialis")->group(function () {
            Route::get("/{id_spesialis}/get_dokter", [GetSpesialisDokterController::class, "get_dokter"]);
            Route::get("/{id_spesialis}/{id_rumah_sakit}", [GetSpesialisDokterController::class, "index"]);
        });

        Route::prefix("penyakit")->group(function () {
            Route::resource("/spesialis_penyakit", SpesialisPenyakitController::class);
        });

        require __DIR__ . '/master/transaksi/rajaongkir/pengiriman.php';
    });

    Route::prefix("apotek")->group(function () {
        Route::prefix("pengaturan")->group(function () {
            Route::post("/profil_apotek/find_nearest", [ProfilApotekController::class, "find_nearest"]);
            Route::put("/profil_apotek/ubah_status/{id_profil_apotek}", [ProfilApotekController::class, "ubah_status"]);
            Route::resource("profil_apotek", ProfilApotekController::class);
        });

        Route::prefix("produk")->group(function () {
            Route::prefix("data_produk")->group(function() {
                Route::get("/by_owner", [DataProdukController::class, "get_by_owner"]);
                Route::get("/by_owner/{id_profil_apotek}/get", [DataProdukController::class, "get_produk_by_owner"]);
                Route::get("/all", [DataProdukController::class, "all"]);
            });
            Route::resource("/data_produk", DataProdukController::class);
            Route::get("/produk_kategori/{id_kategori}", [ProdukKategoriController::class, "detail_by_kategori"]);
            Route::resource("/produk_kategori", ProdukKategoriController::class);
        });
    });

    Route::prefix("konsumen")->group(function() {
        Route::post("/pembayaran", [PembayaranController::class, ""]);
        Route::resource("/riwayat_transaksi_buat_janji", RiwayatTransaksiBuatJanjiController::class);
        Route::resource("/checkout", CheckoutController::class);
    });

    Route::prefix("perawat")->group(function() {
        Route::resource("pesan_perawat", PesanPerawatController::class);
    });

    Route::prefix("ahli")->group(function() {
        
        Route::get("/jadwal_antrian", [JadwalAntrianController::class, "data_antrian"]);
        Route::get("/jadwal_antrian/{id_jadwal_antrian}", [JadwalAntrianController::class, "detail"]);
        Route::put("/jadwal_antrian/{id_jadwal_antrian}", [JadwalAntrianController::class, "update"]);
        Route::get("/transaksi_buat_janji", [RiwayatTransaksiBuatJanjiController::class, "transaksi_buat_janji"]);
    });
    
    Route::prefix("dokter")->group(function() {
        Route::get("/is_active", [DashboardController::class, "is_active"]);
    });

    require __DIR__ . '/transaksi/produk/produk.php';

    require __DIR__ . '/transaksi/konsultasi/rekap.php';

    require __DIR__ . '/master/transaksi/keranjang/keranjang.php';

    require __DIR__ . '/master/transaksi/detail_keranjang/detail.php';

    // require __DIR__ . '/xendit/pembayaran.php';

    Route::get("/count_data", [DashboardController::class, "dashboard"]);

    Route::get("/logout", [LoginController::class, "logout"]);
});