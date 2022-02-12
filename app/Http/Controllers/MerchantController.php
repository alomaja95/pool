<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use App\Models\Odd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allMerchant()
    {
        if (Auth::user()->hasRole('superadmin')) {
            $states = DB::table('state_tbl')->get();
            $merchants = Merchant::all();
            return view('all-merchant',
                [
                    'states' => $states,
                    'merchants' => $merchants,
                ]);
        }else
        {
            $states = DB::table('state_tbl')->get();
            $search = Auth::user()->state;
            $merchants = Merchant::where('state','LIKE', '%'.$search.'%')->get();
            return view('/all-merchant', compact('merchants','states'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addMerchant()
    {
        $states = DB::table('state_tbl')->get();
        $odds   = DB::table('odds')->get();
        return view('add-merchant',compact('states','odds'));
    }
    public function adminAddMerchant()
    {
        $states = DB::table('state_tbl')->get();
        $odds   = DB::table('odds')->get();
        return view('admin-add-merchant',compact('states','odds'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveMerchant(Request $request)
    {
        $this->validate($request,[
            'state'          =>'required',
            'first_name'     =>'required',
            'last_name'      =>'required',
            'business_name'  =>'required',
            //'agent_id'       =>'required|max:20'
        ]);
        Merchant::create([
            'state'         => $request->state,
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'business_name' => $request->business_name,
            'agent_id'      => $request->agent_id,
            'odd1'          => $request->odd1,
            'odd2'          => $request->odd2,
            'odd3'          => $request->odd3,
            'odd4'          => $request->odd4,
            'odd5'          => $request->odd5,
            'odd6'          => $request->odd6,
        ]);
        return redirect('/all-merchant');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    public function show(Merchant $merchant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    public function editMerchant( $id)
    {
        $merchants = Merchant::find($id);
        $odds = Odd::all();
        $states = DB::table('state_tbl')->get();
        return view('edit-merchant',
            ['merchants' => $merchants,
                'odds' =>  $odds,
                'states' => $states
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    public function updateMerchant(Request $request, $id)
    {
        $merchants = Merchant::find($id);
        $odds = Odd::all();
        $states = DB::table('state_tbl')->get();
        $merchants -> first_name    = $request->input('first_name');
        $merchants -> last_name     = $request->input('last_name');
        $merchants -> business_name = $request->input('business_name');
        $merchants -> agent_id      = $request->input('agent_id');
        $merchants ->  odd1         = $request->input('odd1');
        $merchants ->  odd2         = $request->input('odd2');
        $merchants ->  odd3         = $request->input('odd3');
        $merchants ->  odd4         = $request->input('odd4');
        $merchants ->  odd5         = $request->input('odd5');
        $merchants ->  odd6         = $request->input('odd6');
        $merchants->   state        = $request->input('state');
        $merchants -> save();
        return redirect('/all-merchant');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Merchant $merchant)
    {
        //
    }
}
