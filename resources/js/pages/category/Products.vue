<script setup lang="ts">
// import { inject, ref } from 'vue'
import Product from './Product.vue'
import type { Product as ProductType } from '@/types/product'

interface Props {
  products: ProductType[]
}

const props = defineProps<Props>()

  // const { products } = inject('product')

  // const lastX = ref(0)
  // const sensitivity = ref(150) // Чем меньше значение, тем чувствительнее
  // const slide = ref(0)
  // const images = ref(products[1].picture_image) 


  // console.log(images.value)

  
  // const handleMouseMove = (event) => {
  //   const currentX = event.clientX
  //   const deltaX = currentX - lastX.value
      
  //   if (Math.abs(deltaX) > sensitivity.value) {
  //     if (deltaX > 0) {
  //       // Движение вправо - следующий слайд
  //       slide.value = (slide.value + 1) % images.value.length
  //     } else {
  //       // Движение влево - предыдущий слайд
  //       slide.value = (slide.value - 1 + images.value.length) % images.value.length
  //     }

  //     lastX.value = currentX
  //   }
  // }
</script>

<template>
  <!-- <h1>Products</h1>
  {{ products }}

  <template v-for="product in products">
    <product :product="product"/>
  </template> -->

  <!-- <q-card style="margin-left: 300px; margin-top: 50px; height: calc(-152px + 100vh); max-width: calc(-300px + 100vw);"> -->
  <q-card flat>
    <q-card-actions>
      <product :product="product" v-for="product in products" />
    </q-card-actions>
  </q-card>
  

  <!-- {{ products.picture_image }} -->

  <!-- <q-carousel
  //   v-model="slide"
  //   transition-prev="scale"
  //   transition-next="scale"
  //   animated
  //   navigation
  //   infinite
  //   height="400px"
  //   @mousemove="handleMouseMove"
  // >
  // <q-carousel
  //   v-model="slide"
  //   animated
  //   arrows
  //   infinite
  //   height="400px"
  //   @mousemove="handleMouseMove"
  // > 
  //   <q-carousel-slide
  //     v-for="(image, index) in images"
  //     :key="index"
  //     :name="index"
  //     :img-src="image"
  //   /> 
  // </q-carousel> -->

</template>

