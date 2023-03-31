@extends('jquery.layout')

@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <!-- /.page-header -->
   <div class="page-header">
      <h1>Daftar Tarif</h1>
   </div><!-- /.page-header -->

   <div>
   	

<p>
Lorem ipsum dolor sit, amet consectetur adipisicing elit. Odio quia enim velit pariatur magni a dolorem consequuntur est dolores laborum temporibus eligendi, aperiam quasi cumque provident. Commodi perferendis odit asperiores.
</p>

<button id="btn">Toggle</button>


 </div>



<script>
$(document).ready(function(){
  $("#btn").click(function(){
    $("#div3").fadeIn(3000);
  });
});
</script>


@endsection
