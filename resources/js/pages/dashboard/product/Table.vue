<script setup lang="ts">
import { ref, inject } from 'vue'
import type { QTableProps } from 'quasar'
import type { Product } from '@/types/product'
import { Btn } from '@/components/form/button'


// import { ref, inject, onUpdated } from 'vue'

// defineOptions({
//   name: 'Table'
// })

// interface Column {
//     label: string
//     name: string
//     field: string | ((row: any) => any)
//     align?: 'left' | 'right' | 'center'
// 	format?: (val: any) => any
//     headerStyle?: string
//     sortable?: boolean
// }

// type ColumnType = QTableProps["columns"]

interface InjectTable {
  category: any
	isComponent: 'Table' | 'Edit' | 'UpSert'
	reloadProduct: (state: boolean, product_id?: number) => void
	destroyProduct: (product_id: number) => void
}

const injected = inject<InjectTable>('table')

if (!injected) {
	throw new Error('injection "table" not found')
}

const { category, reloadProduct, isComponent, destroyProduct } = injected

const tableRef = ref()
// const selected = ref<QTableProps["selected"][]>([])
const selected = ref<Product[]>([])
const filter = ref('')
const pagination = ref({ rowsPerPage: 0 })

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
        label: 'Активность',
        name: 'active',
        field: 'active',
        align: 'center',
        format: val => val ? '☑' : '☐',
        headerStyle: 'font-weight: 505; font-size: 12px;',
        sortable: true,
      },
    {
      label: 'Сортировка',
      name: 'sort',
      field: 'sort',
      align: 'center',
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
      sortable: true,
    },
    {
      label: 'Цена',
      name: 'price',
      field: 'price',
      align: 'center',
      headerStyle: 'font-weight: 505; font-size: 12px;',
      sortable: true,
    },
  ])
  
const dblClick: QTableProps["onRowDblclick"] = (evt, row, index) => {
// const dblClick = <QTableProps["onRowDblclick"]>(evt: Event, row: Product, index: number) => {
  reloadProduct(false, row.id)
}
  // const onDelete = () => {
    // destroyProduct(selected.value[0].id)
    // console.log('onDelete')
  // }

</script>

<template>
  <q-table
    flat
    dense
    ref="tableRef"
    :rows="category?.products ?? []"
    :columns="columns"
    row-key="id"
    rows-per-page-label="Записей на странице"
    selection="single"
    :filter="filter"
    v-model:selected="selected"
    @row-dblclick="dblClick"
    class="text-gries bg-mutan q-ml-md"
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
      <btn :disable="!!selected?.length" label="Создать" @click="isComponent = 'UpSert'" /> 
      <btn :disable="!selected?.length" label="Изменить" @click="reloadProduct(false, selected[0].id)" /> 
      <btn color="dbrem" :disable="!selected?.length" label="Удалить" @click="destroyProduct(selected[0].id)"/>
      <!-- <q-btn flat no-caps :disable="!!selected?.length" label="Создать" @click.stop.prevent="isComponent = 'Edit'" /> 
      <q-btn flat no-caps :disable="!selected?.length" label="Изменить" @click.stop.prevent="reloadProduct(false, selected[0].id)" /> 
      <q-btn flat no-caps color="dbrem" :disable="!selected?.length" label="Удалить" @click.stop.prevent="destroyProduct(selected[0].id)"/> -->
    </template>
  </q-table>
</template>
