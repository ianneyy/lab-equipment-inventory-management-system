<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public function equipment()
    {
        return $this->hasMany(Equipment::class);
    }


}
