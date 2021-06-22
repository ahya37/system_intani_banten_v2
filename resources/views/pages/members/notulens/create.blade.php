@extends('layouts.admin')
@section('title')
    Intani Banten
@endsection
@push('addon-style')
    <link href="/css/home.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
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
                            <h6>Buat Notulensi</h6>
                            <div class="col-md-12 mt-3">
                                <form action="{{ route('member-notulen-save') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                            <label>Judul</label>
                                            <input type="text" name="title" class="form-control form-control-sm">
                                    </div>
                                     <div class="form-group">
                                            <label>Tempat</label>
                                            <input type="text" name="place" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group">
                                                <label>Isi</label>
                                                <textarea class="summernote form-control" name="content"></textarea>
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
@push('addon-script')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script type="text/javascript">
        $(document).ready(function() {
          $('.summernote').summernote({
              height: 150,
              toolbar: [
                ['font', ['bold', 'underline']],
                ['para', ['ul', 'ol', 'paragraph']],
                ]
          });
        });
</script>
@endpush