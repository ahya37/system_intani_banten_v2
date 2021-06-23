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
            <div class="dashboard-content">
              <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                  <div class="card mb-2 shadow bg-white rounded">
                    <div class="card-body">
                      <div class="dashboard-card-title text-center">Anda belum bisa melakukan survey</div>
                      <div class="dashboard-card-subtitle">
                        <form action="{{ route('member-surveyteam-submission') }}" method="POST">
                          @csrf
                          <button class="col-md-12 btn btn-sm custom-button text-white">Buat Pengajuan</button>
                        </form>
                      </div>
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