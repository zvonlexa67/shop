<script setup lang="ts">
import { ref, toRefs, watch, inject } from 'vue'
import { Gallery } from '@/components/file'

interface InjectImages {
	form: any
	storeImage: () => void
	destroyImage: () => void
	storeSortImage: () => void
}

const injected = inject<InjectImages>('images')

if (!injected) {
	throw new Error('injection "images" not found')
}

const { form, storeImage, destroyImage, storeSortImage } = injected
const { picture_image } = toRefs(form)
const images = ref<any[]>([])

images.value = picture_image.value

watch(images, (newVal, oldVal) => {
  if(oldVal.length == newVal.length) {
    form.picture_image = newVal
    storeSortImage()
  }

  if(oldVal.length < newVal.length) {
    form.picture_image = newVal
    storeImage()
  }

  if(oldVal.length > newVal.length) {
    const difference = oldVal.filter((x: any) => !newVal.includes(x))
    form.picture_image = difference[0].url

    destroyImage()
  }
})
</script>

<template>
  <gallery v-model="images"/>
</template>
