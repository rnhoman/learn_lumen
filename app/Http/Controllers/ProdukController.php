<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
        $getData = Produk::orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'code'          => 200,
            'descriptions'  => 'Data berhasil ditampilkan',
            'Contents'      => $getData 
        ]);
    }
    
    public function show($id)
    {
        $getById = Produk::find($id);

        if(!$getById) {
            return response()->json([
                'code'          => 404,
                'descriptions'  => 'Data kosong',
            ]);
        }

        return response()->json([
            'code'          => 200,
            'descriptions'  => 'Data detail berhasil ditampilkan',
            'Contents'      => $getById 
        ]);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'nama'      => 'required|string',
            'harga'     => 'required|integer',
            'warna'     => 'required|string', 
            'kondisi'   => 'required|in:baru, lama', 
            'deskripsi' => 'string',
        ]);

        $data = $request->all();

        $cekNama = Produk::where('nama',$request->nama)->first();
        if($cekNama) {
            return response()->json([
                'code'          => 422,
                'descriptions'  => 'Data sudah ada, gagal di simpan',
            ]);
        }

        $create = Produk::create($data);
        return response()->json([
            'code'          => 200,
            'descriptions'  => 'Data berhasil di simpan',
            'Contents'      => $create 
        ]);
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::find($id);
        $this->validate($request, [
            'nama'      => 'string',
            'harga'     => 'integer',
            'warna'     => 'string', 
            'kondisi'   => 'in:baru, lama', 
            'deskripsi' => 'string',
        ]);
        $data = $request->all();

        if(!$produk) {
            return response()->json([
                'code'          => 404,
                'descriptions'  => 'Data tidak ditemukan',
            ]);
        }
        $produk->fill($data);
        $produk->save();
        return response()->json([
            'code'          => 200,
            'descriptions'  => 'Data berhasil di rubah',
            'Contents'      => $produk 
        ]);
    }

    public function destroy($id)
    {
        $produk = Produk::find($id);
        if(!$produk) {
            return response()->json([
                'code'          => 404,
                'descriptions'  => 'Data tidak ditemukan',
            ]);
        }

        $produk->delete();
        return response()->json([
            'code'          => 200,
            'descriptions'  => 'Data berhasil di hapus',
        ]);
    }

    //
}
