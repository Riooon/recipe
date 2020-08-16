@extends('layouts.gate')
@section('content')

<div class="auth_title">
    <h1>パスワードをリセット</h1>
</div>

@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

<form method="POST" action="{{ route('password.email') }}">
@csrf
    <div class="auth_inputs">
        <ul>
            <li><input id="email" type="email" class="input_text form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus></li>
            @error('email')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
            <li><button type="submit" class="btn btn-primary">再設定用のリンクを送信する</button></li>
        </ul>
    </div>
</form>

@endsection
