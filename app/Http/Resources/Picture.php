<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Picture extends JsonResource {
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
            'imgLink' => $this->imgLink,
            'orderNumber' => $this->orderNumber
        ];
    }

    public function with($request) {
        return [
            'author_url' => url('https://www.facebook.com/huy.sgh')
        ];
    }
}
