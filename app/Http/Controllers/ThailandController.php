<?php

namespace App\Http\Controllers;

use App\Models\Provinces;
use App\Models\Districts;
use App\Models\Subdistricts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ThailandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function provinces()
    {
        //$provinces = Provinces::all();
        $provinces = Provinces::all();
        return response()->json($provinces, 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function districts(Request $request)
    {
        //$provinces = Provinces::all();
        $districts = Districts::where('province_id', $request->input('province_id'))->get();
        return response()->json($districts, 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function subdistricts(Request $request)
    {
        //$provinces = Provinces::all();
        $subdistricts = Subdistricts::where('district_id', $request->input('district_id'))->get();
        return response()->json($subdistricts, 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function subdistricts_post(Request $request)
    {
        //$provinces = Provinces::all();
        $subdistricts = Subdistricts::where('id', $request->input('subdistrict_id'))->get();
        return response()->json($subdistricts, 200, [], JSON_UNESCAPED_UNICODE);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
