<script setup lang="ts">
import type { Char } from '@/types/product'

interface Prop {
  char: Char
}

const props = defineProps<Prop>()

const first = defineModel<number | null>('first')
const last = defineModel<number | null>('last')

</script>

<template>
  <q-list>
    <q-item dense>
      <q-item-section>
        <q-input filled flat square dense type="number" v-model.number="first" label-color="gries" color="gries" :label="char.title" class="q-pa-none">
          <template v-slot:append>
            <q-icon name="fa-regular fa-circle-xmark" @click.stop.prevent="first=null;last=null;" class="cursor-pointer" />
          </template>
          <q-tooltip transition-show="rotate" transition-hide="rotate" v-if="!!char.description">
            {{ char.description }}
          </q-tooltip>
        </q-input>
      </q-item-section>
    </q-item>
  </q-list>
</template>