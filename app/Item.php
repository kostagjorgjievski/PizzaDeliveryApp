<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Category;

use App\Order;

use Illuminate\Support\Facades\Storage;

class Item extends Model
{
    public $fillable = [
        'name', 'description', 'available', 'image', 'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function deleteImage()
    {
        Storage::delete($this->image);
    }

    public function order()
    {
        return $this->belongsToMany(Order::class);
    }

}
