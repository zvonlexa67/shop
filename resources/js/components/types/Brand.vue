<script setup>
  import { inject } from 'vue'

  defineOptions({
    name: 'Brand'
  })

  const props = defineProps({
    char: Object,
  })

  const first = defineModel('first')
  const last = defineModel('last')

  const { charBrandOptions, loadCharBrandOptions } = inject('brand')

  loadCharBrandOptions()
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
          :options="charBrandOptions" 
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