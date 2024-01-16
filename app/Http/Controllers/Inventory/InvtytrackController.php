<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory\Inventory;
use App\Models\Inventory\Invtytrack;
use Illuminate\Http\Request;

class InvtytrackController extends Controller
{
    public $inventories,$invtytracks;
    public function __construct(Inventory $inventories,Invtytrack $invtytracks)
    {
        $this->inventories = $inventories;
        $this->invtytracks = $invtytracks;
    }
    public function index()
    {
        $typhardwares = active('Inventory\Typhardware',null,['id', 'name']);
        $manufacturers = active('Inventory\Manufacturer',null,['id', 'name']);
        $invtytypes = active('Inventory\Invtytype',null,['TypeId', 'TypeNameAr']);
        $stores = active('Inventory\Store',null,['StockId', 'StockNameAr']);
        $invtytracks = $this->invtytracks::with('hardware.typhardware','hardware.manufacturer','invtype:TypeId,TypeNameAr','stockin:StockId,StockNameAr','stockout:StockId,StockNameAr')->get();
        return view('Inventory.invtytracks',compact('invtytracks','typhardwares','manufacturers','invtytypes','stores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventory\Invtytrack  $invtytrack
     * @return \Illuminate\Http\Response
     */
    public function show(Invtytrack $invtytrack)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventory\Invtytrack  $invtytrack
     * @return \Illuminate\Http\Response
     */
    public function edit(Invtytrack $invtytrack)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventory\Invtytrack  $invtytrack
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invtytrack $invtytrack)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventory\Invtytrack  $invtytrack
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invtytrack $invtytrack)
    {
        //
    }
}
