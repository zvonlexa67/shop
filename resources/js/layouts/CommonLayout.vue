<script setup lang="ts">
import { route } from 'ziggy-js'
import { ref, toRaw } from 'vue'
// import { ref, toRaw, onMounted, onBeforeUpdate, onUpdated} from 'vue'
import { usePage, Link, router } from '@inertiajs/vue3'

import { BtnLink, ImgLink, BtnLucide } from '@/components/form/button'

// import MenuLevel1 from '@/components/category/menu/MenuLevel1.vue'

// interface PageProps {
//   'auth': {
//     'user': {
//         // profile: {
//         //     [key: string]: unknown,
//         // },
//         [key: string]: unknown,
//     },
//     // 'role': string,
//   },
// }

// const page = usePage<PageProps>()
const page = usePage()

    // const userName = computed(() => page.props.user.name)
    // const posts = computed(() => page.props.posts)

// defineOptions({
// 	name: "CommonLayout",
// });

// const props = defineProps<{
// 	catalogs: Array,
// }>();

// const leftDrawerOpen = ref(false)
const rightDrawerOpen = ref(false)

// const toggleLeftDrawer = () => leftDrawerOpen.value = !leftDrawerOpen.value
const toggleRightDrawer = () => rightDrawerOpen.value = !rightDrawerOpen.value

// const catalogs = toRaw(usePage().props.catalogs)
// const user = toRaw(usePage().props.auth.user)
const user = toRaw(page.props.auth.user)


// const profile = user === null ? null : user.profile    // toRaw(usePage().props.auth.profile)
// const role = toRaw(page.props.auth.role)

const searchText = ref("")
// const chapters = ref([])
// const catalogTitle = ref("")

const catalogDialog = ref(false)

// const position = ref("left")

// const ccc = (id) => {
// 	for (let i = 0; i < catalogs.length; i++) {
// 		if (catalogs[i].id == id) {
// 			chapters.value = catalogs[i].chapters;
// 			catalogTitle.value = catalogs[i].title;
// 			return;
// 		}
// 	}
// }

const authUser = (field: string) => user === null ? '' : user[field]
// const authProfile = (field: string) => profile === null ? '' : profile[field]

// v-if="!!Object.keys(user).length"
const logo = "http://localhost/storage/images/template08-logo.png"
//    dashboard.slides.index


// console.log(page)
// console.log(user)

// onMounted(() => {
//     console.log('onMounted')
// })

// onBeforeUpdate(() => {
//     console.log('onBeforeUpdate')
// })

// onUpdated(() => {
//     console.log('onUpdated')
// })


</script>

<template>
<div class="bg-mutan common-layout-max-width">
	<q-layout view="lHh lpr lFf">
		<q-header bordered class="q-pa-none rc-font border-gries" height-hint="98">
			<div class="bg-gries text-mutan">
				<q-toolbar
					class="bg-gries text-mutan q-pa-none common-layout-max-width row justify-startr items-center">
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
						<q-btn v-if="!$page.props.auth.user" flat class="q-px-none q-btn-bg-none" :href="route('login')" no-caps>
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
						<q-btn flat square class="bg-bluies col-5" @click="catalogDialog = !catalogDialog">
							<div class="row justify-evenly items-center no-wrap full-width">
								<q-icon>
									<svg xmlns="http://www.w3.org/2000/svg" stroke="currentColor" fill="none"
										viewBox="-0.5 -0.5 24 24" id="File-Tray-Full-Sharp--Streamline-Ionic-Sharp"
										height="24" width="24">
										<desc>File Tray Full Sharp Streamline Icon: https://streamlinehq.com</desc>
										<path
											d="M17.94 5.0600000000000005H5.0600000000000005v1.9118750000000002h12.88v-1.9118750000000002Z"
											stroke-width="1"></path>
										<path
											d="M18.745 8.280000000000001H4.255000000000001v1.9118750000000002h14.49v-1.9118750000000002Z"
											stroke-width="1"></path>
										<path
											d="M21.16 1.84H1.84L0.23 11.5v9.66h22.54V11.5L21.16 1.84ZM20.55625 11.5H14.72c0 0.85401875 -0.33929791666666664 1.6730104166666666 -0.9430958333333334 2.2769041666666667C13.173010416666667 14.380702083333334 12.35401875 14.72 11.5 14.72s-1.6730583333333333 -0.33929791666666664 -2.2769041666666667 -0.9430958333333334C8.619297916666667 13.173010416666667 8.280000000000001 12.35401875 8.280000000000001 11.5H2.44375L3.550625 3.953125h15.89875L20.55625 11.5Z"
											stroke-width="1"></path>
									</svg>
								</q-icon>
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
		<q-drawer overlay v-model="rightDrawerOpen" side="right" bordered>
			<!-- drawer content -->
			<!--<p>{{  $page.props.auth }}</p>-->
			<q-scroll-area class="fit bg-gries text-mutan">
				<q-list dense padding>
					<q-item dense>
						<q-item-section>
							<Link :href="route('dashboard.dashboard')" class="text-mutan">
							<q-btn flat class="q-px-none q-btn-bg-none" no-caps>
								<div class="row items-center no-wrap">
									<q-icon class="shake">
										<svg xmlns="http://www.w3.org/2000/svg" stroke="currentColor" fill="none"
											viewBox="0 0 24 24" id="Dashboard-2--Streamline-Outlined-Expansion"
											height="24" width="24">
											<desc>Dashboard 2 Streamline Icon: https://streamlinehq.com</desc>
											<g id="dashboard-2">
												<path id="Union"
													d="M15.92 10.6933H23.76V0.24H15.92V10.6933ZM10.6933 23.76H23.76V13.3067H10.6933V23.76ZM0.24 10.6933H13.3067V0.24H0.24V10.6933ZM0.24 23.76H8.08V13.3067H0.24V23.76ZM13.3067 21.1467V15.92H21.1467V21.1467H13.3067ZM2.8533 8.08V2.8533H10.6933V8.08H2.8533ZM18.5333 8.08V2.8533H21.1467V8.08H18.5333ZM2.8533 21.1467V15.92H5.4667V21.1467H2.8533Z"
													stroke-width="1"></path>
											</g>
										</svg>
									</q-icon>
									<div class="text-center q-ml-sm">Панель</div>
								</div>
							</q-btn>
							</Link>


						</q-item-section>
					</q-item>
					<q-item dense>
						<q-item-section>
							<p>{{ authUser('name') }}</p>
						</q-item-section>
					</q-item>
					<q-item dense>
						<q-item-section>
							<p>{{ authUser('email') }}</p>
						</q-item-section>
					</q-item>
					<q-item dense>
						<q-item-section>
							<p>{{ user }}</p>
						</q-item-section>
					</q-item>

					<!-- <q-item dense>
						<q-item-section>
							<p>{{ role }}</p>
						</q-item-section>
					</q-item>
					<q-item dense>
						<q-item-section>
							<p>{{ authProfile('telegram') }}</p>
						</q-item-section>
					</q-item>
					<q-item dense>
						<q-item-section>
							<p>{{ authProfile('whatsapp') }}</p>
						</q-item-section>
					</q-item>
					<q-item dense>
						<q-item-section>
							<p>{{ authProfile('whatsapp') }}</p>
						</q-item-section>
					</q-item>
					<q-item dense>
						<q-item-section>
							<p>{{ authProfile('vk') }}</p>
						</q-item-section>
					</q-item>
					<q-item dense>
						<q-item-section>
							<p>{{ authProfile('inn') }}</p>
						</q-item-section>
					</q-item>
					<q-item dense>
						<q-item-section>
							<p>{{ authProfile('ogrnip') }}</p>
						</q-item-section>
					</q-item> -->

					<!--
                        <q-item dense v-ripple clickable >
                            <q-item-section>
                                <Link :href="route('dashboard.dashboard')" class="text-mutan">
                                    <q-btn flat class="q-px-none q-btn-bg-none" no-caps>
                                        <div class="row items-center no-wrap">
                                            <q-icon>
                                                <svg xmlns="http://www.w3.org/2000/svg" stroke="currentColor" fill="none" viewBox="0 0 24 24" id="Dashboard-2--Streamline-Outlined-Expansion" height="24" width="24">
                                                    <desc>Dashboard 2 Streamline Icon: https://streamlinehq.com</desc>
                                                    <g id="dashboard-2">
                                                        <path id="Union" d="M15.92 10.6933H23.76V0.24H15.92V10.6933ZM10.6933 23.76H23.76V13.3067H10.6933V23.76ZM0.24 10.6933H13.3067V0.24H0.24V10.6933ZM0.24 23.76H8.08V13.3067H0.24V23.76ZM13.3067 21.1467V15.92H21.1467V21.1467H13.3067ZM2.8533 8.08V2.8533H10.6933V8.08H2.8533ZM18.5333 8.08V2.8533H21.1467V8.08H18.5333ZM2.8533 21.1467V15.92H5.4667V21.1467H2.8533Z" stroke-width="1"></path>
                                                    </g>
                                                </svg>
                                            </q-icon>
                                            <div class="text-center q-ml-sm">Панель</div>
                                        </div>
                                    </q-btn>
                                </Link>
                            </q-item-section>
                        </q-item>
                        <q-item dense v-ripple clickable >
                            <q-item-section>
                                <Link :href="route('auth.account')" class="text-mutan">
                                    <q-btn flat class="q-px-none q-btn-bg-none" no-caps>
                                        <div class="row items-center no-wrap">
                                            <q-icon>
                                                <svg xmlns="http://www.w3.org/2000/svg" stroke="currentColor" fill="none" viewBox="0 0 24 24" id="User-2--Streamline-Guidance-Free" height="24" width="24">
                                                    <desc>User 2 Streamline Icon: https://streamlinehq.com</desc>
                                                    <path d="M21.435 16.677V23.5H2.565v-6.823S6.192 14.5 12 14.5c5.806 0 9.435 2.177 9.435 2.177Z" stroke-width="1"></path>
                                                    <path d="M6.92 5.58A5.084 5.084 0 0 1 12.005 0.5a5.073 5.073 0 0 1 5.075 5.08c0 3.89 -4.974 6.533 -4.974 6.533h-0.214S6.919 9.47 6.919 5.58Z" stroke-width="1"></path>
                                                </svg>
                                            </q-icon>
                                            <div class="text-center q-ml-sm">Аккаунт</div>
                                        </div>
                                    </q-btn>
                                </Link>
                            </q-item-section>
                        </q-item>
                        <q-item dense v-ripple clickable >
                            <q-item-section>
                                <Link :href="route('auth.profile')" class="text-mutan">
                                    <q-btn flat class="q-px-none q-btn-bg-none" no-caps>
                                        <div class="row items-center no-wrap">
                                            <q-icon>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="-0.5 -0.5 16 16" stroke="currentColor" fill="none" id="Address-Book-Light--Streamline-Phosphor" height="16" width="16">
                                                    <desc>Address Book Light Streamline Icon: https://streamlinehq.com</desc>
                                                    <path d="M10.029984375000002 8.518189453125c1.673279296875 -1.2819316406249999 1.331349609375 -3.8945156249999995 -0.6154804687500001 -4.702658203125 -1.94682421875 -0.8081367187499999 -4.038421875 0.794279296875 -3.764876953125 2.884353515625 0.0944296875 0.72151171875 0.47216601562499994 1.37576953125 1.0498007812499999 1.8183046875 -0.8524511718750001 0.31836914062500005 -1.595185546875 0.875484375 -2.1394277343750003 1.60475390625 -0.19969335937500002 0.266255859375 -0.03626953125 0.648849609375 0.29416406250000005 0.688658203125 0.153357421875 0.018474609375000003 0.304921875 -0.046265625 0.397599609375 -0.16983984375 1.55647265625 -2.075291015625 4.669412109375 -2.075291015625 6.225884765625 0 0.19969335937500002 0.26626171875 0.61273828125 0.21649804687500002 0.743478515625 -0.089572265625 0.0606796875 -0.142048828125 0.040962890625000005 -0.305677734375 -0.05171484375 -0.42924609375 -0.5442421875 -0.7292695312499999 -1.2869765625 -1.286384765625 -2.1394277343750003 -1.60475390625Zm-3.5388105468749997 -2.1711328125000002c0 -1.442244140625 1.56127734375 -2.34364453125 2.810296875 -1.62251953125 1.24901953125 0.721119140625 1.24901953125 2.52392578125 0 3.245044921875 -0.2847890625 0.16442578125 -0.607921875 0.25099218749999996 -0.936767578125 0.25100390625 -1.03475390625 0.000046875 -1.8735292968750001 -0.838775390625 -1.8735292968750001 -1.8735292968750001ZM13.552939453125001 0.15H3.1764726562499996c-0.557162109375 0 -1.008826171875 0.4516640625 -1.008826171875 1.0088203125v1.8735292968750001H0.8705859375c-0.33282421875 0.000017578125 -0.54084375 0.36032226562499997 -0.3744140625 0.64855078125 0.077232421875 0.1337578125 0.2199609375 0.216158203125 0.3744140625 0.216158203125h1.297060546875v3.17058984375H0.8705859375c-0.33282421875 0 -0.540837890625 0.36029296875 -0.37442578125000003 0.64852734375 0.077232421875 0.13376953125 0.2199609375 0.21617578125 0.37442578125000003 0.21617578125h1.297060546875v3.17058984375H0.8705859375c-0.33282421875 0 -0.540837890625 0.36029296875 -0.37442578125000003 0.64852734375 0.077232421875 0.13376953125 0.2199609375 0.21617578125 0.37442578125000003 0.21617578125h1.297060546875v1.8735292968750001c0 0.557162109375 0.4516640625 1.008826171875 1.008826171875 1.008826171875h10.376466796875c0.55715625 0 1.008826171875 -0.4516640625 1.008826171875 -1.008826171875V1.158826171875c0 -0.557162109375 -0.451669921875 -1.008826171875 -1.008826171875 -1.008826171875Zm0.1441171875 13.691173828125c0 0.07959375 -0.0645234375 0.1441171875 -0.1441171875 0.14412304687500002H3.1764726562499996c-0.079599609375 0 -0.1441171875 -0.0645234375 -0.1441171875 -0.14412304687500002V1.158826171875c0 -0.079599609375 0.064517578125 -0.14412304687500002 0.1441171875 -0.14412304687500002h10.376466796875c0.079599609375 0 0.1441171875 0.0645234375 0.1441171875 0.14412304687500002Z" stroke-width="1"></path>
                                                </svg>
                                            </q-icon>
                                            <div class="text-center q-ml-sm">Профиль</div>
                                        </div>
                                    </q-btn>
                                </Link>
                            </q-item-section>
                        </q-item>
                    -->
					<q-separator class="q-my-md" />

					<q-item dense v-ripple clickable @click="toggleRightDrawer">
						<q-item-section>
                            <btn-lucide
                                align="left"
                                @click="router.post(route('logout'))"
                                class="q-pa-none q-btn-bg-none "
                                svg="LogOut"
                                width="1.5"
                                :size="24"
                            >
                                <div class="text-mutan q-ml-sm">Выйти</div>
                            </btn-lucide>
                        </q-item-section>
                    </q-item>
                    <!-- <q-item dense v-ripple clickable @click="toggleRightDrawer">
						<q-item-section>
							<q-btn flat class="q-px-none q-btn-bg-none" align="left" no-caps @click="router.post(route('logout'))">
								<div class="row items-start no-wrap">
									<q-icon>
										<svg xmlns="http://www.w3.org/2000/svg" stroke="currentColor" fill="none"
											viewBox="-0.5 -0.5 24 24" id="Send-To-Mobile--Streamline-Sharp-Material"
											height="24" width="24">
											<desc>Send To Mobile Streamline Icon: https://streamlinehq.com</desc>
											<path
												d="m16.435416666666665 15.141666666666667 -1.00625 -1.00625 1.9645833333333333 -1.940625H11.5v-1.4375h5.893750000000001l-1.9645833333333333 -1.940625 1.00625 -1.00625 3.6656250000000004 3.6656250000000004 -3.6656250000000004 3.6656250000000004ZM4.791666666666667 22.041666666666668V0.9583333333333334h13.416666666666668v4.935416666666667h-1.4375V4.552083333333334H6.229166666666667v13.895833333333334h10.541666666666668v-1.3416666666666666h1.4375V22.041666666666668H4.791666666666667Zm1.4375 -2.15625V20.604166666666668h10.541666666666668v-0.71875H6.229166666666667Zm0 -16.770833333333336h10.541666666666668V2.3958333333333335H6.229166666666667v0.71875Z"
												stroke-width="1"></path>
										</svg>
									</q-icon>

									<div class="text-center q-ml-sm">Выйти</div>
								</div>
							</q-btn>
						</q-item-section>
					</q-item> -->
					<q-separator class="q-my-md" />
				</q-list>
			</q-scroll-area>
		</q-drawer>
		<q-page-container>
			<slot />
		</q-page-container>
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

	<!-- <q-dialog v-model="catalogDialog" :position="position" full-width full-height> -->
	<q-dialog v-model="catalogDialog" full-width full-height>
		<!-- <menu-level1 /> -->
	</q-dialog>
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
