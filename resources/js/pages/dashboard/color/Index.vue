<script setup lang="ts">
  import DashboardLayout from '@/layouts/DashboardLayout.vue'
  import Update from './Update.vue'
  import Create from './Create.vue'
  import { ScrollArea } from '@/components/design'
  import { type Color } from '@/types'

  defineProps<{
    colors: Color[];
  }>()

</script>

<template>
    <DashboardLayout>
        <scroll-area style="height: calc(100vh - 120px);">
            <q-list>
                <q-item v-for="color in colors" :key="color.id">
                    <q-item-section style="flex-direction: inherit;">
                        <Update :color="color" />
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
