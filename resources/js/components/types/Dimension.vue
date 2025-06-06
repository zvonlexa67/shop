<script setup>
  import { ref, inject } from 'vue'

  defineOptions({
    name: 'Dimension'
  })

  const props = defineProps({
    char: Object,
  })

  const first = defineModel('first')
  const last = defineModel('last')

  const { charDimensionOptions, loadCharDimentionOptions } = inject('dimension')

  loadCharDimentionOptions()
</script>

<template>
  <q-list>
    <q-item dense>
      <q-item-section>
        <q-select
          flat 
          filled 
          square 
          dense 
          v-model="first" 
          label-color="gries" 
          color="gries" 
          :options="charDimensionOptions" 
          :label="char.title" 
          class="full-width"
        >
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