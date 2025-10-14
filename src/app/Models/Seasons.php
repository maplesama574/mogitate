<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seasons extends Model
{
    use HasFactory;
    //以下記載
    protected $fillable = [
        'name'
    ];
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_season');
    }
}
