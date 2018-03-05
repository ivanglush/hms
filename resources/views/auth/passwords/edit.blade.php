@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Изменение пароля</div>
                    <div class="panel-body">

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/account/password') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="old-password" class="col-md-4 control-label">Старый пароль</label>
                                <div class="col-md-6">
                                    <input id="old-password" type="password" class="form-control" name="old_password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="new-password" class="col-md-4 control-label">Новый пароль</label>
                                <div class="col-md-6">
                                    <input id="new-password" type="password" class="form-control" name="new_password"
                                           required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="new-password-confirm" class="col-md-4 control-label">Подтверждение пароля</label>
                                <div class="col-md-6">
                                    <input id="new-password-confirm" type="password" class="form-control" name="new_password_confirmation" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Изменить
                                    </button>
                                </div>
                            </div>
                        </form>
                        @if($errors->any())
                            <ul class="alert alert-danger">
                                @foreach($errors->all() as  $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
