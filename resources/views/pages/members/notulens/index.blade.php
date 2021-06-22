@extends('layouts.admin')
@section('title')
    Intani Banten
@endsection
@push('addon-style')
    <link href="/css/home.css" rel="stylesheet" />
@endpush
@section('content')
<!-- Page Content -->
<div class="page-content page-home" data-aos="fade-down" id="manager">
      <div id="page-content-wrapper" style="min-height: 70vh">
        <div class="page-content">
          <div class="container">
            @include('layouts.message')
            <div class="dashboard-content">
              <div class="card mb-2 shadow p-3 bg-light rounded">
                <div class="card-body">
                    <div class="my-3 p-3">
                    <div class="row">
                        <div class="col-md-10">
                            <h6>Daftar Notulensi</h6>
                        </div>
                        <div class="col-md-2">
                            <a href="{{ route('member-notulen-create') }}" class="btn btn-sm custom-button text-white"><i class="fa fa-pencil-alt"></i> Buat Notulensi</a>
                        </div>
                    </div>
                    <h6 class="border-bottom border-success pb-2 mb-0"></h6>
                    @foreach ($notulens as $item)
                        <div class="pt-3">
                            <a href="{{ route('member-notulen-show', $item->id) }}">
                                <strong class="media-body pb-4 mb-0 lh-125 border-bottom border-gray">
                                        {{ $item->title }} ({{'oleh:' .$item->member->name}})
                                    </strong>
                                </a>
                                <br>
                                    <span>
                                        {{date('d-m-Y', strtotime($item->created_at)) }}
                                    </span>
                                    <span>
                                        <a href="{{ route('member-notulen-pdf', $item->id) }}" target="_blank" class="fa fa-print"> cetak pdf</a>
                                    </span>
                                    <br>
                        </div>
                    @endforeach
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
