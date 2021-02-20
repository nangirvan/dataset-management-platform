@extends('layouts.app')
@section('content')

    <div class="mt-4">
    <form action="{{ route('task-management.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="d-flex justify-content-between mb-4">
            <div>
                <h4 class="text-secondary fw-bold">Upload Dataset</h4>
            </div>
        </div>
        <div class="mb-3">
            <label for="inAddTaskName" class="form-label">Name</label>
            <input type="text" class="form-control" id="inAddTaskName" name="name" value="{{ old('name') }}">
            <div id="inAddTaskName" class="form-text">Leave it empty if you want to use default name</div>
        </div>
        <div class="mb-3">
            <label for="inAddTaskDataset" class="form-label">Dataset File</label>
            <input type="file" class="form-control @error('dataset') is-invalid @enderror" id="inAddTaskDataset" name="dataset" required>
            <div id="inAddTaskName" class="form-text @error('dataset') d-none @enderror">File type must be a .zip</div>
            @error('dataset')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-primary me-2">Submit</button>
        <a href="{{ route('home') }}" class="btn btn-danger">Cancel</a>
    </form>
    </div>

@endsection('content')