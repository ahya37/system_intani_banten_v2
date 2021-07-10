@extends('layouts.admin')
@section('title')
    Intani Banten
@endsection
@push('addon-style')
          <link href="{{ asset('css/home.css') }}" rel="stylesheet" />
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
                        <h6>Detail Petani Berdasarkan Investor</h6>
                        <h6 class="mb-4">{{ $investor->investor_name }}</h6>
                        <small>Petani yang diberi permodalan</small>
                      </div>
                      <div class="col-md-12">
                          <div class="table-responsive">
                            @foreach ($farmer as $row)
                            <table class="" style="font-size: 14px">
                            <thead>
                                    <tr>
                                        <td><b>NAMA PETANI</b></td>
                                        <td>:</td>
                                        <td><b>{{ $row->farmer_name }}</b></td>
                                    </tr>
                                    <tr>
                                        <td><b>ALAMAT PETANI</b></td>
                                        <td>:</td>
                                        <td><b>Ds. {{ $row->village }}, Kec.{{ $row->district }}, {{ $row->regency }}</b></td>
                                    </tr>
                                </thead>
                            </table>
                            @php
                            $farmer_id    = $row->farmer_id;
                            $investor_id  = $row->investor_id;
                            $farmerDetail = $investorModel->getDetailAgricultur($farmer_id, $investor_id);
                            @endphp
                             <div class="table table-responsive">
                                  <table class="display table table-sm table-striped table-bordered" style="font-size: 12px">
                                    <thead>
                                        <tr class="text-center">
                                            <th rowspan="2">JENIS PERTANIAN</th>
                                            <th rowspan="2">TANGGAL TANAM</th>
                                            <th rowspan="2">LUAS LAHAN / m <sup>2</sup> </th>
                                            <th rowspan="2">ALAMAT LAHAN</th>
                                            <th rowspan="2">JENIS BIBIT</th>
                                            <th colspan="2">BIBIT DITANAM</th>
                                            <th rowspan="2">TOTAL BIAYA (Rp)</th>
                                            <th rowspan="2">PERENCANAAN PANEN</th>
                                        </tr>
                                        <tr>
                                            <th>KG</th>
                                            <th>SATUAN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($farmerDetail as $item)
                                        <tr>
                                            <td>{{ $item->name_type }}</td>
                                            <td>{{ date('d-m-Y', strtotime($item->tgl_tanam)) }}</td>
                                            <td class="text-right">{{ $provider->decimalFormat($item->land_area) }}</td>
                                            <td>Ds.{{ $item->village.', Kec.' .$item->district.', '.$item->regency }}</td>
                                            <td>{{ $item->type_of_seed }}</td>
                                                                                    <td align="right">
                                            @if ($item->unit == 'kg')
                                                {{$provider->decimalFormat($item->number_of_seeds)}}
                                            @endif
                                        </td>
                                        <td align="right">
                                            @if ($item->unit == 'satuan')
                                                {{$provider->decimalFormat($item->number_of_seeds)}}
                                            @endif
                                        </td>
                                        <td align="right">
                                            <a href="{{ route('member-management-investor-capitalbreakdown', $item->agricultur_group_id) }}">
                                                {{$provider->decimalFormat($item->total_biaya)}}
                                            </a>
                                        </td>
                                         <td align="center">
                                            <a href="{{ route('member-management-investor-harvestplanning', $item->agricultur_group_id) }}" class="btn btn-sm custom-button text-white">Lihat</a>
                                        </td>
                                        </tr>
                                        @php
                                            $farmer_id    = $row->farmer_id;
                                            $investor_id  = $row->investor_id;
                                            $jumlah_total          = $investorModel->getJumlahTotal($farmer_id,$investor_id);
                                        @endphp
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                         <tr style="background-color: #0e7d7d" class="text-white">
                                            <td colspan=""><b>JUMLAH</b></td>
                                            <td colspan="2" align="right"><b>{{$provider->decimalFormat($jumlah_total->luas_lahan) }}</b></td>
                                            <td colspan="2"></td>
                                            <td align="right">{{$provider->decimalFormat($jumlah_total->bibit_ditanam_kg) }}</td>
                                            <td align="right"><b>{{$provider->decimalFormat($jumlah_total->bibit_ditanam_satuan) }}</b></td>
                                            <td colspan="1" align="right">{{$provider->decimalFormat($jumlah_total->total_biaya) }}</b></td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                    </table>
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
    </div>
@endsection