@extends('layouts.master')

@section('title')
   Query Report
@endsection

@section('content')

   <div class="row">
      <div class="col-12">
         <div class="card-box">
            <form action="/kb/query" method="POST">
            {{ csrf_field() }}
                  <div class="row">
                     <div class="col-sm-3">
                        <h4 class="header-title">Bulan</h4>
                        <div>
                        <select name="bulan" class="form-control">
                        <option value="1">Januari</option>
                           <option value="2">Februari</option>
                           <option value="3">Maret</option>                   
                           <option value="5">April</option>                   
                           <option value="5">Mei</option>                     
                           <option value="6">Juni</option>                    
                           <option value="7">Juli</option>                    
                           <option value="8">Agustus</option>                    
                           <option value="9">September</option>                     
                           <option value="10">October</option>                   
                           <option value="11">November</option>                     
                           <option value="12">Desember</option>                 
                        </select>
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <h4 class="header-title">Tahun</h4>
                        <select name="tahun" class="form-control">
                           <option value="">--PILIH--</option>
                           <option value="2020">2020</option>
                           <option value="2021">2021</option>
                           <option value="2022">2022</option>
                        </select>
                     </div>
                     <div class="col-sm-3">
                        <br>
                        <button class="btn btn-primary btn-block" type="submit">Submit </button>
                     </div>
                  </div>
            </form>
         </div>
      </div>
   </div>


   <div class="card">
      <div class="card-body">
         <div class="row">
            <div class="col-md-12">
            <h4 class="header-title">Data Kas Bank</h4>   
            <table class="table table-sm table-bordered" id="data-table1">
                  <thead>
                  <tr>
                     <th class="text-center" >#</th>
                     <th class="text-center" >Kode</th>
                     <th class="text-center" >Tanggal</th>
                     <th class="text-center" >Keterangan</th>
                     <th class="text-center" >Debet</th>
                     <th class="text-center" >Kredit</th>                  
                     <th class="text-center" >Saldo</th>
                  </tr>
               </thead>
               <tbody>
                  @php
                     $no = 1; $jd = 0; $jk = 0;
                  @endphp
                  @foreach ($kasbank as $kb)
                  <tr>
                     <td>{{ $no++ }}</td>
                     <td>{{ $kb->kd_tr }}</td>
                     <td>{{ $kb->tanggal }}</td>
                     <td>{{ $kb->keterangan1 . ' ' . $kb->keterangan2 . ' ' . $kb->keterangan3 }}</td>
                     @if ($kb->tipe == 'Debet')
                        <td class="text-right">{{ Rupiah($kb->jumlah) }}</td>
                        <td></td>
                        @php
                           $jd += $kb->jumlah;
                        @endphp 
                     @endif
                     @if ($kb->tipe == 'Kredit')
                        <td></td>
                        <td class="text-right">{{ Rupiah($kb->jumlah) }}</td>
                        @php
                           $jk += $kb->jumlah;  
                     @endphp
                     @endif
                     <td class="text-right">
                        @php
                           $saldo = $jd - $jk;  
                        @endphp                       
                        {{ Rupiah($saldo) }}

                     </td>
                  </tr> 
                  @endforeach

               </tbody>
            </table>




            </div>            
         </div>


      </div>
   </div>

@endsection