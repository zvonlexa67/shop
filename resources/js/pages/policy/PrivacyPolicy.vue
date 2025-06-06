<script setup lang="ts">
import { TextLink } from '@/components/form/button'

defineOptions({
    name: 'PrivacyPolicy'
})
</script>

<template>
    <span style="display: inline-block; vertical-align: baseline;">При входе или регистрации вы соглашаетесь с</span>
    <text-link label="Политикой конфиденциальности" href="/" style="vertical-align: baseline;" class="text-deep-orange-13 text-size-10" />
    <span style="display: inline-block; vertical-align: baseline;">&nbsp;и&nbsp;</span>
    <text-link label="Условиями использования" href="/" style="vertical-align: baseline;" class="text-deep-orange-13 text-size-10" />
</template>
