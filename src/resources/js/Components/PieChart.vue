<template>

    <Responsive class="w-full">
        <template #main>
        <Chart
          :width="width"
          :size="{ width, height }"
          :data="piedata"
          :margin="{
            left:-8,
            top: 0,
            right: 0,
            bottom: -5
          }"
          :config="{ controlHover: false }"
          :axis="axis"
          >
          <template #layers>
            <Pie
              :dataKeys="['name', 'prozent']"
              :pie-style="{
                innerRadius: 20,
                padAngle: 0.05,
                colors: piecolors
              }" />
          </template>
          <template #widgets>
            <Tooltip
              :config="{
                name: { label: 'Paket' },
                prozent: { label: 'Anteil %' }
              }"
              hideLine
            />
          </template>
        </Chart>
        <span class="text-xs p-0 m-0">Auslastung {{ label }}</span>
      </template>
    </Responsive>
  </template>

  <script setup>
  import { defineComponent, ref } from 'vue'
  import { Chart, Responsive, Pie, Tooltip } from 'vue3-charts'


    const props = defineProps({
        piedata: Object,
        piecolors: Array,
        label: String,
    });

    const height =150
    const width = 150

  </script>

<style>
.axis {
  visibility: hidden;
}
</style>
