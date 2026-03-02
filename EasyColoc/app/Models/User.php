<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Membership ;
use App\Models\Colocation;
use App\Models\Expense;
use App\Models\Settlement;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
         'name',
        'email',
        'password',
        'reputation',
        'is_banned',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }



    public function colocations()
    {
        return $this->belongsToMany(Colocation::class, 'memberships')
            ->withPivot('role', 'joined_at')
            ->withTimestamps();
    }

    public function memberColocations(){
        return $this->colocations()->wherePivot('role','member');
    }
     public function ownerColocations(){
        return $this->colocations()->wherePivot('role','owner');
    }
public function debts()
    {
        return $this->hasMany(Settlement::class, 'debtor_id');
    }
   public function credits()
    {
        return $this->hasMany(Settlement::class, 'creditor_id');
    }
    public function expensesPaid()
    {
        return $this->hasMany(Expense::class, 'payer_id');
    }
       public function balance($colocation)
    {
        $paid = $this->expensesPaid()
                     ->where('colocation_id', $colocation->id)
                     ->sum('amount');

        $owed = $this->debts($colocation)->sum('amount');

        return $paid - $owed;
    }
    public function setCreditor()
    {
        return $this->hasMany(Settlement::class, 'creditor_id');
    }

    public function setDebtor()
    {
        return $this->hasMany(Settlement::class, 'debtor_id');
    }
}


