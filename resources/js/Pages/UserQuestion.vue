<template>
    <div>
        <master>
            <div class="card mb-3">
                <div class="card-header bg-dark text-center text-white">
                    Your Questions
                </div>
                <div v-if="ques.length >= 1" class="card-body">
                    <div class="card mb-3" v-for="(q,index) in ques" :key="index">
                    <div class="card-header bg-dark text-white">
                    <div class="d-flex justify-content-between">
                        <div class="">
                        <span v-if="q.is_fixed == 'false'" class="badge badge-danger badge-sm">Need Fix</span>
                        <span v-else class="badge badge-success badge-sm">Fixed</span>
                        </div>
                        <div class="">
                        <span>{{ q.title }}</span>
                        </div>
                        <div class="">
                        <button v-show="q.is_fixed !='true'" @click="setFixed(index,q.id)" class="badge badge-warning badge-sm">Fixed</button>
                        <button @click="questionDelete(index,q.id)" class="badge badge-danger badge-sm">Delete</button>
                        </div>
                    </div>
                    </div>
                    <div class="card-body">
                    <div class="mb-2">
                        <Link href="#" v-for="tag in q.tag" :key="tag.id" class="badge badge-info badge-sm">{{ tag.name }}</Link>
                    </div>
                    <p>
                        {{ q.description }}
                    </p>
                    <!-- like comment start -->
                    <div class="d-flex justify-content-between">
                        <div class="">
                        <span>
                            <i v-show="q.is_like !== 'true'" class="far fa-heart text-danger ms-3"></i> 
                            <i v-show="q.is_like == 'true'" class="fas fa-heart text-danger ms-3"></i> 
                            {{ q.like_count }} 
                        </span>
                        <span>
                            <i v-if="q.comment.length == 0" class="far fa-comment text-success ms-3"></i>
                            <i v-else class="fas fa-comment text-success ms-3"></i> {{ q.comment.length }} 
                        </span>
                        <span>
                            <i v-if="q.is_save == 'true'" class="fas fa-star text-warning ms-3"></i>
                            <i v-if="q.is_save == 'false'" @click="saveQuestion(q.id, index)" class="far fa-star text-warning ms-3"></i>
                        </span>
                        </div>
                        <Link class="btn btn-black" :href="route('question.detail',q.slug)" >Read More</Link>
                    </div>
                    <!-- like comment end -->

                    </div>
                </div>
                </div>

                <div v-if="ques.length == 0" class="card-body p-5">
                    <h4 class="text-center">There is no Question !! 🤗🤗</h4>
                </div>

            </div>
            <pagination v-if="ques.length >= 1" :links="questions.links" :tag="tag"></pagination>
        </master>
    </div>
</template>

<script>
import Master from './Layouts/Master.vue'
import VueToastr from "vue-toastr";
import { Link } from "@inertiajs/inertia-vue";
import axios from 'axios';
import Pagination from './Component/Pagination.vue';
    export default {
        name: 'UserQuestion',
        props: ['questions'],
        components: { Master, Link, VueToastr, Pagination },
        data() {
            return {
                ques: '',
                tag: null
            }
        },
        methods: {
            questionDelete(index,id) {
                axios.get(route('question.delete', id))
                .then((res)=> {
                    if(res.data.success){
                        this.ques.splice(index,1);
                        this.$toastr.s('Question Delete Successful')
                    }
                })
            },
            setFixed(index,id){
                axios.post(route('question.fix', id))
                .then((res)=> {
                    if(res.data.success){
                        this.ques[index].is_fixed = 'true'
                    }
                })
            },
            saveQuestion(id,index){
                axios.post(`/question/save/${id}`)
                .then((res)=> {
                if(res.data.success == true){
                    this.ques[index].is_save = "true";
                    this.$toastr.s('Save Question Successfully')
                }
                })
            }
        },
        created() {
            this.ques = this.questions.data
        }
    }
</script>

<style lang="scss" scoped>

</style>