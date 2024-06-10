<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $query = Book::query();

            if ($request->has('search') && !empty($request->input('search'))) {
                $search = $request->input('search');
                $query->where('title', 'LIKE', "%{$search}%")
                      ->orWhere('author', 'LIKE', "%{$search}%")
                      ->orWhere('isbn', 'LIKE', "%{$search}%");
            }

            if ($request->has('sort_by') && in_array($request->input('sort_by'), ['title', 'author', 'isbn', 'is_read'])) {
                $sortBy = $request->input('sort_by');
                $sortOrder = $request->input('sort_order', 'asc');
                $query->orderBy($sortBy, $sortOrder);
            }

            return response()->json($query->get());
        } catch (\Exception $e) {
            Log::error('Error fetching books: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while fetching books'], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'required|numeric|digits_between:10,13|unique:books',
            'is_read' => 'required|boolean',
        ]);

        try {
            $book = Book::create($validatedData);
            return response()->json($book, 201);
        } catch (\Exception $e) {
            Log::error('Error storing book: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while storing the book'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
