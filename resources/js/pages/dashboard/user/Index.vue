<script setup lang="ts">
import DashboardLayout from '@/layouts/DashboardLayout.vue'
import { provide, ref, onMounted, onUpdated } from 'vue'
import { useForm, router } from '@inertiajs/vue3'
import type { User } from '@/types'

import Update from './Update.vue'
import Create from './Create.vue'
import List from './List.vue'

interface StrictFormData extends User {
    password: string | null,
    password_confirmation: string | null,
    _method: string
}

type FormDataType = StrictFormData & Record<string, any>

type ComponentKey = 'List' | 'Update' | 'Create'

const props = defineProps<{
    users: User[] | null,
    user: User | null,
}>()

//   console.log('props.users')

const tagComponent = { List, Update, Create }
const isComponent = ref<ComponentKey>('List')
const rows = ref<User[]>([])

const form = useForm<FormDataType>({
    id: 0,
    name: null,
    email: null,
    email_verified_at: null,
    created_at: null,
    updated_at: null,
    password: null,
    password_confirmation: null,
    _method: 'post'
})

const resetForm = () => {
    form.id = 0
    form.name = null
    form.email = null
    form.email_verified_at = null
    form.created_at = null
    form.updated_at = null
    form.password = null
    form.password_confirmation = null
    form._method = 'POST'
}

const applayForm = () => {
    form.id = props.user?.id ?? 0
    form.name = props.user?.name ?? null
    form.email = props.user?.email ?? null
    form.email_verified_at = props.user?.email_verified_at ?? null
    form.created_at = props.user?.created_at ?? null
    form.updated_at = props.user?.updated_at ?? null
    form.password = null
    form.password_confirmation = null
    form._method = 'POST'
}

onMounted(() => {
	rows.value = props.users ?? []

    if(props.user) {
      applayForm()
      isComponent.value = 'Update'
    }
})

onUpdated(() => {
    rows.value = props.users ?? []
})

const toggleCreate = () => {
    resetForm()
    isComponent.value = 'Create'
}

const toggleUpdate = (user_id: number) => {
    router.get(route('dashboard.users.index', { user_id: user_id }), {}, {
		preserveScroll: true,
      	preserveState: true,
	    	only: ['error', 'user'],
    	  	onSuccess: () => {
        		applayForm()
        		isComponent.value = 'Update'
      		}
	    }
	)
}

const onUpdate = () => {
    form._method = 'PUT'
    form.post(route('dashboard.users.update'), {
      	preserveScroll: true,
      	preserveState: true,
      	only: ['error', 'users', 'user'],
      	onSuccess: () => {
        	applayForm()
        	isComponent.value = 'Update'
      	}
    })
  }

const onCreate = () => {
    form._method = 'POST'
    form.post(route('dashboard.users.store'), {
    	  preserveScroll: true,
      	preserveState: true,
	      only: ['error', 'users', 'user'],
    	  onSuccess: () => {
        	applayForm()
        	isComponent.value = 'Update'
      	}
    })
}

const onDestroy = (user_id: number) => {
    form._method = 'DELETE'
    router.delete(route('dashboard.users.destroy', {user_id: user_id}), {
	    preserveState: true,
    	preserveScroll: true,
      	only: ['errors', 'users'],
        onBefore: () => confirm('Внимание!!! после удаления данные не подлежат востановлении, продолжить удаление...'),
      	onSuccess: () => {
        	resetForm()
        	isComponent.value = 'List'
      	}
    })
}

const onList = () => {
    router.get(route('dashboard.users.index', { user_id: 0 }), {})
}

provide('list', { rows, toggleCreate, toggleUpdate, onDestroy })
provide('update', { form, onUpdate, applayForm, onList })
provide('create', { form, onCreate, resetForm, onList})

</script>

<template>
  <DashboardLayout>
    <!-- <q-scroll-area style="height: calc(100vh - 120px)"> -->
      <component :is="tagComponent[isComponent]" />
    <!-- </q-scroll-area> -->
  </DashboardLayout>
</template>
