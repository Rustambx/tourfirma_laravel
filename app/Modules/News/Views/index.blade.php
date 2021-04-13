@extends('layouts.app')

@section('content')
    <div class="grid_12">
        <h3 class="mtop20">Новости</h3>
        @foreach($news as $item)
            <div class="blog">
                <time datetime="2014-10-01">{{ $item->created_at->format('j') }}<span>{{ $item->created_at->format('M') }}</span></time>
                <div class="extra_wrapper">
                    <div class="text1 col1"><a href="{{ route('news.show', $item->id) }}">{{ $item->title }}</a></div>
                </div>
                {!! $item->preview_text !!}
                <a href="{{ route('news.show', $item->id) }}" class="link1 fright">Подробнее</a>
            </div>
        @endforeach
    </div>
@endsection

@section('footer')
    @include('footer')
@endsection
