<template>
	<div class="bg-white py-12">
		<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
			<div class="lg:text-center">
				<p
					class="mt-2 text-3xl font-bold leading-8 tracking-tight text-gray-900 sm:text-4xl"
				>
					Quartalsplanung mit Arbeitspaketen
				</p>
				<p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
					Mit diesem Tool soll visuell die Verplanung von Arbeitspaketen auf Quartalsbasis vereinfacht werden.
                     (...work in progress)
				</p>
			</div>

			<div class="mt-10">
				<dl
					class="space-y-10 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10 md:space-y-0"
				>
					<div class="relative">
						<dt>
							<div
								class="absolute flex h-12 w-12 items-center justify-center rounded-md bg-red-600 text-white"
							>
                                <p class="text-3xl font-bold text-white">
	    							1
        						</p>
                            </div>
							<p class="ml-16 text-lg font-medium leading-6 text-gray-900">
								Erfassung von Arbeitspaketen
							</p>
						</dt>
						<dd class="mt-2 ml-16 text-base text-gray-500">
							Im ersten Schritt werden alle zu verplanenden Arbeitspakete erfasst. Wechseln Sie hierzu auf die Seite
                            <Link href="/arbeitspakete">Arbeitspakete</Link> und Erstellen Sie für jedes Paket eine Infokarte. Die hier erfassten Werte dienen zur
                            weiteren Verwendung der Pakete in der Planung.
						</dd>
					</div>

					<div class="relative">
						<dt>
							<div
								class="absolute flex h-12 w-12 items-center justify-center rounded-md bg-red-600 text-white"
							>
                                <p class="text-3xl font-bold text-white">
	    							2
        						</p>
                            </div>
							<p class="ml-16 text-lg font-medium leading-6 text-gray-900">
								Erfassung der Aufwände
							</p>
						</dt>
						<dd class="mt-2 ml-16 text-base text-gray-500">
							Im zweiten Schritt werden für jedes Arbeitspaket die jeweiligen Aufwände in der entsprechenden Infokarte
                            eingepflegt. Die erfassten Werte dienen bei der Planung zur Berechnung des Resourcenverbrauchs innerhalb
                            der Quartale.
						</dd>
					</div>

					<div class="relative">
						<dt>
							<div
								class="absolute flex h-12 w-12 items-center justify-center rounded-md bg-red-600 text-white"
							>
                                <p class="text-3xl font-bold text-white">
	    							3
        						</p>
                            </div>
							<p class="ml-16 text-lg font-medium leading-6 text-gray-900">
								Verplanung von Paketen
							</p>
						</dt>
						<dd class="mt-2 ml-16 text-base text-gray-500">
							Nach der Erfassung aller relevanten Arbeitspakete weden diese in Quartale verplant.
                            Wechseln Sie hierzu auf die Seite <Link href="/planung">Planung</Link> und verschieben die verfügbaren Pakete in die- oder
                            zwischen den einzelnen Quartale(n).
						</dd>
					</div>

					<div class="relative">
						<dt>
							<div
								class="absolute flex h-12 w-12 items-center justify-center rounded-md bg-red-600 text-white"
							>
                                <p class="text-3xl font-bold text-white">
	    							4
        						</p>
                            </div>
							<p class="ml-16 text-lg font-medium leading-6 text-gray-900">
								Anpassung der Planung
							</p>
						</dt>
						<dd class="mt-2 ml-16 text-base text-gray-500">
							Nach einer initialen Planung können die Arbeitspakete und die Planung jederzeit angepasst
                            und auf die aktuellen Umstände angepasst werden. Editieren Sie Infokarten und/oder die Quartalsplanung
                            um einen möglichst realistischen Planungsstand darzustellen.
						</dd>
					</div>
				</dl>
			</div>
		</div>
	</div>
</template>


<script setup>
import { Inertia } from '@inertiajs/inertia';
import { Link } from '@inertiajs/inertia-vue3';

import Instruktionen from '@/Components/Instruktionen.vue';


const props = defineProps({
    pakete: Object,
});


</script>
