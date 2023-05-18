<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Color;

class ColorController extends Controller {
    
    public function index() {
        return view('product/color_list', [
            'title' => 'Warna Produk',
        ]);
    }

    public function read() {
        $data = Color::orderBy("id", "desc")->get();
        return view('product/color_read')->with([
            'colors' => $data
        ]);
    }

    public function create() {
        return view('product/color_create');
    }

    public function store(Request $request) {
        $data['color_name'] = $request->name;
        Color::insert($data);
    }

    public function show($id) {
        $color = Color::findOrFail($id);
        return view('product/color_edit')->with([
            'color' => $color
        ]);
    }

    public function update(Request $request, $id) {
        $data = Color::findOrFail($id);
        $data->color_name = $request->name;
        $data->save();
    }

    public function destroy($id) {
        $data = Color::findOrFail($id);
        $data->delete();
    }

}
