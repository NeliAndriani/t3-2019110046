@extends('layout.master')
@section('title', $author->title)
@section('content')
<div class="col-md-12">
    <div class="col-md-8">
        <h2>{{ $author->nama }}</h2>
    </div>

    <div class="col-md4">
        <div class="float-right">
            <div class="btn-group" role="group">
                <a href="{{ route('authors.edit', $author->id) }}"
                     class="btn btn-primary ml-3">Edit</a>

                <form action="{{ route('authors.destroy', $author->id) }}" method="POST">
                    <button type="submit" class="btn btn-danger" ml-3>Delete</button>
                    @method('DELETE')
                    @csrf
                </form>
            </div>
        </div>
    </div>
 <hr>
</div>
@endsection
