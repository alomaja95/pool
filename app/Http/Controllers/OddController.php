<?php

namespace App\Http\Controllers;

use App\Models\Odd;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Route;

class OddController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allodds()
    {
        $odds  = Odd::all();
        return view('all-odds', ['odds' => $odds]) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addodds()
    {
        return view('add-odds');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveOdds(Request $request)
    {
        $this->validate($request, [
            'odds' => 'required'
        ]);
        if (Odd::where('odds', $request->odds)->first())
        {
            return redirect('/add-odds')->with(['odds_error' => 'odd_name is already in use']);
        }
        Odd::create([
            'odds'          => $request->odds
        ]);
        return redirect('/all-odds');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Odd  $odd
     * @return \Illuminate\Http\Response
     */
    public function show(Odd $odd)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Odd  $odd
     * @return \Illuminate\Http\Response
     */
    public function editOdds($id)
    {
        $odds = Odd::find($id);
        return view('edit-odds', ['odds' => $odds]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Odd  $odd
     * @return \Illuminate\Http\Response
     */
    public function updateOdds(Request $request, $id)
    {
        $odds = Odd::find($id);
        $odds -> odds = $request->input('odds');
        $odds -> save();
        return redirect('/all-odds');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Odd  $odd
     * @return \Illuminate\Http\Response
     */
    public function destroyodds(Odd $id)
    {
        $odd = Odd::find($id);
        $odd->delete();
        return redirect('/all-odds');
    }
}
