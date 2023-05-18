<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use Illuminate\Support\Facades\DB;


class GroupController extends Controller
{
    
   public function index() {
        return view('user/group_list', [
            'title' => 'Group User',
        ]);
    }

    public function read() {
        $data = DB::table('groups AS A')
                    ->leftJoin('users AS B', 'B.user_code', '=', 'A.input_user')
                    ->leftJoin('users AS C', 'C.user_code', '=', 'A.input_user')
                    ->select('A.group_id', 'A.group_name', 'A.input_date', 'A.update_date', 'B.name', 'C.name')
                    ->get();

        return view('user/group_read')->with([
            'groups' => $data
        ]);
    }

    public function store(Request $request) {
        $userId = auth()->user()->user_code;
        $today  = date('Y-m-d H:i:s');

        $data['group_name']  = $request->group_name;
        $data['input_user']  = $userId;
        $data['input_date']  = $today;
        $data['update_user'] = $userId;
        $data['update_date'] = $today;

        DB::beginTransaction();

            Group::insert($data);

        DB::commit();

        return response()->json(['status' => 'success']);
    }

    public function show($id) {
        $group = DB::table('groups AS A')
                     ->select('A.group_id', 'A.group_name')
                     ->where('A.group_id', '=', $id)
                     ->get();

        return response()->json($group[0]);
    }

    public function update(Request $request) {
        $id     = $request->id;
        $name   = $request->group_name;
        $userId = auth()->user()->user_code;
        $today  = date('Y-m-d H:i:s');

        DB::beginTransaction();

            DB::table('groups')
                ->where('group_id', $id)
                ->update([
                    'group_name'  => $name,
                    'update_user' => $userId,
                    'update_date' => $today
                ]);

        DB::commit();

        return response()->json(['status' => 'success']);
    }

    public function destroy(Request $request) {
        $id    = $request->id;
        $token = $request->_token;
        $today = date('Y-m-d H:i:s');

        DB::beginTransaction();

            DB::table('groups')->where('group_id', $id)->update(['daleted_at'  => $today]);

        DB::rollback();
        return response()->json(['status' => 'success']);
    }

    public function trash() {
        // mengampil data yang sudah dihapus
        $group = Group::onlyTrashed()->orderBy('group_id', 'desc')->get();
        return view('user/group_trash', [
            'title'  => 'Trash Group User',
            'groups' => $group
        ]);
    }

}
