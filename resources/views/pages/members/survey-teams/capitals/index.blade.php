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
            @if($agricultur_group)
              @foreach ($agricultur_group as $item)
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                Kelompok pertanian <strong>{{ $item->typeAgricultur->name_type }}</strong>atas nama  <strong>{{ $item->farmer->member->name }}</strong> belum memiliki permodalan / biaya
                <a href="{{ route('member-capital-create', $item->capital->id) }}">
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