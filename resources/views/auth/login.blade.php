@extends('layouts.app')
@section('title')
    Login
@endsection
@push('addon-style')
    <link href="{{ asset('css/home.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <!-- Page Content -->
    <div class="page-content page-home" data-aos="fade-down">
        <div class="d-flex justify-content-center">
            <div class="page-content page-auth">
              <div class="row row-login">
                <div class="col-12">
                <div class="container">
                    @include('layouts.message')
                    <div class="card">
                    <div class="card-header">
                      <h3 class="text-center">Login</h3>
                    </div>
                    <div class="card-body">
                      <div class="">
                        <form method="POST" action="{{ route('member-login') }}">
                            @csrf
                          <div class="form-group">
                            <label>Email</label>
                            <input  id="email" type="email" name="email" class="form-control  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus />
                             @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                          </div>
                          <div class="form-group">
                            <label>Password</label>
                            <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="current-password" />
                             @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                          </div>
                          <button
                          type="submit"
                            class="btn custom-button btn-block text-white"
                          >
                            Login
                          </button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

        </div>
    </div>
@endsection