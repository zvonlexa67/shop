<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3'
import GuestLayout from '@/layouts/GuestLayout.vue'
import { InputPassword } from '@/components/form/input'
import { Btn } from '@/components/form/button'

const form = useForm({
    password: '',
});

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => {
            form.reset();
        },
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Confirm your password" />
        <template #title>Confirm your password</template>
        <q-list bordered separator>
            <q-item class="no-border q-mt-sm">
                <q-item-section>
                    <InputPassword label="Пароль" v-model="form.password" :error-message="form.errors.password"
                        :error="!!form.errors.password" no-error-icon class="full-width q-pa-none" />
                </q-item-section>
            </q-item>
            <q-item class="no-border q-mt-sm">
                <q-item-section>
                    <Btn label="Confirm Password" @click.stop.prevent="submit" class="text-mutan bg-bluies full-width" />
                </q-item-section>
            </q-item>
        </q-list>
    </GuestLayout>
</template>
