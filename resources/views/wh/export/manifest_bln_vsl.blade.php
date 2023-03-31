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
    <td colspan="6">LAPORAN BY VESSEL </td>
  </tr>
  <tr>
    <td>Bulan</td><td colspan="5">{{ Helper::GetMonth($bln) }}</td>
  </tr>
  <tr>
     <th style="background-color: #ccdff3;text-align: center;">#</th>
     <th style="background-color: #ccdff3;text-align: center">VESSEL</th>
     <th style="background-color: #ccdff3;text-align: center">ETA</th>     
     <th style="background-color: #ccdff3;text-align: center">BL</th>
     <th style="background-color: #ccdff3;text-align: center">CONTAINER</th>     
     <th style="background-color: #ccdff3;text-align: center">POS</th>
     <th style="background-color: #ccdff3;text-align: center">FOB</th>
     <th style="background-color: #ccdff3;text-align: center">CNF</th>
  </tr>
  @foreach ($data as $vsl)
    <tr>
      <td>1</td>
      <td>{{ $vsl->vessel }}</td>
      <td>{{ $vsl->vls_bl }}</td>
      <td>{{ $vsl->vls_bl }}</td>
      <td>
        @php
          $jumlahCont = App\Models\Container::where('kd_vsl', $vsl->kd_vsl)->count();
        @endphp        
        {{ $jumlahCont }}
      </td>      
      <td>{{ $vsl->jum_pos }}</td>
      <td>

          @php
            $jumlahFob = App\Models\Manifest::where('kd_vsl', $vsl->kd_vsl)
                                          ->where('term','FOB')->count();
                  @endphp
        {{ $jumlahFob }}
      </td>
      <td>
        
         @php
                     $jumlahCnf = App\Models\Manifest::where('kd_vsl', $vsl->kd_vsl)
                                          ->where('term','CNF')->count();
                  @endphp
                     {{ $jumlahCnf }}
                     
      </td>
    </tr>
  @endforeach

</table>