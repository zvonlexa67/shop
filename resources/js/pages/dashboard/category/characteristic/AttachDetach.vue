<script setup lang=ts>
import { router } from '@inertiajs/vue3'
import { ref, inject } from 'vue'
import type { Characteristic } from '@/types'
import type { QTableProps } from 'quasar'
import { SeparatorVertical } from 'lucide-vue-next'

interface InjectAttachDetach {
    cat: any
    char: any
	selChar: any
    onAttach: (characteristic_id: number | null) => void
    onDetach: (characteristic?: QTableProps["selected"]) => void
}

const tree = ref()
const tableRef = ref()

const pagination = ref({ rowsPerPage: 0 })

const widthSplitter = ref<number>(30)
const filterTree = ref<string>('')
const filter = ref<string>('')

const selectedTable = ref<QTableProps["selected"]>([])

const injected = inject<InjectAttachDetach>('attachdetach')

if (!injected) {
	throw new Error('Injection "attachdetach" not found')
}

const { cat, char, selChar, onAttach, onDetach } = injected

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
		label: 'Наименование',
		name: 'title',
		field: 'title',
		align: 'center',
		headerStyle: 'font-weight: 505; font-size: 12px;',
		sortable: true,
    },
    {
		label: 'Фильтр',
		name: 'smart',
		field: 'smart',
		align: 'center',
		format: (val: boolean) => val ? '☑' : '☐',
		headerStyle: 'font-weight: 505; font-size: 12px;',
		sortable: true,
    },
])

const onNodeSelected = (nodeId: number) => {
    tree.value.getNodeByKey(nodeId)
}

const onDblClick = (evt: any, row: Characteristic, index: number) => {
    router.get(route('dashboard.characteristic.index', { characteristic_id: row.id }))
}
</script>

<template>
<q-toolbar class="border-bottom-grey-light-0">
    <q-input
		dense
		v-model="filterTree"
		label="Характеристика"
		label-color="gries"
		color="gries"
		style="height: 40px;"
    >
      	<template v-slot:append>
        	<q-icon v-if="filterTree != ''" name="fa-solid fa-xmark" @click="filterTree = ''" class="cursor-pointer" />
      	</template>
    </q-input>
</q-toolbar>
<q-splitter v-model="widthSplitter" style="height: calc(100vh - 560px)">
    <template v-slot:before>
		<q-tree
			ref="tree"
			icon="fa-solid fa-chevron-right"
			:nodes="char"
			node-key="id"
			label-key="title"
			text-color="gries"
			class="q-size-font-tree"
			selected-color="lblue"
			:filter="filterTree"
			v-model:selected="selChar"
			@update:selected="onNodeSelected"
			default-expand-all
		/>
    </template>
    <template v-slot:separator>
      	<SeparatorVertical />
    </template>
    <template v-slot:after class="no-scroll">
      	<q-table
			flat
			dense
			virtual-scroll
			ref="tableRef"
			:rows="cat === null ? [] : cat.characteristics ?? []"
			:columns="columns"
			row-key="id"
			rows-per-page-label="Записей на странице"
			selection="single"
			:filter="filter"
			style="height: calc(100vh - 560px)"
			v-model:selected="selectedTable"
			@row-dblclick="onDblClick"
			class="text-gries bg-mutan q-ml-md"
			v-model:pagination="pagination"
	    >
			<template v-slot:top-right>
				<q-input
					dense
					label-color="gries"
					color="gries"
					style="height: 40px; width: 250px;"
					v-model="filter"
					label="Поиск"
				>
					<template v-slot:append>
						<q-icon v-if="filter != ''" name="fa-solid fa-xmark" @click="filter = ''" class="cursor-pointer" />
					</template>
				</q-input>
			</template>
			<template v-slot:top-left>
				<q-btn flat no-caps :disable="!selChar" label="Добавить" @click.stop.prevent="onAttach(selChar)" />
				<q-btn flat no-caps :disable="!selectedTable?.length" label="Удалить" @click.stop.prevent="onDetach(selectedTable); selectedTable=[]"/>
			</template>
      	</q-table>
    </template>
</q-splitter>
</template>

<style lang="sass" scoped>
.q-size-font-tree
    font-size: small
</style>
