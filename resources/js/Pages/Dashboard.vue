<template>
    <app-layout title="Dashboard">
       <!-- Creacte By Joker Banny -->
<div class="min-h-screen bg-gray-100 flex justify-center items-center">
	<div class="container mx-auto bg-indigo-500 rounded-lg p-14">
		<form>
			<h1 class="text-center font-bold text-white text-4xl">오늘의 메뉴는 뭘까요</h1>
				<div class="sm:flex items-center bg-white rounded-lg overflow-hidden px-2 py-1 justify-between">
					<input class="text-base text-gray-400 flex-grow outline-none px-2 " type="text" placeholder="위치 로딩중" />
					<div class="ms:flex items-center px-2 rounded-lg space-x-4 mx-auto ">
						<button class="bg-indigo-500 text-white text-base rounded-lg px-4 py-2 font-thin">Search</button>
					</div>
				</div>
		</form>
	</div>
</div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import Welcome from '@/Jetstream/Welcome.vue'

    export default defineComponent({
        components: {
            AppLayout,
            Welcome,
        },
    })
</script>
