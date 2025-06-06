<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'
import { InputString, InputNumber } from '@/components/form/input'
import { Btn } from '@/components/form/button'
import { DropImage } from '@/components/file'
import type { Brand } from '@/types'
import { useTemplateRef } from 'vue'
import { Errors } from '@/composables/useErrors'

interface StrictFormData extends Brand {
    _method: string
    picture_file: File | null
}

type FormDataType = StrictFormData & Record<string, any>
type FileImageType = InstanceType<typeof DropImage>

const refFI = useTemplateRef<FileImageType>('refFileImage')

const form = useForm<FormDataType>({
    id: 0,
    title: '',
    slug: '',
    href: '',
    sort: 100,
    count_products: 0,
    picture_image: '',
    picture_file: null,
    description: '',
    _method: 'POST',
})

const onReset = () => {
    form.id = 0
    form.title = ''
    form.slug = ''
    form.href = ''
    form.sort = 100
    form.count_products = 0
    form.picture_file = null
    form.description = ''
    form._method = 'POST'
    refFI.value?.handleFileClear()
}

const onSave = () => {
    if (form.id == 0) {
        form.post(route('dashboard.brand.store'),
        {
            preserveState: true,
            preserveScroll: true,
            only: [ 'errors', 'brands' ],
            onError: (errors) => Errors(errors),
            onSuccess: () => onReset()
        })
    }
}
</script>

<template>
  <q-card flat bordered square class="bg-mutan">
    <q-card-section>
      <q-list>
        <q-item>
          <q-item-section class="col-3">
            <drop-image
              ref="refFileImage"
              :delete="false"
              label="Логотип бренда"
              for="idFile_0"
              v-model="form.picture_file"
              :error-message="form.errors.picture_file"
              :error="!!form.errors.picture_file"
              height="220px"
              width="100%"
            />
          </q-item-section>
          <q-item-section class="col-9 justify-between q-ml-none">
            <input-number 
              label="Сортировка" v-model="form.sort" :error_message="form.errors.sort" :error="!!form.errors.sort" />
            <input-string label="Наименование" v-model="form.title" :error_message="form.errors.title" :error="!!form.errors.title" />
            <input-string label="Слаг" v-model="form.slug" :error_message="form.errors.slug" :error="!!form.errors.slug" />
            <input-string label="Ссылка" v-model="form.href" :error_message="form.errors.href" :error="!!form.errors.href" class="q-pb-none"/>
          </q-item-section>
                </q-item>
                <q-item>
                    <q-item-section>
                        <q-editor v-model="form.description" min-height="12rem" class="bg-mutan" />
                    </q-item-section>
                </q-item>
                <q-item>
                    <q-item-section class="offset-2 col-2">
                        <btn label="Сохранить" color="gries" @click="onSave"/>
                    </q-item-section>
                    <q-item-section class="offset-4 col-2">
                        <btn label="Отменить" color="gries"  @click="onReset"/>
                    </q-item-section>
                </q-item>
            </q-list>
        </q-card-section>
    </q-card>
</template>
