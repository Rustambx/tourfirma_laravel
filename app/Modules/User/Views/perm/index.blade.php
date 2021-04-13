@extends('layouts.site')

@section('content')
    <div class="animated fadeIn">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    @if(session('status'))
                        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                            {{ session()->get('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    @endif
                    <div class="card-header">
                        <strong class="card-title">Список Привилегии</strong>
                    </div>
                    <form action="{{ route('admin.permissions.store') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Привилегии</th>
                                    @if(!$roles->isEmpty())
                                        @foreach($roles as $item)
                                            <th>{{ $item->name }}</th>
                                        @endforeach
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                @if(!$perms->isEmpty())
                                    @foreach($perms as $perm)

                                        <tr>
                                            <td>{{ $perm->name }}</td>
                                            @foreach($roles as $role)
                                                <td>
                                                    @if($role->hasPermission($perm->name))
                                                        <input checked type="checkbox" name="{{ $role->id }}[]" value="{{ $perm->id }}">
                                                    @else
                                                        <input type="checkbox" name="{{ $role->id }}[]" value="{{ $perm->id }}">
                                                    @endif
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                            <div class="card-footer">
                                <input type="submit" value="Обновить" class="btn btn-primary btn-sm">
                            </div>
                        </div>

                    </form>
                </div>
            </div>


        </div>
    </div><!-- .animated -->
@endsection

@section('footer')
    @include('footer')
@endsection
