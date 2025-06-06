<script setup lang="ts">
import { ref, inject, watch } from 'vue'
import type { Item } from '@/types'
import { DragDropItems } from '@/components/dragdrop'
import { InputSelect } from '@/components/form/input'
import { Btn } from '@/components/form/button'
import type { KeySessionStoreType } from '@/types'
import { WSSR } from '@/composables/useSessionStore'
import axios from 'axios'

interface SmartInject {
  cat: any
}

const injected = inject<SmartInject>('smart')

if (!injected) {
  throw new Error('Injection "smart" not found')
}

const { cat } = injected

const keySelectSmart = ref<KeySessionStoreType>('keySelectSmart')

const group = ref<Item[]>([])
const select = ref<Item>({id: 0, title: ''})

const todoItems = ref<Item[]>([])
const doneItems = ref<Item[]>([])

// const selected = (group: Partial<Item> | undefined) => {
//   console.log(group?.id)
//   console.log(group?.title)
// }

watch(select, (val: Item) => {
  loadItems(val.id)
  WSSR.write(keySelectSmart, val)
})

const loadItems = async (group_id: number) => {
  try {
    const { data } = await axios.get(route('dashboard.api.category.smart', { cat_id: cat.value.id, gr_id: group_id }))

    todoItems.value = data.todo
    doneItems.value = data.done

  } catch (error) {
    console.log(error)
  }
}

const saveItems = async () => {
  const todoIds: number[] =  []
  todoItems.value.map((item) => todoIds.push(item.id))

  const doneIds: number[] =  []
  doneItems.value.map((item) => doneIds.push(item.id))

  try {
    const { data } = await axios.post(route('dashboard.api.category.syncsmart'), { id: cat.value.id, todoIds: todoIds, doneIds: doneIds })

  } catch (error) {
    console.log(error)
  }
}

const init = async () => {
  try {
    const { data } = await axios.get(route('dashboard.api.characteristic.groups'))
    
    group.value = data
    
    if (WSSR.has(keySelectSmart)) {
      select.value = WSSR.load(keySelectSmart)
    } else {
      select.value = group.value[0]
      WSSR.write(keySelectSmart, select.value)
    }
  } catch (error) {
    console.log(error)
  }
}

init()

</script>

<template>
  <q-list>
    <q-item class="justify-center">
      <q-item-section class="width-60">
        <q-list>
          <q-item>
            <q-item-section>
              <input-select 
                :options="group" 
                v-model="select" 
                label="Группы характеристик" 
                option-value="id" 
                option-label="title"
                />
                <!-- @update:model-value="selected" -->
            </q-item-section>
          </q-item>
          <q-item>
            <q-item-section>
              <drag-drop-items 
                v-model:todoItems="todoItems" 
                v-model:doneItems="doneItems"
                todo-label="Характеристики"
                done-label="Установленные"
              />
            </q-item-section>
          </q-item>
          <q-item>
            <q-item-section>
              <btn label="Сохранить" @click="saveItems" >
                <q-tooltip>Сохранить изменения в категории</q-tooltip>
              </btn>
            </q-item-section>
          </q-item>
        </q-list>
      </q-item-section>
    </q-item>
  </q-list>
</template>
