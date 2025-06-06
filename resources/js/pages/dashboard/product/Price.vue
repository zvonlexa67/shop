<script setup lang="ts">
import { InputNumber } from '@/components/form/input'
import { inject } from 'vue'


interface InjectPrice {
  form: any
  storePrice: () => void
  reloadProduct: (state: boolean, product_id?: number) => void
}

const injected = inject<InjectPrice>('price')

if (!injected) {
throw new Error('Injection "price" not found')
}

const { form, storePrice, reloadProduct } = injected
</script>

<template>
<div class="row justify-center q-ma-lg">
    <q-list class="product-card" bordered separator>
      	<q-item>
        	<q-item-section>
          		<input-number label="Базовая цена" v-model="form.base" :error_message="form.errors.base" :error="!!form.errors.base" />
          		<input-number label="Ставка НДС" v-model="form.nds" :error_message="form.errors.nds" :error="!!form.errors.nds" />
          		<input-number label="Закупочная цена" v-model="form.purchase" :error_message="form.errors.purchase" :error="!!form.errors.purchase" />
          		<q-toggle label-color="gries" color="gries" v-model="form.price_nds" label="НДС включен в цену" class="q-mb-md" />
        	</q-item-section>
      	</q-item>
      	<q-item>
        	<q-item-section>
          		<q-btn flat no-caps label="Сохранить" @click.stop.prevent="storePrice" />
        	</q-item-section>
        	<q-item-section>
          		<q-btn flat no-caps label="Отменить" @click.stop.prevent="reloadProduct(false)" />
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
