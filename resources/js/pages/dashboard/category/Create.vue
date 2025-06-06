<script setup lang=ts>
import { InputNumber, InputString } from '@/components/form/input'
import { DropImage } from '@/components/file'
import { Btn } from '@/components/form/button'
import { inject, watch } from 'vue'
import { useTemplateRef } from 'vue'

// import DnD from './treeNode/DnD.vue'

type DropImageType = InstanceType<typeof DropImage>

interface Create {
  form: any
  onCreate: () => void
  loadCreate: () => void
}

const injected = inject<Create>('create')

if (!injected) {
  throw new Error('Injection "create" not found')
}

const { form, onCreate, loadCreate } = injected

const refFImage = useTemplateRef<DropImageType>('refFileImage')
const refFIcon = useTemplateRef<DropImageType>('refFileIcon')

const idImage = 'idImage_010'
const idIcon = 'idIcon_010'

watch(() => [ form.picture_file_image, form.picture_file_icon ], (newVal) => {
	newVal[0] ?? refFImage.value?.handleImgClear()
	newVal[1] ?? refFIcon.value?.handleImgClear()
})

const onChange = () => {
  loadCreate()
  refFImage.value?.handleFileClear()
  refFIcon.value?.handleFileClear()
  form.errors = {}
}

</script>

<template>
<q-list class="img-width">
	<q-item class="q-pa-none">
		<q-item-section>
			<span class="text-gries text-h4"><u>Новая категория</u></span>
		</q-item-section>
	</q-item>
  <q-item class="no-padding">
    <q-item-section class="justify-around">
      <input-number v-model="form.id" label="Id" readonly class="q-field--with-bottom" />
      <input-number v-model="form.sort" label="Сортировка" :error_message="form.errors.sort" :error="!!form.errors.sort" />
      <input-string v-model="form.title" label="Наименование" :error_message="form.errors.title" :error="!!form.errors.title" />
      <input-string v-model="form.slug" label="Слаг" :error_message="form.errors.slug" :error="!!form.errors.slug" class="q-pa-none"/>
    </q-item-section>
    <q-item-section class="col-3">
      <drop-image
        ref="refFileImage"
        :delete="false"
        label="Картинка"
        :for="idImage"
        v-model="form.picture_file_image"
        height="250px"
        width="300px"
      />
    </q-item-section>
    <q-item-section class="col-3">
      <drop-image
        ref="refFileIcon"
        :delete="false"
        label="Иконка"
        :for="idIcon"
        v-model="form.picture_file_icon"
        height="250px"
        width="300px"
      />
    </q-item-section>
    <q-item-section class="items-between col-2">
      <btn label="Создать" @click="onCreate" color="gries">
        <q-tooltip>Создать категорию</q-tooltip>
      </btn>
      <btn label="Отменить" @click="onChange" class="q-ml-sm" color="gries">
        <q-tooltip>Отменить изменения</q-tooltip>
      </btn>
    </q-item-section>
  </q-item>
</q-list>

<!-- <DnD /> -->
</template>
