@extends('layouts.app')

@section('content')
    <div class="grid_12">
        <h3 class="mtop20">{{ $hotel->title }}</h3>
        <div class="blog">

            <div class="clear"></div>
            <img src="{{ $hotel->img }}" alt="" class="img_inner fleft mr10">
            {!! $hotel->detail_text !!}
            <h3>Страна: {{ $hotel->city->country->title }}</h3>


            <div class="o-section">
                <div id="tabs" class="c-tabs no-js">
                    <div class="c-tabs-nav">
                        <a href="#" class="c-tabs-nav__link is-active">
                            <span>Туры</span>
                        </a>
                        <a href="#" class="c-tabs-nav__link">
                            <span>Города</span>
                        </a>

                    </div>
                    <div class="c-tab is-active">
                        @foreach($hotel->arTours as $tour)
                            <div class="c-tab__content">
                                <a href="{{ route('tours.show', $tour->id) }}"><img src="{{ $tour->img}}" alt="{{ $tour->title }}" class="for_tabs fleft"></a>
                                <h1><a href="{{ route('tours.show', $tour->id) }}">{{ $tour->title }}</a></h1>
                                {!! substr($tour->detail_text, 0, 300) !!}
                                <a href="{{ route('tours.show', $tour->id) }}" class="link1">Подробнее</a>
                            </div>
                        @endforeach
                    </div>
                    @if($hotel->city)
                        <div class="c-tab">
                            <div class="c-tab__content">
                                <a href="{{ route('cities.show', $hotel->city->id) }}"><img src="{{ $hotel->city->img }}" alt="" class="for_tabs fleft"></a>
                                <h1><a href="{{ route('cities.show', $hotel->city->id) }}">{{ $hotel->city->title }}</a></h1>
                                {!! $hotel->city->preview_text !!}
                                <a href="{{ route('cities.show', $hotel->city->id) }}" class="link1">Подробнее</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <a href="{{ route('hotels.index') }}" class="link1 mt">К списку</a>
        </div>

    </div>
@endsection

@section('footer')
    @include('footer')
@endsection
