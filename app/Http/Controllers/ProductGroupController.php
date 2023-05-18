<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductGroup;
use Illuminate\Support\Facades\DB;

class ProductGroupController extends Controller
{
    
    public function index() {
        return view('product/group_list', [
            'title'  => 'Kelompok Produk'
        ]);
    }

    public function read() {
        $data = ProductGroup::orderBy("name", "asc")->get();
        return view('product/group_read')->with([
            'groups' => $data
        ]);
    }

    public function store(Request $request) {
        $data['code'] = strtoupper($request->code);
        $data['name'] = $request->name;

        DB::beginTransaction();

            ProductGroup::insert($data);

        DB::commit();

        return response()->json(['status' => 'success']);
    }

    public function show($id) {
        $group = ProductGroup::findOrFail($id);
        return $group;
    }

    public function update(Request $request) {
        $id = $request->id;
        DB::beginTransaction();

            $group = ProductGroup::find($id);
            $group->name = $request->name;
            $group->update();

        DB::commit();

        return response()->json(['status' => 'success']);
    }

    public function destroy(Request $request) {
        $id    = $request->id;
        $token = $request->_token;

        DB::beginTransaction();

            $group = ProductGroup::find($id);
            $group->delete();

        DB::commit();
        return response()->json(['status' => 'success']);
    }

    public function trash() {
        // mengampil data yang sudah dihapus
        $groups = ProductGroup::onlyTrashed()->orderBy('id', 'desc')->get();
        return view('product/group_trash', [
            'title'  => 'Trash Kelompok Produk',
            'groups' => $groups
        ]);
    }

    public function restore($id = "") {
        if($id) {
            ProductGroup::onlyTrashed()->where('id', $id)->restore();
        } else {
            ProductGroup::onlyTrashed()->restore();
        }

        alert()->success('Success!', 'Data berhasil direstore.');
        return redirect('/group/trash');
    }

    public function forceDelete($id = "") {   
        if($id) {
            ProductGroup::onlyTrashed()->where('id', $id)->forceDelete();
        } else {
            ProductGroup::onlyTrashed()->forceDelete();
        }

        alert()->success('Success!', 'Data berhasil dihapus permanen.');
        return redirect('/group/trash');
    }

}
