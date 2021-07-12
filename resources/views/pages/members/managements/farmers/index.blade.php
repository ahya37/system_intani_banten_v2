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
                        <h6 class="mb-4">Data Petani</h6>
                      </div>
                      <div class="col-md-12">
                          <div class="table-responsive">
                             <table id="data" class="display table table-sm table-striped">
                              <thead>
                                  <tr>
                                  <th scope="col">No</th>
                                  <th scope="col">Foto</th>
                                  <th scope="col">Nama</th>
                                  <th scope="col">Alamat</th>
                                  <th scope="col">No. Telp</th>
                                  <th scope="col">Pilihan</th>
                                  </tr>
                              </thead>
                              <tbody>
                                 @foreach ($farmer as $row)
                                 <tr>
                                     <td>{{ $no++ }}</td>
                                     <td>
                                         <img src="{{ asset('storage/'. $row->photo) }}" width="40" alt="{{ $row->farmer_name }}">
                                     </td>
                                     <td>{{ $row->farmer_name }}</td>
                                     <td>{{'Ds'.$row->village.', Kec.'.$row->district. ' ,'. $row->regency }}</td>
                                     <td>{{ $row->phone_number }}</td>
                                     <td>
                                              <a href="{{ route('member-management-farmer-detail', $row->member_id) }}" class="btn btn-sm custom-button text-white">Detail</a>
                                              <a href="{{ route('member-management-farmer-edit', $row->member_id) }}" class="btn btn-sm custom-button text-white">Edit</a>
                                      </td>
                                 </tr>                                     
                                 @endforeach
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