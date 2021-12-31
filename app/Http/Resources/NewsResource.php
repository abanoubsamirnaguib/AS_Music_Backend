<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[
        'id' => $this->id,
        'title'=> $this->title,
        'subTitle'=> $this->subTitle,
        'description'=> $this->description  ,
        'likes'=> [ 'bol'=> false , 'number'=> $this->likesNumber ] ,
        'share'=> [ 'bol'=> false , 'number'=> $this->shareNumber, 'link'=> 'https://'.$this->shareLink ] ,
        'Date' => date_format(new \DateTime($this->Date) , "D /m/Y , h:i a") ,
        'src' => $this->image_path,
        'category'=> $this->category,
        ];
    }
}
