@extends('layouts.admin')
@section('title')
    Intani Banten
@endsection
@push('addon-style')
   <style>
    .required{
        color: red;
    }
</style>  
@endpush
@section('content')
    <!-- Page Content -->
<div class="page-content page-auth">
      <div class="section-store-auth" data-aos="fade-down">
        <div class="container">
          @include('layouts.message')
          <div class="card">
            <div class="card-body">
                <h5 class="mb-4">Kelompok Pertanian</h5>
              <div class="col-lg-12">
                <form action="{{ route('member-management-agriculturalgroup-save') }}" method="POST" id="register" enctype="multipart/form-data">
                  @csrf
                  <div class="row row-login">
                    <div class="col-lg-6">
                         <div class="form-group">
                            <span class="required">*</span>
                          <label for="farmer_id">Petani</label>
                          <select id="farmer_id" name="farmer_id" class="form-control" v-model="farmer_id" v-if="farmers">
                            <option v-for="farmer in farmers" :value="farmer.id">@{{ farmer.member.name }}</option>
                          </select>
                        </div>
                        <div class="form-group">
                            <span class="required">*</span>
                          <label>Jenis Pertanian</label>
                          <select id="type_of_agriculture_id" name="type_of_agriculture_id" class="form-control" v-model="type_of_agriculture_id" v-if="type_of_agricultures">
                            <option v-for="type_of_agriculture in type_of_agricultures" :value="type_of_agriculture.id">@{{ type_of_agriculture.name_type }}</option>
                          </select>
                        </div>
                        <div class="form-group">
                            <label>Luas / m<sup>2</sup></label>
                            <input
                                  type="text"
                                  name="land_area"
                                  class="form-control"
                                />
                        </div>
                        <div class="form-group">
                            <span class="required">*</span>

                          <label for="provinces_id">Provinsi</label>
                          <select id="provinces_id" class="form-control" v-model="provinces_id" v-if="provinces">
                            <option v-for="province in provinces" :value="province.id">@{{ province.name }}</option>
                          </select>
                        </div>
                        <div class="form-group">
                            <span class="required">*</span>

                          <label for="regencies_id">Kabupaten</label>
                          <select id="regencies_id" class="form-control" v-model="regencies_id" v-if="regencies">
                            <option v-for="regency in regencies" :value="regency.id">@{{ regency.name }}</option>
                          </select>
                        </div>
                        <div class="form-group">
                            <span class="required">*</span>

                          <label for="districts_id">Kecamatan</label>
                          <select id="districts_id" class="form-control" v-model="districts_id" v-if="districts">
                            <option v-for="district in districts" :value="district.id">@{{ district.name }}</option>
                          </select>
                        </div>
                        <div class="form-group">
                            <span class="required">*</span>

                          <label for="villages_id">Desa</label>
                          <select name="village_id" id="villages_id" class="form-control" v-model="villages_id" v-if="districts">
                            <option v-for="village in villages" :value="village.id">@{{ village.name }}</option>
                          </select>
                        </div>
                        <div class="form-group">
                            <span class="required">*</span>

                          <label for="">Alamat</label>
                          <textarea name="address_area" class="form-control" required placeholder="Jl. gedung, dsb.."></textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                         <div class="form-group">
                            <span class="required">*</span>

                          <label>Foto Lokasi Lahan</label>
                          <input
                            type="file"
                            name="photo_area"
                            class="form-control"
                          />
                        </div>
                        <div class="form-group">
                            <span class="required">*</span>

                          <label>Nama Pemilik Lahan</label>
                          <input
                            type="text"
                            name="land_owner"
                            class="form-control"
                          />
                        </div>
                         <div class="form-group">

                          <label>Nomor Sertifikat Lahan</label>
                          <input
                            type="text"
                            name="land_certificate_number"
                            class="form-control"
                          />
                        </div>
                         <div class="form-group">
                          <label>Upload Sertifikat</label>
                          <span><sup>(Tidak wajib)</sup></span>
                          <input
                            type="file"
                            name="proof_land_ownership"
                            class="form-control"
                          />
                        </div>
                         <div class="form-group">
                            <span class="required">*</span>

                          <label>Jenis Bibit</label>
                          <input
                            type="text"
                            name="type_of_seed"
                            class="form-control"
                          />
                        </div>
                         <div class="form-group">
                            <span class="required">*</span>

                           <label>Jumlah Bibit Yang Ditanam</label>
                           <div class="row">
                             <div class="col-md-5">
                               <input
                                 type="number"
                                 name="number_of_seeds"
                                 class="form-control"
                               />
                             </div>
                             <div class="col-md-7">
                               <select id="unit" name="unit" id="" class="form-control" required>
                                  <option value="kg">Kg</option>
                                  <option value="satuan">Satuan</option>
                               </select>
                             </div>
                           </div>
                        </div>
                        <div class="form-group">
                            <span class="required">*</span>

                          <label>Asal Bibit</label>
                          <input
                            type="text"
                            name="origin_of_seed"
                            class="form-control"
                          />
                        </div>
                        <div class="form-group">
                            <span class="required">*</span>

                          <label>Tanggal Tanam</label>
                          <input
                            type="date"
                            name="planting_date"
                            class="form-control"
                          />
                        </div>
                        <div class="form-group">

                            <label>Masalah</label>
                            <textarea name="problem" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                          <label>
                            <h6><b>Perencanaan Panen :</b></h6>
                          </label>
                        </div>
                        <div class="form-group">
                            <span class="required">*</span>
                            <label>Tahap Ke : 1</label>
                            <input
                            type="text"
                            readonly
                            name="step"
                            value="1"
                            class="form-control"
                          />
                        </div>
                        <div class="form-group">
                            <span class="required">*</span>
                            <label>Jenis Panen</label>
                            <input
                            type="text"
                            name="type_harvest"
                            class="form-control"
                            placeholder="Contoh: Daun, Ubi, Bibit"
                          />
                        </div>
                         <div class="form-group">
                            <span class="required">*</span>

                          <label>Tanggal Panen</label>
                          <input
                            type="date"
                            name="date"
                            class="form-control"
                          />
                        </div>
                        <div class="form-group">
                            <span class="required">*</span>

                           <label>Jumlah</label>
                           <div class="row">
                             <div class="col-md-5">
                               <input
                                 type="number"
                                 name="qty"
                                 class="form-control"
                               />
                             </div>
                             <div class="col-md-7">
                               <select id="unit" name="unit" id="" class="form-control" required>
                                  <option value="kg">Kg</option>
                                  <option value="satuan">Satuan</option>
                               </select>
                             </div>
                           </div>
                        </div>
                        <div class="form-group">
                            <span class="required">*</span>

                          <label>Estimasi Harga Jual / Kg</label>
                          <input
                            type="number"
                            name="estimated_selling_price"
                            class="form-control"
                          />
                        </div>
                        <div class="form-group">
                                                <div class="col-md-12">
                                                    <p>
                                                    <span class="required">*</span>
                                                        Tahap Selanjutnya bisa di tambahkan setelah mengisi / menyimpan tahap ke 1 (Pertama)</p>
                                                </div>
                                            </div>
                    </div>
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
@endsection
@push('addon-script')
<script src="{{ asset('vendor/vue/vue.js') }}"></script>
<script src="https://unpkg.com/vue-toasted"></script>
<script src="{{ asset('vendor/axios/axios.min.js') }}"></script>

<script>
      Vue.use(Toasted);

      var register = new Vue({
        el: "#register",
        mounted() {
          AOS.init();
          this.getProvincesData();
          this.getTypeOfAgricultur();
          this.getFarmerData()
        },
        data(){
          return  {
            provinces: null,
            regencies: null,
            districts: null,
            villages:null,
            farmers: null,
            farmer_id: null,
            provinces_id: null,
            regencies_id: null,
            districts_id: null,
            villages_id: null,
            type_of_agricultures: null,
            type_of_agriculture_id: null,
          }
        },
        methods:{
          getFarmerData(){
              var self = this;
              axios.get('{{ route('member-management-farmer-api') }}')
              .then(function(response){
                  self.farmers = response.data
              })
          },

          getTypeOfAgricultur(){
            var self = this;
            axios.get('{{ route('api-typeofagricultur') }}')
            .then(function(response){
              self.type_of_agricultures = response.data
            })
          },
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