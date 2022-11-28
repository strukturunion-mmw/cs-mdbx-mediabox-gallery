<template>

<div class="w-full min-w-1100 grid grid-cols-3 gap-3 p-3">

  <ArbeitspaketInfoCard v-for="paket in pakete.data" :key="paket.id" :paket="paket" />

</div>

</template>


<script setup>
import { Inertia } from '@inertiajs/inertia';
import ArbeitspaketInfoCard from '@/Components/ArbeitspaketInfoCard.vue';


const props = defineProps({
    pakete: Object,
});


</script>
