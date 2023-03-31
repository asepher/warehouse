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
    <td colspan="2">LAPORAN PERIODE </td>
  </tr>
  <tr>
    <td>Tanggal</td><td>{{ $tgl }}</td>
  </tr>
  
<table style="border: 1px;background-color: yellow;" border="1">
      <tr>
        <th>HBL</th>
        <th>TERM</th>
        <th>CNEE</th>
        <th>NPWP</th>
        <th>ADDRESS</th>
        <th>VESSEL</th>
        <th>ETA</th>
        <th>INV NUMBER</th>
        <th>AMMOUNT</th>
        <th>DATE RELEASE</th>
        <th>DATE PAID</th>
      </tr>                        
     @foreach ($data as $dt)
        @php
          if ($dt->term == 'FOB'){                                
            $ammount = 0 ;
          } else {
            $ammount = $dt->inv_soa; 
          }
        @endphp
                          
        <tr>
            <td>{{ $dt->hbl }}</td>
            <td>{{ $dt->term }}</td>
            <td>{{ $dt->cnee_name }}</td>
            <td>{{ $dt->cnee_npwp}}</td>
            <td>{{ $dt->cnee_address}}</td>
            <td>{{ $dt->vessel}}</td>
            <td>{{ Helper::TglIndo($dt->eta) }}</td>
            <td>{{ $dt->kd_inv}}</td>
            <td>{{ $ammount }}</td>
            <td>{{ date('d-m-Y', strtotime($dt->tgl_inv)) }}</td>
            <td>{{ date('d-m-Y', strtotime($dt->tgl_memo))}}</td>
        </tr>
    @endforeach
</table>

<table>
    <thead>
        <tr>

            <th>TERM</th>
            <th>INV</th>
            <th>CNEE</th>
            <th>Container</th>
            <th>Hbl</th>
            <th>Weight</th>
            <th>Measure</th>           
            <th>Actual</th>
            <th>Jumlah</th>
        </tr>
    </thead>
    <tbody>
        @php
            $total = 0;
        @endphp
        @foreach ($data as $dt)
            @php
                $fob = ($dt->min_actual*200000) +50000;
                $total = $total + $fob;
            @endphp
            <tr>
                <td>{{ $dt->term }}</td>
                <td>{{ $dt->kd_inv }}</td>
                <td>{{ $dt->cnee_name }}</td>
                <td>{{ $dt->hbl }}</td>
                <td>{{ $dt->container }}</td>
                <td>{{ $dt->weight }}</td>
                <td>{{ $dt->measure }}</td>
                <td>{{ $dt->min_actual }}</td>
                <td>{{ $dt->inv_soa }}</td>
            </tr>
        @endforeach
            <tr>
                <td colspan="8">Total</td>
                <td> {{ $total }}</td>
            </tr>
    </tbody>
</table>