<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'judul' => 'required|max:255',
            'halaman' => 'required|integer|min:1|max:99999',
            'author_id' => 'required|max:5',
            'kategori' => 'required|max:255',
            'penerbit' => 'required|max:255',
            'image' => 'required|file|image|max:5000',
            ]);
            //$book = new Book();

            //$book->judul = $validateData['judul'];
            //$book->halaman = $validateData['halaman'];
            //$book->kategori = $validateData['kategori'];
            //$book->penerbit = $validateData['penerbit'];
            //$book->save();
            //return "Data berhasil ditambahkan!";

          $book = Book::create($validateData);

            $fileExtension = $request->image->getClientOriginalExtension();
            $fileRename = "movieimg-".time().".{$fileExtension}";
            $request->image->storeAs('public', $fileRename);

            $book->image = $fileRename;
            $book->save();

            $request->session()->flash('success', "Successfully adding {$validateData['judul']}!");
            return redirect()->route('books.index');
    }

    public function imageUploadTesting(Request $request){
        if ($request->hasFile('image')) {
            echo "Path: ".$request->image->path().'<br>';
            echo "Extension: ".$request->image->extension().'<br>';
            echo "Org. Extension: ".$request->image->getClientOriginalExtension().'<br>';
            echo "MIME Type: ".$request->image->getMimeType().'<br>';
            echo "Org. Filename: ".$request->image->getClientOriginalName().'<br>';
            echo "Size: ".$request->image->getSize().'<br>';
            }else{
            echo "No uploaded file!";
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $validateData = $request->validate([
            'judul' => 'required|max:255',
            'halaman' => 'required|integer|min:1|max:99999',
            'kategori' => 'required|max:255',
            'penerbit' => 'required|max:255',
            'image' => 'required|file|image|max:5000',
            ]);

            if($request->image){
                // Hapus file yg sudah ada
                \Storage::disk('public')->delete($book->image);
                }
                $book->update($validateData);

                $fileExtension = $request->image->getClientOriginalExtension();
                $fileRename = "movieimg-".time().".{$fileExtension}";
                $request->image->storeAs('public', $fileRename);

                $book->image = $fileRename;
                $book->save();

                $request->session()
                ->flash('success',"Successfully updating {$validateData['judul']}!");
                return redirect()->route('books.index');
                }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        \Storage::disk('public')->delete($book->image);
        $book->delete();
        return redirect()->route('books.index')->with(
        'success',"Successfully deleting {$book['judul']}!"
        );
    }
}
