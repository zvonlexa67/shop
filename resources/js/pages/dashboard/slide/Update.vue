<script setup lang="ts">
import { useForm, router } from '@inertiajs/vue3'
import { InputString, InputNumber } from '@/components/form/input'
import { Btn } from '@/components/form/button'
import { FileImage } from '@/components/file'
import type { Slide } from '@/types'
import { useQuasar } from 'quasar'
import { Warning, Info } from '@/components/notify'
import { useTemplateRef } from 'vue'
import { Errors } from '@/composables/useErrors'

interface StrictFormData extends Slide {
    _method: string
    picture_file: File | null
}

type FormDataType = StrictFormData & Record<string, any>
type FileImageType = InstanceType<typeof FileImage>

const $q = useQuasar()

const props = defineProps<{
    slide: Slide,
}>()

const refFI = useTemplateRef<FileImageType>('refFileImage')

const form = useForm<FormDataType>({
    id: props.slide.id,
    name: props.slide.name,
    sort: props.slide.sort,
    href: props.slide.href,
    picture_file: null,
    _method: 'POST',
})

const onUpdate = () => {
    form._method = 'PUT'

    form.post(
        route('dashboard.slides.update'),
        {
            preserveState: true,
            preserveScroll: true,
            only: [ 'errors', 'slides' ],
            onError: (errors) => Errors(errors),
        }
    )
}

const onReset = () => {
    form.name = props.slide.name
    form.sort = props.slide.sort
    form.href = props.slide.href
    form._method = 'PUT'
    refFI.value?.handleFileClear()
}

const onDestroy = () => {
    $q.dialog({
        title: 'Удаление',
        message: 'Внимание!!! после удаления данные не подлежат востановлении, продолжить удаление...',
        cancel: true,
        persistent: true
    }).onOk(() => {
        router.delete(route('dashboard.slides.destroy', { id: props.slide.id }),
            {
                preserveState: true,
                preserveScroll: true,
                only: [ 'errors', 'slides' ],
                onError: (errors) => Errors(errors),
                onFinish: () => Info('Удаление прошло удачно'),
            }
        )
    }).onCancel(() => {
        Warning('Удаление отменено')
    })
}
</script>

<template>
    <q-card flat bordered square class="bg-mutan width-70">
        <q-card-section class="q-pa-none">
            <q-list>
                <q-item>
                    <q-item-section class="col-4 justify-center">
                        <file-image ref="refFileImage" :for="'idFile_' + props.slide.id" :img="props.slide.picture" v-model="form.picture_file" height="180px" width="100%" />
                    </q-item-section>
                    <q-item-section class="col-4 justify-center">
                        <input-number readonly label="Id" v-model="form.id" :error_message="form.errors.id" :error="!!form.errors.id" />
                        <input-number label="Сортировка" v-model="form.sort" :error_message="form.errors.sort" :error="!!form.errors.sort" />
                        <input-string label="Наименование" v-model="form.name" :error_message="form.errors.name" :error="!!form.errors.name" />
                        <input-string label="Ссылка" v-model="form.href" :error_message="form.errors.href" :error="!!form.errors.href" />
                    </q-item-section>
                    <q-item-section class="col-4 justify-center">
                        <btn label="Сохранить" color="gries" @click="onUpdate"/>
                        <btn label="Отменить" color="gries" @click="onReset"/>
                        <btn label="Удалить" color="dbrem" @click="onDestroy"/>
                    </q-item-section>
                </q-item>
            </q-list>
        </q-card-section>
    </q-card>
</template>

