<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model {
    public function pictures() {
        return $this->hasMany('App\Picture', 'album_id');
    }
}
