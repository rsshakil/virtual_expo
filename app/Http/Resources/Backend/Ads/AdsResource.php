<?php

namespace App\Http\Resources\Backend\Ads;

use Helper;
use Illuminate\Http\Resources\Json\JsonResource;

class AdsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'             => $this->id,
            'ads_type'       => $this->ads_type,
            'adsTypeText'    => $this->ads_type == 1?'Video':'Image',
            'ads_position'   => $this->ads_position,

           'adsPositionText' => $this->ads_position == 1? 'home':($this->ads_position == 2? 'Lobby Center':($this->ads_position == 3?'Lobby Right':($this->ads_position == 4?'Lobby Left':($this->ads_position == 5?'Lobby Bottom Right':'Lobby Left')))),
           
            'video_link'     => $this->video_link,
            'status'         => $this->status,
            'statusText'     => $this->status == 1?'Active':'Inactive',
            'imageOrVideo' => $this->image?'haveImage':'haveVideo',
          
            'created_at'     => $this->created_at,
            'updated_at'     => $this->updated_at,

            'image'          => Helper::publicUrl('/').'/'.'images/Ads/'.$this->image,
            'image_path'     => ' <img style="width:60px; height:60px;" class="img-fluid" src="'.Helper::publicUrl('/').'/'.'images/Ads/'.$this->image.'">',
           

        ];
    }
}
