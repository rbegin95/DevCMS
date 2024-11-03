@extends('layouts.app')

@section('title', config('app.name') . ' - Registration')

@section('body-class', 'registration-page')

@section('content')
<main class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Register</h5>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="username">{{ __('Username') }}</label>
                            <input id="username" class="form-control" type="text" name="username" value="{{ old('username') }}" required autofocus>
                        </div>

                        <div class="form-group mt-4">
                            <label for="email">{{ __('Email') }}</label>
                            <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required>
                        </div>

                        <div class="form-group mt-4">
                            <label for="password">{{ __('Password') }}</label>
                            <input id="password" class="form-control" type="password" name="password" required>
                        </div>

                        <div class="form-group mt-4">
                            <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                            <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <a class="text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                                {{ __('Already registered?') }}
                            </a>

                            <button type="submit" class="btn btn-primary">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
