<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>INV - {{ $inv }}</title>
    <style type="text/css">
    body{
            font-family: Calibri, 'Trebuchet MS', sans-serif;
            color:black;
            text-align:left;
            font-size:12px;
            margin:0;
     
        }
    table {     
      width: 100%;
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
        <td valign="top">  <img src="<?php echo 'data:image/jpg;base64,'.base64_encode(file_get_contents('./images/logo_ssl.png')); ?>" >
        </td>           
        <td width="40%">
          <strong style="font-size:15px;">PT. SINERGI SUKSES LOGISTIK </strong><br>
          Gajah Mada Tower Fl 19th #7 <br>
          Jl. Gajah Mada No. 19-26 , Jakarta 10130 - Indonesia <br>
          Phone : +62 21 63851866  Fax : +62 21 6338155 <br>
          mail@sinergisukseslogistik.com <br>
          www.sinergisukseslogistik.com         
        </td>
      </tr>
    </table>
<p></p>
    <table id="judul">
      <tr style="height: 25px">
        <td width="75%" style="border-right: 0.1px solid;font-size:15px;font-weight: bold;"><center><b>INVOICE</b></center> </td>
        <td style="font-size:15px;font-weight: bold;"><center><b>{{ Helper::FormatInvWh($inv) }}</b></center></td>
      </tr>
    </table>  
    <p></p>

    <table>
      <tr>
        <td style="width:100px">Tanggal </td><td style="width:5px">:</td><td>
        <td>{{ Helper::TglIndo($header->tgl_gen) }}</td>
      </tr>
      <tr>
        <td>Bill To </td><td>:</td><td>
        <td>PT VARUNA LINTAS SARANA LOGISTIK</td>
      </tr>
      <tr>
        <td valign="top">Address</td><td valign="top">:</td><td>
        <td>
          GEDUNG PERKANTORAN HAYAM WURUK PLAZA TOWER LT.7 UNIT A-B,<br>
          JL. HAYAM WURUK 108 MAPHAR TAMAN SARI JAKARTA BARAT <br>
          DKI JAKARTA 11160
        </td>
      </tr>
      <tr>
        <td>NPWP</td><td>:</td><td>
        <td>210073987032000</td>
      </tr>
    </table>
    <hr style="border: 0.1px solid">
  
    <table border="0">      
      <tr>
        <td style="width:100px">BL No</td><td style="width:5px">:</td>
        <td> {{ $vessel->vls_bl }}</td>
      </tr>
      <tr>
        <td>Container</td><td>:</td><td>{{ $cnt }}</td>
      </tr>
      <tr>
        <td>Vessel</td><td>:</td><td>{{ $vessel->vessel }}</td>
      </tr>
      <tr>
        <td>ETA</td><td>:</td><td>{{ $vessel->eta }}</td>
      </tr>
    </table>
    <p></p>
  

    <table id="item" style="width: 100%;">
      <thead>
        <tr style="height: 25px">
          <th style="border: 1px solid; width: 5%;">#</th>
          <th style="border: 1px solid black;">ITEM</th>
          <th style="border:  1px solid black;width: 20%;">TARIF ( Rp )</th>
          <th style="border: 1px solid black;width: 10%;">W/M</th>
          <th style="border: 1px solid black;width: 20%;">TOTAL ( Rp )</th>
        </tr>
      </thead>
      <tbody>
        @php
          // hitung weight/measure
           $brs = 0; $no = 1;
        @endphp

        @foreach ($detail as $dtl)
          @php
            $brs++;                      
          @endphp
          <tr>
            <td style="border: 1px solid black;text-align: center;">{{ $no++ }}</td>
            <td style="border: 1px solid black;">{{ $dtl->keterangan }}</td>
            <td style="border: 1px solid; text-align: center;">{{ Helper::Angka($dtl->jumlah) }}</td>
            <td style="border: 1px solid; text-align: center;">1</td>
            <td style="border: 1px solid;text-align: right;">{{ Helper::Angka($dtl->jumlah) }} &nbsp;&nbsp;</td>
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
        <tr>
            <td colspan="4" style="text-align:right;font-weight: bold;">Sub Total &nbsp;&nbsp;</td>
            <td style="border: 1px solid black;text-align:right;font-size:15px;font-weight: bold;">{{ Helper::Rupiah($header->jumlah) }} &nbsp;&nbsp; </td>
          </tr>
          <tr>
            <td colspan="4" style="text-align:right;font-weight: bold;">PPN &nbsp;&nbsp;</td>
            <td style="border: 1px solid black;text-align:right;font-size:15px;font-weight: bold;">{{ Helper::Rupiah($header->ppn) }} &nbsp;&nbsp;</td>
          </tr>

          @if ($header->materai >> 0)
            <tr>
              <td colspan="4" style="text-align:right;font-weight: bold;"
              >Stemp Duty &nbsp;&nbsp;</td>
              <td style="border: 1px solid black;text-align:right;font-size:15px;font-weight: bold;">{{ Helper::Rupiah($header->materai) }} &nbsp;&nbsp;</td>
            </tr>

          @endif

          <tr>
            <td colspan="4" style="text-align:right;font-weight: bold;">Grand Total &nbsp;&nbsp;</td>
            <td style="border: 1px solid black;text-align:right;font-size:15px;font-weight: bold;">{{ Helper::Rupiah($header->grandtotal) }} &nbsp;&nbsp;</td>
          </tr>
    </table>
</center>
<p><br></p>
<p><br></p>
<table class="table">
  <tr>
    <td width="50%" valign="top">

      <p></p>
      <strong>
      A/N PT SINERGI SUKSES LOGISTIK <br>
      MANDIRI CAB JAKARTA KETAPANG INDAH <br>
      A/C NO. 1150000787772 <br>
      </strong>
      
    </td>
    <td style="text-align:center;font-size:14px;font-weight: bold;">
      Hormat Kami, 
      <p><br></p>
      <p><br></p>

      (..............................)

    </td>
  </tr>
</table>

</body>
</html>