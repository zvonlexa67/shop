<script setup lang="ts">
import { InputNumber, InputString } from '@/components/form/input'
import { Btn } from '@/components/form/button'
import { inject } from 'vue'

interface InjectUpdate {
  form: any
  isComponent: any
	updateProduct: () => void
}

const injected = inject<InjectUpdate>('update')

if (!injected) {
	throw new Error('injection "update" not found')
}

const { form, isComponent, updateProduct } = injected

const list = () => {
  isComponent.value = 'List'
}
</script>

<template>
<div class="row justify-center q-ma-lg">
  <q-list class="product-card" bordered separator>
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
        <btn color="gries" label="Изменить" @click="updateProduct" />
      </q-item-section>
      <q-item-section>
        <btn color="gries" label="Список" @click="list" />
        <!-- <btn color="gries" label="Список" @click="onNodeSelected(form.category_id)" /> -->
      </q-item-section>
    </q-item>
  </q-list>
</div>
</template>

<style lang="sass" scoped>
.product-card
	width: 100%
	max-width: 550px
</style>
