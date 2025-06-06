<script setup>
  defineOptions({
    name: 'Real'
  })

  const props = defineProps({
    char: Object,
  })

  const first = defineModel('first')
  const last = defineModel('last')

</script>

<template>
  <q-list>
    <q-item dense>
      <q-item-section>
        <q-input filled flat square dense type="number" v-model.number="first" label-color="gries" color="gries" :label="char.title" class="q-pa-none">
          <template v-slot:append>
            <q-icon name="fa-regular fa-circle-xmark" @click.stop.prevent="first='';last='';" class="cursor-pointer" />
          </template>
          <q-tooltip transition-show="rotate" transition-hide="rotate" v-if="!!char.description">
            {{ char.description }}
          </q-tooltip>
        </q-input>
      </q-item-section>
    </q-item>
  </q-list>
</template>