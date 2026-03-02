<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
   use App\Models\Category;


class CategoryController extends Controller
{

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255|unique:categories,name',
    ]);

    Category::create([
        'name' => $request->name,
        'colocation_id' => $request->colocation_id,
    ]);

    return back()->with('success', 'Category added successfully!');
}
}
