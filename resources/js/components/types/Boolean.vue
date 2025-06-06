<script setup>
  defineOptions({
    name: 'Boolean'
  })

  const props = defineProps({
    char: Object,
  })

  const first = defineModel('first')
  const last = defineModel('last')

</script>

<template>
  <q-list>
    <q-item dense tag="label" class="text-gries" v-ripple>
      <q-item-section>
        <q-item-label>{{ char.title }}</q-item-label>
        <q-tooltip transition-show="rotate" transition-hide="rotate" v-if="!!char.description">
          {{ char.description }}
          </q-tooltip>
      </q-item-section>
      <q-item-section avatar>
        <!-- <q-toggle color="gries" v-model="first" val="battery" /> -->
        <q-toggle color="gries" v-model="first" />
        <q-tooltip transition-show="rotate" transition-hide="rotate" v-if="!!char.description">
          {{ char.description }}
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
