<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bank;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('master/bank_list', [
            'title' => 'Akun Bank',
            'banks' => Bank::orderBy("name", "desc")->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('master/bank_create', [
            'title' => 'Tambah Akun Bank'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate_data = $request->validate([
            'name'           => 'required|min:3|max:30',
            'account_number' => 'required|min:10|max:35',
            'account_owner'  => 'required|min:3|max:35',
            'branch'         => 'required|min:4|max:50'
        ]);

        Bank::create($validate_data);

        alert()->success('Success!', 'Data berhasil disimpan.');
        return redirect('/bank');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Bank $bank)
    {
        return view('master/bank_edit', [
            'title' => 'Edit Akun Bank',
            'bank'  => $bank
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bank $bank)
    {
        $rules = [
            'name'           => 'required|min:3|max:30',
            'account_number' => 'required|min:10|max:35',
            'account_owner'  => 'required|min:3|max:35',
            'branch'         => 'required|min:4|max:50'
        ];

        $validate_data = $request->validate($rules);

        Bank::where('id', $bank->id)->update($validate_data);

        alert()->success('Success!', 'Data berhasil diupdate.');
        
        return redirect('/bank')->with('success', 'Data berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Bank::destroy($id);

        return redirect('/bank')->with('success', 'Data berhasil dihapus.');
    }

    public function trash()
    {
        // mengampil data yang sudah dihapus
        $banks = Bank::onlyTrashed()->get();
        return view('master/bank_trash', [
            'title' => 'Trash Bank',
            'banks' => $banks
        ]);
    }

    public function restore($id = "")
    {
        if($id) {
            Bank::onlyTrashed()->where('id', $id)->restore();
        } else {
            Bank::onlyTrashed()->restore();
        }

        return redirect('/bank')->with('success', 'Data berhasil direstore.');
    }

    public function forceDelete($id = "")
    {   
        if($id) {
            Bank::onlyTrashed()->where('id', $id)->forceDelete();
        } else {
            Bank::onlyTrashed()->forceDelete();
        }

        return redirect('/bank/trash')->with('success', 'Data berhasil dihapus permanen.');
    }

}
