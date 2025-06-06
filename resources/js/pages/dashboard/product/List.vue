<script setup lang="ts">
import { ref, inject } from 'vue'
import type { QTableProps } from 'quasar'
import type { Product } from '@/types/product'

interface ListInject{
  products: Product[]
  isComponent: any
  loadProduct: (id: number) => void
}

const injected = inject<ListInject>('list', {
  products: [],
  isComponent: undefined,
  loadProduct: (id: number) => {},
})

if (!injected) {
  throw new Error('Injection "list" not found')
}

const { products, isComponent, loadProduct } = injected 

const filter = ref<string>()
const selected = ref<Product[]>([])
const pagination = ref<QTableProps["pagination"]>({ rowsPerPage: 0 })
const columns = ref<QTableProps["columns"]>([
  {
  label: 'Id',
    name: 'id',
    field: 'id',
    align: 'center',
    headerStyle: 'font-weight: 505; font-size: 12px;',
    sortable: true,
  },
  {
    label: 'Сорт',
    name: 'sort',
    field: 'sort',
    align: 'center',
    headerStyle: 'font-weight: 505; font-size: 12px;',
    sortable: true,
  },
  {
		label: 'Активный',
		name: 'active',
		field: 'active',
		align: 'center',
		format: (val: boolean) => val ? '☑' : '☐',
		headerStyle: 'font-weight: 505; font-size: 12px;',
		sortable: true,
  },
  {
    label: 'Наименование',
    name: 'title',
    field: 'title',
    align: 'center',
    headerStyle: 'font-weight: 505; font-size: 12px;',
    sortable: true,
  },
  {
    label: 'Слаг',
    name: 'slug',
    field: 'slug',
    align: 'center',
    headerStyle: 'font-weight: 505; font-size: 12px;',
    // sortable: true,
  },
  // {
  //     label: 'Проверка',
  //     name: 'email_verified_at',
  //     field: 'email_verified_at',
  //     align: 'center',
  //     headerStyle: 'font-weight: 505; font-size: 12px;',
  //     sortable: true,
  // },
  {
      label: 'Создан',
      name: 'createdAt',
      field: 'created_at',
      align: 'center',
      headerStyle: 'font-weight: 505; font-size: 12px;',
      sortable: true,
  },
  {
      label: 'Изменен',
      name: 'updateAt',
      field: 'updated_at',
      align: 'center',
      headerStyle: 'font-weight: 505; font-size: 12px;',
      sortable: true,
  },
])

const onCreate = () => {
  isComponent.value = 'Create'
}

const onUpdate = () => {
  loadProduct(selected.value?.[0].id)
}

const onDblUpdate = (evt:Event, row:Product, index:number) => {
  loadProduct(row.id)
}

const onDelete = () => {
  console.log('onDelete')
}
</script>

<template>
  <q-table
		flat
		dense
		bordered
		virtual-scroll
		style="height: calc(100vh - 120px)"
		ref="tableRef"
		:rows="products"
		:columns="columns"
		row-key="id"
		rows-per-page-label="Записей на странице"
		selection="single"
		:filter="filter"
		v-model:selected="selected"
    @row-dblclick="onDblUpdate"
		class="text-gries bg-mutan text-gries"
		v-model:pagination="pagination"
	>
    <template v-slot:top-right>
    	<q-input borderless dense debounce="300" v-model="filter" placeholder="Поиск">
        <template v-slot:append>
          <q-icon name="fa-solid fa-magnifying-glass" />
        </template>
      </q-input>
    </template>
    <template v-slot:top-left>
      <q-btn flat no-caps :disable="!!selected.length" label="Создать" @click.stop.prevent="onCreate" />
      <q-btn flat no-caps :disable="!selected.length" label="Изменить" @click.stop.prevent="onUpdate" />
      <q-btn flat no-caps color="dbrem" :disable="!selected.length" label="Удалить" @click.stop.prevent="onDelete" />
    </template>
  </q-table>
</template>