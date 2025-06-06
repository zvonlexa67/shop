<script setup lang="ts">
import type { TreeNode } from './types';

defineProps<{
  node: TreeNode;
}>();

const emit = defineEmits(['drag-start', 'drag-over', 'drop']);
</script>

<template>
  <div
    class="tree-node"
    draggable="true"
    @dragstart="(e) => emit('drag-start', node, e)"
    @dragover="(e) => { e.preventDefault(); emit('drag-over', node, e) }"
    @drop="(e) => emit('drop', node, e)"
  >
    <div class="node-content">
      {{ node.text }}
    </div>
    <div v-if="node.children" class="children">
      <TreeNode
        v-for="child in node.children"
        :key="child.id"
        :node="child"
        @drag-start="(n, e) => emit('drag-start', n, e)"
        @drag-over="(n, e) => emit('drag-over', n, e)"
        @drop="(n, e) => emit('drop', n, e)"
      />
    </div>
  </div>
</template>

<style scoped>
.tree-node {
  margin: 5px 0;
  padding: 5px;
  border: 1px solid #eee;
  cursor: move;
}

.node-content {
  padding: 5px;
  background: #f5f5f5;
}

.children {
  margin-left: 20px;
  padding-left: 10px;
  border-left: 2px solid #ddd;
}

.tree-node.drag-over {
  background-color: #e0f7fa;
}
</style>