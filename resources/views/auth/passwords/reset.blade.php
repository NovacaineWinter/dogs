@extends('layouts.app')

@section('content')

    <section class="hero is-fullheight">
        <div class="hero-body">
            <div class="container has-text-centered">
                <div class="column is-4 is-offset-4">
                    <h3 class="title has-text-grey">Login</h3>
                    <p class="subtitle has-text-grey">Toys And Treats</p>
                    <div class="box">                       
                        <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                            @csrf
                            <div class="field">
                                <div class="control">
                                    <input class="input is-large {{ $errors->has('email') ? ' is-danger' : '' }}" type="email" placeholder="Your Email" autofocus="" name="email" value="{{ old('email') }}" required="">

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif

                                </div>
                            </div>

                            <div class="field">
                                <div class="control">
                                    <input class="input is-large {{ $errors->has('password') ? ' is-danger' : '' }}" name="password" type="password" placeholder="Your Password" required>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="field">
                                <div class="control">                                    
                                    <input class="input is-large " name="password_confirmation" type="password" placeholder="{{ __('Confirm Password') }}" required>                                    
                                </div>
                            </div>
                            
                            <button class="button is-block is-info is-large is-fullwidth">{{ __('Reset Password') }}</button>
                        </form>
                    </div>                    
                </div>
            </div>
        </div>
    </section>

@endsection
