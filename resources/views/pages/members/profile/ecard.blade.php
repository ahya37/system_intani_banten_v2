@extends('layouts.admin')
@section('title')
    Profile
@endsection
@push('addon-style')
    <style>
    #idcard {
       width:1000px;
       height:350px;
       margin:10px;
       margin-right: 100px;
       background-image: url("{{url('images/ecard2.png')}}");
       background-repeat: no-repeat;
       background-size: 100% 100%;
       -webkit-print-color-adjust: exact;
    }
    #img {
            margin-top:28px;
            margin-left: 0px;
            border-radius: 8px;  /* Rounded border */
            padding: 5px; /* Some padding */
            width: 110px; /* Set a small width */
            height: 200px;
            /* margin:10px; */
    }

    .texts{
            margin-top:98px;
            font-size: 12px;
    }
    .address{
        margin-right: 120px;
        margin-left: 20px;
        /* margin-top: 2px; */
            font-size: 12px;

    }
    .identity{
       height:350px;
       margin-bottom:100px;
       margin-left: 80px;
       padding-top: 39px; /* Some padding */
       font-size: 12px;
       font-style: bold;

    }
   

    
</style>
@endpush
@section('content')
    <!-- Page Content -->
    <div class="page-content page-home">
      <div id="page-content-wrapper" style="min-height: 70vh">
        <div class="page-content">
          <div class="container">
            <div class="dashboard-content">
              <div class="card mb-2 shadow p-3 bg-white rounded">
                <h5>E-Kartu Anggota</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4 d-inline-block align-top pr-5">
                                        <div class="col-md-12">
                                            <a class="btn btn-sm btn-success" href="" target="_blank"><i class="fa fa-print"></i> Cetak PDF</a>
                                        </div>
                                        <div id="idcard">
                                            <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <table border="0">
                                                                <tr>
                                                                 <td>
                                                                     <div id="img">
                                                                         <img class="img-thumbnail" style="border-radius: 8px;width: 100%; height: 135px; margin: 40px 0 25px 0;" src="{{ Storage::url($member->photo ?? '') }}" />
                                                                     </div>
                                                                 </td>
                                                                 <td align="left" >
                                                                     <p class="texts">
                                                                        <b>
                                                                            {{strtoupper($member->name)}}

                                                                        </b>
                                                                        <br>
                                                                        <b style="color: red">
                                                                            {{$member->base->name }}
                                                                        </b>
                                                                        <br>
                                                                        <br>
                                                                        <b>
                                                                            {{date('m', strtotime($member->created_at))}}
                                                                            {{date('Y', strtotime($member->created_at))}}
                                                                            {{$member->code}}
                                                                        </b>
                                                                    </p>
                                                                 </td>
                                                             </tr>
                                                         </table>
                                                         <table border="0" class="address" cellpadding="0">
                                                             <tr>
                                                                 <td>
                                                                        {{$member->address}}
                                                                </td>
                                                             </tr>
                                                              <tr>
                                                                 <td>
                                                                    
                                                                        {{$member->village->name}}, {{$member->village->district->name}}
 
                                                                </td>
                                                            <tr>
                                                                 <td>
                                                                    
                                                                       {{$member->village->district->regency->name}}
                                                                    
                                                                </td>
                                                             </tr>
                                                             <tr>
                                                                 <td>
                                                                    <b>
                                                                       {{$member->village->district->regency->province->name}}
                                                                    </b> 
                                                                </td>
                                                             </tr>
                                                         </table>
                                                        </div>
                                                        <div class="col-md-6 identity">
                                                            <table border="0" cellpadding="0">
                                                                <tr>
                                                                    <th>Nama</th>
                                                                    <th width="10px">:</th>
                                                                    <th class="texts">
                                                                        {{strtoupper($member->name)}}
                                                                    </th>
                                                                </tr>
                                                                <tr>
                                                                    <th>TTL</th>
                                                                    <th width="10px">:</th>
                                                                    <th>
                                                                            {{$member->place_of_berth}},
                                                                            {{date('d-m-Y', strtotime($member->date_of_berth))}}
                                                                    </th>
                                                                </tr>
                                                                <tr>
                                                                    <th>NIK</th>
                                                                    <th width="10px">:</th>
                                                                    <th>
                                                                            {{$member->nik}}
                                                                    </th>
                                                                </tr>
                                                                <tr>
                                                                    <th >Terdaftar Tgl</th>
                                                                    <th width="10px">:</th>
                                                                    <th>
                                                                            {{date('d-M-Y', strtotime($member->created_at))}}
                                                                    </th>
                                                                </tr>
                                                            </table>
                                                         </div>
                                                    </div>         
                                                    </div>
                                                            
                                         </div>
                                    </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection