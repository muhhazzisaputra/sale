<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{

    public function index()
    {
        return view('master/supplier/supplier_list', [
            'title' => 'Supplier'
        ]);
    }

    public function read() {
        $data = Supplier::orderBy("name", "asc")->get();

        return view('master/supplier/supplier_read')->with([
            'suppliers' => $data
        ]);
    }

    public function add() {
        return view('master/supplier/supplier_add');
    }


    public function store(Request $request)
    {
        $today = date("Y-m-d H:i:s");

        $data['supplier_code'] = $request->supplier_code;
        $data['name']          = $request->name;
        $data['phone']         = $request->phone;
        $data['address']       = $request->address;
        $data['input_user']    = auth()->user()->id;
        $data['input_date']    = $today;
        $data['update_user']   = auth()->user()->id;
        $data['updated_at']    = $today;

        DB::beginTransaction();

            Supplier::insert($data);

        DB::commit();

        return response()->json(['status' => 'success']);
    }

    public function show(Request $request) {
        $id       = $request->id;
        $supplier = Supplier::where('supplier_id', $id)->first();

        return view('master/supplier/supplier_edit')->with([
            'supplier' => $supplier
        ]);
    }

    public function update(Request $request) {
        $id    = $request->supplier_code;
        $today = date("Y-m-d H:i:s");

        $data = [
            "name"        => $request->name,
            "phone"       => $request->phone,
            "address"     => $request->address,
            "update_user" => auth()->user()->id,
            "updated_at"  => $today
        ];

        DB::beginTransaction();
            
            Supplier::where('supplier_code', $id)->update($data);

        DB::commit();

        return response()->json(['status' => 'success']);
    }

    public function destroy(Request $request) {
        $id    = $request->id;
        $token = $request->_token;

        DB::beginTransaction();

            $supplier = Supplier::where('supplier_id', $id);
            $supplier->delete();

        DB::commit();
        return response()->json(['status' => 'success']);
    }

    public function trash()
    {
        // mengampil data yang sudah dihapus
        $suppliers = Supplier::onlyTrashed()->get();
        return view('master/supplier/supplier_trash', [
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
