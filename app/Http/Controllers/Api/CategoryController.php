<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();

        return response()->json([
            'success' => true,
            'categories' => $categories
        ]);
        // return response()->json($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = Category::create($request->all());

        return response()->json([
            'category' => $category
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);
        if($category) {
            return response()->json([
                'success' => true,
                'category' => $category
            ]);
        }else{
            return response()->json([
                'error'     => true,
                'message'   => 'Category not found'
            ], 404);
        }
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {        
        $category = Category::find($id);
        // return $request->all();
        if(!$category) {
            return response()->json([
                'error'     => true,
                'message'   => 'Category not found'
            ], 404);
        }else{
            if(count($request->all()) > 0) {
                $category->update($request->all());
                return response()->json([
                    'success'   => true,
                    'message'   => 'Category updated successfully',
                    'category'  => $category
                ]);
            }else{
                return response()->json([
                    'error'     => true,
                    'message'   => 'Request body cannot be empty.',
                ], 400);
            }
        }      
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);

        if(!$category) {
            return response()->json([
                'error'     => true,
                'message'   => 'Category not found'
            ], 404);
        }else{
            $category->delete();
            return response()->json([
                'success'   => true,
                'message'   => 'Category deleted successfully'
            ]);
        }
    }
}
