@extends('layouts.app')

@section('content')
    @foreach($tours as $item)
        <div class="grid_4">
            <div class="banner">
                <img src="{{ $item->resized_image }}" alt="{{ $item->title }}">
                <div class="label">
                    <div class="title"><a href="{{ route('tours.show', $item->id) }}">{{ $item->title }}</a></div>
                    <div class="price"><span>$ {{ $item->price }}</span></div>
                    <a href="{{ route('tours.show', $item->id) }}">Подробнее</a>
                </div>
            </div>
        </div>
    @endforeach
    <div class="clear"></div>


    <div class="grid_4 prefix_1">
        <h5>Выберите страну</h5>
        <ul class="list">
            @foreach($countries as $item)
                <li><a href="{{ route('countries.show', $item->id) }}">{{ $item->title }}</a></li>
            @endforeach

        </ul>

        <h3 class="mtop20">Найти Тур</h3>
        <form id="bookingForm" method="get" action="{{ route('tours.index') }}">
            @csrf
            <div class="fl1 fl2">
                <em>Страна</em>
                <select id="country" name="country">
                    <option value="">Выберите страну</option>
                    @foreach($countries as $item)
                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                    @endforeach
                </select>
                <div class="clear"></div>
                <em>Город</em>
                <select id="city" name="city">
                    <option>Выберите город</option>
                </select>
                <div class="clear"></div>
                <em>Тип тура</em>
                <select name="type">
                    <option>Выберите тур</option>
                    @foreach($types as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                <label class="price">Цена до ($)</label>
                <input type="number" name="price" min="100">
            </div>

            <div class="clear"></div>
            <div class="tmRadio hot_tour">
                <label>
                    <input name="hot" value="Y" type="checkbox" id="tmRadio0" data-constraints='	@RadioGroupChecked(name="Comfort", groups=[RadioGroup])' />
                    Горячий тур
                </label>
            </div>
            <div class="clear"></div>
            <button class="btn" type="submit">Найти</button>

        </form>
    </div>
    <script src="{{ asset('js/script.js') }}"></script>

    <div class="grid_8 prefix_1">
        <h3>Добро пожаловать</h3>
        <img src="{{asset(env('THEME'))}}/images/page1_img1.jpg" alt="" class="img_inner fleft">
        <div class="extra_wrapper">
            <p>Lorem ipsum dolor sit ere amet, consectetur ipiscin.</p>
            In mollis erat mattis neque facilisis, sit ametiol
        </div>
        <div class="clear cl1"></div>
        <p>Find the detailed description of this <span class="col1"><a href="http://blog.templatemonster.com/free-website-templates/" rel="dofollow">freebie</a></span> at TemplateMonster blog.</p>
        <p><span class="col1"><a href="http://www.templatemonster.com/category/travel-website-templates/" rel="nofollow">Travel Website Templates</a></span> category offers you a variety of designs that are perfect for travel sphere of business.</p>

        <p>Secuit iapeto. Umor eurus! Opifex origine mixta coercuit erat concordi.
            Tegi igni ensis di vix non. Terram mortales zephyro inclusum videre! Fuerat
            carentem tanto sublime rerum mixta traxit ambitae fixo induit.</p>
        <p>Piscibus circumdare spectent perveniunt montes ut concordi feras sidera.
            Nitidis colebat silvas ab retinebat lege densior mentisque deorum. Aliud
            descenderat conversa densior hominum nabataeaque onus. Nitidis agitabilis
            ipsa melioris nova?</p>
        <ul>
            <li>Usu nec austro obliquis quam aer ligavit: fratrum omnia obstabatque</li>
            <li>Vindice porrexerat tempora et ensis di corpore siccis crescendo corpore
                postquam cum hanc sunt nunc terras terrarum valles pluvialibus iudicis
                foret perpetuum</li>
            <li>Hanc nova perpetuum caelo pronaque egens cesserunt rectumque alto hanc
                locis caeca evolvit erant metusque sponte totidem spisso tanta</li>
        </ul>
        <p>Totidemque illic. Dicere cepit quoque iapeto forma viseret stagna. Nubes
            stagna quisque stagna parte origo caeli. Pontus rudis. Foret erat securae.
            Animal habentia litora quisque. Mentes cingebant matutinis sua habentem
            quia erectos animalibus origo. Uno ripis passim dissociata fronde umor
            terrarum recens prima. Rapidisque aere.</p>
        <p>Effigiem quanto ne dominari. Sic quam otia adhuc. Imagine principio agitabilis
            adspirate congestaque. Sanctius rapidisque meis ultima siccis alta deerat
            feras fontes. Praeter oppida circumfuso indigestaque elementaque fuerat
            flexi. Aliis lumina fossae? Perpetuum vis sectamque quod terram illic erant
            margine galeae habitandae.</p>
    </div>

    <div class="grid_12">
        <h3 class="head1">Новости</h3>
    </div>
    @foreach($news as $item)
        <div class="grid_4">
            <div class="block1">
                <time datetime="2014-01-01">{{ $item->created_at->format('j') }}<span>{{ $item->created_at->format('M') }}</span></time>
                <div class="extra_wrapper">
                    <div class="text1 col1"><a href="{{ route('news.show', $item->id) }}">{{ $item->title }}</a></div>
                    {!!   substr($item->preview_text, 0, 100) !!}
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('footer')
    @include('footer')
@endsection
