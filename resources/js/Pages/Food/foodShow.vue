<template>


        <div class="py-6">
            <!-- Breadcrumbs -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center space-x-2 text-gray-400 text-sm">
                    <a href="#" class="hover:underline hover:text-gray-600">{{category}}</a>
                    <span>
                        <svg class="h-5 w-5 leading-none text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </span>
                    <a href="#" class="hover:underline hover:text-gray-600">{{category2}}</a>
                    <span>
                        <svg class="h-5 w-5 leading-none text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </span>
                    <span>{{category3}}</span>
                </div>

                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
                    <div class="flex flex-col md:flex-row -mx-4">
                        <div class="md:flex-1 px-4">

                            <img v-if="image" class="object-cover h-100 w-full" :src="`${image}`">

                            <div class="flex -mx-2 mb-4">
                                <template x-for="i in 4">
                                    <div class="flex-1 px-2">
                                        <button x-on:click="image = i"
                                            :class="{ 'ring-2 ring-indigo-300 ring-inset': image === i }"
                                            class="focus:outline-none w-full rounded-lg h-24 md:h-32 bg-gray-100 flex items-center justify-center">
                                            <span x-text="i" class="text-2xl"></span>
                                        </button>
                                    </div>
                                </template>
                            </div>
                        </div>
                        <div class="md:flex-1 px-4">
                            <h2 v-if="title" v-html="title"
                                class="mb-2 leading-tight tracking-tight font-bold text-gray-800 text-2xl md:text-3xl">
                            </h2>
                            <h2 v-else v-html="food.식품명"
                                class="mb-2 leading-tight tracking-tight font-bold text-gray-800 text-2xl md:text-3xl">
                            </h2>

                            <p v-if="maker" class="text-indigo-600 hover:underline">{{maker}}</p>
                            <p v-else class="text-indigo-600 hover:underline">{{food.지역___제조사}} [{{food.식품상세분류}}]</p>




                            <div class="flex py-4 space-x-4">
                                <div v-if="items[1]" class="relative">
                                    <div
                                        class="text-center left-0 pt-2 right-0 absolute block text-xs uppercase text-gray-400  font-semibold">
                                        최저가</div>
                                    <select
                                        class="cursor-pointer appearance-none rounded-xl border p-5 border-gray-200 pl-4 pr-8 h-14 flex items-end pb-1">
                                        <option>{{items[0].lprice}}원</option>
                                    </select>
                                </div>

                                <button v-if="items[1]" @click="clickShop" type="button"
                                    class="h-14 px-6 py-2 font-semibold rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white">
                                    최저가 구매하기 : {{items[0].mallName}} {{ items[0].lprice}}￦
                                </button>
                                <button disabled v-else
                                    class="h-14 px-6 py-2 font-semibold rounded-xl bg-gray-300 text-white">판매하지 않는
                                    상품입니다</button>
                            </div>

                            <div>
                                <div v-if="items[1]" class="bg-white shadow-md rounded ">
                                    <table class="text-left w-full border-collapse">
                                        <!--Border collapse doesn't work on this site yet but it's available in newer tailwind versions -->
                                        <thead>
                                            <tr>
                                                <th
                                                    class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                                                    판매처</th>
                                                <th
                                                    class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                                                    판매가</th>
                                                <th
                                                    class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                                                    사러가기</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(item,i) in items" v-bind:key="i" class="hover:bg-grey-lighter">
                                                <td class="py-4 px-6 border-b border-grey-light">{{item.mallName}}</td>
                                                <td class="py-4 px-6 border-b border-grey-light">{{item.lprice}}</td>
                                                <td class="py-4 px-6 border-b border-grey-light "> <a :href="item.link"
                                                        class="bg-green-200 text-green-600 py-1 px-3 rounded-full">사러가기</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="justify-center mx-auto flex flex-nowrap">
                            <div class="p-1 border-4 border-black font-sans w-72">
                                <div class="text-4xl p-2 font-extrabold leading-none bg-black text-white">영양정보</div>
                                <div class="flex justify-between font-bold border-b-8 border-black">
                                    <div>1회제공량</div>
                                    <div>{{food.일회제공량}}{{food.내용량_단위}}</div>
                                </div>
                                <div class="flex justify-between items-end font-extrabold">
                                    <div>
                                        <div class="font-bold">1회제공량당</div>
                                        <div class="text-4xl">{{food.에너지_kcal_}}</div>
                                    </div>
                                    <div class="text-3 xl">칼로리</div>
                                </div>
                                <div class="border-t-4 border-black text-sm pb-1">
                                    <div class="text-right font-bold pt-1 pb-1">1일 영양성분 기준치</div>
                                    <hr class="border-gray-500" />
                                    <div class="flex justify-between">
                                        <div>
                                            <span class="font-bold">나트륨</span> {{food.나트륨_mg_}}mg
                                        </div>
                                        <div class="font-bold">{{dailySalt}}%</div>
                                    </div>
                                    <hr class="border-gray-500" />
                                    <div class="flex justify-between">
                                        <div> <span class="font-bold">탄수화물</span> {{food.탄수화물_g_}}g</div>
                                        <div class="font-bold">{{dailyFiber}}%</div>
                                    </div>
                                    <hr class="border-gray-500" />
                                    <div class="flex justify-between">
                                        <div> <span class="font-bold pl-4"> 당류</span> {{food.총당류_g_}}g</div>
                                        <div class="font-bold">{{dailySuger}}%</div>
                                    </div>
                                    <hr class="border-gray-500" />
                                    <div class="flex justify-between">
                                        <div> <span class="font-bold"> 지방</span> {{food.지방_g_}}g</div>
                                        <div class="font-bold">{{dailyFat}}%</div>
                                    </div>
                                    <hr class="border-gray-500" />
                                    <div class="flex justify-between">
                                        <div> <span class="font-bold pl-4"> 트랜스지방</span> {{food.트랜스_지방산_g_}}g</div>
                                        <div class="font-bold">{{dailyTransFat}}%</div>
                                    </div>
                                    <hr class="border-gray-500" />
                                     <div class="flex justify-between">
                                        <div > <span class="font-bold pl-4"> 포화지방</span> {{food.총_포화_지방산_g_}}g</div>
                                        <div class="font-bold">{{dailypoFat}}%</div>
                                    </div>
                                    <hr class="border-gray-500" />
                                       <div class="flex justify-between">
                                        <div > <span class="font-bold"> 콜레스테롤</span> {{food.콜레스테롤_mg_}}mg</div>
                                        <div class="font-bold">{{dailyCole}}%</div>
                                    </div>
                                       <hr class="border-gray-500" />
                                       <div class="flex justify-between">
                                        <div > <span class="font-bold"> 단백질</span> {{food.단백질_g_}}mg</div>
                                        <div class="font-bold">{{dailyProtein}}%</div>
                                    </div>
                                </div>
                                <div class="pt-1 text-sm">                          
                                    <div class="border-t-4 border-black flex leading-none text-ms pt-2 pb-1">
                                        <div class="pr-1">*</div>
                                        <div><span class="font-bold">1일 영양성분 기준치에 대한 비율(%)</span> 은 2000 kcal 기준이므로 개인의
                                            필요 열량에 따라 다를 수 있습니다.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ./ Breadcrumbs -->
            {{food}}
        </div>
</template>

<script>
    import axios from 'axios'
    import AppLayout from '@/Layouts/AppLayout.vue'
    export default {
        props: ['food_id', 'food_name'],
        components: {
            AppLayout,
        },
        data() {
            return {
                food: '',
                items: [],
                image: '',
            }
        },

        mounted() {
            axios.get('/food/index/' + this.food_id + '/' + this.food_name)
                .then(response => {
                    this.food = response.data.food
                    this.getImage()

                    this.dailySalt = ((this.food.나트륨_mg_ / 2000) * 100).toFixed(1)
                    this.dailyFiber = ((this.food.탄수화물_g_ / 250) * 100).toFixed(1)
                    this.dailySuger = (this.food.총당류_g_).toFixed(1)
                    this.dailyFat = ((this.food.지방_g_ / 51) * 100).toFixed(1)
                    this.dailyTransFat = (this.food.트랜스_지방산_g_ / 2.2 * 100).toFixed(1)
                    this.dailypoFat = (this.food.총_포화_지방산_g_ / 15 * 100).toFixed(1)
                    this.dailyCole = (this.food.콜레스테롤_mg_ / 300 * 100).toFixed(1)
                    this.dailyProtein = (this.food.단백질_g_ / 60 * 100).toFixed(1)
                })
        },
        methods: {
            getImage() {     
                axios.get('https://www.ckme.live/https://openapi.naver.com/v1/search/shop.json', {
                        params: {
                            query: this.food.지역___제조사 + this.food.식품명   ,
                            display: 5,
                            sort: 'asc'
                        },
                        headers: {
                            'X-Naver-Client-Id': '7qRPkXSv04vUKHhniI_B',
                            'X-Naver-Client-Secret': '5yVDk4wVaa'
                        }
                    })
                    .then(response => {
                        if ((this.food.상용제품 != '품목대표') && response.data.items.length >=5) {
                            this.items = response.data.items
                            this.image = response.data.items[0].image
                        } else {
                            axios.get('https://www.ckme.live/https://openapi.naver.com/v1/search/image.json', {
                                params: {
                                    query: this.food.식품명,
                                    display: 1,
                                    sort: 'sim',
                                    filter: 'medium'
                                },
                                headers: {
                                    'X-Naver-Client-Id': '7qRPkXSv04vUKHhniI_B',
                                    'X-Naver-Client-Secret': '5yVDk4wVaa'
                                }
                            })
                            .then(response=>{
                                this.image = response.data.items[0].thumbnail
                            })
                            .catch(error=>{
                                console.log(error)
                            })
                        }
                    })
            },

            clickShop() {
                window.location.href = this.items[0].link;
            }
        }




    }
</script>