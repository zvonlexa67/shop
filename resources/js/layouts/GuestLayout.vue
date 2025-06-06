<script setup lang="ts">
import { route } from 'ziggy-js'
import { Link, router } from '@inertiajs/vue3'
import { CircleX } from 'lucide-vue-next'

defineOptions({
  name: 'GuestLayout'
})

const index = () => {
  router.visit(route('index'))
}
</script>

<template>
<div class="window-height window-width row justify-center items-center">
  <q-card class="login-card">
    <div class="full-height full-width border">
      <q-toolbar class="bg-mutan text-gries">
        <q-toolbar-title>
          <slot name="title" />
        </q-toolbar-title>
        <q-btn flat round class="text-size-8" @click="index">
          <CircleX :absoluteStrokeWidth="true" />
        </q-btn>
      </q-toolbar>
      <slot />
    </div>
  </q-card>
</div>
</template>

<style lang="sass">
.login-card
    width: 100%
    max-width: 320px
</style>
