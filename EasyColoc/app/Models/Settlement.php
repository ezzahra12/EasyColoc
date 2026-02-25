<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settlement extends Model
{
      protected $fillable = [
        'amount',
        'creditor_id',
        'debtor_id',
        'colocation_id',
        'is_paid'
    ];

    public function creditor()
    {
        return $this->belongsTo(User::class, 'creditor_id');
    }

    public function debtor()
    {
        return $this->belongsTo(User::class, 'debtor_id');
    }

    public function colocation()
    {
        return $this->belongsTo(Colocation::class);
    }
}
