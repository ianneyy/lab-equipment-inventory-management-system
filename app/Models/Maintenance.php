<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;
class Maintenance extends Model implements AuditableContract
{

    use Auditable;

    protected $table = 'maintenance';
    protected $primaryKey = 'id';
    public $incrementing = false; // for UUID
    protected $keyType = 'string';


    protected $fillable = [
        'equipment',
        'issue',
        'date_reported',
        'tech_assigned',
        'status',
    ];
}
