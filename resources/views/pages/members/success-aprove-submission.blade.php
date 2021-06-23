@extends('layouts.app')
@section('title')
    Success Aprove Submission
@endsection
@push('addon-style')
    <link href="{{ asset('css/home.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <!-- Page Content -->
    <div class="page-content page-success">
      <div class="section-success" data-aos="zoom-in">
        <div class="container">
          <div class="row align-items-center row-align justify-content-center">
            <div class="col-lg-6 text-center">
              <img src="{{ asset('images/checklist2.svg') }}" class="mb-4" width="200" />
              <h5>Sukses Menyetujui</h5>
              <h5>{{ $member->name }}</h5>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection