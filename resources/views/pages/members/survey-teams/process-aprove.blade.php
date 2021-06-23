@extends('layouts.admin')
@section('title')
    Intani Banten
@endsection
@push('addon-style')
          <link href="{{ asset('css/home.css') }}" rel="stylesheet" />

@endpush
@section('content')
    <!-- Page Content -->
    <div class="page-content page-home" data-aos="fade-down">
      <div id="page-content-wrapper" style="min-height: 70vh">
        <div class="page-content">
          <div class="container">
          @include('layouts.message')
            <div class="dashboard-content">
              <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                  <div class="card mb-2 shadow bg-warning rounded">
                    <div class="card-body">
                      <div class="dashboard-card-title text-center">Pengajuan tim survey Anda sedang diproses</div>
                    </div>
                  </div>
                </div>
                <div class="col-md-3"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection