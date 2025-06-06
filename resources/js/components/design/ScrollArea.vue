<script setup lang="ts">
import { HTMLAttributes } from 'vue';

interface Props {
    style?: HTMLAttributes['style'],
    class?: HTMLAttributes['class'],
    thumbBgColor?: string,
}

const props = withDefaults(defineProps<Props>(), {
    thumbBgColor: 'rgb(154, 165, 174)',
})

// const contentStyle = {
//     backgroundColor: 'rgba(0,0,0,0.02)',
//     color: '#555',
// }

// const contentActiveStyle = {
//     backgroundColor: '#eee',
//     color: 'black',
// }

const contentStyle = {}
const contentActiveStyle = {}

const thumbStyle = {
    right: '2px',
    borderRadius: '5px',
    backgroundColor: props.thumbBgColor,
    width: '5px',
    opacity: '0.75',
}
</script>

<template>
<q-scroll-area
    :content-style="contentStyle"
    :content-active-style="contentActiveStyle"
    :thumb-style="thumbStyle"
    :class="props.class"
    :style="props.style"
>
    <slot />
</q-scroll-area>
</template>
