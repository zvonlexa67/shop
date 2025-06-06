<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'
import { InputString, InputNumber } from '@/components/form/input'
import { Btn } from '@/components/form/button'
import type { Dimension } from '@/types'
import { Warning } from '@/components/notify'
import { useQuasar } from 'quasar'

interface Props {
    dimension: Dimension;
}

interface ScriptFormData extends Dimension {
    _method: string;
}

type FormDataType = ScriptFormData & Record<string, any>

const $q = useQuasar()

const props = defineProps<Props>()

const form = useForm<FormDataType>({
    id: props.dimension.id,
    sort: props.dimension.sort,
    title: props.dimension.title,
    _method: 'POST'
})

const onSave = () => {
    form._method = 'PUT'
    form.post(route('dashboard.dimension.update', { dimension: props.dimension.id }))
}

const onReset = () => {
    form.id = props.dimension.id
    form.sort = props.dimension.sort
    form.title = props.dimension.title
    form._method = 'POST'
}

const onDestroy = () => {
    $q.dialog({
        title: 'Удаление',
        message: 'Внимание!!! после удаления данные не подлежат востановлении, продолжить удаление...',
        cancel: true,
        persistent: true
    }).onOk(() => {
        form._method = 'DELETE'
        form.delete(route('dashboard.dimension.destroy', { dimension: props.dimension.id }))
    }).onCancel(() => {
        Warning('Удаление отменено')
    })
}
</script>

<template>
    <q-card flat bordered square class="bg-mutan width-60">
        <q-card-section class="q-pa-none">
            <q-list>
                <q-item>
                    <q-item-section class="col-2 justify-center">
                        <input-number readonly label="Id" class="q-pb-none" v-model="form.id" :error_message="form.errors.id" :error="!!form.errors.id" />
                    </q-item-section>
                    <q-item-section class="col-2 justify-center">
                        <input-number label="Сортировка" class="q-pb-none" v-model="form.sort" :error_message="form.errors.sort" :error="!!form.errors.sort" />
                    </q-item-section>
                    <q-item-section class="col-3 justify-center">
                        <input-string label="Наименование" class="q-pb-none" v-model="form.title" :error_message="form.errors.title" :error="!!form.errors.title" />
                    </q-item-section>
                    <q-item-section class="col-5 justify-center" style="flex-direction: row">
                        <btn label="Сохранить" color="gries" @click="onSave"/>
                        <btn label="Отменить" color="gries" @click="onReset"/>
                        <btn label="Удалить" color="dbrem" @click="onDestroy"/>
                    </q-item-section>
                </q-item>
            </q-list>
        </q-card-section>
    </q-card>
</template>

