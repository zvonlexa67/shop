<script setup lang="ts">
import { ref } from 'vue';
import TreeWithDnD from './TreeWithDnD.vue';
import type { TreeNode } from './types';

const leftTree = ref<TreeNode[]>([
  {
    id: '1',
    text: 'Node 1',
    children: [
      { id: '1-1', text: 'Node 1.1' },
      { id: '1-2', text: 'Node 1.2',
        children: [
          { id: '1-2-1', text: 'Node 1.2.1' },
        ]
      }
    ]
  },
  {
    id: '2',
    text: 'Node 2'
  }
]);

const rightTree = ref<TreeNode[]>([
  {
    id: '3',
    text: 'Node 3',
    children: [
      { id: '3-1', text: 'Node 3.1' }
    ]
  }
]);
</script>

<template>
  <div class="tree-container">
    <TreeWithDnD 
      v-model="leftTree" 
      class="tree-wrapper"
    />
    <TreeWithDnD 
      v-model="rightTree" 
      class="tree-wrapper"
    />
  </div>
</template>

<style scoped>
.tree-container {
  display: flex;
  gap: 20px;
}

.tree-wrapper {
  flex: 1;
  border: 1px solid #ddd;
  padding: 15px;
  min-height: 500px;
}
</style>