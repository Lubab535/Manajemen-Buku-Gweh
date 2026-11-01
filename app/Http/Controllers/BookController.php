<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BookController extends Controller
{
    // Catatan: index/show dapat diakses semua role autentikasi; create/store/edit/update dibatasi route role.
    public function index(): View
    {
        $books = Book::latest()->paginate(10);
        return view('books.index', compact('books'));
    }

    public function create(): View
    {
        return view('books.create');
    }

    public function store(BookRequest $request): RedirectResponse
    {
        Book::create($request->validated());
        return to_route('books.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function show(Book $book): View
    {
        return view('books.show', compact('book'));
    }

    public function edit(Book $book): View
    {
        return view('books.edit', compact('book'));
    }

    public function update(BookRequest $request, Book $book): RedirectResponse
    {
        $book->update($request->validated());
        return to_route('books.index')->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy(Book $book): RedirectResponse
    {
        $book->delete();
        return to_route('books.index')->with('success', 'Buku berhasil dihapus.');
    }
}
