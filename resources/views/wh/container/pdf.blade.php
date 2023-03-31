<html>
    <head>
        <style>
            /** Define the margins of your pdf page **/          
            header {
                position: fixed;
                top: 0px;
                left: 0px;
                right: 0px;
                height: 110px;
                background-color: yellow;               
            }

            footer {
                position: fixed; 
                bottom: -100px; 
                left: 0px; 
                right: 0px;
                height: 100px; 
               
            }
            main{
               margin-top: 150px;               
            }

        </style>
    </head>
    <body>
        <!-- Define dompdf header and footer blocks before your subject matter content -->
        <header>

                <table style="width:100%;">
                <tr>
                    <td>    <img src="<?php echo 'data:image/jpg;base64,'.base64_encode(file_get_contents('./images/logo_ssl.png')); ?>" >
                    </td>                       
                    <td width="45%" style="font-size:14px">
                        <strong>PT. SINERGI SUKSES LOGISTIK </strong><br>
                        Gajah Mada Tower Fl 19th #7 <br>
                        Jl. Gajah Mada No. 19-26 , Jakarta 10130 - Indonesia <br>
                        Phone : +62 21 63851866  Fax : +62 21 6338155 <br>
                        mail@sinergisukseslogistik.com <br>
                        www.sinergisukseslogistik.com                   
                    </td>
                </tr>
            </table>

        </header>

        <footer>
                <div class="right">
                  All Rights Reserved. Copyright © <?php echo date("Y");?>
</div>

               <span class="page-number">Page 
                  
<script type="text/php">
    if (isset($pdf)) {

         $pdf->page_text(60, $pdf->get_height() - 40, "{PAGE_NUM} of {PAGE_COUNT}", null, 12, array(0,0,0));        
    }
</script>               
               </span>
         
        </footer>



        <!-- Wrap the subject matter content of your PDF inside a main tag -->
        <main>          
         <table style="width:50%;">
               @php
                  $brs = 1;
               @endphp

                 @foreach ($container as $cont)
                    @php
                       $brs = $brs +1;
                    @endphp
                       <tr>
                           <td>{{ $cont->container }}</td>
                        </tr>

                 @endforeach 
         </table>



        </main>

    </body>
</html>