@extends('layouts.site')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Vocabularies list -->
                <div class="card">
                    <div class="card-header">
                        {{ __('Users') }}

                        <div class="nav-actions float-right">
                            <a href="{{ route('user.add') }}" class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-plus"></i>
                                {{ __('Add') }}
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-striped">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Photo</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $item)
                                <tr>
                                    <th scope="row">{{ $item->id }}</th>
                                    <td>
                                        {{ $item->name }}
                                    </td>
                                    <td>
                                        {{ $item->email }}
                                    </td>

                                    <td>
                                        <img src="{{ $item->resized_photo }}" alt="">
                                    </td>
                                    <td class="dropdown">
                                        <button class="dropbtn">Dropdown</button>
                                        <div class="dropdown-content">
                                            <a href="{{ route('user.edit', $item->id) }}">Edit</a>
                                            <form method="post" action="{{ route('user.delete', $item->id) }}">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-form_delete" type="submit">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('modals')
    <!-- Modal -->
    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="delete-modal-label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                {!! Form::open(['route' => 'taxonomy.vocabulary.delete']) !!}
                {!! Form::hidden('vid', null) !!}
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="delete-modal-label">{{ __('Confirm removal of') }} <em id="v-name"></em></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ __('Are you sure you want to remove vocabulary and all of it\'s terms?') }}
                    <p>
                        <b>{{ __('This action is irreversible!') }}</b>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Remove</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endpush

@push('scripts')
    <script>
        $('#delete-modal').on('show.bs.modal', function (e) {
            var button = $(e.relatedTarget);

            $('#v-name').text(button.attr('data-name'));
            $('#delete-modal input[name="vid"]').val(button.attr('data-id'));
        }).on('hide.bs.modal', function () {
            $('#v-name').empty();
        });
    </script>
@endpush
