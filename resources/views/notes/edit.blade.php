@extends('notes.layout')

@section('content')
<div class="card mt-5">
    <h2 class="card-header">Edit Note</h2>
    <div class="card-body">
        
        <form action="{{ route('notes.update', $note->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="title" class="form-label">Title:</label>
                <input type="text" name="title" value="{{ $note->title }}" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Title">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="content" class="form-label">Content:</label>
                <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content" rows="3" placeholder="Content">{{ $note->content }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="image" class="form-label">Current Image:</label><br>
                @if($note->image)
                    <img src="{{ asset('storage/images/' . $note->image) }}" alt="Current Image" style="max-width: 200px; max-height: 200px;" class="mb-2">
                @else
                    <p>No image uploaded</p>
                @endif
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="image">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
        
    </div>
</div>
@endsection