@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Редактирование пользователя</div>
                    <div class="panel-body">
                        <form action="{{ url('/users/block') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input type="hidden" name="user_id" value="{{$user->id}}">
                                @if($user->is_blocked)
                                    <p>Вы уверены, что хотите разблокировать пользователя?</p>
                                    <button class="btn btn-info" type="submit">Разблокировать</button>
                                @else
                                    <label for="blocked_description" class="control-label">Причина
                                        блокировки</label>
                                    <input id="blocked_description" type="text" class="form-control"
                                           name="blocked_description">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-danger" type="submit">Заблокировать</button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection