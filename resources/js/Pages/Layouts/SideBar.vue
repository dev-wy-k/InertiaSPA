<template>
  <div class="col-md-4">
    <div v-show="!isProfileUrl" class="card">
      <div class="card-header bg-primary text-white text-center">
        <Link :href="route('question.create')" class="text-white">Ask Any Question ?</Link>
      </div>
      <div class="card-body p-3">
        <h5 class="mb-3">Tags</h5>
        <ul class="list-group">
          <li class="list-group-item" v-for="tag in $page.props.tags" :key="tag.id">
            <Link :href="'/?tag='+tag.slug">{{ tag.name }}</Link>
          </li>
        </ul>
      </div>
    </div>

    <div v-show="isProfileUrl" class="card">
      <div class="card-header bg-primary text-white text-center">
        <Link class="text-white">Profile</Link>
      </div>
      <div class="card-body p-3">
        <ul class="list-group">
          <li class="list-group-item">
            <i class="fas fa-user me-2 text-info"></i>
            <Link :href="route('profile.edit')">Edit Profile</Link>
          </li>
          <li class="list-group-item">
            <i class="fas fa-question me-2 text-info"></i>
            <Link :href="route('question.user')">Your Questions</Link>
          </li>
          <li class="list-group-item">
            <i class="fas fa-star me-2 text-info"></i>
            <Link :href="route('question.save.question')">Your Save Questions</Link>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue";
export default {
  name: "SideBar",
  components: {Link},
  data() {
    return {
      path: ''
    }
  },
  computed: {
    isProfileUrl(){
      let path = location.pathname
      let expression = '/profile/.*'
      let response = path.match(expression)

      if(response != null){
        return true
      }else{
        return false
      }
    }
  },
};
</script>

<style lang="scss" scoped>
</style>