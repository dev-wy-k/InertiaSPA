<template>
    <div>   
        <master>
            <div class="card">
                <div class="card-header bg-dark text-center text-white">
                    Your Profile
                </div>
                <div class="card-body">
                    <div class="col-md-6 offset-3 text-center p-5">
                        <div class=" mb-3">
                            <img :src="'/storage/profile/'+auth_user.image" class="img-fluid rounded-circle" width="75px" height="75px" alt="profile_img">
                        </div>
                        <h4>{{ auth_user.name }}</h4>
                        <p>{{ auth_user.email }}</p>
                        <Link :href="route('profile.edit')" class="btn btn-primary btn-block">
                            Edit Profile
                        </Link>
                    </div>
                </div>
            </div>
        </master>
    </div>
</template>

<script>
import Master from './Layouts/Master.vue'
import { Link } from "@inertiajs/inertia-vue";

    export default {
        name: 'Profile',
        components: { Master, Link },
        props: ['auth_user'],
    }
</script>

<style lang="scss" scoped>

</style>