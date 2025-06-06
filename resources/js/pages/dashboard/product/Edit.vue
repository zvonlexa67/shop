<script setup lang="ts">
import { ref, inject, onMounted, onUpdated, watch } from 'vue'
import Product from './Update.vue'
import Images from './Images.vue'
import Characteristics from './Characteristics.vue'
import Category from './Category.vue'
import Description from './Description.vue'
import Price from './Price.vue'
import Accounting from './Accounting.vue'
import { ScrollArea } from '@/components/design'
import { WSSR } from '@/composables/useSessionStore'
import type { KeySessionStoreType } from '@/types'

type ComponentType = 'Product' | 'Images' | 'Category' | 'Characteristics' | 'Description' | 'Price' | 'Accounting'

interface InjectEdit {
	form: any
}

const injected = inject<InjectEdit>('edit')

if (!injected) {
	throw new Error('Injection "edit" not found')
}

const { form } = injected

interface ActiveBtnSideBar {
    ActiveNavRoute: any
    NameNavRoute: any
}

const injectedA = inject<ActiveBtnSideBar>('activeBtnSideBar')

if (!injectedA) {
    throw new Error('Injection "activeBtnSideBar" not found')
}

const { ActiveNavRoute, NameNavRoute } = injectedA

NameNavRoute.value = 'Товар "' + form.title + '"'

const keyProductisComponent = ref<KeySessionStoreType>('keyProductisComponent')
const isComponent = ref<ComponentType>(WSSR.has(keyProductisComponent) ? WSSR.load(keyProductisComponent) : 'Product')
const tagComponent = { Product, Images, Category, Characteristics, Description, Price, Accounting }

watch(isComponent, (newVal: ComponentType) => {
  WSSR.write(keyProductisComponent, newVal)
})

onMounted(() => {
  // isComponent.value = WSSR.has(keyProductisComponent) ? WSSR.load(keyProductisComponent) : 'Table'
  // console.log('edit onMounted')
})

onUpdated(() => {
  // console.log('edit onUpdated')
})
</script>

<template>
  <q-card class="bg-mutan" square bordered>
      <q-card-section class="q-pa-none">
        <q-toolbar class="bg-mutan text-gries border-bottom-grey-light-0">
          <q-tabs
            v-model="isComponent"
            dense
            active-color="gries"
          >
            <q-tab no-caps name="Product" label="Товар" />
            <q-tab no-caps name="Images" label="Картинки" />
            <q-tab no-caps name="Category" label="Категории" />
            <q-tab no-caps name="Description" label="Описание" />
            <q-tab no-caps name="Characteristics" label="Характеристики" />
            <q-tab no-caps name="Price" label="Цены" />
            <q-tab no-caps name="Accounting" label="Учет" />

          </q-tabs>
        </q-toolbar>
      </q-card-section>
      <q-card-section class="q-pa-none">
        <component :is="tagComponent[isComponent]" />
      </q-card-section>
  </q-card>
</template>
