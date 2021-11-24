<template>
    <div class="h-screen w-full flex bg-gray-800">

        <!-- main -->
        <main class="w-full overflow-y-auto">
            <div class="px-10 mt-5">
                <span class="uppercase font-bold text-2xl text-white">{{food_name}} 검색결과</span>
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
                                <tr class="text-gray-700"  v-for="(food,i) in foods" v-bind:key="i">
                                    <td class="px-4 py-3 border">
                                        <div class="flex items-center text-sm">
                                            <div>
                                                <p class="font-semibold text-black">{{food.식품명}}</p>
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

    export default {
        props: ['food_name'],
        data() {
            return {
                foods: [],
            }
        },

        mounted() {
            axios.get('/food/search/' + this.food_name)
                .then(response => {
                    this.foods = response.data.foods
                })
        }
    }
</script>