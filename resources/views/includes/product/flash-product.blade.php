
@if(strpos($prod->discount_date, '-') !== false || strpos($prod->discount_date, '/') !== false)

@if(Carbon\Carbon::now()->format('Y-m-d') < Carbon\Carbon::parse($prod->discount_date)->format('Y-m-d'))

												{{-- If This product belongs to vendor then apply this --}}
                                                @php
													$product = new \App\Models\Product();
                                                    $price = $product->showPrice($prod->price);
                                                    $name = $product->showName($prod->name);
                                                    if(isset($prod->name_ar)){
                                                        $name = $prod->name_ar;
                                                    }
                                                    @endphp
												{{-- check  If This vendor status is active --}}
												@if($product->user->is_vendor == 2)
												<a href="{{ route('front.product', $prod->slug) }}" class="item">
												@if($prod->is_official == 1)
    											<center>
    											     <span calss="offi text-light" style="font-size: 13px;z-index :1; background-color:#d81e26;color:#fff;padding-left:5px;padding-right:5px;" > {{$langg->official_store}} </span>
    											</center>
    											@endif
													<div class="item-img">
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
                                                            $price = $product->showPrice($prod->price);
                                                            $name = $product->showName($prod->name);
                                                            if(isset($prod->name_ar)){
                                                                $name = $prod->name_ar;
                                                            }
                                                            $previous_price = $product->showPreviousPrice($prod->previous_price);
														@endphp
														<h4 class="price">{{ $price }} <del><small>{{ $previous_price }}</small></del></h4>
																<h5 class="name">{{ $name }}</h5>
																<div class="item-cart-area">
																	@if($prod->product_type == "affiliate")
																		<span class="add-to-cart-btn affilate-btn"
																			data-href="{{ route('affiliate.product', $prod->slug) }}"><i class="icofont-cart"></i>
																			{{ $langg->lang251 }}
																		</span>
																	@else
																		@if($prod->emptyStock())
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
													
							<div class="deal-counter">
								<div data-countdown="{{ $prod->discount_date }}"></div>
						</div>
												</a>
				                                @endif

												{{-- If This product belongs admin and apply this --}}


				<a href="{{ route('front.product', $prod->slug) }}" class="item">
				    @if($prod->is_official == 1)
    											<center>
    											     <span calss="offi text-light" style="float:right!important;padding-bottom:5px!important;font-size: 13px;z-index :1; background-color:#d81e26;color:#fff;padding-left:5px;padding-right:5px;" > {{$langg->official_store}} </span>
    											</center>
    											@endif
					<div class="item-img">
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
                            $price = $product->showPrice($prod->price);
                            $name = $product->showName($prod->name);
                            if(isset($prod->name_ar)){
                                $name = $prod->name_ar;
                            }
                            $previous_price = $product->showPreviousPrice($prod->previous_price);
						@endphp

						<h4 class="price">{{ $price }} <del><small>{{ $previous_price }}</small></del></h4>
								<h5 class="name">{{ $name }}</h5>
								<div class="item-cart-area">
															@if($prod->product_type == "affiliate")
																<span class="add-to-cart-btn affilate-btn" data-href="{{ route('affiliate.product', $prod->slug) }}"><i class="icofont-cart"></i> {{ $langg->lang251 }}
																</span>
															@else
																<span class="add-to-cart add-to-cart-btn" data-href="{{ route('product.cart.add',$prod->id) }}">
																	<i class="icofont-cart"></i> {{ $langg->lang56 }}
																</span>
																<span class="add-to-cart-quick add-to-cart-btn" data-href="{{ route('product.cart.quickadd',$prod->id) }}">
																	<i class="icofont-cart"></i> {{ $langg->lang251 }}
																</span>
															@endif
								</div>
					</div>
					
		<div class="deal-counter">
		<div data-countdown="{{ $prod->discount_date }}"></div>
		</div>
				</a>



								@endif				

@endif