<template>
    <div class="d-flex justify-content-center">
        <nav aria-label="...">
            <ul class="pagination">
                <li class="page-item" :class="{'active' : l.active }" v-for="(l,index) in links" :key="index">
                <Link v-if="tag == null" :href="l.url" class="page-link text-cof" v-html="l.label"></Link>

                <Link v-show="!tag.tag && !tag.type" v-if="tag !== null" :href="l.url" class="page-link text-cof" v-html="l.label"></Link>                
                <Link v-show="tag.tag" v-if="tag !== null" :href="l.url+'&tag='+tag.tag" class="page-link text-cof" v-html="l.label"></Link>                
                <Link v-show="tag.type" v-if="tag !== null" :href="l.url+'&type='+tag.type" class="page-link text-cof" v-html="l.label"></Link>                
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue";

    export default {
        name: 'Pagination',
        components: {Link},
        props: ['links', 'tag']
    }
</script>

<style lang="scss" scoped>

</style>