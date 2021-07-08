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
                        <h6 class="mb-4">Data Kelompok Pertanian</h6>
                        <hr>

                      </div>
                      <div class="col-md-12">
                          <div class="table-responsive">
                             <table id="data" class="display table table-sm table-striped">
                              <thead>
                                 <tr class="text-center">
                                    <th rowspan="2">Jenis Pertanian</th>
                                    <th rowspan="2">Total Luas Lahan / m<sup>2</sup></th>
                                    <th colspan="2">Total Bibit Ditanam</th>
                                    <th rowspan="2">Total Biaya (Rp)</th>
                                    <th rowspan="2">Persentasi</th>
                                </tr>
                                <tr align="center">
                                    <th>KG</th>
                                    <th>Satuan</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach ($agriculture_group as $row)
                                <tr>
                                    <td>
                                       <a href="{{ route('member-management-agriculturalgroup-farmerbyagricultur', $row->type_of_agriculture_id) }}">{{$row->name_type}} </a>
                                    </td>
                                    <td align="right">{{$provider->decimalFormat($row->total_luas_lahan)}}</td>
                                    <td align="right">{{$provider->decimalFormat($row->total_kg)}}</td>
                                    <td align="right">{{$provider->decimalFormat($row->total_satuan)}}</td>
                                    <td align="right">{{$provider->decimalFormat($row->total_biaya)}}</td>
                                    <td align="right">
                                        @if($row->total_biaya != '')
                                        @php
                                            $persentage = ($row->total_biaya/$getTotal->total_all_biaya)*100 
                                        @endphp
                                        {{number_format($persentage)}} %
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                              </tbody>
                              <tfoot>
                                <tr class="bg-warning">
                                    <td><b>Total</b></td>
                                    <td align="right"><b>{{$provider->decimalFormat($getTotal->total_luas_lahan)}}</b></td>
                                    <td align="right"><b>{{$provider->decimalFormat($getTotal->total_kg)}}</b></td>
                                    <td align="right"><b>{{$provider->decimalFormat($getTotal->total_satuan)}}</b></td>
                                    <td align="right"><b>{{$provider->decimalFormat($getTotal->total_all_biaya)}}</b></td>
                                    <td align="right"><b>{{$provider->decimalFormat($total_persentage)}} %</b></td>
                                </tr>
                              </tfoot>
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