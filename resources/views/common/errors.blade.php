@if (count($errors) > 0)
<div class="validation_error">
    <ul class="errors">
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
    </ul>
    <h2 class="message">入力内容に不足があります。</h2>
</div>
@endif