@extends('layouts.admin')
@push('addon-style')
   <style>
    .required{
        color: red;
    }
</style> 
@endpush
@section('title')
    Intani Banten
@endsection

@section('content')
    <!-- Page Content -->
<div class="page-content page-auth">
      <div class="section-store-auth" data-aos="fade-down">
        <div class="container">
          @include('layouts.message')
          <div class="card">
            <div class="card-body">
                <h5 class="mb-3">Tambah Petani</h5>
              <div class="col-lg-12">
                <form action="{{ route('member-management-farmer-update', $member->id) }}" method="POST" id="register" enctype="multipart/form-data">
                  @csrf
                  <div class="row row-login">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <span class="required">*</span>
                          <label>NIK</label>
                          <input
                            type="text"
                            class="form-control is-valid"
                            name="nik"
                            value="{{ $member->nik }}" 
                            readonly
                          />
                        </div>
                        <div class="form-group">
                            <span class="required">*</span>
                          <label>Nama</label>
                          <input
                            type="text"
                            name="name"
                            class="form-control"
                            value="{{ $member->name }}"
                          />
                        </div>
                        <div class="form-group">
                            <div class="row">
                              <div class="col-md-5">
                            <span class="required">*</span>
                                <label>Tempat</label>
                                <input
                                  type="text"
                                  name="place_of_berth"
                                  class="form-control"
                                  value="{{ $member->place_of_berth }}"
                                />

                              </div>
                               <div class="col-md-7">
                            <span class="required">*</span>
                                <label>Tgl Lahir</label>
                                <input
                                  type="date"
                                  name="date_of_berth"
                                  class="form-control"
                                  value="{{ $member->date_of_berth }}"
                                />
                              </div>
                            </div>
                          </div>
                        <div class="form-group">
                            <span class="required">*</span>
                          <label>Jenis Kelamin</label>
                           <select name="gender" class="form-control">
                              <option value="1" {{ $member->gender == '1' ? 'selected' : '' }}>Pria</option>
                              <option value="0" {{ $member->gender == '0' ? 'selected' : '' }}>Wanita</option>
                            </select>
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
                          <textarea name="address" class="form-control">{{ $member->address }}</textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                         <div class="form-group">
                            <span class="required">*</span>
                          <label>No. Telp</label>
                          <input
                            type="number"
                            name="phone_number"
                            class="form-control"
                            value="{{ $member->phone_number }}"
                            
                          />
                        </div>
                        <div class="form-group">
                          <label>No. Whatsapp</label>
                          <input
                            type="number"
                            name="wa_number"
                            class="form-control"
                            value="{{ $member->wa_number }}"
                          />
                        </div>
                         <div class="form-group">
                          <label>Facebook</label>
                          <input
                            type="text"
                            name="sosmed_facebook"
                            class="form-control"
                            value="{{ $member->sosmed_facebook }}"
                          />
                        </div>
                         <div class="form-group">
                          <label>Instagram</label>
                          <input
                            type="text"
                            name="sosmed_instagram"
                            class="form-control"
                            value="{{ $member->sosmed_instagram }}"                            
                          />
                        </div>
                         <div class="form-group">
                          <label>Youtube</label>
                          <input
                            type="text"
                            name="sosmed_youtube"
                            class="form-control"
                            value="{{ $member->sosmed_youtube }}"

                          />
                        </div>
                         <div class="form-group">
                            <span class="required">*</span>
                          <label>Foto Petani</label>
                          <input
                            type="file"
                            name="photo"
                            class="form-control"
                          />
                        </div>
                         <div class="form-group">
                            <span class="required">*</span>
                          <label>Foto KTP</label>
                          <input
                            type="file"
                            name="photo_idcard"
                            class="form-control"
                          />
                        </div>
                        <div class="form-group">
                          <label>Foto Kartu Keluarga</label>
                          <input
                            type="file"
                            name="photo_family_card"
                            class="form-control"
                          />
                        </div>
                    </div>
                      <button
                      type="submit"
                        class="btn btn-try custom-button text-white  btn-block w-00 mt-4"
                      >
                        Ubah
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
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
        },
        data(){
          return  {
            email: "",
            email_unavailable: false,
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
          checkForNikAvailability: function(){
            var self = this;
            axios.get('{{ route('api-nik-check') }}', {
              params:{
                nik:this.nik
              }
            })
              .then(function (response) {

                if(response.data == 'Available'){
                    self.$toasted.show(
                        "NIK Anda tersedia, silahkan lanjut langkah selanjutnya!",
                        {
                          position: "top-center",
                          className: "rounded",
                          duration: 2000,
                        }
                    );
                    self.nik_unavailable = false;

                }else{
                    self.$toasted.error(
                      "Maaf, NIK Anda sudah terdaftar pada sistem kami.",
                      {
                        position: "top-center",
                        className: "rounded",
                        duration: 2000,
                      }
                  );
                  self.nik_unavailable = true;

                }
                  // handle success
                  console.log(response);
                });
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