<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory\Manufacturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class ManufacturerController extends Controller
{
    public $manufacturers;
    public function __construct(Manufacturer $manufacturers)
    {
        $this->manufacturers = $manufacturers;
    }

    public function index()
    {
        $manufacturers = $this->manufacturers::orderBy('id', 'DESC')->get();
        return view('Inventory.manufacturers',compact('manufacturers'));
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
        try {
            $validate = Validator::make($request->all(), [
                'name' => 'required|unique:manufacturers',
            ], [
                'name.required' => 'يجب إدخال إسم الشركة',
                'name.unique' => 'هذه الشركة مدخلة من قبل',
            ]);

            if ($validate->fails()) {
                return back()->withErrors($validate->errors())->withInput();
            }

            $manufacturers = new Manufacturer();
            $manufacturers->name = $request->name;
            $manufacturers->userEntry = auth()->user()->id;
            $manufacturers->status = 1;
            $manufacturers->save();

            $msg = 'تم إضافة ' . $request->name . ' بنجاح';
            Alert::success($msg)->autoClose(15000);
            return back();
        } catch (\Throwable $th) {
            Alert::error('هنالك خطأ', $th->getMessage())->autoClose(15000);
            return redirect()->back()->withErrors(['errors' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventory\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function show(Manufacturer $manufacturer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventory\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function edit(Manufacturer $manufacturer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventory\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Manufacturer $manufacturer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventory\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Manufacturer $manufacturer)
    {
        //
    }
}
