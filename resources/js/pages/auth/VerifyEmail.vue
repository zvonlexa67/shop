<script setup lang="ts">
import { route } from 'ziggy-js'
import { Head, router } from '@inertiajs/vue3'
import GuestLayout from '@/layouts/GuestLayout.vue'
import { Btn } from '@/components/form/button'

defineProps<{
    status?: string;
}>();

</script>

<template>
<GuestLayout>
    <Head title="Email verification" />
    <template #title>Подтвердить e-mail</template>
    <q-list bordered separator>
        <q-item class="no-border q-mt-md" v-if="status === 'verification-link-sent'">
            <q-item-section>
                <span>На адрес электронной почты, указанный вами при регистрации, была отправлена ​​новая ссылка для подтверждения.</span>
            </q-item-section>
        </q-item>
        <q-item class="no-border q-mt-md" v-else>
            <q-item-section>
                <span class="text-center">{{ $page.props.auth.user.email }}</span>
            </q-item-section>
        </q-item>
        <q-item class="no-border q-mt-sm">
            <q-item-section>
                <Btn label="Повторно отправить письмо" @click.stop.prevent="router.post(route('verification.send'))"
                    class="text-mutan bg-bluies full-width" />
            </q-item-section>
        </q-item>
        <q-item class="no-border q-mt-sm">
            <q-item-section>
                <btn @click="router.post(route('logout'))" label="Выйти" class="full-width" />
            </q-item-section>
        </q-item>
    </q-list>
</GuestLayout>
</template>
