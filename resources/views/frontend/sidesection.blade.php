<div class="sidesection">
    <div class="sidesection__item">
        <div class="sidesection__header">
            <i class="fa fa-fire-alt sidesection__header-icon m-r-1"></i>
            <span class="sidesection__title">Popular Bloggers</span>
        </div>
        <div class="sidesection__body">
            @foreach($bloggers as $blogger)
                <div class="card">
                    <div class="card__content">
                        <div class="card__header">
                            <img class="card__img"
                                src="{{ asset('/storage/'.$blogger->profile->avatar) }}"
                                alt="{{ asset('/storage/'.$blogger->profile->avatar) }}">
                        </div>
                        <div class="card__body">
                            <h2 class="heading-secondary">{{ $blogger->full_name }}</h2>
                            <h3 class="heading-tertiary">{{ $blogger->posts->count() }} Posts</h3>
                            <h3 class="heading-tertiary">
                                {{ $blogger->followers->count() }} Followers
                                {{ $blogger->following->count() }} Following
                            </h3>
                        </div>
                    </div>
                    <div class="card__footer">
                        <a href="" class="card__btn btn btn-follow">
                            <svg class="card__btn-icon">
                                <use xlink:href="icons/sprite.svg#icon-circle-with-plus"></use>
                            </svg>
                            <span class="card__btn-text">
                                Follow
                            </span>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
