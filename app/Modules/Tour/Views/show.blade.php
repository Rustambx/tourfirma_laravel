@extends('layouts.app')

@section('content')
    <div class="grid_12">
        <h3 class="mtop20">{{ $tour->title }}</h3>
        <div class="blog">
            <div class="clear"></div>
            <img src="{{ $tour->img }}" alt="" class="img_inner fleft mr10">
            <p>{!! $tour->detail_text !!}</p>
            @if(is_array($arResult['countries']))
                <h3>Страна: {{ implode(" / ", \Illuminate\Support\Arr::pluck($arResult['countries'], 'title')) }}</h3>
            @endif
            <p>Галерея</p>

            <hr class="my-5" />

            <p class="imglist" style="max-width: 1000px;">
                @foreach($galleries as $gallery)
                    <a href="{{ $gallery->img }}" data-fancybox="images">
                        <img src="{{ $gallery->resized_image }}" alt="{{ $gallery->name }}" />
                    </a>
                @endforeach
            </p>
            <br>




            <div class="o-section">
                <div id="tabs" class="c-tabs no-js">
                    <div class="c-tabs-nav">

                        <a href="#" class="c-tabs-nav__link is-active">
                            <span>Города</span>
                        </a>
                        <a href="#" class="c-tabs-nav__link">
                            <span>Отели</span>
                        </a>
                    </div>

                    <div class="c-tab is-active">
                        @foreach($arResult['cities'] as $city)
                            <div class="c-tab__content">

                                <a href="{{ route('cities.show', $city->id) }}"><img src="{{ $city->img }}" alt="{{ $city->title }}" class="for_tabs fleft"></a>
                                <h1><a href="{{ route('cities.show', $city->id) }}">{{ $city->title }}</a></h1>
                                {!! $city->preview_text !!}
                                <a href="{{ route('cities.show', $city->id) }}" class="link1">Подробнее</a>
                            </div>
                        @endforeach
                    </div>
                    <div class="c-tab">
                        @foreach($arResult['hotels'] as $hotel)
                            <div class="c-tab__content">

                                <a href="{{ route('hotels.show', $hotel->id) }}"><img src="{{ $hotel->img }}" alt="" class="for_tabs fleft"></a>
                                <h1><a href="{{ route('hotels.show', $hotel->id) }}">{{ $hotel->title }}</a></h1>
                                {!!   substr($hotel->detail_text, 0 , 300) !!}
                                <a href="{{ route('hotels.show', $hotel->id) }}" class="link1">Подробнее</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <a href="{{ route('tours.index') }}" class="link1 mt">К списку</a>
    </div>
    <script type="text/javascript">
        $('[data-fancybox="images"]').fancybox({
            afterLoad : function(instance, current) {
                var pixelRatio = window.devicePixelRatio || 1;

                if ( pixelRatio > 1.5 ) {
                    current.width  = current.width  / pixelRatio;
                    current.height = current.height / pixelRatio;
                }
            }
        });
    </script>
@endsection
