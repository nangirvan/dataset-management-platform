@extends('layouts.auth')
@section('content')

    <div class="d-flex justify-content-center" style="margin-top: 10%;">
        <div class="card" style="width: 25rem;">
            <div class="card-header shadow-sm">
                <h5 class="card-title text-center my-2 text-muted">{{ config('app.name') }}</h5>
            </div>
            <div class="card-body mb-5">
                @error('email')
                <div class="alert alert-danger text-center" role="alert">
                    {{ $message }}
                </div>
                @enderror
                <h4 class="card-subtitle text-center mt-4 mb-4 fw-bolder">LOGIN</h4>
                <form action="{{ route('auth.login') }}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inLoginEmailAddon">
                            <i class="fas fa-at"></i>
                        </span>
                        <input type="email" class="form-control py-2" id="inLoginEmail" name="email" placeholder="Email" value="{{ old('email') }}" required>
                    </div>
                    <div class="input-group mb-4">
                        <span class="input-group-text" id="inLoginPasswordAddon">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" class="form-control py-2" id="inLoginPassword" name="password" placeholder="Password" value="{{ old('password') }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary fw-bolder py-2" style="width: 100%;">LOGIN</button>
                </form>
            </div>
        </div>
    </div>

@endsection