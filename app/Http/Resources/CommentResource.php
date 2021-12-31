<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
        return[
            'id' => $this->id,
            'name'=> $this->name,
            'message'=> $this->message,
            'Number'=> $this->Number,
            'color'=> $this->color,
            'author'=> false  ,
            ];
    }
}
