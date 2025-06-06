<script setup lang="ts">
import { route } from 'ziggy-js'
import { Head, useForm } from '@inertiajs/vue3'
import { InputString, InputPassword } from '@/components/form/input'
import { BtnLink, Btn } from '@/components/form/button'
import GuestLayout from '@/layouts/GuestLayout.vue'
import PrivacyPolicy from '@/pages/policy/PrivacyPolicy.vue'

defineOptions({
    name: 'Login'
})

const form = useForm({
    email: '',
    password: '',
})

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    })
}
</script>

<template>
    <GuestLayout>
        <Head title="Login" />
        <template #title>Вход по почте</template>
        <q-list bordered separator>
            <q-item class="no-border q-mt-md">
                <q-item-section>
                    <InputString label="Введите почту" v-model="form.email" :error_message="form.errors.email"
                        :error="!!form.errors.email" class="full-width q-pa-none" />
                </q-item-section>
            </q-item>
            <q-item class="no-border q-mt-sm">
                <q-item-section>
                    <InputPassword label="Введите пароль" v-model="form.password" :error-message="form.errors.password"
                        :error="!!form.errors.password" no-error-icon class="full-width q-pa-none" />
                </q-item-section>
            </q-item>
            <q-item class="no-border q-mt-sm">
                <q-item-section>
                    <Btn label="Войти" @click.stop.prevent="submit" class="text-mutan bg-bluies full-width" />
                </q-item-section>
            </q-item>
            <q-item class="no-border q-mt-sm">
                <q-item-section>
                    <BtnLink :href="route('register')" label="Зарегистрироваться" class="text-gries full-width" />
                </q-item-section>
            </q-item>
            <q-item class="no-border">
                <q-item-section class="text-gries text-size-10 text-center q-mb-md" style="display: block;">
                    <PrivacyPolicy />
                </q-item-section>
            </q-item>
        </q-list>
    </GuestLayout>
</template>
