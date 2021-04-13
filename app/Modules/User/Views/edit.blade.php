@extends('layouts.site')

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong>{{ $title }}</strong>
            </div>
            <div class="card-body card-block">
                @include('includes.result_messages')
                <form action="{{ route('admin.users.update', $user->id) }}" method="post" class="">
                    @csrf
                    <div class="form-group">
                        <div class="col col-md-3"><label for="selectLg" class=" form-control-label">Имя</label></div>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            <input type="text" id="name" name="name" value="{{ $user->name }}" placeholder="Имя" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col col-md-3"><label for="selectLg" class=" form-control-label">Логин</label></div>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            <input type="text" id="login" name="login" value="{{ $user->login }}" placeholder="Логин" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col col-md-3"><label for="selectLg" class=" form-control-label">Email</label></div>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                            <input type="email" id="email" name="email" value="{{ $user->email }}" placeholder="Email" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col col-md-3"><label for="selectLg" class=" form-control-label">Пароль</label></div>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-asterisk"></i></div>
                            <input type="password" id="password" name="password" placeholder="Пароль" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col col-md-3"><label for="selectLg" class=" form-control-label">Повторите пароль</label></div>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-asterisk"></i></div>
                            <input type="password" id="password" name="password_confirmation" placeholder="Повторите пароль" class="form-control">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3"><label for="selectLg" class=" form-control-label">Роль</label></div>
                        <div class="input-group">
                            <div class="col-12 col-md-9">
                                <select name="role_id" id="role_id" class="form-control-lg form-control">
                                    @foreach($user->roles as $userRole)
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}" @if($role->id == $userRole->id) selected @endif>
                                                {{$role->name}}
                                            </option>
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="_method" value="PUT">

                    <div class="form-actions form-group"><button type="submit" class="btn btn-success btn-sm">Сохранить</button></div>
                </form>
            </div>
        </div>
    </div>
@endsection
