<div class="tab">
    <div :class="{'tab__item':true, 'tab__item--active':active('popular')}"
        @click="active_tab='popular'">
        <span class="tab__name">
            Popular
        </span>
    </div>
    <div :class="{'tab__item':true, 'tab__item--active':active('latest')}"
        @click="active_tab='latest'">
        <span class="tab__name">
            Latest
        </span>
    </div>
    <div :class="{'tab__item':true, 'tab__item--active':active('featured')}"
        @click="active_tab='featured'">
        <span class="tab__name">
            Featured
        </span>
    </div>
</div>
