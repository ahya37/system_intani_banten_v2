@extends('layouts.admin')
@section('title')
    Intani Banten
@endsection
@push('addon-style')
    <link href="/css/home.css" rel="stylesheet" />
@endpush
@section('content')
<!-- Page Content -->
<div class="page-content page-home" data-aos="fade-down">
      <div id="page-content-wrapper" style="min-height: 70vh">
        <div class="page-content">
          <div class="container">
            <div class="dashboard-content">
              <div class="card mb-2 shadow p-3 bg-light rounded">
                <div class="card-body">
                  <div class="dashboard-card-title">
                    Silahkan lengkapi informasi mengenai profesi Anda sebagai:
                    <i>
                      {{ $profession->profession }}
                    </i>
                  </div>
                  <div class="dashboard-card-subtitle">
                    <a
                      href="{{ route('member-validation-profession') }}"
                      class="btn btn-sm custom-button text-white"
                    >
                      Lengkapi
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection