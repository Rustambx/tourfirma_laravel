<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                {{ Breadcrumbs::render() }}
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div>{{ $auth_user->login }}</div>
            <div><a href="{{ route('logout') }}">Выйти</a></div>
        </div>
    </div>
</div>
