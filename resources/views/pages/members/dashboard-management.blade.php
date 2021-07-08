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
                <div class="col-md-3">
                  <div class="card mb-2 shadow bg-white rounded">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="dashboard-card-title">
                              Investor
                            </div>
                          </div>
                        </div>
                      </div>

                  </div>
                </div>
                <div class="col-md-3">
                  <div class="card mb-2 shadow bg-white rounded">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="dashboard-card-title">
                              Petani
                            </div>
                          </div>
                        </div>
                      </div>

                  </div>
                </div>
                <div class="col-md-3">
                  <div class="card mb-2 shadow bg-white rounded">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="dashboard-card-title">
                              Kelompok Pertanian
                            </div>
                          </div>
                        </div>
                      </div>

                  </div>
                </div>
                <div class="col-md-3">
                  <div class="card mb-2 shadow bg-white rounded">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="dashboard-card-title">
                              Permodalan
                            </div>
                          </div>
                        </div>
                      </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection