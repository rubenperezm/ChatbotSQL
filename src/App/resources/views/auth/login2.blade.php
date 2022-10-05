@extends('layouts.appAuth')

@section('content')
<div class="overlay"></div>
 <video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
   <source src="mp4/bg.mp4" type="video/mp4">
 </video>

 <div class="masthead">
   <div class="masthead-bg"></div>
   <div class="container h-100">
     <div class="row h-100">
       <div class="col-12 my-auto">
         <div class="masthead-content text-white py-5 py-md-0">
           <h1 class="mb-3">Coming Soon!</h1>
           <p class="mb-5">We're working hard to finish the development of this site. Our target launch date is
             <strong>January 2019</strong>! Sign up for updates using the form below!</p>
           <div class="input-group input-group-newsletter">
             <input type="email" class="form-control" placeholder="Enter email..." aria-label="Enter email..." aria-describedby="basic-addon">
             <div class="input-group-append">
               <button class="btn btn-secondary" type="button">Notify Me!</button>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
 </div>

 <div class="social-icons">
   <ul class="list-unstyled text-center mb-0">
     <li class="list-unstyled-item">
       <a href="#">
         <i class="fab fa-twitter"></i>
       </a>
     </li>
     <li class="list-unstyled-item">
       <a href="#">
         <i class="fab fa-facebook-f"></i>
       </a>
     </li>
     <li class="list-unstyled-item">
       <a href="#">
         <i class="fab fa-instagram"></i>
       </a>
     </li>
   </ul>
 </div>



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required autocomplete="current-password">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
