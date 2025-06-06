<script setup lang="ts">
import { InputNumber, InputString } from '@/components/form/input'
import { DropImage } from '@/components/file'
import { Btn } from '@/components/form/button'
import { inject, onUpdated } from 'vue'
import { useTemplateRef } from 'vue'

type DropImageType = InstanceType<typeof DropImage>

interface InjectUpdate {
  form: any
  cat: any
  onUpdate: () => void
  applayForm: () => void
  onDestroy: () => void
  loadCreate: () => void
}

const injected = inject<InjectUpdate>('update')

if (!injected) {
  throw new Error('Injection "update" not found')
}

const { form, cat, onUpdate, applayForm, onDestroy, loadCreate } = injected

const refFileImage = useTemplateRef<DropImageType>('refFileImage')
const refFileIcon = useTemplateRef<DropImageType>('refFileIcon')

const idImage = 'idImage_' + (cat.value === null ? '000' : cat.value.id)
const idIcon = 'idIcon_' + (cat.value === null ? '000' : cat.value.id)

document.querySelector<HTMLButtonElement>('#' + idImage)?.click()
document.querySelector<HTMLButtonElement>('#' + idIcon)?.click()

onUpdated(() => {
    // console.log('cat.value')
    // console.log(cat.value)
})

const onChange = () => {
  applayForm()
  refFileImage.value?.handleFileClear()
  refFileIcon.value?.handleFileClear()
  form.errors = {}
}
</script>

<template>
<!-- <q-list class="img-width"> -->
<q-list>
  <q-item class="q-pa-none">
		<q-item-section>
			<span class="text-gries text-h4"><u>{{ form.title }}</u></span>
		</q-item-section>
	</q-item>
  <q-item class="no-padding">
    <q-item-section class="justify-around">
      <input-number v-model="form.id" label="Id" readonly class="q-field--with-bottom" />
      <input-number v-model="form.sort" label="Сортировка":error_message="form.errors.sort" :error="!!form.errors.sort" />
      <input-string v-model="form.title" label="Наименование" :error_message="form.errors.title" :error="!!form.errors.title" />
      <input-string v-model="form.slug" label="Слаг" :error-message="form.errors.slug" :error="!!form.errors.slug" class="q-pa-none"/>
    </q-item-section>
    <q-item-section class="col-3">
      <drop-image
        :img="form.picture_image"
        ref="refFileImage"
        :delete="false"
        label="Картинка"
        :for="idImage"
        v-model="form.picture_file_image"
        :error-message="form.errors.picture_file_image"
        :error="!!form.errors.picture_file_image"
        height="250px"
        width="300px"
      />
    </q-item-section>
    <q-item-section class="col-3">
      <drop-image
        :img="form.picture_icon"
        ref="refFileIcon"
        :delete="false"
        label="Иконка"
        :for="idIcon"
        v-model="form.picture_file_icon"
        :error-message="form.errors.picture_file_icon"
        :error="!!form.errors.picture_file_icon"
        height="250px"
        width="300px"
      />
    </q-item-section>
    <q-item-section class="items-between col-2">
      <btn label="Создать" @click="loadCreate" color="gries">
        <q-tooltip>Создать категорию</q-tooltip>
      </btn>
      <q-space />
      <btn label="Сохранить" :disable="!form.id" @click="onUpdate" color="gries">
        <q-tooltip>Сохранить изменения в категории</q-tooltip>
      </btn>
      <btn label="Отменить" @click="onChange" color="gries" class="q-ml-sm">
        <q-tooltip>Отменить все изменения категории</q-tooltip>
      </btn>
      <btn label="Удалить" :disable="!form.id" color="dbrem" class="q-ml-sm" @click="onDestroy">
        <q-tooltip>Удалить категорию</q-tooltip>
      </btn>
    </q-item-section>
  </q-item>
</q-list>
</template>

<style lang="sass" scoped>
.slide-img--border
	border: 1px solid #ccc
	border-radius: 4px
.img-width
	width: 100%
.q-size-font-tree
	font-size: small
</style>

<style lang="sass">
.q-error-pt-none .q-field__bottom
	padding-top: 0px
.q-tree__arrow
	font-size: 12px
	margin-right: 4px
</style>
