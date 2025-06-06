<script setup lang="ts">
import { ref } from 'vue'
import type { FirstLastType, CharColorType, Char } from '@/types/product'
import axios from 'axios';

interface Props {
  char: Char
}

const props = defineProps<Props>()

const charColorOptions = ref<CharColorType[]>([])

const first = defineModel<FirstLastType>('first')
const last = defineModel<FirstLastType>('last')
  
const loadCharColorOptions = async () => {
  if (charColorOptions.value.length == 0) {
    try {
      const { data } = await axios.get(route('dashboard.api.color.options'))
      charColorOptions.value = data
    } catch (error) {
      console.log(error)
    }
  }
}

loadCharColorOptions()

if (typeof first.value !== 'object') {
  first.value = null
}

if (typeof last.value !== 'object') {
  last.value = null
}
</script>

<template>
  <q-list>
    <q-item>
      <q-item-section>
        <q-select
          flat 
          filled 
          square 
          dense 
          v-model="first" 
          label-color="gries" 
          color="gries" 
          :options="charColorOptions" 
          :label="props.char.title" 
          class="full-width"
          input-style="color: red;"
        >
          <template v-slot:option="scope">
            <q-item v-bind="scope.itemProps">
              <q-item-section avatar>
                <q-img
                  :src="scope.opt.href"
                  spinner-color="black"
                  style="height: 50px; max-width: 50px"
                  class="rounded-borders"
                />
              </q-item-section>
              <q-item-section>
                <q-item-label class="text-gries">{{ scope.opt.label }}</q-item-label>
              </q-item-section>
            </q-item>
          </template>
          <template v-if="first" v-slot:append>
            <q-icon name="fa-regular fa-circle-xmark" @click.stop.prevent="first=null" class="cursor-pointer" />
          </template>
          <q-tooltip transition-show="rotate" transition-hide="rotate" v-if="!!props.char.description">
            {{ props.char.description }}
          </q-tooltip>
        </q-select>
      </q-item-section>
    </q-item>
  </q-list>
</template>

<style lang="sass">
.q-field__native span.ellipsis
  color: $gries !important
</style>