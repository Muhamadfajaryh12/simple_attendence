<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Absensi extends Model
{
    use HasFactory;
    
    protected $table = "attendence";

    protected $fillable =[
        'foto','status','lokasi','id_user'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user'); 
    }
}