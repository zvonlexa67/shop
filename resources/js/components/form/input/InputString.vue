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
  filled?: boolean
  flat?: boolean
  square?: boolean
  dense?: boolean
  inputClass?: string
}

const props = withDefaults(defineProps<Props>(), {
  error: false,
  readonly: false,
  filled: true,
  flat: true,
  square: true,
  dense: true,
  labelColor: 'gries',
  color: 'gries',
  inputClass: 'text-gries'
})

const model = defineModel<string>()
</script>

<template>
  <q-input 
    :filled="filled" 
    :flat="flat" 
    :square="square" 
    :readonly="readonly" 
    dense 
    :label-color="labelColor" 
    :color="color" 
    v-model="model"
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
