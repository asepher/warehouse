@extends('layouts.app')

@section('title')
    Surat Jalan    
@endsection

@section('content')
   @php
       $cek = App\Models\Sjdtl::where('kd_sj', $id)->count();
   @endphp

    <div class="card border">

      <div class="card-header py-2 bg-primary text-white">                            
            <div class="row align-items-center">
                <div class="col-sm-9">
                    <h4 class="mb-0">Surat Jalan</h4>
                    <strong>{{ $id }}</strong>
                </div>
                <div class="col-sm-2 text-end">
                    <a href="{{ route('sj.detail.preview',[$id]) }}" class="btn btn-white btn-sm px-3" 
                     target="_blank"
                        @if ($cek == 0)
                           style="pointer-events: none;" 
                        @endif
                     >Print PDF</a>  
                </div>
                <div class="col-sm-1 text-end">

                    <div class="fs-5 ms-auto dropdown">
                            <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" 
                            data-bs-toggle="dropdown"><i class="bi bi-three-dots-vertical"></i>
                            </div>
                              <ul class="dropdown-menu dropdown-menu-end">                                 
                                <li style="font-size: 14px">

                                          <form action="{{ route('sj.posting',[$id] ) }}" method="post">
                                             @csrf
                                             <button type="submit" class="dropdown-item"
                        @if ($cek == 0)
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

      <div class="card-body">                
             <div class="row">
                 <div class="col-sm-6">
                     
                      <form class="form-horizontal" role="form" action="{{ route('sj.store.detail',[$id]) }}" 
                      method="post">
                         {{ csrf_field() }}

                         <div class="mb-3 row">
                             <label class="col-md-3 col-form-label"><strong>Tanggal</strong></label>
                             <div class="col-md-9">
                                 <input type="date" name="tanggal" 
                                 class="form-control font-w500 font-size-sm" placeholder="yyyy/mm/dd" 
                                 value="{{ $hd->tanggal }}" id="datepicker-autoclose">
                                 @if($errors->has('tanggal'))
                                     <div class="text-danger">
                                         {{ $errors->first('tanggal')}}
                                     </div>
                                 @endif            
                             </div>
                         </div>

                          <div class="mb-3 row">
                             <label class="col-sm-3 col-form-label"><strong>Type</strong></label>
                             <div class="col-md-9">
                                 <select class="form-control" name="document">
                                     <option value="">-- Pilih --</option>
                                     @foreach ($param as  $c)
                                       <option value="{{ $c->param2 }}">{{ $c->param2 }}</option> 
                                     @endforeach
                                 </select>
                                 @if($errors->has('document'))
                                     <div class="text-danger">
                                         {{ $errors->first('document')}}
                                     </div>
                                 @endif
             
                             </div>
                         </div>

                         <div class="mb-3 row">
                             <label class="col-md-3 col-form-label"><strong>Note</strong></label>
                             <div class="col-md-9">
                                 <textarea class="form-control" 
                                 rows="3" name="note">{{ old('note') }}</textarea>
                                  @if($errors->has('note'))                         
                                     <div class="text-danger">
                                         {{ $errors->first('note')}}
                                     </div>
                                 @endif
                             </div>
                         </div>
                      
                         <div class="mb-3 row">
                             <label class="col-sm-3 col-form-label"><strong>Jumlah</strong></label>
                             <div class="col-md-5">
                                 <input type="number" name="jumlah" class="form-control" 
                                 value="{{ old('jumlah') }}" autocomplete="off">
                                   @if($errors->has('jumlah'))
                                     <div class="text-danger font-w300 font-size-sm">
                                         {{ $errors->first('jumlah')}}
                                     </div>
                                 @endif
             
                             </div>
                         </div>

                         <div class="mb-3 row">
                             <label class="col-sm-3 col-form-label"><strong>Satuan</strong></label>
                             <div class="col-md-5">
                                 <select name="satuan" class="form-control">
                                     <option value="">-- Pilih --</option>
                                     <option value="Lembar">Lembar</option>
                                     <option value="Lembar">Kg</option>
                                 </select>
                                 @if($errors->has('satuan'))
                                     <div class="text-danger">
                                         {{ $errors->first('satuan')}}
                                     </div>
                                 @endif
                             </div>
                         </div>


                         <div class="mb-3 row">
                             <label for="" class="col-md-3"></label>
                             <div class="col-md-9">
                                     <button type="submit" class="btn btn-primary btn-sm px-3"
                                       @if ($hd->is_posting == 1)
                                            disabled 
                                       @endif
                                     >Submit</button>
                             </div>
                         </div>

                      </form>





                 </div>
                 <div class="col-sm-6">

                     @if (session('error'))
                         <div class="alert alert-danger">
                             {{ session('error') }}
                         </div>
                     @endif
                     <table class="table align-middle">
                        <thead class="bg-light">
                          <tr>
                             <th class="text-center">#</th>
                             <th class="text-center">Document</th>                 
                             <th class="text-center">Jumlah</th>                 
                             <th class="text-center">X</th>                 
                          </tr>               
                        </thead>       
                        <tbody>
                         @php
                             $no=1;
                         @endphp
                         @foreach ($detail as $d)
                         <tr>
                             <td scope="row">{{ $no++ }}</td>
                             <td>{{ $d->note }}</td>
                             <td>
                                 {{ $d->jumlah . " " . $d->satuan }}</td>
                             <td width="5">


   <div class="fs-5 dropdown">
                            <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown" style="font-size: 12px">
                                <i class="bi bi-three-dots"></i></div>

                              <ul class="dropdown-menu dropdown-menu-end" >
                                <li style="font-size: 14px"><a class="dropdown-item" 
                                    href="{{ route('sj.detail.edit',[$d->kd_sj,$d->id]) }}"
                                @if ($d->is_posting == 1)
                                    style="pointer-events: none;" 
                                 @endif
                                 >Edit</a>
                               </li> 
                               <li><hr class="dropdown-divider"></li> 
                               <li style="font-size: 14px">
                                    <form action="{{ route('sj.delete.detail',[$d->kd_sj,$d->id] ) }}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="dropdown-item" onclick="return confirm('Anda yakin menghapus data ?')">Delete</button>
                                            </form>
                               </li>
                               
                              </ul>
                          </div>


                             </td>
                         </tr>
                         @endforeach
                         </tbody>
                     </table>            

                                        
                 </div>
                 


             </div>
             <!-- END Row -->

      </div>        
    </div>    

@endsection


