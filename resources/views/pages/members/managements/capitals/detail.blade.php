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
                        <h6>Detail Permodalan Berdasarkan Investor : {{ $investor->investor_name }}</h6>
                        <h6>Untuk Jenis Pertanian</h6>
                      </div>
                      <hr>
                       <div class="col-md-12">
                        @foreach ($farmer as $farmer)
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
                              @php
                                  $farmer_id    = $farmer->farmer_id;
                                  $investor_id  = $farmer->investor_id;
                                  $capitals     = $capitalModel->getTotalCapitalByAgriculturGroup($farmer_id, $investor_id);
                              @endphp
                              <div class="table table-responsive">
                            <table id="myTable" class="table table-striped table-bordered table-sm" style="width:100%; font-size:12px">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>JENIS PERTANIAN</th>
                                        <th>JUMLAH UANG (Rp)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($capitals as $row)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$row->name_type}}</td>
                                        <td class="text-right">{{$provider->decimalFormat($row->total)}}</td>
                                    </tr>
                                    @endforeach
                                     @php
                                        $total_capital  = $capitalModel->getTotalByInvestor($farmer_id, $investor_id);
                                    @endphp
                                </tbody>
                                <tfoot>
                                  @foreach ($total_capital as $item)
                                    <tr style="background-color: #0e7d7d" class="text-white">
                                        <td colspan="2">Total</td>
                                        <td align="right">{{$provider->decimalFormat($item->total)}}</td>
                                    </tr>
                                    @endforeach
                                </tfoot>
                            </table>
                        </div>
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