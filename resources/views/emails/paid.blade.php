<!DOCTYPE html>
<html>
<head>
    <title>SSL:: Sendmail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
    <p>PT Sinergi Sukses Logistik,</p>
    <p>Invoice ready paid : </p>
    <table style="width:70%" border="0">
        <tr>
            <td>NO</td>
            <td style="width:3px">:</td>
            <td>{{ $details['kd_inv'] }}</td>
        </tr>
        <tr>
            <td>Vessel</td>
            <td style="width:3px">:</td>
            <td>{{ $details['vessel'] }}</td>
        </tr>
        <tr>
            <td>CNEE</td>
            <td style="width:3px">:</td>
            <td>{{ $details['cnee_name'] }}</td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td style="width:3px">:</td>
            <td >{{ date('d-m-Y',strtotime($details['tanggal'])) }}</td>
        </tr>
        <tr>
            <td>Jumlah</td>
            <td style="width:3px">:</td>
            <td>{{ Helper::Rupiah($details['jumlah']) }}</td>
        </tr>
    </table>

    <p>Please chek your Application.</p>
   
    <p>Thank you</p>
</body>
</html>