<script setup lang="ts">
import { useForm, router } from '@inertiajs/vue3'
import { InputString, InputNumber } from '@/components/form/input'
import { Btn } from '@/components/form/button'
// import { FileImage } from '@/components/file'
import { DropImage } from '@/components/file'
import type { Brand } from '@/types'
import { Errors } from '@/composables/useErrors'
import { useTemplateRef } from 'vue'
import { Warning, Info } from '@/components/notify'
import { useQuasar } from 'quasar'

interface StrictFormData extends Brand {
    _method: string
    picture_file: File | null
}

type FormDataType = StrictFormData & Record<string, any>
type FormImageType = InstanceType<typeof DropImage>

const $q = useQuasar()

const refFI = useTemplateRef<FormImageType>('refFileImage')

const props = defineProps<{
    brand: Brand
}>()

const form = useForm<FormDataType>({
    id: props.brand.id,
    title: props.brand.title,
    slug: props.brand.slug,
    href: props.brand.href,
    sort: props.brand.sort,
    count_products: props.brand.count_products,
    picture_image: '',
    picture_file: null,
    description: props.brand.description ?? '',
    _method: 'POST',
})

const onReset = () => {
    form.id = props.brand.id
    form.title = props.brand.title
    form.slug = props.brand.slug
    form.href = props.brand.href
    form.sort = props.brand.sort
    form.count_products = props.brand.count_products
    form.picture_image = ''
    form.picture_file = null
    form.description = props.brand.description ?? ''
    form._method = 'POST'
    refFI.value?.handleFileClear()
}

const onSave = () => {
    if (form.id != 0) {
        form._method = 'PUT'
        form.post(route('dashboard.brand.update', { 'brand': props.brand.id }), {
            preserveState: true,
            preserveScroll: true,
            only: [ 'errors', 'brands' ],
            onError: (errors) => Errors(errors),
            onSuccess: () => onReset()
        })
    }
}

const onDestroy = () => {
    $q.dialog({
        title: 'Удаление',
        message: 'Внимание!!! после удаления данные не подлежат востановлении, продолжить удаление...',
        cancel: true,
        persistent: true
    }).onOk(() => {
        router.delete(route('dashboard.brand.destroy', { 'brand': form.id }),
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
  <q-card flat bordered square class="bg-mutan">
    <q-card-section>
      <q-list>
        <q-item>
          <q-item-section class="col-3">
            <!-- <file-image 
              ref="refFileImage" 
              :for="'idFile_' + props.brand.id" 
              :img="props.brand.picture_image"
              v-model="form.picture_file" 
              height="275px" 
              width="100%" 
            /> -->

            <drop-image
              ref="refFileImage"
              :delete="false"
              label="Логотип бренда"
              :for="'idFile_' + props.brand.id"
              :img="props.brand.picture_image"
              v-model="form.picture_file"
              :error-message="form.errors.picture_file"
              :error="!!form.errors.picture_file"
              height="220px"
              width="100%"
            />

          </q-item-section>
          <q-item-section class="col-9 justify-between q-ml-none">
            <!-- <input-number readonly label="Id" v-model="form.id" :error_message="form.errors.id" :error="!!form.errors.id" /> -->
            <input-number label="Сортировка" v-model="form.sort" :error_message="form.errors.sort" :error="!!form.errors.sort" />
            <input-string label="Наименование" v-model="form.title" :error_message="form.errors.title" :error="!!form.errors.title" />
            <input-string label="Слаг" v-model="form.slug" :error_message="form.errors.slug" :error="!!form.errors.slug" />
            <input-string label="Ссылка" v-model="form.href" :error_message="form.errors.href" :error="!!form.errors.href" class="q-pb-none"/>
          </q-item-section>
        </q-item>
        <q-item>
          <q-item-section class="col-12">
              <q-editor v-model="form.description" min-height="12rem" class="bg-mutan" />
          </q-item-section>
        </q-item>
        <q-item>
          <q-item-section class="offset-2 col-2">
            <btn label="Сохранить" color="gries" @click="onSave"/>
          </q-item-section>
          <q-item-section class="offset-1 col-2">
            <btn label="Отменить" color="gries" @click="onReset"/>
          </q-item-section>
          <q-item-section class="offset-1 col-2">
              <btn v-if="form.id != 0" label="Удалить" color="dbrem" @click="onDestroy"/>
          </q-item-section>
        </q-item>
      </q-list>
    </q-card-section>
  </q-card>
</template>
