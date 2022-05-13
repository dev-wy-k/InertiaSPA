<template>
    <div class="container mt-5">
        <div class="row pt-5">
            <div class="col-md-4 offset-md-4">
                <h3 class="text-center">User Login</h3>
                <div class="card">                
                    <div class="card body p-5">
                        <!-- <form @submit.prevent="submit">
                            <div class="mb-3">
                                <label for="name" class="form-label">Email</label>
                                <input v-model="form.name" type="text" id="name" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input v-model="form.email" type="email" id="email" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input v-model="form.password" type="password" id="password" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Photo</label>
                                <input type="file" id="image" class="form-control" @change="getImage">
                            </div>

                            <button type="submit" class="btn btn-danger btn-block">Register</button>
                        </form> -->

                        <form @submit.prevent="submit">

                            <!-- Email input -->
                            <div class="form-outline mb-5">
                                <input v-model="form.email" type="email" id="email" class="form-control" :class="{'is-invalid' : errors.email}" />
                                <label v-if="!form.email" class="form-label" for="email">Email address</label>
                                <small v-if="errors.email" class="invalid-feedback">{{ errors.email }}</small>

                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-5">
                                <input v-model="form.password" type="password" id="password" class="form-control" :class="{'is-invalid' : errors.password}" />
                                <label v-if="!form.password" class="form-label" for="password">Password</label>
                                <small v-if="errors.password" class="invalid-feedback">{{ errors.password }}</small>
                            </div>

                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary btn-block" :disabled="is_loading">
                                <div v-if="is_loading" class="spinner-border spinner-border-sm" role="status">
                                    <span class="visually-hidden mr-2">Loading...</span>                                    
                                </div>
                                <span v-if="!is_loading">Login</span>
                            </button>
                        </form>

                        <Link class="text-center mt-2" :href="route('register')">Don't you have an account ?</Link>
                        
              
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { Link } from "@inertiajs/inertia-vue";
    import VueToastr from "vue-toastr";

    export default {
        name: 'Login',
        props: ['error', 'errors'],
        components: {Link, VueToastr},
        data() {
            return {
                form: {
                    email : '',
                    password : ''
                },
                is_loading : false,
                e: ''
            }
        },
        methods: {
            submit() {
                this.clear();
                this.is_loading = true;
                this.$inertia.post('/login', this.form, {
                    onSuccess : ()=> {
                        this.is_loading = false;
                        if(this.error != ''){
                            this.$toastr.e(this.error)
                        }
                    }
                })
            },
            clear(){
                this.error = ''
            }
        }        
    }
</script>

<style lang="scss" scoped>

</style>