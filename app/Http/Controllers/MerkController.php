<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Merk;

class MerkController extends Controller
{

    public function index()
    {
        return view('product/merk_list', [
            'title' => 'Merk Produk',
            'merks' => Merk::orderBy('id', 'desc')->get()
        ]);
    }

    public function read() {
        $data = Merk::orderBy("id", "desc")->get();
        return view('product/merk_read')->with([
            'merks' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data['name'] = $request->name;
        Merk::insert($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $merk = Merk::findOrFail($id);
        return $merk;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Merk::findOrFail($id);
        $data->name = $request->name;
        $data->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Merk::findOrFail($id);
        $data->delete();
    }

    public function trash()
    {
        // mengampil data yang sudah dihapus
        $merks = Merk::onlyTrashed()->orderBy('id', 'desc')->get();
        return view('product/merk_trash', [
            'title' => 'Trash Merk',
            'merks' => $merks
        ]);
    }

    public function restore($id = "")
    {
        if($id) {
            Merk::onlyTrashed()->where('id', $id)->restore();
        } else {
            Merk::onlyTrashed()->restore();
        }

        alert()->success('Success!', 'Data berhasil direstore.');
        return redirect('/merk');
    }

    public function forceDelete($id = "")
    {   
        if($id) {
            Merk::onlyTrashed()->where('id', $id)->forceDelete();
        } else {
            Merk::onlyTrashed()->forceDelete();
        }

        alert()->success('Success!', 'Data berhasil dihapus permanen.');
        return redirect('/category/trash');
    }

}
