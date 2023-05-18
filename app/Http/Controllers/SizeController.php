<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Size;
use Illuminate\Support\Facades\DB;

class SizeController extends Controller
{

    public function index()
    {
        return view('product/size_list', [
            'title' => 'Ukuran Produk'
        ]);
    }

    public function read() {
        $data = Size::orderBy("name", "asc")->get();
        return view('product/size_read')->with([
            'sizes' => $data
        ]);
    }

    public function create()
    {
        return view('product/size_create', [
            'title' => 'Tambah Size'
        ]);
    }

    public function store(Request $request)
    {
        $data['name'] = $request->name;

        DB::beginTransaction();

            SIze::insert($data);

        DB::commit();

        return response()->json(['status' => 'success']);
    }

    public function show($id)
    {
        $size = Size::findOrFail($id);
        return $size;
    }

    public function edit(Size $size)
    {
        return view('product/size_edit', [
            'title' => 'Edit Ukuran',
            'size'  => $size
        ]);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        DB::beginTransaction();

            $size = Size::find($id);
            $size->name = $request->name;
            $size->update();

        DB::commit();

        return response()->json(['status' => 'success']);
    }

    public function destroy(Request $request)
    {
        $id    = $request->id;
        $token = $request->_token;

        DB::beginTransaction();

            $group = Size::find($id);
            $group->delete();

        DB::commit();
        return response()->json(['status' => 'success']);
    }

    public function trash()
    {
        // menampilkan data yang sudah dihapus
        $sizes = Size::onlyTrashed()->get();
        return view('product/size_trash', [
            'title' => 'Trash Ukuran',
            'sizes' => $sizes
        ]);
    }

    public function restore($id = "")
    {
        if($id) {
            Size::onlyTrashed()->where('id', $id)->restore();
        } else {
            Size::onlyTrashed()->restore();
        }

        return redirect('/size')->with('success', 'Data berhasil direstore.');
    }

    public function forceDelete($id = "")
    {   
        if($id) {
            Size::onlyTrashed()->where('id', $id)->forceDelete();
        } else {
            Size::onlyTrashed()->forceDelete();
        }

        return redirect('/size/trash')->with('success', 'Data berhasil dihapus permanen.');
    }

}
