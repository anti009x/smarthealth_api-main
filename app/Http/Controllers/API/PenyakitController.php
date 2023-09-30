<?php



namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;

use App\Models\Penyakit;
use Illuminate\Http\Request;

class PenyakitController extends Controller
{
 
    public function index()
    {
        $penyakit = Penyakit::all();
        return response()->json($penyakit);

    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'penyebab' => 'required'
        ]);

        $data = $request->all();

        Penyakit::create($data);

        return back()->with('success', 'Data penyakit berhasil disimpan');
    }

    public function json()
    {
        $data = Penyakit::find(request('id'));

        return response()->json($data);
    }

    public function update(Request $request)
    {
        $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'penyebab' => 'required'
        ]);

        $data = $request->all();

        Penyakit::find($request->id)->update($data);

        return back()->with('success', 'Data penyakit berhasil diubah');
    }

    public function destroy(Penyakit $penyakit)
    {
        $penyakit->delete();
        return back()->with('success', 'Data penyakit berhasil dihapus');
    }
}
