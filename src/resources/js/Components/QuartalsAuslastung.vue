<template>
    <!-- Box Piecharts -->
    <div class="p-3 border rounded-md">
        <div class="w-full text-center -mt-6">
            <span class="px-3 text-[#555555] font-bold bg-white">{{ data.label }}</span>
        </div>
        <div class="w-full grid grid-cols-2 gap-3 p-3">
            <PieChart :piedata="pie.data.bi.tasks" :piecolors="pie.data.bi.colors" label="Prognose BI"/>
            <PieChart :piedata="pie.data.ri.tasks" :piecolors="pie.data.ri.colors" label="Prognose RI" />
            <PieChart :piedata="pie.data.ds.tasks" :piecolors="pie.data.ds.colors" label="Data Science" />
            <PieChart :piedata="pie.data.ripa.tasks" :piecolors="pie.data.ripa.colors" label="Prognose RIPA" />
        </div>
    </div>
      <!-- Ende Box Piecharts -->
</template>


<script setup>

    import PieChart from "@/Components/PieChart.vue";

    const props = defineProps({

        data: Object,
        pie: Object

    });


</script>

<style>
</style>
