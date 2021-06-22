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
          <div class="card">
            <div class="card-body">
              <h5>Permodalan</h5>
                <form action="{{ route('member-next-capital-save') }}" method="POST" id="register" enctype="multipart/form-data">
                  @csrf
                  <div class="row row-login">
                    <div class="col-lg-12">
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
                <a
                 href="{{ route('member-dashboard') }}"
                   class="btn btn-try btn-danger text-white  btn-block w-100"
                 >
                   Lewati
               </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
@push('addon-script')
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