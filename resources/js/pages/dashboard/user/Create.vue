<script setup lang="ts">
import { inject } from 'vue'
import { InputString, InputPassword } from '@/components/form/input'
import { Btn } from '@/components/form/button'

interface Create {
    form: any
    onCreate: () => void
    resetForm: () => void
    onList: () => void
}

const injected = inject<Create>('create')

if (!injected) {
    throw new Error('Injection "create" not found')
}

const { form, onCreate, resetForm, onList } = injected
</script>

<template>
	<div class="row text-gries bg-mutan q-ma-xl">
		<div class="offset-3 col-6 text-center">
			<q-list bordered separator>
				<q-item class="no-border q-mt-md">
					<q-item-section>
                        <input-string
                            label="Введите имя"
                            v-model="form.name"
                            :error_message="form.errors.name"
                            :error="!!form.errors.name"
                            class="full-width q-pa-none"
                        />
					</q-item-section>
				</q-item>
				<q-item class="no-border q-mt-md">
					<q-item-section>
                        <input-string
                            label="Введите почту"
                            v-model="form.email"
                            :error_message="form.errors.email"
                            :error="!!form.errors.email"
                            class="full-width q-pa-none"
                        />
					</q-item-section>
				</q-item>
				<q-item class="no-border q-mt-md">
					<q-item-section>
                        <input-password
                            label="Введите пароль"
                            v-model="form.password"
                            :error_message="form.errors.password"
                            :error="!!form.errors.password"
                            class="full-width q-pa-none"
                        />
					</q-item-section>
				</q-item>
				<q-item class="no-border q-mt-md">
					<q-item-section>
                        <input-password
                            label="Еще раз пароль"
                            v-model="form.password_confirmation"
                            :error_message="form.errors.password_confirmation"
                            :error="!!form.errors.password_confirmation"
                            class="full-width q-pa-none"
                        />
					</q-item-section>
				</q-item>
				<q-item class="no-border q-mt-sm text-center">
					<q-item-section>
						<btn label="Сохранить" color="bluies" @click="onCreate"/>
					</q-item-section>
					<q-item-section>
						<btn label="Сбросить" color="gries" @click="resetForm" />
					</q-item-section>
					<q-item-section>
						<btn label="Список" color="dbrem" @click="onList" />
					</q-item-section>
				</q-item>
			</q-list>
		</div>
  	</div>
</template>

<style lang="sass">
.q-error-pt-none .q-field__bottom
	padding-top: 0px
</style>
