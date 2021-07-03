@extends('layouts.app')
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
          <div class="card">
            <div class="card-header">
                <h5 class="text-center">Daftar Anggota Intani Banten</h5>
            </div>
            <div class="card-body">
              <div class="col-lg-12">
                <form action="{{ route('register.member.store') }}" method="POST" id="register" enctype="multipart/form-data">
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
                            v-model="nik"
                            @change="checkForNikAvailability()"
                            type="nik" 
                            class="form-control @error('nik') is-invalid @enderror"
                            :class="{'is_invalid' : this.nik_unavailable}" 
                            name="nik" 
                            value="{{ old('nik') }}" 
                            required
                            autofocus
                          />
                        </div>
                        <div class="form-group">
                            <span class="required">*</span>
                          <label>Nama</label>
                          <input
                            type="text"
                            name="name"
                            class="form-control"
                          />
                        </div>
                        <div class="form-group">
                            <span class="required">*</span>
                          <label for="professional_category_id">Profesi</label>
                           <select class="form-control select2" name="professional_category_id" id="professional_category_id" required v-model="professional">
                              <option value="">-Pilih Profesi-</option>
                              @foreach ($professional_category as $row)
                              <option value="{{ $row->id }}">{{ $row->name }}</option>
                              @endforeach
                              </select>
                              @error('professional_category_id')
                              <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                        </div>
                        <div class="form-group">
                            <span class="required">*</span>
                            <div class="row">
                              <div class="col-md-5">
                                <label>Tempat</label>
                                <input
                                  type="text"
                                  name="place_of_berth"
                                  class="form-control"
                                />

                              </div>
                               <div class="col-md-7">
                            <span class="required">*</span>
                                <label>Tgl Lahir</label>
                                <input
                                  type="date"
                                  name="date_of_berth"
                                  class="form-control"
                                />
                              </div>
                            </div>
                          </div>
                        <div class="form-group">
                            <span class="required">*</span>
                          <label>Jenis Kelamin</label>
                           <select name="gender" class="form-control">
                              <option value="1">Pria</option>
                              <option value="0">Wanita</option>
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
                          <textarea name="address" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                          <label>Minat Sebagai</label>
                            <sup>(Tidak Wajib)</sup>
                           <select name="interest" class="form-control">
                             <option value="">-Pilih-</option>
                             <option value="Investor">Investor</option>
                             <option value="Nelayan">Nelayan</option>
                             <option value="Pembudidaya">Pembudidaya</option>
                             <option value="Petani">Petani</option>
                            </select>
                        </div>

                         <div class="form-group">
                            <span class="required">*</span>
                          <label>No. Telp</label>
                          <input
                            type="number"
                            name="phone_number"
                            class="form-control"
                          />
                        </div>
                        <div class="form-group">
                          <label>No. Whatsapp</label>
                          <input
                            type="number"
                            name="wa_number"
                            class="form-control"
                          />
                        </div>
                         <div class="form-group">
                          <label>Facebook</label>
                          <input
                            type="text"
                            name="sosmed_facebook"
                            class="form-control"
                          />
                        </div>
                         <div class="form-group">
                          <label>Instagram</label>
                          <input
                            type="text"
                            name="sosmed_instagram"
                            class="form-control"
                          />
                        </div>
                         <div class="form-group">
                          <label>Youtube</label>
                          <input
                            type="text"
                            name="sosmed_youtube"
                            class="form-control"
                          />
                        </div>
                         <div class="form-group">
                            <span class="required">*</span>
                          <label>Foto Anggota</label>
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
                            <span class="required">*</span>
                          <label>Email</label>
                          <input id="email" 
                            v-model="email"
                            @change="checkForEmailAvailability()"
                            type="email" 
                            class="form-control @error('email') is-invalid @enderror"
                            :class="{'is_invalid' : this.email_unavailable}" 
                            name="email" 
                            value="{{ old('email') }}" 
                            required
                            autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <span class="required">*</span>
                          <label>Password</label>
                          <input type="password" name="password" class="form-control" />
                        </div>
                    </div>
                      <button
                      type="submit"
                        class="btn btn-try custom-button text-white  btn-block w-00 mt-4"
                      >
                        Daftar
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
@push('prepend-script')
    <div class="modal" id="addCdCat" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Buat Kelompok Pertanian</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('add.agricultur') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Nama Kelompok Pertanian</label>
                <input type="text" name="name" class="form-control form-control-sm" placeholder="Talas, Jahe, Porang, dll..">
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-sm custom-button btn-success">Simpan</button>
      </div>
    </form>
    </div>
  </div>
</div>
@endpush
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

          checkForEmailAvailability: function(){
            var self = this;
            axios.get('{{ route('api-register-check') }}', {
              params:{
                email:this.email
              }
            })
              .then(function (response) {

                if(response.data == 'Available'){
                    self.$toasted.show(
                        "Email Anda tersedia, silahkan lanjut langkah selanjutnya!",
                        {
                          position: "top-center",
                          className: "rounded",
                          duration: 2000,
                        }
                    );
                    self.email_unavailable = false;

                }else{
                    self.$toasted.error(
                      "Maaf, tampaknya email sudah terdaftar pada sistem kami.",
                      {
                        position: "top-center",
                        className: "rounded",
                        duration: 2000,
                      }
                  );
                  self.email_unavailable = true;

                }
                  // handle success
                  console.log(response);
                });
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