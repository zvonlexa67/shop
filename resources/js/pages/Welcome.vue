<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import { Monitor, Moon, Sun } from 'lucide-vue-next'
// import { ref } from 'vue'

// const Icons = { Monitor, Moon, Sun }

</script>

<template>
<Head title="Welcome">
    <link rel="preconnect" href="https://rsms.me/" />
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
</Head>
<div class="q-pa-md row items-start justify-center q-gutter-md">
    <q-card style="width: 100%; max-width: 350px;">
        <q-card-section>

            <component :is="Monitor" />
            
            <Link :href="route('login')">
            first section
            </Link>
        </q-card-section>
        <q-card-section>
            <component :is="Moon" />
            <Link :href="route('home')">
            second section
            </Link>
        </q-card-section>
        <q-card-section>
            <component :is="Sun" />
            thried section
        </q-card-section>
    </q-card>
    <!-- <q-card style="width: 100%; max-width: 350px;">
        <q-card-section>
            <component :is="Icons['Monitor']" />
            <Link :href="route('dashboard')">
            first section
            </Link>
        </q-card-section>
        <q-card-section>
            <component :is="Icons['Moon']" />
            <Link :href="route('home')">
            second section
            </Link>
        </q-card-section>
        <q-card-section>
            <component :is="Icons['Sun']" />
            thried section
        </q-card-section>
    </q-card>
    <q-card style="width: 100%; max-width: 350px;">
        <q-card-section>
            <component :is="Icons.Monitor" />
            <Link href="/">
            first section
            </Link>
        </q-card-section>
        <q-card-section>
            <component :is="Icons.Moon" />
            <Link :href="route('home')">
            second section
            </Link>
        </q-card-section>
        <q-card-section>
            <component :is="Icons.Sun" />
            thried section
        </q-card-section>
    </q-card>
    <q-card style="width: 100%; max-width: 350px;">
        <q-card-section>
            <Monitor />
            <Link href="/">
            first section
            </Link>
        </q-card-section>
        <q-card-section>
            <Moon />
            <Link :href="route('home')">
            second section
            </Link>
        </q-card-section>
        <q-card-section>
            <Sun />
            thried section
        </q-card-section>
    </q-card> -->
</div>
</template>

<style lang="sass">
body
    height: 100vh
</style>
