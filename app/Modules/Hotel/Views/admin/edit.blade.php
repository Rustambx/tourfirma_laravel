@extends('layouts.site')

@section('content')
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong>{{ $hotel->title }}</strong>
                    </div>
                    <div class="card-body card-block">
                        @include('includes.result_messages')
                            <form action="{{ route('admin.hotels.update', $hotel->id) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                                @method('PATCH')
                                @csrf
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Название</label></div>
                                    <div class="col-12 col-md-9"><input type="text" id="title" name="title" placeholder="Text" value="{{ $hotel->title }}" class="form-control"></div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Цена</label></div>
                                    <div class="col-12 col-md-9"><input type="text" id="price" name="price" placeholder="Text" value="{{ $hotel->price }}" class="form-control"></div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Детальный текст</label></div>
                                    <div class="col-12 col-md-9"><textarea name="detail_text" id="detail_text" rows="9" placeholder="Текст..."  class="form-control html-editor">{{ $hotel->detail_text }}</textarea></div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="selectLg" class=" form-control-label">Город</label></div>
                                    <div class="col-12 col-md-9">
                                        <select name="city_id" id="city_id" class="form-control-lg form-control">
                                            <option value="0">Выберите город</option>
                                            @foreach($cities as $city)}
                                                <option value="{{$city->id}}" @if($city->id == $hotel->city_id) selected @endif>
                                                    {{$city->title}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Текущее изображение</label></div>
                                    <img src="{{ $hotel->resized_image }}" alt="{{ $hotel->title }}">
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="file-input" class=" form-control-label">Изображение</label></div>
                                    <div class="col-12 col-md-9"><input type="file" id="img" name="img" class="form-control-file"></div>
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
