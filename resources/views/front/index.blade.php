@extends('layouts.front')

@section('content')

	@if($ps->slider == 1)

		@if(count($sliders))
			@include('includes.slider-style')
		@endif
	@endif

	@if($ps->slider == 1)
		<!-- Hero Area Start -->
		<section class="hero-area">
		    
			@if($ps->slider == 1)

				@if(count($sliders))
			
					<div style="padding:10px" class="row">
					    
					    <div class="col-lg-3 col-sm12">
					            <div style="display:block;" class="mona categories_menu_inner w-100">
                                    <ul  >
                                        @php
                                            $i=1;
                                        @endphp
                                        @foreach($categories as $category)
            
                                            <li class="{{count($category->subs) > 0 ? 'dropdown_list':''}} {{ $i >= 12 ? 'rx-child' : '' }}">
                                                @if(count($category->subs) > 0)
                                                    <div class="img">
                                                        <img src="{{ asset('assets/images/categories/'.$category->photo) }}" alt="">
                                                    </div>
                                                    <div class="link-area">
                                                        <span><a href="{{ route('front.category',$category->slug) }}">@if(session('language') == null || session('language') == 2){{ $category->name_ar}}@else{{$category->name}}@endif</a></span>
                                                        @if(count($category->subs) > 0)
                                                            <a href="javascript:;">
                                                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                                                            </a>
                                                        @endif
                                                    </div>
            
                                                @else
                                                    <a href="{{ route('front.category',$category->slug) }}"><img src="{{ asset('assets/images/categories/'.$category->photo) }}">@if(session('language') == null || session('language') == 2){{ $category->name_ar}}@else{{$category->name}}@endif</a>
            
                                                @endif
                                                @if(count($category->subs) > 0)
            
                                                    @php
                                                        $ck = 0;
                                                        foreach($category->subs as $subcat) {
                                                            if(count($subcat->childs) > 0) {
                                                                $ck = 1;
                                                                break;
                                                            }
                                                        }
                                                    @endphp
                                                    <ul class="{{ $ck == 1 ? 'categories_mega_menu' : 'categories_mega_menu column_1' }}">
                                                        @foreach($category->subs as $subcat)
                                                            @if(session('language') == 2||session('language') == null && $subcat->name_ar != null)
                                                                <li>
                                                                <a href="{{ route('front.subcat',['slug1' => $subcat->category->slug, 'slug2' => $subcat->slug]) }}">{{$subcat->name_ar}}</a>
                                                                @if(count($subcat->childs) > 0)
                                                                    <div class="categorie_sub_menu">
                                                                        <ul>
                                                                            @foreach($subcat->childs as $childcat)
                                                                                @if($childcat->name_ar != null)
                                                                                    <li><a href="{{ route('front.childcat',['slug1' => $childcat->subcategory->category->slug, 'slug2' => $childcat->subcategory->slug, 'slug3' => $childcat->slug]) }}">{{$childcat->name_ar}}</a></li>
                                                                                @endif
                                                                            @endforeach
                                                                        </ul>
                                                                    </div>
                                                                @endif
                                                            </li>
                                                                <!-- Arabic-->
                                                              
                                                            @elseif(session('language') == 2 && $subcat->name != null) 
                                                            <li>
                                                                <a href="{{ route('front.subcat',['slug1' => $subcat->category->slug, 'slug2' => $subcat->slug]) }}">{{$subcat->name}}</a>
                                                                @if(count($subcat->childs) > 0)
                                                                    <div class="categorie_sub_menu">
                                                                        <ul>
                                                                            @foreach($subcat->childs as $childcat)
                                                                             @if($childcat->name != null)
                                                                                <li><a href="{{ route('front.childcat',['slug1' => $childcat->subcategory->category->slug, 'slug2' => $childcat->subcategory->slug, 'slug3' => $childcat->slug]) }}">{{$childcat->name}}</a></li>
                                                                             @endif
                                                                            @endforeach
                                                                        </ul>
                                                                    </div>
                                                                @endif
                                                            </li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
            
                                                @endif
            
                                            </li>
            
                                            @php
                                                $i++;
                                            @endphp
            
                                            @if($i == 14)
                                                <li>
                                                    <a href="{{ route('front.categories') }}"><i class="fas fa-plus"></i> {{$langg->lang15}} </a>
                                                </li>
                                                @break
                                            @endif
            
            
                                        @endforeach
            
                                    
                                    </ul>
                                </div>
                        </div>
					<div class="hero-area-slider col-lg-6">
						<div class="slide-progress"></div>
						<div class="intro-carousel">
							@if(session('language') == 2)
								@php
									$data_ar = App\Models\Slider_ar::all();
								@endphp
								@foreach($data_ar as $data)
									@php
										$data_ar = App\Models\Slider::find($data->id);
									@endphp									
									<div class="intro-content {{$data_ar->position}}" 
									style="background-image: url({{asset('assets/images/sliders/'.$data->photo)}})">
										<div class="container">
											<div class="row">
												<div class="col-lg-8">
													<div class="slider-content">
														<!-- layer 1 -->
														<div class="layer-1">
															<h4 style="font-size: {{$data_ar->subtitle_size}}px; color: {{$data_ar->subtitle_color}}" class="subtitle subtitle{{$data->id}}" data-animation="animated {{$data->subtitle_anime}}">{{$data->subtitle_text}}</h4>
															<h2 style="font-size: {{$data_ar->title_size}}px; color: {{$data_ar->title_color}}" class="title title{{$data->id}}" data-animation="animated {{$data->title_anime}}">{{$data->title_text}}</h2>
														</div>
														<!-- layer 2 -->
														<div class="layer-2">
															<p style="font-size: {{$data_ar->details_size}}px; color: {{$data_ar->details_color}}"  class="text text{{$data_ar->id}}" data-animation="animated {{$data_ar->details_anime}}">{{$data->details_text}}</p>
														</div>
														<!-- layer 3 -->
														<div class="layer-3">
															<a href="{{$data_ar->link}}" target="_blank" class="mybtn1"><span>{{ $langg->lang25 }} <i class="fas fa-chevron-right"></i></span></a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								@endforeach
							@else
								@foreach($sliders as $data)
									<div class="intro-content {{$data->position}}" style="background-image: url({{asset('assets/images/sliders/'.$data->photo)}})">
										<div class="container">
											<div class="row">
												<div class="col-lg-8">
													<div class="slider-content">
														<!-- layer 1 -->
														<div class="layer-1">
															<h4 style="font-size: {{$data->subtitle_size}}px; color: {{$data->subtitle_color}}" class="subtitle subtitle{{$data->id}}" data-animation="animated {{$data->subtitle_anime}}">{{$data->subtitle_text}}</h4>
															<h2 style="font-size: {{$data->title_size}}px; color: {{$data->title_color}}" class="title title{{$data->id}}" data-animation="animated {{$data->title_anime}}">{{$data->title_text}}</h2>
														</div>
														<!-- layer 2 -->
														<div class="layer-2">
															<p style="font-size: {{$data->details_size}}px; color: {{$data->details_color}}"  class="text text{{$data->id}}" data-animation="animated {{$data->details_anime}}">{{$data->details_text}}</p>
														</div>
														<!-- layer 3 -->
														<div class="layer-3">
															<a href="{{$data->link}}" target="_blank" class="mybtn1"><span>{{ $langg->lang25 }} <i class="fas fa-chevron-right"></i></span></a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								@endforeach
							@endif
						</div>
					</div>
				@endif

			@endif
			<div class="col-lg-3 remove-padding">
								<div class="left">
									
									
										<img  class="loma" style="height:190px; width:450px; padding-bottom:5px;padding-top:10px" src="{{asset('assets/images/banners/3a1a9c02-b55b-476c-b451-dad7a968ef2c.jpg')}}" alt="">
									<img class="loma" style="height:170px; width:450px;"src="{{asset('assets/images/banners/1568889164bottom1.jpg')}}" alt="">
									
									
								
								</div>
								
							</div>
</div>
		</section>
		<!-- Hero Area End -->
	@endif

	
	
@if($ps->featured == 1)
		<!-- Trending Item Area Start -->
		<section  class="trending">
			<div  class="container">
				<div class="row">
					<div class="col-lg-12 remove-padding">
						<div class="section-top"  style="background:#4E53E1 !important">
							<h2 class="section-title">
								{{ $langg->lang26 }}
								<a href="{{route('front.seeall','featured')}}" class="link">{{$langg->see_all}}</a>
							</h2>
							
						</div>
					</div>
				</div>
				<div style="background:white;padding:3px" class="row">
					<div class="col-lg-12 remove-padding">
						<div class="trending-item-slider">
							@foreach($feature_products as $prod)
								@include('includes.product.slider-product')
							@endforeach
						</div>
					</div>

				</div>
			</div>
		</section>
			@if($ps->small_banner == 1)
		<!-- Banner Area One Start -->
		<section class="banner-section">
			<div class="container" style="background:white;">
				@foreach($top_small_banners->chunk(2) as $chunk)
					<div class="row">
						@foreach($chunk as $img)
							<div class="col-lg-6 remove-padding">
								<div class="left">
									<a class="banner-effect" href="{{ $img->link }}" target="_blank">
										@php
											if(session('language') == 2 || session('language') == null){$photo = $img->photo_ar;}
											else{$photo = $img->photo;}
										@endphp
										<img src="{{asset('assets/images/banners/'.$photo)}}" alt="">
									</a>
								</div>
							</div>
						@endforeach
					</div>
				@endforeach
			</div>
		</section>
		<!-- Banner Area One Start -->
	@endif
		<!-- Tranding Item Area End -->
	@endif

	@if($ps->featured_category == 1)

		{{-- Slider buttom Category Start --}}
		<section class="slider-buttom-category d-none d-md-block">
			<div class="container-fluid">
				<div class="row" style="background:white;padding:3px">
					@foreach($categories->where('is_featured','=',1) as $cat)
						<div class="col-xl-2 col-lg-3 col-md-4 sc-common-padding">
							<a href="{{ route('front.category',$cat->slug) }}" class="single-category">
								<div class="left">
									<h5 class="title">
										{{ $cat->name }}
									</h5>
									<p class="count">
										{{ count($cat->products) }} {{ $langg->lang4 }}
									</p>
								</div>
								<div class="right">
									<img src="{{asset('assets/images/categories/'.$cat->image) }}" alt="">
								</div>
							</a>
						</div>
					@endforeach
				</div>
			</div>
		</section>
		{{-- Slider buttom banner End --}}

	@endif

	



	<section id="extraData">
		<div class="text-center">
			<img src="{{asset('assets/images/'.$gs->loader)}}">
		</div>
	</section>


@endsection

@section('scripts')
	<script>
		$(window).on('load',function() {

			setTimeout(function(){

				$('#extraData').load('{{route('front.extraIndex')}}');

			}, 500);
		});

	</script>
@endsection