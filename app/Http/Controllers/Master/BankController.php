<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bank;
use Illuminate\Support\Facades\DB;

class BankController extends Controller
{

    public function index()
    {
        return view('master/bank/bank_list', [
            'title' => 'Akun Bank'
        ]);
    }

    public function read() {
        $data = Bank::orderBy("name", "asc")->get();

        return view('master/bank/bank_read')->with([
            'banks' => $data
        ]);
    }

    public function add() {
        return view('master/bank/bank_add');
    }

    public function store(Request $request)
    {
        $today = date("Y-m-d H:i:s");

        $data['bank_code']      = $request->bank_code;
        $data['name']           = $request->name;
        $data['account_number'] = $request->account_number;
        $data['account_owner']  = $request->account_owner;
        $data['branch']         = $request->branch;
        $data['input_user']     = auth()->user()->id;
        $data['input_date']     = $today;
        $data['update_user']    = auth()->user()->id;
        $data['updated_at']     = $today;

        DB::beginTransaction();

            Bank::insert($data);

        DB::commit();

        return response()->json(['status' => 'success']);
    }

    public function show(Request $request)
    {
        $id = $request->id;
        $bank = Bank::where('bank_id', $id)->first();

        return view('master/bank/bank_edit')->with([
            'bank' => $bank
        ]);
    }

    public function update(Request $request) {
        $id    = $request->id;
        $today = date("Y-m-d H:i:s");

        $data = [
            "name"           => $request->name,
            "account_number" => $request->account_number,
            "account_owner"  => $request->account_owner,
            "branch"         => $request->branch,
            "update_user"    => auth()->user()->id,
            "updated_at"     => $today
        ];

        DB::beginTransaction();
            
            Bank::where('bank_id', $id)->update($data);

        DB::commit();

        return response()->json(['status' => 'success']);
    }

    public function destroy(Request $request) {
        $id    = $request->id;
        $token = $request->_token;

        DB::beginTransaction();

            $bank = Bank::where('bank_id', $id);
            $bank->delete();

        DB::commit();
        return response()->json(['status' => 'success']);
    }

    public function trash() {
        // menampilkan data yang sudah dihapus
        $banks = Bank::onlyTrashed()->get();
        return view('master/bank/bank_trash', [
            'title' => 'Trash Bank',
            'banks' => $banks
        ]);
    }

    public function restore($id = "") {
        if($id) {
            Bank::onlyTrashed()->where('bank_id', $id)->restore();
        } else {
            Bank::onlyTrashed()->restore();
        }

        return redirect('/bank')->with('success', 'Data berhasil direstore.');
    }

    public function forceDelete($id = "") {   
        if($id) {
            Bank::onlyTrashed()->where('bank_id', $id)->forceDelete();
        } else {
            Bank::onlyTrashed()->forceDelete();
        }

        return redirect('/bank/trash')->with('success', 'Data berhasil dihapus permanen.');
    }

}
