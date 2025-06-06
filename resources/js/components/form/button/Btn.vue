<script setup lang="ts">
import { cn } from '@/lib/utils'

interface Props {
  label: string,
  class?: string,
  color?: string,
}

const props = withDefaults(defineProps<Props>(), {
    // error: false,
    // readonly: false,
  labelColor: 'gries',
  color: 'gries',
})


const emit = defineEmits<{
  (e: 'onClick'): void
}>()

const onClick = () => {
  emit('onClick')
}

</script>

<template>
    <q-btn
        flat
        :color="color"
        :label="props.label"
        no-caps
        :class="cn('bg-btn-none', props.class)"
        @click.stop.prevent="onClick"
    >
    <slot />
    </q-btn>
<!-- :class="cn('text-gries bg-btn-none', props.class)" -->
</template>
