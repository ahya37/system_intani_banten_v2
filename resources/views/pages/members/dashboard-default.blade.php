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
              @if ($agruculturalGroup->status_management == 0)
                <div class="row">
                    <span class="alert alert-warning">
                      Anda belum melengkapi informasi profesi Anda terkait pengelolaanya
                      <a href="{{ route('member-next-management') }}">
                        <i>Lengkapi!</i>
                      </a>
                    </span>
                </div>
              @elseif ($agruculturalGroup->status_investor == 0)
              <div class="row">
                  <span class="alert alert-warning">
                    Anda belum melengkapi informasi profesi Anda terkait pemodalnya
                    <a href="{{ route('member-next-investor') }}">
                      <i>Lengkapi!</i>
                    </a>
                  </span>
              </div>
              @elseif ($agruculturalGroup->status_capital == 0)
              <div class="row">
                  <span class="alert alert-warning">
                    Anda belum melengkapi informasi profesi Anda terkait permodalan / biaya
                    <a href="{{ route('member-next-capital') }}">
                      <i>Lengkapi!</i>
                    </a>
                  </span>
              </div>
              @endif
              <div class="row">
                <div class="col-md-3">
                  <div class="card mb-2">
                    <div class="card-body">
                      <div class="dashboard-card-title">Investor</div>
                      <div class="dashboard-card-subtitle">15,209</div>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="card mb-2">
                    <div class="card-body">
                      <div class="dashboard-card-title">Petani</div>
                      <div class="dashboard-card-subtitle">$931,290</div>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="card mb-2">
                    <div class="card-body">
                      <div class="dashboard-card-title">Kelompok Pertanian</div>
                      <div class="dashboard-card-subtitle">22,309,399</div>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="card mb-2">
                    <div class="card-body">
                      <div class="dashboard-card-title">Permodalan</div>
                      <div class="dashboard-card-subtitle">22,409,399</div>
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