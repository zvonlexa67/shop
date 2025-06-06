<script setup lang="ts">
import SiteLayout from '@/layouts/SiteLayout.vue'

interface Props {
  categories: string[]
}

const props = defineProps<Props>()

</script>

<template>
<site-layout >
  <pre class="q-pa-xl">
  {{ props.categories }}
  </pre>
</site-layout>
</template>