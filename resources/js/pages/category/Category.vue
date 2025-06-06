<script setup>
	import { Link } from '@inertiajs/vue3'
	import { inject } from 'vue'

	defineOptions({
		name: 'Category'
	})

	const props = defineProps({
		list_categories: Array,
		breadcrumbs: Array,
	})

	const { list_categories, breadcrumbs } = inject('category')
</script>

<template>
	<div class="q-pa-md q-gutter-sm">
		<q-breadcrumbs class="text-gries">
			<div class="q-breadcrumbs__separator">/</div>
			<Link href="/">
					<q-breadcrumbs-el label="Главная страница" icon="fa-solid fa-house" />
			</Link>
			<template v-for="breadcrumb in breadcrumbs" :key="breadcrumb.id">
				<div :id="breadcrumb.id" class="q-breadcrumbs__separator">/</div>
				<Link :href="'/category/' + breadcrumb.slug">
					<q-breadcrumbs-el :label="breadcrumb.title" icon="fa-solid fa-table-list" />
				</Link>
			</template>
		</q-breadcrumbs>
	</div>
	<div class="row items-start justify-between">
		<q-intersection v-for="category in list_categories" :key="category.id" transition="scale" class="inter-section">
			<Link :href="'/category/' + category.slug">
				<q-card class="q-ma-none q-mb-md card-catalog">
					<q-card-section class="card-img__catalog no-border q-pa-xs">
						<img :src="category.picture_image">
					</q-card-section>
					<q-card-section>
						<div class="text-h6">{{ category.title }}</div>
						<div class="text-subtitle2">{{ category.slug }}</div>
					</q-card-section>
					<q-card-section class="q-pt-none">
						Описание
					</q-card-section>
				</q-card>
			</Link>
		</q-intersection>
	</div>
</template>

<style lang="sass" scoped>
.inter-section
	height: 410px
	width: 270px
.card-catalog
	width: 270px
	height: 394px
	overflow: hidden
.card-img__catalog
	width: 100%
	height: 270px
	img
		object-fit: cover
		width: 100%
		height: 100%
</style>

