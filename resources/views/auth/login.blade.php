@extends('layouts.app')

@section('content')

    <section class="hero is-fullheight">
        <div class="hero-body">
            <div class="container has-text-centered">
                <div class="column is-4 is-offset-4">
                    <h3 class="title has-text-grey">Login</h3>
                    <p class="subtitle has-text-grey">{{{env('APP_NAME')}}}</p>
                    <div class="box">
                       <!--  <figure class="avatar">
                           <img src="https://placehold.it/128x128">
                       </figure> -->
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
                                <label class="checkbox">
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                        Remember me
                                </label>
                            </div>
                            <button class="button is-block is-info is-large is-fullwidth">Login</button>
                        </form>
                    </div>
                    <p class="has-text-grey">
                        <a href="{{ route('password.request') }}">Forgot Password</a> &nbsp;·&nbsp;
                    </p>
                </div>
            </div>
        </div>
    </section>




@endsection
