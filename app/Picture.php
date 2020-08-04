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

    public function album() {
        return $this->belongsTo('App\Album');
    }
}
