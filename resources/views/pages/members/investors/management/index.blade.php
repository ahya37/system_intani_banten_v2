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
                        <h6>Data Pengelola</h6>
                        <hr>
                      </div>
                      <div class="col-md-12">
                          <div class="table-responsive">
                             <table id="data" class="display table table-sm table-striped">
                              <thead>
                                  <tr>
                                  <th scope="col">No</th>
                                  <th scope="col">Foto</th>
                                  <th scope="col">Nama Pengelola</th>
                                  <th scope="col">Alamat</th>
                                  <th scope="col">No. Telp</th>
                                  <th scope="col">Pilihan</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @foreach ($management as $row)
                                      <tr>
                                          <td>{{ $no++ }}</td>
                                          <td>
                                              <img src="{{ asset('storage/'. $row->manager_photo) }}" width="40" alt="{{ $row->manager_name }}">
                                          </td>
                                          <td>{{ $row->manager_name }}</td>
                                          <td>{{ $row->address }}</td>
                                          <td>{{ $row->phone_number }}</td>
                                          <td>
                                              <a href="{{ route('member-investor-management-farmer', $row->management_id) }}" class="btn btn-sm custom-button text-white">Petani</a>
                                              <a class="btn btn-sm custom-button text-white">Kelompok Pertanian</a>
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