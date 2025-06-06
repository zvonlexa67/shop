<script setup lang="ts">
import { route } from 'ziggy-js'
import { ref } from 'vue'
import { usePage, Link, router } from '@inertiajs/vue3'
import { BtnLink, ImgLink, BtnLucide } from '@/components/form/button'
import { NotebookTabs } from 'lucide-vue-next'
import type { Category } from '@/types'
import { ListCategory } from '@/layouts/site/category'

const categories = usePage().props.categories as Category[]

// const { route } = usePage().props

const catalogDialog = ref(false)

const leftDrawerOpen = ref(false)
const rightDrawerOpen = ref(false)

const logo = "http://localhost/storage/images/template08-logo.png"
const searchText = ref<string>('')


const toggleLeftDrawer =  () => { 
  leftDrawerOpen.value = !leftDrawerOpen.value
}

const toggleRightDrawer = () => {
  rightDrawerOpen.value = !rightDrawerOpen.value
}

const login = () => {
  router.visit(route('login'))
}
</script>

<template>
<div class="bg-mutan common-layout-max-width">
  <q-layout view="hHh lpR lFr">
    <q-header bordered class="q-pa-none rc-font border-gries" height-hint="98">
			<div class="bg-gries text-mutan">
				<q-toolbar class="bg-gries text-mutan q-pa-none common-layout-max-width row justify-startr items-center">
					<div class="col-1 self-center">
						<q-btn flat class="q-px-none q-btn-bg-none" no-caps>
							<div class="row items-center no-wrap">
								<q-icon class="shake">
									<svg xmlns="http://www.w3.org/2000/svg" stroke="currentColor" fill="none"
										viewBox="0 0 24 24" id="Location-Pin-1--Streamline-Cyber" height="24"
										width="24">
										<desc>Location Pin 1 Streamline Icon: https://streamlinehq.com</desc>
										<path stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
											d="M16.5 19.5h3l4 2 -4 2h-15l-4 -2 4 -2h3" stroke-width="1"></path>
										<path stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
											d="M12 21.5 5.5 10.087V4.609L12 0.5l6.5 4.109v5.478L12 21.5Z"
											stroke-width="1"></path>
										<path stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
											d="m9.5 5.93403 2.5 -1.555 2.5 1.555v2.639L12 10.129 9.5 8.57303v-2.639Z"
											stroke-width="1">
										</path>
									</svg>
								</q-icon>
								<div class="text-center q-ml-sm shake">Москва</div>
							</div>
						</q-btn>
					</div>
					<div class="col-2 self-center">
						<q-toolbar-title class="text-center">Start router</q-toolbar-title>
					</div>
					<div class="col-4 self-center">
						<q-btn-group flat class="full-width row">
              <btn-link href="/" label="О нас" link-class="col-3" class="text-mutan bg-gries full-width" />
              <btn-link href="/" label="Новости" link-class="col-3" class="text-mutan bg-gries full-width" />
              <btn-link href="/" label="Оплата" link-class="col-3" class="text-mutan bg-gries full-width" />
              <btn-link href="/" label="Доставка" link-class="col-3" class="text-mutan bg-gries full-width" />
						</q-btn-group>
					</div>
					<div class="col-5 self-center text-end">
						<q-btn v-if="!$page.props.auth.user" flat class="q-px-none q-btn-bg-none" @click="login" no-caps>
							<div class="row items-center no-wrap">
								<q-icon class="shake">
									<svg xmlns="http://www.w3.org/2000/svg" stroke="currentColor" fill="none"
										viewBox="0 0 24 24" id="User-2--Streamline-Guidance-Free" height="24"
										width="24">
										<desc>User 2 Streamline Icon: https://streamlinehq.com</desc>
										<path
											d="M21.435 16.677V23.5H2.565v-6.823S6.192 14.5 12 14.5c5.806 0 9.435 2.177 9.435 2.177Z"
											stroke-width="1"></path>
										<path
											d="M6.92 5.58A5.084 5.084 0 0 1 12.005 0.5a5.073 5.073 0 0 1 5.075 5.08c0 3.89 -4.974 6.533 -4.974 6.533h-0.214S6.919 9.47 6.919 5.58Z"
											stroke-width="1"></path>
									</svg>
								</q-icon>
								<div class="text-center q-ml-sm shake">Вход</div>
							</div>
						</q-btn>
						<q-btn v-else flat class="q-px-none q-btn-bg-none" @click="toggleRightDrawer" no-caps>
							<div class="row items-center no-wrap">
								<q-icon class="shake">
									<svg xmlns="http://www.w3.org/2000/svg" stroke="currentColor" fill="none"
										viewBox="0 0 24 24" id="User-2--Streamline-Guidance-Free" height="24"
										width="24">
										<desc>User 2 Streamline Icon: https://streamlinehq.com</desc>
										<path
											d="M21.435 16.677V23.5H2.565v-6.823S6.192 14.5 12 14.5c5.806 0 9.435 2.177 9.435 2.177Z"
											stroke-width="1"></path>
										<path
											d="M6.92 5.58A5.084 5.084 0 0 1 12.005 0.5a5.073 5.073 0 0 1 5.075 5.08c0 3.89 -4.974 6.533 -4.974 6.533h-0.214S6.919 9.47 6.919 5.58Z"
											stroke-width="1"></path>
									</svg>
								</q-icon>
								<div class="text-center q-ml-sm shake">{{ $page.props.auth.user.name }}</div>
							</div>
						</q-btn>
					</div>
				</q-toolbar>
			</div>
			<div class="bg-white">
				<q-toolbar class="text-mutan q-pa-none common-layout-max-width row justify-between items-center">
					<div class="col-3 row">
            <img-link href="/" :src="logo" height="50px" width="150px" />
						<q-btn flat square class="bg-bluies col-5" @click="toggleLeftDrawer">
							<div class="row justify-evenly items-center no-wrap full-width">
                <NotebookTabs 
                  :absolute-stroke-width="true" 
                  :stroke-width="1.5" 
                  :size="24"
                />
								<div class="text-center q-ml-sm">Каталог</div>
							</div>
						</q-btn>
					</div>
					<div class="col-8">
						<q-input input-class="no-outline" dense bottom-slots item-aligned color="gries"
							v-model="searchText" label="Введите наименование или артикуль">
							<template v-slot:append>
								<q-icon>
									<svg id="Magnifying-Glass--Streamline-Atlas" xmlns="http://www.w3.org/2000/svg"
										stroke="currentColor" fill="none" viewBox="-0.5 -0.5 16 16" height="16"
										width="16">
										<desc>Magnifying Glass Streamline Icon: https://streamlinehq.com</desc>
										<defs></defs>
										<path
											d="M0.9375 5.7125a4.7749999999999995 4.7749999999999995 0 1 0 9.549999999999999 0 4.7749999999999995 4.7749999999999995 0 1 0 -9.549999999999999 0"
											stroke-miterlimit="10" stroke-width="1"></path>
										<path d="m14.0625 14.0625 -5.06875 -5.06875" stroke-miterlimit="10"
											stroke-width="1"></path>
									</svg>
								</q-icon>
							</template>
						</q-input>
					</div>
					<div class="col-1">
						<q-btn-group flat class="full-width row">
							<Link href="/" class="text-mutan bg-gries offset-2 col-4">
							<q-btn flat square class="full-width q-pa-none">

								<svg xmlns="http://www.w3.org/2000/svg" stroke="currentColor" fill="none"
									viewBox="0 0 24 24" id="Business-Scale-4" height="24" width="24">
									<desc>Business Scale 4 Streamline Icon: https://streamlinehq.com</desc>
									<path stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
										d="M2.06935 10.9547 21.9307 2.59198" stroke-width="1"></path>
									<path stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
										d="M12 3.63733V21.408" stroke-width="1"></path>
									<path stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
										d="M8.86395 21.408H15.136" stroke-width="1"></path>
									<path stroke-linejoin="round" stroke-miterlimit="10" d="M4.68265 9.80481V15.136"
										stroke-width="1">
									</path>
									<path stroke-linejoin="round" stroke-miterlimit="10" d="M19.3174 3.74188v6.1674"
										stroke-width="1">
									</path>
									<path stroke-linejoin="round" stroke-miterlimit="10"
										d="M4.68264 19.3173 0.501343 15.136H8.86394l-4.1813 4.1813Z" stroke-width="1">
									</path>
									<path stroke-linejoin="round" stroke-miterlimit="10"
										d="m19.3173 14.0907 -4.1814 -4.1814h8.3627l-4.1813 4.1814Z" stroke-width="1">
									</path>
								</svg>

								<q-badge color="red" floating>4</q-badge>
								<q-tooltip transition-show="rotate" transition-hide="rotate"
									class="bg-orange text-grey-9">Перейти в сравнение</q-tooltip>
							</q-btn>
							</Link>
							<Link href="/" class="text-mutan bg-gries offset-2 col-4">
							<q-btn flat square class="full-width q-pa-none">
								<svg xmlns="http://www.w3.org/2000/svg" stroke="currentColor" fill="none"
									viewBox="0 0 24 24" id="Shopping-Cart-3--Streamline-Cyber" height="24" width="24">
									<desc>Shopping Cart 3 Streamline Icon: https://streamlinehq.com</desc>
									<path stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
										d="M3.5 17.5h12l4.5 -16 3.5 -1" stroke-width="1"></path>
									<path stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
										d="m4.5 19.5 -2 2 2 2 2 -2 -2 -2Z" stroke-width="1"></path>
									<path stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
										d="m13.5 19.5 -2 2 2 2 2 -2 -2 -2Z" stroke-width="1"></path>
									<path stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
										d="M18.873 5.5H0.5l2 7.5 13.693 2.029" stroke-width="1"></path>
								</svg>
								<q-badge color="red" floating>400 &#8381;</q-badge>
								<q-tooltip transition-show="rotate" transition-hide="rotate"
									class="bg-orange text-grey-9">
									Перейти в корзину
								</q-tooltip>
							</q-btn>
							</Link>
						</q-btn-group>
					</div>
				</q-toolbar>
			</div>
		</q-header>

    <q-drawer v-model="leftDrawerOpen" side="left" overlay bordered :width="300">
      <list-category :categories="categories" />
    </q-drawer>

    <q-drawer v-model="rightDrawerOpen" side="right" overlay bordered>
      <!-- drawer content -->
    </q-drawer>

    <q-page-container>
      <slot />
      <!-- <router-view /> -->
    </q-page-container>

    <!-- <q-footer bordered class="bg-grey-8 text-white">
      <q-toolbar>
        <q-toolbar-title>
          <q-avatar>
            <img src="https://cdn.quasar.dev/logo-v2/svg/logo-mono-white.svg">
          </q-avatar>
          <div>Title</div>
        </q-toolbar-title>
      </q-toolbar>
    </q-footer> -->

  	<q-footer bordered class="bg-gries text-mutan rc-font">
			<q-toolbar class="q-pa-none common-layout-max-width row justify-between items-center">
				<div class="col-4">
					<ImgLink height="50px" width="150px" href="/" :src="logo" />
				</div>
				<div class="col-4">
					<q-btn-group flat class="full-width row">
						<btn-link class="text-mutan bg-gries full-width" link-class="col-3" href="/" label="О нас" />
						<btn-link class="text-mutan bg-gries full-width" link-class="col-3" href="/" label="Новости" />
						<btn-link class="text-mutan bg-gries full-width" link-class="col-3" href="/" label="Оплата" />
						<btn-link class="text-mutan bg-gries full-width" link-class="col-3" href="/" label="Доставка" />
					</q-btn-group>
				</div>
				<div class="offset-2 col-4">
					<q-btn-group flat class="full-width row justify-start items-center">
						<btn-lucide class="q-pa-none text-mutan bg-gries col-1 q-btn-bg-none shake" svg="Facebook"	width="1.5" :size="24" />
						<btn-lucide class="q-pa-none text-mutan bg-gries col-1 q-btn-bg-none shake" svg="Twitter"	width="1.5" :size="24" />
						<btn-lucide class="q-pa-none text-mutan bg-gries col-1 q-btn-bg-none shake" svg="Phone"	width="1.5" :size="24" />
						<btn-lucide class="q-pa-none text-mutan bg-gries col-1 q-btn-bg-none shake" svg="Send"	width="1.5" :size="24" />
						<btn-lucide class="q-pa-none text-mutan bg-gries col-1 q-btn-bg-none shake" svg="Linkedin"	width="1.5" :size="24" />
					</q-btn-group>
				</div>
			</q-toolbar>
		</q-footer>

  </q-layout>


</div>
</template>

<style lang="sass" scoped>
.common-layout-max-width
	max-width: 1440px
	height: 50px
	margin: auto
.size-footer-logo
	height: 50px
	width: 150px
</style>


