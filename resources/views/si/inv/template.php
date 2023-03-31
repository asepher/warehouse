
<hr>
  <div class="container">
       
      <div class="card border"> 

        <div class="card-header py-2 bg-primary text-white">
            <div class="row align-items-center">
              <div class="col-md-9">
                <h4 class="mb-0">Create Invoice</h4>
                <strong>SI Ref : {{ $si }}</strong>
              </div>

          <div class="col-sm-2 text-end">

                  <form action="{{ route('si.inv.viewpdf') }}" method="post">
                      @csrf
                      <input type="hidden" name="tipe" value="{{ $tipe }}">
                      <input type="hidden" name="si" value="{{ $si }}">
                      <button type="submit" class="btn btn-white btn-sm px-3" 
                      @if ($hit == 0)
                        disabled
                      @endif
                      >Export PDF</button>
                    </form>
      


                </div>


              <div class="col-md-1 text-end">
                
                    <div class="fs-5 ms-auto dropdown">
                            <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown">  
        <i class="bi bi-three-dots-vertical"></i>                              
                            </div>
                              <ul class="dropdown-menu dropdown-menu-end">                                 
                                <li style="font-size: 14px">
                                      <form action="{{ route('si.inv.posting') }}" method="post">
                                         @csrf
                                          <input type="hidden" name="tipe" value="{{ $tipe }}">
                                          <input type="hidden" name="si" value="{{ $si }}">
                                         <button type="submit" class="dropdown-item"

                      @if ($hit == 0 || $cek->is_posting == 1)
                        disabled
                      @endif

                                         >Posting</button>
                                      </form>
                                </li>
                              </ul>
                          </div>



              </div>
            </div>          
        </div>


      </div>

  </div>


 <header>
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
    </header>

