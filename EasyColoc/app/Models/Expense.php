<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use APP\Models\User;
class Expense extends Model
{
    use HasFactory;
   protected $fillable = [
         'title',
    'amount',
    'date',
    'category_id',
    'colocation_id',
    'payer_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function colocation()
    {
        return $this->belongsTo(Colocation::class);
    }

    public function payer()
    {
        return $this->belongsTo(User::class, 'payer_id');
    }

      public function users()
    {
        return $this->belongsToMany(User::class, 'settlements')
                    ->withPivot('amount', 'is_paid')
                    ->withTimestamps();
    }


}
