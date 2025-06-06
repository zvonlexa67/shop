<script setup lang="ts">
import { ref } from 'vue'
import { ScrollArea } from '@/components/design';
import Update from './Update.vue'
import Smart from './Smart.vue'
import Compare from './Compare.vue';
import Test1 from './Test1.vue';

type ComponentKey = 'Update' | 'Smart' | 'Compare' | 'Test1'

const isComponent = ref<ComponentKey>('Update')
const tagComponents = { Update, Smart, Compare, Test1 }

</script>

<template>
  <q-toolbar class="bg-mutan text-gries border-bottom-grey-light-0">
    <q-tabs
      v-model="isComponent"
      dense
      active-color="gries"
    >
      <q-tab no-caps name="Update" label="Категория" />
      <q-tab no-caps name="Smart" label="Умный фильтр" />
      <q-tab no-caps name="Compare" label="Сравнение" />
      <q-tab no-caps name="Test1" label="Test1" />
      <q-tab no-caps name="r2" label="Резерв2" />
      <q-tab no-caps name="r3" label="Резерв3" />
    </q-tabs>
  </q-toolbar>
    <component :is="tagComponents[isComponent]" />
</template>