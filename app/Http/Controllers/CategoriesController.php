<?php

namespace App\Http\Controllers;

use App\Models\categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categories::paginate(10);
       return view('category.index', [
          'categories' => $categories
       ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'status' => 'nullable',
        ]);
    
        $category = Categories::create([
           'name' => $request->name,
           'description' => $request->description,
           'status' => $request->input('status', 'Inactive'),
        ]);
    
        return redirect()->route('category.index')->with('success', 'Category created successfully');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Categories::findOrFail($id);
        return view('category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function edit(categories $category)
{
    return view('category.edit', compact('category'));
}


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'status' => 'nullable',
        ]);
    
        $category = Categories::findOrFail($id);
    
        $category->update([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->input('status', 'Inactive'),
        ]);
    
        return redirect()->route('category.index')->with('success', 'Category updated successfully');
    }
    
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy(categories $category)
{
    // Perform deletion
    $category->delete();

    // Redirect with success message
    return redirect()->route('category.index')->with('success', 'Category deleted successfully');
}

}
