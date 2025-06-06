<script setup lang="ts">
import { computed, ref } from 'vue';
import type { TreeNode } from './types';
import TreeNodeCom from './TreeNode.vue';

const props = defineProps<{
  modelValue: TreeNode[];
}>();

const emit = defineEmits(['update:modelValue']);

const treeData = computed({
  get: () => props.modelValue,
  set: (value) => emit('update:modelValue', value)
});

// Drag-and-drop состояние
const dragState = ref({
  draggedNode: null as TreeNode | null,
  sourceTree: null as HTMLElement | null,
  targetNode: null as TreeNode | null
});

// Вспомогательные функции
function findNode(tree: TreeNode[], id: string): TreeNode | null {
  for (const node of tree) {
    if (node.id === id) return node;
    if (node.children) {
      const found = findNode(node.children, id);
      if (found) return found;
    }
  }
  return null;
}

function removeNode(tree: TreeNode[], id: string): boolean {
  const index = tree.findIndex(n => n.id === id);
  if (index >= 0) {
    tree.splice(index, 1);
    return true;
  }

  for (const node of tree) {
    if (node.children && removeNode(node.children, id)) {
      return true;
    }
  }
  return false;
}

// Обработчики событий
function onDragStart(node: TreeNode, event: DragEvent) {
  console.log('onDragStart')
  console.log(node)

  dragState.value.draggedNode = node;
  dragState.value.sourceTree = event.currentTarget as HTMLElement;
  event.dataTransfer?.setData('text/plain', node.id);
}

function onDragOver(node: TreeNode, event: DragEvent) {
  event.preventDefault();
  dragState.value.targetNode = node;
}

function onDrop(tree: TreeNode[], event: DragEvent) {
  event.preventDefault();

  console.log('onDrop')
  console.log(tree)
  console.log(event)
    
  const { draggedNode, targetNode } = dragState.value;
  if (!draggedNode || !targetNode) return;

  // Не допускаем перенос узла в самого себя или своего потомка
  if (draggedNode.id === targetNode.id || 
      (draggedNode.children && findNode(draggedNode.children, targetNode.id))) {
    return;
  }

  // Удаляем узел из исходного положения
  const newTree = JSON.parse(JSON.stringify(treeData.value));
  removeNode(newTree, draggedNode.id);

  // Добавляем узел в новое положение
  if (!targetNode.children) {
    targetNode.children = [];
  }
  targetNode.children.push(draggedNode);

  treeData.value = newTree;
  resetDragState();
}

function resetDragState() {
  dragState.value = {
    draggedNode: null,
    sourceTree: null,
    targetNode: null
  };
}
</script>

<template>
  <div 
    class="tree"
    @dragleave="resetDragState"
    @dragend="resetDragState"
  >
    <TreeNodeCom
      v-for="node in treeData"
      :key="node.id"
      :node="node"
      @drag-start="onDragStart"
      @drag-over="onDragOver"
      @drop="onDrop"
    />
  </div>
</template>

<style scoped>
.tree {
  min-height: 300px;
  border: 1px dashed #ccc;
  padding: 10px;
  margin: 10px;
}
</style>