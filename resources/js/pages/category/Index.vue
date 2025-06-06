<script setup lang="ts">
import CommonLayout from '@/layouts/CommonLayout.vue'
import SiteLayout from '@/layouts/SiteLayout.vue'
// import Category from './Category.vue'
import Products from './Products.vue'
import { provide } from 'vue'

import type { Product } from '@/types/product'


interface Props {
  categories: any
  list_categories: any
  breadcrumbs: any
  products: Product[]
}

const props = defineProps<Props>()

  console.log(props.products)


  // const list_categories = props.list_categories
  // const breadcrumbs = props.breadcrumbs
  // const products = props.products

  // provide('category', { list_categories, breadcrumbs })
  // provide('product', { products })

  // console.log(props.products)

</script>

<template>
  <site-layout>
    <!-- <Category /> -->
    <products :products="props.products"/>
  </site-layout>
</template>

