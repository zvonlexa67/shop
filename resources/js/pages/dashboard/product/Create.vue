<script setup lang="ts">
import { inject } from 'vue'
import { InputNumber, InputString } from '@/components/form/input'
import { Btn } from '@/components/form/button'

interface CreateInject {
  form: any
  isComponent: any
  storeProduct: () => void
}

const injected = inject<CreateInject>('create')

if (!injected) {
  throw new Error('Injection "create" not found')
}

const { form, isComponent, storeProduct } = injected

const list = () => {
  isComponent.value = 'List'
}
</script>

<template>
  <div class="row justify-center q-ma-lg">
    <q-list class="width-40" bordered separator>
      <q-item class="text-gries">
        <q-item-section>
          <input-number readonly label="Id" v-model="form.id" :error_message="form.errors.id" :error="!!form.errors.id" />
          <q-toggle color="gries" v-model="form.active" label="Активный" class="q-mb-md" />
          <input-number label="Сортировка" v-model="form.sort" :error_message="form.errors.sort" :error="!!form.errors.sort" />
          <input-string label="Наименование" v-model="form.title" :error_message="form.errors.title" :error="!!form.errors.title" />
          <input-string label="Слаг" v-model="form.slug" :error_message="form.errors.slug" :error="!!form.errors.slug" />
          <input-string label="Подсказка" v-model="form.tooltip" :error_message="form.errors.tooltip" :error="!!form.errors.tooltip" />
        </q-item-section>
      </q-item>
      <q-item>
        <q-item-section>
          <btn color="gries" label="Сохранить" @click="storeProduct" />
        </q-item-section>
        <q-item-section>
          <btn color="gries" label="Список" @click="list" />
        </q-item-section>
      </q-item>
    </q-list>
  </div>
</template>