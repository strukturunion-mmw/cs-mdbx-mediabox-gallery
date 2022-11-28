<template>
	<div class="min-h-full min-w-1100">
		<header class="bg-white shadow">
			<div class="mx-auto py-2 px-3">
				<Link href="#">
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
									class="text-gray-300  hover:bg-red-400 hover:text-white px-3 py-2 text-sm font-medium"
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

                <Instruktionen />

				<!-- /End replace -->
			</div>
		</main>
	</div>
</template>


<script setup>

import { Link } from '@inertiajs/inertia-vue3';

import Instruktionen from '@/Components/Instruktionen.vue';


</script>
