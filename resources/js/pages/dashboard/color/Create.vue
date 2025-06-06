<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'
import { InputString, InputNumber } from '@/components/form/input'
import { Btn } from '@/components/form/button'
import { FileImage } from '@/components/file'
import type { Color } from '@/types'
import { useTemplateRef } from 'vue'
import { Errors } from '@/composables/useErrors'
import { DropImage } from '@/components/file'

interface StrictFormData extends Color {
  _method: string
  picture_file: File | null
}

type FormDataType = StrictFormData & Record<string, any>
type FileImageType = InstanceType<typeof FileImage>

const refFI = useTemplateRef<FileImageType>('refFileImage')

const form = useForm<FormDataType>({
  id: 0,
  sort: 100,
  title: '',
  picture_file: null,
  _method: 'POST',
})

const onSave = () => {
  form._method = 'POST'
  form.post(route('dashboard.color.store'),
    {
      preserveState: true,
      preserveScroll: true,
      only: [ 'errors', 'colors' ],
      onError: (errors) => Errors(errors),
      onSuccess: () => onReset()
    }
  )
}

const onReset = () => {
  form.id = 0
  form.sort = 100
  form.title = ''
  form.picture_file = null
  form._method = 'POST'
  refFI.value?.handleFileClear()
}
</script>

<template>
  <q-card flat bordered square class="bg-mutan list-width">
    <q-card-section class="q-pa-none">
      <q-list>
        <q-item>
          <q-item-section class="col-3 content-center">
            <!-- <file-image 
              ref="refFileImage" 
              for="idFile_0" 
              v-model="form.picture_file" height="120px" width="120px" /> -->

            <drop-image
              ref="refFileImage"
              :delete="false"
              label="Картинка цвета"
              for="idFile_0"
              v-model="form.picture_file"
              :error-message="form.errors.picture_file"
              :error="!!form.errors.picture_file"
              height="100px"
              width="100px"
            />



          </q-item-section>
          <q-item-section class="col-6 justify-evenly q-ml-none">
            <!-- <input-number readonly label="Id" v-model="form.id" :error_message="form.errors.id" :error="!!form.errors.id" /> -->
            <input-number label="Сортировка" v-model="form.sort" :error_message="form.errors.sort" :error="!!form.errors.sort" />
            <input-string label="Наименование" v-model="form.title" :error_message="form.errors.title" :error="!!form.errors.title" />
          </q-item-section>
          <q-item-section class="col-3 justify-center">
            <btn label="Сохранить" color="gries" @click="onSave"/>
            <btn label="Отменить" color="gries" @click="onReset"/>
          </q-item-section>
        </q-item>
      </q-list>
    </q-card-section>
  </q-card>
</template>

<style lang="sass" scoped>
.list-width
  width: 100%
  max-width: 720px
</style>
