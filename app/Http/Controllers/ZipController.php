<?php

namespace App\Http\Controllers;

use App\Http\Resources\ZipResource;
use App\Models\Zip;
use Illuminate\Http\Request;

class ZipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        echo "index";
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
     * @param  \App\Models\Zip  $zip
     * @return \Illuminate\Http\Response
     */
    public function show($zipcode)
    {
        //
        $match = [
            Zip::CODE_FIELD => $zipcode
        ];
        $zip = Zip::select()->with('municipalities')
            ->with("federals")
            ->where($match)->first();
        return new ZipResource($zip);
        /*
        echo "<pre>";
        print_r(Zip::where( "id",$zip)->first());
        echo "</pre>";
        return new ZipResource($zip);*/
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Zip  $zip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Zip $zip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Zip  $zip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Zip $zip)
    {
        //
    }
}
