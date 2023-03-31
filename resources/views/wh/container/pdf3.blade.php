<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Container PDF</title>		
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.1/css/bootstrap.min.css" integrity="sha512-siwe/oXMhSjGCwLn+scraPOWrJxHlUgMBMZXdPe2Tnk3I0x3ESCoLz7WZ5NTH6SZrywMY+PB1cjyqJ5jAluCOg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<style>
		header{
			margin-top: 50px;
			width: 50%;
			position: fixed;
			text-align: center;
			height: 50px;
			line-height: 35px;
			border-bottom: 0.1px solid;
		}
		#detail{
			margin-top: 150px;

			background-color: yellow;
		}
		footer{
			width: 50%;
			position: fixed;
			text-align: center;
			height: 100px;
			line-height: 35px;			
		}
	</style>
</head>
<body>
	<header>CONTAINER</header>
<div id="detail">
<table style="width:50%;" class="mt-5">
		@foreach ($container as $cont)
		<tr>
			<td  style="border-bottom: 0.1px solid;">{{ $cont->container }}</td>
		</tr>
		@endforeach	
</table>
</div>

<footer>
	<p>Date {{ date("Y-m-d h:i A") }}</p>
</footer>	

<script type="text/php">
    if (isset($pdf)) {

			$pdf->page_text(60, $pdf->get_height() - 40, "{PAGE_NUM} of {PAGE_COUNT}", null, 12, array(0,0,0));        
    }
</script>
</body>
</html>

