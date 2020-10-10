<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
class sponsor extends Model
{
     use NodeTrait;
     
     protected $guarded = [];
     
      public function semua_transaction_sponsor()
    {
        return $this->hasMany('App\Models\transaction_sponsor');
    }
     
}


