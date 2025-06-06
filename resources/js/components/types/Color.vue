<script setup lang="ts">
import { ref } from 'vue'
import axios from 'axios'
import type { Char } from '@/types/product'

interface Prop {
  char: Char
}

const props = defineProps<Prop>()

const first = defineModel('first')
const last = defineModel('last')

const charColorOptions = ref()

const loadCharColorOptions = async () => {
  try {
    const { data } = await axios.get(route('dashboard.api.color.options'))
    charColorOptions.value = data
  } catch (error) {
    console.log(error)
  }
}

loadCharColorOptions()
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
          :label="char.title" 
          class="full-width"
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
                <q-item-label>{{ scope.opt.label }}</q-item-label>
              <!-- <q-item-label caption>{{ scope.opt.description }}</q-item-label> -->
              </q-item-section>
            </q-item>
          </template>
          <template v-if="first" v-slot:append>
            <q-icon name="fa-regular fa-circle-xmark" @click.stop.prevent="first=null" class="cursor-pointer" />
          </template>
          <q-tooltip transition-show="rotate" transition-hide="rotate" v-if="!!char.description">
            {{ char.description }}
          </q-tooltip>
        </q-select>
      </q-item-section>
    </q-item>
  </q-list>
</template>