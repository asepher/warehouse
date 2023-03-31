<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>INV </title>
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

  </style>
</head>
<body>  
  <table>
      <tr style="padding: 3px;">
        <td>
          <strong style="font-size:15px;">PT. SINERGI SUKSES LOGISTIK </strong><br>
          www.sinergisukseslogistik.com         
        </td>
        <td style="text-align: center;" valign="bottom">
          {{ $nmbulan.'-'.$thn }}
        </td>
      </tr>
  </table> 
  <center><span style="font-size:14px;font-weight: bold;">LAPORAN SOA</span></center>
  <p></p>
  <table>
    <tr>
      <th style="text-align:center;font-weight:bold;border: 0.1px solid black;padding: 5px;">#</th>
      <th style="text-align:center;font-weight:bold;border: 0.1px solid black;">INV</th>
      <th style="text-align:center;font-weight:bold;border: 0.1px solid black;">CNEE</th>
      <th style="text-align:center;font-weight:bold;border: 0.1px solid black;">CONTAINER</th>
      <th style="text-align:center;font-weight:bold;border: 0.1px solid black;">BL</th>
      <th style="text-align:center;font-weight:bold;border: 0.1px solid black;">HBL</th>
      <th style="text-align:center;font-weight:bold;border: 0.1px solid black;">WEIGHT</th>
      <th style="text-align:center;font-weight:bold;border: 0.1px solid black;">VOL</th>
      <th style="text-align:center;font-weight:bold;border: 0.1px solid black;">TOTAL</th>
    </tr>
    @foreach ($invmaster as $invms)
       <tr>
         <td colspan="9">Container : {{ $invms->container }}</td>
       </tr>
        @php
          $header = App\Models\InvDnHeader::where('container',$invms->container)->get();
          $no = 1; $totPPn = 0;
        @endphp
       @foreach ($header as $hd)
          <tr>
            <td style="width:7px">{{ $no++ }}</td>
            <td style="width:100px">{{ $hd->kd_inv }}</td>
            <td style="width:300px">{{ $hd->cnee_name }}</td>
            <td style="width:100px">{{ $hd->container }}</td>
            <td>{{ $hd->vls_bl }}</td>
            <td>{{ $hd->hbl }}</td>
            <td style="width:80px;text-align:right;">{{ $hd->weight }}</td>
            <td style="width:70px;text-align:right;">{{ $hd->min_actual }}</td>
            <td style="text-align:right;width:100px">{{ Helper::Angka($hd->inv_soa_vls) }}</td>
          </tr>
          @php
            $totPPn = $totPPn+$hd->inv_soa_vls;
          @endphp
       @endforeach
       <tr>
            <td colspan="8" style="text-align:right;font-weight:bold;font-weight:14px;">PPN </td>
            <td style="text-align:right;font-weight:bold;font-size: 14px;">{{ Helper::Angka($totPPn*0.11) }} </td>
          </tr>
     @endforeach 
  </table>

</body>
</html>


