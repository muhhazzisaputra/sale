<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

    public function index()
    {
        return view('product/category_list', [
            'title' => 'Kategori Produk'
        ]);
    }

    public function read() {
        // $data = Category::orderBy("name", "asc")->get();

        $data = DB::table('categories AS A')
                    ->leftJoin('users AS B', 'B.id', '=', 'A.input_user')
                    ->leftJoin('users AS C', 'C.id', '=', 'A.update_user')
                    ->select('A.*', 'B.name AS UserInput', 'C.name AS UserEdit')
                    ->get();

        return view('product/category_read')->with([
            'categories' => $data
        ]);
    }

    public function store(Request $request) {
        $today = date("Y-m-d H:i:s");

        $data['category_code'] = strtoupper($request->code);
        $data['name']          = $request->name;
        $data['input_user']    = auth()->user()->id;
        $data['input_date']    = $today;
        $data['update_user']   = auth()->user()->id;
        $data['update_date']   = $today;

        DB::beginTransaction();

            Category::insert($data);

        DB::commit();

        return response()->json(['status' => 'success']);
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        return $category;
    }


    public function update(Request $request) {
        $id = $request->id;
        DB::beginTransaction();

            // $category       = Category::find($id);
            // $category->name        = $request->name;
            // $category->update_user = auth()->user()->id;
            // $category->update_date = date("Y-m-d H:i:s");
            // $category->update();
            DB::table('categories')->where('id', $id)->update([
                'name'        => $request->name,
                'update_user' => auth()->user()->id,
                'update_date' => date("Y-m-d H:i:s")
            ]);

        DB::commit();

        return response()->json(['status' => 'success']);
    }

    public function destroy(Request $request) {
        $id    = $request->id;
        $token = $request->_token;

        DB::beginTransaction();

            $category = Category::find($id);
            $category->delete();

        DB::commit();
        return response()->json(['status' => 'success']);
    }

    public function trash()
    {
        // mengampil data yang sudah dihapus
        $categories = Category::onlyTrashed()->orderBy('id', 'desc')->get();
        return view('product/category_trash', [
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
