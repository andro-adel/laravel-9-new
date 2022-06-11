@extends('layouts.front')
@section('content')
<!-- User Dashbord Area Start -->
<section class="user-dashbord">
    <div class="container">
        <div class="row">
            @include('includes.user-dashboard-sidebar')
            <div class="col-lg-8">
                <div class="user-profile-details">
                    <div class="order-details">

                        <div class="process-steps-area">
                            <table id="example" class="table table-hover dt-responsive" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th>{{ $langg->lang278 }}</th>
														<th>{{ $langg->lang279 }}</th>
														<th>{{ $langg->lang280 }}</th>
														<th>{{ $langg->lang281 }}</th>
														<th>{{ $langg->lang282 }}</th>
													</tr>
												</thead>
												<tbody>
													 @foreach($cart->items as $key => $product)
													<tr>
														<td>
																{{$product['item']['name']}}
														</td>
														<td>
																{{$product['qty']}}
														</td>
														<td>
																{{$product['price']}}
														</td>
														<td>
																<img class="xzoom5" id="xzoom-magnific" src="{{asset('assets/images/products/'.$product['item']['photo'])}}">
														</td>
														<td>
																<a class="btn btn-danger" href="{{route('user.cancel.item',['order'=>$order->id,'id'=>$key])}}">remove item</button>
														</td>
													</tr>
													@endforeach
												</tbody>
											</table>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection