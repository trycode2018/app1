<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable=[
        'product_id',
        'date_sale',
        'user_id',
        'client_id',
        'quantity',
        'amount_pay'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function users()
    {
        return $this->hasOne(User::class);
    }
    public function client()
    {
        return $this->hasOne(Client::class);
    }
}
