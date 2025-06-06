<script setup lang="ts">
import { ref, inject } from 'vue'

interface InjectDescription {
	form: any
	storeDescription: () => void
}

const injected = inject<InjectDescription>('description')

if (!injected) {
	throw new Error('Injection "description" not found')
}

const { form, storeDescription } = injected

const defnitions = ref(
  {
    save: {
      tip: 'Сохранить все изменения',
      icon: 'fa-regular fa-floppy-disk',
      // label: 'Сохранить',
      label: '',
      handler: storeDescription
    }
  }
)

const toolbar = ref(
  [
    [ 'left', 'center', 'right', 'justify' ], 
    [ 'bold', 'italic', 'underline', 'strike' ], 
    [ 'undo', 'redo' ],
    [ 'save' ],
  ]
)
 
</script>

<template>
<q-editor 
	square 
	v-model="form.description" 
	min-height="12rem" 
	height="calc(100vh - 285px)" 
	class="bg-mutan q-ma-md" 
	:definitions="defnitions" 
	:toolbar="toolbar"
/>
</template>
