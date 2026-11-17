<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable=['phone','address','bio','date_of_birth','user_id','image'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
