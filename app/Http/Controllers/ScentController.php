<?php

namespace App\Http\Controllers;

use App\Models\Scent;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ScentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lstScent = Scent::all();
        return view('scent.scent_index',['lstScent'=>$lstScent]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lstScent=Scent::all();
        return view('scent.scent_add')->with('lstScent',$lstScent);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreScentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lstScent = new Scent;
        $lstScent->fill([
            'name_scent'=>$request->input('name_scent'),
        ]);
        $lstScent->save();
        return Redirect::route('scent.index',['lstScent'=>$lstScent]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Scent  $scent
     * @return \Illuminate\Http\Response
     */
    public function show(Scent $scent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Scent  $scent
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lstScent=Scent::find($id);
        return view('scent.scent_update',['lstScent'=>$lstScent]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateScentRequest  $request
     * @param  \App\Models\Scent  $scent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $lstScent=Scent::find($id);
        $lstScent->fill([
            'name_scent'=>$request->input('name_scent'),
        ]);
        $lstScent->save();
        return Redirect::route('scent.index',['lstScent'=>$lstScent]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Scent  $scent
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lstScent=Scent::find($id);
        $lstScent->delete();
        return Redirect::route('scent.index');
    }

    public function showscent($id)
    {
        $scent=Scent::find($id);
        $lstProduct=Product::where('scent_id','=',$id)->get();
        foreach($lstProduct as $p){
            $p->image=Storage::url($p->image);
        }
        return view('scent',['scent'=>$scent,'lstProduct'=>$lstProduct]);
    }
}
