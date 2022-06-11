@extends('layouts.front')

@section('content')

<section class="login-signup">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6">
    

        <div class="tab-content" id="nav-tabContent">

          {{-- login section satrt --}}

          <div class="tab-pane fade show active" id="nav-log" role="tabpanel" aria-labelledby="nav-log-tab">
            <div class="login-area">
              <div class="header-area">
                <h4 class="title">{{ $langg->lang172 }}</h4>
              </div>
              <div class="login-form signin-form">
                @include('includes.admin.form-login')
                <form class="mloginform" action="{{ route('user.login.submit') }}" method="POST">
                  {{ csrf_field() }}
                  <div class="form-input">
                    <input type="email" name="email" placeholder="{{ $langg->lang173 }}" required="">
                    <i class="icofont-user-alt-5"></i>
                  </div>
                  <div class="form-input">
                    <input type="password" class="Password" name="password" placeholder="{{ $langg->lang174 }}"
                      required="">
                    <i class="icofont-ui-password"></i>
                  </div>
                  <div class="form-forgot-pass">
                    <div class="left">
                      <input type="checkbox" name="remember" id="mrp" {{ old('remember') ? 'checked' : '' }}>
                      <label for="mrp">{{ $langg->lang175 }}</label>
                    </div>
                    <div class="right">
                      <a href="{{ route('user-forgot') }}">
                        {{ $langg->lang176 }}
                      </a>
                    </div>
                  </div>
                  <input type="hidden" name="modal" value="1">
                  <input class="mauthdata" type="hidden" value="{{ $langg->lang177 }}">
                  <button style='border: 1px solid #ad1515;
    border-radius: 10px;font-weight:500;color:white;font-family:Roboto,-apple-system,BlinkMacSystemFont,"Segoe UI","Helvetica Neue",Arial,sans-serif 'type="submit" class="submit-btn">{{ $langg->lang178 }}</button>
                  @if(App\Models\Socialsetting::find(1)->f_check == 1 || App\Models\Socialsetting::find(1)->g_check ==
                  1)
                  <div class="social-area">
                    <h3 class="title">{{ $langg->lang179 }}</h3>
                    
                    <ul class="social-links">
                      @if(App\Models\Socialsetting::find(1)->f_check == 1)
                      <li style="background: #264996;
    border: 1px solid blue;
    border-radius: 10px;
   
    width: 100%;">
                        <a href="{{ route('social-provider','facebook') }}">
                             <i style="background: white;color:#264996; width:40px;height:40px;
    
    margin:5px;
    border-radius: 19px;
    font-size: 19px;" class="fab fa-facebook-f"></i>
                             <p style='display:inline-block;font-size: .975rem;font-weight:500;color:white;font-family:Roboto,-apple-system,BlinkMacSystemFont,"Segoe UI","Helvetica Neue",Arial,sans-serif 'class="text">{{ $langg->lang180 }}</p>
                         
                          
                        </a>
                      </li>
                      @endif
                      @if(App\Models\Socialsetting::find(1)->g_check == 1)
                      <li style="background: #cc002c;
    border: 1px solid #cc002c;
    border-radius: 10px;

    width: 100%; margin-top: 10px;">
                        <a href="{{ route('social-provider','google') }}">
                          <i class="fab fa-google-plus-g"></i>
                          <p style='display:inline-block;font-size: .975rem;font-weight:500;color:white;font-family:Roboto,-apple-system,BlinkMacSystemFont,"Segoe UI","Helvetica Neue",Arial,sans-serif 'class="text">{{ $langg->lang4567 }}</p>
                        </a>
                      </li>
                      @endif
                    </ul>
                  </div>
                  @endif
                </form>
              </div>
            </div>
          </div>

          {{-- login section end --}}

          {{-- signup section satrt --}}

          {{--<div class="tab-pane fade" id="nav-reg" role="tabpanel" aria-labelledby="nav-reg-tab">
            <div class="login-area signup-area">
              <div class="header-area">
                <h4 class="title">{{ $langg->lang181 }}</h4>
              </div>
              <div class="login-form signup-form">
                @include('includes.admin.form-login')
                <form class="mregisterform" action="{{route('user-register-submit')}}" method="POST">
                  {{ csrf_field() }}

                  <div class="form-input">
                    <input type="text" class="User Name" name="name" placeholder="{{ $langg->lang182 }}" required="">
                    <i class="icofont-user-alt-5"></i>
                  </div>

                  <div class="form-input">
                    <input type="email" class="User Name" name="email" placeholder="{{ $langg->lang183 }}" required="">
                    <i class="icofont-email"></i>
                  </div>

                  <div class="form-input">
                    <input type="text" class="User Name" name="phone" placeholder="{{ $langg->lang184 }}" required="">
                    <i class="icofont-phone"></i>
                  </div>

                  <div class="form-input">
                    <input type="text" class="User Name" name="address" placeholder="{{ $langg->lang185 }}" required="">
                    <i class="icofont-location-pin"></i>
                  </div>

                  <div class="form-input">
                    <input type="password" class="Password" name="password" placeholder="{{ $langg->lang186 }}"
                      required="">
                    <i class="icofont-ui-password"></i>
                  </div>

                  <div class="form-input">
                    <input type="password" class="Password" name="password_confirmation"
                      placeholder="{{ $langg->lang187 }}" required="">
                    <i class="icofont-ui-password"></i>
                  </div>

                  @if($gs->is_capcha == 1)

                  <ul class="captcha-area">
                    <li>
                      <p><img class="codeimg1" src="{{asset("assets/images/capcha_code.png")}}" alt=""> <i
                          class="fas fa-sync-alt pointer refresh_code "></i></p>
                    </li>
                  </ul>

                  <div class="form-input">
                    <input type="text" class="Password" name="codes" placeholder="{{ $langg->lang51 }}" required="">
                    <i class="icofont-refresh"></i>
                  </div>

                  @endif

                  <input class="mprocessdata" type="hidden" value="{{ $langg->lang188 }}">
 <label > <input  style="display:inline!important" type="checkbox" required>من خلال تحديد هذا المربع ، فإنك تؤكد أنك قد قرأت وفهمت وقبلت القواعد المدرجة في

 <a  style="color:red; font-size:20px" href="https://amorshoping.com/terms">الشروط والأحكام</a> </label >
 <button type="submit" class="submit-btn">{{ $langg->lang189 }}</button>

                </form>
              </div>
            </div>
          </div>--}}

          {{-- signup section end --}}
        </div>

      </div>

    </div>
  </div>
</section>

@endsection