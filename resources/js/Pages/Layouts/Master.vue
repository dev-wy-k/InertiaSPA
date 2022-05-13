<template>
  <div class="">
    <!-- Navbar start  -->
    <nav-bar/>
    <!-- Navbar End  -->

    <div class="container mt-3">
            <div class="row">

            <!-- Sidebar Start  -->
                <side-bar/>
            <!-- Sidebar End  -->
            
                <div class="col-md-8">
                    <slot/>
                </div>
            </div>
        </div>
  </div>
</template>


<script>
import { Link } from "@inertiajs/inertia-vue";
import SideBar from './SideBar.vue';
import NavBar from './NavBar.vue';
export default {
  name: "Master",
  components: { Link,SideBar, NavBar, },
};
</script>

<style lang="scss" scoped>
</style>

