<script setup lang="ts">
import CommonLayout from '@/layouts/CommonLayout.vue'
// import MainAdv from '@/components/adv/MainAdv.vue'
import { Head } from '@inertiajs/vue3'

// import { usePage, Head, Link } from '@inertiajs/vue3'
// import { ref, toRaw } from 'vue'
// import { useQuasar } from 'quasar'
// import { Screen } from 'quasar'

// defineOptions({
//   name: "Index",
// })

// defineProps<{
//   slides: array,
// }>()

//    const slides = toRaw(props.slides)

// const $q = useQuasar()

//console.log($q.platform.is.mobile)
//console.log(slides)

</script>

<template>
<common-layout>
    <Head title="Home" />
    <!-- <main-adv :slides="slides" /> -->

    <!--    <p>{{ $page }}</p>
<p>{{ $page.props.auth }}</p>
-->
    <div v-for="n in 50" :key="n">
        <p class="sm text-primary bg-gries"><!-- <p class=" gt-md text-primary desktop-only"> -->
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit nihil praesentium
            molestias a adipisci, dolore vitae odit, quidem consequatur optio voluptates
            asperiores pariatur eos numquam rerum delectus commodi perferendis voluptate?
        </p>
        <p class="md text-negative bg-dbrem"><!-- <p class=" gt-lg text-negative mobile-only"> -->
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit nihil praesentium
            molestias a adipisci, dolore vitae odit, quidem consequatur optio voluptates
            asperiores pariatur eos numquam rerum delectus commodi perferendis voluptate?
        </p>
        <p class="lg text-positive bg-dbrem"><!-- <p class=" gt-lg text-negative mobile-only"> -->
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit nihil praesentium
            molestias a adipisci, dolore vitae odit, quidem consequatur optio voluptates
            asperiores pariatur eos numquam rerum delectus commodi perferendis voluptate?
        </p>
        <p class="xl text-gries"><!-- <p class=" gt-lg text-negative mobile-only"> -->
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit nihil praesentium
            molestias a adipisci, dolore vitae odit, quidem consequatur optio voluptates
            asperiores pariatur eos numquam rerum delectus commodi perferendis voluptate?
        </p>
    </div>
</common-layout>
</template>

<style lang="sass" scoped>
.my-p
  body.screen--md &
    color: red
  body.screen--lg &
    color: blue
</style>
