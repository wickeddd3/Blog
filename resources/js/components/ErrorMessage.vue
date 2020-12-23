<template>
<div class="errors" v-show="errors">
    <template v-for="(error, index) in errors">
        <div class="errors__message" :key="index">{{ error[0] }}</div>
    </template>
</div>
</template>

<script>
export default {
    props:['errors']
}
</script>
