<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width-device-width,initial-scale-1,shrink-to-fit=no">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title>Print Test INV</title>    

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">


    <style>
      body{
        margin-top: 250px;
        font-size: 13px;
      }


#header,
#footer {
  position: fixed;
  left: 0;
  right: 0;
  color: black;
  font-size: 0.9em;
}

#header {
  top: 0;
  border-bottom: 0.1pt solid #aaa;
}

#footer {
  bottom: 0;
  border-top: 0.1pt solid #aaa;
}

#header table,
#footer table {
  width: 100%;
  border-collapse: collapse;
  border: none;
}

#header td,
#footer td {
  padding: 0;
  width: 50%;
}

.page-number {
  text-align: center;
}

.page-number:after { 
  counter-increment: pages; 
  content: counter(page) " of " counter(pages); 
 }

hr {
  page-break-after: always;
  border: 0;
}


#footer {
  bottom: 0;
  border-top: 0.1pt solid #aaa;
}



#pageCounter {
  counter-reset: pageTotal;
}
#pageCounter span {
  counter-increment: pageTotal; 
}
#pageNumbers {
  counter-reset: currentPage;
}
#pageNumbers div:before { 
  counter-increment: currentPage; 
  content: "Page " counter(currentPage) " of "; 
}
#pageNumbers div:after { 
  content: counter(pageTotal); 
}

    </style>    
</head>

<body>

<div id="header">

 <table border="0" cellpadding="0" cellspacing="2" style="width: 100%;">
      <tr>
        <td style="width:50%;" valign="top"> 
          <img src="<?php echo 'data:image/jpg;base64,'.base64_encode(file_get_contents('./images/logo_ssl.png')); ?>"><br>
          PT. SINERGI SUKSES LOGISTIK <br>
          GAJAH MADA PLAZA FL 19#07 <br>
          JL. GAJAH MADA NO.19-26 <br>
          JAKARTA 10130
        </td>
        <td style="width:50%; border:0.1px solid;">
          TO CONSIGNE : <br>
          {{ $cus->customer }}<br>
          {{ $cus->address }}<br>
          {{ $cus->email }}<br>
          {{ $cus->pic }}<br>
          {{ $cus->npwp }}
          <p></p>
          Customer Reference : {{ $shipping->kd_cus }}
        </td>
      </tr>      
    </table>  
    <table style=" width: 100%">
        <tr>
          <th>NO</th>
          <th style="text-align:center;">KODE</th>
          <th style="text-align:center">KETERANGAN</th>
          <th style="text-align:center">JUMLAH</th>
        </tr>
    </table>  
</div>



        @php
          $no = 1; 
          $brs = 1;       
        @endphp       

        @foreach ($details as $detail)
        @php
          $brs++;
        @endphp
        <table style=" width: 100%;border: 1px solid;">
        <tr>
          <td style=" width: 25%;">{{ $no++ }}</td>
          <td style=" width: 25%;">{{ $detail->kd_chg }}</td>
          <td style=" width: 25%;">{{ $detail->keterangan }}</td>
          <td style=" width: 25%;">{{ $detail->jumlah }}</td>
        </tr>
        </table>
        @if ($no == 15)
          @php
            $brs = 1;        
          @endphp

          <div id="footer">
            <div class="page-number" id="pageNumbers">{{ $PAGE_COUNT }}</div>
          </div>

              <hr>

            @endif
        @endforeach







   
</body>
</html>

