<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class StoreController extends Controller
{
    public $stores;
    public function __construct(Store $stores)
    {
        $this->stores = $stores;
    }

    public function index()
    {
        $stores = $this->stores::orderBy('StockId')->get();
        /* $invtytypes = active('Inventory\Invtytype',null,['TypeId','name']); */
        return view('Inventory.stores',compact('stores'));
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
        /* return $request; */
        try {
            $validate = Validator::make($request->all(), [
                'StockId' => 'required|unique:stores',
                'StockNameAr' => 'required',
                'StockTyp' => 'required',
            ], [
                'StockId.required' => 'يجب إدخال رقم المستودع',
                'StockId.unique' => 'هذه المستودع مدخل من قبل',
                'StockNameAr.required' => 'يجب إدخال إسم المستودع',
                'StockTyp.required' => 'يجب إختيار نوع المستودع',
            ]);

            if ($validate->fails()) {
                return back()->withErrors($validate->errors())->withInput();
            }
            $stores = new Store();
            $stores->StockId = $request->StockId;
            $stores->StockNameAr = $request->StockNameAr;
            $stores->StockNameEn = $request->StockNameEn;
            $stores->StockTyp = $request->StockTyp;
            $stores->userEntry = auth()->user()->id;
            $stores->status = 1;
            $stores->save();

            $msg = 'تم إضافة مستودع ' . $request->StockNameAr . ' بنجاح';
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
     * @param  \App\Models\Inventory\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventory\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store)
    {
        //
    }
    public function update(Request $request,$store)
    {
    try {
            $validate = Validator::make($request->all(), [
                'StockNameAr' => 'required',
            ], [
                'StockNameAr.required' => 'يجب إدخال إسم المستودع',
            ]);

            if ($validate->fails()) {
                return back()->withErrors($validate->errors())->withInput();
            }
            $this->stores::where('StockId',$request->StockId)->update([
                'StockNameAr' => $request->StockNameAr,
                'StockNameEn' => $request->StockNameEn,
            ]);

            $msg = 'تم تحديث بيانات ' . $request->StockNameAr . ' بنجاح';
            Alert::success($msg)->autoClose(15000);
            return back();
        } catch (\Throwable $th) {
            Alert::error('هنالك خطأ', $th->getMessage())->autoClose(15000);
            return redirect()->back()->withErrors(['errors' => $th->getMessage()]);
        }
    }

    public function destroy(Request $request, $store)
    {
        try {
            /* return $request->stockid; */
            /* $checks = inventories */
            $this->stores::where('StockId',$request->stockid)->delete();
            $msg = 'تم حذف المستودع بنجاح';
            Alert::success($msg)->autoClose(15000);
            return back();
        } catch (\Throwable $th) {
            Alert::error('هنالك خطأ', $th->getMessage())->autoClose(15000);
            return redirect()->back()->withErrors(['errors' => $th->getMessage()]);
        }
    }
}
