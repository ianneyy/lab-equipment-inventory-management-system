<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;
class Task extends Model implements AuditableContract
{
    use Auditable;

    protected $fillable = ['title', 'status'];
}
