<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    //以下記載
    protected $fillable = ['name', 'price', 'description', 'image'];
    
    //季節処理
    public function seasons(){
        return $this->belongsToMany(Season::class);
    }
}
