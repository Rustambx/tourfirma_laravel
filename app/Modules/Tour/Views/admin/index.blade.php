@extends('layouts.site')

@section('content')
    <div class="animated fadeIn">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    @if(session('status'))
                        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                            {{ session()->get('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    @endif
                    <div class="card-body">
                        <a href="{{route('admin.tours.create')}}" class="btn btn-primary">Создать Тур</a>
                    </div>
                    <div class="card-header">
                        <strong class="card-title">Список туров</strong>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Название</th>
                                <th>Цена</th>
                                <th>Текст</th>
                                <th>Город</th>
                                <th>Отель</th>
                                <th>Тип тура</th>
                                <th>Изображения</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tours as $item)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.tours.edit', $item->id) }}">{{ $item->title }}</a>
                                    </td>
                                    <td>${{ $item->price }}</td>
                                    <td>{!! substr($item->detail_text, 0, 200) !!}</td>
                                    <td>
                                        @foreach($item->ar_cities as $cityTitle)
                                            <b>{{ $cityTitle . (!$loop->last ? ", " : "") }}</b>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($item->arHotels as $hotel)
                                            @if ($hotel)
                                                <b>{{ $hotel->title . (!$loop->last ? ", " : "") }}</b>
                                            @endif
                                        @endforeach
                                    </td>

                                    <td>
                                        @foreach($item->arType as $type)
                                            <b>{{ $loop->first ? '' : ', ' }}</b>
                                            <b>{{$type->name}}</b>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.tours.edit', $item->id) }}"><img style="max-width: inherit;" src="{!! $item->resized_image !!}" alt="{{ $item->title }}"></a>
                                    </td>
                                    <td>
                                        <form method="post" action="{{ route('admin.tours.destroy', $item->id) }}">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-danger" type="submit">Удалить</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div><!-- .animated -->
@endsection

@section('footer')
    @include('footer')
@endsection
