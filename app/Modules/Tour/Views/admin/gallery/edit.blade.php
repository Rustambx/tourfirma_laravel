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
                        <form action="{{ route('admin.galleries.update', $gallery->id) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                            @method('PATCH')
                            @csrf
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Название</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="name" name="name" placeholder="Text" value="{{ $gallery->name }}" class="form-control"></div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Текущее изображение</label></div>
                                <img src="{{ $gallery->resized_image}}" alt="{{ $gallery->title }}">
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="file-input" class=" form-control-label">Изображение</label></div>
                                <div class="col-12 col-md-9"><input type="file" id="img" name="img" class="form-control-file"></div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="selectLg" class=" form-control-label">Тур</label></div>
                                <div class="col-12 col-md-9">
                                    <select name="tour_id" id="selectLg" class="form-control-lg form-control">
                                        <option value="0">Выберите тур</option>
                                        @foreach($tours as $tour)
                                            <option value="{{$tour->id}}" @if($tour->id == $gallery->tour_id) selected @endif>
                                                {{$tour->title}}
                                            </option>
                                        @endforeach
                                    </select>
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
