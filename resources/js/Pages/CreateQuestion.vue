<template>
    <div>
        <master>
            <div class="card">
                <div class="card-header bg-dark text-white text-center">
                    Ask Your Question
                </div>
                <div class="card-body">
                    <form @submit.prevent=createQuestion()>
                        <!-- Title  -->
                        <div class="mb-3">
                            <label for="form-label">Enter Title</label>
                            <input v-model="question.title" type="text" class="form-control mb-0" :class="{'is-invalid' : errors.title}">
                            <small v-if="errors.title" class="text-danger">{{ errors.title }}</small>
                        </div>
                        <div class="mb-3">
                            <div class="form-check" v-for="tag in tags" :key="tag.id">
                                <input class="form-check-input" type="checkbox" :value="tag.id" :id="tag.id" v-model="question.tag"/>
                                <label class="form-check-label" :for="tag.id">{{ tag.name }}</label>
                            </div>
                            <small v-if="errors.tag" class="text-danger mb-3">{{ errors.tag }}</small>
                        </div>

                        <!-- Description  -->
                        <div class="mb-3">
                            <label class="form-label">Enter Description</label>
                            <textarea v-model="question.description" class="form-control mb-0" rows="5" :class="{'is-invalid' : errors.description}"></textarea>
                            <small v-if="errors.description" class="text-danger">{{ errors.description }}</small>
                        </div>
                        <Link :href="route('home')" class="btn btn-black btn-sm">Back</Link>
                        <button type="submit" class="btn btn-primary btn-sm float-end" :disabled="is_loading">
                            <div v-if="is_loading" class="spinner-border spinner-border-sm" role="status">
                                <span class="visually-hidden mr-2">Loading...</span>                                    
                            </div>
                            <span v-if="!is_loading">Ask</span>
                        </button>
                    </form>
                </div>
            </div>
        </master>
    </div>
</template>

<script>
import Master from "./Layouts/Master.vue"
import { Link } from "@inertiajs/inertia-vue";
import VueToastr from "vue-toastr";


    export default {
        name: 'CreateQuestion',
        components: { Master, Link, VueToastr },
        props: ['tags', 'errors'],
        data() {
            return {
                is_loading: false,
                question: {
                    title: '',
                    description: '',
                    tag: []
                }
            }
        },
        methods: {
            createQuestion() {
                this.is_loading = true
                this.$inertia.post('/question/create', this.question)
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>