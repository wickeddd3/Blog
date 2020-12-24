<template>
<div class="container__row">
    <div class="container__col-xl-9 container__col-12">
        <div class="addpost__card">
            <h1 class="addpost__title">Add New Post</h1>
            <error-message :errors="errors"></error-message>
            <success-message :message="success" v-show="!errors && success"></success-message>
            <div class="addpost__item">
                <input type="text" v-model="form.title" class="addpost__input" placeholder="TITLE" autofocus>
            </div>
            <div class="addpost__item addpost__item--editor">
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
                    @click="save">
                    {{ loading ? 'Saving. . .' : 'Publish' }}
            </button>
        </div>
    </div>
</div>
</template>

<script>
import { VueEditor } from "vue2-editor";
import ErrorMessage from './ErrorMessage';
import SuccessMessage from './SuccessMessage';

export default {
    components: {
        VueEditor,
        ErrorMessage,
        SuccessMessage
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
        save() {
            this.loading = true;
            axios.post('/posts', {form:this.form})
                .then(response => {
                    Object.keys(this.form).forEach(key => this.form[key] = "");
                    this.form.tags = [];
                    this.errors = false;
                    this.success = "Post created and published successfully !";
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
