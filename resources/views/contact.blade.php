@extends('layouts.app')

@section('content')
    <div class="grid_5">
        <h3 class="mtop20">Контакты</h3>
        <div class="map">
            <div class="clear"></div>
            <figure class="">
                <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A309843254fa6efbd5e364d3fbf49148107d8fcd3e2f5bf1269948199ae2c0da8&amp;width=380&amp;height=402&amp;lang=ru_RU&amp;scroll=true"></script>
            </figure>
            <address>
                <dl>
                    <dt>
                        Ташкент, ул. Алишера Навои
                    </dt>
                    <dd><span>Telephone:</span>+998 71 207-57-57</dd>
                    <dd>E-mail: <a href="#" class="col1">info@tcibc.uz</a></dd>
                </dl>
            </address>
        </div>
    </div>
    @if (count($errors) > 0)
        <div class="success_wrapper">
            <div class="success-message">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach</div>
        </div>
    @endif
    @if (session('status'))
        <div class="success_wrapper">
            <div class="success-message">{{ session('status') }}</div>
        </div>
    @endif
    <div class="grid_6 prefix_1">
        <h3 class="mtop20">Напишите нам</h3>
        <form id="form" action="{{ route('contacts') }}" method="post">

            <label class="name">
                <input type="text" placeholder="Имя" data-constraints="@Required @JustLetters" />
                <span class="empty-message">*This field is required.</span>
                <span class="error-message">*This is not a valid name.</span>
            </label>
            <label class="sirname">
                <input type="text" placeholder="Фамилия" data-constraints="@Required @JustLetters"/>
                <span class="empty-message">*This field is required.</span>
                <span class="error-message">*This is not a valid phone.</span>
            </label>
            <label class="email">
                <input type="text" placeholder="Email" data-constraints="@Required @Email" />
                <span class="empty-message">*This field is required.</span>
                <span class="error-message">*This is not a valid email.</span>
            </label>

            <label class="message">
                <textarea placeholder="Сообщение" data-constraints='@Required @Length(min=20,max=999999)'></textarea>
                <span class="empty-message">*This field is required.</span>
                <span class="error-message">*The message is too short.</span>
            </label>
            <div>
                <div class="clear"></div>
                <div class="btns">
                    <a href="javascript:void(0)"  data-type="submit" class="link1 mt">Отправить</a>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('footer')
    @include('footer')
@endsection
