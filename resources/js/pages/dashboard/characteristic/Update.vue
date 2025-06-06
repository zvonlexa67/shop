<script setup lang="ts">
import { inject } from 'vue'
import { Btn } from '@/components/form/button'
import { InputString, InputNumber, InputSelect } from '@/components/form/input'

interface UpdateInjection {
  form: any;
  types: any;
  onSave: () => void;
  onReset: () => void;
  onDestroy: () => void;
  onNewGroup: () => void;
  onNewCharacteristic: () => void;
}

const injected = inject<UpdateInjection>('update');

if (!injected) {
  throw new Error('Injection "update" not found');
}

const { form, types, onSave, onReset, onDestroy, onNewGroup, onNewCharacteristic } = injected;

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
            <q-item-section class="justify-around offset-1 col-4">
                <btn label="Создать группу" color="gries" @click="onNewGroup" />
                <btn label="Создать характеристику" color="gries" @click="onNewCharacteristic" />
                <q-space />
                <btn :disable="form.id==0" label="Сохранить" color="gries" @click="onSave" />
                <btn label="Отменить" color="gries" @click="onReset" />
                <btn :disable="form.id==0" label="Удалить" color="dbrem" @click="onDestroy" />
            </q-item-section>
        </q-item>
    </q-list>
</template>
