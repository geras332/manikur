<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $table = 'requests';
    protected $fillable = [
        'name',
        'phone_number',
        'date',
        'time',
        'service_id'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
