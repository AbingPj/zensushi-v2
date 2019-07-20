<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class ItemsController extends Controller
{
    public function items(){
        $items = Item::all();
        return response()->json($items);
        // dd($items);
    }

    public function index()
    {
        $request = request();
        //$query = app(Post::class)->newQuery()->with('group');
        $query = app(Item::class)->newQuery();
            if (request('sort') != "" ){
                // handle multisort
                $sorts = explode(',', request()->sort);
                foreach ($sorts as $sort) {
                    list($sortCol, $sortDir) = explode('|', $sort);
                    $query = $query->orderBy($sortCol, $sortDir);
                }
            } else {
                $query = $query->orderBy('id', 'asc');
            }


             if ($request->exists('filter')) {
                 $query->where(function($q) use($request) {
                     $value = "%{$request->filter}%";
                     $q->where('id', 'like', $value)
                        //  ->orWhere('title', 'like', $value)
                         ->orWhere('description', 'like', $value);
                 });
             }


              $perPage = request()->has('per_page') ? (int) request()->per_page : null;
              $pagination = $query->paginate($perPage);
              $pagination->appends([
                  'sort' => request()->sort,
                  'filter' => request()->filter,
                  'per_page' => request()->per_page
              ]);
            return response()->json(
                   $pagination
                )
                ->header('Access-Control-Allow-Origin', '*')
                ->header('Access-Control-Allow-Methods', 'GET');
    }




}
