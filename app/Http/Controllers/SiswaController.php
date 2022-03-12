<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $data  = Siswa::all();
        return response()->json([
            'success' => true,
            'message' => "list data siswa",
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => "required",
            'NIS' => "required",
            "kelas" => "required",
            "alamat" => "required"
        ]);
        Siswa::create($request->all());
        return response()->json([
            "success" => true,
            "message" => "data berhasil ditambahkan"
        ]);
    }


    public function show($id)
    {
        $data = Siswa::find($id);
        return response()->json([
            'success' => true,
            'message' => "detail data siswa",
            "data" => $data
        ]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => "required",
            'NIS' => "required",
            "kelas" => "required",
            "alamat" => "required"
        ]);
        $data = Siswa::find($id);
        $data->nama = htmlspecialchars($request['nama']);
        $data->NIS = htmlspecialchars($request['NIS']);
        $data->kelas = htmlspecialchars($request['kelas']);
        $data->alamat = htmlspecialchars($request['alamat']);
        $data->save();
        return response()->json([
            "success" => true,
            "message" => "data berhasil diupdate"
        ]);
    }


    public function destroy($id)
    {
        $data = Siswa::find($id);
        $data->delete();
        $data_siswa =  Siswa::onlyTrashed()->where("id_siswa", $id)->get();
        return response()->json([
            'success' => true,
            'message' => "data berhasil dihapus",
            "data" => $data_siswa
        ]);
    }

    public function restore($id)
    {
        $data_siswa =  Siswa::onlyTrashed()->where("id_siswa", $id);
        $data_siswa->restore();
        return response()->json([
            'success' => true,
            'message' => "data berhasil di restore",
        ]);
    }
}
