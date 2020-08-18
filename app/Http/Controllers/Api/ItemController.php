<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Item;
use App\Brand;
use App\Subcategory;
use App\Http\Resources\ItemResource;

class ItemController extends Controller
{
    public function __construct($value='')
    {
        // $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();
        return ItemResource::Collection($items);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd('Store Method');
        // dd($request);

        // Validation
        $request->validate([
            'item_codeno'=>'required|min:4',
            'item_name'=>'required',
            'item_photo'=>'required',
            'unit_price'=>'required',
            'discount_price'=>'required',
            'item_des'=>'required',
            'brand'=>'required',
            'subcategory'=>'required'
        ]);

        // If include file, upload
        $imgName = time().'.'.$request->item_photo->extension();

        $request->item_photo->move(public_path('backend/itemimg/'),$imgName);

        $myfile = 'backend/itemimg/'.$imgName;

        // Data insert
        $item = new Item;
        $item->codeno = $request->item_codeno;
        $item->name = $request->item_name;
        $item->photo = $myfile;
        $item->price = $request->unit_price;
        $item->discount = $request->discount_price;
        $item->description = $request->item_des;
        $item->brand_id = $request->brand;
        $item->subcategory_id = $request->subcategory;

        $item->save();

        //redirect
       return new ItemResource($items);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $items = Item::findOrFail($id);
        return new ItemResource($items);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
