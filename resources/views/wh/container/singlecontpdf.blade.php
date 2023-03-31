<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Laporan Harian</title>

    <style>

        *{
            margin: 0;
            padding: 0;
        }

        .judul {
            width: 100%;
            font-size: 12px;
            margin-left: auto;
            margin-right: auto;
            text-align: center;
            margin-top: 20px;
        }

        .content{
            margin-left: 20px;
            margin-top: 20px;
            margin-bottom: 20px;
            margin-right: 20px;
        }

        table {
            border-collapse: collapse; 
            border: 0.1px solid black;
            padding: 5px;
            font-size: 12px;
            text-align: left;
            width: 100%;
        }

        th {
            text-align: center;
            border-collapse: collapse; 
            border: 0.1px solid black;
            padding: 5px;
        }

        td{
            border-collapse: collapse; 
            border: 0.1px solid black;
        }

    </style>

</head>
<body>
   <div class="reset">
        <div class="judul">
            <h4>LAPORAN INVOICE</h4>
            <h4>CONTAINER : {{ $container }}</h4>
        </div>

        <div class="content">
            <table>
              <thead>
                <tr>
                   <th>No</th>
                   <th>No.Invoice</th>
                   <th>Cnee</th>
                   <th>Jumlah</th>
                   <th>PPN</th>
                   <th>Materai</th>
                   <th>GrandTotal</th>
                </tr>
              </thead>
              <tbody>
              	@php
              		$no = 1;
              	@endphp
              	@foreach ($whHeader as $whhd)
              	<tr>
              		<td>{{ $no++ }}</td>
              		<td>{{ $whhd->kd_inv }}</td>
              	</tr>
              	@endforeach
              </tbody>
            </table>    
        </div>

   </div>
</body>
</html>