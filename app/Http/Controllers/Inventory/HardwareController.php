<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory\Hardware;
use App\Models\Inventory\Manufacturer;
use App\Models\Inventory\Typhardware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class HardwareController extends Controller
{
    public $hardwares;
    public $typhardwares;
    public $manufacturers;
    public function __construct(Hardware $hardwares,Typhardware $typhardwares,Manufacturer $manufacturers )
    {
        $this->hardwares = $hardwares;
        $this->typhardwares = $typhardwares;
        $this->manufacturers = $manufacturers;
    }

    public function index()
    {
        $hardwares = $this->hardwares::with('typhardware:id,name','manufacturer:id,name')->orderBy('id', 'DESC')->get();
        $typhardwares  = $this->typhardwares::get(['id','name']);
        $manufacturers = $this->manufacturers::get(['id','name']);
        return view('Inventory.hardwares',compact('hardwares','typhardwares','manufacturers'));
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

    public function store(Request $request)
    {
        try {
                $validate = Validator::make($request->all(), [
                    'HdwBarcode' => 'required|unique:hardwares',
                    'TphdwId' => 'required',
                    'ManfId' => 'required',
                ], [
                    'HdwBarcode.required' => 'يجب إدخال رقم الباركود للجهاز',
                    'HdwBarcode.unique' => 'هذه الجهاز مدخل من قبل',
                    'TphdwId.required' => 'نوع الجهاز مطلوب',
                    'ManfId.required' => 'الشركة المصنعة للجهاز مطلوبة',
                ]);
                if ($validate->fails()) {
                    return back()->withErrors($validate->errors())->withInput();
                }
                $hardwares = new Hardware();
                $hardwares->HdwBarcode = $request->HdwBarcode;
                $hardwares->TphdwId = $request->TphdwId;
                $hardwares->ManfId = $request->ManfId;
                $hardwares->HdwModel = $request->HdwModel;
                $hardwares->OSystems = $request->OSystems;
                $hardwares->userEntry = auth()->user()->id;
                $hardwares->status = 1;
                $hardwares->save();
                Alert::success('تم إضافة جهاز جديد بنجاح')->autoClose(15000);
                return back();
        } catch (\Throwable $th) {
            Alert::error('هنالك خطأ', $th->getMessage())->autoClose(15000);
            return redirect()->back()->withErrors(['errors' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventory\Hardware  $hardware
     * @return \Illuminate\Http\Response
     */
    public function show(Hardware $hardware)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventory\Hardware  $hardware
     * @return \Illuminate\Http\Response
     */
    public function edit(Hardware $hardware)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventory\Hardware  $hardware
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hardware $hardware)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventory\Hardware  $hardware
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hardware $hardware)
    {
        //
    }
}
