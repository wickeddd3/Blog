<div>
    <div class="tab">
        <div class="tab__item"
            :class="{'tab__item--active':active('drafted')}"
            @click="active_tab='drafted'">
            <span class="tab__name">Drafts</span>
        </div>
        <div class="tab__item"
            :class="{'tab__item--active':active('published')}"
            @click="active_tab='published'">
            <span class="tab__name">Published</span>
        </div>
        <div class="tab__item"
            :class="{'tab__item--active':active('trashed')}"
            @click="active_tab='trashed'">
            <span class="tab__name">Trashed</span>
        </div>
    </div>
    <my-posts :active_tab="active_tab"></my-posts>
</div>
