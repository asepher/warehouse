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
    <td colspan="2">LAPORAN HARIAN </td>
  </tr>
  <tr>
    <td>Tanggal</td><td>{{ $tgl }}</td>
  </tr>
</table>

<table style="border: 1px;" border="1">
      <tr>
        <th style="background-color: #ccdff3;">HBL</th>
        <th style="background-color: #ccdff3;">TERM</th>
        <th style="background-color: #ccdff3;">CNEE</th>
        <th style="background-color: #ccdff3;">NPWP</th>
        <th style="background-color: #ccdff3;">ADDRESS</th>
        <th style="background-color: #ccdff3;">VESSEL</th>
        <th style="background-color: #ccdff3;">ETA</th>
        <th style="background-color: #ccdff3;">INV NUMBER</th>
        <th style="background-color: #ccdff3;">AMMOUNT</th>
        <th style="background-color: #ccdff3;">DATE RELEASE</th>
        <th style="background-color: #ccdff3;">DATE PAID</th>
        <th style="background-color: #ccdff3;">DATE MEMO</th>        
        <th style="background-color: #ccdff3;">METHOD</th>
      </tr>  
      @php
        $total =  0;              
      @endphp                      
     @foreach ($data as $dt)                 
        <tr>
            <td 
            @if ($dt->paid_at == 2)
              style="background-color: #ffff4d;"
            @endif
            >{{ $dt->hbl }}</td>
            <td
            @if ($dt->paid_at == 2)
              style="background-color: #ffff4d;"
            @endif            
            >{{ $dt->term }}</td>
            <td
            @if ($dt->paid_at == 2)
              style="background-color: #ffff4d;"
            @endif
            >{{ $dt->cnee_name }}</td>
            <td
            @if ($dt->paid_at == 2)
              style="background-color: #ffff4d;"
            @endif
            >{{ $dt->cnee_npwp}}</td>
            <td
            @if ($dt->paid_at == 2)
              style="background-color: #ffff4d;"
            @endif
            >{{ $dt->cnee_address }}</td>
            <td
            @if ($dt->paid_at == 2)
              style="background-color: #ffff4d;"
            @endif
            >{{ $dt->vessel}}</td>
            <td
            @if ($dt->paid_at == 2)
              style="background-color: #ffff4d;"
            @endif
            >{{ Helper::TglIndo($dt->eta) }}</td>
            <td
            @if ($dt->paid_at == 2)
              style="background-color: #ffff4d;"
            @endif            
            >{{ Helper::FormatInvWh($dt->kd_inv) }}</td>
            @if ($dt->term == 'FOB')
              <td
              @if ($dt->paid_at == 2)
                style="background-color: #ffff4d;"
              @endif
              >0</td>
            @endif
            @if ($dt->term == 'CNF')              
              <td
              @if ($dt->paid_at == 2)
                style="background-color: #ffff4d;"
              @endif
              >{{ $dt->inv_wh }}</td>
              @php
                $total = $total + $dt->inv_wh;
              @endphp
            @endif
            <td
            @if ($dt->paid_at == 2)
              style="background-color: #ffff4d;"
            @endif
            >{{ date('d-m-Y', strtotime($dt->tgl_inv)) }}
            </td>                       
            <td
            @if ($dt->paid_at == 2)
              style="background-color: #ffff4d;"
            @endif
            >
                @if (isset($dt->tgl_paid))
                   {{ date('d-m-Y', strtotime($dt->tgl_paid))}}
                @endif
            </td>
            <td
            @if ($dt->paid_at == 2)
              style="background-color: #ffff4d;"
            @endif
            >
                @if (isset($dt->tgl_mem))
                  {{ date('d-m-Y', strtotime($dt->tgl_mem)) }}
                @endif  
            </td>            
            <td
            @if ($dt->paid_at == 2)
              style="background-color: #ffff4d;"
            @endif
            >
                @if ($dt->paid_at == 1)
                   EDC
                @endif
                @if ($dt->paid_at == 2)
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