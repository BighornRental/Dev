<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contracts extends Model
{
    use HasFactory;

    public function customers() {

        // get the contracts that belongs to user
        
        return $this->belongsTo(Contract::class);  // example SELECT * from Customers where customer_id =
    }

}
