<template>
<div class="container text-center pt-2 my-2">
    <carousel :navigationEnabled="true"
              :navigationPrevLabel="'&#8249;'"
              :navigationNextLabel="'&#8250;'"
              :autoplay="true"
              :autoplayHoverPause="true"
              :loop="true"
              :scrollPerPage="false"
              :paginationEnabled="false"
              :perPageCustom="[[360, 2], [560, 4], [768, 8]]">
        <template v-for="category in categories">
            <slide :key="category.id">
                <a class="p-2 text-uppercase font-weight-light text-muted" :href="`/posts/${category.slug}`">
                    {{ category.name }}
                </a>
            </slide>
        </template>
    </carousel>
</div>
</template>

<script>
export default {
    props: ['categories'],

}
</script>
