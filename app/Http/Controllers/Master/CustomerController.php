<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{

    public function index()
    {
        return view('master/customer/customer_list', [
            'title' => 'Customer'
        ]);
    }

    public function read() {
        $data = Customer::orderBy("name", "asc")->get();

        return view('master/customer/customer_read')->with([
            'customers' => $data
        ]);
    }

    public function add() {
        return view('master/customer/customer_add');
    }


    public function store(Request $request)
    {
        $today = date("Y-m-d H:i:s");

        $data['customer_code'] = strtoupper($request->customer_code);
        $data['name']          = $request->name;
        $data['email']         = $request->email;
        $data['phone']         = $request->phone;
        $data['address']       = $request->address;
        $data['level']         = $request->level;
        $data['input_user']    = auth()->user()->id;
        $data['input_date']    = $today;
        $data['update_user']   = auth()->user()->id;
        $data['updated_at']    = $today;

        DB::beginTransaction();

            Customer::insert($data);

        DB::commit();

        return response()->json(['status' => 'success']);
    }

    public function show(Request $request) {
        $id       = $request->id;
        $customer = Customer::where('customer_id', $id)->first();

        return view('master/customer/customer_edit')->with([
            'customer' => $customer
        ]);
    }

    public function update(Request $request) {
        $id    = $request->customer_code;
        $today = date("Y-m-d H:i:s");

        $data = [
            "name"        => $request->name,
            "email"       => $request->email,
            "phone"       => $request->phone,
            "address"     => $request->address,
            "level"       => $request->level,
            "update_user" => auth()->user()->id,
            "updated_at"  => $today
        ];

        DB::beginTransaction();
            
            Customer::where('customer_code', $id)->update($data);

        DB::commit();

        return response()->json(['status' => 'success']);
    }

    public function destroy(Request $request) {
        $id    = $request->id;
        $token = $request->_token;

        DB::beginTransaction();

            $customer = Customer::where('customer_id', $id);
            $customer->delete();

        DB::commit();
        return response()->json(['status' => 'success']);
    }

    public function trash()
    {
        // mengampil data yang sudah dihapus
        $customers = customer::onlyTrashed()->get();
        return view('master/customer/customer_trash', [
            'title'     => 'Trash customer',
            'customers' => $customers
        ]);
    }

    public function restore($id = "")
    {
        if($id) {
            customer::onlyTrashed()->where('id', $id)->restore();
        } else {
            customer::onlyTrashed()->restore();
        }

        return redirect('/customer')->with('success', 'Data berhasil direstore.');
    }

    public function forceDelete($id = "")
    {   
        if($id) {
            customer::onlyTrashed()->where('id', $id)->forceDelete();
        } else {
            customer::onlyTrashed()->forceDelete();
        }

        return redirect('/customer/trash')->with('success', 'Data berhasil dihapus permanen.');
    }

}