@extends('layouts.printTemplate')

@section('content')
	<section  id="homebanner">
		<div class="container">	
			<div class="misty">
				<h1 class="maintitle landingtext">Toys and Treats Gift Voucher</h1>
				<p>A surprise gift box subscription for your dog</p>
				@if($voucher->num_of_boxes > 1)
					<p class="mainsubtitle">This gift voucher entitles you to {{{$voucher->num_of_boxes}}} deliveries</p>
				@else
					<p class="mainsubtitle">This gift voucher entitles you to {{{$voucher->num_of_boxes}}} delivery</p>
				@endif	
				<p>Voucher code: &nbsp;&nbsp;&nbsp;&nbsp;<span>{{{$voucher->voucher_code}}}</span></p>
			</div>		
		</div>	
	</section>

	<section class="bottombanner">
		<h1 class="">Redeem online at ToysAndTreats.co.uk/redeem</h1>
	</section>

@endsection