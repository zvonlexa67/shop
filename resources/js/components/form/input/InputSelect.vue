<script setup lang="ts">
import { HTMLAttributes } from 'vue'
// import { cn } from '@/lib/utils';

interface Props {
    label: string
    options?: any[]
    class?: HTMLAttributes['class']
    labelColor?: string
    color?: string
    optionValue?: string
    optionLabel?: string
}

const props = withDefaults(defineProps<Props>(), {
  labelColor: 'gries',
  color: 'gries',
  optionValue: 'value',
  optionLabel: 'label',
})

const model = defineModel<object>()
</script>

<template>
  <q-select
    flat
    dense
    filled
    square
    :label-color="props.labelColor"
    :color="props.color"
    :options="props.options"
    v-model="model"
    :label="props.label"
    :class="props.class"
    :option-value="optionValue"
    :option-label="optionLabel"
  />
</template>
