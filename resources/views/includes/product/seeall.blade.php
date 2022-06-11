			@if (count($data) > 0)
					@foreach ($data as $key => $prod)
									<div class="col-lg-4 col-md-4 col-6 remove-padding">


										<a href="{{ route('front.product', $prod->slug) }}" class="item">
										    @if($prod->is_official == 1)
											<center>
											     <span calss="offi text-light" style="float:right!important;padding-bottom:5px!important;font-size: 13px;z-index :1; background-color:#d81e26;color:#fff;padding-left:5px;padding-right:5px;" > {{$langg->official_store}} </span>
											</center>
											@endif
											<div class="item-img" style="z-index :1;">
												@if(!empty($prod->features))
													<div class="sell-area">
													  @foreach($prod->features as $key => $data1)
														<span class="sale" style="background-color:{{ $prod->colors[$key] }}">{{ $prod->features[$key] }}</span>
														@endforeach
													</div>
												@endif
													<div class="extra-list">
														<ul>
															<li>
																@if(Auth::guard('web')->check())

																<span class="add-to-wish" data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip" data-placement="right" title="{{ $langg->lang54 }}" data-placement="right"><i class="icofont-heart-alt" ></i>
																</span>

																@else

																<span rel-toggle="tooltip" title="{{ $langg->lang54 }}" data-toggle="modal" id="wish-btn" data-target="#comment-log-reg" data-placement="right">
																	<i class="icofont-heart-alt"></i>
																</span>

																@endif
															</li>
															<li>
															<span class="quick-view" rel-toggle="tooltip" title="{{ $langg->lang55 }}" href="javascript:;" data-href="{{ route('product.quick',$prod->id) }}" data-toggle="modal" data-target="#quickview" data-placement="right"> <i class="icofont-eye"></i>
															</span>
															</li>
														</ul>
													</div>
												
												<img class="img-fluid" src="{{ $prod->thumbnail ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}" alt="">
											</div>
											<div class="info">
												<div class="stars">
                            <div class="ratings">
                                <div class="empty-stars"></div>
                                <div class="full-stars" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></div>
                            </div>
												</div>
												@php 
													$product = new \App\Models\Product();
                                                                    $price = $product->setCurrency($prod->price);
                                                                    $name = $product->showName($prod->name);
                                                                    $stock = '';
                                                                    if($prod->stock != null){
                                                                        $stock = $product->emptyStock($prod->stock);
                                                                    }
                                                                    if(isset($prod->name_ar)){
                                                                        $name = $prod->name_ar;
                                                                    }
                                                                    
                                                                    $previous_price = $product->showPreviousPrice($prod->previous_price);
												@endphp
												<h4 class="price">{{ $prod->price }} <del><small>{{ $previous_price }}</small></del></h4>
														<h5 class="name">{{ $name }}</h5>
														<div class="item-cart-area">
															@if($prod->product_type == "affiliate")
																<span class="add-to-cart-btn affilate-btn"
																	data-href="{{ route('affiliate.product', $prod->slug) }}"><i class="icofont-cart"></i>
																	{{ $langg->lang251 }}
																</span>
															@else
																@if($stock)
																<span class="add-to-cart-btn cart-out-of-stock">
																	<i class="icofont-close-circled"></i> {{ $langg->lang78 }}
																</span>
																@else
																<span class="add-to-cart add-to-cart-btn" data-href="{{ route('product.cart.add',$prod->id) }}">
																	<i class="icofont-cart"></i> {{ $langg->lang56 }}
																</span>
																<span class="add-to-cart-quick add-to-cart-btn"
																	data-href="{{ route('product.cart.quickadd',$prod->id) }}">
																	<i class="icofont-cart"></i> {{ $langg->lang251 }}
																</span>
																@endif
															@endif
														</div>
											</div>
										</a>

									</div>
				    @endforeach
				<div class="col-lg-12">
					<div class="page-center mt-5">
						{!! $data->appends(['search' => request()->input('search')])->links() !!}
					</div>
				</div>
			@else
				<div class="col-lg-12">
					<div class="page-center">
						 <h4 class="text-center">{{ $langg->lang60 }}</h4>
					</div>
				</div>
			@endif


@if(isset($ajax_check))


<script type="text/javascript">


// Tooltip Section


    $('[data-toggle="tooltip"]').tooltip({
      });
      $('[data-toggle="tooltip"]').on('click',function(){
          $(this).tooltip('hide');
      });




      $('[rel-toggle="tooltip"]').tooltip();

      $('[rel-toggle="tooltip"]').on('click',function(){
          $(this).tooltip('hide');
      });


// Tooltip Section Ends

</script>

@endif