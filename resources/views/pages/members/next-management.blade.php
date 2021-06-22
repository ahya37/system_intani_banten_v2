@extends('layouts.admin')
@section('title')
    Intani Banten
@endsection
@push('addon-style')
          <link href="{{ asset('css/home.css') }}" rel="stylesheet" />
@endpush
@section('content')
<!-- Page Content -->
<div class="page-content page-home" data-aos="fade-down" id="manager">
      <div id="page-content-wrapper" style="min-height: 70vh">
        <div class="page-content">
          <div class="container">
            @include('layouts.message')
            <div class="dashboard-content">
              <div class="card mb-2 shadow p-3 bg-light rounded">
                <div class="card-body">
                  <form action="{{ route('member-next-management-save') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <p class="text-muted">Apakah Anda pengelolanya ?</p>
                      <div
                       class="custom-control custom-radio custom-control-inline"
                     >
                       <input
                         type="radio"
                         class="custom-control-input"
                         name="is_manager"
                         id="isManagerFalse"
                         v-model="is_manager"
                         :value="false"
                       />
                       <label for="isManagerFalse" class="custom-control-label">
                         Orang Lain
                       </label>
                     </div>
                      <div
                       class="custom-control custom-radio custom-control-inline"
                     >
                       <input
                        type="radio"
                         class="custom-control-input"
                         name="is_manager"
                         id="isManagerTrue"
                         v-model="is_manager"
                         :value="true"
                       />
                       <label for="isManagerTrue" class="custom-control-label">
                         Ya, saya sendiri
                       </label>
                     </div>
                     
                    </div>
                    <div class="form-group" v-if="is_manager == false">
                     <label>Nama Pengelola</label>
                     <input type="text" name="name" class="form-control" autofocus />
                   </div>
                    <div class="form-group" v-if="is_manager == false">
                     <label>Alamat</label>
                    <textarea class="form-control" name="address"></textarea>
                   </div>
                   <div class="form-group">
                     <button
                      type="submit"
                        class="btn btn-try custom-button text-white  btn-block w-00 mt-4"
                      >
                        Simpan dan lanjutkan
                    </button></div>                  
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
@push('addon-script')
<script src="{{ asset('vendor/jquery/jquery.slim.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="{{ asset('vendor/vue/vue.js') }}"></script>
    <script src="https://unpkg.com/vue-toasted"></script>
<script>
  var manager = new Vue({
    el: "#manager",
    data: {
      is_manager: true,
    },
  });
</script>
@endpush