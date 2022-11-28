<template>

    <div class="kanban-cards">
      <Kanban
        :columns.sync="columns"
        col-min-width="100"
        col-max-width="300"
        @item-dropped="columnChange"
      >
        <template v-slot:card="{ item }">
          <div :class="['item']" :style="{borderLeftColor: item.chartcolor}">
            <div class="kanban-card">
              <span class="card">
                <div class="kanban-action">
                  <label
                    ><strong>#{{ item.id }}</strong></label
                  >
                  <button :class="['kanban-button']"  :style="{backgroundColor: item.chartcolor}">
                     {{ item.icon }}
                  </button>
                </div>

                <label class="label"> {{ item.task }}</label>
                <small> {{ item.date }} </small>
              </span>
            </div>
          </div>
        </template>
      </Kanban>
    </div>
  </template>


<script>
import { applyDrag, scene, lorem } from "../utils/helpers";
import Kanban from "./Kanban.vue";
import { Inertia } from '@inertiajs/inertia';


export default {
  name: "CardsKanban",

  props: {
    pakete: Object,
  },
  components: { Kanban },
  computed: {
    notMobile() {
      return window.innerWidth >= 1025;
    },
  },
  data() {
    return {
      item: {},
      columns: [
        {
          name: "Noch nicht verplant",
          id: 0,
          status: ["open"],
          columnItems: [],
          validation: (src, payload, index, origins) =>
            this.columnValidation(src, payload, index, (origins = [""])),
        },
        {
          name: "Quartal I (Jan-Mrz)",
          id: 1,
          status: ["winter"],
          columnItems: [],
          validation: (src, payload, index, origins) =>
            this.columnValidation(
              src,
              payload,
              index,
              (origins = [""])
            ),
        },
        {
          name: "Quartal 2 (Apr-Jun)",
          id: 2,
          status: ["spring"],
          columnItems: [],
          validation: (src, payload, index, origins) =>
            this.columnValidation(
              src,
              payload,
              index,
              (origins = [""])
            ),
        },
        {
          name: "Quartal 3 (Jul-Sep)",
          id: 3,
          status: ["summer"],
          columnItems: [],
          validation: (src, payload, index, origins) =>
            this.columnValidation(
              src,
              payload,
              index,
              (origins = [""])
            ),
        },
        {
          name: "Quartal 4 (Okt-Dez)",
          id: 4,
          status: ["fall"],
          columnItems: [],
          validation: (src, payload, index, origins) =>
            this.columnValidation(
              src,
              payload,
              index,
              (origins = [""])
            ),
        },
      ],
      showDropdown: {},
      opcoesDropdownMenu: [
        { type: "customAction" },
        { type: "separator", color: "yellow" },
        { type: "customAction" },
      ],
      scene,
      upperDropPlaceholderOptions: {
        className: "cards-drop-preview",
        animationDuration: "150",
        showOnTop: true,
      },
      dropPlaceholderOptions: {
        className: "drop-preview",
        animationDuration: "150",
        showOnTop: true,
      },
    };
  },
  mounted() {
    //this.cardsKanban(0, 2, "open", ["open", "spring", "summer", "winter", "fall"]);
    //this.cardsKanban(1, 3, "winter", ["open", "spring", "summer", "winter", "fall"]);
    //this.cardsKanban(2, 1, "spring", ["open", "spring", "summer", "winter", "fall"]);
    //this.cardsKanban(3, 0, "summer", [""]);
    //this.cardsKanban(4, 0, "fall", [""]);
    //console.log(this.pakete.data);
    this.pakete.forEach(element => {
        this.assignKanbanCard(element);
    });
    //console.log(this.columns);

  },

  methods: {
    iconType(status) {
      switch (status) {
        case "winter":
          return "⛄";
        case "spring":
          return "🌼";
        case "summer":
          return "🌞";
        case "fall":
          return "🎃";
        default:
          return "🗓";
      }
    },
    quarterAssignment(quarter) {
      switch (quarter) {
        case 0:
          return "open";
        case 1:
          return "winter";
        case 2:
          return "spring";
        case 3:
          return "summer";
        case 4:
          return "fall";
      }
    },
    assignKanbanCard(paket) {
        const colunaId = paket.quartal;
        const currentStatus = this.quarterAssignment(paket.quartal);
        const index = paket.import_id;
        const current = this.columns.find((item) => item.id === colunaId);
        //const random = Math.floor(Math.random() * 99);
        current.columnItems.push({
            id: paket.import_id,
            task: paket.name,
            date: paket.termin,
            chartcolor:paket.chartcolor,
            status: ["open", "spring", "summer", "winter", "fall"],
            currentStatus,
            icon: this.iconType(currentStatus),
            dropdownId: index,
            corStatus: {
            nome: currentStatus,
            corTexto: `#2${index}1ba8`,
            cor: `#2${index}3ced`,
            },
        });
    },
    cardsKanban(colunaId, items, currentStatus, statusList) {
      const current = this.columns.find((item) => item.id === colunaId);
      const random = Math.floor(Math.random() * 99);
      for (let index = 0; index <= items; index++) {
        current.columnItems.push({
          id: random + index + 1,
          task: lorem.slice(0, Math.floor(Math.random() * 20) + 10),
          date: `11/2${index}/2020`,
          status: statusList,
          currentStatus,
          icon: this.iconType(currentStatus),
          dropdownId: index,
          corStatus: {
            nome: currentStatus,
            corTexto: `#2${index}1ba8`,
            cor: `#2${index}3ced`,
          },
        });
      }
    },
    selectStatus(item) {
      this.showDropdown = {
        id: item.id,
      };
    },
    columnChange({ item, column }) {
      setTimeout(() => {
        this.columns.reduce((total, el) => {
          const items = el.columnItems.map((i) => i.id);
          if (items.includes(item.id)) {
            const newStatus = el.columnItems.find((i) => i.id === item.id);
            if (Array.isArray(column) && column.length) {
              //console.log(column);
              newStatus.icon = this.iconType(column[0]);
              return (newStatus.currentStatus = column[0]);
            }
            newStatus.currentStatus = column;
            newStatus.icon = this.iconType(column);
            const ab = el.columnItems.findIndex((i) => i.id === newStatus.id);
            const colunaDestino = this.columns.findIndex((col) =>
              col.status.includes(newStatus.currentStatus)
            );
            el.columnItems.splice(ab, 1);
            this.columns[colunaDestino].columnItems.push(newStatus);
            return newStatus;
          } else return this.columns;
        }, 0);
      });

      // Make call to backend
      Inertia.visit('/planung', {
        method: 'post',
        data: {
            action: 'drop_package',
            parameters: {
                id:item.id,
                quartal: this.columns.findIndex((col) => col.status.includes(column[0])),
                quartal_name: column[0],
            }
        },
      });
    },
    columnValidation(src, payload, index, possibleOrigins) {
      return possibleOrigins.includes(payload.currentStatus);
    },

    onColumnDrop(dropResult) {
      const scene = Object.assign({}, this.scene);
      scene.children = applyDrag(scene.children, dropResult);
      this.scene = scene;
    },

    onCardDrop(columnId, dropResult) {
      if (dropResult.removedIndex !== null || dropResult.addedIndex !== null) {
        const scene = Object.assign({}, this.scene);
        const column = scene.children.filter((p) => p.id === columnId)[0];
        const columnIndex = scene.children.indexOf(column);

        const newColumn = Object.assign({}, column);
        newColumn.children = applyDrag(newColumn.children, dropResult);
        scene.children.splice(columnIndex, 1, newColumn);

        this.scene = scene;
      }
    },

    getCardPayload(columnId) {
      return (index) => {
        return this.scene.children.filter((p) => p.id === columnId)[0].children[
          index
        ];
      };
    },

    dragStart() {
      console.log("drag started");
    },

    log(...params) {
      console.log(...params);
    },
  },
};
</script>







<style scoped>
.kanban {
  display: flex;
  justify-content: stretch;
  width: 100%;
  height: 100%;
  user-select: none;
}
.kanban__move-icon {
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 1rem;
  font-size: 0.9rem;
  color: #b0b0b0;
  user-select: none;
}
.kanban__move-icon span {
  margin-left: 10px;
}
.kanban__move-icon svg {
  width: 20px;
  height: 20px;
}
.kanban__drop-preview {
  position: relative;
  margin: 10px;
  background-color: #edf1f3;
  border: 2px dashed rgba(0, 0, 0, 0.059);
  border-radius: 4px;
}
.kanban__drop-preview::before {
  position: absolute;
  top: 50%;
  left: 50%;
  color: #b0b0b0;
  transform: translate(-50%, -50%);
}
.kanban__drop-preview::after {
  position: absolute;
  top: 50%;
  left: 27%;
  width: 20px;
  height: 20px;
  content: "";
  transform: translate(-50%, -50%);
}
.kanban__description {
  display: flex;
  align-items: center;
}
.kanban__icon {
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: #edf5f7;
  padding: 0.5rem;
  border-radius: 8px;
}
.kanban__title {
  margin: 0 0 0 5px;
  font-size: 1rem;
  font-weight: bold;
  color: #555;
}
.kanban__quantity {
  margin-top: 0;
  font-size: small;
  color: #b0b0b0;
  text-align: right;
}
.kanban__quantity--inner-count {
  margin: 1rem 1rem 0 1rem;
  padding-top: 0.5rem;
}
.kanban__column {
  flex: 1;
  height: fit-content;
  padding: 10px;
  border-radius: 6px;
  transition: height 0.5s ease;
  border: 1px solid #e0e0e0;
}
.kanban__column:not(:first-of-type) {
  margin-left: 15px;
}
.kanban__column--no-border {
  border: none;
}
.kanban__header {
  margin-bottom: 15px;
  background-color: #fff;
}
.kanban__content {
  position: relative;
}
.kanban__skeleton {
  display: flex;
  width: 100%;
  height: 100%;
  padding-top: 15px;
  padding-right: 15px;
  background-color: #f8f8f8;
  border-radius: 4px;
  overflow: auto;
}
.kanban__skeleton-container {
  width: 100%;
}
.kanban__skeleton-column {
  flex: 1;
  height: calc(100% - 30px);
  padding: 10px;
  margin-left: 15px;
  background-color: #e9e9e9;
  border-radius: 6px;
}
.kanban__skeleton-card {
  position: relative;
  height: 100px;
  padding: 15px;
  margin-top: 16px;
  background-color: #f5f5f5;
  border-radius: 6px;
}
.kanban__skeleton-card--one {
  position: absolute;
  top: 8px;
}
.kanban__skeleton-card--two {
  position: absolute;
  top: 8px;
  right: 10px;
}
.kanban__skeleton-card--three {
  position: absolute;
  top: 30px;
}
.kanban__skeleton-card--four {
  position: absolute;
  bottom: 2rem;
}
.kanban__skeleton-card--five {
  position: absolute;
  left: 1rem;
  bottom: 0.5rem;
}

.item,
.draggable-item,
.draggable-item-horizontal {
  position: relative;
  display: flex;
  flex-direction: column;
  padding: 10px;
  margin: 8px;
  cursor: pointer;
  user-select: none;
  background-color: white;
  border: 1px solid transparent;
  border-left: 5px solid #e0e0e0;
  border-radius: 4px;
  transition: border-color 0.2s linear;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1), 0 0 1px rgba(0, 0, 0, 0.1);
}
.item .card {
  display: flex;
  flex-direction: column;
  gap: 4px;
}
.item .card small {
  color: #838383;
}
.item.open {
  border-left: 5px solid #ffe9e9;
}
.item.winter {
  border-left: 5px solid #a7dbfd;
}
.item.summer {
  border-left: 5px solid #f7fa66;
}
.item.spring {
  border-left: 5px solid #b0f7a9;
}
.item.fall {
  border-left: 5px solid #f5c380;
}
.badge {
  margin: 1rem 0;
  cursor: pointer;
}
.label {
  color: #838383;
  margin-bottom: 5px;
}
.kanban-action {
  display: flex;
  justify-content: space-between;
}

.kanban-button {
  max-width: 130px;
  pointer-events: none;
  border: none;
  color: #f7f7f7;
  padding: 1px 20px;
  text-align: center;
  text-decoration: none;
  border-radius: 100px;
}

.kanban-button.open {
  background-color: #ffe9e9;
}
.kanban-button.winter {
  background-color: #a7dbfd;
}
.kanban-button.summer {
  background-color: #f7fa66;
}
.kanban-button.spring {
  background-color: #b0f7a9;
}
.kanban-button.fall {
  background-color: #f58080;
}

.kanban-cards {
  display: flex;
  justify-content: center;
  margin: 5px 0;
}
</style>
