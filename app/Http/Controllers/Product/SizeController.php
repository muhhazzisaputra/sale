<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Size;
use Illuminate\Support\Facades\DB;

class SizeController extends Controller
{

    public function index() {
        return view('product/size/size_list', [
            'title' => 'Ukuran Produk'
        ]);
    }

    public function read() {
        $data = Size::orderBy("name", "asc")->get();
        return view('product/size/size_read')->with([
            'sizes' => $data
        ]);
    }

    public function create() {
        return view('product/size/size_create');
    }

    public function store(Request $request) {
        $today = date("Y-m-d H:i:s");

        $size = Size::max('counter');
        $kode    = ($size == null) ? 1 : $size+1;
        $kodemax = str_pad($kode, 2, "0", STR_PAD_LEFT);

        $data['size_code']   = $kodemax;
        $data['name']        = $request->name;
        $data['counter']     = $kode;
        $data['input_user']  = auth()->user()->id;
        $data['input_date']  = $today;
        $data['update_user'] = auth()->user()->id;
        $data['updated_at']  = $today;

        DB::beginTransaction();

            Size::insert($data);

        DB::commit();

        return response()->json(['status' => 'success']);
    }

    public function show(Request $request) {
        $id = $request->id;

        $size = Size::where('size_id', $id)->first();

        return view('product/size/size_edit')->with([
            'size' => $size
        ]);
    }

    public function update(Request $request) {
        $id = $request->size_id;

        DB::beginTransaction();

            DB::table('sizes')->where('size_id', $id)->update([
                'name'        => $request->name,
                'update_user' => auth()->user()->id,
                'updated_at'  => date("Y-m-d H:i:s")
            ]);;

        DB::commit();

        return response()->json(['status' => 'success']);
    }

    public function destroy(Request $request)
    {
        $id    = $request->id;
        $token = $request->_token;

        DB::beginTransaction();

            $group = Size::where('size_id', $id);
            $group->delete();

        DB::commit();
        return response()->json(['status' => 'success']);
    }

    public function trash()
    {
        // menampilkan data yang sudah dihapus
        $sizes = Size::onlyTrashed()->get();
        return view('product/size/size_trash', [
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
