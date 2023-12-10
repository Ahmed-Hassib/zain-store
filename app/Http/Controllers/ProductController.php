<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    public function index()
    {
        // get all products
        $products = DB::table('products')->get();
        return view('products.list', ['products' => $products]);
    }

    public function add()
    {
        // get all categories
        $categories = \App\Models\Category::all();
        return view('products.add', ['categories' => $categories]);
    }

    public function insert(Request $req)
    {
        $req->validate([
            'pr_code' => 'required|integer',
            'pr_name' => 'required',
            'qty' => 'required',
            'price' => 'required',
        ]);

        $is_inserted = DB::table('products')->insert([
            'product_code' => $req->pr_code,
            'product_name' => $req->pr_name,
            'price' => $req->price,
            'parchasing_price' => $req->parchasing_price,
            'quantity' => $req->qty,
            'discount_limit' => $req->discount_limit,
            'description' => $req->desc,
            'color' => $req->color,
            'category_id' => $req->category,
            'alert_stock' => $req['alert-stock'],
        ]);


        if ($is_inserted) {
            return redirect()->back()->with('status', __('products.added'));
        }
        return redirect()->back()->withErrors('status', __('products.adding failed'));
    }

    public function edit(Request $req)
    {
        // $req->validate([
        //     'id'
        // ])
        // check if product exists
        $is_exist = DB::table('products')->where('id', $req->id)->exists();
        // get all categories
        $categories = \App\Models\Category::all();

        if ($is_exist) {
            // get product
            $product = (array)DB::table('products')->where('id', $req->id)->get()[0];
            return view('products.edit', ['product_data' => $product, 'categories' => $categories]);
        }
        // return error message
        return redirect(route('products.list'))->withErrors(__('ar.not found'));
    }

    public function update(Request $req)
    {
        $req->validate([
            'pr_code' => 'required',
            'pr_name' => 'required',
            'qty' => 'required',
            'price' => 'required',
        ]);

        // check if product exists
        $is_exist = DB::table('products')->where('id', $req->id)->exists();

        if ($is_exist) {
            $is_updated = DB::table('products')
                ->where('id', $req->id)
                ->update([
                    'product_code' => $req->pr_code,
                    'product_name' => $req->pr_name,
                    'price' => $req->price,
                    'parchasing_price' => $req->parchasing_price,
                    'quantity' => $req->qty,
                    'discount_limit' => $req->discount_limit,
                    'description' => $req->desc,
                    'color' => $req->color,
                    'category_id' => $req->category,
                    'alert_stock' => $req['alert-stock'],
                ]);

            if ($is_updated) {
                return redirect()->back()->with('status', __('ar.updated'));
            }
            return redirect()->back()->with('status', __('ar.no changes'));
        }
        // return error message
        return redirect()->back()->withErrors(__('ar.not found'));
    }

    public function delete(Request $req)
    {
        $req->validate([
            'id' => 'required'
        ]);

        $is_exist = DB::table('products')->where('id', $req->id)->exists();

        if ($is_exist) {
            $is_deleted = DB::table('products')->where('id', $req->id)->delete();

            if ($is_deleted) {
                return redirect(route('products.list'))->with('status', __('products.deleted'));
            }
        }
        // return error message
        return redirect()->back()->withErrors(__('ar.not found'));
    }
}
