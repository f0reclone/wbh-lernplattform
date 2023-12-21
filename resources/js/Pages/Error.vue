<script setup>
import { computed } from 'vue'

const props = defineProps({ status: Number, message: String })

const title = computed(() => {
    return {
        503: '503: Service Unavailable',
        500: '500: Server Error',
        404: '404: Page Not Found',
        403: '403: Forbidden',
        402: '402: Error with external Resource.',
    }[props.status]
})

const description = computed(() => {
    return {
        503: 'Sorry, we are doing some maintenance. Please check back soon.',
        500: 'Whoops, something went wrong on our servers.',
        404: 'Sorry, the page you are looking for could not be found.',
        403: 'Sorry, you are forbidden from accessing this page.',
        402: 'There was an error while requesting an external system',
    }[props.status]
})
</script>

<template>
    <div>
        <H1>{{ title }}</H1>
        <div>{{ message ?? description }}</div>
    </div>
</template>
