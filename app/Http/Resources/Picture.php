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
            'id' => $this['id'],
            'title' => $this['title'],
            // 'description' => $this['description'],
            'img_link' => $this['img_link'],
            'order_number' => $this['order_number']
        ];
    }
}
