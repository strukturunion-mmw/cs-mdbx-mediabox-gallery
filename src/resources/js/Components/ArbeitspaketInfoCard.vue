<template>
    <!-- Karte Arbeitspaket-->
    <div class="w-310 max-w-sm p-3 border rounded-md shadow-md">
        <!-- Titel Karte Arbeitspaket-->
        <div class="flex flex-wrap -mx-3 mb-2">
          <div class="w-3/5 px-3 mb-6 md:mb-0">
            <label
              class="block tracking-wide text-gray-700 text-md font-bold mb-2"
              for="grid-first-name"
            >
                {{ paket.name }}
            </label>
          </div>
          <div class="w-2/5 mb-6 md:mb-0">
            <label
              class="block text-right text-md mx-3 mb-2"
              for="grid-first-name"
            >
              <span>
                <Link
                    title="Neues Paket"
                    preserve-scroll
                    href="/handle_paket"
                    method="post"
                    as="button"
                    :data="{ action: 'new', id: paket.id, groupfilter:groupfilter}"
                >
                    📗
                </Link>
              </span>
              <span>
                <Link
                    title="Paket duplizieren"
                    preserve-scroll
                    href="/handle_paket"
                    method="post"
                    as="button"
                    :data="{ action: 'copy', id: paket.id, groupfilter:groupfilter }"
                >
                    📘
                </Link>
              </span>
              <span>
                <Link
                    title="Paket löschen"
                    preserve-scroll
                    href="/handle_paket"
                    method="post"
                    as="button"
                    :data="{ action: 'delete', id: paket.id, groupfilter:groupfilter }"
                >
                    📕
                </Link>
              </span>
            </label>
          </div>
        </div>
        <!-- ZwischenTitel Informationen -->
        <label
          class="block tracking-wide text-gray-700 text-sm text-center font-bold mb-2"
          for="grid-first-name"
        >
          Informationen
        </label>

        <!-- Zeile Flex -->
        <div class="flex flex-row flex-nowrap -mx-3 mb-0">
          <!-- Paketnummer -->
          <div class="pl-3 w-12 flex-none">
            <label
              class="text-gray-700 text-xs font-medium mb-2"
              for="paket-import_id"
            >
              Nr.
            </label>
            <input
                v-model="paket.import_id"
                @keydown.enter.prevent=""
                @change="Inertia.post('/handle_paket_field', {groupfilter:groupfilter, id: paket.id, field:'import_id', value:paket.import_id})"
              class="appearance-none text-sm block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded p-1 mb-0 leading-tight focus:outline-none focus:bg-white"
              id="paket-import_id"
              type="text"
              placeholder="1"
            />
          </div>
          <!-- Paketname -->
          <div class="grow w-full px-3">
            <label
              class="text-gray-700 text-xs font-medium mb-2"
              for="paket-name"
            >
              Name des Pakets
            </label>
            <input
                v-model="paket.name"
                @keydown.enter.prevent=""
                @change="Inertia.post('/handle_paket_field', {groupfilter:groupfilter, id: paket.id, field:'name', value:paket.name})"
              class="appearance-none text-sm block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded p-1 mb-0 leading-tight focus:outline-none focus:bg-white"
              id="paket-name"
              type="text"
              placeholder="Paketname"
            />
          </div>
        </div>
        <!-- Ende Zeil Flex -->

        <!-- Zeile Flex-->
        <div class="flex flex-row flex-nowrap -mx-3 mb-0">
          <!-- Feld Links -->
          <div class="pl-3">
            <!-- Input Termin -->
            <label
              class="text-gray-700 text-xs font-medium mb-2"
              for="paket-termin"
            >
              Termin
            </label>
            <input
                v-model="paket.termin"
                @keydown.enter.prevent=""
                @change="Inertia.post('/handle_paket_field', {groupfilter:groupfilter, id: paket.id, field:'termin', value:paket.termin})"
              class="appearance-none text-sm block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded p-1 mb-0 leading-tight focus:outline-none focus:bg-white"
              id="paket-termin"
              type="text"
              placeholder="31.12.2023"
            />
          </div>
          <!-- Feld Innen -->
          <div class="px-3 w-2/5 flex-none mb-6 md:mb-0">
            <!-- Input Kategorie -->
            <label
              class="text-gray-700 text-xs font-medium mb-2"
              for="paket-kategorie"
            >
              Kategorie
            </label>
            <input
                v-model="paket.kategorie"
                @keydown.enter.prevent=""
                @change="Inertia.post('/handle_paket_field', {groupfilter:groupfilter, id: paket.id, field:'kategorie', value:paket.kategorie})"
              class="appearance-none text-sm block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded p-1 mb-0 leading-tight focus:outline-none focus:bg-white"
              id="paket-kategorie"
              type="text"
              placeholder=""
            />
          </div>
          <!-- Feld Rechts -->
          <div class="pr-3 mb-6 md:mb-0">
            <!-- Input Budget -->
            <label
              class="text-gray-700 text-xs font-medium mb-2"
              for="paket-budget-teur"
            >
              Budget T€
            </label>
            <input
                v-model="paket.budget_teur"
                @keydown.enter.prevent=""
                @change="Inertia.post('/handle_paket_field', {groupfilter:groupfilter, id: paket.id, field:'budget_teur', value:paket.budget_teur})"
              class="appearance-none text-sm text-right block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded p-1 mb-0 leading-tight focus:outline-none focus:bg-white"
              id="paket-budget-teur"
              type="text"
              placeholder="0"
            />
          </div>
          <!-- Feld Rechts -->
          <div class="pr-3 mb-6 md:mb-0">
            <!-- Input Budget -->
            <label
              class="text-gray-700 text-xs font-medium mb-2"
              for="paket-budget"
            >
              Budget PT
            </label>
            <input
                v-model="paket.budget"
                @keydown.enter.prevent=""
                @change="Inertia.post('/handle_paket_field', {groupfilter:groupfilter, id: paket.id, field:'budget', value:paket.budget})"
              class="appearance-none text-sm text-right block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded p-1 mb-0 leading-tight focus:outline-none focus:bg-white"
              id="paket-budget"
              type="text"
              placeholder="0"
            />
          </div>
        </div>
        <!-- Ende Zeil Flex -->

        <!-- Input Zielbeschreibung -->
        <div class="w-full">
          <label class="text-gray-700 text-xs font-medium mb-0" for="paket-ziel">
            Zielbeschreibung
          </label>
          <textarea
            v-model="paket.beschreibung"
            @change="Inertia.post('/handle_paket_field', {groupfilter:groupfilter, id: paket.id, field:'beschreibung', value:paket.beschreibung})"
            id="paket-ziel"
            rows="4"
            class="appearance-none text-sm block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded p-1 mb-0 leading-tight focus:outline-none focus:bg-white"
            placeholder="Beschreibung des Zielzustandes zum angegebenen Termin"
          ></textarea>
        </div>
        <!-- Ende Input Zielbeschreibung -->
        <!-- Input Kommentar -->
        <div class="w-full">
          <label class="text-gray-700 text-xs font-medium mb-0" for="paket-kommentar">
            Kommentar
          </label>
          <textarea
            v-model="paket.kommentar"
            @change="Inertia.post('/handle_paket_field', {groupfilter:groupfilter, id: paket.id, field:'kommentar', value:paket.kommentar})"
            id="paket-kommentar"
            rows="4"
            class="appearance-none text-sm block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded p-1 mb-0 leading-tight focus:outline-none focus:bg-white"
            placeholder=""
          ></textarea>
        </div>
        <!-- Ende Input Kommentar -->
        <!-- ZwischenTitel Ressourcennutzung -->
        <label
          class="block pt-3 tracking-wide text-gray-700 text-sm text-center font-bold mb-2"
          for="grid-first-name"
        >
          Ressourcennutzung
        </label>


        <!-- Zeile Flex-->
        <div class="flex flex-row flex-nowrap -mx-3">
          <!-- Name Gruppe -->
          <div class="pl-3 text-gray-700 mt-3 text-xs text-center font-bold">
            Gruppe DS
          </div>
          <!-- Input Min Aufwand Paket -->
          <div class="px-3 mb-0 md:mb-0">
            <label
              class="text-gray-700 text-xs font-medium mb-2 whitespace-nowrap"
              for="paket-ds_aufwand_min"
            >
              Min / Best
            </label>
            <input
                v-model="paket.ds_aufwand_min"
                @keydown.enter.prevent=""
                @change="Inertia.post('/handle_paket_field', {groupfilter:groupfilter, id: paket.id, field:'ds_aufwand_min', value:paket.ds_aufwand_min})"
              class="px-3 appearance-none text-sm text-right block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded p-1 mb-0 leading-tight focus:outline-none focus:bg-white"
              id="paket-ds_aufwand_min"
              type="text"
            />
          </div>
          <!--  Input Max Aufwand Paket -->
          <div class="pr-3 mb-0 md:mb-0">
            <label
              class="text-gray-700 text-xs font-medium mb-2 whitespace-nowrap"
              for="paket-ds_aufwand_max"
            >
              Max / Worst
            </label>
            <input
                v-model="paket.ds_aufwand_max"
                @keydown.enter.prevent=""
                @change="Inertia.post('/handle_paket_field', {groupfilter:groupfilter, id: paket.id, field:'ds_aufwand_max', value:paket.ds_aufwand_max})"
              class="pr-3 appearance-none text-sm text-right block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded p-1 mb-0 leading-tight focus:outline-none focus:bg-white"
              id="paket-ds_aufwand_max"
              type="text"
            />
          </div>
          <div class="text-gray-700 mt-7 text-xs text-center font-bold">oder</div>
          <!-- Input Anteil am Paket -->
          <div class="px-3 mb-0 md:mb-0">
            <label
              class="text-gray-700 text-xs font-medium mb-2 whitespace-nowrap"
              for="paket-ds_aufwand"
            >
              Aufwand (PT)
            </label>
            <input
                v-model="paket.ds_aufwand"
                @keydown.enter.prevent=""
                @change="Inertia.post('/handle_paket_field', {groupfilter:groupfilter, id: paket.id, field:'ds_aufwand', value:paket.ds_aufwand})"
              class="px-3 appearance-none text-sm text-right block w-full text-gray-700 border border-gray-200 rounded p-1 mb-0 leading-tight focus:outline-none focus:bg-white"
              :class="classAufwand(participation.ds)"
              id="paket-ds_aufwand"
              type="text"
            />
          </div>
        </div>
        <!-- Ende Zeile geteilt Flex -->

        <!-- Zeile Flex-->
        <div class="flex flex-row flex-nowrap -mx-3">
            <!-- Name Gruppe -->
            <div class="pl-3 text-gray-700 mt-3 text-xs text-center font-bold">
              Gruppe BI
            </div>
            <!-- Input Min Aufwand Paket -->
            <div class="px-3 mb-0 md:mb-0">
              <label
                class="text-gray-700 text-xs font-medium mb-2 whitespace-nowrap"
                for="paket-bi_aufwand_min"
              >
              Min / Best
              </label>
              <input
                  v-model="paket.bi_aufwand_min"
                  @keydown.enter.prevent=""
                  @change="Inertia.post('/handle_paket_field', {groupfilter:groupfilter, id: paket.id, field:'bi_aufwand_min', value:paket.bi_aufwand_min})"
                class="px-3 appearance-none text-sm text-right block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded p-1 mb-0 leading-tight focus:outline-none focus:bg-white"
                id="paket-bi_aufwand_min"
                type="text"
              />
            </div>
            <!--  Input Max Aufwand Paket -->
            <div class="pr-3 mb-0 md:mb-0">
              <label
                class="text-gray-700 text-xs font-medium mb-2 whitespace-nowrap"
                for="paket-bi_aufwand_max"
              >
              Max / Worst
              </label>
              <input
                  v-model="paket.bi_aufwand_max"
                  @keydown.enter.prevent=""
                  @change="Inertia.post('/handle_paket_field', {groupfilter:groupfilter, id: paket.id, field:'bi_aufwand_max', value:paket.bi_aufwand_max})"
                class="pr-3 appearance-none text-sm text-right block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded p-1 mb-0 leading-tight focus:outline-none focus:bg-white"
                id="paket-bi_aufwand_max"
                type="text"
              />
            </div>
            <div class="text-gray-700 mt-7 text-xs text-center font-bold">oder</div>
            <!-- Input Anteil am Paket -->
            <div class="px-3 mb-0 md:mb-0">
              <label
                class="text-gray-700 text-xs font-medium mb-2 whitespace-nowrap"
                for="paket-bi_aufwand"
              >
                Aufwand (PT)
              </label>
              <input
                  v-model="paket.bi_aufwand"
                  @keydown.enter.prevent=""
                  @change="Inertia.post('/handle_paket_field', {groupfilter:groupfilter, id: paket.id, field:'bi_aufwand', value:paket.bi_aufwand})"
                class="px-3 appearance-none text-sm text-right block w-full text-gray-700 border border-gray-200 rounded p-1 mb-0 leading-tight focus:outline-none focus:bg-white"
                :class="classAufwand(participation.bi)"
                id="paket-bi_aufwand"
                type="text"
              />
            </div>
          </div>
          <!-- Ende Zeile geteilt Flex -->

                  <!-- Zeile Flex-->
        <div class="flex flex-row flex-nowrap -mx-3">
            <!-- Name Gruppe -->
            <div class="pl-3 text-gray-700 mt-3 text-xs text-center font-bold">
              Gruppe RI
            </div>
            <!-- Input Min Aufwand Paket -->
            <div class="px-3 mb-0 md:mb-0">
              <label
                class="text-gray-700 text-xs font-medium mb-2 whitespace-nowrap"
                for="paket-ri_aufwand_min"
              >
              Min / Best
              </label>
              <input
                  v-model="paket.ri_aufwand_min"
                  @keydown.enter.prevent=""
                  @change="Inertia.post('/handle_paket_field', {groupfilter:groupfilter, id: paket.id, field:'ri_aufwand_min', value:paket.ri_aufwand_min})"
                class="px-3 appearance-none text-sm text-right block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded p-1 mb-0 leading-tight focus:outline-none focus:bg-white"
                id="paket-ri_aufwand_min"
                type="text"
              />
            </div>
            <!--  Input Max Aufwand Paket -->
            <div class="pr-3 mb-0 md:mb-0">
              <label
                class="text-gray-700 text-xs font-medium mb-2 whitespace-nowrap"
                for="paket-ri_aufwand_max"
              >
              Max / Worst
              </label>
              <input
                  v-model="paket.ri_aufwand_max"
                  @keydown.enter.prevent=""
                  @change="Inertia.post('/handle_paket_field', {groupfilter:groupfilter, id: paket.id, field:'ri_aufwand_max', value:paket.ri_aufwand_max})"
                class="pr-3 appearance-none text-sm text-right block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded p-1 mb-0 leading-tight focus:outline-none focus:bg-white"
                id="paket-ri_aufwand_max"
                type="text"
              />
            </div>
            <div class="text-gray-700 mt-7 text-xs text-center font-bold">oder</div>
            <!-- Input Anteil am Paket -->
            <div class="px-3 mb-0 md:mb-0">
              <label
                class="text-gray-700 text-xs font-medium mb-2 whitespace-nowrap"
                for="paket-ri_aufwand"
              >
                Aufwand (PT)
              </label>
              <input
                  v-model="paket.ri_aufwand"
                  @keydown.enter.prevent=""
                  @change="Inertia.post('/handle_paket_field', {groupfilter:groupfilter, id: paket.id, field:'ri_aufwand', value:paket.ri_aufwand})"
                class="px-3 appearance-none text-sm text-right block w-full text-gray-700 border border-gray-200 rounded p-1 mb-0 leading-tight focus:outline-none focus:bg-white"
                :class="classAufwand(participation.ri)"
                id="paket-ri_aufwand"
                type="text"
              />
            </div>
          </div>
          <!-- Ende Zeile geteilt Flex -->
                  <!-- Zeile Flex-->
        <div class="flex flex-row flex-nowrap -mx-3">
            <!-- Name Gruppe -->
            <div class="pl-3 text-gray-700 mt-3 text-xs text-center font-bold">
              Gruppe RIPA
            </div>
            <!-- Input Min Aufwand Paket -->
            <div class="px-3 mb-0 md:mb-0">
              <label
                class="text-gray-700 text-xs font-medium mb-2 whitespace-nowrap"
                for="paket-ripa_aufwand_min"
              >
              Min / Best
              </label>
              <input
                  v-model="paket.ripa_aufwand_min"
                  @keydown.enter.prevent=""
                  @change="Inertia.post('/handle_paket_field', {groupfilter:groupfilter, id: paket.id, field:'ripa_aufwand_min', value:paket.ripa_aufwand_min})"
                class="px-3 appearance-none text-sm text-right block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded p-1 mb-0 leading-tight focus:outline-none focus:bg-white"
                id="paket-ripa_aufwand_min"
                type="text"
              />
            </div>
            <!--  Input Max Aufwand Paket -->
            <div class="pr-3 mb-0 md:mb-0">
              <label
                class="text-gray-700 text-xs font-medium mb-2 whitespace-nowrap"
                for="paket-ripa_aufwand_max"
              >
              Max / Worst
              </label>
              <input
                  v-model="paket.ripa_aufwand_max"
                  @keydown.enter.prevent=""
                  @change="Inertia.post('/handle_paket_field', {groupfilter:groupfilter, id: paket.id, field:'ripa_aufwand_max', value:paket.ripa_aufwand_max})"
                class="pr-3 appearance-none text-sm text-right block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded p-1 mb-0 leading-tight focus:outline-none focus:bg-white"
                id="paket-ripa_aufwand_max"
                type="text"
              />
            </div>
            <div class="text-gray-700 mt-7 text-xs text-center font-bold">oder</div>
            <!-- Input Anteil am Paket -->
            <div class="px-3 mb-0 md:mb-0">
              <label
                class="text-gray-700 text-xs font-medium mb-2 whitespace-nowrap"
                for="paket-ripa_aufwand"
              >
                Aufwand (PT)
              </label>
              <input
                  v-model="paket.ripa_aufwand"
                  @keydown.enter.prevent=""
                  @change="Inertia.post('/handle_paket_field', {groupfilter:groupfilter, id: paket.id, field:'ripa_aufwand', value:paket.ripa_aufwand})"
                class="px-3 appearance-none text-sm text-right block w-full text-gray-700 border border-gray-200 rounded p-1 mb-0 leading-tight focus:outline-none focus:bg-white"
                :class="classAufwand(participation.ripa)"
                id="paket-ripa_aufwand"
                type="text"
              />
            </div>
          </div>
          <!-- Ende Zeile geteilt Flex -->

      </div>

      <!-- Ende Karte Arbeitspaket-->
</template>


<script setup>
    import { Inertia } from '@inertiajs/inertia';
    import { Link } from '@inertiajs/inertia-vue3';
    import { onMounted, onUpdated } from 'vue';

    const props = defineProps({
        paket: Array,
        groupfilter: String,
    });

    const participation = {
        ds: 1,
        ri: 1,
        bi: 1,
        ripa: 1
    };

    function backendCall(action, data) {
      // Make call to backend
      Inertia.visit('/arbeitspakete', {
        method: 'post',
        data: {
            action: action,
            parameters: data
        },
      });
    }

    function hideNullOrNegatives() {
        if(props.paket.ds_aufwand_min < 1) props.paket.ds_aufwand_min='';
        if(props.paket.ds_aufwand_max < 1) props.paket.ds_aufwand_max='';
        if(props.paket.ds_aufwand < 0) participation.ds = -1;
        if(props.paket.ds_aufwand < 1) props.paket.ds_aufwand='';

        if(props.paket.bi_aufwand_min < 1) props.paket.bi_aufwand_min='';
        if(props.paket.bi_aufwand_max < 1) props.paket.bi_aufwand_max='';
        if(props.paket.bi_aufwand < 0) participation.bi = -1;
        if(props.paket.bi_aufwand < 1) props.paket.bi_aufwand='';

        if(props.paket.ri_aufwand_min < 1) props.paket.ri_aufwand_min='';
        if(props.paket.ri_aufwand_max < 1) props.paket.ri_aufwand_max='';
        if(props.paket.ri_aufwand < 0) participation.ri = -1;
        if(props.paket.ri_aufwand < 1) props.paket.ri_aufwand='';

        if(props.paket.ripa_aufwand_min < 1) props.paket.ripa_aufwand_min='';
        if(props.paket.ripa_aufwand_max < 1) props.paket.ripa_aufwand_max='';
        if(props.paket.ripa_aufwand < 0) participation.ripa = -1;
        if(props.paket.ripa_aufwand < 1) props.paket.ripa_aufwand='';
    }

    function classAufwand(value) {
        if(value<0) {return "bg-red-200"}
        else {return "bg-gray-200"}
    };

    function idle() {  };

    onMounted(() => {hideNullOrNegatives()});

    onUpdated(() => {hideNullOrNegatives()});

</script>
