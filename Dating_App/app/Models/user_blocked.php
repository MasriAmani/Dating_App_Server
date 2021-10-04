<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_blocked extends Model
{
    use HasFactory;
    public $table ="user_blocked";
    protected $fillable = [
        'from_user_id',
        'to_user_id',
    ];
}
