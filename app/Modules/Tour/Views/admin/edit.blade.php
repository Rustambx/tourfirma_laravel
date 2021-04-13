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
                        <form action="{{ route('admin.tours.update', $tour->id) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                            @csrf
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Название</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="title" name="title" placeholder="Text" value="{{ $tour->title }}" class="form-control"></div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Цена</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="price" name="price" placeholder="Price" value="{{ $tour->price }}" class="form-control"></div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Текст</label></div>
                                <div class="col-12 col-md-9"><textarea name="detail_text" id="detail_text" rows="9" placeholder="Текст..." class="form-control html-editor"> {{ $tour->detail_text }}</textarea></div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="selectLg" class=" form-control-label">Тип тура</label></div>
                                <div class="col-12 col-md-9">
                                    <select name="type_tour_id" id="type_tour_id"  class="form-control-lg form-control">
                                        <option value="0">Выберите тип тура</option>
                                        @foreach($typeTours as $typeTour)
                                            <option value="{{$typeTour->id}}" @if($typeTour->id == $tour->type_tour_id) selected @endif>
                                                {{$typeTour->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="selectLg" class=" form-control-label">Отель</label></div>
                                <div class="col-12 col-md-9">
                                    <select name="hotel_id[]" id="hotel_id" multiple class="form-control-lg form-control">
                                        @foreach($hotels as $hotel)

                                            <option value="{{$hotel->id}}" @if($hotel->option == true) selected @endif>
                                                {{$hotel->title}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            @if(isset($tour->img))
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Текущее изображение</label></div>
                                    <img src="{{ $tour->img }}" alt="{{ $tour->title }}">
                                </div>
                            @endif

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="file-input" class=" form-control-label">Изображение</label></div>
                                <div class="col-12 col-md-9"><input type="file" id="img" name="img" class="form-control-file"></div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-2"><label for="file-input" class=" form-control-label">Горячий тур</label></div>
                                <div class="col-12 col-md-3"><input type="checkbox" checked value="Y" id="hot" name="hot" class="form-control-file"></div>
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




