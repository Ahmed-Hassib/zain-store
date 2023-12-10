<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

    public function index()
    {
        // get all categories
        $categories = DB::table('categories')->get();
        // call view
        return view('categories.list', ['categories' => $categories]);
    }

    public function add()
    {
        return view('categories.add');
    }


    public function insert(Request $req)
    {
        $req->validate([
            'category_name' => 'required|unique:categories'
        ]);

        $is_inserted = DB::table('categories')->insert([
            'category_name' => $req->category_name
        ]);

        if ($is_inserted) {
            return redirect()->back()->with('status', __('category.added'));
        }

        return redirect()->back()->withErrors(__('category.adding failed'));
    }

    public function edit(Request $req)
    {
        $is_exist = DB::table('categories')->where('id', $req->id)->exists();

        if ($is_exist) {
            $category = (array)DB::table('categories')->where('id', $req->id)->get()[0];
            return view('categories.edit', ['category' => $category]);
        }
        return redirect()->back()->withErrors(__('ar.not found'));
    }

    public function update(Request $req)
    {
        $req->validate([
            'id' => 'required',
            'category_name' => 'required'
        ]);

        $is_exist = DB::table('categories')->where('id', $req->id)->exists();

        if ($is_exist) {
            $is_updated = DB::table('categories')->where('id', $req->id)->update([
                'category_name' => $req->category_name
            ]);

            if ($is_updated) {
                return redirect()->back()->with('status', __('category.updated'));
            }

            return redirect()->back()->with('status', __('ar.no changes'));
        }

        return redirect()->back()->withErrors(__('ar.not found'));
    }


    public function delete(Request $req)
    {
        $req->validate([
            'id' => 'required'
        ]);

        $is_exist = DB::table('categories')->where('id', $req->id)->exists();

        if ($is_exist) {
            $is_deleted = DB::table('categories')->where('id', $req->id)->delete();

            if ($is_deleted) {
                return redirect()->back()->with('status', __('category.deleted'));
            }
            
            return redirect()->back()->with('status', __('ar.query problem'));
        }
        
        return redirect()->back()->withErrors(__('ar.not found'));
    }
    
    public function truncate(Request $req) {
        $req->validate([
            'operation' => 'required'
        ]);
        DB::table('categories')->truncate();
        return redirect()->back()->with('status', __('category.truncated'));
    }
}
