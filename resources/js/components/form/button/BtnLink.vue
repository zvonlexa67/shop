<script setup lang="ts">
import { HTMLAttributes } from 'vue'
import { Link } from '@inertiajs/vue3'
import { cn } from "@/lib/utils"

const props = defineProps<{
    href: string,
    label: string,
    class?: HTMLAttributes['class'],
    linkClass?: HTMLAttributes['class'],
}>()
</script>

<template>
    <Link :href="props.href" :class="linkClass">
        <q-btn flat square :label="props.label" :class="cn('bg-btn-none', props.class)" no-caps />
        <!-- <q-btn flat :label="props.label" :class="cn('text-gries bg-btn-none', props.class)" no-caps /> -->
    </Link>
</template>
