<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MusicResource extends JsonResource
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
            'title'=> $this->Title,
            'artist'=> $this->Artist,
            'Label'=> $this->Label,
            'Description'=> $this->description  ,
            'likes'=> [ 'bol'=> false , 'number'=> $this->likesNumber ] ,
            'share'=> [ 'bol'=> false , 'number'=> $this->shareNumber ] ,
            'url'=>'https://'.$this->shareLink ,
            'source'=>$this->track_path ,
            'Released' => date_format(new \DateTime($this->Released) , "D /m/Y , h:i a") ,
            'cover' => $this->image_path,
            ];
    }
}
