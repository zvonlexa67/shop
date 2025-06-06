<script setup lang="ts">
import { ref, inject, onMounted, onUpdated } from 'vue'

interface InjectList {
	cats: any
	filterTree: any
	selected: any
	onNodeSelected: () => void
}

  const treeRef = ref()
  
  const injected = inject<InjectList>('list')

  if (!injected) {
	  throw new Error('Injection "list" not found')
  }

  const { cats, filterTree, selected, onNodeSelected } = injected

  onMounted(() => {
    // treeRef.value.expandAll(selected.value)
  })

  onUpdated(() => {
    treeRef.value.expandAll(selected.value)
  })
</script>

<template>
<q-tree
    ref="treeRef"
    icon="fa-solid fa-chevron-right"
    :nodes="cats"
    node-key="id"
    label-key="title"
    text-color="gries"
    class="q-size-font-tree"
    selected-color="lblue"
    :filter="filterTree"
    v-model:selected="selected"
    @update:selected="onNodeSelected"
    default-expand-all
/>
</template>

<style lang="sass" scoped>
.q-size-font-tree
	font-size: small
</style>
