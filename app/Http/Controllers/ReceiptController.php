<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use App\Models\Receipt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allReceipt()
    {
        if (Auth::user()->hasRole('superadmin')) {
            $receipts = Receipt::all();
            return view('/all-receipt', compact('receipts'));
        }else
        {
            $search = Auth::user()->state;
            $receipts = Receipt::where('state','LIKE', '%'.$search.'%')->get();
            return view('/all-receipt', compact('receipts','search'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addReceipt()
    {
        if (Auth::user()->hasRole('superadmin')) {
            $states = DB::table('state_tbl')->get();
            $merchants = Merchant::all();
            return view('/add-receipt', compact('states', 'merchants'));
        }else
        {
            $states = DB::table('state_tbl')->get();
            $search = Auth::user()->state;
            $merchants = Merchant::where('state','LIKE', '%'.$search.'%')->get();
            return view('/add-receipt', compact('merchants','search','states'));
        }
    }

    /**
     for new receipt
     */
    public function newReceipt($id)
    {
        $merchants = Merchant::find($id);
        return view('/new-receipt', compact('merchants'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveReceipt(Request $request)
    {
        $this->validate($request, [
            'year_week_no' => 'required|unique:receipts,merchant_id,null,year_week_no'
//                Rule::unique('receipts')->where(
//                    function ($query) use ($request) {
//                        return $query->where('merchant_id',$request->merchant_id)
//                            ->where('year_week_no',$request->year_week_no);
//                    }
//                )
        ]);
        Receipt::create([
            'year_week_no'             => $request->year_week_no,
            'state'                    => $request->state,
            'business_name'            => $request->business_name,
            'merchant_id'              => $request->agent_id,
            'cash'                     => $request->cash,
            'teller'                   => $request->teller,
            'total_deposit'            => $request->total_deposit,
            'odd1'                     => $request->odd1,
            'odd2'                     => $request->odd2,
            'odd3'                     => $request->odd3,
            'odd4'                     => $request->odd4,
            'odd5'                     => $request->odd5,
            'odd6'                     => $request->odd6,
            'g_odd1'                   => $request->g_odd1,
            'g_odd1_1'                 => $request->g_odd1_1,
            'g_odd1_2'                 => $request->g_odd1_2,
            'g_odd1_3'                 => $request->g_odd1_3,
            'g_odd2'                   => $request->g_odd2,
            'g_odd2_1'                 => $request->g_odd2_1,
            'g_odd2_2'                 => $request->g_odd2_2,
            'g_odd2_3'                 => $request->g_odd2_3,
            'g_odd3'                   => $request->g_odd3,
            'g_odd3_1'                 => $request->g_odd3_1,
            'g_odd3_2'                 => $request->g_odd3_2,
            'g_odd3_3'                 => $request->g_odd3_3,
            'g_odd4'                   => $request->g_odd4,
            'g_odd4_1'                 => $request->g_odd4_1,
            'g_odd4_2'                 => $request->g_odd_4_2,
            'g_odd4_3'                 => $request->g_odd4_3,
            'g_odd5'                   => $request->g_odd5,
            'g_odd5_1'                 => $request->g_odd5_1,
            'g_odd5_2'                 => $request->g_odd5_2,
            'g_odd5_3'                 => $request->g_odd5_3,
            'g_odd6'                   => $request->g_odd6,
            'g_odd6_1'                 => $request->g_odd6_1,
            'g_odd6_2'                 => $request->g_odd6_2,
            'g_odd6_3'                 => $request->g_odd6_3,
            'total'                    => $request->total,
            'total_1'                  => $request->total_1,
            'total_2'                  => $request->total_2,
            'total_3'                  => $request->total_3,
            'loan'                     => $request->loan,
            'balance_merchant'         => $request->balance_merchant,
            'balance_company'          => $request->balance_company,
            'created_by'               => Auth::user()->name,
        ]);
        return redirect('/all-receipt');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function search(Receipt $receipt)
    {
        $states = DB::table('state_tbl')->get();
        $search = $_GET['query'];
        $merchants = Merchant::where('state','LIKE', '%'.$search.'%')->get();
        return view('/search', compact('merchants','states'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function editReceipt($id)
    {
        $receipts = Receipt::find($id);
        return view('/edit-receipt', ['receipts' => $receipts]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function updateReceipt(Request $request, $id)
    {
        $reciepts = Receipt::find($id);
        $reciepts ->  year_week_no         = $request->input('year_week_no');
        $reciepts ->  state                = $request->input('state');
        $reciepts ->  business_name        = $request->input('business_name');
        $reciepts ->  merchant_id          = $request->input('agent_id');
        $reciepts ->  cash                 = $request->input('cash');
        $reciepts ->  teller               = $request->input('teller');
        $reciepts ->  total_deposit        = $request->input('total_deposit');
        $reciepts ->  g_odd1               = $request->input('g_odd1');
        $reciepts ->  g_odd1_1             = $request->input('g_odd1_1');
        $reciepts ->  g_odd1_2             = $request->input('g_odd1_2');
        $reciepts ->  g_odd1_3             = $request->input('g_odd1_3');
        $reciepts ->  g_odd2               = $request->input('g_odd2');
        $reciepts ->  g_odd2_1             = $request->input('g_odd2_1');
        $reciepts ->  g_odd2_2             = $request->input('g_odd2_2');
        $reciepts ->  g_odd2_3             = $request->input('g_odd2_3');
        $reciepts ->  g_odd3               = $request->input('g_odd3');
        $reciepts ->  g_odd3_1             = $request->input('g_odd3_1');
        $reciepts ->  g_odd3_2             = $request->input('g_odd3_2');
        $reciepts ->  g_odd3_3             = $request->input('g_odd3_3');
        $reciepts ->  g_odd4               = $request->input('g_odd4');
        $reciepts ->  g_odd4_1             = $request->input('g_odd4_1');
        $reciepts ->  g_odd4_2             = $request->input('g_odd4_2');
        $reciepts ->  g_odd4_3             = $request->input('g_odd4_3');
        $reciepts ->  g_odd5               = $request->input('g_odd5');
        $reciepts ->  g_odd5_1             = $request->input('g_odd5_1');
        $reciepts ->  g_odd5_2             = $request->input('g_odd5_2');
        $reciepts ->  g_odd5_3             = $request->input('g_odd5_3');
        $reciepts ->  g_odd6               = $request->input('g_odd6');
        $reciepts ->  g_odd6_1             = $request->input('g_odd6_1');
        $reciepts ->  g_odd6_2             = $request->input('g_odd6_2');
        $reciepts ->  g_odd6_3             = $request->input('g_odd6_3');
        $reciepts ->  loan                 = $request->input('loan');
        $reciepts ->  balance_merchant     = $request->input('balance_merchant');
        $reciepts ->  balance_company      = $request->input('balance_company');
        $reciepts -> updated_by            = Auth::user()->name;
        $reciepts->save();
        return redirect('/all-receipt');
    }
    public function printReceipt()
    {
        $states = DB::table('state_tbl')->get();
        return view('/print-receipt', compact('states'));
    }

    public function printPreview(Request $request)
    {
        $merchants = Merchant::all();
        $receipts = DB::table('receipts')->where([
            ['state', 'LIKE', '%' . $request->state . '%'],
            ['year_week_no', 'LIKE', '%' . $request->year . '%']
        ])->get();
        return view('/print-preview', compact('receipts', 'merchants'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receipt $receipt)
    {
        //
    }
}
