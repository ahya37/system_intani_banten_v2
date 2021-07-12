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
                        <div class="col-md-12">
                          <h6>Perencanaan Panen</h6>
                          <div class="row">
                            <div class="col-md-6">
                            </div>
                            <div class="col-md-6 text-right">
                              <button class="btn btn-sm custom-button text-white" data-toggle="modal" data-target="#add{{$agricultur_group_id}}"><i class="fa fa-plus"></i> Tambah Perencanaan Panen</button>
                            </div>
                          </div>

                        </div>
                        <hr>
                        <div class="">
                             <table class="">
                               <tbody>
                                  <tr>
                                  <td>Petani </td><td>: &nbsp;</td><td>{{ $farmer->farmer_name }}</td>
                                <tr>
                                  <td>Jenis Pertanian </td><td>:&nbsp;</td><td>{{ $farmer->name_type }}</td>
                                </tr>
                                <tr>
                                  <td>Luas Lahan</td><td>:&nbsp;</td><td>{{$provider->decimalFormat($farmer->land_area) }} m<sup>2</sup></td>
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
                                </tbody>
                                <tfoot>
                                  
                                  <tr style="background-color: #0e7d7d" class="text-white">
                                    <td colspan="3">Total</td>
                                    <td>{{$provider->decimalFormat($total_harvest->jumlah_panen)}} kg</td>
                                    <td align="right">{{$provider->decimalFormat($total_harvest->estimasi_harga_jual)}}</td>
                                    <td align="right">{{$provider->decimalFormat($total_harvest->estimasi_keuntungan)}}</td>
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

@foreach ($harvest_planning as $row)
<div class="modal fade" id="add{{$agricultur_group_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Perencanaan Panen : {{ $farmer->name_type }} </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="{{ route('member-management-add-harvesplanning') }}" method="POST">
            @csrf
             <div class="form-group">
                <label for="step" class="col-md-4 col-form-label">{{ __('Tahap Ke : ') }}
                    <span class="required">*</span>
                </label>
                <div class="col-md-4">
                    <input type="hidden" value="{{$agricultur_group_id}}" class="form-control form-control-sm @error('step') is-invalid @enderror" name="agricultural_group_id">
                    <input id="step"  type="text" class="form-control form-control-sm @error('step') is-invalid @enderror" name="step" readonly autocomplete="step" value="{{$row->step + 1}}">
                </div>
            </div>

            <div class="form-group">
                <label for="type_harvest" class="col-md-4 col-form-label">{{ __('Jenis Panen') }}
                <span class="required">*</span>
                </label>
                <div class="col-md-10">
                    <input id="type_harvest" type="text" class="form-control form-control-sm @error('type_of_seed') is-invalid @enderror" name="type_harvest" value="{{ old('type_of_seed') }}"  autocomplete="type_of_seed" placeholder="Contoh: Daun, Ubi, Bibit">
                </div>
            </div>

            <div class="form-group">
                <label for="date" class="col-md-4 col-form-label">{{ __('Tanggal Panen') }}
                <span class="required">*</span>
                </label>
                <div class="col-md-10">
                    <input id="date" type="date" class="form-control form-control-sm @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}"  autocomplete="date">
                </div>
            </div>

            <div class="form-group">
                <label for="number_of_seeds" class="col-md-4 col-form-label">{{ __('Jumlah') }}
                <span class="required">*</span>
                </label>
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-8">
                            <input id="qty" type="text" class="number form-control form-control-sm @error('qty') is-invalid @enderror" name="qty" value="{{ old('qty') }}" required autocomplete="qty">
                        </div>
                        <div class="col-md-4">
                            <select id="unit" name="unit" id="" class="form-control form-control-sm">
                                <option value="kg">Kg</option>
                                <option value="satuan">Satuan</option>
                            </select>
                        </div>
                    </div>
                </div>
             </div>

             <div class="form-group">
                <label for="estimated_selling_price" class="col-md-4 col-form-label">{{ __('Estimasi Harga Jual / KG') }}
                <span class="required">*</span>
                </label>
                <div class="col-md-10">
                    <input id="estimated_selling_price" type="text" class="number form-control form-control-sm @error('estimated_selling_price') is-invalid @enderror" name="estimated_selling_price" value="{{ old('estimated_selling_price') }}"  autocomplete="estimated_selling_price">
                    @error('estimated_selling_price')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

      </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-sm custom-button text-white">Simpan</button>
        </div>
    </form>
    </div>
  </div>
</div>
@endforeach

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