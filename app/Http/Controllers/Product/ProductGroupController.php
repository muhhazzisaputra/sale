<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductGroup;
use Illuminate\Support\Facades\DB;

class ProductGroupController extends Controller
{
    
    public function index() {
        return view('product/group/group_list', [
            'title'  => 'Kelompok Produk'
        ]);
    }

    public function read() {
        $data = ProductGroup::orderBy("name", "asc")->get();
        return view('product/group/group_read')->with([
            'groups' => $data
        ]);
    }

    public function add() {
        return view('product/group/group_add');
    }

    public function store(Request $request) {
        $today = date("Y-m-d H:i:s");

        $data['group_code']  = strtoupper($request->group_code);
        $data['name']        = $request->name;
        $data['input_user']  = auth()->user()->id;
        $data['input_date']  = $today;
        $data['update_user'] = auth()->user()->id;
        $data['updated_at']  = $today;

        DB::beginTransaction();

            ProductGroup::insert($data);

        DB::commit();

        return response()->json(['status' => 'success']);
    }

    public function show(Request $request) {
        $id = $request->id;

        $group = ProductGroup::where('group_id', $id)->first();

        return view('product/group/group_edit')->with([
            'group' => $group
        ]);
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

            $group = ProductGroup::where('group_id', $id);
            $group->delete();

        DB::commit();
        return response()->json(['status' => 'success']);
    }

    public function trash() {
        // mengampil data yang sudah dihapus
        $groups = ProductGroup::onlyTrashed()->orderBy('group_id', 'desc')->get();
        return view('product/group/group_trash', [
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
