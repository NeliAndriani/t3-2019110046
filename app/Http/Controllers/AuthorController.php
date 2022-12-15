<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::all();
        return view('authors.indexauthors', compact('authors'));
    }


    public function create()
    {
        return view('authors.createauthors');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama' => 'required|max:255',
                  ]);

            //$author = new Author();

            //$author->nama = $validateData['nama'];
            //$author->save();

            Author::create($validateData);

            $request->session()->flash('success', "Successfully adding {$validateData['nama']}!");
            return redirect()->route('authors.index');


    }

    public function show(Author $author)
    {
        return view('authors.showauthors', compact('author'));
    }

    public function edit(Author $author)
    {
        return view('authors.editauthors', compact('author'));
    }

    public function update(Request $request, Author $author)
    {
        $validateData = $request->validate([
            'nama' => 'required|max:255',
            ]);

                $author->update($validateData);

                $request->session()
                ->flash('success',"Successfully updating {$validateData['nama']}!");
                return redirect()->route('authors.index');
                }

    public function destroy(Author $author)
        {
          $author->delete();

            return redirect()->route('authors.index')->with(
            'success',"Successfully deleting {$author['nama']}!"
                    );
                }


                public function find()
                {
                $author = Author::find(2);
                echo "Author: <b>$author->nama ($author->nama)</b><br />";
                echo "<table border=\"1\">
                <thead>
                <th>Book ID</th>
                <th>Judul</th>
                <th>Halaman</th>
                <th>Kategori</th>
                </thead>
                <tbody>";
                foreach ($author->books as $book) {
                echo "<tr>";
                echo "<td>$book->id</td>";
                echo "<td>$book->judul</td>";
                echo "<td>$book->halaman</td>";
                echo "<td>$book->kategori</td>";
                echo "</tr>";
                }
                echo "</tbody></table>";
                }


                public function allJoin()
                {
                $authors = Author::all();
                foreach ($authors as $author) {
                echo "Author: <b>$author->nama ($author->nama)</b><br />";
                echo "Buku: ";
                foreach ($author->books as $book) {
                echo $book->judul . " - ";
                }
                echo "<hr>";
                }
                }


                public function withCount()
                {
                $authors = Author::withCount('books')->get();
                foreach ($authors as $author) {
                echo "<b>$author->nama</b> ($author->books_count buku)<br />";
                }
                }

}
