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
                        <form action="{{ route('admin.tours.store') }}" method="post" enctype="multipart/form-data" class="form-horizontal" novalidate>
                            @csrf
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Название</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="title" name="title" placeholder="Text" class="form-control"></div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Цена</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="price" name="price" placeholder="Price" class="form-control"></div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Текст</label></div>
                                <div class="col-12 col-md-9"><textarea name="detail_text" id="detail_text" rows="9" placeholder="Текст..." class="form-control html-editor"></textarea></div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="selectLg" class=" form-control-label">Тип тура</label></div>
                                <div class="col-12 col-md-9">
                                        <select name="type_tour_id" id="type_tour_id"  class="form-control-lg form-control">
                                            <option value="0">Выберите тип тура</option>
                                            @foreach($typeTours as $typeTour)
                                                <option value="{{$typeTour->id}}">
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
                                                <option value="{{$hotel->id}}">
                                                    <b>Отель:</b> {{$hotel->title}} - <b>Город:</b> {{ $hotel->city->title }}
                                                </option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="file-input" class=" form-control-label">Изображение</label></div>
                                <div class="col-12 col-md-9"><input type="file" id="img" name="img" class="form-control-file"></div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-2"><label for="file-input" class=" form-control-label">Горячий тур</label></div>
                                <div class="col-12 col-md-3"><input type="checkbox" value="Y" id="hot" name="hot" class="form-control-file"></div>
                            </div>

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

