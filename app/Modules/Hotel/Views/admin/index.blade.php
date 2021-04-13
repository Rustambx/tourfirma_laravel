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
                        <a href="{{route('admin.hotels.create')}}" class="btn btn-primary">Создать отеля</a>
                    </div>
                    <div class="card-header">
                        <strong class="card-title">Список отелей</strong>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Название</th>
                                <th>Цена</th>
                                <th>Текст</th>
                                <th>Изображения</th>
                                <th>Город</th>
                                <th>Туры</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($hotels as $item)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.hotels.edit', $item->id) }}">{{ $item->title }}</a>
                                    </td>
                                    <td>${{ $item->price }}</td>
                                    <td>{!! substr($item->detail_text, 0, 200) !!}</td>
                                    <td>
                                        <a href="{{ route('admin.hotels.edit', $item->id) }}"><img src="{{ $item->resized_image}}" alt="{{ $item->title }}"></a>
                                    </td>
                                    <td>{{ $item->city->title }}</td>
                                    <td>
                                        @foreach($item->arTours as $tour)
                                            @if($tour)
                                                <b>{{ $tour->title . (!$loop->last ? ", " : "") }}</b>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        <form method="post" action="{{ route('admin.hotels.destroy', $item->id) }}">
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
