<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import { ref } from 'vue'
import type { Category } from '@/types'
import DialogCategory from './DialogCategory.vue'

interface Props {
  categories: Category[]
  width?: number
}

const props = withDefaults(defineProps<Props>(), {
  width: 300
})

const catalogDialog = ref<boolean>(false)

const list_categories = props.categories[0].children

const dialog_categories = ref<Category[]>([])

let timeoutOpen: any = null
let timeoutClose: any = null

const loadChildren = (id: number) => {
  for (let i=0; i<list_categories.length; i++) {
    if (list_categories[i].id === id) {
      dialog_categories.value = list_categories[i].children
      break
    }
  }

  openDialog()
}

const openDialog = () => {
  clearTimeout(timeoutClose)
  timeoutOpen = setTimeout(() => { catalogDialog.value = true }, 500)
}

const closeDialog = () => {
  clearTimeout(timeoutOpen)
  timeoutClose = setTimeout(() => { catalogDialog.value = false }, 500)
}

const fixDialog = () => {
  clearTimeout(timeoutClose)
}
</script>

<template>
  <q-list>
    <template v-for="category in list_categories" :key="category.id">
      <Link :href="'/category/' + category.slug">
        <q-item clickable dense v-ripple @mouseenter="loadChildren(category.id)" @mouseleave="closeDialog">
          <q-item-section avatar>
            <q-icon v-if="category.picture_icon" :name="'img:' + category.picture_icon" />
          </q-item-section>
          <q-item-section>
            {{ category.title }}
          </q-item-section>
          <q-item-section side>
            <q-icon name="fa-solid fa-chevron-right" size="16px"/>
          </q-item-section>
        </q-item>
      </Link>
    </template>
  </q-list>

  <q-dialog v-model="catalogDialog" seamless position="left">
    <q-card 
      style="margin-left: 300px; margin-top: 50px; height: calc(-152px + 100vh); max-width: calc(-300px + 100vw);"
      @mouseenter="fixDialog" 
      @mouseleave="closeDialog"
    >
    <dialog-category :categories="dialog_categories" />
    </q-card>
	</q-dialog>
</template>