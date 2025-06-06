<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3'
import GuestLayout from '@/layouts/GuestLayout.vue'
import { InputString, InputPassword } from '@/components/form/input'
import { Btn } from '@/components/form/button'

interface Props {
    token: string;
    email: string;
}

const props = defineProps<Props>();

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.store'), {
        onFinish: () => {
            form.reset('password', 'password_confirmation');
        },
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />
        <template #title>Reset password</template>
        <q-list bordered separator>
            <q-item class="no-border q-mt-md">
                <q-item-section>
                    <InputString label="Email" v-model="form.email" :error_message="form.errors.email"
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
                    <InputPassword label="Подтвердите пароль" v-model="form.password_confirmation"
                        :error-message="form.errors.password_confirmation" :error="!!form.errors.password_confirmation"
                        no-error-icon class="full-width q-pa-none" />
                </q-item-section>
            </q-item>
            <q-item class="no-border q-mt-sm">
                <q-item-section>
                    <Btn label="Reset password" @click.stop.prevent="submit" class="text-mutan bg-bluies full-width" />
                </q-item-section>
            </q-item>
        </q-list>
    </GuestLayout>
</template>
