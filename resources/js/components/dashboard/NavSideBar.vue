<script setup lang="ts">
import { ContextSideBar } from '@/components/dashboard'
import type { NavRoute } from '@/types'

interface Props {
  arr_navroute: NavRoute[],
  ml: number,
}

defineProps<Props>()
</script>

<template>
  <context-side-bar v-for="navroute in arr_navroute" :key="navroute.name" :navroute="navroute" :ml="ml" />
</template>
