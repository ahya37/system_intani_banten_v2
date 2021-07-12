@extends('layouts.admin')
@section('title')
    Intani Banten
@endsection
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
                                 <tr>
                                  <td>Tanggal</td><td>:</td><td>{{ date('d-m-Y', strtotime($capital_breakdown->created_at)) }}</td>
                                </tr>
                              </tbody>                                 
                              </table>
                          </div>
                      </div>
                      <div class="col-md-12">
                          <div class="table-responsive">
                             <table id="data" class="table table-striped" style="font-size: 12px">
                                 <tbody>
                                    <tr>
                                      <td>Biaya Bibit</td>
                                      <td>:</td><td align="right">Rp. {{$provider->decimalFormat($capital_breakdown->cost_of_seeds) }}</td>
                                    </tr>
                                    <tr>
                                      <td>Biaya Sewa Lahan</td>
                                      <td>:</td><td align="right">Rp. {{ $provider->decimalFormat($capital_breakdown->rental_cost) }}</td>
                                    </tr>
                                    <tr>
                                      <td>Biaya Pengolahan Lahan</td>
                                      <td>:</td><td align="right">Rp. {{ $provider->decimalFormat($capital_breakdown->material_processing_costs) }}</td>
                                    </tr>
                                    <tr>
                                      <td>Biaya Penanaman</td>
                                      <td>:</td><td align="right">Rp. {{ $provider->decimalFormat($capital_breakdown->planting_costs) }}</td>
                                    </tr>
                                    <tr>
                                      <td>Biaya Pemeliharaan</td>
                                      <td>:</td><td align="right">Rp. {{ $provider->decimalFormat($capital_breakdown->maintenance_cost) }}</td>
                                    </tr>
                                    <tr>
                                      <td>Biaya Pupuk</td>
                                      <td>:</td><td align="right">Rp. {{ $provider->decimalFormat($capital_breakdown->fertilizer_costs) }}</td>
                                    </tr>
                                    <tr>
                                      <td>Biaya Panen</td>
                                      <td>:</td><td align="right">Rp. {{ $provider->decimalFormat($capital_breakdown->harvest_costs) }}</td>
                                    </tr>
                                    <tr>
                                      <td>Biaya lainnya</td>
                                      <td>:</td><td align="right">Rp. {{ $provider->decimalFormat($capital_breakdown->other_costs) }}</td>
                                    </tr>
                                    <tr>
                                      <td>Piutang</td>
                                      <td>:</td><td align="right">Rp. {{ $provider->decimalFormat($capital_breakdown->accounts_receivable) }}</td>
                                    </tr>
                                </tbody>
                                         <tr style="background-color: #0e7d7d" align="right" class="text-white">
                                            <td><b>JUMLAH</b></td>
                                            <td></td>
                                            <td>Rp. {{$provider->decimalFormat($total_jumlah->total) }}</td>
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
