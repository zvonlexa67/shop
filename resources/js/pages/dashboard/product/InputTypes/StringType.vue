<script setup lang="ts">
import type { FirstLastType, Char } from '@/types/product'

interface Props {
  char: Char
}

const props = defineProps<Props>()

const first = defineModel<FirstLastType>('first')
const last = defineModel<FirstLastType>('last')

if (typeof first.value !== 'string') {
  first.value = ''
}

if (typeof last.value !== 'string') {
  last.value = ''
}

const clearModel = () => {
  first.value = ''
  last.value = ''
}
</script>

<template>
  <q-list>
    <q-item dense>
      <q-item-section>
        <q-input 
          filled 
          flat 
          square 
          counter 
          dense 
          v-model="first as string" 
          label-color="gries" 
          color="gries" 
          :label="props.char.title" 
          class="q-pa-none" 
          input-class="text-gries"
        >
          <template v-slot:append>
            <q-icon name="fa-regular fa-circle-xmark" @click.stop.prevent="clearModel" class="cursor-pointer" />
          </template>
          <q-tooltip transition-show="rotate" transition-hide="rotate" v-if="!!props.char.description">
            {{ props.char.description }}
          </q-tooltip>
        </q-input>
      </q-item-section>
    </q-item>
  </q-list>
</template>
