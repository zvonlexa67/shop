<script setup lang="ts">
import { ref, inject } from 'vue'
import type { QTableProps } from 'quasar'
import type { Product } from '@/types/product'
import { Btn } from '@/components/form/button'

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
  reloadProduct(false, row.id)
}

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
    </template>
  </q-table>
</template>
