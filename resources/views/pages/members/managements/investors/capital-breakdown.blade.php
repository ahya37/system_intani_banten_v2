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
                                  <td>Jenis Pertanian</td><td>:</td><td>{{ $farmer->name_type }}</td>
                                </tr>
                              </tbody>                                 
                              </table>
                          </div>
                      </div>
                      <div class="col-md-12">
                          <div class="table-responsive">
                             <table id="data" class="display table table-sm table-striped" style="font-size: 12px">
                                 <thead>
                                    <tr class="text-center">
                                        <th>Tanggal</th>
                                        <th>Biaya Bibit (Rp.)</th>
                                        <th>Biaya Sewa Lahan (Rp.)</th>
                                        <th>Biaya Pengolahan Lahan (Rp.)</th>
                                        <th>Biaya Penanaman (Rp.)</th>
                                        <th>Biaya Pemeliharaan (Rp.)</th>
                                        <th>Biaya Pupuk (Rp.)</th>
                                        <th>Biaya Panen (Rp.)</th>
                                        <th>Biaya lainnya (Rp.)</th>
                                        <th>Piutang (Rp.)</th>
                                        <th>Total (Rp.)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach ($capital_breakdown as $item)
                                      <tr class="text-right">
                                        <td>{{date('d-m-Y', strtotime($item->created_at)) }}</td>
                                        <td>{{$provider->decimalFormat($item->cost_of_seeds) }}</td>
                                        <td>{{$provider->decimalFormat($item->rental_cost) }}</td>
                                        <td>{{$provider->decimalFormat($item->material_processing_costs) }}</td>
                                        <td>{{$provider->decimalFormat($item->planting_costs) }}</td>
                                        <td>{{$provider->decimalFormat($item->maintenance_cost) }}</td>
                                        <td>{{$provider->decimalFormat($item->fertilizer_costs) }}</td>
                                        <td>{{$provider->decimalFormat($item->harvest_costs) }}</td>
                                        <td>{{$provider->decimalFormat($item->other_costs) }}</td>
                                        <td>{{$provider->decimalFormat($item->accounts_receivable) }}</td>
                                        <td>{{$provider->decimalFormat($item->total) }}</td>
                                      </tr>
                                  @endforeach
                                </tbody>
                                         <tr style="background-color: #0e7d7d" align="right" class="text-white">
                                            <td><b>JUMLAH</b></td>
                                            <td>{{$provider->decimalFormat($total_jumlah->cost_of_seeds) }}</td>
                                            <td>{{$provider->decimalFormat($total_jumlah->rental_cost) }}</td>
                                            <td>{{$provider->decimalFormat($total_jumlah->material_processing_costs) }}</td>
                                            <td>{{$provider->decimalFormat($total_jumlah->planting_costs) }}</td>
                                            <td>{{$provider->decimalFormat($total_jumlah->maintenance_cost) }}</td>
                                            <td>{{$provider->decimalFormat($total_jumlah->fertilizer_costs) }}</td>
                                            <td>{{$provider->decimalFormat($total_jumlah->harvest_costs) }}</td>
                                            <td>{{$provider->decimalFormat($total_jumlah->other_costs) }}</td>
                                            <td>{{$provider->decimalFormat($total_jumlah->accounts_receivable) }}</td>
                                            <td>{{$provider->decimalFormat($total_jumlah->total) }}</td>
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