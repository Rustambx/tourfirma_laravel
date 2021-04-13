@extends('layouts.app')

@section('content')
    <div class="banners">
        @foreach($hotels as $item)
            <div class="grid_4">
                <div class="banner">
                    <img src="{{ $item->resized_image }}" alt="">
                    <div class="label">
                        <div class="title"><a href="{{ route('hotels.show', $item->id) }}">{{ $item->title }}</a></div>
                        <div class="price"><span>$ {{ $item->price }}</span></div>
                        <a href="{{ route('hotels.show', $item->id) }}">Подробнее</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('footer')
    @include('footer')
@endsection
