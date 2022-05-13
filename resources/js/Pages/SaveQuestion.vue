<template>
  <div>
    <master>
      <div class="card mb-3">
        <div class="card-header bg-dark text-center text-white">
          Your Save Questions
        </div>
        <div v-if="ques.length >= 1" class="card-body">
          <div class="card mb-3" v-for="(q, index) in ques" :key="index">
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
                <span>{{ q.question.title }}</span>
                <div class="float-end">
                  <i
                    v-if="q.question.savequestion.length > 0"
                    class="fas fa-star text-warning ms-3"
                  ></i>
                  <i
                    v-if="q.question.savequestion.length == 0"
                    class="far fa-star text-warning ms-3"
                  ></i>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="mb-2">
                <Link
                  href="#"
                  v-for="tag in q.question.tag"
                  :key="tag.id"
                  class="badge badge-info badge-sm"
                  >{{ tag.name }}</Link
                >
              </div>
              <p>
                {{ q.question.description }}
              </p>

              <Link
                class="btn btn-black float-end"
                :href="route('question.detail', q.question.slug)"
                >Read More</Link
              >
            </div>
          </div>
        </div>

        <div v-if="ques.length == 0" class="card-body p-5">
          <h4 class="text-center">There is no Question !! 🤗🤗</h4>
        </div>

        <!-- <table class="table table-bordered">
            <thead>
                <tr class="text-center">
                    <th>#</th>
                    <th>Questions</th>
                    <th>Save</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(q,index) in ques" :key="index">
                    <td>{{ index+1 }}</td>
                    <td>
                        <span class="h6">{{ q.question.title }}</span>
                        <br>
                        <small>{{ q.question.description }}</small>
                    </td>
                    <td>
                        <i
                            v-if="q.question.savequestion.length > 0"
                            class="fas fa-star text-warning ms-3"
                        ></i>
                        <i
                            v-if="q.question.savequestion.length == 0"
                            class="far fa-star text-warning ms-3"
                        ></i>
                    </td>
                </tr>
            </tbody>
        </table> -->
      </div>
      <pagination v-if="ques.length >= 1" :links="questions.links" :tag="tag"></pagination>
    
    </master>
  </div>
</template>

<script>
import Master from "./Layouts/Master.vue";
import { Link } from "@inertiajs/inertia-vue";
import Pagination from './Component/Pagination.vue';

export default {
  components: { Master, Link, Pagination },
  name: "SaveQuestion",
  props: ["questions"],
  data() {
    return {
      ques: "",
      tag: null
    };
  },
  created() {
    this.ques = this.questions.data;
  },
};
</script>

<style lang="scss" scoped>
</style>