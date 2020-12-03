<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Customers extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user() {

        return  $this->belongsTo('App\Models\User'); // where customer belongs to user with id
    }

    public function contracts() {

        // get the contracts for this user
        return $this->hasMany(Contracts::class); // example SELECT * contracts where customer_id = this customer
    }
    
}