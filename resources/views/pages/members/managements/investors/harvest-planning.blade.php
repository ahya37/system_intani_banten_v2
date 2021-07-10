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
                        <h6 class="mb-4">Rincian Biaya Pertanian</h6>
                        <hr>
                        <div class="">
                             <table class="">
                               <tbody>
                                <tr>
                                  <td>Petani</td><td>:</td><td>{{ $farmer->farmer_name }}</td>
                                </tr>
                                <tr>
                                  <td>Luas Lahan</td><td>:</td><td>{{$provider->decimalFormat($farmer->land_area) }} m<sup>2</sup></td>
                                </tr>
                              </tbody>                                 
                              </table>
                          </div>
                      </div>
                      <div class="col-md-12">
                          <div class="table-responsive">
                             <table id="data" class="display table table-sm table-striped">
                              <thead>
                                  <tr>
                                  <th scope="col">Tahap</th>
                                  <th scope="col">Jenis Dipanen</th>
                                  <th scope="col">Tanggal Panen</th>
                                  <th scope="col">Jumlah</th>
                                  <th scope="col">Estimasi Harga Jual / Kg (Rp)</th>
                                  <th scope="col">Estimasi Pendapatan (Rp)</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @foreach ($harvest_planning as $row)
                                      <tr>
                                        <td>{{$row->step}}</td>
                                        <td>{{$row->type_harvest}}</td>
                                        <td>{{date('d-m-Y', strtotime($row->date))}}</td>
                                        <td>{{$provider->decimalFormat($row->qty)}} {{$row->unit}}</td>
                                        <td align="right">{{$provider->decimalFormat($row->estimated_selling_price)}}</td>
                                        <td align="right">{{$provider->decimalFormat($row->total_income)}}</td>                                        
                                    </tr>
                                  @endforeach
                                  <tr style="background-color: #0e7d7d" class="text-white">
                                    <td colspan="3">Total</td>
                                    <td>{{$provider->decimalFormat($total_harvest->jumlah_panen)}} kg</td>
                                    <td align="right">{{$provider->decimalFormat($total_harvest->estimasi_harga_jual)}}</td>
                                    <td align="right">{{$provider->decimalFormat($total_harvest->estimasi_keuntungan)}}</td>
                                </tr>
                              </tbody>
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