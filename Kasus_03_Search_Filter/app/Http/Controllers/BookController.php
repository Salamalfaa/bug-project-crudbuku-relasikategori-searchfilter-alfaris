<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->validate([
            'keyword' => ['nullable', 'string', 'max:255'],
            'category' => ['nullable', 'integer', 'exists:categories,id'],
        ]);

        $keyword = trim($filters['keyword'] ?? '');
        $categoryId = $filters['category'] ?? null;

        $books = Book::with('category')
            ->when($keyword !== '', function ($query) use ($keyword) {
                $query->where(function ($searchQuery) use ($keyword) {
                    $searchQuery->where('title', 'like', '%' . $keyword . '%')
                        ->orWhere('author', 'like', '%' . $keyword . '%');
                });
            })
            ->when($categoryId, function ($query) use ($categoryId) {
                $query->where('category_id', $categoryId);
            })
            ->latest()
            ->get();

        $categories = Category::orderBy('name')->get();

        return view('books.index', compact('books', 'categories', 'keyword', 'categoryId'));
    }
}
