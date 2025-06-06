<script setup lang="ts">
import { ScrollArea } from '@/components/design'
import { Btn } from '@/components/form/button'
import { Boolean } from '@/components/form'
// import Fields from './Fields.vue'
import { inject, ref } from 'vue'
import { ColorType, StringType, BooleanType, NumberType, RangeType } from './InputTypes'
import type { Product, Character, Char } from '@/types/product'

type ComponentKey = 'ColorType' | 'StringType' | 'BooleanType' | 'NumberType' | 'RangeType'

interface InjectCharacteristics {
  form: any
	product: Product
	characteristics: Char[]
	storeCharacteristics: () => void
}

const injected = inject<InjectCharacteristics>('characteristics')

if (!injected) {
	throw new Error('Injection "characteristics" not found')
}

const tagComponent = { 
  ColorType, 
  StringType, 
  BooleanType, 
  NumberType, 
  RangeType 
}

const { form, product, characteristics, storeCharacteristics } = injected

// console.log(characteristics)

const types = {
  '1': 'StringType',
  '2': 'BooleanType',
  '3': 'NumberType',
  '4': 'RangeType',
  '5': 'RangeInt',
  '6': 'RangeReal',
  '7': 'Brand',
  '8': 'ColorType',
  '9': 'Dimension',
}

const compress = ref<boolean>(false)
</script>

<template>
<div class="row justify-center">
  <q-list class="width-50">
    <q-item>
      <q-item-section>
        <scroll-area style="height: calc(100vh - 240px);" class="border-ccc-0">
          <q-list separator>
            <q-item>
              <q-item-section>
                <q-expansion-item
                  v-for="characteristic in form.characteristics"
                  switch-toggle-side 
                  dense-toggle 
                  :label="characteristic.title"
                  :header-inset-level="0"
                  :content-inset-level="1"
                  class="q-mb-lg text-gries"
                  default-opened
                >
                  <q-list bordered class="rounded-borders">
                    <q-item v-for="children in characteristic.children">
                      <q-item-section v-if="children.type == '1' || children.type == '2' || children.type == '3' || children.type == '4' || children.type == '8'">
                        <component 
                          :is="tagComponent[types[children.type as keyof typeof types] as ComponentKey]"
                          :char="children" 
                          v-model:first="children.first" 
                          v-model:last="children.last"
                        />
                      </q-item-section>
                      <q-item-section v-else>
                        {{ children.title }} - {{ types[children.type as keyof typeof types] }}
                      </q-item-section>
                    </q-item>
                  </q-list>
                </q-expansion-item>
              </q-item-section>
            </q-item>
          </q-list>
        </scroll-area>
      </q-item-section>
    </q-item>
        <q-item>
      <q-item-section>
        <btn label="Сохранить" @click="storeCharacteristics"/>
      </q-item-section>
      <!-- <q-item-section class="text-center">
        <boolean label="Сжать" v-model="compress"/>
      </q-item-section> -->
    </q-item>
  </q-list>
</div>
</template>
