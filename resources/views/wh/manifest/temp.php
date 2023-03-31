
 //dd($invmaster);
          InvWhMaster::create($invmaster);

            $manifest     = Manifest::where('container',$container)->where('term','FOB')->get(); 
            foreach ($manifest as $man ) {
                $dtheader = [
                   'seq'         =>  $value->seq,                              
                   'kd_inv'      =>  $kd_inv,
                   'tipe'        =>  'DN',
                   'kd_vsl'      =>  $vsl,
                   'term'        =>  'FOB',
                   'container'      =>  $data['cont'],
                   'kd_cnee'           => $value->kd_cnee, 
                   'cnee_name'         => $value->cnee_name, 
                   'cnee_address'      => $value->cnee_address, 
                   'cnee_npwp'         => $value->cnee_npwp, 
                   'kd_forwader'       => $value->kd_forwader,    
                   'forwader_name'     => $value->forwader_name, 
                   'forwader_address'  => $value->forwader_address,  
                   'forwader_npwp'     => $value->forwader_npwp,  
                   'jumlah'            =>  0,
                   'tgl_gen'           =>  now(),  
                   ];
                InvDnHeader::create($dtheader);


                foreach ($tarif as $trf) {
                  

                                       if ($tr->is_adm == 1) {
                                          $weight = 0;
                                          $measure = 0;
                                          $vol_actual = 1;
                                       } else {
                                          $weight = $value->weight;
                                          $measure = $value->weight;
                                          $vol_actual = $value->min_actual;
                                       }

                                       $dtDtl = [                                         
                                          'seq'       => $value->seq, 
                                          'kd_inv'    => $kd_inv, 
                                          'tipe'      => 'DN', 
                                          'term'      => 'FOB', 
                                          'kd_vsl'    => $vsl,
                                          'kd_tarif'   => $tr->kd_tarif, 
                                          'nama_tarif' => $tr->nama_tarif, 
                                          'tarif'      => $tr->jumlah, 
                                          'weight'      => $weight, 
                                          'measure'     => $measure, 
                                          'vol_actual'  => $vol_actual, 
                                          'wm'        => 0,
                                          'jumlah'    => $vol_actual*$tr->jumlah,
                                          'ppn'       => $tr->ppn, 
                                          'container' => $request->container, 
                                      ];
                                      InvDnDetail::create($dtDtl);         
                                     }



                }
            }




<li>
		<a class="dropdown-item" href="{{ route('wh.manifest.destroy',[$man->id]) }}"
		 onclick="event.preventDefault();
 document.getElementById('posting-form').submit();
 alert('Are you sure? ');"        		
			@if ($man->is_posting == 1)
    		style="pointer-events: none;" 
 		@endif
 		>Delete
 		</a>
 		<form id="posting-form" action="{{ route('wh.manifest.destroy',[$man->id]) }}" 	method="POST">
	{{ csrf_field() }}
	<input type="hidden" name="id" value="{{ $man->id }}">
</form>


	</li>

	
      //dd($invdn_header);
      return view('wh.invoice.generatedn',[        
         'container'   => $container,
         'vessel'   => $vessel,
         'jumcon'   =>  $jumcon,
         'invdn_header' => $invdn_header,
      ]);   

   }