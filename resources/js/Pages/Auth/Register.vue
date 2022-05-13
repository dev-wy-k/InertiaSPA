<template>
    <div class="container mt-5">
        <div class="row pt-5">
            <div class="col-md-4 offset-md-4">
                <h3 class="text-center">User Register</h3>
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
                            <!-- Name input -->
                            <div class="form-outline mb-5">
                                <input v-model="form.name" type="text" id="name" class="form-control" :class="{'is-invalid' : errors.name}" />
                                <label v-if="!form.name" class="form-label" for="name">Enter Name</label>
                                <small v-if="errors.name" class="invalid-feedback">{{ errors.name }}</small>
                            </div>

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

                            <!-- Photo input -->
                            <div class="form-outline mb-5">
                                <input @change="getImage" type="file" id="photo" class="form-control" />
                                <!-- <label class="form-label" for="photo">Photo</label> -->
                                <small v-if="errors.image" class="text-danger">{{ errors.image }}</small>
                            </div>

                            <div class="row mb-4">                               
                                <div class="col text-center">
                                    <Link href="/login">Already have a account ?</Link>
                                </div>
                            </div>

                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary btn-block" :disabled="is_loading">
                                <div v-if="is_loading" class="spinner-border spinner-border-sm" role="status">
                                    <span class="visually-hidden mr-2">Loading...</span>                                    
                                </div>
                                <span v-if="!is_loading">Register</span>
                            </button>
                        </form>
                        
              
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { Link } from '@inertiajs/inertia-vue'

    export default {
        name: 'Register',
        components: {Link},

        props: ['errors'],
        data() {
            return {
                form:{
                    name : '',
                    email : '',
                    password : '',
                    image : '',
                },
                is_loading : false
            }
        },
        methods: {
            getImage(e){
                this.form.image = e.target.files[0] ;
                this.is_loading = false ;
            },
            submit() {
                this.is_loading = true ;
                this.$inertia.post('/register', this.form, {
                    onSuccess : ()=> this.is_loading = false,
                    onError : ()=> this.is_loading = false
                })
            },            
        },
    }
</script>

<style lang="scss" scoped>

</style>