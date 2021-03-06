<?php

namespace App\Http\Resources;

use App\Models\Municipality;
use App\Models\Zip;
use Illuminate\Http\Resources\Json\JsonResource;

class ZipResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            "zip_code"          => $this->code,
            "locality"          => "",
            "federal_entity"    => new FederalCollection($this->federals),
            "settlements"       => new SettlementsCollection($this->settlements)
            //"municipality"      => new Municipality($this->municipalities)
        ];
    }
}
