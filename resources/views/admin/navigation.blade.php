<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="./">Админ панель</a>

        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            @if($menu)
                {!! $menu->asUl(['class'=>'nav navbar-nav']) !!}
            @endif
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>
