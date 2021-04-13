@extends('layouts.app')

@section('content')
    <div class="inner_tour_filter">
        <fieldset>
            <legend>Фильтр по турам</legend>
            <form id="filter_tours" method="get" action="{{ route('tours.index') }}">
                @csrf
                <div class="block_filter_1">
                    <em>Страна</em>
                    <select id="country" name="country">
                        <option value="">Выберите страну</option>
                        @foreach($countries as $item)
                            <option value="{{ $item->id }}" @if(isset($_GET['country']) && $_GET['country'] == $item->id) selected @endif>{{ $item->title }}</option>
                        @endforeach
                    </select>
                    <em>Город</em>
                    <select id="city" name="city">
                        <option>Выберите город</option>
                    </select>
                    <em>Тип тура</em>
                    <select name="type">
                        <option>Выберите тур</option>
                        @foreach($types as $item)
                            <option value="{{ $item->id }}" @if(isset($_GET['type']) && $_GET['type'] == $item->id) selected @endif>{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="block_filter_2">
                    <em>Цена до ($)</em>
                    <input type="number" name="price" min="100" @if(isset($_GET['price']) &&  $_GET['price']) value="{{ $_GET['price'] }}" @endif>
                    <label>
                        @if(isset($_GET['hot']))
                            <input name="hot" value="Y" type="checkbox"  checked />
                        @else
                            <input name="hot" value="Y" type="checkbox"/>
                        @endif
                        <em>Горячий тур</em>
                    </label>

                </div>
                <div>
                    <a class="link1 mt" href="javascript:void(0)" onclick="document.getElementById('filter_tours').submit();">Найти</a>
                    <a class="link1 mt" href="{{ route('tours.index') }}">Очистить</a>
                </div>
            </form>
        </fieldset>
    </div>
    @if(count($tours) > 0)
        <div class="banners">
            @foreach($tours as $item)
                <div class="grid_4">
                    <div class="banner">
                        <img  src="{{ $item->resized_image }}" alt="{{ $item->title }}">
                        <div class="label">
                            <div class="title"><a href="{{ route('tours.show', $item->id) }}">{{ $item->title }}</a></div>
                            <div class="price"><span>$ {{ $item->price }}</span></div>
                            <a href="{{ route('tours.show', $item->id) }}">Подробнее</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <script src="{{ asset('js/script.js') }}"></script>
    @else
        <p class="empty_element">Не найдены туры по заданным фильтрам</p>
    @endif
@endsection

@section('footer')
    @include('footer')
@endsection
