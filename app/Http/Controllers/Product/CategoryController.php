<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

    public function index()
    {
        return view('product/category/category_list', [
            'title' => 'Kategori Produk'
        ]);
    }

    public function read() {
        $data = Category::orderBy("name", "asc")->get();

        return view('product/category/category_read')->with([
            'categories' => $data
        ]);
    }

    public function add() {
        return view('product/category/category_add');
    }

    public function store(Request $request) {
        $today = date("Y-m-d H:i:s");

        $data['category_code'] = strtoupper($request->code);
        $data['name']          = $request->name;
        $data['input_user']    = auth()->user()->id;
        $data['input_date']    = $today;
        $data['update_user']   = auth()->user()->id;
        $data['updated_at']    = $today;

        DB::beginTransaction();

            Category::insert($data);

        DB::commit();

        return response()->json(['status' => 'success']);
    }

    public function show(Request $request) {
        $id = $request->id;

        $category = Category::where('category_id', $id)->first();

        return view('product/category/category_edit')->with([
            'category' => $category
        ]);
    }

    public function update(Request $request) {
        $id = $request->category_id;

        DB::beginTransaction();

            DB::table('categories')->where('category_id', $id)->update([
                'name'        => $request->name,
                'update_user' => auth()->user()->id,
                'updated_at'  => date("Y-m-d H:i:s")
            ]);

        DB::commit();

        return response()->json(['status' => 'success']);
    }

    public function destroy(Request $request) {
        $id    = $request->id;
        $token = $request->_token;

        DB::beginTransaction();

            $category = Category::where('category_id', $id);
            $category->delete();

        DB::commit();
        return response()->json(['status' => 'success']);
    }

    public function trash()
    {
        // get data yang sudah dihapus
        $categories = Category::onlyTrashed()->orderBy('category_id', 'desc')->get();
        return view('product/category/category_trash', [
            'title'      => 'Trash Kategori',
            'categories' => $categories
        ]);
    }

    public function restore($id = "")
    {
        if($id) {
            Category::onlyTrashed()->where('id', $id)->restore();
        } else {
            Category::onlyTrashed()->restore();
        }

        return redirect('/category')->with('success', 'Data berhasil direstore.');
    }

    public function forceDelete($id = "")
    {   
        if($id) {
            Category::onlyTrashed()->where('id', $id)->forceDelete();
        } else {
            Category::onlyTrashed()->forceDelete();
        }

        return redirect('/category/trash')->with('success', 'Data berhasil dihapus permanen.');
    }

}
