<script setup lang="ts">
import { inject } from 'vue'
import { Btn } from '@/components/form/button'
import { InputString, InputNumber, InputSelect } from '@/components/form/input'

interface CreateCharacteristic {
    form: any
    types: any
    onCreate: () => void
    onUpdate: () => void
}

const injected = inject<CreateCharacteristic>('createcharacteristic')

if(!injected) {
    throw new Error('Injection "createcharacteristic" not found');
}

const { form, types, onCreate, onUpdate } = injected

</script>

<template>
    <q-list>
        <q-item>
            <q-item-section class="justify-around col-6">
                <input-number v-model="form.id" label="Id" readonly class="q-field--with-bottom" />
                <input-number v-model="form.sort" label="Сортировка" class="q-field--with-bottom" />
                <input-string v-model="form.title" label="Наименование" class="q-field--with-bottom" />
                <input-string v-model="form.description" label="Описание" class="q-field--with-bottom q-pb-none" />
		        <template v-if="form.parent_id != null">
          			<q-toggle v-model="form.smart" color="gries" label="Фильтр" />
					<input-select :options="types" v-model="form.type" label="Тип характеристики" class="q-field--with-bottom q-pb-none" />
		        </template>
      		</q-item-section>
      		<q-item-section class="justify-center offset-1 col-4">
        		<btn label="Сохранить" @click="onCreate" color="gries" />
        		<btn label="Отменить" @click="onUpdate" color="gries" />
      		</q-item-section>
    	</q-item>
  	</q-list>
</template>
