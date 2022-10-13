<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'quant_min',
        'quant_max',
        'price_in',
        'price_out',
        'input_date',
        'description',
        'status',
        'provider_id',
        'category_id',
        'user_id'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function provider(){
        return $this->hasOne(Provider::class);
    }
    public function category(){
        return $this->hasOne(Category::class);
    }
}
