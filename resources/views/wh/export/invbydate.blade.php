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
    <td colspan="2">LAPORAN BY PRIODE </td>
  </tr>
  <tr>
    <td>Tanggal</td><td>{{ $awal }}</td><td>{{ $akhir }}</td>
  </tr>
</table>

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
        <th>METHOD</th>
      </tr>  
      @php
        $total =  0;              
      @endphp                      
     @foreach ($manifest as $man)         
        @php
          $total = $total + $man->inv_wh;
        @endphp
        <tr>
            <td>{{ $man->hbl }}</td>
            <td>{{ $man->term }}</td>
            <td>{{ $man->cnee_name }}</td>
            <td>{{ $man->cnee_npwp}}</td>
            <td>{{ Str::limit($man->cnee_address,35)}}</td>
            <td>{{ $man->vessel}}</td>
            <td>{{ Helper::TglIndo($man->eta) }}</td>
            <td>{{ Helper::FormatInvWh($man->kd_inv) }}</td>
            <td>{{ $man->inv_wh }}</td>
            <td>{{ date('d-m-Y', strtotime($man->tgl_inv)) }}</td>
            <td>
                @if (isset($man->tgl_paid))
                   {{ date('d-m-Y', strtotime($man->tgl_paid))}}
                @endif
            </td>
            <td>
                @if ($man->paid_at == 1)
                   EDC
                @endif
                @if ($man->paid_at == 2)
                   Transfer
                @endif
            </td>            
        </tr>
    @endforeach
      <tr>
        <td colspan="7"></td>
        <td> Total</td>
        <td> {{ $total }}</td>
      </tr>
</table>
