<script setup lang="ts">
import { inject } from 'vue'
import { InputString, InputPassword, InputNumber } from '@/components/form/input'
import { Btn } from '@/components/form/button'

interface Update {
    form: any
    onUpdate: () => void
    applayForm: () => void
    onList: () => void
}

const injected = inject<Update>('update')

if (!injected) {
    throw new Error('Injection "update" not found')
}

const { form, onUpdate, applayForm, onList } = injected
</script>

<template>
    <div class="row text-gries bg-mutan q-ma-xl">
        <div class="offset-3 col-6 text-center">
            <q-list bordered separator>
                <q-item class="no-border q-mt-md">
                    <q-item-section>
                        <input-number
                            label="Id"
                            v-model="form.id"
                            readonly
                            :error_message="form.errors.id"
                            :error="!!form.errors.id"
                            class="full-width q-pa-none"
                        />
                    </q-item-section>
                </q-item>
                <q-item class="no-border">
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
                <q-item class="no-border">
                    <q-item-section>
                        <input-string
                            label="Почта"
                            v-model="form.email"
                            :error_message="form.errors.email"
                            :error="!!form.errors.email"
                            class="full-width q-pa-none"
                        />
                    </q-item-section>
                </q-item>
                <q-item class="no-border">
                    <q-item-section>
                        <input-string
                            label="Проверка"
                            v-model="form.email_verified_at"
                            :error_message="form.errors.email_verified_at"
                            :error="!!form.errors.email_verified_at"
                            class="full-width q-pa-none"
                        />
                    </q-item-section>
                </q-item>
                <q-item class="no-border">
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
                <q-item class="no-border">
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
                <q-item class="no-border">
                    <q-item-section>
                        <input-string
                            label="Создан"
                            v-model="form.created_at"
                            class="full-width q-pa-none"
                        />
                    </q-item-section>
                </q-item>
                <q-item class="no-border">
                    <q-item-section>
                        <input-string
                            label="Изменен"
                            v-model="form.updated_at"
                            class="full-width q-pa-none"
                        />
                    </q-item-section>
                </q-item>
                <q-item class="no-border q-mb-md text-center">
					<q-item-section>
						<btn label="Сохранить" color="bluies" @click="onUpdate"/>
					</q-item-section>
					<q-item-section>
						<btn label="Сбросить" color="gries" @click="applayForm" />
					</q-item-section>
					<q-item-section>
						<btn label="Список" color="dbrem" @click="onList" />
					</q-item-section>
                </q-item>
            </q-list>
        </div>
    </div>
</template>
