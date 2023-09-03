<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Color;
use Illuminate\Support\Facades\DB;

class ColorController extends Controller {
    
    public function index() {
        return view('product/color/color_list', [
            'title' => 'Warna Produk',
        ]);
    }

    public function read() {
        $data = Color::orderBy("name", "asc")->get();
        return view('product/color/color_read')->with([
            'colors' => $data
        ]);
    }

    public function create() {
        return view('product/color/color_create');
    }

    public function store(Request $request) {
        $today = date("Y-m-d H:i:s");

        $color    = Color::max('counter');
        $kode    = ($color == null) ? 1 : $color+1;
        $kodemax = str_pad($kode, 2, "0", STR_PAD_LEFT);

        $data['color_code']  = $kodemax;
        $data['name']        = $request->name;
        $data['counter']     = $kode;
        $data['input_user']  = auth()->user()->id;
        $data['input_date']  = $today;
        $data['update_user'] = auth()->user()->id;
        $data['updated_at']  = $today;

        DB::beginTransaction();

            Color::insert($data);

        DB::commit();

        return response()->json(['status' => 'success']);
    }

    public function show(Request $request) {
        $id = $request->id;

        $color = Color::where('color_id', $id)->first();

        return view('product/color/color_edit')->with([
            'color' => $color
        ]);
    }

    public function update(Request $request) {
        $id = $request->color_id;

        DB::beginTransaction();

            DB::table('colors')->where('color_id', $id)->update([
                'name'        => $request->name,
                'update_user' => auth()->user()->id,
                'updated_at'  => date("Y-m-d H:i:s")
            ]);;

        DB::commit();

        return response()->json(['status' => 'success']);
    }

    public function destroy(Request $request) {
        $id    = $request->id;
        $token = $request->_token;

        DB::beginTransaction();

            $color = Color::where('color_id', $id);
            $color->delete();

        DB::commit();
        return response()->json(['status' => 'success']);
    }

    public function trash() {
        // menampilkan data yang sudah dihapus
        $colors = Color::onlyTrashed()->get();
        return view('product/color/color_trash', [
            'title'  => 'Trash Ukuran',
            'colors' => $colors
        ]);
    }

    public function restore($id = "") {
        if($id) {
            Color::onlyTrashed()->where('id', $id)->restore();
        } else {
            Color::onlyTrashed()->restore();
        }

        return redirect('/color')->with('success', 'Data berhasil direstore.');
    }

    public function forceDelete($id = "") {   
        if($id) {
            Color::onlyTrashed()->where('id', $id)->forceDelete();
        } else {
            Color::onlyTrashed()->forceDelete();
        }

        return redirect('/color/trash')->with('success', 'Data berhasil dihapus permanen.');
    }

}
