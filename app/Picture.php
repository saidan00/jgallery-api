<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model {
    // Table Name
    protected $table = 'pictures';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    public function getImgLinkAttribute() {
        return $this->attributes['img_link'];
    }

    public function setImgLinkAttribute($value) {
        $this->attributes['img_link'] = $value;
    }

    public function getOrderNumberAttribute() {
        return $this->attributes['order_number'];
    }

    public function setOrderNumberAttribute($value) {
        $this->attributes['order_number'] = $value;
    }

    public function album() {
        return $this->belongsTo('App\Album');
    }
}
