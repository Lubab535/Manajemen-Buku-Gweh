<?php

namespace App\Http\Controllers\Api;

use App\Models\Book;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;

//import Http request
use Illuminate\Http\Request;

//import facade Validator
use Illuminate\Support\Facades\Validator;

//import facade Storage
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        //get all books
        $books = Book::latest()->paginate(5);

        //return collection of books as a resource
        return new BookResource(true, 'List Data Books', $books);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'image'         => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title'         => 'required',
            'author'        => 'required',
            'publisher'     => 'required',
            'description'   => 'required',
            'publication_year' => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //upload image
        $image = $request->file('image');
        $image->storeAs('books', $image->hashName());

        //create book
        $book = Book::create([
            'image'         => $image->hashName(),
            'title'         => $request->title,
            'author'        => $request->author,
            'publisher'     => $request->publisher,
            'description'   => $request->description,
            'publication_year' => $request->publication_year,
        ]);

        //return response
        return new BookResource(true, 'Data Book Berhasil Ditambahkan!', $book);
    }

    public function show($id)
    {
        //find book by ID
        $book = Book::find($id);

        //return single book as a resource
        return new BookResource(true, 'Data Book Ditemukan!', $book);
    }

    public function update(Request $request, Book $book)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'image'         => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title'         => 'required',
            'author'        => 'required',
            'publisher'     => 'required',
            'description'   => 'required',
            'publication_year' => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //check if image is uploaded
        if ($request->hasFile('image')) {
            //upload new image
            $image = $request->file('image');
            $image->storeAs('books', $image->hashName());

            //delete old image
            Storage::delete('books/' . $book->image);

            //update book with new image
            $book->update([
                'image'         => $image->hashName(),
                'title'         => $request->title,
                'author'        => $request->author,
                'publisher'     => $request->publisher,
                'description'   => $request->description,
                'publication_year' => $request->publication_year,
            ]);
        } else {
            //update book without changing image
            $book->update([
                'title'         => $request->title,
                'author'        => $request->author,
                'publisher'     => $request->publisher,
                'description'   => $request->description,
                'publication_year' => $request->publication_year,
            ]);
        }

        //return response
        return new BookResource(true, 'Data Book Berhasil Diubah!', $book);
    }

    public function destroy(Book $book)
    {
        $book = Book::findOrFail($book->id);
        //delete image
        Storage::delete('books/' . basename($book->image));

        //delete book
        $book->delete();

        //return response
        return new BookResource(true, 'Data Book Berhasil Dihapus!', null);
    }
}
