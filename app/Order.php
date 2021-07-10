<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Item;

class Order extends Model
{
    protected $fillable = [
        'cost', 'user_id', 'address', 'progress', 'status'
    ];

    public function items()
    {
        return $this->belongsToMany(Item::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hasItem($itemId){
        return in_array($itemId, $this->items->pluck('id')->toArray());
    }
}
