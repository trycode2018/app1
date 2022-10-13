<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'contact',
        'adress',
        'user_id'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
