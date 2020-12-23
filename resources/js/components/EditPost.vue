<template>
<div class="container__row">
    <div class="container__col-xl-9 container__col-12">
        <div class="addpost__card">
            <h1 class="addpost__title">Edit Post</h1>
            <ErrorMessage :errors="errors" />
            <SuccessMassage :message="success" v-show="!errors && success" />
            <div class="addpost__item">
                <input type="text" v-model="form.title" class="addpost__input" placeholder="TITLE" autofocus>
            </div>
            <div class="addpost__item">
                <vue-editor id="editor" v-model="form.content" />
            </div>
        </div>
    </div>
    <div class="container__col-xl-3 container__col-12">
        <div class="addpost__card">
            <div class="addpost__item">
                <label class="addpost__label">Featured Image</label>
                <input type="file" @change="onImageChange" class="addpost__input--file" name="featured" id="featured">
                <img :src="form.featured" v-show="form.featured" class="addpost__featured" alt="featured image">
            </div>
            <div class="addpost__item">
                <label class="addpost__label">Category</label>
                <select name="category" v-model="form.category" id="category" class="addpost__select">
                    <option value="">Choose category</option>
                    <template v-for="category in categories">
                        <option :value="category.id" :key="category.id">{{ category.name }}</option>
                    </template>
                </select>
            </div>
            <div class="addpost__item">
                <label class="addpost__label">Tags</label>
                <div class="addpost__tags">
                    <ul class="addpost__tags-list">
                        <template v-for="tag in tags">
                            <li class="addpost__tags-item" :key="tag.id">
                                <input type="checkbox" class="addpost__checkbox" v-model="form.tags" :value="tag.id"> {{ tag.name }}
                            </li>
                        </template>
                    </ul>
                </div>
            </div>
            <button type="submit"
                    class="btn btn--primary addpost__btn"
                    :class="{'btn--disabled':loading}"
                    :disabled="loading"
                    @click="update">
                    {{ loading ? 'Updating. . .' : 'Update' }}
            </button>
        </div>
    </div>
</div>
</template>

<script>
import { VueEditor } from "vue2-editor";
import ErrorMessage from './ErrorMessage';
import SuccessMassage from './SuccessMessage';

export default {
    components: {
        VueEditor,
        ErrorMessage,
        SuccessMassage
    },

    data() {
        return {
            categories:[],
            tags:[],
            form: {
                title:"",
                content:"",
                featured:"",
                category:"",
                tags:[]
            },
            errors:false,
            success:false,
            loading:false
        };
    },

    created() {
        this.fetchCategories();
        this.fetchTags();
        this.fetchPost();
    },

    methods: {
        fetchCategories() {
            axios.get('/admin/panel/categories')
                .then((response) => {
                    this.categories = response.data.categories.data;
                })
        },
        fetchTags() {
            axios.get('/admin/panel/tags')
                .then((response) => {
                    this.tags = response.data.tags.data;
                })
        },
        onImageChange(e) {
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            this.createImage(files[0]);
        },
        createImage(file) {
            let reader = new FileReader();
            let vm = this;
            reader.onload = (e) => {
                vm.form.featured = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        fetchPost() {
            axios.get(`${location.pathname}`)
                .then((response) => {
                    let post = response.data.post;
                    this.form.slug = post.slug;
                    this.form.title = post.title;
                    this.form.content = post.content;
                    this.form.category = post.category.id;
                    this.form.tags = post.tags.map(tag => { return tag.id });
                })
        },
        update() {
            this.loading = true;
            axios.patch(`/posts/${this.form.slug}`, {form:this.form})
                .then(response => {
                    this.errors = false;
                    this.success = "Post updated successfully !";
                    this.loading = false;
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                    this.loading = false;
                })
        }
    }
}
</script>
