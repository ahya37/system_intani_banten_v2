@extends('layouts.admin')
@section('title')
    Profile
@endsection
@push('addon-style')
    <link href="/css/home.css" rel="stylesheet" />
@endpush
@section('content')
    <!-- Page Content -->
    <div class="page-content page-home">
      <div id="page-content-wrapper" style="min-height: 70vh">
        <div class="page-content">
          <div class="container">
            <div class="dashboard-content">
              <div class="card mb-2 shadow p-3 bg-white rounded">
                <h5>Profil Anda</h5>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4">
                        <a href="{{ Storage::url($member->photo ?? '') }}" target="_blank">
                            <img
                            src="{{ Storage::url($member->photo ?? '') }}"
                            class="w-100 mb-2">
                            </a>
                    </div>
                    <div class="col-md-8">
                        <table id="myTable">
                                            <tr>
                                                <td>NIK</td><td>:</td><td>{{$member->nik}}</td>
                                            </tr>
                                            <tr>
                                                <td>Nama</td><td>:</td><td>{{$member->name}}</td>
                                            </tr>
                                            <tr>
                                                <td>Tempat / Lahir</td><td>:</td><td>{{$member->place_of_berth}} / {{$member->date_of_berth}}</td>
                                            </tr>
                                            <tr>
                                                <td>Jenis Kelamin</td><td>:</td><td>{{ $member->status_gender }}</td>
                                            </tr>
                                            <tr>
                                                <td>Alamat</td><td>:</td><td>{{ $member->address }} - Ds. {{$member->village->name}}, Kec. {{$member->village->district->name}}, {{$member->village->district->regency->name}}</td>
                                            </tr>
                                            <tr>
                                                <td>No. Telp</td><td>:</td><td>{{$member->phone_number}}</td>
                                            </tr>
                                            <tr>
                                                <td>Email</td><td>:</td><td>{{$member->email}}</td>
                                            </tr>
                                            <tr>
                                                <td>Facebook</td><td>:</td><td>{{$member->sosmed_facebook}}</td>
                                            </tr>
                                            <tr>
                                                <td>Instagram</td><td>:</td><td>{{$member->sosmed_instagram}}</td>
                                            </tr>
                                            <tr>
                                                <td>Youtube</td><td>:</td><td>{{$member->sosmed_youtube}}</td>
                                            </tr>
                                            <tr>
                                                <td>KTP</td><td>:</td>
                                                <td>
                                                    <a href="{{ Storage::url($member->photo_idcard ?? '') }}" target="_blank">
                                                        <img
                                                        src="{{ Storage::url($member->photo_idcard ?? '') }}"
                                                        class="w-100">
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Kartu Keluarga</td><td>:</td>
                                                <td>
                                                    <a href="{{ Storage::url($member->photo_family_card ?? '') }}" target="_blank">
                                                        <img
                                                        src="{{ Storage::url($member->photo_family_card ?? '') }}" alt="{{$member->name}}"
                                                      class="w-100">
                                                    </a>
                                                </td>
                                            </tr>                                  
                                        </table>
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