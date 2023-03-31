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
    <td colspan="6"><strong><h4>LAPORAN SOA</h4></strong> </td>
  </tr>
  <tr>
    <td colspan="6">Bulan : {{ Helper::GetMonth($bulan) . '2022' }}</td>
  </tr>
</table>
@php
  $no=1;
@endphp

<table>
  <tr>
    <th style="background-color: #ccdff3;">NO</th>
    <th style="background-color: #ccdff3;">VESSEL</th>
    <th style="background-color: #ccdff3;">INVOICE</th>
    <th style="background-color: #ccdff3;">BL</th>
    <th style="background-color: #ccdff3;">ETA</th>
    <th style="background-color: #ccdff3;">CNEE</th>
    <th style="background-color: #ccdff3;">CONT</th>
    <th style="background-color: #ccdff3;">HBL</th>
    <th style="background-color: #ccdff3;">WEIGHT</th>
    <th style="background-color: #ccdff3;">VOL_ACTUAL</th>
    <th style="background-color: #ccdff3;">VOL_SOA</th>
    <th style="background-color: #ccdff3;">INV_VLS</th>
  </tr>

  @foreach ($data as $dt)
    <tr>
      <td colspan="12"><strong>Container : {{$dt->container}}</strong></td>
    </tr>
      @php
        $header = App\Models\InvDnHeader::where('container',$dt->container)->get();
        $no = 1; $totPPn = 0;
      @endphp
    @foreach ($header as $hd)    
      <tr>
        <td>{{ $no++ }}</td>
        <td>{{ $hd->vessel_name }}</td>
        <td>{{ $dt->kd_inv }}</td>
        <td>{{ $hd->vls_bl }}</td>
        <td>{{ $dt->eta }}</td>
        <td>{{ $hd->cnee_name }}</td>
        <td>{{ $hd->container }}</td>
        <td>{{ $hd->hbl }}</td>
        <td>{{ $hd->weight }}</td>
        <td>{{ $hd->min_actual }}</td>
        <td>{{ $hd->vol_soa_vls }}</td>
        <td>{{ $hd->inv_soa_vls }}</td>
      </tr>
      @php
        $totPPn = $totPPn + $hd->inv_soa_vls;
      @endphp
    @endforeach
      @php
        $hitPPn = $totPPn * 0.11;
        $materai = 10000;
      @endphp
      <tr>
        <td colspan="11"> P P N </td>
        <td>{{ $hitPPn }}</td>
      </tr>
      @if ($totPPn >= 5000000)
      <tr>
        <td colspan="11"> MATERAI </td>
        <td>{{ $materai }}</td>
      </tr>      
      @endif
      <tr>
        <td colspan="12"></td>
      </tr>
  @endforeach
</table>