@extends('layouts.vendor')

@section('content')
    @if(Auth::guard('web')->user()->contract_img == null)
        <div class="content-area">
            <div class="mr-breadcrumb">
                    <div class="row">
                      <div class="col-lg-12">
                          <h4 class="heading">{{ __('Vendor Verification') }}</h4>
                          <ul class="links">
                            <li>
                              <a href="{{ route('vendor-dashboard') }}">{{ __('Dashboard') }}</a>
                            </li>
                          <li>
                            <a href="{{ route('vendor-verify') }}">{{ __('Vendor Verification') }}</a>
                          </li>
                          </ul>
                      </div>
                    </div>
                  </div>
            <div class="add-product-content1">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="product-description">
                          <div class="body-area">
    
                              @if($data->checkVerification())
                                  <div class="alert alert-success validation" style="">
                <p class="text-left"><div class="text-center"><i class="fas fa-check-circle fa-4x"></i><br><h3>{{ $langg->lang804 }}</h3></div></p> 
          </div>
                              @else
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                  @include('includes.admin.form-both')
                                  <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>


                                    <div class="row center">
                                        <div class="col-lg-12 text-justify">
                                            <h4>{{$langg->contract_message}}</h4>
                                            <div class="center col-lg-4 m-auto">
                                                <a href="../assets/files/contract.pdf" class="btn btn-primary" download style="text-align: center;padding-top: 8px; background-color: #1f224f">Download Contract</a>
                                            </div>
                                        </div>

                                    </div>



                                    <form action="{{route('admin-vendor-contract',Auth::guard('web')->user()->id)}}" method="POST" enctype="multipart/form-data">
    
                                        {{csrf_field()}}


                                        <!-- image -->
                                        <div class="row">
                                            <div  class="col-lg-4">
                                            <div class="left-area">
                                              <h4 class="heading">
                                                {{ __('Attachment') }}*
                                              </h4>
                                              <p class="sub-heading">(Maximum Size is 10 MB)</p>
        
                                            </div>
                                            </div>
                                            <div  class="col-lg-3">
                                              <div class="attachments" id="attachment-section">
                                                <div class="attachment-area">
                                                  <input type="file" name="contract_img" required>
                                                </div>
                                              </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                          <div class="col-lg-4">
                                            <div class="left-area">
        
                                            </div>
                                          </div>
                                          <div class="col-lg-7">
                                            <button class="addProductSubmit-btn" type="submit">{{ __('Submitt') }}</button>
                                          </div>
                                        </div>
    
                                  </form>

                              @endif
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
        </div>
    @elseif(Auth::guard('web')->user()->Is_Verfiy())
    <div class="content-area">
            <div class="mr-breadcrumb">
                    <div class="row">
                      <div class="col-lg-12">
                          <h4 class="heading">{{ __('Vendor Verification') }}</h4>
                          <ul class="links">
                            <li>
                              <a href="{{ route('vendor-dashboard') }}">{{ __('Dashboard') }}</a>
                            </li>
                          <li>
                            <a href="{{ route('vendor-verify') }}">{{ __('Vendor Verification') }}</a>
                          </li>
                          </ul>
                      </div>
                    </div>
                  </div>
            <div class="add-product-content1">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="product-description">
                          <div class="body-area">
    
                              @if($data->checkVerification())
                                  <div class="alert alert-success validation" style="">
                <p class="text-left"><div class="text-center"><i class="fas fa-check-circle fa-4x"></i><br><h3>{{ $langg->lang804 }}</h3></div></p> 
          </div>
                              @else
                                  @include('includes.admin.form-both')
                                  <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                                  <form id="verifyform"  action="{{route('vendor-verify-submit')}}" method="POST" enctype="multipart/form-data">
    
                                      {{csrf_field()}}
                                    <div class="row">
                                      <div class="col-lg-4">
                                        <div class="left-area">
                                          <h4 class="heading">
                                              {{ __('Description') }} *
                                          </h4>
                                        </div>
                                      </div>
                                      <div class="col-lg-7">
                                          <textarea class="input-field" name="text" required="" placeholder="{{ __('Enter Details') }}"></textarea>
                                      </div>
                                    </div>
                                    <div class="row">
                                          <div class="col-lg-4">
                                              <div class="left-area">
                                                  <h4 class="heading">
                                                      {{ __('NatID') }} *
                                                  </h4>
                                              </div>
                                          </div>
                                          <div class="col-lg-7">
                                              <input class="input-field" type="text" name="nat_id" required="" placeholder="{{ __('NatID') }}"></input>
                                          </div>
                                      </div>
                                    <div class="row">
                                          <div class="col-lg-4">
                                              <div class="left-area">
                                                  <h4 class="heading">
                                                      {{ __('tax record') }} *
                                                  </h4>
                                              </div>
                                          </div>
                                          <div class="col-lg-7">
                                              <input class="input-field" type="text" name="tax_rec" required="" placeholder="{{ __('tax record') }}"></input>
                                          </div>
                                      </div>
                                    <div class="row">
                                        <div  class="col-lg-4">
                                        <div class="left-area">
                                          <h4 class="heading">
                                            {{ __('Attachment') }}*
                                          </h4>
                                          <p class="sub-heading">(Maximum Size is 10 MB)</p>
    
                                        </div>
                                        </div>
                                        <div  class="col-lg-3">
                                          <div class="attachments" id="attachment-section">
                                            <div class="attachment-area">
                                              <span class="remove attachment-remove"><i class="fas fa-times"></i></span>
                                              <input type="file" name="attachments[]" required>
                                            </div>
                                          </div>
                                        <a href="javascript:;" id="attachment-btn" class="add-more mt-4"><i class="fas fa-plus"></i>{{ __('Add More Attachment') }} </a>
                                        </div>
                                    </div>
                                    <input type="hidden" name="warning" value="{{ isset($verify) ? $verify->admin_warning : '0' }}" />
                                    <input type="hidden" name="verify_id" value="{{ isset($verify) ? $verify->id : '0' }}" />
                                    <div class="row">
                                      <div class="col-lg-4">
                                        <div class="left-area">
    
                                        </div>
                                      </div>
                                      <div class="col-lg-7">
                                        <button class="addProductSubmit-btn" type="submit">{{ __('Submitt') }}</button>
                                      </div>
                                    </div>
    
                                  </form>
                              @endif
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
        </div>
    @else
    <div class="content-area">
        <div class="mr-breadcrumb">
                    <div class="row">
                      <div class="col-lg-12">
                          <h4 class="heading">{{ __('Vendor Verification') }}</h4>
                          <ul class="links">
                            <li>
                              <a href="{{ route('vendor-dashboard') }}">{{ __('Dashboard') }}</a>
                            </li>
                          <li>
                            <a href="{{ route('vendor-verify') }}">{{ __('Vendor Verification') }}</a>
                          </li>
                          </ul>
                      </div>
                    </div>
                  </div>
        <div class="add-product-content1">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product-description">
                        <div class="body-area">
                            <h3> في انتظار موافقه الادمن علي طلبكم </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                  
    @endif
@endsection

@section('scripts')


<script type="text/javascript">
  

  function isEmpty(el){
      return !$.trim(el.html())
  }

// Color Section

$("#attachment-btn").on('click', function(){

    $("#attachment-section").append(''+
                            '<div class="attachment-area  mt-2">'+
                                '<span class="remove attachment-remove"><i class="fas fa-times"></i></span>'+
                                '<input type="file" name="attachments[]" required>'+
                            '</div>'
                            +'');
});


$(document).on('click','.attachment-remove', function(){

    $(this.parentNode).remove();
    if (isEmpty($('#attachment-section'))) {

    $("#attachment-section").append(''+
                            '<div class="attachment-area  mt-2">'+
                                '<span class="remove attachment-remove"><i class="fas fa-times"></i></span>'+
                                '<input type="file" name="attachments[]" required>'+
                            '</div>'
                            +'');

    }

});

// Color Section Ends

</script>

@endsection
