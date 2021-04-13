@extends('layouts.app')

@section('content')
    <div class="grid_12">
        <h3 class="mtop20">Страны</h3>
        @foreach($countries as $item)
            <div class="block2">
                <a href="{{ route('countries.show', $item->id) }}"><img src="{{ $item->resized_image }}" alt="{{ $item->title }}" class="img_inner fleft"></a>
                <div class="extra_wrapper">
                    <div class="text1 col1"><a href="{{ route('countries.show', $item->id) }}">{{ $item->title }}</a></div>
                    {!! $item->preview_text !!}
                    <br>
                    <a href="{{ route('countries.show', $item->id) }}" class="link1 mt">Подробнее</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('footer')
    @include('footer')
@endsection
