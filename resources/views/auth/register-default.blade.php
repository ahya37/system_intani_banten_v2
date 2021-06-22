@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')
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
                          <label>NIK</label>
                          <input
                            type="text"
                            class="form-control is-valid"
                            name="nik"
                            autofocus
                          />
                        </div>
                        <div class="form-group">
                          <label>Nama</label>
                          <input
                            type="text"
                            name="name"
                            class="form-control"
                          />
                        </div>
                        <div class="form-group">
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

                        {{-- type profession --}}
                         {{-- <template v-if="professional == '1'">
                           <div class="form-group">
                              <span style="color: red">*</span>
                              <label>Kelompok Pertanian ?</label>
                               <input
                                type="text"
                                name="type_profesion"
                                class="form-control is-invalid"
                                v-model="type_profesion"
                                placeholder="contoh: ikan, udang dll"
                              />
                            </div>
                        </template>
                        <template v-if="professional == '2'">
                            <div class="form-group">
                              <span style="color: red">*</span>
                              <label>Kelompok Neleyan ?</label>
                              <input
                                type="text"
                                name="type_profesion"
                                class="form-control is-invalid"
                                v-model="type_profesion"
                                placeholder="contoh: ikan, udang dll"
                              />
                            </div>
                        </template>
                        <template v-if="professional == '8'">
                            <div class="form-group">
                              <span style="color: red">*</span>
                              <label>Kelompok Budidaya ?</label>
                              <input
                                type="text"
                                name="type_profesion"
                                class="form-control is-invalid"
                                v-model="type_profesion"
                                placeholder="contoh: ikan, udang dll"
                              />
                            </div>
                        </template>
                         <template v-if="professional == '6'">
                            <div class="form-group">
                              <span style="color: red">*</span>
                              <label>Kelompok Usaha ?</label>
                              <input
                                type="text"
                                name="type_profesion"
                                class="form-control is-invalid"
                                v-model="type_profesion"
                                placeholder="contoh: pengusaha pertanian, pengusaha retail, dll"
                              />
                            </div>
                        </template>
                        <template v-if="professional == '5'">
                            <div class="form-group">
                              <span style="color: red">*</span>
                              <label>Kelompok Peternak ?</label>
                              <input
                                type="text"
                                name="type_profesion"
                                class="form-control is-invalid"
                                v-model="type_profesion"
                                placeholder="contoh: kambing, dll"
                              />
                            </div>
                        </template> --}}
                        {{-- type profession --}}

                        <div class="form-group">
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
                          <label>Jenis Kelamin</label>
                           <select name="gender" class="form-control">
                              <option value="1">Pria</option>
                              <option value="0">Wanita</option>
                            </select>
                        </div>
                        <div class="form-group">
                          <label for="provinces_id">Provinsi</label>
                          <select name="provinces_id" id="provinces_id" class="form-control" v-model="provinces_id" v-if="provinces">
                            <option v-for="province in provinces" :value="province.id">@{{ province.name }}</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="regencies_id">Kabupaten</label>
                          <select name="regencies_id" id="regencies_id" class="form-control" v-model="regencies_id" v-if="regencies">
                            <option v-for="regency in regencies" :value="regency.id">@{{ regency.name }}</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="districts_id">Kecamatan</label>
                          <select name="districts_id" id="districts_id" class="form-control" v-model="districts_id" v-if="districts">
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
                          <label for="">Alamat</label>
                          <textarea name="address" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                          <label>Minat Sebagai</label>
                            <sup>(Tidak Wajib)</sup>
                           <select name="interest" class="form-control" v-model="interest">
                             <option value="">-Pilih-</option>
                             <option value="Investor">Investor</option>
                             <option value="Nelayan">Nelayan</option>
                             <option value="Pembudidaya">Pembudidaya</option>
                             <option value="Petani">Petani</option>
                            </select>
                        </div>

                        {{-- interest --}}
                        {{-- <template v-if="interest == 'Investor'">
                            <div class="form-group">
                              <span style="color: red">*</span>
                              <label>Investor Apa ?</label>
                              <input
                                type="text"
                                name="type_interest"
                                class="form-control is-invalid"
                                v-model="type_interest"
                              />
                            </div>
                        </template>
                        <template v-if="interest == 'Nelayan'">
                            <div class="form-group">
                              <span style="color: red">*</span>
                              <label>Nelayan Apa ?</label>
                              <input
                                type="text"
                                name="type_interest"
                                class="form-control is-invalid"
                                v-model="type_interest"
                              />
                            </div>
                        </template>
                        <template v-if="interest == 'Pembudidaya'">
                            <div class="form-group">
                              <span style="color: red">*</span>
                              <label>Pembudidaya Apa ?</label>
                              <input
                                type="text"
                                name="type_interest"
                                class="form-control is-invalid"
                                v-model="type_interest"
                              />
                            </div>
                        </template>
                        <template v-if="interest == 'Petani'">
                            <div class="form-group">
                              <span style="color: red">*</span>
                              <label>Petani Apa ?</label>
                               <select class="form-control is-invalid" name="type_of_agriculture_id" id="type_of_agriculture_id" v-model="type_profesion">
                                  <option value="">-Pilih-</option>
                                  @foreach ($type_agricultur as $row)
                                  <option value="{{ $row->id }}">{{ $row->name_type }}</option>
                                  @endforeach
                              </select>
                              <span>
                                <a href="#" type="button" data-toggle="modal" data-target="#addCdCat"><i class="fa fa-plus"></i> Buat Kelompok Pertanian Baru</a>
                              </span>
                            </div>
                        </template>                           --}}
                        {{-- interest --}}

                         <div class="form-group">
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
                            name="facebook"
                            class="form-control"
                          />
                        </div>
                         <div class="form-group">
                          <label>Instagram</label>
                          <input
                            type="text"
                            name="instagram"
                            class="form-control"
                          />
                        </div>
                         <div class="form-group">
                          <label>Youtube</label>
                          <input
                            type="text"
                            name="youtube"
                            class="form-control"
                          />
                        </div>
                         <div class="form-group">
                          <label>Foto Anggota</label>
                          <input
                            type="file"
                            name="photo"
                            class="form-control"
                          />
                        </div>
                         <div class="form-group">
                          <label>Foto KTP</label>
                          <input
                            type="file"
                            name="photo_idcard"
                            class="form-control"
                          />
                        </div>
                        <div class="form-group">
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
<script src="/vendor/vue/vue.js"></script>
<script src="https://unpkg.com/vue-toasted"></script>
<script src="/vendor/axios/axios.min.js"></script>

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