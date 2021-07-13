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

        {{-- pengelola --}}
        @if (auth()->guard('member')->user()->roles_manager == 1)
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
                             <div class="">
                               <h5 class="mt-3">
                              {{ $total_investor }}
                               </h5>
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
                            <div class="">
                               <h5 class="mt-3">
                              {{ $total_farmer }}
                               </h5>
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
                             <div class="">
                               <h5 class="mt-3">
                                {{ $total_agriculture_group }}
                               </h5>
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
                             <div class="">
                               <h5 class="mt-3">
                                Rp. {{$provider->decimalFormat($total_capital) }}
                               </h5>
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
        {{-- /pengelola --}}

        {{-- investor --}}
        @elseif (auth()->guard('member')->user()->roles_investor == 1)
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
                              Pengelola
                            </div>
                             <div class="">
                               <h5 class="mt-3">
                              {{ $investor_total_management }}
                               </h5>
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
                            <div class="">
                               <h5 class="mt-3">
                              {{ $investor_total_farmer }}
                               </h5>
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
                             <div class="">
                               <h5 class="mt-3">
                                  {{ $investor_total_agriculture_group }}
                               </h5>
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
                             <div class="">
                               <h5 class="mt-3">
                                 Rp. {{$provider->decimalFormat($investor_total_capital) }}
                               </h5>
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
        @endif
        {{-- /investor --}}
      </div>
    </div>
@endsection