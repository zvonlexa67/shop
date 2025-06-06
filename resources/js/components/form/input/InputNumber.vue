<script setup lang="ts">
import { HTMLAttributes } from 'vue'
import { cn } from '@/lib/utils';

interface Props {
  label: string
  error_message?: string
  error?: boolean
  readonly?: boolean
  class?: HTMLAttributes['class']
  labelColor?: string
  color?: string
  inputClass?: string
}

const props = withDefaults(defineProps<Props>(), {
  error: false,
  readonly: false,
  labelColor: 'gries',
  color: 'gries',
  inputClass: 'text-gries'
})

const model = defineModel<number>()

</script>

<template>
  <q-input 
    filled 
    flat 
    square 
    :readonly="readonly" 
    dense 
    :label-color="labelColor" 
    :color="color" 
    v-model.number="model"
    :label="props.label" 
    :class="cn('q-error-pt-none', props.class)" 
    :input-class="inputClass"
    :error-message="props.error_message"
    :error="props.error" no-error-icon 
  />
</template>

<style lang="sass">
.q-error-pt-none .q-field__bottom
  padding-top: 0px
</style>
