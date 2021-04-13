@extends('layouts.site')

@section('content')
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong>{{ $title }}</strong>
                    </div>
                    <div class="card-body card-block">
                        @include('includes.result_messages')
                        <form action="{{ route('admin.navigations.update', $navigation->id) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                        @method('PATCH')
                            @csrf
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Название</label></div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="title" name="title" value="{{ $navigation->title }}" placeholder="Text" class="form-control">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Адресс</label></div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="path" name="path" value="{{ $navigation->path }}" placeholder="Text" class="form-control">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Названия маршрута</label></div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="routeName" name="routeName" value="{{ $navigation->routeName }}" placeholder="Text" class="form-control">
                                </div>
                            </div>

                            <input type="hidden" name="_method" value="PUT">

                            <div class="card-footer">
                                <input type="submit" value="Сохранить" class="btn btn-primary btn-sm">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
