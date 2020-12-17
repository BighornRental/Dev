<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Model\Customers;

class Contracts extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function customers() {

        // get the contracts that belongs to user
        
        return $this->belongsTo(Contracts::class);  // example SELECT * from Customers where customer_id =
    }

}
