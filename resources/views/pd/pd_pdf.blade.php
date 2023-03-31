<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Print PDF</title>
   <style type="text/css">

      @page {
         margin-top: 0.5cm;
         margin-bottom: 0.5cm;
      }
      body{
            font-family: Calibri, 'Trebuchet MS', sans-serif;
            color:#333;
            text-align:left;
            font-size:12px;
            margin-top: 0;
        }
      table {           
         width: 100%;         
         border-collapse: collapse;
      }  
      th,td    {        
         padding:2px;
      }  
      
      .center-image {
        background-image: url("images/ssl_gw.png");        
         height: 300px;
         background-position: center;
         background-repeat: no-repeat;
         background-size: cover;
         position: relative;
      }


   </style> 
</head>
<body>
   <table>
      <tr style="border-bottom: 0.1px solid;">
         <td width="50%" style="font-size:17px;font-weight: bold;">PT SINERGI SUKSES LOGISTIK</td>
         <td style="text-align:center;font-size:17px;font-weight: bold;">PERMOHONAN DANA</td>
      </tr>
   </table>
   <br>
   <table>
      <tr>
         <td width="65"><b>Kepada</b></td><td width="3"><b>:</b></td><td>{{ $pd->penerima }}</td>
         <td width="65"><b>No</b></td><td width="3"><b>:</td><td width="150">{{ $pd->kd_pd }}</td>
      </tr>
      <tr>
         <td><b>Customer</b> </td><td><b>:</b></td><td>{{ $pd->customer}}</td>
         <td><b>Tanggal</b> </td><td><b>:</b></td><td>
            {{ Helper::TglIndo($pd->tanggal) }}
         </td>
      </tr>
      <tr>
         <td colspan="3"></td>
         <td><b>Department</b></td><td>:</td><td>{{ $pd->dept }}</td>
      </tr>
   </table>
   <br>
<div class="center-image">
   <table>
      <tr style="border: 0.1px solid;">
         <td><strong>Untuk Pembayaran :</strong> {{ $pd->keterangan }}</td>
         <td style="border-left: 0.1px solid;"><strong>Jumlah</strong></td>
      </tr>
      @php
         $total = 0;
         $brs = 0;
         $no = 0;
         $jumlah_plus = 0; $jumlah_min = 0;
      @endphp
      <tr>
         <td style="border-left: 0.1px solid;"> &nbsp; </td>
          <td style="border-left: 0.1px solid;border-right: 0.1px solid;"></td>
      </tr>      
      @foreach ($pddtl as $dtl)

            @php
                $no = $no + 1;
            @endphp
            @if ($dtl->noted ==1)

            <tr>
               <td style="padding-left: 10px;border-left: 0.1px solid;"> 
                  @php
                           echo nl2br($dtl->keterangan)
                        @endphp
                    </td>
               <td style="border-left: 0.1px solid;border-right: 0.1px solid;"> &nbsp; </td>
            </tr>

            
            @else 

            <tr>
               <td style="padding-left: 10px;border-left: 0.1px solid;"> {{ $dtl->keterangan }} </td>
               <td style="border-left: 0.1px solid;border-right: 0.1px solid;text-align: right;">{{ Helper::Rupiah($dtl->jumlah) }} &nbsp; </td>
            </tr>

            @endif
         @php
           
            $brs++;
            if ($dtl->operator == 'plus') {
               $jumlah_plus = $jumlah_plus + $dtl->jumlah;
            } 
            if ($dtl->operator == 'minus') {
               $jumlah_min = $jumlah_min + $dtl->jumlah;
            }            
         @endphp
      @endforeach

         @for ($i = 0; $i < (7-$no); $i++)
            <tr>
                <td style="border-left: 0.1px solid;border-right: 0.1px solid;">
                  &nbsp;
               </td>
               <td style="border-left: 0.1px solid;border-right: 0.1px solid;">
                  &nbsp;
               </td>
            </tr>
        @endfor
 
      <tr style="border-bottom: 0.1px solid;">
         <td style="border-left: 0.1px solid;">
            @php
               echo nl2br($pd->noted);
            @endphp
         </td>  
         <td style="border-left: 0.1px solid;border-right: 0.1px solid;"> &nbsp; </td>     
      </tr> 
     <tr style="border-bottom: 0.1px solid;">
         <td style="border-left: 0.1px solid;">
            Terbilang : 
         </td>  
         <td style="border-left: 0.1px solid;border-right: 0.1px solid;"> &nbsp; </td>     
      </tr> 

   </table>
   @php
      $jumlah_tot = $jumlah_plus - $jumlah_min;
   @endphp
   <table>
      <tr>
        <td style="text-align: center;font-size: 1.5em" width="150"><b> Total </b> </td>
         <td style="font-size: 1.5em;text-align: right;"> {{ Helper::Rupiah($jumlah_tot) }} &nbsp; </td>         
      </tr>
   </table>

   <table cellpadding="1" cellspacing="1" border="1">
      <tr>
         <td colspan="3" style="text-align:center;">Diketahui oleh</td>
         <td style="text-align:center;">Yang Mengajukan</td>
         <td style="text-align:center;">Penerima</td>
      </tr>
      <tr>
         <td style="width: 20%">Direksi</td>
         <td style="text-align:center;">Kepala Bagian</td>
         <td style="text-align:center;">Keuangan</td>
         <td rowspan1="3"></td>
         <td rowspan1="3"></td>
      </tr>
      <tr>
         <td style="height:60px;width: 20%">  </td>
         <td style="height:60px;width: 20%">  </td>
         <td style="height:60px;width: 20%">  </td>
         <td style="height:60px;width: 20%" valign="bottom" align="center"> {{ Auth::user()->name }} </td>
         <td style="height:60px;width: 20%">  </td>
      </tr>

   </table> 
   

   </div>

</body>
</html>