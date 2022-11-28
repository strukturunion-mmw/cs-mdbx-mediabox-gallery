<template>
	<div class="min-h-full min-w-1100">
		<header class="bg-white shadow">
			<div class="mx-auto py-2 px-3">
				<Link href="/">
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900">
			    		RI Prognose Jahresplanung
				    </h1>
                </Link>
			</div>
		</header>
		<nav class="bg-red-600">
			<div class="mx-auto px-3">
				<div class="flex items-center justify-between">
					<div class="flex items-center">
						<div class="flex-shrink-0">
							<!-- Logo -- img class="h-8 w-8" src="" alt=""-->
						</div>
						<div class="hidden md:block">
							<div class="ml-10 flex items-baseline space-x-4">
								<!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                                <Link
                                href="/arbeitspakete"
                                class="bg-red-600 text-white px-3 py-2 rounded-md text-sm font-medium"
                                aria-current="page"
                            >
                                Arbeitspakete
                            </Link>

                            <Link
                                href="/planung"
                                class="text-gray-300 hover:bg-red-400 hover:text-white px-3 py-2 text-sm font-medium"
                            >
                                Planung
                            </Link>
                        </div>
						</div>
					</div>
				</div>
			</div>
		</nav>

		<main>
			<div class="mx-auto py-3">
				<!-- Replace with your content -->

                <div class="my-0 py-0 mx-auto px-3">
					<div class="flex items-center justify-between">
						<div class="flex items-center">
                            <Link
                                href="/arbeitspakete"
                                as="button"
                                :data="{ groupfilter: 'all'}"
                            >
                                <button
                                    class="hover:bg-red-600 w-20 mr-3 text-white text-xs text-bold rounded-md px-2 py-1"
                                    :class="classSelectedPill('all')"
                                >
                                    Alle
                                </button>
                            </Link>
                            <Link
                                href="/arbeitspakete"
                                as="button"
                                :data="{ groupfilter: 'bi'}"
                            >
                                <button
                                    class="hover:bg-red-600 w-20 mr-3 text-white text-xs text-bold rounded-md px-2 py-1"
                                    :class="classSelectedPill('bi')"
                                >
                                    BI
                                </button>
                            </Link>
                            <Link
                                href="/arbeitspakete"
                                as="button"
                                :data="{ groupfilter: 'ri'}"
                            >
                                <button
                                    class="hover:bg-red-600 w-20 mr-3 text-white text-xs text-bold rounded-md px-2 py-1"
                                    :class="classSelectedPill('ri')"
                                >
                                    RI
                                </button>
                            </Link>
                            <Link
                                href="/arbeitspakete"
                                as="button"
                                :data="{ groupfilter: 'ds'}"
                            >
                                <button
                                    class="hover:bg-red-600 w-20 mr-3 text-white text-xs text-bold rounded-md px-2 py-1"
                                    :class="classSelectedPill('ds')"
                                >
                                    DS
                                </button>
                            </Link>
                            <Link
                                href="/arbeitspakete"
                                as="button"
                                :data="{ groupfilter: 'ripa'}"
                            >
                                <button
                                    class="hover:bg-red-600 w-20 mr-3 text-white text-xs text-bold rounded-md px-2 py-1"
                                    :class="classSelectedPill('ripa')"
                                >
                                    RIPA
                                </button>
                            </Link>
						</div>
					</div>
				</div>

                <div class="w-full grid grid-cols-3 gap-3 p-3">

                    <ArbeitspaketInfoCard v-for="paket in pakete.data" :key="paket.id" :paket="paket" :groupfilter="groupfilter" />

                  </div>

				<!-- /End replace -->
			</div>
		</main>
	</div>
</template>


<script setup>
import { Inertia } from '@inertiajs/inertia';
import { Link } from '@inertiajs/inertia-vue3';
import { onMounted, onUpdated } from 'vue';


import ArbeitspaketInfoCard from '@/Components/ArbeitspaketInfoCard.vue';

const props = defineProps({
    pakete: Object,
    groupfilter: String,
});

function classSelectedPill(group) {
    if(group==props.groupfilter) {return "bg-red-600"}
    else {return "bg-red-200"}
}

    onMounted(() => {
        console.log(props.groupfilter)
    });

</script>
