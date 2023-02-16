<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'ip_address',
        'port',
        'instansi_id'
    ];

    public function instansi()
    {
    	return $this->belongsTo(Instansi::class);
    }
}
