<div class="slider_wrapper">
    <div id="camera_wrap" class="">
        @foreach($sliders as $item)
            <div data-src="{!! $item->img !!}">
                <div class="caption fadeIn">
                    <h2>{{ $item->title }}</h2>
                    <div class="price">
                        <span>${{ $item->price }}</span>
                    </div>
                    <a href="{{ route('countries.show', $item->country_id) }}">Подробнее</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
