<div class="tab">
    <div :class="{'tab__item':true, 'tab__item--active':active('posts')}"
        @click="active_tab='posts'">
        <span class="tab__name">
            Posts
        </span>
    </div>
    @if(Auth::id() === $profile->id)
    <div :class="{'tab__item':true, 'tab__item--active':active('likes')}"
        @click="active_tab='likes'">
        <span class="tab__name">
            Liked
        </span>
    </div>
    <div :class="{'tab__item':true, 'tab__item--active':active('bookmarks')}"
        @click="active_tab='bookmarks'">
        <span class="tab__name">
            Bookmarked
        </span>
    </div>
    @endif
</div>
