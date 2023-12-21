@if(isset($errors) && $errors->count())
@foreach($errors->messages() as $error)
@if(is_array($error))
@foreach($error as $row)
<li>{{ $row }}</li>
@endforeach
@else
<li>{{ $error }}</li>
@endif
@endforeach
<hr>
@endif
<form method="post">
    @csrf
    <input type="password" name="password" placeholder="password" id=""><br>
    <input type="password" name="password_confirmation" placeholder="password confirmation" id=""><br>
    <button type="submit">Reset password</button>
</form>