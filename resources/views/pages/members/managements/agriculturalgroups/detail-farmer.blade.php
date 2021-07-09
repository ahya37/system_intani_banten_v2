@extends('layouts.admin')
@section('title')
    Intani Banten
@endsection
@push('addon-style')
          <link href="{{ asset('css/home.css') }}" rel="stylesheet" />
          <link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet" />
          <link href="https://cdn.datatables.net/1.10.25/css/dataTables.jqueryui.min.css" rel="stylesheet" />
@endpush
@section('content')
    <!-- Page Content -->
    <div class="page-content page-home" data-aos="fade-down">
      <div id="page-content-wrapper" style="min-height: 70vh">
        <div class="page-content">
          <div class="container">
            <div class="dashboard-content">
              <div class="row">
                <div class="col-md-12">
                  <div class="card mb-2 shadow bg-white rounded">
                      <div class="card-body">
                        <h6>Data Kelompok Pertanian</h6>
                        <h6 class="mb-4">Berdasarkan Jenis Pertanian : {{ strtoupper($name_type) }}</h6>
                        <hr>
                      </div>

                      {{-- petani --}}
                      <div class="col-md-12">
                        @foreach ($detailFarmer as $farmer)
                          <div>
                             <table>
                               <tr>
                                 {{-- <td>{{$no_farmer++}}</td> --}}
                                 <td><b>NAMA PETANI</b></td><td>:</td><td><b>{{ $farmer->farmer_name }}</b></td>
                               </tr>
                                <tr>
                                 <td><b>ALAMAT PETANI</b></td><td>:</td><td><b>{{ 'Ds. '.$farmer->village .', Kec. '.$farmer->district .', '.$farmer->regency }}</b></td>
                               </tr>
                              </table>
                          </div>

                          {{-- detail kelompok pertaniannya --}}
                          @php
                              $farmer_id = $farmer->farmer_id;
                              $type_of_agriculture_id = $farmer->type_of_agriculture_id;
                              $detail = $agricultureGroupModel->getAgriculturGroupByFarmer($farmer_id, $type_of_agriculture_id);                              
                          @endphp
                          <div class="">
                             <table class="display table table-sm table-striped table-bordered" style="font-size: 12px">
                              <thead>
                                 <tr class="text-center">
                                                <th rowspan="2">NO</th>
                                                <th rowspan="2">LUAS LAHAN / m <sup>2</sup> </th>
                                                <th rowspan="2">ALAMAT LAHAN</th>
                                                <th rowspan="2">JENIS BIBIT</th>
                                                <th colspan="2">BIBIT DITANAM</th>
                                                <th rowspan="2">TOTAL BIAYA (Rp)</th>
                                            </tr>
                                            <tr>
                                                <th>KG</th>
                                                <th>SATUAN</th>
                                            </tr>
                              </thead>
                              <tbody>
                               @foreach ($detail as $details)
                                            <tr>
                                                <td>{{$no_type++}}</td>
                                                
                                                <td align="right">{{$provider->decimalFormat($details->land_area)}}</td>
                                                <td>Ds. {{$details->village}}, Kec. {{$details->district}}, {{$details->regency}}</td>
                                                <td>{{$details->type_of_seed}}</td>
                                                <td align="right">{{$provider->decimalFormat($details->total_kg)}}</td>
                                                <td align="right">{{$provider->decimalFormat($details->total_satuan)}}</td>
                                                <td align="right">{{$provider->decimalFormat($details->total_all_biaya)}}</td>
                                            </tr>
                                @endforeach
                                @php
                                    $farmer_id = $farmer->farmer_id;
                                    $type_of_agriculture_id = $farmer->type_of_agriculture_id;
                                    $total   = $agricultureGroupModel->getTotalAgriculturGroupByFarmer($farmer_id, $type_of_agriculture_id);
                                @endphp
                                  <tr style="background-color: #0e7d7d" class="text-white">
                                                  <td colspan=""><b>Jumlah</b></td>
                                                  <td colspan="" align="right"><b>{{$provider->decimalFormat($total->luas_lahan)}}</b></td>
                                                  <td></td>
                                                  <td></td>
                                                  <td align="right">{{$total->total_kg}}</td>
                                                  <td align="right"><b>{{$total->total_satuan}}</b></td>
                                                  <td colspan="1" align="right">{{$provider->decimalFormat($total->total_all_biaya)}}</b></td>
                                  </tr>
                              </tbody>
                              </table>
                          </div>
                          @endforeach
                      </div>
                      {{-- /petani --}}

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
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.jqueryui.min.js"></script>
<script>
    $(document).ready(function() {
    $('#data').DataTable();
} );
</script>    
@endpush