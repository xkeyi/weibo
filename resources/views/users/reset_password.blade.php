@extends('layouts.default')

@section('title', '修改密码')

@section('content')
<div class="offset-md-2 col-md-8">
  <div class="card">
    <div class="card-header">
      <h5>修改密码</h5>
    </div>

    <div class="card-body">

      @include('shared._errors')

      <form method="POST" action="{{ route('reset_password', $user->id) }}">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}

        <div class="form-group">
          <label for="password">密码：</label>
          <input type="password" name="password" class="form-control" value="{{ old('password') }}">
        </div>

        <div class="form-group">
          <label for="password_confirmation">确认密码：</label>
          <input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}">
        </div>

        <button type="submit" class="btn btn-primary">更新</button>
      </form>
    </div>
  </div>
</div>
@stop
