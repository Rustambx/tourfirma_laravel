@extends('layouts.app')

@section('content')
    <div class="grid_12">
        <h3 class="mtop20">{{ $news->title }}</h3>
        <div class="blog">
            <img src="{{ $news->img }}" alt="" class="img_inner fleft mr10">
            <time datetime="2014-10-01">{{ $news->created_at->format('j') }}<span>{{ $news->created_at->format('M') }}</span></time>
            {!! $news->detail_text !!}
        </div>
        <a href="{{ route('news.index') }}" class="link1 mt">К списку</a>
    </div>
@endsection

@section('footer')
    @include('footer')
@endsection
