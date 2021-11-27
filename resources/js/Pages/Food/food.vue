<template>
        <div class=" w-full flex bg-gray-800">

            <!-- main -->
            <main class="w-full overflow-y-auto">
                <div class="px-10 mt-5">
                    <span class="uppercase font-bold text-2xl text-white">{{food_name}} 검색결과 : {{page.total}} 건</span>
                </div>

    
                    <div class="container flex justify-center mx-auto">
                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px"
                            aria-label="Pagination">
                            <!-- Current: "z-10 bg-indigo-50 border-indigo-500 text-indigo-600", Default: "bg-white border-gray-300 text-gray-500 hover:bg-gray-50" -->
                            <a v-for="(item,i) in page.links" v-bind:key="i">
                                <button @click="refreshPage(item.label)" v-if="item.active==true"
                                    class="h-10 px-5 text-white bg-gray-600 border border-r-0 border-gray-600">{{ item.label }}</button>
                                <button @click="refreshPage(item.label)" v-else
                                    class="h-10 px-5 text-gray-600 bg-white border border-gray-600 hover:bg-gray-100">{{ item.label }}</button>
                            </a>

                        </nav>

                    </div>

                <section class="container mx-auto p-6 font-mono">
                    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
                        <div class="w-full overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr
                                        class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                        <th class="px-4 py-3">제품명</th>
                                        <th class="px-4 py-3">1회 제공량</th>
                                        <th class="px-4 py-3">분류</th>
                                        <th class="px-4 py-3">1회 제공량 당 칼로리</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    <tr class="text-gray-700" v-for="(food,i) in foods" v-bind:key="i">
                                        <td class="px-4 py-3 border">
                                            <div class="flex items-center text-sm">
                                                <div>
                                                    <a :href="`/food/show/${food.NO}/${food.식품명}`">
                                                        <p class="font-semibold text-blue-500">{{food.식품명}}</p>
                                                    </a>
                                                    <p class="text-xs text-gray-600">{{food.연도}}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 text-ms font-semibold border">{{food.일회제공량}}</td>
                                        <td class="px-4 py-3 text-xs border">
                                            <span
                                                class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-sm">
                                                {{food.식품대분류}} </span>
                                        </td>
                                        <td class="px-4 py-3 text-sm border">{{ food.에너지_kcal_}} Kcal</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </main>
        </div>
</template>

<script>
    import axios from 'axios'
    import AppLayout from '@/Layouts/AppLayout.vue'
    export default {
        props: ['food_name'],
        components: {
            AppLayout,
        },
        data() {
            return {
                foods: [],  
                page: [],
            }
        },

        mounted() {
            axios.get('/food/search/' + this.food_name)
                .then(response => {
                    this.page = response.data.foods
                    this.foods = response.data.foods.data
                    this.pageLinks = response.data.foods.links
                })
        },

          methods: {
             refreshPage(page) {
                if (page == "<") {
                    if (this.pageLinks[0].url) {
                        page = this.pageLinks[0].url.charAt(this.pageLinks[0].url.length - 1)
                    } else {
                        page = 1
                    }
                }
                if (page == ">") {
                    if (this.pageLinks[this.page.last_page + 1].url) {
                        page = this.pageLinks[this.page.last_page + 1].url.charAt(this.pageLinks[this.page.last_page +
                            1].url.length - 1)
                    } else {
                        page = this.page.last_page;
                    }
                }
                axios.get("/food/search/" + this.food_name +"?page="+ page)
                        .then(response => {
                            this.page = response.data.foods;
                            this.pageId = response.data.foods.current_page
                            this.foods = response.data.foods.data;
                            this.pageLinks = response.data.foods.links
                })
            },
          
        }
    }
</script>