<script setup lang="ts">
import { router } from '@inertiajs/vue3'
import { route } from 'ziggy-js'
import type { NavRoute } from '@/types'
import { ExpSideBar, BtnSideBar, NavSideBar } from '@/components/dashboard'

interface Props {
	navroute: NavRoute,
	ml: number,
}

const props = withDefaults(defineProps<Props>(), { ml: 10 })

// @click="router.visit(route(navroute.uri, navroute.params), { method: navroute.method })"

// console.log(props.navroute)
// console.log(props.navroute.uri)
// console.log(props.navroute.params)
// console.log(!!props.navroute.uri && !!props.navroute.params)
// console.log(!!props.navroute.uri && !!props.navroute.params ? 'tttt' : 'ffff')

// console.log(!!props.navroute.uri ? route(props.navroute.uri , props.navroute.params) : '')
// console.log(props.navroute.uri ? route(props.navroute.uri , props.navroute.params) : '')

const onClick = () => {
	router.visit(
		props.navroute.uri ? route(props.navroute.uri , props.navroute.params) : '', 
		{ 
			method: props.navroute.method, 
			// only: ['name'],
			// except: ['quote','product'], 
		}
	)
}

</script>

<template>
	<btn-side-bar v-if="navroute.children.length === 0"
		:navroute="navroute"
		:ml="ml"
		@click="onClick"
	/>
	<exp-side-bar v-else :navroute="navroute" :ml="ml" >
		<nav-side-bar :arr_navroute="navroute.children" :ml="ml+10"/>
	</exp-side-bar>
</template>
