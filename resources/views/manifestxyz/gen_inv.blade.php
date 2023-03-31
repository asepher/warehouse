<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>INV - {{ $inv }}</title>
    <style type="text/css">
    body{
            font-family: Calibri, 'Trebuchet MS', sans-serif;
            color:#333;
            text-align:left;
            font-size:14px;
            margin:0;
        }
    table {     
      width: 70%;
      border-collapse: collapse;      
    } 
    th,td   {     
      padding: 1px;
    }     
    #judul {    
      border: 0.1px solid black;
    }   
    #item th  {     
      border: 0.1px solid black;
      padding: 2px;
    }
    #item td  {       
      padding: 2px;
    }
    #bg {   
      
      background-repeat: no-repeat;
      
      background-image: url('http://localhost:8000/images/nomimasi.png');
      background-repeat: no-repeat;
    }

  </style>
</head>
<body>
	<center>
		

  <table>
      <tr>
        <td>  <img src="<?php echo 'data:image/jpg;base64,'.base64_encode(file_get_contents('./images/logo_ssl.png')); ?>" >
        </td>           
        <td width="40%" style="font-size:15px">
          <strong>PT. SINERGI SUKSES LOGISTIK </strong><br>
          Gajah Mada Tower Fl 19th #7 <br>
          Jl. Gajah Mada No. 19-26 , Jakarta 10130 - Indonesia <br>
          Phone : +62 21 63851866  Fax : +62 21 6338155 <br>
          mail@sinergisukseslogistik.com <br>
          www.sinergisukseslogistik.com         
        </td>
      </tr>
    </table>

    <table id="judul">
      <tr style="height: 25px">
        <td width="75%" style="border-right: 0.1px solid;font-size:17px;font-weight: bold;"><center><b>INVOICE</b></center> </td>
        <td style="font-size:17px;font-weight: bold;"><center><b>{{ $inv }}</b></center></td>
      </tr>
    </table>  
    <p></p>

    <table>
      <tr>
        <td>Tanggal </td>
        <td>{{ $tanggal }}</td>
      </tr>
      <tr>
        <td>Bill To </td>
        <td>PT Multi Terminal Indonesia</td>
      </tr>
      <tr>
        <td>Address</td>
        <td>Jl Banda No. 1 Gudang CDC Banda
          Pelabuhan Tj Priok - Jakarta </td>
      </tr>
      <tr>
        <td>NPWP</td>
        <td>Bpk Hasan</td>
      </tr>
    </table>
    <hr>


    <table border="0">
      <tr>
        <td>Customer</td><td>{{ $manifest->consignee }}</td>
        <td></td><td></td>
      </tr>
      <tr>
        <td>HB/L No</td><td>{{ $manifest->hbl }}</td>
        <td>Quantity </td><td>{{ $manifest->qty }}</td>
      </tr>
      <tr>
        <td>BL No</td><td>{{ $manifest->vls_bl }}</td>
        <td>Type</td><td>{{ $manifest->sat_qty }}</td>
      </tr>
      <tr>
        <td>Container</td><td>{{ $manifest->container }}</td>
        <td>Gw</td><td>{{ $manifest->weight }}</td>
      </tr>
      <tr>
        <td>Vessel</td><td>{{ $manifest->vessel }}</td>
        <td>Measure</td><td>{{ $manifest->measure }}</td>
      </tr>
      <tr>
        <td>ETA</td><td>{{ $manifest->eta }}</td>        
      </tr>
      <tr>
        <td>Description :</td><td colspan="3">{{ $manifest->description }}</td>
      </tr>
    </table>
    <p></p>
  

<div 
  @if ($manifest->term == 'FOB')
    id="bg"
  @endif
  >

    <table id="item" style="width: 65%;">
      <thead>
        <tr style="height: 25px">
          <th style="border: 1px solid; width: 5%;">#</th>
          <th style="border: 1px solid black;">ITEM</th>
          <th style="border:  1px solid black;width: 20%;">TARIF</th>
          <th style="border: 1px solid black;width: 10%;">W/M</th>
          <th style="border: 1px solid black;width: 20%;">TOTAL</th>
        </tr>
      </thead>
      <tbody>
        @php
          // hitung weight/measure
            $weight = $manifest->weight / 1000;
            if ( $weight >= $manifest->measure)
            {
                $wm = $manifest->weight;
            } else {
                $wm = $manifest->measure;
            }
           $totsub =  $totppn = 0; 
           $brs = 0; $no = 1;
        @endphp

        @foreach ($tarif as $trf)
          @php
            $brs++;
            if ( $trf->is_adm == 0)
            {
              $min = round($wm);
            }
            else  
            {
              $min = 1;       
            }
            
            $jumlah = $min * $trf->jumlah;
            $totsub = $totsub + $jumlah ;
          @endphp
          <tr>
            <td style="border: 1px solid black;text-align: center;">{{ $no++ }}</td>
            <td style="border: 1px solid black;">{{ $trf->nama_tarif }}</td>
            <td style="border: 1px solid; text-align: center;">{{ Helper::Rupiah($trf->jumlah) }}</td>
            <td style="border: 1px solid; text-align: center;">{{ $min }}</td>
            <td style="border: 1px solid;text-align: right;">{{ Helper::Rupiah($jumlah) }}</td>
          </tr>
        @endforeach   
        @for ($i = $brs; $i < 7 ; $i++)
          <tr>
            <td style="border: 1px solid black;">&nbsp;</td>
            <td style="border: 1px solid black;"></td>
            <td style="border: 1px solid black;"></td>
            <td style="border: 1px solid black;"></td>
            <td style="border: 1px solid black;"></td>
          </tr>
        @endfor   
      </tbody>
      @php
          $totppn = $totsub * 0.1 ;
          $tmptot = $totsub + $totppn ;
          $materai = 0;

          if ($tmptot > 5000000)
            $materai = 10000;

           $grandtot = $tmptot + $materai;
        @endphp
        <tr>
            <td colspan="4" style="text-align:right;font-size:17px;font-weight: bold;">Subtototal</td>
            <td style="border: 1px solid black;text-align:right;font-size:17px;font-weight: bold;">
            	{{ Helper::Rupiah($totsub) }}</td>
          </tr>
          <tr>
            <td colspan="4" style="text-align:right;font-size:17px;font-weight: bold;">PPN</td>
            <td style="border: 1px solid black;text-align:right;font-size:17px;font-weight: bold;">
            	{{ Helper::Rupiah($totppn) }}</td>
          </tr>
          <tr>
            <td colspan="4" style="text-align:right;font-size:17px;font-weight: bold;">Materai</td>
            <td style="border: 1px solid black;text-align:right;font-size:17px;font-weight: bold;">
            	{{ Helper::Rupiah($materai) }}</td>
          </tr>
          <tr>
            <td colspan="4" style="text-align:right;font-size:17px;font-weight: bold;">Grand Total </td>
            <td style="border: 1px solid black;text-align:right;font-size:17px;font-weight: bold;">
            	{{ Helper::Rupiah($grandtot) }}</td>
          </tr>
    </table>

 </div>

      <p></p>
        <form action="{{ route('invoice.pdf',[$inv]) }}" method="post">  
      {{ csrf_field() }}
      <input type="hidden" name="tipe" value="CR">
      <input type="hidden" name="inv" value="{{$inv}}">
      <button type="submit" >Print</button>
    </form>
       <p><br></p>

	</center>
	
</body>
</html>