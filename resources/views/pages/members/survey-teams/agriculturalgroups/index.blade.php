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
          @if($agricultur_group)
            @foreach ($agricultur_group as $item)
             <div class="alert alert-warning alert-dismissible fade show" role="alert">
              Petani atas nama  <strong>{{ $item->farmer->member->name }}</strong> belum memiliki pengelola
              <a href="{{ route('member-management-create', $item->id) }}">
                <i>Lengkapi</i>
              </a>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @endforeach
          @endif
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