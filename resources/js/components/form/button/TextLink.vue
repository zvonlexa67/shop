<script setup lang="ts">
import { cn } from '@/lib/utils'

interface Props {
    label: string,
    class?: HTMLAttributes['class'],
    href: string,
}

const props = defineProps<Props>()

</script>

<template>
    <q-btn
        flat
        square
        no-caps
        :label="props.label"
        :href="props.href"
        style="min-height: 0px; line-height: 0;"
        :class="cn('q-pa-none q-btn-bg-none', props.class)"
    />
</template>
