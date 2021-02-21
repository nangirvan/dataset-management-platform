@extends('layouts.app')
@section('content')

    <div class="mt-4">
        @if(session('success'))
        <div class="alert alert-primary alert-dismissible fade show text-center" role="alert">
            <strong>Success!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="row mb-4 text-center">
            <div class="col-sm text-md-start my-2 my-md-0">
                <h4 class="text-secondary fw-bold">Tasks</h4>
            </div>
            <div class="col-sm my-2 my-md-0">
                <form action="#" method="GET" class="d-flex">
                    <input class="form-control me-2" type="search" name="task_name" placeholder="Task name ..." aria-label="Search">
                    <button class="btn btn-outline-secondary text-secondary" type="submit">Search</button>
                </form>
            </div>
            <div class="col-sm text-md-end my-2 my-md-0">
                <a href="{{ route('task-management.create') }}" class="btn btn-secondary fw-bold">
                    <i class="fas fa-upload me-1"></i>
                    Upload Dataset
                </a>
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="table table-borderless">
                <thead>
                    <tr class="bg-secondary text-white">
                        <th scope="col">NO</th>
                        <th scope="col">NAME</th>
                        <th scope="col">SIZE</th>
                        <th scope="col">UPLOADED TIME</th>
                        <th scope="col">STATUS</th>
                        <th scope="col">BOOKING</th>
                        <th scope="col">ACTION</th>
                    </tr>
                </thead>
                <tbody class="bg-light">
                    @foreach($tasks as $task)
                    <tr class="align-middle">
                        <td>
                            {{ $loop->iteration }}
                        </td>
                        <td>
                            <strong>{{ $task->name }}</strong>
                        </td>
                        <td>
                            {{ $task->file_size }}
                        </td>
                        <td>
                            {{ $task->uploaded_at }}
                        </td>
                        <td>
                            @if (sizeof($task->users))
                                Booked
                            @else
                                Not Booked
                            @endif
                        </td>
                        <td>
                            <div class="d-flex justify-content-start">
                                <form action="{{ route('task-management.booking') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $task->id }}">
                                    <button type="submit" class="btn btn-sm btn-primary me-2 @if(sizeof($task->users) > 0) disabled @endif">
                                        <i class="fas fa-ticket-alt"></i>
                                        <span>Booking</span>
                                    </button>
                                </form>
                                <form action="{{ route('task-management.revoke-booking') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $task->id }}">
                                    <button type="submit" class="btn btn-sm btn-danger me-2 @if(sizeof($task->users) == 0) disabled @endif">
                                        <i class="fas fa-times"></i>
                                        <span>Revoke</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-start">
                                <form action="{{ route('task-management.download') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $task->id }}">
                                    <button type="submit" class="btn btn-sm btn-primary me-2 @if(sizeof($task->users) == 0) disabled @endif">
                                        <i class="fas fa-download"></i>
                                        <span>Download</span>
                                    </button>
                                </form>
                                <form action="{{ route('task-management.destroy', $task->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                        <span>Delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection