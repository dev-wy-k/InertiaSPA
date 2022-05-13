<template>
  <div>
    <master>
      <div v-if="questions.data.length >= 1" class="">
        <div class="card mb-3" v-for="(q, index) in questions.data" :key="index">
          <div class="card-header bg-dark text-white">
            <div class="d-flex justify-content-between">
              <div class="">
                <span
                  v-if="q.is_fixed == 'false'"
                  class="badge badge-danger badge-sm"
                  >Need Fix</span
                >
                <span v-else class="badge badge-success badge-sm">Fixed</span>
              </div>
              <div class="text-center">
                <span class="text-center">{{ q.title }}</span>
              </div>
              <div></div>
            </div>
          </div>
          <div class="card-body">
            <div class="mb-2">
              <Link
                :href="'/?tag=' + tag.slug"
                v-for="tag in q.tag"
                :key="tag.id"
                class="badge badge-info badge-sm"
                >{{ tag.name }}</Link
              >
            </div>
            <p>
              {{ q.description }}
            </p>
            <!-- like comment start -->
            <div class="d-flex justify-content-between">
              <div class="">
                <span>
                  <i
                    @click="like(q.id, index)"
                    v-show="q.is_like !== 'true'"
                    class="far fa-heart text-danger ms-3"
                  ></i>
                  <i
                    v-show="q.is_like == 'true'"
                    class="fas fa-heart text-danger ms-3"
                  ></i>
                  {{ q.like_count }}
                </span>
                <span>
                  <i
                    v-if="q.comment.length == 0"
                    class="far fa-comment text-success ms-3"
                  ></i>
                  <i v-else class="fas fa-comment text-success ms-3"></i>
                  {{ q.comment.length }}
                </span>
                <span>
                  <i v-if="q.is_save == 'true'" class="fas fa-star text-warning ms-3"></i>
                  <i v-if="q.is_save == 'false'" @click="saveQuestion(q.id, index)" class="far fa-star text-warning ms-3"></i>
                </span>
              </div>
              <Link class="btn btn-black" :href="route('question.detail', q.slug)"
                >Read More</Link
              >
            </div>
            <!-- like comment end -->
          </div>
        </div>
        <pagination :links="questions.links" :tag="tag"></pagination>
      </div>
      <div v-if="questions.data.length == 0" class="h-auto">
        <div class="card mb-3">
          <div class="card-header bg-dark">
            <p class="text-white text-center mb-0">No More Questions</p>
          </div>
          <div class="card-body p-5">
            <h4 class="text-center">There is no Question !! 🤗🤗</h4>
          </div>
        </div>
      </div>
    </master>
  </div>
</template>

<script>
import Master from "./Layouts/Master.vue";
import VueToastr from "vue-toastr";
import { Link } from "@inertiajs/inertia-vue";
import Pagination from "./Component/Pagination.vue";
import axios from 'axios';

export default {
  name: "Home",
  props: ["success", "questions", "auth_user", "tag"],
  components: { Link, Master, VueToastr, Pagination },
  data() {
    return {};
  },
  created() {
    if (!this.success == "") {
      this.$toastr.s(this.success);
    }
  },
  methods: {
    like(id, index) {
      alert(id)
      axios.get(`/question/like/${id}`).then((res) => {
        if (res.data.success == true) {
          this.questions.data[index].is_like = "true";
          this.questions.data[index].like_count += 1;
          this.$toastr.s("Like Successful");
        }
      });
    },
    isUser(user_id) {
      const auth_user = this.auth_user.id;
      if (user_id == auth_user) {
        return true;
      } else {
        return false;
      }
    },
    setFixed(index, id) {
      axios.post(route("question.fix", id)).then((res) => {
        if (res.data.success) {
          this.questions.data[index].is_fixed = "true";
        }
      });
    },
    saveQuestion(id, index){
        axios.post(`/question/save/${id}`)
        .then((res)=> {
          if(res.data.success == true){
            this.questions.data[index].is_save = "true";
            this.$toastr.s('Save Question Successfully')
          }
        })
    }
  },
};
</script>

<style lang="scss" scoped>
</style>