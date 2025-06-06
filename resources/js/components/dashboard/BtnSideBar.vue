<script setup lang="ts">
import { cn } from '@/lib/utils'
import type { NavRoute, KeySessionStoreType } from '@/types'
import { WSSR } from '@/composables/useSessionStore'
import { ref, inject, watch } from 'vue'

interface Props {
    navroute: NavRoute,
    ml: number,
}

interface ActiveBtnSideBar {
    ActiveNavRoute: any
    NameNavRoute: any
}

const props = defineProps<Props>()

const emit = defineEmits<{
    (e: 'onClick'): void
}>()

const injected = inject<ActiveBtnSideBar>('activeBtnSideBar')

if (!injected) {
    throw new Error('Injection "activeBtnSideBar" not found')
}

const { ActiveNavRoute, NameNavRoute } = injected
const keyActiveNavRoute = ref<KeySessionStoreType>('keyActiveNavRoute')
const keyZiggyAs  = ref<KeySessionStoreType>('keyZiggyAs')

const active = ref(false)

watch(ActiveNavRoute, (newValue) => {
    active.value = newValue == props.navroute.name ? true : false
})

const getActiveNavRoute = () => {
    if(WSSR.has(keyActiveNavRoute)) {
        return WSSR.load(keyActiveNavRoute) == props.navroute.name
    } else {
        ActiveNavRoute.value = props.navroute.name
        WSSR.write(keyActiveNavRoute, ActiveNavRoute.value)
        return true
    }
}

if (getActiveNavRoute()) {
    active.value = true
    NameNavRoute.value = props.navroute.title
}

const onClick = () => {
    active.value = true
    ActiveNavRoute.value = props.navroute.name
    WSSR.write(keyActiveNavRoute, ActiveNavRoute.value)
    WSSR.write(keyZiggyAs, props.navroute.uri)

    emit('onClick')
}
</script>

<template>
    <q-item
        dense
        clickable
        v-ripple
        :active-class="cn('text-gries bg-mutan')"
        @click="onClick"
        :active="active"
        :style="'margin-left: ' + ml + 'px'"
    >
        <q-item-section avatar>
            <component :is="navroute.icon" :absoluteStrokeWidth="true" />
        </q-item-section>
        <q-item-section>
            {{ navroute.title }}
        </q-item-section>
    </q-item>
</template>
