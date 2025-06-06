<script setup lang="ts">
import { HTMLAttributes } from 'vue'
import { Link } from '@inertiajs/vue3'
// import { cn } from "@/lib/utils"

const props = defineProps<{
    href: string,
    src: string,
    height: string,
    width: string,
    class?: HTMLAttributes['class'],
}>()

</script>

<template>
    <Link :href="href" :class="props.class">
        <q-img :src="src" :height="props.height" :width="props.width"/>
    </Link>
</template>
