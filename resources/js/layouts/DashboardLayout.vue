<script setup lang="ts">
import { route } from 'ziggy-js'
import { router, usePage } from '@inertiajs/vue3'
import { ref, provide, toRaw } from 'vue'
import { ListSideBar } from '@/components/dashboard'
import { ScrollArea } from '@/components/design'
import { WSSR } from '@/composables/useSessionStore'
import {
  LayoutDashboard,
  Users,
  ContactRound,
  Mails,
  Folders,
  Ruler,
  Palette,
  Dribbble,
  TableProperties,
  Proportions,
  Barcode,
} from 'lucide-vue-next';
import type { NavRoute, KeySessionStoreType } from '@/types'

const keyZiggyAs  = ref<KeySessionStoreType>('keyZiggyAs')
const keyActiveNavRoute = ref<KeySessionStoreType>('keyActiveNavRoute')
const keyExpSideBar = ref<KeySessionStoreType>('keyExpSideBar')

const isProcessing = ref(false)
const NameNavRoute = ref('')
let timeout: any = null

const as = usePage().props.ziggy.as
const wssrAs = WSSR.load(keyZiggyAs)

if((wssrAs === null) || (wssrAs !== as)) {
  WSSR.remove(keyZiggyAs)
  WSSR.remove(keyActiveNavRoute)
  WSSR.remove(keyExpSideBar)
}

router.on('start', () => {
  // console.log(`Starting a visit to ${event.detail.visit.url}`)
  timeout = setTimeout(() => isProcessing.value = true, 250)
})

router.on('finish', () => {
  clearTimeout(timeout)
  isProcessing.value = false
})

const widthLeftDrawer = ref(300)

const leftDrawerOpen = ref(false)
const rightDrawerOpen = ref(false)

const toggleLeftDrawer = () => leftDrawerOpen.value = !leftDrawerOpen.value
const toggleRightDrawer = () => rightDrawerOpen.value = !rightDrawerOpen.value

const ActiveNavRoute = ref()

const ItemsNavRoute: NavRoute[] = [
  {
    title: 'Панель',
    uri: 'dashboard.dashboard',
    name: 'dashboard',
    icon: LayoutDashboard,
    params: { p1: 10, p2: 20 },
    method: 'get',
    children: [],
  },
  {
    title: 'Пользователи',
    name: 'users',
    icon: Users,
    children: [
      {
        title: 'Список',
        name: 'list',
        uri: 'dashboard.users.index',
        icon: ContactRound,
        params: { user_id: 0 },
        method: 'get',
        children: [],
      },
      {
        title: 'Рассылки',
        name: 'newsletters',
        uri: 'dashboard.dashboard',
        icon: Mails,
        params: {},
        method: 'get',
        children: [],
      },
    ],
  },
  {
    title: 'Справочники',
    name: 'directories',
    icon: Folders,
    children: [
      {
        title: 'Слайды',
        name: 'slides',
        uri: 'dashboard.slides.index',
        icon: ContactRound,
        params: {},
        method: 'get',
        children: [],
      },
      {
        title: 'Бренд',
        name: 'brand',
        uri: 'dashboard.brand.index',
        icon: Dribbble,
        params: {},
        method: 'get',
        children: [],
      },
      {
        title: 'Цвет',
        name: 'color',
        uri: 'dashboard.color.index',
        icon: Palette,
        params: {},
        method: 'get',
        children: [],
      },
      {
        title: 'Размер',
        name: 'ruler',
        uri: 'dashboard.dimension.index',
        icon: Ruler,
        params: {},
        method: 'get',
        children: [],
      },
    ],
  },
  {
    title: 'Характеристики',
    uri: 'dashboard.characteristic.index',
    name: 'characteristic',
    icon: Proportions,
    params: { characteristic_id: 0 },
    method: 'get',
    children: [],
  },
  {
    title: 'Категории',
    uri: 'dashboard.category.index',
    name: 'category',
    icon: TableProperties,
    params: { id: 1 },
    method: 'get',
    children: [],
  },
  {
    title: 'Товар',
    uri: 'dashboard.product.index',
    name: 'product',
    icon: Barcode,
    params: { product_id: 0 },
    // params: { category_id: 1, product_id: 0 },
    method: 'get',
    children: [],
  },
]

const ItemsNavRouteRight: NavRoute[] = []

// [
//     {
//         title: 'Проверить почту',
//         uri: 'verification.notice',
//         name: 'verification.notice',
//         icon: LayoutDashboard,
//         params: {},
//         method: 'get',
//         children: [],
//     },
//     {
//         title: 'Панель1',
//         name: 'dashboard1',
//         icon: LayoutDashboard,
//         params: {},
//         method: 'get',
//         children: [
//             {
//                 title: 'Панель_c1',
//                 name: 'dashboard',
//                 icon: LayoutDashboard,
//                 params: {},
//                 method: 'get',
//                 children: [
//                     {
//                         title: 'Панель login',
//                         name: 'login',
//                         uri: 'dashboard/{p1}/{p2}',
//                         icon: LayoutDashboard,
//                         params: {},
//                         method: 'get',
//                         children: [],
//                     },
//                     {
//                         title: 'Панель_c2',
//                         name: 'dashboard',
//                         uri: 'dashboard/{p1}/{p2}',
//                         icon: LayoutDashboard,
//                         params: { p1: 11, p2: 22 },
//                         method: 'get',
//                         children: [],
//                     },
//                 ],
//             },
//             {
//                 title: 'Панель_c2',
//                 name: 'dashboard',
//                 icon: LayoutDashboard,
//                 params: {},
//                 method: 'get',
//                 children: [],
//             },
//         ],
//     },
//     {
//         title: 'Панель2',
//         name: 'dashboard',
//         icon: LayoutDashboard,
//         params: {},
//         method: 'get',
//         children: [
//             {
//                 title: 'Панель_c1',
//                 name: 'dashboard',
//                 icon: LayoutDashboard,
//                 params: {},
//                 method: 'get',
//                 children: [],
//             },
//             {
//                 title: 'Панель_c2',
//                 name: 'dashboard',
//                 icon: LayoutDashboard,
//                 params: {},
//                 method: 'get',
//                 children: [],
//             },
//         ],
//     },
// ]

provide('activeBtnSideBar', { ActiveNavRoute, NameNavRoute })
</script>

<template>
  <q-layout view="hHh Lpr fFf">
    <q-header class="bg-gries text-white" height-hint="98">
      <q-toolbar>
        <div class="row items-center text-mutan" :style="{ width: widthLeftDrawer - 12 + 'px' }">
          <q-btn dense flat round @click="toggleLeftDrawer" class="text-mutan q-mr-md">
            <q-icon>
              <svg id="Table--Streamline-Carbon" xmlns="http://www.w3.org/2000/svg" stroke="currentColor"
                fill="none" viewBox="-0.5 -0.5 16 16" height="16" width="16">
                <desc>Table Streamline Icon: https://streamlinehq.com</desc>
                <defs></defs>
                <title>table</title>
                <path
                  d="M13.59375 2.34375a0.9375 0.9375 0 0 0 -0.9375 -0.9375H2.34375a0.9375 0.9375 0 0 0 -0.9375 0.9375v10.3125a0.9375 0.9375 0 0 0 0.9375 0.9375h10.3125a0.9375 0.9375 0 0 0 0.9375 -0.9375Zm-0.9375 0v1.875H2.34375V2.34375Zm0 10.3125H2.34375v-1.875h10.3125Zm0 -2.8125H2.34375v-1.875h10.3125Zm0 -2.8125H2.34375v-1.875h10.3125Z"
                  stroke-width="1">
                </path>
                <path id="_Transparent_Rectangle_" d="M0 0h15v15H0Z" fill="none" stroke-width="1"></path>
              </svg>
            </q-icon>
          </q-btn>
          <q-avatar class="q-mr-md">
            <img src="https://cdn.quasar.dev/logo-v2/svg/logo-mono-white.svg">
          </q-avatar>
          <div class="q-mr-md">
            <span class="text-h4">
              {{ $page.props.auth.user.name }}
            </span>
          </div>
        </div>
        <q-separator dark vertical inset />
        <span class="text-h4 q-ml-lg">
          {{ NameNavRoute }}
        </span>
        <slot name="select" />
        <q-space />
        <q-tabs align="left">
          <q-btn :href="route('index')" label="В Магазине" flat no-casp/>
          <q-route-tab to="/" label="Page Two" />
          <q-route-tab to="/" label="Page Three" />
        </q-tabs>
        <q-btn dense flat round @click="toggleRightDrawer" class="text-mutan">
          <q-icon>
            <svg id="Table--Streamline-Carbon" xmlns="http://www.w3.org/2000/svg" stroke="currentColor"
              fill="none" viewBox="-0.5 -0.5 16 16" height="16" width="16">
              <desc>Table Streamline Icon: https://streamlinehq.com</desc>
              <defs></defs>
              <title>table</title>
              <path
                d="M13.59375 2.34375a0.9375 0.9375 0 0 0 -0.9375 -0.9375H2.34375a0.9375 0.9375 0 0 0 -0.9375 0.9375v10.3125a0.9375 0.9375 0 0 0 0.9375 0.9375h10.3125a0.9375 0.9375 0 0 0 0.9375 -0.9375Zm-0.9375 0v1.875H2.34375V2.34375Zm0 10.3125H2.34375v-1.875h10.3125Zm0 -2.8125H2.34375v-1.875h10.3125Zm0 -2.8125H2.34375v-1.875h10.3125Z"
                stroke-width="1">
              </path>
              <path id="_Transparent_Rectangle_" d="M0 0h15v15H0Z" fill="none" stroke-width="1"></path>
            </svg>
          </q-icon>
        </q-btn>
      </q-toolbar>
    </q-header>
    <q-drawer show-if-above v-model="leftDrawerOpen" side="left" :width="widthLeftDrawer">
      <scroll-area class="fit bg-gries text-mutan">
        <list-side-bar :arr_navroute="ItemsNavRoute" />
      </scroll-area>
    </q-drawer>
    <q-drawer v-model="rightDrawerOpen" side="right" overlay bordered>
      <scroll-area class="fit bg-gries text-mutan">
        <list-side-bar :arr_navroute="ItemsNavRouteRight" />
        <p>{{ $page.props.auth }}</p>
      </scroll-area>
    </q-drawer>
    <q-page-container>
      <slot />
      <q-inner-loading :showing="isProcessing">
        <q-spinner-gears size="50px" color="gries" />
      </q-inner-loading>
    </q-page-container>
    <q-footer elevated class="bg-grey-8 text-white">
      <q-toolbar>
        <q-toolbar-title>
          <q-avatar>
            <img src="https://cdn.quasar.dev/logo-v2/svg/logo-mono-white.svg">
          </q-avatar>
          <div>Title</div>
          <slot name="footer" />
        </q-toolbar-title>
      </q-toolbar>
    </q-footer>
  </q-layout>
</template>

<style lang="sass">
body
  overflow: hidden !important
</style>
