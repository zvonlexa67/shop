<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'
import { InputString, InputNumber } from '@/components/form/input'
import { Btn } from '@/components/form/button'
import { FileImage } from '@/components/file'
import type { Slide } from '@/types'
import { useTemplateRef } from 'vue'
import { Errors } from '@/composables/useErrors'

interface ScriptFormData extends Slide {
    _method: string
    picture_file: File | null
}

type FormDataType = ScriptFormData & Record<string, any>
type FileImageType = InstanceType<typeof FileImage>

const refFI = useTemplateRef<FileImageType>('refFileImage')

const form = useForm<FormDataType>({
    id: 0,
    sort: 100,
    name: '',
    href: '',
    picture_file: null,
    _method: 'POST',
})

const onCreate = () => {
    form.post(route('dashboard.slides.store'), {
        preserveState: true,
        preserveScroll: true,
        only: [ 'errors', 'slides' ],
        onError: (errors) => Errors(errors),
        onFinish: () => onReset(),
    })
}

const onReset = () => {
    form.sort = 100
    form.name = ''
    form.href = ''
    form.picture_file = null
    refFI.value?.handleFileClear()
}
</script>

<template>
    <q-card flat bordered square class="bg-mutan width-70">
        <q-card-section class="q-pa-none">
            <q-list>
                <q-item>
                    <q-item-section class="col-4 justify-center">
                        <file-image ref="refFileImage" for="idFile_0" v-model="form.picture_file" height="180px" width="100%" />
                    </q-item-section>
                    <q-item-section class="col-4 justify-center">
                        <input-number readonly label="Id" v-model="form.id" :error_message="form.errors.id" :error="!!form.errors.id" />
                        <input-number label="Сортировка" v-model="form.sort" :error_message="form.errors.sort" :error="!!form.errors.sort" />
                        <input-string label="Наименование" v-model="form.name" :error_message="form.errors.name" :error="!!form.errors.name" />
                        <input-string label="Ссылка" v-model="form.href" :error_message="form.errors.href" :error="!!form.errors.href" />
                    </q-item-section>
                    <q-item-section class="col-4 justify-center">
                        <btn label="Добавить" @click="onCreate" color="gries" />
                        <btn label="Отменить" color="gries" @click="onReset"/>
                    </q-item-section>
                </q-item>
            </q-list>
        </q-card-section>
    </q-card>
</template>


