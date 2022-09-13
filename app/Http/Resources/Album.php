<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Picture as PictureResource;

class Album extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'cover_img_link' => $this->cover_img_link,
            'pictures_count' => $this->pictures_count,
            'pictures' => PictureResource::collection($this->pictures)
        ];
    }
}
