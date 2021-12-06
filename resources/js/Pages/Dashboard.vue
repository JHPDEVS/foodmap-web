<template>
    <app-layout data-theme="cupcake">
        <header>
            <!-- <nav class="p-6">
      <div class="flex justify-between items-center">
        <h1 class="pr-6 border-r-2 text-2xl font-bold text-gray-500">건강할시간</h1>
        <div class="flex justify-between flex-grow">
          <div class="flex ml-6 items-center">
            <span>
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-4 cursor-pointer text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
              </svg>
            </span>
              <input type="text" v-model="food_name" placeholder="음식명" class="w-full pr-16 input input-primary input-bordered"> 
          </div>
          <div class="md:flex space-x-6 hidden">
            <span class="text-gray-500 text-md">+ Add your sauna</span>
            <span class="text-gray-500 text-md">Sign up</span>
            <span class="text-gray-500 text-md">Log in</span>
          </div>
        </div>
      </div>
    </nav> -->
            <!-- Section Hero -->
            <div style="background-repeat: no-repeat"
                class="bg-food  mx-auto bg-gray-400 h-96 rounded-md flex items-center bg-blend-multiply">

                <div class="sm:ml-20 text-gray-50 text-center sm:text-left">
                    <h1 class="text-5xl font-black mb-4 ">
                        궁금한 음식을 <br />
                        찾아보세요!
                    </h1>
                    <div class="pt-2  mx-auto text-gray-600">
                        <div class="form-control">
                            <div class="relative">
                                <input type="text" v-model="food_name" placeholder="음식명"
                                    class="w-full pr-16 input input-primary input-bordered">
                                <button @click="search"
                                    class="absolute top-0 right-0 rounded-l-none btn btn-primary">검색</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <main class="py-16 container mx-auto px-4">
            <section>
                <a href="https://www.10000recipe.com/">
                  <img src="https://recipe1.ezmember.co.kr/img/logo4.png" class="mx-4" alt="">
                  </a>
                <carousel :items-to-show="5" :autoplay="2000" >
                    <slide v-for="post in posts" :key="post">
                      <div class="carousel__item">
                        <div class="card bordered compact mx-3">
                            <a :href="post.href">
                                <figure>
                                    <img :src="post.thumb" alt="post.title" class="object-cover w-96 h-48 w-full ">
                                </figure>
                                <div class="card-body">
                                    <h4 class="font-bold">{{post.title}}</h4>
                                    <div class="flex">
                                        <img :src="post.rvimg" :alt="post.rvtext"
                                            class="inline object-cover w-8 h-8 mr-2 rounded-full">
                                        <a :href="post.rvhref">
                                            <p class="mt-1.5">{{post.rvtext}}</p>
                                        </a>

                                    </div>
                                    <p class="text-left">{{post.view}}</p>
                                    <div class="flex">
                                        <h1 class="text-yellow-500 mr-1" v-for="(n, i) in post.star" v-bind:key="i">★
                                        </h1>
                                        {{post.staruser}}
                                    </div>
                                </div>
                            </a>
                        </div>
                        </div>
                    </slide>
                    <template #addons>

                        <navigation />
                    </template>
                </carousel>

                <hr class="w-40 my-14 border-4 rounded-md sm:mx-0 mx-auto" />
            </section>
            <section>
                <h1 class="inline-block text-gray-600 font-bold text-3xl">
                    The holy sauna ritual <br />
                    (or how does Saunatime work).
                </h1>

                <div class="grid grid-cols-3 gap-4 mt-10">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-500 mt-2">1. Browse and book</h3>
                        <p class="text text-gray-400">Start by searching for a location. Once you find a sauna you like,
                            simply check the availability, book it, and make a secure payment right away.</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-500 mt-2">2. Have a great bath</h3>
                        <p class="text text-gray-400">Meet your host on the date you chose and enjoy the home sauna
                            experience. We'll handle the payment to the host after your experience.</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-500 mt-2">3. Review the host</h3>
                        <p class="text text-gray-400">If you enjoyed the experience, let others know by giving a review
                            to your sauna host. This way others will know where to go.</p>
                    </div>
                </div>
            </section>
            <div class="mt-14">
                <p>Ps. You can also become a Saunatime host in few clicks!</p>
            </div>
        </main>

    </app-layout>
</template>

<script>
    import {
        defineComponent
    } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import Welcome from '@/Jetstream/Welcome.vue'
    import axios from 'axios'
    import cheerio from 'cheerio'
    import 'vue3-carousel/dist/carousel.css';
    import {
        Carousel,
        Slide,
        Pagination,
        Navigation
    } from 'vue3-carousel';
    export default defineComponent({
        components: {
            AppLayout,
            Welcome,
            Carousel,
            Slide,
            Pagination,
            Navigation,
        },
        data: () => ({
            posts: [],
            food_name: '',
        }),
        mounted() {
            axios.get(
                    "https://www.ckme.live/https://www.10000recipe.com/recipe/list.html?q=%EA%B1%B4%EA%B0%95%EB%A0%88%EC%8B%9C%ED%94%BC"
                )
                .then(response => {
                    const $ = cheerio.load(response.data);
                    const span = $('.rcp_m_list2 .common_sp_list_li');
                    var posts = []
                    span.map(function (i, elem) {
                        var thumb = $(this).find('.common_sp_thumb img').last().attr('src')
                        var title = $(this).find('.common_sp_caption .line2').first().text()
                        var rvhref = $(this).find('.common_sp_caption_rv_name a').attr('href')
                        var href = $(this).find('.common_sp_thumb a').attr('href')
                        var rvtext = $(this).find('.common_sp_caption_rv_name a').text()
                        var rvimg = $(this).find('.common_sp_caption_rv_name a img').attr('src')
                        var view = $(this).find('.common_sp_caption_rv span').last().text()
                        var star = $(this).find('.common_sp_caption_rv .common_sp_caption_rv_star')
                            .children().length
                        var staruser = $(this).find(
                                '.common_sp_caption_rv .common_sp_caption_rv_ea')
                            .text()
                        let value = {
                            thumb: thumb,
                            title: title,
                            rvhref: "https://www.10000recipe.com" + rvhref,
                            href: "https://www.10000recipe.com" + href,
                            rvtext: rvtext,
                            rvimg: rvimg,
                            view: view,
                            star,
                            staruser
                        }
                        posts.push(value);
                    })
                    this.posts = posts;
                    this.ifLoading = 1;
                })

        },
        methods: {
            search() {
                if (this.food_name == '') {
                    alert("음식명을 입력해주세요")
                } else {
                    window.location.href = "/food/" + this.food_name
                }
            }
        }
    })
</script>
<style>
.carousel__prev {
   box-sizing: content-box;
  border: 5px solid white;
  margin-left: 22px
}
.carousel__next {
  box-sizing: content-box;
  border: 5px solid white;
  margin-right: 22px
}
</style>