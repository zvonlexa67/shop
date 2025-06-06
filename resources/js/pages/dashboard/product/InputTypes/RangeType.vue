<script setup lang="ts">
import type { FirstLastType, Char } from '@/types/product'

interface Props {
  char: Char
}

const props = defineProps<Props>()

const first = defineModel<FirstLastType>('first')
const last = defineModel<FirstLastType>('last')

if (typeof first.value !== 'number') {
  first.value = 0
}

if (typeof last.value !== 'number') {
  last.value = 0
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
          dense 
          type="number" 
          v-model.number="first as number" 
          label-color="gries" 
          color="gries" 
          :label="props.char.title + ' c'" 
          class="q-pa-none"  
          input-class="text-gries"
        >
          <template v-slot:append>
            <q-icon name="fa-regular fa-circle-xmark" @click.stop.prevent="first=''" class="cursor-pointer" />
          </template>
          <q-tooltip transition-show="rotate" transition-hide="rotate">
            {{ props.char.description }}
          </q-tooltip>
        </q-input>
      </q-item-section>
      <q-item-section>
        <q-input 
          filled 
          flat 
          square 
          dense 
          type="number" 
          v-model.number="last as number" 
          label-color="gries" 
          color="gries" 
          :label="props.char.title + ' по'" 
          class="q-pa-none" 
          input-class="text-gries"
        >
          <template v-slot:append>
            <q-icon name="fa-regular fa-circle-xmark" @click.stop.prevent="last='';" class="cursor-pointer" />
          </template>
          <q-tooltip transition-show="rotate" transition-hide="rotate">
            {{ props.char.description }}
          </q-tooltip>
        </q-input>
      </q-item-section>
    </q-item>
  </q-list>
</template>