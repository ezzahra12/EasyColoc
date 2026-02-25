<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Expense;
use App\Models\Colocation;

class Category extends Model
{
      protected $fillable = [
           'name',
        'colocation_id'
          ];

     public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public function colocation()
    {
        return $this->belongsTo(Colocation::class);
    }

}
