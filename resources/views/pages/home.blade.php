@extends('layouts.app')
@section('title')
    Intani Banten
@endsection
@push('addon-style')
             <link href="{{ asset('css/home.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <!-- Page Content -->
    <div class="page-content page-home">
      <div class="page-content page-auth">
        <div class="row row-login">
          <div class="col-12 text-center mt-4">
           <div
              class="header-4-2 container-xxl mx-auto p-0 position-relative"
              style="font-family: 'Poppins', sans-serif"
              data-aos="fade-down"
              data-aos-duration="1000"
            >
              <div class="">
                <div class="mx-auto d-flex flex-lg-row flex-column hero">
                  <!-- Left Column -->
                  <div
                    class="left-column d-flex flex-lg-grow-1 flex-column align-items-lg-start text-lg-start align-items-center text-center"
                  >
                    <h1 class="title-text-big">Intani Banten</h1>
                    <div
                      class="d-flex flex-sm-row flex-column align-items-center mx-lg-0 mx-auto justify-content-center gap-3"
                    >
                      <a href="{{ route('register-member') }}"
                        class="btn d-inline-flex mb-md-0 w-100 btn-try text-white mr-2 mb-2"
                      >
                        Daftar Menjadi Anggota
                      </a>
                      <a
                       href="{{ route('register-management') }}"
                        class="btn d-inline-flex mb-md-0 w-100 btn-try text-white mr-2 mb-2"
                      >
                        Daftar Menjadi Pengelola
                      </a>
                      <a
                        class="btn d-inline-flex mb-md-0  w-100 btn-try text-white mr-2 mb-2"
                      >
                        Daftar Menjadi Investor
                      </a>
                    </div>
                  </div>
                  <!-- Right Column -->
                  <div
                    class="right-column text-center d-flex justify-content-lg-end justify-content-center pe-0"
                  >
                    <img
                      id="img-fluid"
                      class="h-auto mw-100"
                      src="data:image/png;base64,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"
                      alt=""
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
