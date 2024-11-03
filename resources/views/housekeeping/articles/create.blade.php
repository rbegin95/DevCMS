@extends('housekeeping.app')

@section('title', 'Create News Article')

@section('content')
<br />
@if(session('success'))
        <div class="alert alert-success" style="width: 50%; margin: 0 auto; text-align: center;">
            {{ session('success') }}
        </div>
    @endif

<div class="container">
    <h1><center>Create News Article</center></h1>
    <form method="POST" action="{{ route('housekeeping.articles.store') }}">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="desc">Description</label>
            <input id="desc" name="desc" class="form-control"></input>
        </div>
       <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" id="content" name="content" rows="10" required></textarea>
        </div>
        <div class="form-group">
            <label for="published_by">Published By</label>
            <input type="text" id="published_by" name="published_by" class="form-control" value="{{ $username }}" disabled>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <select id="image" name="image" class="form-control" required>
                <option value="">Select an image</option>
                @foreach($images as $image)
                    <option value="{{ $image->getFilename() }}">{{ $image->getFilename() }}</option>
                @endforeach
            </select>
            <img id="image-preview" src="#" alt="Image Preview" style="display: none; margin-top: 15px; max-width: 400px; max-height: 300px;">
        </div>
        <br />
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>

<script>
document.getElementById('image').addEventListener('change', function(event) {
    const selectedImage = event.target.value;
    const img = document.getElementById('image-preview');
    if (selectedImage) {
        img.src = `/img/webpromo/${selectedImage}`;
        img.style.display = 'block';
    } else {
        img.style.display = 'none';
    }
});

$(document).ready(function() {
    $('#content').summernote({
        height: 300
    });
});
</script>
@endsection
