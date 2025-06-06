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

</script>

<template>
  <site-layout>
    <!-- <Category /> -->
    <products :products="props.products"/>
  </site-layout>
</template>

