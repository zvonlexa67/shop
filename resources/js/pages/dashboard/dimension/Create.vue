<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'
import { InputString, InputNumber } from '@/components/form/input'
import { Btn } from '@/components/form/button'
import type { Dimension } from '@/types'
import { Errors } from '@/composables/useErrors'

interface ScriptFormData extends Dimension {
    _method: string;
}

type FormDataType = ScriptFormData & Record<string, any>

const form = useForm<FormDataType>({
    id: 0,
    sort: 100,
    title: '',
    _method: 'POST'
})

const onSave = () => {
    form._method = 'POST'
    form.post(route('dashboard.dimension.store'),
    {
        preserveState: true,
        preserveScroll: true,
        only: [ 'errors', 'colors' ],
        onError: (errors) => Errors(errors),
        onSuccess: () => onReset()
    })
}

const onReset = () => {
    form.id = 0
    form.sort = 100
    form.title = ''
    form._method = 'POST'
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
                        <btn label="Добавить" color="gries" @click="onSave"/>
                        <btn label="Отменить" color="gries" @click="onReset"/>
                    </q-item-section>
                </q-item>
            </q-list>
        </q-card-section>
  </q-card>
</template>
