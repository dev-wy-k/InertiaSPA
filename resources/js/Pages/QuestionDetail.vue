<template>
    <div>
        <master>
            <div class="card mb-3">
                <div class="card-header bg-dark text-white">
                <div class="d-flex justify-content-between">
                    <div class="">
                    <span v-if="q.is_fixed == 'false'" class="badge badge-danger badge-sm">Need Fix</span>
                    <span v-else class="badge badge-success badge-sm">Fixed</span>
                    </div>
                    <div class="">
                    <span class="text-center">{{ q.title }}</span>
                    </div>
                    <div v-if="isUser(q.user_id)" class="">
                    <button v-show="q.is_fixed !='true'" @click="setFixed(q.id)" class="badge badge-warning badge-sm">Fixed</button>
                    </div>
                </div>
                </div>
                <div class="card-body">
                <div class="mb-2">
                    <Link :href="'/?tag=' + tag.slug" v-for="tag in q.tag" :key="tag.id" class="badge badge-info badge-sm">{{ tag.name }}</Link>
                </div>
                <p>
                    {{ q.description }}
                </p>
                <!-- like comment start -->
                <div class="d-flex justify-content-between">
                    <div class="">
                    <span>
                        <i @click="like(q.id)" v-show="q.is_like !== 'true'" class="far fa-heart text-danger ms-3"></i> 
                        <i v-show="q.is_like == 'true'" class="fas fa-heart text-danger ms-3"></i> 
                        {{ q.like_count }} 
                    </span>
                    <span>
                        <i v-if="q.comment.length == 0" class="far fa-comment text-success ms-3"></i>
                        <i v-else class="fas fa-comment text-success ms-3"></i> {{ q.comment.length }} 
                    </span>
                    <span>
                        <i v-if="q.is_save == 'true'" class="fas fa-star text-warning ms-3"></i>
                        <i v-if="q.is_save == 'false'" @click="saveQuestion(q.id)" class="far fa-star text-warning ms-3"></i>
                    </span>
                    </div>
                </div>
                <!-- like comment end -->                 
                </div>
                <!-- Create Comment Start -->
                <div class="card p-2">
                    <form @submit.prevent="createComment(q.id)">
                        <div class="form-outline mb-3">
                            <textarea v-model="comment" class="form-control"></textarea>
                            <label v-if="!comment" class="form-label">Comment Here</label>
                            <button type="submit" class="btn btn-black btn-sm float-end mt-2">Comment</button>                            
                        </div>
                    </form>
                </div>
                <!-- Create Comment End -->
            </div>
            <!-- Comment Box start  -->
                <div class="card p-2 mb-3" v-for="cmt in q.comment" :key="cmt.id">
                    <div class="card-header bg-dark text-white">
                        <img :src="'/storage/profile/'+cmt.user.image" class="rounded-circle me-2" width="50px" height="50px" alt="">
                        <span>{{ cmt.user.name }}</span>
                        <small>comment: {{ cmt.date }}</small>
                    </div>
                    <div class="card-body">
                        {{ cmt.comment }}
                    </div>
                </div>
                <!-- Comment Box end  -->
        </master>
    </div>
</template>

<script>
    import axios from 'axios';
    import Master from './Layouts/Master.vue'
    import { Link } from "@inertiajs/inertia-vue";
    import VueToastr from "vue-toastr";

    export default {
        name: 'QuestionDetail',
        props: ['question', 'auth_user', 'errors'],
        components: { Master, VueToastr, Link },
        data() {
            return {
                q: '',
                comment: ''
            }
        },
        created () {
            this.q = this.question;
        },methods: {
            like(id) {      
            axios.get(`/question/like/${id}`).then(res=>{
                if(res.data.success == true){
                    this.q.is_like = 'true';
                    this.q.like_count += 1;
                    this.$toastr.s('Like Successful')
                }
            })
            },
            isUser(user_id){
                const auth_user = this.auth_user.id 
                if(user_id == auth_user){
                    return true
                }else{
                    return false
                }
            },
            createComment(q_id){
                let data = {
                    'question_id' : q_id, 
                    'comment' : this.comment,
                }
                axios.post('/question/comment/create', data)
                .then((res)=> {
                    if(res.data.success){
                        this.q.comment.push(res.data.comment)
                        this.comment = ''
                        this.$toastr.s('Comment Successful')
                    }
                })
            },
            setFixed(id){
                axios.post(route('question.fix', id))
                .then((res)=> {
                    if(res.data.success){
                        this.q.is_fixed = 'true'
                    }
                })
            },
            saveQuestion(id){
                axios.post(`/question/save/${id}`)
                .then((res)=> {
                if(res.data.success == true){
                    this.q.is_save = "true";
                    this.$toastr.s('Save Question Successfully')
                }
                })
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>