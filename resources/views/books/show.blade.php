@extends('layout.master')
@section('title', $book->title)
@section('content')
<div class="col-md-12">
    <div class="col-md-8">
        <h2>{{ $book->judul }}</h2>
    </div>

    <div class="col-md4">
        <div class="float-right">
            <div class="btn-group" role="group">
                <a href="{{ route('books.edit', $book->id) }}"
                     class="btn btn-primary ml-3">Edit</a>

                <form action="{{ route('books.destroy', $book->id) }}" method="POST">
                    <button type="submit" class="btn btn-danger" ml-3>Delete</button>
                    @method('DELETE')
                    @csrf
                </form>
            </div>
        </div>
    </div>

 <h5>
 <span class="badge badge-primary">
 <i class="fa fa-star fa-fw"></i>
HAL: {{ $book->halaman }}
 </span>
 </h5>
 <p>
 <ul class="list-inline">
 <li class="list-inline-item">
 <i class="fa fa-th-large fa-fw"></i> Kategori:
 <em>{{ $book->kategori }}</em>
 </li><br>
 <li class="list-inline-item">
<i class="fa fa-calendar fa-fw"></i> Penerbit:
 {{ $book->penerbit }}
 </li>
 </ul>

 <div class="text-center">
    <img src="{{ Storage::url($book->image) }}"
    class="img-fluid rounded text-center">
    </div>

 </p>
 <hr>
</div>
@endsection
