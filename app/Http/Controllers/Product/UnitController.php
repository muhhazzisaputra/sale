<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unit;
use Illuminate\Support\Facades\DB;

class UnitController extends Controller
{
    
    public function index() {
        return view('product/unit/unit_list', [
            'title' => 'Satuan Produk'
        ]);
    }

    public function read() {
        $data = Unit::orderBy("name", "asc")->get();
        return view('product/unit/unit_read')->with([
            'units' => $data
        ]);
    }

    public function create() {
        return view('product/unit/unit_create');
    }

    public function store(Request $request) {
        $today = date("Y-m-d H:i:s");

        $unit    = Unit::max('counter');
        $kode    = ($unit == null) ? 1 : $unit+1;
        $kodemax = str_pad($kode, 2, "0", STR_PAD_LEFT);

        $data['unit_code']   = $kodemax;
        $data['name']        = $request->name;
        $data['counter']     = $kode;
        $data['input_user']  = auth()->user()->id;
        $data['input_date']  = $today;
        $data['update_user'] = auth()->user()->id;
        $data['updated_at']  = $today;

        DB::beginTransaction();

            Unit::insert($data);

        DB::commit();

        return response()->json(['status' => 'success']);
    }

    public function show(Request $request) {
        $id = $request->id;

        $unit = Unit::where('unit_id', $id)->first();

        return view('product/unit/unit_edit')->with([
            'unit' => $unit
        ]);
    }

    public function update(Request $request) {
        $id = $request->unit_id;

        DB::beginTransaction();

            DB::table('units')->where('unit_id', $id)->update([
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

            $group = Unit::where('unit_id', $id);
            $group->delete();

        DB::commit();
        return response()->json(['status' => 'success']);
    }

    public function trash()
    {
        // menampilkan data yang sudah dihapus
        $units = Unit::onlyTrashed()->get();
        return view('product/unit/unit_trash', [
            'title' => 'Trash Ukuran',
            'units' => $units
        ]);
    }

    public function restore($id = "")
    {
        if($id) {
            Unit::onlyTrashed()->where('id', $id)->restore();
        } else {
            Unit::onlyTrashed()->restore();
        }

        return redirect('/unit')->with('success', 'Data berhasil direstore.');
    }

    public function forceDelete($id = "")
    {   
        if($id) {
            Unit::onlyTrashed()->where('id', $id)->forceDelete();
        } else {
            Unit::onlyTrashed()->forceDelete();
        }

        return redirect('/unit/trash')->with('success', 'Data berhasil dihapus permanen.');
    }

}
