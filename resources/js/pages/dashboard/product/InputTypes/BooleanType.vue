<script setup lang="ts">
import type { FirstLastType, Char } from '@/types/product'

interface Props {
  char: Char
}

const props = defineProps<Props>()

const first = defineModel<FirstLastType>('first')
const last = defineModel<FirstLastType>('last')

if (typeof first.value !== 'boolean') {
  first.value = ''
}

if (typeof last.value !== 'boolean') {
  last.value = ''
}
</script>

<template>
  <q-list>
    <q-item dense tag="label" class="text-gries" v-ripple>
      <q-item-section>
        <q-item-label>{{ props.char.title }}</q-item-label>
        <q-tooltip transition-show="rotate" transition-hide="rotate" v-if="!!props.char.description">
          {{ props.char.description }}
          </q-tooltip>
      </q-item-section>
      <q-item-section avatar>
        <q-toggle color="gries" v-model="first" />
        <q-tooltip transition-show="rotate" transition-hide="rotate" v-if="!!props.char.description">
          {{ props.char.description }}
        </q-tooltip>
      </q-item-section>
    </q-item>
  </q-list>  
</template>