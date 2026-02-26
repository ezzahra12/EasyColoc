<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Colocation extends Model
{

    protected $fillable = [
        'name',
        'owner_id',
        'status'
    ];

   public function users()
{
    return $this->belongsToMany(
        User::class,
        'memberships',
        'colocation_id', 
        'user_id'
    )->withPivot('role', 'joined_at')
     ->withTimestamps();
}









    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
    public function settlements()
    {
        return $this->hasMany(Settlement::class);
    }
}
