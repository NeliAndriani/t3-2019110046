@extends('layout.master')
@section('title', 'Edit Author')
@section('content')
<h2>Update New Author</h2>

<form action="{{ route('authors.update', ['author' => $author->id]) }}" method="POST">
    @method('PATCH')
 @csrf
 <div class="row">
 <div class="col-md-6 mb-3">
 <label for="nama">Nama</label>
 <input type="text" class="form-control @error('nama') is-invalid @enderror"
 name="nama" id="nama" value="{{ old('nama') ?? $author->nama }}">
 @error('nama')
 <div class="text-danger">{{ $message }}</div>
 @enderror
 </div>
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
