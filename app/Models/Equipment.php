<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{


    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
