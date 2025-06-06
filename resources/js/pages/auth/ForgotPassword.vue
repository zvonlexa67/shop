<script setup lang="ts">
import { route } from 'ziggy-js'
import { Head, useForm } from '@inertiajs/vue3'
import { InputString } from '@/components/form/input'
import { BtnLink, Btn } from '@/components/form/button'
import GuestLayout from '@/layouts/GuestLayout.vue'

defineProps<{
    status?: string;
}>();

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <GuestLayout>
        <Head title="Forgot password" />
        <template #title>Forgot password</template>
        <q-list bordered separator>
            <q-item class="no-border q-mt-md">
                <q-item-section>
                    <InputString label="Email address" v-model="form.email" :error_message="form.errors.email"
                        :error="!!form.errors.email" class="full-width q-pa-none" />
                </q-item-section>
            </q-item>
            <q-item class="no-border q-mt-sm">
                <q-item-section>
                    <Btn label="Email password reset link" @click.stop.prevent="submit" class="text-mutan bg-bluies full-width" />
                </q-item-section>
            </q-item>
            <q-item class="no-border q-mt-sm">
                <q-item-section>
                    <BtnLink :href="route('login')" label="og in" class="full-width" />
                </q-item-section>
            </q-item>
        </q-list>
    </GuestLayout>
</template>
