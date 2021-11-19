<template>
    <app-layout title="Dashboard">
       <!-- Creacte By Joker Banny -->
<div class="min-h-screen bg-gray-100 flex justify-center items-center">
	<div class="container mx-auto bg-indigo-500 rounded-lg p-14">
		<form>
			<h1 class="text-center font-bold text-white text-4xl">어디 맛집이 궁금한가요?</h1>
				<div class="sm:flex items-center bg-white rounded-lg overflow-hidden px-2 py-1 justify-between">
					<input class="text-base text-gray-400 flex-grow outline-none px-2 " type="text" placeholder="복현동" />
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
    import axios from 'axios'
    import cheerio from 'cheerio'

    export default defineComponent({
        components: {
            AppLayout,
            Welcome,
        },
        data: () => ({
            posts: [],
        }),
        mounted() {
             axios.get("https://www.ckme.live/https://map.naver.com/v5/search/%EB%B3%B5%ED%98%84%EB%8F%99%20%EB%A7%9B%EC%A7%91")
                    .then(response => {
                        const $ = cheerio.load(response.data);
                        const span = $('#app-root').children('div');
                        console.log(span)
                        var posts = []
                        span.map(function (i, elem) {

                            var time = $(this).find('.time').text()
                            var title = $(this).find('.title a').text().trim()
                            var href = $(this).find('.title a').attr('href')

                            let value = {
                                time: time,
                                title: title,
                                href: href
                            }
                            posts.push(value);

                        })
                        posts.shift();
                        this.posts = posts;
                        this.ifLoading = 1;
                    }).catch(error => {
                        this.ifLoading = 1;
                        alert("프록시 서버와 연결실패입니다")
                    })
        },
    })
</script>
