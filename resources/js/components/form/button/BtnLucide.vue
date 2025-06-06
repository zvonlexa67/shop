<!-- <script setup lang="ts">
import { computed } from 'vue';
import * as icons from "lucide-vue-next";

const props = defineProps<{
  class?: string,
  svg: string,
  width?: string,
  size?: number,
  align?: 'left' | 'right' | 'center' | 'around' | 'between' | 'evenly'
}>()

const emit = defineEmits<{
  (e: 'onClick'): void
}>()

const onClick = () => {
  emit('onClick')
}


const svg = computed(() => icons[props.svg as keyof typeof icons])
</script>

<template>
<!-- <q-btn flat square :align="props.align" :class="props.class" no-caps @click.stop.prevent="onClick"> -->
<!-- <q-btn 
  flat 
  square 
  :align="props.align" 
  :class="props.class" 
  no-caps 
  @click="onClick"
>
  <component :is="svg" :absolute-stroke-width="true" :stroke-width="width" :size="size"/>
  <slot />
</q-btn>
</template> -->


<script setup lang="ts">
import { computed, type Component } from 'vue'
import * as icons from "lucide-vue-next"
import type { LucideProps } from 'lucide-vue-next'
import { type FunctionalComponent } from 'vue'

const props = defineProps<{
  class?: string
  svg: keyof typeof icons
  width?: string
  size?: number
  align?: 'left' | 'right' | 'center' | 'around' | 'between' | 'evenly'
}>()

const emit = defineEmits<{
  (e: 'click'): void
}>()

const onClick = () => {
  emit('click')
}

// const iconComponent = computed<Component<LucideProps>>(() => {
//   return icons[props.svg]
// })

type LucideIcon = FunctionalComponent<LucideProps>
type LucideIcons = Record<string, LucideIcon>

const lucideIcons = icons as unknown as LucideIcons

const iconComponent = computed<LucideIcon | null>(() => {
  return lucideIcons[props.svg] || null
})
</script>

<template>
  <q-btn 
    flat 
    square 
    :align="props.align" 
    :class="props.class" 
    no-caps 
    @click="onClick"
  >
    <component 
      :is="iconComponent" 
      :absolute-stroke-width="true" 
      :stroke-width="props.width" 
      :size="props.size"
    />
    <slot />
  </q-btn>
</template>