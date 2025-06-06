<script setup lang="ts">
import DashboardLayout from '@/layouts/DashboardLayout.vue'
import Update from './Update.vue'
import Create from './Create.vue'
import { ScrollArea } from '@/components/design'
import { type Slide } from '@/types'

interface Props {
    slides: Slide[]
}

const props = defineProps<Props>();
</script>

<template>
    <DashboardLayout>
        <scroll-area style="height: calc(100vh - 120px);" >
            <q-list>
                <q-item v-for="slide in props.slides" :key="slide.id" >
                    <q-item-section style="flex-direction: inherit;">
                        <Update :slide="slide" />
                    </q-item-section>
                </q-item>
                <q-item>
                    <q-item-section style="flex-direction: inherit;">
                        <Create />
                    </q-item-section>
                </q-item>
            </q-list>
        </scroll-area>
    </DashboardLayout>
</template>
