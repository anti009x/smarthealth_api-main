<?php

namespace App\Http\Controllers\API\Master\Obat\Transaksi;

use App\Http\Controllers\Controller;
use App\Http\Resources\Apotek\Master\Obat\Transaksi\GetTransaksiMasukResource;
use App\Models\Master\Obat\TransaksiObat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransaksiObatMasukController extends Controller
{
    public function index()
    {
        return DB::transaction(function () {
            $transaksi = TransaksiObat::orderBy("created_at", "DESC")->paginate(10);

            return GetTransaksiMasukResource::collection($transaksi);
        });
    }

    public function store(Request $request)
    {
        return DB::transaction(function () use ($request) {
            TransaksiObat::create([
                "id_transaksi_obat" => "TRN-O-" . date("YmdHis"),
                "kode_produk" => $request->kode_produk,
                "tanggal" => date("Y-m-d"),
                "qty" => $request->qty,
                "apotek_id" => Auth::user()->getAdminApotek->id_profil_apotek,
                "nama_supplier" => empty($request->nama_supplier) ? null : $request->nama_supplier,
                "asal_supplier" => empty($request->asal_supplier) ? null : $request->asal_supplier,
                "status" => 1
            ]);

            return response()->json(["pesan" => "Data Transaksi Obat Masuk Berhasil di Tambahkan"]);
        });
    }

    public function edit($id_transaksi_obat)
    {
        return DB::transaction(function () use ($id_transaksi_obat) {
            $transaksi = TransaksiObat::where("id_transaksi_obat", $id_transaksi_obat)->first();

            return new GetTransaksiMasukResource($transaksi);
        });
    }

    public function update(Request $request, $id_transaksi_obat)
    {
        return DB::transaction(function () use ($id_transaksi_obat, $request) {

            TransaksiObat::where("id_transaksi_obat", $id_transaksi_obat)->update([
                "obat_id" => $request->obat_id,
                "tanggal" => $request->tanggal,
                "qty" => $request->qty,
                "nama_supplier" => empty($request->nama_supplier) ? null : $request->nama_supplier,
                "asal_supplier" => empty($request->asal_supplier) ? null : $request->asal_supplier
            ]);

            return response()->json(["pesan" => "Data Transaksi Obat Masuk Berhasil di Simpan"]);
        });
    }

    public function destroy($id_transaksi_obat)
    {
        return DB::transaction(function () use ($id_transaksi_obat) {

            TransaksiObat::where("id_transaksi_obat", $id_transaksi_obat)->delete();

            return response()->json(["pesan" => "Data Transaksi Obat Masuk Berhasil di Hapus"]);
        });
    }
}
