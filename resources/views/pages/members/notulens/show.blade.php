@extends('layouts.admin')
@section('title')
    Intani Banten
@endsection
@push('addon-style')
      <link href="{{ asset('css/home.css') }}" rel="stylesheet" />
@endpush
@section('content')
<!-- Page Content -->
<div class="page-content page-home" data-aos="fade-down" id="manager">
      <div id="page-content-wrapper" style="min-height: 70vh">
        <div class="page-content">
          <div class="container">
            @include('layouts.message')
            <div class="dashboard-content">
              <div class="card mb-2 shadow p-3 rounded">
                <div class="row">
                    <div class="col-md-12">
                         <h6>Notulensi</h6>
                        <h6 class="border-bottom border-success pb-2 mb-0"></h6>
                        <div class="row">
                                <div class="col-md-10">
                                    <table>
                                        <tr>
                                            <td>Nomor</td>
                                            <td>:</td>
                                            <td>
                                                {{$notulens->id}}/{{$romawi}}/{{$year}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tempat</td>
                                            <td>:</td>
                                            <td>
                                                {{$notulens->place}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Perihal</td>
                                            <td>:</td>
                                            <td>
                                                <b>
                                                    {{$notulens->title}}
                                                </b>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        
                            <div class="mt-4"></div>
                        <p class="media-body pb-3 mb-0 lh-125" align="justify">
                            {!! $notulens->content !!}
                        </p>
                        
                        <br>
                        <footer>
                            <div class="text-right">
                                <table style="float:right">
                                    <tr align="right">
                                        <td >
                                            Hormat Saya
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="{{asset('storage/'.$notulens->member->signature)}}" width="100">
                                            <p align="center" style="color: black">{{$notulens->member->name}}</p>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </footer>
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
