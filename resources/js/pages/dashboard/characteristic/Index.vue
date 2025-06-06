<script setup lang="ts">
import DashboardLayout from '@/layouts/DashboardLayout.vue'
import { useForm, router } from '@inertiajs/vue3'
import { ref, onMounted, onUpdated, provide } from 'vue'
import Update from './Update.vue'
import CreateCharacteristic from './CreateCharacteristic.vue'
import CreateGroup from './CreateGroup.vue'
import type { TypeEnum, Characteristic } from '@/types'
import { Warning } from '@/components/notify'
import { useQuasar } from 'quasar'

interface Props {
    characteristics?: Characteristic[],
    characteristic: Characteristic | null,
    types: TypeEnum,
}

interface StrictFormData extends Characteristic {
    _method: string;
}

type FormDataType = StrictFormData & Record<string, any>
type ComponentKey = 'Update' | 'CreateGroup' | 'CreateCharacteristic'

const $q = useQuasar()

const props = defineProps<Props>()

const tagComponents = { Update, CreateGroup, CreateCharacteristic }
const isComponent = ref<ComponentKey>('Update')

const widthSplitter = ref(20)
const tree = ref(null)
const filterTree = ref('')
const selected = ref<number | null>(null)
const types = ref(props.types)

const form = useForm<FormDataType>({
    id: 0,
    sort: 100,
    title: '',
    smart: false,
    type: null,
    description: '',
    parent_id: null,
    _method: 'POST'
})

const onReset = () => {
    if (props.characteristic != undefined) {
        form.id = props.characteristic.id
        form.sort = props.characteristic.sort
        form.title = props.characteristic.title
        form.smart = props.characteristic.smart ?? false
        form.type = props.characteristic.type ?? null
        form.description = props.characteristic.description
        form.parent_id = props.characteristic.parent_id ?? null
        form._method = 'POST'
    } else {
        form.id = 0
        form.sort = 100
        form.title = ''
        form.smart = false
        form.type = null
        form.description = ''
        form.parent_id = null
        form._method = 'POST'
    }
}

const onNodeSelected = (nodeId: number) => {
    router.visit(
        route('dashboard.characteristic.index', { 'characteristic_id': nodeId ?? 0 }),
        {
            method: 'get',
            only: [ 'characteristic' ],
            preserveState: true,
            preserveScroll: true,
            onSuccess: () => isComponent.value = 'Update'
        }
    )
}

const onSave = () => {
    if (form.id != 0) {
        form._method = 'PUT'
        form.post(route('dashboard.characteristic.update'), {
            only: [ 'errors', 'characteristics', 'characteristic' ],
        })
    }
}

const onCreate = () => {
    if (form.id == 0) {
        form._method = 'POST'
        form.post(route('dashboard.characteristic.create'), {
            only: [ 'errors', 'characteristics', 'characteristic' ],
            onSuccess: () => {
            onReset()
            isComponent.value = 'Update'
            }
        })
    }
}

const onNewGroup = () => {
    form.id = 0
    form.sort = 100
    form.title = ''
    form.smart = false
    form.type = null
    form.description = ''
    form.parent_id = null
    form._method = 'POST'
    isComponent.value = 'CreateGroup'
}

const onNewCharacteristic = () => {
    if (props.characteristic == undefined) {
        Warning('Выберите группу для новой характеристики')
    } else {
        form.id = 0
        form.sort = 100
        form.title = ''
        form.smart = false
        form.type = null
        form.description = ''
        form.parent_id = props.characteristic.parent_id ?? props.characteristic.id
        form._method = 'POST'
        isComponent.value = 'CreateCharacteristic'
    }
}

const onDestroy = () => {
    $q.dialog({
        title: 'Удаление',
        message: 'Внимание!!! после удаления данные не подлежат востановлении, продолжить удаление...',
        cancel: true,
        persistent: true
    }).onOk(() => {
        form._method = 'DELETE'
        form.post(route('dashboard.characteristic.destroy', { characteristic_id: form.id }), {
            only: [ 'errors', 'characteristics', 'characteristic' ],
            onSuccess: () => onReset()
        })
    }).onCancel(() => {
        // console.log('>>>> Cancel')
    })
}

const onUpdate = () => {
    router.visit(
        route('dashboard.characteristic.index', {
            characteristic_id: props.characteristic == undefined ? 0 : props.characteristic.id }),
        {
            method: 'get',
            only: [ 'characteristic' ],
            preserveState: true,
            preserveScroll: true,
            onSuccess: () => isComponent.value = 'Update'
        }
    )
}

onMounted(() => {
    if (props.characteristic == null) {
        selected.value = 0
        onReset()
    } else {
        selected.value = props.characteristic.id
        onReset()
    }
})

onUpdated(() => {
    if (props.characteristic == null) {
        selected.value = 0
        onReset()
    } else {
        selected.value = props.characteristic.id
        onReset()
    }
})

provide('update', { form, types, onSave, onReset, onDestroy, onNewGroup, onNewCharacteristic })
provide('creategroup', { form, onCreate, onUpdate })
provide('createcharacteristic', { form, types, onCreate, onUpdate })

</script>

<template>
  <dashboard-layout>
    <q-toolbar class="border-bottom-grey-light-0">
      <q-input
        v-model="filterTree"
        label="Характеристика"
        label-color="gries"
        color="gries"
        style="height: 40px;"
        dense
      >
        <template v-slot:append>
          <q-icon v-if="filterTree != ''" name="fa-solid fa-xmark" @click="filterTree = ''" class="cursor-pointer" />
        </template>
      </q-input>
    </q-toolbar>
    <q-splitter v-model="widthSplitter" style="height: calc(100vh - 169px)" class="q-ml-md">
      <template v-slot:before>
        <q-tree
					ref="tree"
					icon="fa-solid fa-chevron-right"
					:nodes="props.characteristics ?? []"
					node-key="id"
					label-key="title"
					text-color="gries"
					class="text-font-size-small"
					selected-color="lblue"
					:filter="filterTree"
					v-model:selected="selected"
					@update:selected="onNodeSelected"
					default-expand-all
        />
      		</template>
      		<template v-slot:after>
        		<component :is="tagComponents[isComponent]" />
      		</template>
    	</q-splitter>
  	</dashboard-layout>
</template>

