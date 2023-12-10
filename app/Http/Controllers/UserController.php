<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{


    public function index()
    {
        return view('user.profile');
    }

    public function update(Request $req)
    {
        $req->validate([
            'id' => 'required',
            'name' => 'required'
        ]);

        $is_updated = DB::table('users')->where('id', $req->id)->update(['name' => $req->name]);

        if ($is_updated) {
            return redirect()->back()->with('status', __('ar.updated'));
        }
        return redirect()->back()->with('status', __('ar.no changes'));
    }

    public function reset_password(Request $req)
    {
        $req->validate([
            'password' => ['required', 'confirmed'],
        ]);

        $is_updated = DB::table('users')->where('id', $req->id)->update(['password' => Hash::make($req->name)]);

        if ($is_updated) {
            return redirect()->back()->with('status', __('passwords.reset'));
        }
        return redirect()->back()->with('status', __('ar.no changes'));
    }
}
