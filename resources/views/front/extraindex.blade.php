@if($ps->flash_deal == 1)
    <!-- Electronics Area Start -->
    <section class="categori-item electronics-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 remove-padding">
                    <div class="section-top" style="background:#4E53E1 !important">
                        <h2 class="section-title">
                            {{ $langg->lang31 }}
                            <a href="{{route('front.seeall','latest')}}" class="link">{{ $langg->see_all }}</a>
                        </h2>
                        
                       
                    </div>
                </div>
            </div>
            <div class="row" style="background:white;padding:3px">
                <div class="col-lg-12">
                    <div class="flash-deals">
                        <div class="flas-deal-slider">
                            @foreach($latest_products as $prod)
                                @include('includes.product.list-product')
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Electronics Area End-->
@endif
@if($ps->hot_sale == 1)
    <!-- Hot sale Area Start -->
    <section class="categori-item electronics-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 remove-padding">
                    <div class="section-top" style="background:#4E53E1 !important">
                        <h2 class="section-title">
                            {{ $langg->lang30 }}
                            <a href="{{route('front.seeall','hot')}}" class="link">{{$langg->see_all}}</a>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row" style="background:white;padding:3px">
                <div class="col-lg-12">
                    <div class="flash-deals">
                        <div class="flas-deal-slider item-list">
                            @foreach($hot_products as $prod)
                                @include('includes.product.list-product')
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Hot sale Area End -->
@endif
    <!-- Hot sale Area Start -->
    <section class="categori-item electronics-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 remove-padding">
                    <div class="section-top" style="background:#4E53E1 !important">
                        <h2 class="section-title">
                            {{ $langg->langbordf }}
                            <a href="{{route('front.seeall','is_abroad')}}" class="link">{{$langg->see_all}}</a>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row" style="background:white;padding:3px">
                <div class="col-lg-12">
                    <div class="flash-deals">
                        <div class="flas-deal-slider item-list">
                            @foreach($abrod_products as $prod)
                                @include('includes.product.is-abroad')
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Hot sale Area End -->
@if($ps->best == 1)
    <!-- Phone and Accessories Area Start -->
    <section class="phone-and-accessories categori-item">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 remove-padding">
                    <div class="section-top" style="background:#4E53E1 !important">
                        <h2 class="section-title">
                            {{ $langg->lang27 }}
                            <a href="{{route('front.seeall','best')}}" class="link">{{$langg->see_all}}</a>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row" style="background:white;padding:3px">
                <div class="col-lg-12">
                    <div class="flash-deals">
                        <div class="flas-deal-slider item-list">
                            @foreach($best_products as $prod)
                                @include('includes.product.is-abroad')
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Phone and Accessories Area ENd-->
@endif

@if($ps->flash_deal == 1)
    <!-- Flash Deals Area Start -->
    <section class="categori-item electronics-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 remove-padding">
                    <div class="section-top" style="background:#4E53E1 !important">
                        <h2 class="section-title">
                            {{ $langg->lang244 }}
                            <a href="{{route('front.seeall','is_discount')}}" class="link">{{$langg->see_all}}</a>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row" style="background:white;padding:3px">
                <div class="col-lg-12">
                    <div class="flash-deals">
                        <div class="flas-deal-slider">

                            @foreach($discount_products as $prod)
                                @include('includes.product.flash-product')
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Flash Deals Area End-->
@endif

@if($ps->large_banner == 1)
    <!-- Banner Area One Start -->
    <section class="banner-section">
        <div class="container">
            @foreach($large_banners->chunk(1) as $chunk)
                <div class="row" style="background:white;padding:3px">
                    @foreach($chunk as $img)
                        <div class="col-lg-12 remove-padding">
                            <div class="img">
                                <a class="banner-effect" href="{{ $img->link }}">
                                    <img src="{{asset('assets/images/banners/'.$img->photo)}}" alt="">
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </section>
    <!-- Banner Area One End -->
@endif

@if($ps->top_rated == 1)
    <!-- Top Products Area Start -->
    <section class="categori-item electronics-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 remove-padding">
                    <div class="section-top" style="background:#4E53E1 !important">
                        <h2 class="section-title">
                            {{ $langg->lang28 }}
                            <a href="{{route('front.seeall','top')}}" class="link">{{$langg->see_all}}</a>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row" style="background:white;padding:3px">

                        @foreach($top_products as $prod)
                            @include('includes.product.top-product')
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Top Products  Area End-->
@endif

@if($ps->bottom_small == 1)
    <!-- Banner Area One Start -->
    <section class="banner-section">
        <div class="container">
            @foreach($bottom_small_banners->chunk(3) as $chunk)
                <div class="row" style="background:white;padding:3px">
                    @foreach($chunk as $img)
                        <div class="col-lg-4 remove-padding">
                            <div class="left">
                                <a class="banner-effect" href="{{ $img->link }}" target="_blank">
                                    <img src="{{asset('assets/images/banners/'.$img->photo)}}" alt="">
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

@if($ps->big == 1)
    <!-- Clothing and Apparel Area Start -->
    <section class="categori-item clothing-and-Apparel-Area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 remove-padding">
                    <div class="section-top" style="background:#4E53E1 !important">
                        <h2 class="section-title">
                            {{ $langg->lang29 }}
                            <a href="{{route('front.seeall','big')}}" class="link">{{$langg->see_all}}</a>
                        </h2>

                    </div>
                </div>
            </div>
            <div class="row" style="background:white;padding:3px">
                        <div class="col-lg-12">
                            <div class="flash-deals">
                                <div class="flas-deal-slider item-list">
                                    @foreach($big_products as $prod)
                                        @include('includes.product.is-abroad')
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </section>
    <!-- Clothing and Apparel Area start-->
@endif

@if($ps->hot_sale == 1)
    <!-- hot-and-new-item Area Start -->
    <section class="hot-and-new-item">
        <div class="container">
            <div class="row" style="padding:3px">
                <div class="col-lg-12">
                    <div class="accessories-slider">
                        <div class="slide-item">
                            <div class="row">

                                <div class="col-lg-6 col-sm-6">
                                    <div class="categori">
                                        <div class="section-top" style="background:#4E53E1 !important">
                                            <h2 class="section-title">
                                                {{ $langg->lang32 }}
                                                <a href="{{route('front.seeall','trending')}}" class="link">{{$langg->see_all}}</a>
                                            </h2>
                                        </div>


                                        <div class="hot-and-new-item-slider">

                                            @foreach($trending_products->chunk(3) as $chunk)
                                                <div class="item-slide">
                                                    <ul class="item-list">
                                                        @foreach($chunk as $prod)
                                                            @include('includes.product.list-product')
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endforeach

                                        </div>

                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6">
                                    <div class="categori">
                                        <div class="section-top" style="background:#4E53E1 !important">
                                            <h2 class="section-title">
                                                {{ $langg->lang33 }}
                                                <a href="{{route('front.seeall','sale')}}" class="link">{{$langg->see_all}}</a>
                                            </h2>
                                        </div>

                                        <div class="hot-and-new-item-slider">

                                            @foreach($sale_products->chunk(3) as $chunk)
                                                <div class="item-slide">
                                                    <ul class="item-list">
                                                        @foreach($chunk as $prod)
                                                            @include('includes.product.list-product')
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Clothing and Apparel Area start-->
@endif

@if($ps->review_blog == 1)
    <!-- Blog Area Start -->
    <section class="blog-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="aside">
                        <div class="slider-wrapper">
                            <div class="aside-review-slider">
                                @foreach($reviews as $review)
                                    <div class="slide-item">
                                        <div class="top-area">
                                            <div class="left">
                                                <img src="{{ $review->photo ? asset('assets/images/reviews/'.$review->photo) : asset('assets/images/noimage.png') }}"
                                                     alt="">
                                            </div>
                                            <div class="right">
                                                <div class="content">
                                                    <h4 class="name">{{ $review->title }}</h4>
                                                    <p class="dagenation">{{ $review->subtitle }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <blockquote class="review-text">
                                            <p>
                                                {!! $review->details !!}
                                            </p>
                                        </blockquote>
                                    </div>
                                @endforeach


                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    @foreach(DB::table('blogs')->orderby('views','desc')->take(2)->get() as $blogg)

                        <div class="blog-box">
                            <div class="blog-images">
                                <div class="img">
                                    <img src="{{ $blogg->photo ? asset('assets/images/blogs/'.$blogg->photo):asset('assets/images/noimage.png') }}"
                                         class="img-fluid" alt="">
                                    <div class="date d-flex justify-content-center">
                                        <div class="box align-self-center">
                                            <p>{{date('d', strtotime($blogg->created_at))}}</p>
                                            <p>{{date('M', strtotime($blogg->created_at))}}</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="details">
                                <a href='{{route('front.blogshow',$blogg->id)}}'>
                                    <h4 class="blog-title">
                                        {{mb_strlen($blogg->title,'utf-8') > 40 ? mb_substr($blogg->title,0,40,'utf-8')."...":$blogg->title}}
                                    </h4>
                                </a>
                                <p class="blog-text">
                                    {{substr(strip_tags($blogg->details),0,170)}}
                                </p>
                                <a class="read-more-btn"
                                   href="{{route('front.blogshow',$blogg->id)}}">{{ $langg->lang34 }}</a>
                            </div>
                        </div>

                    @endforeach

                </div>
            </div>
        </div>
    </section>
    <!-- Blog Area start-->
@endif

@if($ps->partners == 1)
    <!-- Partners Area Start -->
    <section class="partners">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-top" style="background:#4E53E1 !important">
                        <h2 class="section-title">
                            {{ $langg->lang236 }}
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div style="background:white" class="partner-slider">
                        @foreach($partners as $data)
                            <div class="item-slide">
                                <a href="{{ $data->link }}" target="_blank">
                                    <img src="{{asset('assets/images/partner/'.$data->photo)}}" alt="">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Partners Area Start -->
@endif

@if($ps->service == 1)

    {{-- Info Area Start --}}
    <section class="info-area">
        <div class="container">

            @foreach($services->chunk(4) as $chunk)

                <div class="row">

                    <div class="col-lg-12 p-0">
                        <div class="info-big-box">
                            <div class="row">
                                @foreach($chunk as $service)
                                    <div class="col-6 col-xl-3 p-0">
                                        <div class="info-box">
                                            <div class="icon">
                                                @if(session('language') == null || session('language') == 2)
                                                <img src="{{ asset('assets/images/services/'.$service->photo) }}">
                                                @elseif(session('language') == 1)
                                                 <img src="{{ asset('assets/images/services/'.$service->photo) }}">
                                                @endif
                                            </div>
                                            <div class="info">
                                                <div class="details">
                                                <h4 class="title">
                                                        @if(session('language') == null || session('language') == 2)
                                                            {{ $service->title_ar }}
                                                       @elseif(session('language') == 1)
                                                            {{ $service->title }}
                                                        @endif
                                                    </h4>
                                                    <p class="text">
                                                        @if(session('language') == null || session('language') == 2)
                                                            {!! $service->details_ar !!}
                                                        @elseif(session('language') == 1)
                                                            {!! $service->details !!}
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>

            @endforeach

        </div>
    </section>
    {{-- Info Area End  --}}

@endif

<!-- main -->
<script src="{{asset('assets/front/js/mainextra.js')}}"></script>