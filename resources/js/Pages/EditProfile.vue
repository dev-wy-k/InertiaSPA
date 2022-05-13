<template>
    <div>
        <master>
            <div class="card">
                <div class="card-header bg-dark text-white text-center">
                    Edit Profile
                </div>
                <div class="card-body">
                    <form @submit.prevent="updateUser">
                        <!-- Name input -->
                        <div class="form-outline mb-5">
                            <input v-model="form.name" type="text" id="name" class="form-control" />
                            <label v-if="!form.name" class="form-label" for="name">Enter Name</label>
                            <!-- <small v-if="errors.name" class="invalid-feedback">{{ errors.name }}</small> -->
                        </div>

                        <!-- Email input -->
                        <div class="form-outline mb-5">
                            <input v-model="form.email" type="email" id="email" class="form-control"  :class="{'is-invalid' : errors.email}"/>
                            <label v-if="!form.email" class="form-label" for="email">Email address</label>
                            <small v-if="errors.email" class="invalid-feedback">{{ errors.email }}</small>

                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-5">
                            <input v-model="form.password" type="password" id="password" class="form-control"  :class="{'is-invalid' : errors.password}"/>
                            <label v-if="!form.password" class="form-label" for="password">Password</label>
                            <small v-if="errors.password" class="invalid-feedback">{{ errors.password }}</small>
                        </div>

                        <!-- Photo input -->
                        <div class="form-outline mb-5">
                            <input type="file" id="photo" class="form-control" @change="getImage"/>
                            <!-- <label class="form-label" for="photo">Photo</label> -->
                            <small v-if="errors.image" class="text-danger">{{ errors.image }}</small>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" class="btn btn-primary float-end">
                            <div v-if="is_loading" class="spinner-border spinner-border-sm" role="status">
                                <span class="visually-hidden mr-2">Loading...</span>                                    
                            </div>
                            <span v-if="!is_loading">Update</span>
                        </button>
                    </form>
                    <div class="mt-3">
                        <img :src="'/storage/profile/'+user.image" alt="profile-img" width="150px">
                    </div>
                </div>
            </div>
        </master>
    </div>
</template>

<script>
import Master from './Layouts/Master.vue'
import VueToastr from "vue-toastr"

    export default {
        components: { Master, VueToastr },
        props: ['errors', 'success'],
        name: 'EditProfile',
        data() {
            return {
                form: {
                    name: '',
                    email: '',
                    password: '',
                    image: ''
                },
                is_loading: false 
            }
        },
        computed: {
            user() {
                return this.$page.props.auth_user
            }
        },
        methods: {
            getImage(e) {
                this.form.image = e.target.files[0]
            },
            updateUser(){
                this.is_loading = true
                this.$inertia.post('/profile/update', this.form, {
                    onSuccess : ()=> {
                        this.is_loading = false;
                        this.$toastr.s(this.success);
                    },                    
                    onError : ()=> this.is_loading = false
                })
            }
        },
        created(){
            this.form.name = this.user.name 
            this.form.email = this.user.email
        }
    }
</script>

<style lang="scss" scoped>

</style>