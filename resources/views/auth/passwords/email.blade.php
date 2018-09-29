@extends('layouts.app')

@section('content')


    <section class="hero is-fullheight">
        <div class="hero-body">
            <div class="container has-text-centered">
                <div class="column is-4 is-offset-4">
                    <h3 class="title has-text-grey">Reset Password</h3>
                    <p class="subtitle has-text-grey">Toys And Treats</p>
                    <div class="box">
                        <form method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">
                            @csrf
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
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
                            <button class="button is-block is-info is-large is-fullwidth">  {{ __('Send Password Reset Link') }}</button>
                        </form>
                    </div>                   
                </div>
            </div>
        </div>
    </section>
@endsection
