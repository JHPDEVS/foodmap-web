<template>
    <app-layout data-theme="cupcake">
        <div class="py-20 bg-primary flex justify-center items-center">
            <div class="md:px-4 md:grid md:grid-cols-2 lg:grid-cols-2 gap-10 space-y-4 md:space-y-0">
                <div class="max-w-sm bg-white px-6 pt-6 pb-2 rounded-xl shadow-lg ">
                    <h3 class="mb-3 text-sm font-bold text-primary">날짜를 선택하여 내 뱃속을 확인하세요</h3>
                    <date-picker title-position="left" is-expanded mode="date" v-model="picked"
                        class="flex justify-center items-center" />

                </div>


                <div class="max-w-sm bg-white px-6 pt-6  rounded-xl shadow-lg">

                    <div class="w-80 h-auto  p-3 rounded-full">
                        <div>
                            <h1 class="font-bold text-2xl">1일영양섭취기준(%)</h1>
                        </div>
                        <div class="inline-block font-bold ">
                            에너지
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-6 dark:bg-gray-700">

                            <div class="bg-red-400 h-6 rounded-full dark:bg-gray-300" style="max-width:100%"
                                :style="`width: ${KcalPer}%`">
                                <p class="px-3 text-right font-bold">{{KcalPer}}%</p>
                            </div>
                        </div>
                        <div class="inline-block font-bold ">
                            나트륨
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-6 dark:bg-gray-700">

                            <div class="bg-green-500 h-6 rounded-full dark:bg-gray-300" style="max-width:100%"
                                :style="`width: ${saltper}%`">
                                <p class="px-3 text-right font-bold">{{saltper}}%</p>
                            </div>
                        </div>


                        <div class="inline-block font-bold">
                            탄수화물
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-6 dark:bg-gray-700">

                            <div class="bg-yellow-400 h-6 rounded-full dark:bg-gray-300" style="max-width:100%"
                                :style="`width: ${fiberper}%`">
                                <p class="px-3 text-right font-bold">{{fiberper}}%</p>
                            </div>
                        </div>

                        <div class="inline-block font-bold">
                            당류
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-6 dark:bg-gray-700">

                            <div class="bg-warning h-6 rounded-full dark:bg-gray-300" style="max-width:100%"
                                :style="`width: ${suger}%`">
                                <p class="px-3 text-right font-bold">{{suger}}%</p>
                            </div>
                        </div>


                        <div class="inline-block font-bold ">
                            지방
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-6 dark:bg-gray-700">

                            <div class="bg-blue-400 h-6 rounded-full dark:bg-gray-300" style="max-width:100%"
                                :style="`width: ${fatper}%;`">
                                <p class="px-3 text-right font-bold">{{fatper}}%</p>
                            </div>
                        </div>
                        <div class="inline-block font-bold ">
                            트랜스지방
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-6 dark:bg-gray-700">

                            <div class="bg-indigo-400 h-6 rounded-full dark:bg-gray-300" style="max-width:100%"
                                :style="`width: ${transper}%`">
                                <p class="px-3 text-right font-bold">{{transper}}%</p>
                            </div>
                        </div>

                        <div class="inline-block font-bold ">
                            포화지방
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-6 dark:bg-gray-700">

                            <div class="bg-primary h-6 rounded-full dark:bg-gray-300" style="max-width:100%"
                                :style="`width: ${poper}%`">
                                <p class="px-3 text-right font-bold">{{poper}}%</p>
                            </div>
                        </div>

                        <div class="inline-block font-bold ">
                            콜레스테롤
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-6 dark:bg-gray-700">

                            <div class="bg-purple-400 h-6 rounded-full dark:bg-gray-300" style="max-width:100%"
                                :style="`width: ${colper}%`">
                                <p class="px-3 text-right font-bold">{{colper}}%</p>
                            </div>
                        </div>

                        <div class="inline-block font-bold ">
                            단백질
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-6 dark:bg-gray-700">

                            <div class="bg-pink-400 h-6 rounded-full dark:bg-gray-300" style="max-width:100%"
                                :style="`width: ${proper}%`">
                                <p class="px-3 text-right font-bold">{{proper}}%</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="w-full xl:w-10/12 mb-12 xl:mb-0 px-4 mx-auto mt-6" data-theme="cupcake">
            <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded ">
                <div class="rounded-t mb-0 px-4 py-3 border-0">
                    <div class="flex flex-wrap items-center">
                        <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                            <h3 class="font-semibold text-base text-2xl text-primary">내 뱃속</h3>
                        </div>
                    </div>
                </div>
                <div class="block w-full overflow-x-auto text-center">
                    <table class=" w-full text-center border-collapse table">
                        <thead>
                            <tr>
                                <th
                                    class="text-center bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xl uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">

                                </th>
                                <th
                                    class="text-center bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xl uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    음식명
                                </th>
                                <th
                                    class="text-center bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xl uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    칼로리
                                </th>
                                <th
                                    class="text-center bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xl uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold ">
                                    탄수화물
                                </th>
                                <th
                                    class="text-center bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xl uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold ">
                                    단백질
                                </th>
                                <th
                                    class="text-center bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xl uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold ">
                                    지방
                                </th>
                                <th
                                    class="text-center bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xl uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold ">
                                    당류
                                </th>
                                <th
                                    class="text-center bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xl uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold ">
                                    나트륨
                                </th>
                                <th
                                    class="text-center bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xl uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold ">
                                    트랜스지방
                                </th>
                                <th
                                    class="text-center bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xl uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold ">
                                    포화지방
                                </th>
                                <th
                                    class="text-center bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xl uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold ">
                                    콜레스테롤
                                </th>
                            </tr>
                        </thead>

                        <tbody class="text-center">
                            <tr v-for="(menu,i) in menus" :key="i">
                                <td class="e  text-xl whitespace-nowrap p-4">
                                    <button @click="deleteMenu(menu.id)"><i
                                            class="fas fa-trash-alt text-red-300"></i></button>
                                </td>
                                <th class="    whitespace-nowrap p-4  text-red-400 ">
                                    <a :href="`/food/show/${menu.product_id}/${menu.product_title}`">{{menu.product_title}}
                                        {{menu.serve}}</a>
                                </th>
                                <td class=" text-xl whitespace-nowrap p-4 ">
                                    {{menu.kcal}}&nbsp;㎉
                                </td>
                                <td class="   text-xl whitespace-nowrap p-4">
                                    {{menu.fiber}}g
                                </td>
                                <td class="text-xl whitespace-nowrap p-4">
                                    {{menu.pro}}g
                                </td>
                                <td class="e  text-xl whitespace-nowrap p-4">
                                    {{menu.fat}}g
                                </td>
                                <td class="e  text-xl whitespace-nowrap p-4">
                                    {{menu.suger}}g
                                </td>
                                <td class="e  text-xl whitespace-nowrap p-4">
                                    {{menu.salt}}mg
                                </td>
                                <td class="e  text-xl whitespace-nowrap p-4">
                                    {{menu.trans}}g
                                </td>
                                <td class="e  text-xl whitespace-nowrap p-4">
                                    {{menu.po}}g
                                </td>
                                <td class="e  text-xl whitespace-nowrap p-4">
                                    {{menu.col}}mg
                                </td>
                            </tr>



                        </tbody>

                    </table>
                </div>
            </div>
        </div>
        <div class="w-full xl:w-10/12 mb-12 xl:mb-0 px-4 mx-auto mt-6" data-theme="cupcake">
            <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded ">
                <div class="rounded-t mb-0 px-4 py-3 border-0">
                    <div class="flex flex-wrap items-center">
                        <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                            <h3 class="font-semibold text-base text-2xl text-primary">총 영양성분</h3>
                        </div>
                    </div>
                </div>
                <div class="block w-full overflow-x-auto text-center">
                    <table class="table w-full text-center border-collapse">
                        <thead>
                            <tr>
                                <th
                                    class="text-center bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xl uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    분류
                                </th>
                                <th
                                    class="text-center bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xl uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    총 함량
                                </th>
                                <th
                                    class="text-center bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xl uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold ">
                                    단위
                                </th>
                                <th
                                    class="text-center bg-gray-200 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xl uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    1일 영양성분 기준치대비 %
                                </th>
                            </tr>
                        </thead>

                        <tbody class="text-center">
                            <tr>
                                <th class="    whitespace-nowrap p-4  text-blueGray-700 ">
                                    에너지
                                </th>
                                <td class=" text-xl whitespace-nowrap p-4 ">
                                    {{totalKcal}}
                                </td>
                                <td class="   text-xl whitespace-nowrap p-4">
                                    ㎉
                                </td>
                                <td class="bg-gray-100   align-middle  text-xl whitespace-nowrap p-4">
                                    {{KcalPer}}% [<b class="text-red-300">{{totalKcal}}</b>/2000]㎉
                                </td>
                            </tr>


                            <tr>
                                <th class="    whitespace-nowrap p-4  text-blueGray-700 ">
                                    단백질
                                </th>
                                <td class=" text-xl whitespace-nowrap p-4 ">
                                    {{pro}}
                                </td>
                                <td class="   text-xl whitespace-nowrap p-4">
                                    g
                                </td>
                                <td class="bg-gray-100 align-middle  text-xl whitespace-nowrap p-4">
                                    {{proper}}% [<b class="text-red-300">{{pro}}</b>/60]gg
                                </td>

                            </tr>

                            <tr>
                                <th class="    whitespace-nowrap p-4  text-blueGray-700 ">
                                    지방
                                </th>
                                <td class=" text-xl whitespace-nowrap p-4 ">
                                    {{fat}}
                                </td>
                                <td class="   text-xl whitespace-nowrap p-4">
                                    g
                                </td>
                                <td class="bg-gray-100 align-middle  text-xl whitespace-nowrap p-4">
                                    {{fatper}}% [<b class="text-red-300">{{fat}}</b>/51]g
                                </td>

                            </tr>

                            <tr>
                                <th class="    whitespace-nowrap p-4  text-blueGray-700 ">
                                    탄수화물
                                </th>
                                <td class=" text-xl whitespace-nowrap p-4 ">
                                    {{fiber}}
                                </td>
                                <td class="   text-xl whitespace-nowrap p-4">
                                    g
                                </td>

                                <td class="bg-gray-100   align-middle  text-xl whitespace-nowrap p-4">
                                    {{fiberper}}% [<b class="text-red-300">{{fiber}}</b>/250]g
                                </td>
                            </tr>

                            <tr>
                                <th class="    whitespace-nowrap p-4  text-blueGray-700 ">
                                    총당류
                                </th>
                                <td class=" text-xl whitespace-nowrap p-4 ">
                                    {{suger}}
                                </td>
                                <td class="   text-xl whitespace-nowrap p-4">
                                    g
                                </td>

                                <td class="bg-gray-100   align-middle  text-xl whitespace-nowrap p-4">
                                    {{suger}}% [<b class="text-red-300">{{suger}}</b>/100]g
                                </td>
                            </tr>

                            <tr>
                                <th class="    whitespace-nowrap p-4  text-blueGray-700 ">
                                    콜레스테롤
                                </th>
                                <td class=" text-xl whitespace-nowrap p-4 ">
                                    {{col}}
                                </td>
                                <td class="   text-xl whitespace-nowrap p-4">
                                    mg
                                </td>

                                <td class="bg-gray-100   align-middle  text-xl whitespace-nowrap p-4">
                                    {{colper}}% [<b class="text-red-300">{{col}}</b>/300]mg
                                </td>
                            </tr>

                            <tr>
                                <th class="    whitespace-nowrap p-4  text-blueGray-700 ">
                                    포화지방
                                </th>
                                <td class=" text-xl whitespace-nowrap p-4 ">
                                    {{po}}
                                </td>
                                <td class="   text-xl whitespace-nowrap p-4">
                                    g
                                </td>

                                <td class="bg-gray-100   align-middle  text-xl whitespace-nowrap p-4">
                                    {{poper}}% [<b class="text-red-300">{{po}}</b>/15]g
                                </td>
                            </tr>

                            <tr>
                                <th class="    whitespace-nowrap p-4  text-blueGray-700 ">
                                    트랜스지방
                                </th>
                                <td class=" text-xl whitespace-nowrap p-4 ">
                                    {{trans}}
                                </td>
                                <td class="   text-xl whitespace-nowrap p-4">
                                    g
                                </td>

                                <td class="bg-gray-100   align-middle  text-xl whitespace-nowrap p-4">
                                    {{transper}}% [<b class="text-red-300">{{trans}}</b>/2]g
                                </td>
                            </tr>

                            <tr>
                                <th class="    whitespace-nowrap p-4  text-blueGray-700 ">
                                    나트륨
                                </th>
                                <td class=" text-xl whitespace-nowrap p-4 ">
                                    {{salt}}
                                </td>
                                <td class="   text-xl whitespace-nowrap p-4">
                                    mg
                                </td>

                                <td class="bg-gray-100   align-middle  text-xl whitespace-nowrap p-4">
                                    {{saltper}}% [<b class="text-red-300">{{salt}}</b>/2000]mg
                                </td>
                            </tr>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import axios from 'axios'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import cheerio from 'cheerio'
    import moment from 'moment'
    import {
        Calendar,
        DatePicker
    } from 'v-calendar';
    export default {
        props: ['food_id', 'food_name'],
        components: {
            AppLayout,
            DatePicker,
        },
        computed: {
            totalKcal: function () {
                let sum = 0;
                for (let i = 0; i < this.menus.length; i++) {
                    sum += (parseInt(this.menus[i].kcal));
                }
                return sum;
            },
            KcalPer: function () {
                let sum = 0;
                for (let i = 0; i < this.menus.length; i++) {
                    sum += (parseInt(this.menus[i].kcal_per));
                }
                return sum;
            },
            pro: function () {
                let sum = 0;
                for (let i = 0; i < this.menus.length; i++) {
                    sum += (parseInt(this.menus[i].pro));
                }
                return sum;
            },
            proper: function () {
                let sum = 0;
                for (let i = 0; i < this.menus.length; i++) {
                    sum += (parseInt(this.menus[i].pro_per));
                }
                return sum;
            },
            fat: function () {
                let sum = 0;
                for (let i = 0; i < this.menus.length; i++) {
                    sum += (parseInt(this.menus[i].fat));
                }
                return sum;
            },
            fatper: function () {
                let sum = 0;
                for (let i = 0; i < this.menus.length; i++) {
                    sum += (parseInt(this.menus[i].fat_per));
                }
                return sum;
            },
            suger: function () {
                let sum = 0;
                for (let i = 0; i < this.menus.length; i++) {
                    sum += (parseInt(this.menus[i].suger));
                }
                return sum;
            },
            sugerper: function () {
                let sum = 0;
                for (let i = 0; i < this.menus.length; i++) {
                    sum += (parseInt(this.menus[i].sugerper));
                }
                return sum;
            },
            salt: function () {
                let sum = 0;
                for (let i = 0; i < this.menus.length; i++) {
                    sum += (parseInt(this.menus[i].salt));
                }
                return sum;
            },
            saltper: function () {
                let sum = 0;
                for (let i = 0; i < this.menus.length; i++) {
                    sum += (parseInt(this.menus[i].salt_per));
                }
                return sum;
            },
            trans: function () {
                let sum = 0;
                for (let i = 0; i < this.menus.length; i++) {
                    sum += (parseInt(this.menus[i].trans));
                }
                return sum;
            },
            transper: function () {
                let sum = 0;
                for (let i = 0; i < this.menus.length; i++) {
                    sum += (parseInt(this.menus[i].trans_per));
                }
                return sum;
            },
            po: function () {
                let sum = 0;
                for (let i = 0; i < this.menus.length; i++) {
                    sum += (parseInt(this.menus[i].po));
                }
                return sum;
            },
            poper: function () {
                let sum = 0;
                for (let i = 0; i < this.menus.length; i++) {
                    sum += (parseInt(this.menus[i].po_per));
                }
                return sum;
            },
            col: function () {
                let sum = 0;
                for (let i = 0; i < this.menus.length; i++) {
                    sum += (parseInt(this.menus[i].col));
                }
                return sum;
            },
            colper: function () {
                let sum = 0;
                for (let i = 0; i < this.menus.length; i++) {
                    sum += (parseInt(this.menus[i].col_per));
                }
                return sum;
            },
            fiber: function () {
                let sum = 0;
                for (let i = 0; i < this.menus.length; i++) {
                    sum += (parseInt(this.menus[i].fiber));
                }
                return sum;
            },
            fiberper: function () {
                let sum = 0;
                for (let i = 0; i < this.menus.length; i++) {
                    sum += (parseInt(this.menus[i].fiber_per));
                }
                return sum;
            },
        },
        data() {
            return {
                image: '',
                menus: [],
                date: '',
                pack: [],
                kcal: '',
                image: '/image/noimg.gif',
                serve: '',
                kcalcalc: '',
                picked: new Date(),
            }
        },
        watch: {
            picked: function () {
                this.refresh()
            }
        },
        mounted() {
            this.date = moment(this.picked).format('yyyy-MM-DD')
            axios.get('/menu/show/', {
                    params: {
                        date: this.date
                    }
                })
                .then(response => {
                    this.menus = response.data.menus
                })
        },
        methods: {
            refresh() {
                this.date = moment(this.picked).format('yyyy-MM-DD')
                axios.get('/menu/show/', {
                        params: {
                            date: this.date
                        }
                    })
                    .then(response => {
                        this.menus = response.data.menus
                    })
            },
            deleteMenu(menu_id) {
                if (confirm("정말 삭제하시겠습니까??") == true) { //확인

                    axios.delete('/menu/delete/', {
                            params: {
                                id: menu_id
                            }
                        })
                        .then(response => {
                            if (response.data.status == 'ture') {
                                this.refresh();
                            }
                            alert(response.data.message)
                        })

                } else { //취소

                    return;

                }



            },
            getImage() {
                axios.get('https://www.ckme.live/https://openapi.naver.com/v1/search/encyc.json', {
                        params: {
                            query: this.food.식품명,
                        },
                        headers: {
                            'X-Naver-Client-Id': '7qRPkXSv04vUKHhniI_B',
                            'X-Naver-Client-Secret': '5yVDk4wVaa'
                        }
                    })
                    .then(response => {
                        this.items = response.data.items
                        this.image = response.data.items[0].thumbnail
                        if (this.image) {
                            console.log(this.items)
                            axios.get("https://www.ckme.live/" + this.items[0].link, )
                                .then(response => {
                                    const $ = cheerio.load(response.data)
                                    var result = $('meta[property="og:image"]').attr('content');
                                    this.image = result
                                })
                        } else {
                            axios.get('https://www.ckme.live/https://openapi.naver.com/v1/search/shop.json', {
                                    params: {
                                        query: this.food.식품명,
                                        display: 5
                                    },
                                    headers: {
                                        'X-Naver-Client-Id': '7qRPkXSv04vUKHhniI_B',
                                        'X-Naver-Client-Secret': '5yVDk4wVaa'
                                    }
                                })
                                .then(response => {


                                    this.image = response.data.items[0].image



                                })
                        }
                        if (!this.image) {
                            this.image = "/image/noimg.gif"
                        }
                    })
            }

        },

        clickShop() {
            window.location.href = this.items[0].link;
        }
    }
</script>