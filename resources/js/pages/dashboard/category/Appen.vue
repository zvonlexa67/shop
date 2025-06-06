<script setup lang=ts>
  import { inject } from 'vue'

//   defineOptions({
//     name: 'Appen'
//   })

interface InjectAppen {
    form: any
    cat: any
    onAppen: () => void
    loadAppen: () => void
}

const injected = inject<InjectAppen>('appen')

if (!injected) {
    throw new Error('Injection "appen" not found')
}

const { form, cat, onAppen, loadAppen } = injected

const idImage = 'idImage_' + cat.value.id
const idIcon = 'idIcon_' + cat.value.id

const urlImage = () =>  form.picture_image != null ? URL.createObjectURL(form.picture_image) : cat.value.picture_image
const urlIcon = () =>  form.picture_icon != undefined ? URL.createObjectURL(form.picture_icon) : cat.value.picture_icon

const clickImage = () => document.querySelector<HTMLButtonElement>('#' + idImage)?.click()
const clickIcon = () => document.querySelector<HTMLButtonElement>('#' + idIcon)?.click()
</script>

<template>
<q-card flat class="slide-card full-height">
    <q-card-section style="height: 292px;">
        <q-list class="img-width">
          <q-item class="no-padding">
            <q-item-section class="justify-around">
              <q-input
                filled
                square
                label-color="gries"
                color="gries"
                v-model="form.id"
                label="Id"
                dense
                readonly
                class="q-field--with-bottom"
              />
              <q-input
                filled
                square
                label-color="gries"
                color="gries"
                v-model="form.sort"
                label="Сортировка"
                dense
                class="q-error-pt-none"
                :error-message="form.errors.sort"
                :error="!!form.errors.sort"
                no-error-icon
              />
              <q-input
                filled
                square
                label-color="gries"
                color="gries"
                v-model="form.title"
                label="Наименование"
                dense
                class="q-error-pt-none"
                :error-message="form.errors.title"
                :error="!!form.errors.title"
                no-error-icon
              />
              <q-input
                filled
                square
                label-color="gries"
                color="gries"
                v-model="form.slug"
                label="Слаг"
                dense
                class="q-error-pt-none"
                :error-message="form.errors.slug"
                :error="!!form.errors.slug"
                no-error-icon
              />
            </q-item-section>
            <q-item-section class="col-3">
              <q-img
                :src="urlImage()"
                loading="eager"
                height="200px"
                width="100%"
                fit="contain"
                class="slide-img--border cursor-pointer"
                @click.stop.prevent="clickImage"
              />
              <q-file
                dense
                square
                label="Картинка"
                label-color="gries"
                color="gries"
                v-model="form.picture_image"
                filled
                counter
                :for="idImage"
                class="q-error-pt-none"
                :error-message="form.errors.picture_image"
                :error="!!form.errors.picture_image"
                no-error-icon
              >
                <template v-slot:append>
                  <q-icon @click.stop.prevent="form.picture_image = null" class="cursor-pointer" >
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                        <path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/>
                      </svg>
                  </q-icon>
                </template>
                <template v-slot:hint>
                  Файл
                </template>
              </q-file>
            </q-item-section>
            <q-item-section class="col-3">
              <q-img
                :src="urlIcon()"
                height="200px"
                width="100%"
                fit="contain"
                class="slide-img--border cursor-pointer"
                @click.stop.prevent="clickIcon"
              />
              <q-file
                dense
                square
                label="Иконка"
                label-color="gries"
                color="gries"
                v-model="form.picture_icon"
                filled
                counter
                :for="idIcon"
                class="q-error-pt-none"
                :error-message="form.errors.picture_icon"
                :error="!!form.errors.picture_icon"
                no-error-icon
              >
                  <template v-slot:append>
                      <q-icon @click.stop.prevent="form.picture_icon = null" class="cursor-pointer" >
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                              <path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/>
                          </svg>
                      </q-icon>
                  </template>
                  <template v-slot:hint>
                      Файл
                  </template>
              </q-file>
            </q-item-section>
            <q-item-section class="items-between col-2">
              <q-btn label="Сохранить" @click.stop.prevent="onAppen" color="gries" flat no-caps>
                <q-tooltip>Сохранить категорию</q-tooltip>
              </q-btn>
              <q-btn label="Отменить" @click.stop.prevent="loadAppen" color="gries" flat no-caps class="q-ml-sm">
                <q-tooltip>Отменить все изменения</q-tooltip>
              </q-btn>
            </q-item-section>
          </q-item>
      </q-list>
    </q-card-section>
</q-card>
</template>

<style lang="sass" scoped>
.slide-img--border
	border: 1px solid #ccc
	border-radius: 4px
.slide-card
	width: 100%
	background: none
	border-bottom: 1px solid #D6D5D1
	border-radius: inherit
.img-width
	width: 100%
.q-size-font-tree
	font-size: small
</style>

<style lang="sass">
.q-error-pt-none .q-field__bottom
	padding-top: 0px
.q-tree__arrow
	font-size: 12px
	margin-right: 4px
</style>
