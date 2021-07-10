<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

class Address extends Model
{
    protected $fillable = [
        'address'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
