<?php

namespace App\Http\Controllers;

use App\Http\Resources\PetitionCollection;
use App\Http\Resources\PetitionResource;
use App\Http\Resources\ZipResource;
use App\Imports\ZipImport;
use App\Models\Petition;
use App\Models\Zip;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return PetitionCollection
     */
    public function index()
    {

        $match = [
          Zip::CODE_FIELD => "20010"
        ];
        echo "hola";
        /*
        $zip = Zip::select("code")->with('municipalities')
            ->with('settlements')
            ->with("federals")
            ->where($match)->first();*/
        /*$zipG = null;
        Zip::chunkById(1,function($zips){
            foreach ($zips as $zip){
                // Process posts
                $zipG = $zip;
                break;
            }
        });
        if($zipG != null){

            return new ZipResource($zipG);
        }*/
        /*echo "<pre>";
        print_r($zip->toArray());
        echo "</pre>";*/

        /*$zip = Zip::all();
        */

        //return new ZipResource($zip);
        /*

                //return ZipResource::collection($petitions)[0]->Municipalities;

                /*return new PetitionCollection($petitions);*/

        //Excel::import(new ZipImport,"testbook.xlsx" );
        /*if(Petition::where('title' , '=' , 'asdasd')->first() == null){
            echo "nothing to see ";
        }else{

            $zip = Petition::where('title' , '=' , 'asdasd')->first()->toArray();
            print_r( $zip);
        }*/
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
     * @param  \App\Models\Petition  $petition
     * @return PetitionResource
     */
    public function show(Petition $petition)
    {
        //
        return new PetitionResource($petition);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Petition  $petition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Petition $petition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Petition  $petition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Petition $petition)
    {
        //
    }
}
