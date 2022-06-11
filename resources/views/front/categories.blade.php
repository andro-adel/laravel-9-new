@extends('layouts.front')
@section('content')

    <div class="category-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="bg-white">
                        @foreach($categories as $category)
                            <div class="sub-category-menu">
                                <h3 class="category-name">
                                    <a href="{{ route('front.category',$category->slug) }}">
                                        @if(session('language') == 2 || session('language') == null)
                                            {{ $category->name_ar }}
                                        @else
                                            {{ $category->name }}
                                        @endif

                                    </a>
                                </h3>
                                @if(count($category->subs) > 0)
                                    <ul class="parent-category">
                                        @foreach($category->subs as $subcat)
                                            @if($subcat->name_ar != null && session('language') == 2 || session('language') == null)
                                            <li>
                                                <a class="p-c-title" href="{{ route('front.subcat',['slug1' => $subcat->category->slug, 'slug2' => $subcat->slug]) }}">
                                                    {{$subcat->name_ar}}
                                                </a>
                                                @if(count($subcat->childs) > 0)
                                                    <ul>
                                                        @foreach($subcat->childs as $childcat)
                                                            @if($childcat->name_ar != null)
                                                            <li>
                                                                <a href="{{ route('front.childcat',['slug1' => $childcat->subcategory->category->slug, 'slug2' => $childcat->subcategory->slug, 'slug3' => $childcat->slug]) }}"><i class="fas fa-angle-double-right"></i>
                                                                    {{$childcat->name_ar}}
                                                                </a>
                                                            </li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                            @elseif(session('language') == 1)
                                                <li>
                                                    <a class="p-c-title" href="{{ route('front.subcat',['slug1' => $subcat->category->slug, 'slug2' => $subcat->slug]) }}">
                                                        {{$subcat->name}}
                                                    </a>
                                                    @if(count($subcat->childs) > 0)
                                                        <ul>
                                                            @foreach($subcat->childs as $childcat)
                                                                <li>
                                                                    <a href="{{ route('front.childcat',['slug1' => $childcat->subcategory->category->slug, 'slug2' => $childcat->subcategory->slug, 'slug3' => $childcat->slug]) }}"><i class="fas fa-angle-double-right"></i>{{$childcat->name}}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection