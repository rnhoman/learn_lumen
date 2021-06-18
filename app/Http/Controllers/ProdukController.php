<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\JsonResponse;

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
                'descriptions'  => 'Data sudah ada, gagal disimpan',
            ]);
        }

        $create = Produk::create($data);
        return response()->json([
            'code'          => 200,
            'descriptions'  => 'Data berhasil disimpan',
            'Contents'      => $create 
        ]);
    }

    //
}
