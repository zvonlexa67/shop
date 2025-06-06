<script setup lang="ts">
import DashboardLayout from '@/layouts/DashboardLayout.vue'
import List from './List.vue'

import Edit from './Edit.vue'

import Create from './Create.vue'

import { ref, provide, onMounted, onUpdated, toRef } from 'vue'
import type { QTableProps } from 'quasar'
import { SeparatorVertical } from 'lucide-vue-next'
import { Errors } from '@/composables/useErrors'
import { useForm, router } from '@inertiajs/vue3'
import type { Category, Characteristic, KeySessionStoreType } from '@/types'
import { InputString } from '@/components/form/input'

interface Props {
  category: Category | null,
	categories?: Category[],
  characteristics?: Characteristic,
}

interface StrictFormData extends Category {
  _method: string
  picture_file_image: File | null
  picture_file_icon: File | null
}

type FormDataType = StrictFormData & Record<string, any>
type ComponentKey = 'Edit' | 'Create'

const props = defineProps<Props>()
const tagComponents = { Edit, Create }

const isComponent = ref<ComponentKey>('Create')

const form = useForm<FormDataType>({
  id: 0,
  sort: 100,
  title: '',
  slug: '',
	parent_id: 1,
  picture_image: '',
  picture_icon: '',
  picture_file_image: null,
  picture_file_icon: null,
  _method: 'POST',
})

const splitterModel = ref(20)
const filterTree = ref('')
const char = toRef(props.characteristics)
const cats = toRef(props.categories)
const cat = toRef(props.category)
const selected = ref<number | null>(null)
const selChar = ref<number | null>(null)

const resetForm = () => {
  form.id = 0
  form.sort = 100
  form.title = ''
  form.slug = ''
  form.parent_id = 1
  form.picture_image = ''
  form.picture_icon = ''
  form.picture_file_image = null
  form.picture_file_icon = null
  form._method = 'POST'
}

const applayForm = () => {
  if (props.category) {
    form.id = props.category.id
    form.sort = props.category.sort
    form.title = props.category.title
    form.slug = props.category.slug
    form.picture_image = props.category.picture_image
    form.picture_icon = props.category.picture_icon
    form.picture_file_image = null
    form.picture_file_icon = null
  }

  form._method = 'PUT'
}

const onNodeSelected = (nodeId: number) => {
  nodeId ??= props.category?.id ?? 1

  router.get(route('dashboard.category.index', { id: nodeId ?? 1 }), {},
	{
    preserveState: true,
    preserveScroll: true,
    only: [ 'category' ],
    onSuccess: () => {
      cat.value = props.category
      form.errors = {}
      applayForm()
    }
  })
}

const onUpdate = () => {
  if (form.id > 1) {
    form.post(route('dashboard.category.update'),
    {
      preserveState: true,
      preserveScroll: true,
      only: ['errors', 'categories', 'category'],
      onSuccess: () => {
				cats.value = props.categories
        applayForm()
      }
    })
  }
}

const onCreate = () => {
    if (form.id === 0) {
      	form._method = 'POST'
      	form.post(route('dashboard.category.create'),
            {
          	    only: ['errors', 'categories', 'category'],
          	    onError: (errors) => Errors(errors),
          	    onSuccess: () => {
            	    cats.value = props.categories
            	    applayForm()
          	    },
            }
        )
    }
}

const loadCreate = () => {
    resetForm()
    form.parent_id = cat.value?.id!
    isComponent.value = 'Create'

}

const onDestroy = () => {
    form._method = 'DELETE'
    form.post(
      	route('dashboard.category.destroy', { id: props.category?.id }),
      	{
            preserveState: true,
        	preserveScroll: true,
        	only: [ 'errors', 'category', 'categories', 'characteristics' ],
        	onBefore: () => confirm('Внимание!!! после удаления данные не подлежат востановлении, продолжить удаление...'),
        	onSuccess: () => {
          		cats.value = props.categories
          		cat.value = props.category
          		selected.value = 1
                init()
        	}
    	}
	)
}

const onAttach = (characteristic_id: number | null) => {
	if (characteristic_id !== null) {
		router.visit(
			route('dashboard.category.attach', { category_id: props.category?.id, characteristic_id: characteristic_id }),
			{
				method: 'post',
				only: [ ' errors', 'category' ],
				preserveState: true,
				preserveScroll: true,
				onSuccess: () => {
					cat.value = props.category
					selChar.value = null
				}
			}
		)
	}
}

const onDetach = (selectedTable: QTableProps["selected"]) => {
    if (selectedTable?.length) {
        router.visit(
            route('dashboard.category.detach', { category_id: props.category?.id, characteristic_id: selectedTable[0].id }),
            {
                method: 'post',
                only: [ ' errors', 'category' ],
                preserveState: true,
                preserveScroll: true,
                onSuccess: () => {
					cat.value = props.category
					selChar.value = null
				}
            }
        )
    }
}

onMounted(() => init())

onUpdated(() => init())

const init = () => {
    isComponent.value = props.category ? 'Edit' : 'Create'

    switch(isComponent.value) {
        case 'Create':
            resetForm()
            selected.value = 1
            break
        case 'Edit':
            applayForm()
            selected.value = props.category?.id ?? null
            break
        default:
            applayForm()
            break
    }
}

provide('list', { cats, filterTree, selected, onNodeSelected})
provide('update', { form, cat, onUpdate, applayForm, onDestroy, loadCreate})
provide('attachdetach', { cat, char, selChar, onAttach, onDetach })
provide('create', { form, onCreate, loadCreate })
provide('smart', { cat })
provide('compare', { cat })

</script>

<template>
<DashboardLayout>
  <q-toolbar class="border-bottom-grey-light-0">
    <input-string v-model="filterTree" label="Категория" style="height: 40px;" :filled="false" >
      <template v-slot:append>
        <q-icon v-if="filterTree != ''" name="fa-solid fa-xmark" @click="filterTree = ''" class="cursor-pointer" />
      </template>
    </input-string>
  </q-toolbar>
  <q-splitter
    v-model="splitterModel"
    style="height: calc(100vh - 169px)"
    class="q-ml-md"
  >
    <template v-slot:before>
      <List />
    </template>
    <template v-slot:separator>
      <SeparatorVertical class="text-gries" />
    </template>
    <template v-slot:after>
      <q-card flat class="slide-card full-height">
        <q-card-section>
          <component :is="tagComponents[isComponent]" />
        </q-card-section>
      </q-card>
    </template>
  </q-splitter>
</DashboardLayout>
</template>

<style lang="sass" scoped>
.slide-card
	width: 100%
	background: none
	border-bottom: 1px solid #D6D5D1
	border-radius: inherit
</style>

