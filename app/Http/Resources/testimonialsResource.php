<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class testimonialsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'name'=> $this->name,
            'job'=> $this->job,
            'description'=> $this->description  ,
            'likes'=> [ 'bol'=> false , 'number'=> $this->likes ] ,
            'src' => $this->image_path
        ];
    }
}
