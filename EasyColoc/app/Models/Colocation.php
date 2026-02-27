<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;

class Colocation extends Model
{
   use HasFactory;
    protected $fillable = [
        'name',
        'owner_id',
        'status'
    ];


  public function members()
    {
        return $this->belongsToMany(User::class)
                    ->withPivot('role', 'joined_at')
                    ->withTimestamps();
    }
public function users()
{
    return $this->belongsToMany(User::class, 'memberships')
                ->withPivot('role', 'joined_at')
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
