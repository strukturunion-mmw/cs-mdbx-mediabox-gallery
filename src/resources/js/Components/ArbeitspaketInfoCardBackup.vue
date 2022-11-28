<template>
	<!-- Karte Arbeitspaket-->
	<div class="w-510 p-3 border rounded-md shadow-md">
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
				<label class="block text-right text-md mx-3 mb-2" for="grid-first-name">
					<span>
						<Link
							title="Neues Paket"
							preserve-scroll
							href="/handle_paket"
							method="post"
                            as="button"
							:data="{ action: 'new', id: paket.id }"
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
							:data="{ action: 'copy', id: paket.id }"
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
							:data="{ action: 'delete', id: paket.id }"
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
		<!-- Input Paketname -->
		<div class="w-full">
			<label class="text-gray-700 text-xs font-medium mb-2" for="paket-name">
				Name des Pakets
			</label>
			<input
            v-model="paket.name"
            @keydown.enter.prevent=""
            @change="Inertia.post('/handle_paket_field', {id: paket.id, field:'name', value:paket.name})"
            class="appearance-none text-sm block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded p-1 mb-3 leading-tight focus:outline-none focus:bg-white"
				id="paket-name"
				type="text"
				placeholder="Paketname"
			/>
		</div>
		<!-- Ende Input Paketname -->

		<!-- Zeile geteilt 1/2 -->
		<div class="flex flex-wrap -mx-3 mb-2">
			<!-- Input Termin -->
			<div class="w-1/2 px-3 mb-6 md:mb-0">
				<label class="text-gray-700 text-xs font-medium mb-2" for="paket-termin">
					Termin
				</label>
				<input
					v-model="paket.termin"
					class="appearance-none text-sm block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded p-1 mb-3 leading-tight focus:outline-none focus:bg-white"
					id="paket-termin"
					type="text"
					placeholder="Datum..."
                    @keydown.enter.prevent=""
                    @change="Inertia.post('/handle_paket_field', {id: paket.id, field:'termin', value:paket.termin})"
                    />
			</div>
			<!-- Input Budget -->
			<div class="w-1/2 px-3 mb-6 md:mb-0">
				<label class="text-gray-700 text-xs font-medium mb-2" for="paket-budget">
					Budget in PT
				</label>
				<input
					v-model="paket.budget"
					class="appearance-none text-sm text-right block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded p-1 mb-3 leading-tight focus:outline-none focus:bg-white"
					id="paket-budget"
					type="text"
					placeholder="0"
                    @keydown.enter.prevent=""
                    @change="Inertia.post('/handle_paket_field', {id: paket.id, field:'budget', value:paket.budget})"
				/>
			</div>
		</div>
		<!-- Ende Zeile geteilt 1/2 -->
		<!-- Input Zielbeschreibung -->
		<div class="w-full">
			<label class="text-gray-700 text-xs font-medium mb-2" for="paket-ziel">
				Zielbeschreibung
			</label>
			<textarea
				v-model="paket.beschreibung"
                @change="Inertia.post('/handle_paket_field', {id: paket.id, field:'beschreibung', value:paket.beschreibung})"
				id="paket-ziel"
				rows="4"
				class="appearance-none text-sm block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded p-1 mb-3 leading-tight focus:outline-none focus:bg-white"
				placeholder="Beschreibung des Zielzustandes zum angegebenen Termin"
        ></textarea>
		</div>
		<!-- Ende Input Zielbeschreibung -->

		<!-- ZwischenTitel Ressourcennutzung -->
		<label
			class="block tracking-wide text-gray-700 text-sm text-center font-bold mb-2"
			for="grid-first-name"
		>
			Ressourcennutzung
		</label>


        <!-- Zeile geteilt DS-->
        <div class="flex flex-wrap -mx-3">
            <!-- Name Gruppe -->
            <div class="w-1/5 px-3 text-gray-700 mt-7 text-xs text-center font-bold">
                Gruppe DS
            </div>
            <!-- Input Min Aufwand Paket -->
            <div class="w-1/5 px-3 mb-6 md:mb-0">
                <label
                    class="text-gray-700 text-xs font-medium mb-2 whitespace-nowrap"
                    for="paket-gruppe-anteil"
                >
                    Best (PT)
                </label>
                <input
    				v-model="paket.ds_aufwand_min"
                    class="appearance-none text-sm text-right block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded p-1 mb-3 leading-tight focus:outline-none focus:bg-white"
                    id="paket-gruppe-anteil"
                    type="text"
                    placeholder="0"
                    @keydown.enter.prevent=""
                    @change="Inertia.post('/handle_paket_field', {id: paket.id, field:'ds_aufwand_min', value:paket.ds_aufwand_min})"
                />
            </div>
            <!--  Input Max Aufwand Paket -->
            <div class="w-1/5 px-3 mb-6 md:mb-0">
                <label
                    class="text-gray-700 text-xs font-medium mb-2 whitespace-nowrap"
                    for="paket-gruppe-anteil"
                >
                    Worst (PT)
                </label>
                <input
                    v-model="paket.ds_aufwand_max"
                    class="appearance-none text-sm text-right block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded p-1 mb-3 leading-tight focus:outline-none focus:bg-white"
                    id="paket-gruppe-anteil"
                    type="text"
                    placeholder="0"
                    @keydown.enter.prevent=""
                    @change="Inertia.post('/handle_paket_field', {id: paket.id, field:'ds_aufwand_max', value:paket.ds_aufwand_max})"
                />
            </div>
            <div class="w-1/5 px-3 text-gray-700 mt-7 text-xs text-center font-bold">
                oder
            </div>
            <!-- Input Anteil am Paket -->
            <div class="w-1/5 px-3 mb-6 md:mb-0">
                <label
                    class="text-gray-700 text-xs font-medium mb-2 whitespace-nowrap"
                    for="paket-gruppe-aufwand"
                >
                    Aufwand (PT)
                </label>
                <input
                    v-model="paket.ds_aufwand"
                    class="appearance-none text-sm text-right block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded p-1 mb-3 leading-tight focus:outline-none focus:bg-white"
                    id="paket-gruppe-aufwand"
                    type="text"
                    placeholder="0"
                    @keydown.enter.prevent=""
                    @change="Inertia.post('/handle_paket_field', {id: paket.id, field:'ds_aufwand', value:paket.ds_aufwand})"
                />
            </div>
        </div>
        <!-- Ende Zeile geteilt DS -->




		<!-- Zeile geteilt 1/3  DS-->
		<div class="flex flex-wrap -mx-3">
			<!-- Name Gruppe -->
			<div class="w-1/5 px-3">
				<div class="text-gray-700 mt-3 text-xs text-center font-bold">
					Gruppe DS
				</div>
			</div>
			<!-- Input Anteil am Paket -->
			<div class="w-2/5 px-3 mb-6 md:mb-0">
				<label
					class="text-gray-700 text-xs font-medium mb-2"
					for="paket-gruppe-anteil"
				>
					% Umsetzung
				</label>
				<input
					v-model="paket.ds_anteil"
					class="appearance-none text-sm text-right block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded p-1 mb-3 leading-tight focus:outline-none focus:bg-white"
					id="paket-gruppe-anteil"
					type="text"
					placeholder="0"
				/>
			</div>
			<!-- Input Anteil am Paket -->
			<div class="w-2/5 px-3 mb-6 md:mb-0">
				<label
					class="text-gray-700 text-xs font-medium mb-2"
					for="paket-gruppe-aufwand"
				>
					Aufwand in PT
				</label>
				<input
					v-model="paket.ds_aufwand"
					class="appearance-none text-sm text-right block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded p-1 mb-3 leading-tight focus:outline-none focus:bg-white"
					id="paket-gruppe-aufwand"
					type="text"
					placeholder="0"
				/>
			</div>
		</div>
		<!-- Ende Zeile geteilt 1/3 DS -->

		<!-- Zeile geteilt 1/3  BI-->
		<div class="flex flex-wrap -mx-3">
			<!-- Name Gruppe -->
			<div class="w-1/5 px-3">
				<div class="text-gray-700 mt-3 text-xs text-center font-bold">
					Gruppe BI
				</div>
			</div>
			<!-- Input Anteil am Paket -->
			<div class="w-2/5 px-3 mb-6 md:mb-0">
				<label
					class="text-gray-700 text-xs font-medium mb-2"
					for="paket-gruppe-anteil"
				>
					% Umsetzung
				</label>
				<input
					v-model="paket.bi_anteil"
					class="appearance-none text-sm text-right block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded p-1 mb-3 leading-tight focus:outline-none focus:bg-white"
					id="paket-gruppe-anteil"
					type="text"
					placeholder="0"
				/>
			</div>
			<!-- Input Anteil am Paket -->
			<div class="w-2/5 px-3 mb-6 md:mb-0">
				<label
					class="text-gray-700 text-xs font-medium mb-2"
					for="paket-gruppe-aufwand"
				>
					Aufwand in PT
				</label>
				<input
					v-model="paket.bi_aufwand"
					class="appearance-none text-sm text-right block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded p-1 mb-3 leading-tight focus:outline-none focus:bg-white"
					id="paket-gruppe-aufwand"
					type="text"
					placeholder="0"
				/>
			</div>
		</div>
		<!-- Ende Zeile geteilt 1/3 BI -->

		<!-- Zeile geteilt 1/3  RI-->
		<div class="flex flex-wrap -mx-3">
			<!-- Name Gruppe -->
			<div class="w-1/5 px-3">
				<div class="text-gray-700 mt-3 text-xs text-center font-bold">
					Gruppe RI
				</div>
			</div>
			<!-- Input Anteil am Paket -->
			<div class="w-2/5 px-3 mb-6 md:mb-0">
				<label
					class="text-gray-700 text-xs font-medium mb-2"
					for="paket-gruppe-anteil"
				>
					% Umsetzung
				</label>
				<input
					v-model="paket.ri_anteil"
					class="appearance-none text-sm text-right block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded p-1 mb-3 leading-tight focus:outline-none focus:bg-white"
					id="paket-gruppe-anteil"
					type="text"
					placeholder="0"
				/>
			</div>
			<!-- Input Anteil am Paket -->
			<div class="w-2/5 px-3 mb-6 md:mb-0">
				<label
					class="text-gray-700 text-xs font-medium mb-2"
					for="paket-gruppe-aufwand"
				>
					Aufwand in PT
				</label>
				<input
					v-model="paket.ri_aufwand"
					class="appearance-none text-sm text-right block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded p-1 mb-3 leading-tight focus:outline-none focus:bg-white"
					id="paket-gruppe-aufwand"
					type="text"
					placeholder="0"
				/>
			</div>
		</div>
		<!-- Ende Zeile geteilt 1/3 RI -->

		<!-- Zeile geteilt 1/3  RIPA-->
		<div class="flex flex-wrap -mx-3">
			<!-- Name Gruppe -->
			<div class="w-1/5 px-3">
				<div class="text-gray-700 mt-3 text-xs text-center font-bold">
					Gruppe RIPA
				</div>
			</div>
			<!-- Input Anteil am Paket -->
			<div class="w-2/5 px-3 mb-6 md:mb-0">
				<label
					class="text-gray-700 text-xs font-medium mb-2"
					for="paket-gruppe-anteil"
				>
					% Umsetzung
				</label>
				<input
					v-model="paket.ripa_anteil"
					class="appearance-none text-sm text-right block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded p-1 mb-3 leading-tight focus:outline-none focus:bg-white"
					id="paket-gruppe-anteil"
					type="text"
					placeholder="0"
				/>
			</div>
			<!-- Input Anteil am Paket -->
			<div class="w-2/5 px-3 mb-6 md:mb-0">
				<label
					class="text-gray-700 text-xs font-medium mb-2"
					for="paket-gruppe-aufwand"
				>
					Aufwand in PT
				</label>
				<input
					v-model="paket.ripa_aufwand"
					class="appearance-none text-sm text-right block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded p-1 mb-3 leading-tight focus:outline-none focus:bg-white"
					id="paket-gruppe-aufwand"
					type="text"
					placeholder="0"
				/>
			</div>
		</div>
		<!-- Ende Zeile geteilt 1/3 RIPA -->

		<!-- Zeile geteilt 1/3  DRITTE-->
		<div class="flex flex-wrap -mx-3">
			<!-- Name Gruppe -->
			<div class="w-1/5 px-3">
				<div class="text-gray-700 mt-3 text-xs text-center font-bold">
					Externe Dritte
				</div>
			</div>
			<!-- Input Anteil am Paket -->
			<div class="w-2/5 px-3 mb-6 md:mb-0">
				<label
					class="text-gray-700 text-xs font-medium mb-2"
					for="paket-gruppe-anteil"
				>
					% Umsetzung
				</label>
				<input
					v-model="paket.dritte_anteil"
					class="appearance-none text-sm text-right block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded p-1 mb-3 leading-tight focus:outline-none focus:bg-white"
					id="paket-gruppe-anteil"
					type="text"
					placeholder="0"
				/>
			</div>
			<!-- Input Anteil am Paket -->
			<div class="w-2/5 px-3 mb-6 md:mb-0">
				<label
					class="text-gray-700 text-xs font-medium mb-2"
					for="paket-gruppe-aufwand"
				>
					Aufwand in PT
				</label>
				<input
					v-model="paket.dritte_aufwand"
					class="appearance-none text-sm text-right block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded p-1 mb-3 leading-tight focus:outline-none focus:bg-white"
					id="paket-gruppe-aufwand"
					type="text"
					placeholder="0"
				/>
			</div>
		</div>
		<!-- Ende Zeile geteilt 1/3 DRITTE -->
	</div>

	<!-- Ende Karte Arbeitspaket-->
</template>


<script setup>
    import { Inertia } from '@inertiajs/inertia';
    import { Link } from '@inertiajs/inertia-vue3';

    const props = defineProps({
        paket: Array,
    });

    function idle() {  }

</script>
