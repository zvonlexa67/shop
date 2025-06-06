<script setup lang="ts">
import { inject, toRef, ref, watch } from 'vue'

interface CategoryInject {
  form: any
  categories: any
  syncCategories: () => void
}

const injected = inject<CategoryInject>('category')

if(!injected) {
  throw new Error('Injection "category" not found')
}

const { form, categories, syncCategories } = injected

watch(() => form.categories, (newVal, oldVal) => {
  if (JSON.stringify(newVal) !== JSON.stringify(oldVal)) {
    syncCategories()
  }
})

</script>

<template>
  <div class="row justify-center q-ma-lg">
    <q-list bordered separator>
    <!-- <q-list class="width-50" bordered separator> -->
      	<q-item>
        	<q-item-section>
            <q-tree
              ref="treeRef"
              icon="fa-solid fa-chevron-right"
              :nodes="categories"
              node-key="id"
              label-key="title"
              text-color="gries"
              class="q-size-font-tree"
              selected-color="lblue"
              default-expand-all
              v-model:ticked="form.categories"
              tick-strategy="strict"
              />
        	</q-item-section>
      	</q-item>
      </q-list>
  </div>
</template>
