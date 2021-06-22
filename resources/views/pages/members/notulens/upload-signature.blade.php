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
      <div id="page-content-wrapper">
        <div class="page-content">
          <div class="container">
            @include('layouts.message')
            <div class="col-md-12">
                <div class="dashboard-content">
                        <div class="card shadow">
                        <div class="card-body">
                            <h6>Silahkan upload gambar tanda tangan Anda untuk membuat notulensi !</h6>
                            <div class="col-md-12 mb-4 text-center">
                                    <img src="/images/notulens.svg" alt="" width="100px">
                            </div>
                            <div class="col-md-12 text-center">
                                <form action="{{ route('member-notulen-signature-save') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <input type="file" name="file" required>
                                    </div>
                                    <div class="form-group">
                                        <button
                                        type="submit"
                                            class="btn btn-try custom-button text-white  btn-block w-00 mt-4"
                                        >
                                            Simpan
                                        </button>
                                    </div>                  
                            </form>
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
