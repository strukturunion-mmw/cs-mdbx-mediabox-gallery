<script>
import { Container, Draggable } from "vue-dndrop";
import { applyDrag, generateItems } from "../utils/helpers";

export default {
  name: "LockAxis",

  components: { Container, Draggable },

  data() {
    return {
      items: generateItems(10, (i) => ({ id: i, data: "Draggable " + i })),
    };
  },

  methods: {
    onDrop(dropResult) {
      this.items = applyDrag(this.items, dropResult);
    },
  },
};
</script>

<template>
  <div class="simple-page">
    <Container @drop="onDrop" lock-axis="y">
      <Draggable v-for="item in items" :key="item.id">
        <div class="draggable-item">
          {{ item.data }}
        </div>
      </Draggable>
    </Container>
  </div>
</template>
