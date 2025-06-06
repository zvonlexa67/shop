<script setup lang="ts">
import DashboardLayout from '@/layouts/DashboardLayout.vue'
import Update from './Update.vue'
import Create from './Create.vue'
import { ScrollArea } from '@/components/design'
import { type Brand } from '@/types'

interface Props {
    brands: Brand[]
}

const props = defineProps<Props>()
</script>

<template>
    <DashboardLayout>
        <scroll-area style="height: calc(100vh - 120px);" >
            <q-list>
                <q-item v-for="brand in props.brands" :key="brand.id">
                    <q-item-section>
                        <Update :brand="brand" />
                    </q-item-section>
                </q-item>
                <q-item>
                    <q-item-section>
                        <Create />
                    </q-item-section>
                </q-item>
            </q-list>
        </scroll-area>
    </DashboardLayout>
</template>
