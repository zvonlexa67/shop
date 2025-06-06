<script setup lang="ts">
import RangeInt from '@/components/types/RangeInt.vue'
import RangeReal from '@/components/types/RangeReal.vue'
import Brand from '@/components/types/Brand.vue'

import Dimension from '@/components/types/Dimension.vue'

import { ColorType, StringType, BooleanType, NumberType, RangeType } from './InputTypes'

import { ref } from 'vue'

import type { FirstLastType } from '@/types/product'

interface Props {
	type: number
  title: string
  description?: string
}

type ComponentKey = 
	'StringType' | 
	'BooleanType' |
  'NumberType' |
  'RangeType' |
  'RangeInt' |
  'RangeReal' |
  'Brand' |
  'ColorType' |
  'Dimension'

type TypesType = { 
  key: number
  value: ComponentKey
}

const tagComponents = { 
  StringType,
  BooleanType,
  NumberType,
  RangeType,
  RangeInt,
  RangeReal,
  Brand,
  ColorType,
  Dimension,
}

const isComponent = ref<ComponentKey>('StringType')

const Types: TypesType[] = [
  { key: 1, value: 'StringType' },
  { key: 2, value: 'BooleanType' },
  { key: 3, value: 'NumberType' },
  { key: 4, value: 'RangeType' },
  { key: 5, value: 'RangeInt' },
  { key: 6, value: 'RangeReal' },
  { key: 7, value: 'Brand' },
  { key: 8, value: 'ColorType' },
  { key: 9, value: 'Dimension' },
]

const props = defineProps<Props>()
const first = defineModel<FirstLastType>('first')
const last = defineModel<FirstLastType>('last')

const init = (idType: number) => {
  for (let i = 0; i < Types.length; i++) {
    if (Types[i].key == idType) {
      return Types[i].value
    }
  }

  throw new Error('Type number not found')
}

isComponent.value = init(props.type)

</script>

<template>
  <component 
    :is="tagComponents[isComponent]"
    :title="props.title"
    :description="props.description"
    v-model:first="first"
    v-model:last="last"
  />
</template>
