<style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
          
        th, td {
            text-align: left;
            padding: 4px;
        }

        .yellow {
            background-color: yellow;
        }
    </style>
<table>
  <tr class="yelow">
    <td colspan="6">LAPORAN BY CONTAINER </td>
  </tr>
  <tr>
    <td>Bulan</td><td colspan="5">{{ Helper::GetMonth($bln) }}</td>
  </tr>
  <tr>
     <th style="background-color: #ccdff3;text-align: center;">#</th>
     <th style="background-color: #ccdff3;text-align: center">CONTAINER</th>
     <th style="background-color: #ccdff3;text-align: center">VESSEL</th>     
     <th style="background-color: #ccdff3;text-align: center">TOTAL</th>
  </tr>
   @php
            $brs = 1;
  @endphp
  @foreach ($data as $cont)
    <tr>
      <td>{{ $brs++ }}</td>
      <td>{{ $cont->container }}</td>
      <td>{{ $cont->vessel }}</td>
      <td>
        @php
          $totCont = App\Models\IwhHeader::where('container', $cont->container)->sum('grandtot');
        @endphp        
        {{ $totCont }}
      </td>      
    </tr>
  @endforeach

</table>