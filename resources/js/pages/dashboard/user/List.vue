<script setup lang="ts">
import { inject, ref } from 'vue'

interface Columns {
    label: string
    name: string
    field: string | ((row: any) => any)
    align?: 'left' | 'right' | 'center'
    headerStyle?: string
    sortable?: boolean
}

interface List {
    rows: []
    toggleCreate: () => void
    toggleUpdate: (user_id: number) => void
    onDestroy: (user_id: number) => void
}

const injected = inject<List>('list')

if (!injected) {
    throw new Error('Injection "list" not found')
}

const { rows, toggleCreate, toggleUpdate, onDestroy } = injected

const tableRef = ref()
const selected = ref<any[]>([])
const filter = ref()
const pagination = ref({ rowsPerPage: 0 })

const columns = ref<Columns[]>([
    {
     	label: 'Id',
      	name: 'id',
      	field: 'id',
      	align: 'center',
      	headerStyle: 'font-weight: 505; font-size: 12px;',
      	sortable: true,
    },
    {
      	label: 'Имя',
      	name: 'name',
      	field: 'name',
      	align: 'center',
      	headerStyle: 'font-weight: 505; font-size: 12px;',
      	sortable: true,
    },
    {
      	label: 'Почта',
      	name: 'email',
      	field: 'email',
      	align: 'center',
      	headerStyle: 'font-weight: 505; font-size: 12px;',
      	sortable: true,
    },
    {
      	label: 'Проверка',
      	name: 'email_verified_at',
      	field: 'email_verified_at',
      	align: 'center',
      	headerStyle: 'font-weight: 505; font-size: 12px;',
      	sortable: true,
    },
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

const onDelete = (user_id: number) => {
    selected.value = []
    onDestroy(user_id)
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
		:rows="rows"
		:columns="columns"
		row-key="id"
		rows-per-page-label="Записей на странице"
		selection="single"
		:filter="filter"
		v-model:selected="selected"
		class="text-gries bg-mutan"
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
      <q-btn flat no-caps :disable="!!selected.length" label="Создать" @click.stop.prevent="toggleCreate" />
      <q-btn flat no-caps :disable="!selected.length" label="Изменить" @click.stop.prevent="toggleUpdate(selected[0].id)" />
      <q-btn flat no-caps color="dbrem" :disable="!selected.length" label="Удалить" @click.stop.prevent="onDelete(selected[0].id)" />
    </template>
  </q-table>
</template>


