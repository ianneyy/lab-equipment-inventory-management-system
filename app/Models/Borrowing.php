<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class Borrowing extends Model implements AuditableContract
{
    use Auditable;
    protected $table = 'borrowing';
    protected $primaryKey = 'id';
    public $incrementing = false; // for UUID
    protected $keyType = 'string';


    protected $fillable = [
        'id',
        'borrower',
        'equipment',
        'borrowed_date',
        'return_date',
        'status',
    ];
}
