<div class="sidenav">
    <div class="sidenav__item">
        <div :class="{'sidenav__header': true,  'sidenav__header--collapse': categories_collapse}">
            <div class="sidenav__header-left">
                <i class="fa fa-lightbulb sidenav__header-icon m-r-1"></i>
                <span class="sidenav__header-title">Interests</span>
            </div>
            <div class="sidenav__header-right">
                <span @click="categories_collapse = !categories_collapse">
                    <i class="fa fa-chevron-down sidenav__header-icon"></i>
                </span>
            </div>
        </div>
        <div :class="{'sidenav__body': true, 'sidenav__body--collapse': categories_collapse}">
            <div :class="{'category': true, 'category--collapse': categories_collapse}">
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
        <div :class="{'sidenav__header': true,  'sidenav__header--collapse': tags_collapse}">
            <div class="sidenav__header-left">
                <i class="fa fa-tags sidenav__header-icon m-r-1"></i>
                <span class="sidenav__header-title">Tags</span>
            </div>
            <div class="sidenav__header-right">
                <span @click="tags_collapse = !tags_collapse">
                    <i class="fa fa-chevron-down sidenav__header-icon"></i>
                </span>
            </div>
        </div>
        <div :class="{'sidenav__body': true, 'sidenav__body--collapse': tags_collapse}">
            <div :class="{'tag': true, 'tag--collapse': tags_collapse}">
                @foreach($tags as $tag)
                <span class="tag__item">
                    #{{ $tag->name }}
                </span>
                @endforeach
            </div>
        </div>
    </div>
</div>
