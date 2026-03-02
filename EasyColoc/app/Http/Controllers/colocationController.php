<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreColocationRequest;
use App\Models\Colocation;
use App\Models\Membership;
use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;

class colocationController extends Controller
{
    public function create()
    {
        return view('colocations.create');
    }

  public function store(StoreColocationRequest $request){
    $col= Colocation::create([
        'name' => $request->name,
        'owner_id' => auth()->id(),
     ]);
     Membership::create([
        'user_id' => Auth()->id(),
        'colocation_id' => $col->id,
        'role' => "owner",
        'joined_at'=> now(),
     ]);
     return redirect()->route('dashboard');
  }
  public function Membercolocations(){
     auth()->user()->memberColocations()->get();
  }
   public function Ownerolocations(){
     auth()->user()->OwnerColocations()->get();
  }
  public function dashboard(){
    $user = auth()->user();

    $memberCol = $user->memberColocations()->get();
    $ownerCol = $user->OwnerColocations()->get();
    $allCol = $memberCol->merge($ownerCol);


    $hasActiveColocation = $allCol->contains(function($col){
        return $col->status === 'active';
    });

    return view('dashboard', [
        'memberCol' => $memberCol,
        'ownerCol' => $ownerCol,
        'allColocs' => $allCol,
        'hasActiveColocation' => $hasActiveColocation
    ]);
}
  public function leave($colocationId)
{
    $colocation = \App\Models\Colocation::findOrFail($colocationId);

    $user = auth()->user();

    
    $colocation->users()->detach($user->id);

    return redirect('/dashboard')->with('success', 'You have left the colocation.');
}
}
