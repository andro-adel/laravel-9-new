@extends('layouts.front')
@section('content')

<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <ul class="pages">
          <li>
            <a href="{{ route('front.index') }}">
              {{ $langg->lang17 }}
            </a>
          </li>
          <li>
            <a href="{{ route('front.page',$page->slug) }}">
            @if(session()->get('language') == 1)
              {{ $page->title }}
            @else
              {{ $page->title_ar }}
            @endif
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- Breadcrumb Area End -->



<section class="about">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="about-info">
            <h4 class="title">
            @if(session()->get('language') == 1)
              {{ $page->title }}
            @else
              {{ $page->title_ar }}
            @endif
            </a>
            </h4>
            <p>
            @if(session()->get('language') == 1)
              {!! $page->details !!}
            @else
              {!! $page->details_ar !!}
            @endif
            </p>

          </div>
        </div>
      </div>
    </div>
  </section>

@endsection