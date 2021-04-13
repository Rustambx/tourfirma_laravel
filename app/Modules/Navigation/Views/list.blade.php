<header>
    <div class="container_12">
        <div class="grid_12">
            <div class="menu_block">
                <nav class="horizontal-nav full-width horizontalNav-notprocessed">
                    <ul class="sf-menu">
                        @foreach($navigations as $item)
                            <li><a href="{{ $item->path }}">{{ $item->title }}</a></li>
                        @endforeach
                    </ul>
                </nav>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</header>
