@extends('layouts.app')
@section('content')

    <div class="mt-4">
    <form action="{{ route('task-management.store') }}" method="POST">
        @csrf
        <div class="d-flex justify-content-between mb-4">
            <div>
                <h4 class="text-secondary fw-bold">Add Task</h4>
            </div>
        </div>
        <div class="mb-3">
            <label for="inAddTaskName" class="form-label">Nama</label>
            <input type="text" class="form-control" id="inAddTaskName" name="name" value="{{ old('name') }}">
            <div id="inAddTaskName" class="form-text">Kosongkan jika ingin menggunakan nama default file.</div>
        </div>
        <div class="mb-3">
            <label for="inAddTaskDataset" class="form-label">File Dataset</label>
            <input type="text" class="form-control" id="inAddTaskDataset" name="dataset" required>
            <div id="inAddTaskName" class="form-text">Hanya file dengan format .zip yang diperbolehkan.</div>
        </div>
        <button type="submit" class="btn btn-primary me-2">Submit</button>
        <a href="#" class="btn btn-danger">Cancel</a>
    </form>
    </div>

@endsection('content')