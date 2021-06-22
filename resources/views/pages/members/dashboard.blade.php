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
              @if ($agriculturalGroup->status_management == 0)
                <div class="row">
                    <span class="alert alert-warning">
                      Anda belum melengkapi informasi profesi Anda terkait pengelolaanya
                      <a href="{{ route('member-next-management') }}">
                        <i>Lengkapi!</i>
                      </a>
                    </span>
                </div>
              @elseif ($agriculturalGroup->status_investor == 0)
              <div class="row">
                  <span class="alert alert-warning">
                    Anda belum melengkapi informasi profesi Anda terkait pemodalnya
                    <a href="{{ route('member-next-investor') }}">
                      <i>Lengkapi!</i>
                    </a>
                  </span>
              </div>
              @elseif ($agriculturalGroup->status_capital == 0)
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
                <div class="col-md-12">
                  <div class="card mb-2 shadow bg-white rounded">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-10">
                            <div class="dashboard-card-title">
                              Profesi
                            </div>
                          </div>
                          <div class="col-md-10">
                            <div class="dashboard-card-subtitle">
                              {{ $member->profession->name }} {{ $agriculturalGroup->typeAgricultur->name_type }}
                            </div>
                          </div>
                          <div class="col-md-2">
                            <a href="#detail" class="btn btn-sm custom-button text-white" data-toggle="collapse" role="button" aria-expanded="false">
                              Detail
                            </a>
                          </div>
                          @if ($agriculturalGroup != null)
                          <div class="collapse col-md-12 mt-2" id="detail">
                            <div class="row">
                              <div class="card col-md-4">
                                <div class="card-header custom-button text-white">Detail</div>
                                <img class="card-img-top" src="{{ Storage::url('assets/'.$agriculturalGroup->photo_area ?? '') }}" width="100" height="180" alt="Card image cap">
                                <div class="card-body">
                                  <h6 class="card-title">
                                    {{ $agriculturalGroup->typeAgricultur->name_type }} 
                                  </h6>
                                </div>
                              </div>
                              <div class="col-md-8">
                                <div class="table-responsive ">
                                 <table class="table">
                                    <tbody>
                                     <tr>
                                       <td>Luas Lahan</td><td>:</td><td>{{$provider->decimalFormat($agriculturalGroup->land_area) }} m<sup>2</sup></td>
                                     </tr>
                                     <tr>
                                       <td>Alamat Lahan</td><td>:</td></td><td>Ds. {{ $agriculturalGroup->village->name }}, Kec. {{ $agriculturalGroup->village->district->name }}, {{ $agriculturalGroup->village->district->regency->name }},{{  $agriculturalGroup->village->district->regency->province->name  }} </td>
                                     </tr>
                                     <tr>
                                       <td>Jenis Bibit</td><td>:</td><td>{{ $agriculturalGroup->type_of_seed }}</td>
                                     </tr>
                                     <tr>
                                       <td>Bibit Ditanam</td><td>:</td><td>{{$provider->decimalFormat($agriculturalGroup->number_of_seeds) }} {{ $agriculturalGroup->unit }}</td>
                                     </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="card card-body">
                                  <div class="card-title">
                                     <h6>
                                       Biaya / Permodalan 
                                      </h6>
                                   </div>
                                 <div class="table-responsive ">
                                  <table class="table">
                                     <tbody>
                                      <tr>
                                        <td>Biaya Bibit</td><td>:</td><td>Rp. {{$provider->decimalFormat($agriculturalGroup->capital->cost_of_seeds) }}</td>
                                      </tr>
                                      <tr>
                                        <td>Biaya Sewa</td><td>:</td><td>Rp. {{$provider->decimalFormat($agriculturalGroup->capital->rental_cost) }}</td>
                                      </tr>
                                      <tr>
                                        <td>Biaya Pengolahan Lahan</td><td>:</td><td>Rp. {{$provider->decimalFormat($agriculturalGroup->capital->material_processing_costs)	 }}</td>
                                      </tr>
                                      <tr>
                                        <td>Biaya Penanaman</td><td>:</td><td>Rp.{{$provider->decimalFormat($agriculturalGroup->capital->planting_costs)	}}</Rp.>
                                      </tr>
                                      <tr>
                                        <td>Biaya Pemeliharaan</td><td>:</td><td>Rp. {{$provider->decimalFormat($agriculturalGroup->capital->maintenance_cost)	 }}</td>
                                      </tr>
                                      <tr>
                                        <td>Biaya Pupuk</td><td>:</td><td>Rp. {{$provider->decimalFormat($agriculturalGroup->capital->fertilizer_costs)	 }}</td>
                                      </tr>
                                      <tr>
                                        <td>Biaya Panen</td><td>:</td><td>Rp. {{$provider->decimalFormat($agriculturalGroup->capital->harvest_costs)	 }}</td>
                                      </tr>
                                      <tr>
                                        <td>Biaya Lainnya</td><td>:</td><td>Rp. {{$provider->decimalFormat($agriculturalGroup->capital->other_costs)	 }}</td>
                                      </tr>
                                      <tr>
                                        <td>Piutang</td><td>:</td><td>Rp. {{$provider->decimalFormat($agriculturalGroup->capital->accounts_receivable)	 }}</td>
                                      </tr>
                                      <tr>
                                        <td>Total</td>
                                        <td>:</td>
                                        <td>Rp {{$provider->decimalFormat($total_capital->total)}}</td>
                                      </tr>
                                     </tbody>
                                   </table>
                                 </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          @endif
                          @if($cultivator != null)
                          <div class="collapse col-md-12 mt-2" id="detail">
                            Pembudidaya
                          </div>
                          @endif
                          @if($farm != null)
                          <div class="collapse col-md-12 mt-2" id="detail">
                            Peternak
                          </div>
                          @endif
                          @if($fisherman != null)
                          <div class="collapse col-md-12 mt-2" id="detail">
                            Nelayan
                          </div>
                          @endif
                          @if($enterpreneur != null)
                          <div class="collapse col-md-12 mt-2" id="detail">
                            Pengusaha
                          </div>
                          @endif
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