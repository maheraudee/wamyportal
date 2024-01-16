<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Inventory\Hardware;
use App\Models\Inventory\Inventory;
use App\Models\Inventory\Invtytrack;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class InventoryController extends Controller
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
        $inventories = $this->inventories::with('hardware.typhardware','hardware.manufacturer','stockin:StockId,StockNameAr')->get();
        return view('Inventory.inventory',compact('inventories','typhardwares','manufacturers','invtytypes','stores'));
    }

    public function getCustody(Request $request,$inventory)
    {
        $day = Carbon::now()->format('Y-m-d');
        switch ($inventory) {
            case 1:
                $empInfo = Employee::where(['status' => 1,'empno' => $request->StockIN])->get();
                $inventories = $this->inventories::with('hardware.typhardware','hardware.manufacturer','stockin:StockId,StockNameAr','invtytype:TypeId,TypeNameAr')
                ->where('StockIN',$request->StockIN)->get();
                break;
            case 2:
                # code...
                break;
        }
        return view('Inventory.Reps.RepCustody',compact('inventories','empInfo','day'));
    }
    public function create()
    {
        $typhardwares = active('Inventory\Typhardware',null,['id', 'name']);
        $manufacturers = active('Inventory\Manufacturer',null,['id', 'name']);
        $invtytypes = active('Inventory\Invtytype',null,['TypeId', 'TypeNameAr']);
        $stores = active('Inventory\Store',null,['StockId', 'StockNameAr']);
        return view('Inventory.Custody.add',compact('typhardwares','manufacturers','invtytypes','stores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* return $request; */
        try {


                $validate = Validator::make($request->all(), [
                    'hdwbarcode' => 'required',
                    /* |unique:inventories */
                    'tphdwid' => 'required|not_in:0',
                    'manfid' => 'required|not_in:0',
                    'invtypeid' => 'required|not_in:0',
                    'stockin' => 'required|not_in:0',
                ], [
                    'hdwbarcode.required' => 'الرجاء مراجعة بياناتك',
                    /* 'hdwbarcode.unique' => 'هذا الجهاز موجود مسبقاً', */
                    'tphdwid.required' => 'الرجاء تحديد نوع الجهاز ',
                    'manfid.required' => 'الرجاء تحديد نوع الشركة ',
                    'invtypeid.required' => 'الرجاء تحديد نوع العهدة',

                    'tphdwid.not_in' => 'الرجاء تحديد نوع الجهاز ',
                    'manfid.not_in' => 'الرجاء تحديد نوع الشركة ',
                    'invtypeid.not_in' => 'الرجاء تحديد نوع العهدة',

                    'stockin.required' => 'من هو صاحب العهدة',
                    'stockin.not_in' => 'من هو صاحب العهدة',
                ]);

                if ($validate->fails()) {
                    return back()->withErrors($validate->errors())->withInput();
                }

                $inventories = $this->inventories::where('HdwBarcode',$request->hdwbarcode)->get();
                $Avlbhardwares = Hardware::where('HdwBarcode',$request->hdwbarcode)->get();
                /* return count($inventories); */
                if(count($inventories) == 0 || count($Avlbhardwares) == 0){
                    $MaxInv = $this->inventories::max('InvId');

                    $hardwares = new Hardware();
                    $hardwares->HdwBarcode = $request->hdwbarcode;
                    $hardwares->TphdwId = $request->tphdwid;
                    $hardwares->ManfId = $request->manfid;
                    $hardwares->HdwModel = $request->hdwmodel;
                    $hardwares->userEntry  = UserId();
                    $hardwares->save();

                    $inventory = new Inventory();
                    $inventory->InvId = $MaxInv + 1;
                    $inventory->HdwId  = $hardwares->id ;
                    $inventory->HdwBarcode  = $request->hdwbarcode ;
                    $inventory->InvTypeId  = $request->invtypeid ;
                    $inventory->StockIN  = $request->stockin ;
                    $inventory->Note  = $request->note ;
                    $inventory->userEntry  = UserId();
                    $inventory->save();

                    $invtytracks = new Invtytrack();
                    $invtytracks->HdwId  = $hardwares->id ;
                    $invtytracks->HdwBarcode  = $request->hdwbarcode ;
                    $invtytracks->InvTypeId  = $request->invtypeid ;
                    $invtytracks->StockOUT  = 1 ;
                    $invtytracks->StockIN  = $request->stockin ;
                    $invtytracks->Note  = $request->note ;
                    $invtytracks->userEntry  = UserId();
                    $invtytracks->save();
                    Alert::success('تم حفظ بيناتك بنجاح')->autoClose(15000);
                    return redirect()->route('inventories.index');

                }else{
                    /* $this->inventories::where('HdwBarcode',$request->hdwbarcode)->update([
                        'InvTypeId' => $request->invtypeid ;
                        'StockIN'  => $request->stockin ;
                        'Note'  => $request->note ;
                        'userEntry'  => UserId();
                    ]); */
                    Alert::error('هذا الجهاز موجود مسبقاً')->autoClose(15000);
                    return redirect()->route('inventories.index')->withInput();
                    /* return redirect()->back()->withErrors(['error' => 'هذا الجهاز موجود مسبقاً']); */
                }


        } catch (\Throwable $th) {
            Alert::error('هنالك خطأ', $th->getMessage())->autoClose(15000);
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventory\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventory\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventory $inventory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventory\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventory $inventory)
    {
        return $request;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventory\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventory $inventory)
    {
        //
    }
}
