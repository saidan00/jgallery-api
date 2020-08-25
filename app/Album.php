<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model {
    public function getCoverImgLinkAttribute() {
        return $this->attributes['cover_img_link'];
    }

    public function setCoverImgLinkAttribute($value) {
        $this->attributes['cover_img_link'] = $value;
    }

    public function pictures() {
        return $this->hasMany('App\Picture', 'album_id');
    }
}
