@extends('layouts.gate')
@section('content')

<div class="auth_title">
    <h1>いつもありがとうございます！</h1>
</div>

<form method="POST" action="{{ route('login') }}">
@csrf
    <div class="auth_inputs">
        <ul>
            <li><input placeholder="メールアドレス" type="email" class="input_text form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus></li>
            @error('email')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
            <li><input placeholder="パスワード" type="password" class="input_text form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"></li>
            @error('password')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
            <li><label for="remember"><span class="auth_min_text">{{ __('パスワードを保存') }}</span></label><input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}></li>
            <li><button type="submit">{{ __('Login') }}</button></li>
        </ul>
    </div>
</form>

<div class="auth_links">

    @if (Route::has('password.request'))
        <a href="{{ route('password.request') }}"><span class="auth_min_text">{{ __('パスワードをお忘れですか？') }}</span></a>
    @endif

    <a href="{{url('/register')}}"><span class="auth_min_text">アカウント登録</span></a>
</div>

@endsection
