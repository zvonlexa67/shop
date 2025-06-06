<script setup lang="ts">

interface Props {
  label: string
  description?: string
}

const props = defineProps<Props>()

const model = defineModel()
</script>

<template>
  <q-list>
    <q-item dense tag="label" class="text-gries bg-mutan" v-ripple style="height: 36px">
      <q-item-section style="align-items: end">
        <q-item-label>{{ props.label }}</q-item-label>
        <q-tooltip transition-show="rotate" transition-hide="rotate" v-if="!!props.description">
          {{ props.description }}
          </q-tooltip>
      </q-item-section>
      <q-item-section>
        <!-- <q-toggle color="gries" v-model="first" val="battery" /> -->
        <q-toggle color="gries" v-model="model" />
        <q-tooltip transition-show="rotate" transition-hide="rotate" v-if="!!props.description">
          {{ props.description }}
        </q-tooltip>
      </q-item-section>
    </q-item>
  </q-list>
</template>

<style lang="sass" scoped>
div.q-list--dense > .q-item, .q-item--dense
  margin: 0 16px !important
  padding-left: 12px !important
  background: rgba(0, 0, 0, 0.05)
</style>
