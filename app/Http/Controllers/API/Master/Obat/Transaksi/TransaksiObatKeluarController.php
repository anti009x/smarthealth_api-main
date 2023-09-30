<?php

namespace App\Http\Controllers\API\Master\Obat\Transaksi;

use App\Http\Controllers\Controller;
use App\Http\Resources\Apotek\Master\Obat\Transaksi\GetTransaksiKeluarResource;
use App\Models\Master\Obat\TransaksiObat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransaksiObatKeluarController extends Controller
{
    public function index()
    {
        return DB::transaction(function () {
            $transaksi = TransaksiObat::orderBy("created_at", "DESC")->with("getObat:id_obat,nama_obat,harga")->paginate(10);

            return GetTransaksiKeluarResource::collection($transaksi);
        });
    }

    public function store(Request $request)
    {
        return DB::transaction(function () use ($request) {
            TransaksiObat::create([
                "id_transaksi_obat" => "TRN-O-" . date("YmdHis"),
                "obat_id" => $request->obat_id,
                "tanggal" => $request->tanggal,
                "qty" => $request->qty,
                "apotek_id" => Auth::user()->getAdminApotek->id_profil_apotek,
                "status" => 0
            ]);

            return response()->json(["pesan" => "Data Transaksi Obat Keluar Berhasil di Tambahkan"]);
        });
    }

    public function edit($id_transaksi_obat)
    {
        return DB::transaction(function () use ($id_transaksi_obat) {
            $transaksi = TransaksiObat::where("id_transaksi_obat", $id_transaksi_obat)->first();

            return new GetTransaksiKeluarResource($transaksi);
        });
    }

    public function update(Request $request, $id_transaksi_obat)
    {
        return DB::transaction(function () use ($id_transaksi_obat, $request) {

            TransaksiObat::where("id_transaksi_obat", $id_transaksi_obat)->update([
                "obat_id" => $request->obat_id,
                "tanggal" => $request->tanggal,
                "qty" => $request->qty
            ]);

            return response()->json(["pesan" => "Data Transaksi Obat Keluar Berhasil di Simpan"]);
        });
    }

    public function destroy($id_transaksi_obat)
    {
        return DB::transaction(function () use ($id_transaksi_obat) {

            TransaksiObat::where("id_transaksi_obat", $id_transaksi_obat)->delete();

            return response()->json(["pesan" => "Data Transaksi Obat Keluar Berhasil di Hapus"]);
        });
    }
}
