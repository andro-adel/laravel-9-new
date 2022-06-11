@if(Auth::guard('admin')->check())

<option data-href="" value="">Select Sub Category</option>
@foreach($cat->subs as $sub)
@if(!empty($sub->name_ar))
    <option data-href="{{ route('admin-childcat-load',$sub->id) }}" value="{{ $sub->id }}">{{ $sub->name_ar }}</option>
@else
    <option data-href="{{ route('admin-childcat-load',$sub->id) }}" value="{{ $sub->id }}">{{ $sub->name }}</option>
@endif
@endforeach

@else 

<option data-href="" value="">Select Sub Category</option>
@foreach($cat->subs as $sub)
@if(!empty($sub->name_ar))
<option data-href="{{ route('vendor-childcat-load',$sub->id) }}" value="{{ $sub->id }}">{{ $sub->name_ar }}</option>
@else
    <option data-href="{{ route('vendor-childcat-load',$sub->id) }}" value="{{ $sub->id }}">{{ $sub->name }}</option>
@endif
@endforeach
@endif