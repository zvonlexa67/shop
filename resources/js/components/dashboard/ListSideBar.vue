<script setup lang="ts">
import type { NavRoute } from '@/types'
import { NavSideBar } from '@/components/dashboard'

defineProps<{
  arr_navroute: NavRoute[],
}>()
</script>

<template>
  <q-list dense padding class="q-pa-none">
    <nav-side-bar :arr_navroute="arr_navroute" :ml="0"/>
  </q-list>
</template>
