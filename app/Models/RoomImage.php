<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoomImage extends Model
{
    use HasFactory;

    protected $fillable=[
        'room_id',
        'path'
    ];
    
    public function room(){
    return $this->belongsTo(Room::class);
    }
}
