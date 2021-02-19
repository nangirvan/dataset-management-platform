@extends('layouts.app')
@section('content')

    <div class="mt-4">
        <div class="d-flex justify-content-between mb-4">
            <div>
                <h4 class="text-secondary fw-bold">Tasks</h4>
            </div>
            <div>
                <a href="#" class="btn btn-secondary fw-bold">
                    <i class="fas fa-upload me-1"></i>
                    Upload Dataset
                </a>
            </div>
        </div>
        
        <table class="table table-borderless">
            <thead>
                <tr class="bg-secondary text-white">
                    <th scope="col">NO</th>
                    <th scope="col">NAME</th>
                    <th scope="col">SIZE</th>
                    <th scope="col">STATUS</th>
                    <th scope="col">BOOKING</th>
                    <th scope="col">ACTION</th>
                </tr>
            </thead>
            <tbody class="bg-light">
                <tr class="align-middle">
                    <td>1</td>
                    <td>task_a</td>
                    <td>1KB</td>
                    <td>Booked</td>
                    <td>
                        <div class="d-flex justify-content-start">
                            <a href="#" class="btn btn-primary me-2 disabled">
                                <i class="fas fa-ticket-alt"></i>
                                Booking
                            </a>
                            <a href="#" class="btn btn-danger me-2">
                                <i class="fas fa-times"></i>
                                Revoke
                            </a>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex justify-content-start">
                            <a href="#" class="btn btn-primary me-2">
                                <i class="fas fa-download"></i>
                                Download
                            </a>
                            <form action="#" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash"></i>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <tr class="align-middle">
                    <td>1</td>
                    <td>task_ba</td>
                    <td>128B</td>
                    <td>Not Booked</td>
                    <td>
                        <div class="d-flex justify-content-start">
                            <a href="#" class="btn btn-primary me-2">
                                <i class="fas fa-ticket-alt"></i>
                                Booking
                            </a>
                            <a href="#" class="btn btn-danger me-2 disabled">
                                <i class="fas fa-times"></i>
                                Revoke
                            </a>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex justify-content-start">
                            <a href="#" class="btn btn-primary me-2 disabled">
                                <i class="fas fa-download"></i>
                                Download
                            </a>
                            <form action="#" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash"></i>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

@endsection