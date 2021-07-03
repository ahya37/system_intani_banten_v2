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
<div class="page-content page-auth d-flex justify-content-center">
      <div class="section-store-auth " data-aos="fade-down">
        <div class="container">
           @include('layouts.message')
          <div class="col-lg-12">
          <div class="card shadow-lg p-3 mb-5 bg-white rounded">
            <div class="card-body">
              <h5 class="mb-3">Permodalan</h5>
                <form action="{{ route('member-management-capital-save') }}" method="POST" id="farmer" enctype="multipart/form-data">
                  @csrf
                  <div class="row row-login">
                    <div class="col-lg-12">
                        <div class="form-group">
                        <span class="required">*</span>
                          <label for="investor_id">Investor</label>
                           <select class="form-control select2" name="investor_id" id="investor_id" required>
                              <option value="">-Pilih Investor-</option>
                              @foreach ($investor as $row)
                              <option value="{{ $row->investor_id }}">{{ $row->investor }}</option>
                              @endforeach
                              </select>
                        </div>
                        <div class="form-group">
                            <span class="required">*</span>
                          <label for="farmers_id">Petani</label>
                          <select id="farmers_id" class="form-control" v-model="farmers_id" v-if="farmers" required>
                            <option v-for="farmer in farmers" :value="farmer.farmer_id">@{{ farmer.farmer_name }}</option>
                          </select>
                        </div>
                        <div class="form-group">
                            <span class="required">*</span>
                          <label for="agricultural_group_id">Jenis Pertanian</label>
                          <select id="agricultural_group_id" class="form-control" name="agricultural_group_id" v-model="agricultural_group_id" v-if="type_agriculturs" required>
                            <option v-for="type_agricultur in type_agriculturs" :value="type_agricultur.agricultural_group_id">@{{ type_agricultur.name_type }}</option>
                          </select>
                        </div>
                      <div class="form-group">
                        <label>Biaya Bibit</label>
                        <input
                          type="text"
                          name="cost_of_seeds"
                          class="number form-control"
                        />
                      </div>
                      <div class="form-group">
                        <label>Biaya Sewa Lahan</label>
                        <input
                          type="text"
                          name="rental_cost"
                          class="number form-control"
                        />
                      </div>
                      <div class="form-group">
                        <label>Biaya Pengolahan Lahan</label>
                        <input
                          type="text"
                          name="material_processing_costs"
                          class="number form-control"
                        />
                      </div>
                      <div class="form-group">
                        <label>Biaya Penanaman</label>
                        <input
                          type="text"
                          name="planting_costs"
                          class="number form-control"
                        />
                      </div>
                      <div class="form-group">
                        <label>Biaya Pemeliharaan</label>
                        <input
                          type="text"
                          name="maintenance_cost"
                          class="number form-control"
                        />
                      </div>
                       <div class="form-group">
                        <label>Biaya Pupuk</label>
                        <input
                          type="text"
                          name="fertilizer_costs"
                          class="number form-control"
                        />
                      </div>
                      <div class="form-group">
                        <label>Biaya Panen</label>
                        <input
                          type="text"
                          name="harvest_costs"
                          class="number form-control"
                        />
                      </div>
                      <div class="form-group">
                        <label>Biaya Lainnya</label>
                        <input
                          type="text"
                          name="other_costs"
                          class="number form-control"
                        />
                      </div>
                       <div class="form-group">
                        <label>Piutang</label>
                        <input
                          type="text"
                          name="accounts_receivable"
                          class="number form-control"
                        />
                      </div>
                    </div>
                    <div class="col-12 form-group">
                        <button
                        type="submit"
                          class="btn btn-try custom-button text-white  btn-block w-100"
                        >
                          Simpan
                      </button>
                    </div>
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
<script src="{{ asset('vendor/axios/axios.min.js') }}"></script>

<script>
    var farmer = new Vue({
        el: "#farmer",
        mounted(){
            AOS.init();
            this.getFarmersData();
        },
        data(){
            return {
                farmers:null,
                farmers_id: null,
                agricultural_group_id: null,
                type_agriculturs: null
            }
        },
        methods:{
            getFarmersData(){
                var self = this;
                axios.get('{{ route('api-management-farmer') }}')
                .then(function(response){
                    self.farmers = response.data
                })
            },

            getTypeAgricultur(){
                var self = this;
                axios.get('{{ url('member/api/management/typeagricultur') }}/' + self.farmers_id)
                .then(function(response){
                    self.type_agriculturs = response.data
                })
            }
        },
        watch:{
            farmers_id: function(val, oldval){
                this.agricultural_group_id = null;
                this.getTypeAgricultur();
            },
        },
    });
</script>

<script>
  $(document).ready(function(){
    $(".number").keypress(function(data) {
            if (data.which != 8 && data.which != 0 && (data.which<48 || data.which>57)) {
                // $(".message").html("Please.. Number Only").show().fadeOut("slow");
                return false;
            }
        });
  });
</script>
@endpush