<div class="sidenav">
    <div class="sidenav__item">
        <div class="sidenav__header">
            <div class="sidenav__header-left">
                <i class="fa fa-lightbulb sidenav__header-icon m-r-1"></i>
                <span class="sidenav__header-title">Interests</span>
            </div>
            <div class="sidenav__header-right">
                <i class="fa fa-chevron-down sidenav__header-icon"></i>
            </div>
        </div>
        <div class="sidenav__body">
            <div class="category">
                <ul class="category__list">
                    @foreach($categories as $category)
                    <li class="category__item">
                        {{ $category->name }}
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div class="sidenav__item">
        <div class="sidenav__header">
            <div class="sidenav__header-left">
                <i class="fa fa-tags sidenav__header-icon m-r-1"></i>
                <span class="sidenav__header-title">Tags</span>
            </div>
            <div class="sidenav__header-right">
                <i class="fa fa-chevron-down sidenav__header-icon"></i>
            </div>
        </div>
        <div class="sidenav__body">
            <div class="tag">
                @foreach($tags as $tag)
                <span class="tag__item">
                    #{{ $tag->name }}
                </span>
                @endforeach
            </div>
        </div>
    </div>
</div>
