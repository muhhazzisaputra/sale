<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{

    public function index()
    {
        return view('master/customer_list', [
            'title'     => 'Customer',
            'customers' => Customer::orderBy('id', 'desc')->get()
        ]);
    }

    public function create()
    {
        return view('master/customer_create', [
            'title' => 'Tambah Customer'
        ]);
    }

    public function store(Request $request)
    {
        $validate_data = $request->validate([
            'name'     => 'required|min:3|max:30',
            'email'    => 'required|min:8|max:40',
            'phone'    => 'required|min:10|max:16',
            'address'  => 'required|min:4',
            'level'    => 'required'
        ]);

        Customer::create($validate_data);

        alert()->success('Success!', 'Data berhasil disimpan.');
        return redirect('/customer');
    }

    public function show($id)
    {
        //
    }

    public function edit(Customer $customer)
    {
        return view('master/customer_edit', [
            'title'    => 'Edit Customer',
            'customer' => $customer
        ]);
    }

    public function update(Request $request, Customer $customer)
    {
        $rules = [
            'name'     => 'required|min:3|max:30',
            'email'    => 'required|min:8|max:40',
            'phone'    => 'required|min:10|max:16',
            'address'  => 'required|min:4',
            'level'    => 'required'
        ];

        $validate_data = $request->validate($rules);

        Customer::where('id', $customer->id)->update($validate_data);

        alert()->success('Success!', 'Data berhasil diupdate.');
        return redirect('/customer');
    }

    public function destroy($id)
    {
        Customer::destroy($id);

        alert()->success('Success!', 'Data berhasil dihapus.');
        return redirect('/customer');
    }

    public function trash()
    {
        // mengampil data yang sudah dihapus
        $customers = Customer::onlyTrashed()->get();
        return view('master/customer_trash', [
            'title'     => 'Trash Customer',
            'customers' => $customers
        ]);
    }

    public function restore($id = "")
    {
        if($id) {
            Customer::onlyTrashed()->where('id', $id)->restore();
        } else {
            Customer::onlyTrashed()->restore();
        }

        return redirect('/customer')->with('success', 'Data berhasil direstore.');
    }

    public function forceDelete($id = "")
    {   
        if($id) {
            Customer::onlyTrashed()->where('id', $id)->forceDelete();
        } else {
            Customer::onlyTrashed()->forceDelete();
        }

        return redirect('/customer/trash')->with('success', 'Data berhasil dihapus permanen.');
    }

}
