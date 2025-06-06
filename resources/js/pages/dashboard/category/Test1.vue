<script setup lang="ts">
import { ref } from 'vue'

interface TodoItem {
  id: number
  title: string
}

// Исходные данные
const todos = ref<TodoItem[]>([
  { id: 1, title: "Schedule perm" },
  { id: 2, title: "Rewind VHS tapes" },
  { id: 3, title: "Make change for the arcade" }
])

const dones = ref<TodoItem[]>([
  { id: 4, title: "Get disposable camera developed" },
  { id: 5, title: "Learn C++" },
  { id: 6, title: "Return Nintendo Power Glove" }
])

// Переменные для drag-and-drop
const dragItem = ref<TodoItem | null>(null)
const sourceList = ref<'todos' | 'dones' | null>(null)

// Обработчики drag-and-drop
function handleDragStart(item: TodoItem, list: 'todos' | 'dones') {

  console.log('handleDragStart')
  console.log(item)
  console.log(list)

  dragItem.value = item
  sourceList.value = list
}

function handleDragOver(e: DragEvent) {

  console.log('handleDragOver')

  e.preventDefault()
}

function handleDrop(targetList: 'todos' | 'dones') {
  if (!dragItem.value || !sourceList.value) return

  // Не делаем ничего, если элемент бросают в тот же список
  if (sourceList.value === targetList) return

  // Удаляем элемент из исходного списка
  if (sourceList.value === 'todos') {
    todos.value = todos.value.filter(item => item.id !== dragItem.value?.id)
  } else {
    dones.value = dones.value.filter(item => item.id !== dragItem.value?.id)
  }

  // Добавляем элемент в целевой список
  if (targetList === 'todos') {
    todos.value.push(dragItem.value)
  } else {
    dones.value.push(dragItem.value)
  }

  // Сбрасываем значения
  dragItem.value = null
  sourceList.value = null
}
</script>

<template>
  <div class="drag-drop-container">
    <ul 
      ref="todoList" 
      class="item-column"
      @dragover="handleDragOver"
      @drop="() => handleDrop('todos')"
    >
      <li 
        v-for="todo in todos" 
        :key="todo.id"
        draggable="true"
        @dragstart="() => handleDragStart(todo, 'todos')"
      >
        {{ todo.title }}
      </li>
    </ul>
    
    <ul 
      ref="doneList" 
      class="item-column"
      @dragover="handleDragOver"
      @drop="() => handleDrop('dones')"
    >
      <li 
        v-for="done in dones" 
        :key="done.id"
        draggable="true"
        @dragstart="() => handleDragStart(done, 'dones')"
      >
        {{ done.title }}
      </li>
    </ul>
  </div>
</template>

<style lang="sass" scoped>
.drag-drop-container
  display: flex
  gap: 20px

.item-column 
  border: 1px solid #ccc
  padding: 10px
  min-width: 200px
  min-height: 300px
  list-style: none

.item-column li 
  padding: 8px
  margin: 5px 0
  background-color: #f5f5f5
  cursor: move

.item-column li:hover 
  background-color: #e0e0e0
</style>