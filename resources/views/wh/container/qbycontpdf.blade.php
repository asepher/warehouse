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
  <center>
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
    <p></p>
    <table>
      <tr style="padding: 3px;border-top: 0.1px solid black;">
        <th rowspan="2">#</th>
        <th rowspan="2">ETA</th>
        <th rowspan="2">CONTAINER</th>
        <th colspan="4" style="border-left: 1px solid black;">INVOICE</th>
        <th colspan="4" style="border-left: 1px solid black;border-right: 1px solid black;">INVOICE TAMBAHAN</th>
      </tr>
      <tr style="border-bottom: 0.1px solid black;">
        <th style="border-left: 0.1px solid black;">INV</th>
        <th>PPN</th>
        <th>MATERAI</th>
        <th style="border-right: 0.1px solid black;">GRAND.TOT</th>        
        <th style="border-left: 0.1px solid black;">INV</th>
        <th>PPN</th>
        <th>MATERAI</th>
        <th style="border-right: 0.1px solid black;">GRAND.TOT</th>        
      </tr>
      @php
        $no = 1;
      @endphp
      @foreach ($container as $cont)
        <tr>
          <td style="padding-top: 2px;">{{ $no++ }}</td>
          <td>{{ $cont->eta }}</td>
          <td>{{ $cont->container }}</td>
          <td style="text-align:right;">
              @php
               $hitInv = App\Models\IwhHeader::where('container',$cont->container)->sum('jumlah');
              @endphp
              {{ $hitInv == 0 ? "-" :  Helper::Rupiah($hitInv) }}  
          </td>
          <td  style="text-align:right;">
            @php
               $hitPPN = App\Models\IwhHeader::where('container',$cont->container)->sum('vat');
            @endphp
              {{ $hitPPN == 0 ? '-'  : Helper::Rupiah($hitPPN) }}
          </td>
          <td style="text-align:right;">
            @php
               $hitMat = App\Models\IwhHeader::where('container',$cont->container)->sum('materai');
            @endphp
               {{ $hitMat == 0 ? '-'  : Helper::Rupiah($hitMat) }}            
          </td>
          <td style="text-align:right;">
            @php
               $hitGrand = App\Models\IwhHeader::where('container',$cont->container)->sum('grandtot');
            @endphp
            {{ $hitGrand == 0 ? '-'  : Helper::Rupiah($hitGrand) }}            
          </td>

          <td style="text-align:right;">
            @php
              $ManInvJum = App\Models\InvManHeader::where('container',$cont->container)->sum('jumlah');
            @endphp
            {{ $ManInvJum == 0 ? '-'  : Helper::Rupiah($ManInvJum) }}
          </td>
          <td style="text-align:right;">
            @php
               $ManPPn = App\Models\InvManHeader::where('container',$cont->container)->sum('ppn');
            @endphp
            {{ $ManPPn == 0 ? '-'  : Helper::Rupiah($ManPPn) }}
          </td>
            <td style="text-align:right;">
            @php
              $ManJumVat = App\Models\InvManHeader::where('container',$cont->container)->sum('vat');
            @endphp
              {{ $ManJumVat == 0 ? '-' : Helper::Rupiah($ManJumVat) }}
            </td>
            <td style="text-align:right;">
              @php
                 $ManGrandTot = App\Models\InvManHeader::where('container',$cont->container)->sum('grandtotal');
              @endphp
                 {{ $ManGrandTot == 0 ? '-' : Helper::Rupiah($ManGrandTot) }}
            </td>



        </tr>
       @endforeach 
    </table>

</body>
</html>