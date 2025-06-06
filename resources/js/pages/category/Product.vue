<script setup lang="ts">
import type { Product } from '@/types/product'

interface Props {
  product: Product
  width?: string
  height?: string
  widthList?: string
  heightList?: string
}
const props = withDefaults(defineProps<Props>(), {
  widthList: '300px',
  heightList: '415px'
})

const product = props.product
const image = props.product.picture_image[0] as string

</script>

<template>
  <q-list 
    :style="{ width: props.widthList, height: props.heightList }"
    bordered 
    class="cursor-pointer"
  >
    <q-item>
      <q-item-section class="image-wrapper">
        <q-img 
          :src="image" 
          :width="props.width" 
          :height="props.height"
          class="zoom-image"
        />
      </q-item-section>
    </q-item>
    <q-item clickable dense v-ripple>
      <q-item-section>
        {{ product.title }}
      </q-item-section>
    </q-item>
  </q-list>
</template>

<style lang="sass" scoped>
.image-wrapper 
  // width: 300px
  // height: 200px
  overflow: hidden
  // border-radius: 8px
  position: relative

.zoom-image
  width: 100%
  height: 100%
  object-fit: cover
  transition: transform 0.5s ease

.zoom-image:hover
  transform: scale(1.5)
</style>