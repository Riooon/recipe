@extends('layouts.gate')
@section('content')

<div class="auth_title">
    <h1>パスワードをリセット</h1>
</div>

<form method="POST" action="{{ route('password.update') }}">
@csrf

    <div class="auth_inputs">
        <ul>
            <li><input type="hidden" name="token" value="{{ $token }}"></li>
            <li><input id="email" type="email" class="input_text form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus></li>
            @error('email')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
            <li><input placeholder="パスワード" id="password" type="password" class="input_text form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password"></li>
            @error('password')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
            <li><input placeholder="パスワード（確認用）" id="password-confirm" type="password" class="input_text form-control" name="password_confirmation" required autocomplete="new-password"></li>
            <li><button type="submit" class="btn btn-primary">パスワードをリセットする</button></li>
        </ul>
    </div>

</form>

@endsection
