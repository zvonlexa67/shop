<script setup lang="ts">
import { useForm, router } from '@inertiajs/vue3'
import { InputString, InputNumber } from '@/components/form/input'
import { Btn } from '@/components/form/button'
import { FileImage } from '@/components/file'
import type { Color } from '@/types'
import { Errors } from '@/composables/useErrors'
import { useTemplateRef } from 'vue'
import { Warning, Info } from '@/components/notify'
import { useQuasar } from 'quasar'
import { DropImage } from '@/components/file'

interface Props {
    color: Color;
}

interface StrictFormData extends Color {
    _method: string
    picture_file: File | null
}

type FormDataType = StrictFormData & Record<string, any>
type FileImageType = InstanceType<typeof FileImage>

const $q = useQuasar()

const refFI = useTemplateRef<FileImageType>('refFileImage')

const props = defineProps<Props>()

const form = useForm<FormDataType>({
	id: props.color.id,
	sort: props.color.sort,
	title: props.color.title,
	picture_file: null,
    _method: 'POST',
})

const onSave = () => {
    if (props.color.id != 0) {
		form._method = 'PUT'
      	form.post(route('dashboard.color.update'),
      	{
            preserveState: true,
            preserveScroll: true,
            only: [ 'errors', 'colors' ],
            onError: (errors) => Errors(errors),
            onSuccess: () => onReset()
      	})
    }
}

const onReset = () => {
    form.id = props.color.id
    form.sort = props.color.sort
    form.title = props.color.title
    form.picture_file = null
    form._method = 'POST'
    refFI.value?.handleFileClear()
}

const onDestroy = () => {
    $q.dialog({
        title: 'Удаление',
        message: 'Внимание!!! после удаления данные не подлежат востановлении, продолжить удаление...',
        cancel: true,
        persistent: true
    }).onOk(() => {
        router.delete(route('dashboard.color.destroy', { 'id': props.color.id }),
            {
                preserveState: true,
                preserveScroll: true,
                only: [ 'errors', 'colors' ],
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
  	<q-card flat bordered square class="bg-mutan list-width">
    	<q-card-section class="q-pa-none">
      		<q-list>
        		<q-item>
				<q-item-section class="col-3 content-center">

					<!-- <file-image 
            ref="refFileImage" 
            :for="'idFile_' + props.color.id" 
            :img="props.color.picture_image" 
            v-model="form.picture_file" 
            height="120px" 
            width="120px" 
          /> -->

        <drop-image
          :img="props.color.picture_image"
          ref="refFileImage"
          :delete="false"
          label="Картинка цвета"
          :for="'idFile_' + props.color.id"
          v-model="form.picture_file"
          :error-message="form.errors.picture_file"
          :error="!!form.errors.picture_file"
          height="100px"
          width="100px"
        />







				</q-item-section>
				<q-item-section class="col-6 justify-evenly q-ml-none">
					<!-- <input-number readonly label="Id" v-model="form.id" :error_message="form.errors.id" :error="!!form.errors.id" /> -->
					<input-number 
            label="Сортировка" 
            v-model="form.sort" 
            :error_message="form.errors.sort" 
            :error="!!form.errors.sort" 
          />
					<input-string 
            label="Наименование" 
            v-model="form.title" 
            :error_message="form.errors.title" 
            :error="!!form.errors.title" 
            class="q-pb-none"
          />
				</q-item-section>
				<q-item-section class="col-3 justify-center">
					<btn label="Сохранить" color="gries" @click="onSave"/>
					<btn label="Отменить" color="gries" @click="onReset"/>
					<btn label="Удалить" color="dbrem" @click="onDestroy"/>
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
