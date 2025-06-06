<script setup lang="ts">
import { ref, watch } from 'vue'
import type { NavRoute, KeySessionStoreType } from '@/types'
import { WSSR } from '@/composables/useSessionStore'

const props = defineProps<{
    navroute: NavRoute,
    ml: number,
}>()

const expUseful = ref(false)
const itemExpSideBar = ref<Record<string, boolean>>({})
const keyExpSideBar = ref<KeySessionStoreType>('keyExpSideBar')

const findNavRouteToChildren = (): boolean => {
    if (WSSR.has(keyExpSideBar)) {
        itemExpSideBar.value = WSSR.load(keyExpSideBar)

        if(itemExpSideBar.value.hasOwnProperty(props.navroute.name)) {
            return itemExpSideBar.value[props.navroute.name]
        }
    }

    itemExpSideBar.value[props.navroute.name] = false
    WSSR.write(keyExpSideBar, itemExpSideBar.value)

    return false
}

expUseful.value = findNavRouteToChildren()

watch(expUseful, (newValue) => {
    if (WSSR.has(keyExpSideBar)) {
        itemExpSideBar.value = WSSR.load(keyExpSideBar)
        itemExpSideBar.value[props.navroute.name] = itemExpSideBar.value.hasOwnProperty(props.navroute.name) ? newValue : false
        WSSR.write(keyExpSideBar, itemExpSideBar.value)
    } else {
        itemExpSideBar.value[props.navroute.name] = false
        WSSR.write(keyExpSideBar, itemExpSideBar.value)
    }
})

</script>

<template>
    <q-expansion-item
        v-model="expUseful"
        dense
        expand-icon-class="text-mutan"
        :style="'margin-left: ' + ml + 'px'">
        <template v-slot:header>
            <q-item-section avatar>
                <component :is="props.navroute.icon" :absoluteStrokeWidth="true" />
            </q-item-section>
            <q-item-section>
                {{ props.navroute.title }}
            </q-item-section>
        </template>
        <slot />
    </q-expansion-item>
</template>

<style lang="sass">
.q-item__section--side > i.q-icon
	font-size: 16px
</style>

