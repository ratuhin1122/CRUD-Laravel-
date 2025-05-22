@extends('notes.layout')

@section('content')
<div class="card mt-5">
    <h2 class="card-header">Add New Note</h2>
    <div class="card-body">
        
        <form action="{{ route('notes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-3">
                <label for="title" class="form-label">Title:</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Title">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="content" class="form-label">Content:</label>
                <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content" rows="3" placeholder="Content"></textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="image" class="form-label">Image:</label>
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="image">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
        
    </div>
</div>
@endsection