@extends('layout.master')
@section('title', 'Edit Book')
@section('content')
<h2>Update New Book</h2>

<form action="{{ route('books.update', ['book' => $book->id]) }}" method="POST" enctype="multipart/form-data">
    @method('PATCH')
 @csrf
 <div class="row">
 <div class="col-md-6 mb-3">
 <label for="judul">Judul</label>
 <input type="text" class="form-control @error('judul') is-invalid @enderror"
 name="judul" id="judul" value="{{ old('judul') ?? $book->judul }}">
 @error('judul')
 <div class="text-danger">{{ $message }}</div>
 @enderror
 </div>

 </div>

 <div class="form-group">
 <label for="halaman">Halaman</label>
 <textarea class="form-control @error('halaman') is-invalid @enderror"
 name="halaman" id="halaman" rows="3">{{ old('halaman') ?? $book->halaman }}</textarea>
 @error('halaman')
 <div class="text-danger">{{ $message }}</div>
 @enderror
 </div>

 <div class="row">

    <div class="col-md-6 mb-3">
        <label for="kategori">Kategori</label>
        <input type="text" class="form-control @error('kategori') is-invalid @enderror"
        name="kategori" id="kategori" value="{{ old('kategori') ?? $book->kategori }}">
        @error('kategori')
        <div class="text-danger">{{ $message }}</div>
        @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label for="penerbit">Penerbit</label>
            <input type="text" class="form-control @error('penerbit') is-invalid @enderror"
            name="penerbit" id="penerbit" value="{{ old('penerbit') ?? $book->penerbit }}">
            @error('penerbit')
            <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>

 </div>

 <div class="form-group">
    <div class="input-group">
    <div class="input-group-prepend">
    <span class="input-group-text" id="image-label">Image</span>
    </div>
    <div class="custom-file">
    <input type="file" class="custom-file-input" name="image" id="image">
    <label class="custom-file-label" for="image">Choose file</label>
    </div>
    </div>
    @error('image')
    <div class="text-danger">{{ $message }}</div>
    @enderror
    @if ($book->image)
    <div class="card card-primary">
    <div class="card-body">
    <div class="filter-container p-0 row">
    <div class="filtr-item col-sm-2">
    <a href="{{ Storage::url($book->image) }}"
    data-toggle="lightbox">
    <img src="{{ Storage::url($book->image) }}"
    class="img-fluid mb-2"/>
    </a>
    </div>
    </div>
    </div>
    </div>
    @endif
    </div>

 <button class="btn btn-primary btn-lg btn-block" type="submit">Update</button>
</form>
@endsection

@push('js_after')
<script>
 // Untuk upload file
 $(".custom-file-input").on("change", function () {
 var fileName = $(this).val().split("\\").pop();
 $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
 });
</script>
@endpush
