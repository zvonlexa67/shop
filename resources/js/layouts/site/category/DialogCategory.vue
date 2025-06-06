<script setup lang="ts">
import { router } from '@inertiajs/core';
import type { Category } from '@/types'

interface Props {
  categories: Category[]
}

const props = defineProps<Props>()

const toCategory = (slug: string) => {
  router.visit(route('category', { slug: slug }), { method: 'get' })
  // console.log(slug)
}

</script>

<template>
  <q-card-actions align="left" class="items-start">
    <q-list v-for="category in props.categories" :key="category.id"
      style="width: 450px; text-align: left; margin-left: 0; margin-right: 70px;" 
    >
      <q-item clickable dense v-ripple style="font-size: large;" @click="toCategory(category.slug)">
        <q-item-section avatar>
          <q-icon v-if="category.picture_icon" :name="'img:' + category.picture_icon" />
        </q-item-section>
        <q-item-section>
          {{ category.title }}
        </q-item-section>
          <q-item-section side>
            123
          </q-item-section>
      </q-item>
      <q-item style="font-size: small;">  
        <q-item-section>
          <q-list v-for="children in category.children" :key="children.id" class="q-ml-sm">
            <q-item clickable dense v-ripple  @click="toCategory(children.slug)">
              <q-item-section avatar>
                <q-icon v-if="children.picture_icon" :name="'img:' + children.picture_icon" />
              </q-item-section>
              <q-item-section>
                  {{ children.title }}
              </q-item-section>
              <q-item-section side>
                15
              </q-item-section>
            </q-item>
          </q-list>
        </q-item-section>
      </q-item>
    </q-list>
  </q-card-actions>
</template>