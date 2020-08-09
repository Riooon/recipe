@extends('layouts.gate')
@section('content')


<div class="auth_title">
    <h1>ようこそ！</h1>
</div>

<form method="POST" action="{{ route('register') }}">
@csrf
    <div class="auth_inputs">
        <ul>
            <li><input type="text" placeholder="名前" class="input_text form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus></li>
            @error('name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror

            <li><input type="email" placeholder="メールアドレス" class="input_text form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email"></li>
            @error('email')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror

            <li><input type="password" placeholder="パスワード" class="input_text form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password"></li>
            @error('password')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror

            <li><input type="password" placeholder="パスワード確認" class="input_text form-control" name="password_confirmation" required autocomplete="new-password"></li>
            <li><button type="submit" class="btn btn-primary">{{ __('Register') }}</button></li>
        </ul>
    </div>
</form>

<div class="auth_links">


    <a href="{{url('/login')}}"><span class="auth_min_text">既にアカウントを持っています</span></a>
</div>

@endsection
