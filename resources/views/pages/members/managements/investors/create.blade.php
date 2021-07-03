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
              @include('layouts.message')
              <div class="dashboard-content">
                <div class="card mb-2 shadow p-3 bg-light rounded">
                  <div class="card-body">
                  <h5 class="mb-3">Tambah Investor</h5>
                    <form action="{{ route('member-management-investor-save') }}" method="POST" enctype="multipart/form-data" id="register">
                      @csrf
                     <div class="form-group">
                        <p>Jenis Pengelola ?</p>
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
                           Instansi
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
                           Individu
                         </label>
                       </div>
                       
                      </div>
                      <div class="form-group" v-if="is_manager == false">
                       <label>Nama Instansi</label>
                       <input type="text" name="name_agency" class="form-control" autofocus />
                     </div>
                     <div class="form-group">
                       <label>Nama Investor</label>
                       <input type="text" name="name" class="form-control" autofocus />
                     </div>
  
                      <div class="form-group">
                            <label>Jenis Kelamin</label>
                             <select class="form-control select2" name="gender" required>
                              <option value="">-Pilih jenis kelamin-</option>
                              <option value="0">Perempuan</option>
                              <option value="1">Laki-laki</option>
                             </select>
                     </div>
                      <div class="form-group">
                              <label for="provinces_id">Provinsi</label>
                              <select id="provinces_id" class="form-control" v-model="provinces_id" v-if="provinces">
                                  <option v-for="province in provinces" :value="province.id">@{{ province.name }}</option>
                              </select>
                      </div>
                      <div class="form-group">
                            <label for="regencies_id">Kabupaten</label>
                            <select id="regencies_id" class="form-control" v-model="regencies_id" v-if="regencies">
                              <option v-for="regency in regencies" :value="regency.id">@{{ regency.name }}</option>
                            </select>
                      </div>
                      <div class="form-group">
                            <label for="districts_id">Kecamatan</label>
                            <select id="districts_id" class="form-control" v-model="districts_id" v-if="districts">
                              <option v-for="district in districts" :value="district.id">@{{ district.name }}</option>
                            </select>
                      </div>
                      <div class="form-group">
                            <label for="villages_id">Desa</label>
                            <select name="village_id" id="villages_id" class="form-control" v-model="villages_id" v-if="districts">
                              <option v-for="village in villages" :value="village.id">@{{ village.name }}</option>
                            </select>
                      </div>
                       
                      <div class="form-group">
                            <label>No. Telp</label>
                            <input
                              type="number"
                              name="phone_number"
                              class="form-control"
                            />
                          </div>
                          <div class="form-group">
                              <label>Alamat</label>
                              <textarea class="form-control" name="address" required></textarea>
                          </div>
                      <div class="form-group">
                        <button
                            type="submit"
                            class="btn btn-try custom-button text-white  btn-block w-00 mt-4"
                            >
                            Simpan dan lanjutkan
                            </button>
                     </div>                  
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
<script src="{{ asset('vendor/vue/vue.js') }}"></script>
<script src="https://unpkg.com/vue-toasted"></script>
<script src="{{ asset('vendor/axios/axios.min.js') }}"></script>
<script>
  var register = new Vue({
        el: "#register",
        mounted() {
          AOS.init();
          this.getProvincesData();
        },
        data(){
          return  {
            is_manager: true,
            provinces: null,
            regencies: null,
            districts: null,
            villages:null,
            provinces_id: null,
            regencies_id: null,
            districts_id: null,
            villages_id: null
          }
        },
        methods:{
          getProvincesData(){
                    var self = this;
                    axios.get('{{ route('api-provinces') }}')
                    .then(function(response){
                        self.provinces = response.data
                    })
                },
          getRegenciesData(){
                    var self = this;
                    axios.get('{{ url('api/regencies') }}/' + self.provinces_id)
                    .then(function(response){
                        self.regencies = response.data
                    })

                },
          getDistrictsData(){
                var self = this;
                 axios.get('{{ url('api/districts') }}/' + self.regencies_id)
                    .then(function(response){
                        self.districts = response.data
                    })
          },
           getVillagesData(){
                var self = this;
                 axios.get('{{ url('api/villages') }}/' + self.districts_id)
                    .then(function(response){
                        self.villages = response.data
                    })
          },
        },
        watch:{
                provinces_id: function(val,oldval){
                    this.regencies_id = null;
                    this.getRegenciesData();
                },
                 regencies_id: function(val,oldval){
                    this.districts_id = null;
                    this.getDistrictsData();
                },
                districts_id: function(val,oldval){
                    this.villages_id = null;
                    this.getVillagesData();
                },
            },
      });
</script>
@endpush