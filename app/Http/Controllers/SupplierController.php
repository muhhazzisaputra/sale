<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use RealRashid\SweetAlert\Facades\Alert;

class SupplierController extends Controller
{

    public function index()
    {
        return view('master/supplier_list', [
            'title'     => 'Supplier',
            'suppliers' => Supplier::orderBy("id", "desc")->get()
        ]);
    }

    public function create()
    {
        return view('master/supplier_create', [
            'title' => 'Tambah Supplier'
        ]);
    }

    public function store(Request $request)
    {
        $validate_data = $request->validate([
            'name'     => 'required|min:3|max:30',
            'phone'    => 'required|min:10|max:16',
            'address'  => 'required|min:4'
        ]);

        Supplier::create($validate_data);

        alert()->success('Success!', 'Data berhasil disimpan.');
        return redirect('/supplier');
    }

    public function show($id)
    {
        //
    }

    public function edit(Supplier $supplier)
    {
        return view('master/supplier_edit', [
            'title'    => 'Edit Supplier',
            'supplier' => $supplier
        ]);
    }

    public function update(Request $request, Supplier $supplier)
    {
        $rules = [
            'name'     => 'required|min:3|max:30',
            'phone'    => 'required|min:10|max:16',
            'address'  => 'required|min:4'
        ];

        $validate_data = $request->validate($rules);

        Supplier::where('id', $supplier->id)->update($validate_data);

        alert()->success('Success!', 'Data berhasil diupdate.');
        return redirect('/supplier');
    }

    public function destroy($id)
    {
        Supplier::destroy($id);

        alert()->success('Success!', 'Data berhasil dihapus.');
        return redirect('/supplier');
    }

    public function trash()
    {
        // mengampil data yang sudah dihapus
        $suppliers = Supplier::onlyTrashed()->get();
        return view('master/supplier_trash', [
            'title'     => 'Trash Supplier',
            'suppliers' => $suppliers
        ]);
    }

    public function restore($id = "")
    {
        if($id) {
            Supplier::onlyTrashed()->where('id', $id)->restore();
        } else {
            Supplier::onlyTrashed()->restore();
        }

        return redirect('/supplier')->with('success', 'Data berhasil direstore.');
    }

    public function forceDelete($id = "")
    {   
        if($id) {
            Supplier::onlyTrashed()->where('id', $id)->forceDelete();
        } else {
            Supplier::onlyTrashed()->forceDelete();
        }

        return redirect('/supplier/trash')->with('success', 'Data berhasil dihapus permanen.');
    }

}
