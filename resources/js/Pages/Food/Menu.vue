<template>
    <app-layout data-theme="cupcake">
        <!-- 日付選択と栄養インジケーターバー -->
        <div class="py-20 bg-primary flex justify-center items-center">
            <div
                class="md:px-4 md:grid md:grid-cols-2 lg:grid-cols-2 gap-10 space-y-4 md:space-y-0"
            >
                <!-- 日付選択パネル -->
                <div
                    class="max-w-sm bg-white px-6 pt-6 pb-2 rounded-xl shadow-lg"
                >
                    <h3 class="mb-3 text-sm font-bold text-primary">
                        日付を選択して自分のお腹の中身を確認しましょう
                    </h3>
                    <date-picker
                        title-position="left"
                        is-expanded
                        mode="date"
                        v-model="picked"
                        class="flex justify-center items-center"
                    />
                </div>

                <!-- 1日の栄養摂取基準(%)グラフ -->
                <div class="max-w-sm bg-white px-6 pt-6 rounded-xl shadow-lg">
                    <div class="w-80 h-auto p-3 rounded-full">
                        <div>
                            <h1 class="font-bold text-2xl">
                                1日の栄養摂取基準（％）
                            </h1>
                        </div>
                        <div class="inline-block font-bold">エネルギー</div>
                        <div
                            class="w-full bg-gray-200 rounded-full h-6 dark:bg-gray-700"
                        >
                            <div
                                class="bg-red-400 h-6 rounded-full dark:bg-gray-300"
                                style="max-width: 100%"
                                :style="`width: ${KcalPer}%`"
                            >
                                <p class="px-3 text-right font-bold">
                                    {{ KcalPer }}%
                                </p>
                            </div>
                        </div>
                        <div class="inline-block font-bold">ナトリウム</div>
                        <div
                            class="w-full bg-gray-200 rounded-full h-6 dark:bg-gray-700"
                        >
                            <div
                                class="bg-green-500 h-6 rounded-full dark:bg-gray-300"
                                style="max-width: 100%"
                                :style="`width: ${saltper}%`"
                            >
                                <p class="px-3 text-right font-bold">
                                    {{ saltper }}%
                                </p>
                            </div>
                        </div>
                        <div class="inline-block font-bold">炭水化物</div>
                        <div
                            class="w-full bg-gray-200 rounded-full h-6 dark:bg-gray-700"
                        >
                            <div
                                class="bg-yellow-400 h-6 rounded-full dark:bg-gray-300"
                                style="max-width: 100%"
                                :style="`width: ${fiberper}%`"
                            >
                                <p class="px-3 text-right font-bold">
                                    {{ fiberper }}%
                                </p>
                            </div>
                        </div>
                        <div class="inline-block font-bold">糖類</div>
                        <div
                            class="w-full bg-gray-200 rounded-full h-6 dark:bg-gray-700"
                        >
                            <div
                                class="bg-warning h-6 rounded-full dark:bg-gray-300"
                                style="max-width: 100%"
                                :style="`width: ${suger}%`"
                            >
                                <p class="px-3 text-right font-bold">
                                    {{ suger }}%
                                </p>
                            </div>
                        </div>
                        <div class="inline-block font-bold">脂肪</div>
                        <div
                            class="w-full bg-gray-200 rounded-full h-6 dark:bg-gray-700"
                        >
                            <div
                                class="bg-blue-400 h-6 rounded-full dark:bg-gray-300"
                                style="max-width: 100%"
                                :style="`width: ${fatper}%;`"
                            >
                                <p class="px-3 text-right font-bold">
                                    {{ fatper }}%
                                </p>
                            </div>
                        </div>
                        <div class="inline-block font-bold">トランス脂肪</div>
                        <div
                            class="w-full bg-gray-200 rounded-full h-6 dark:bg-gray-700"
                        >
                            <div
                                class="bg-indigo-400 h-6 rounded-full dark:bg-gray-300"
                                style="max-width: 100%"
                                :style="`width: ${transper}%`"
                            >
                                <p class="px-3 text-right font-bold">
                                    {{ transper }}%
                                </p>
                            </div>
                        </div>
                        <div class="inline-block font-bold">飽和脂肪</div>
                        <div
                            class="w-full bg-gray-200 rounded-full h-6 dark:bg-gray-700"
                        >
                            <div
                                class="bg-primary h-6 rounded-full dark:bg-gray-300"
                                style="max-width: 100%"
                                :style="`width: ${poper}%`"
                            >
                                <p class="px-3 text-right font-bold">
                                    {{ poper }}%
                                </p>
                            </div>
                        </div>
                        <div class="inline-block font-bold">コレステロール</div>
                        <div
                            class="w-full bg-gray-200 rounded-full h-6 dark:bg-gray-700"
                        >
                            <div
                                class="bg-purple-400 h-6 rounded-full dark:bg-gray-300"
                                style="max-width: 100%"
                                :style="`width: ${colper}%`"
                            >
                                <p class="px-3 text-right font-bold">
                                    {{ colper }}%
                                </p>
                            </div>
                        </div>
                        <div class="inline-block font-bold">タンパク質</div>
                        <div
                            class="w-full bg-gray-200 rounded-full h-6 dark:bg-gray-700"
                        >
                            <div
                                class="bg-pink-400 h-6 rounded-full dark:bg-gray-300"
                                style="max-width: 100%"
                                :style="`width: ${proper}%`"
                            >
                                <p class="px-3 text-right font-bold">
                                    {{ proper }}%
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 食品リストテーブル -->
        <div
            class="w-full xl:w-10/12 mb-12 xl:mb-0 px-4 mx-auto mt-6"
            data-theme="cupcake"
        >
            <div
                class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded"
            >
                <div class="rounded-t mb-0 px-4 py-3 border-0">
                    <div class="flex flex-wrap items-center">
                        <div
                            class="relative w-full px-4 max-w-full flex-grow flex-1"
                        >
                            <h3
                                class="font-semibold text-base text-2xl text-primary"
                            >
                                私のお腹の中
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="block w-full overflow-x-auto text-center">
                    <!-- 食品詳細テーブル -->
                    <table class="w-full text-center border-collapse table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>食品名</th>
                                <th>カロリー</th>
                                <th>炭水化物</th>
                                <th>タンパク質</th>
                                <th>脂肪</th>
                                <th>糖類</th>
                                <th>ナトリウム</th>
                                <th>トランス脂肪</th>
                                <th>飽和脂肪</th>
                                <th>コレステロール</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <tr v-for="(menu, i) in menus" :key="i">
                                <td class="e text-xl whitespace-nowrap p-4">
                                    <button @click="deleteMenu(menu.id)">
                                        <i
                                            class="fas fa-trash-alt text-red-300"
                                        ></i>
                                    </button>
                                </td>
                                <th class="whitespace-nowrap p-4 text-red-400">
                                    <a
                                        :href="`/food/show/${menu.product_id}/${menu.product_title}`"
                                    >
                                        {{ menu.product_title }}
                                        {{ menu.serve }}
                                    </a>
                                </th>
                                <td class="text-xl whitespace-nowrap p-4">
                                    {{ menu.kcal }}&nbsp;㎉
                                </td>
                                <td class="text-xl whitespace-nowrap p-4">
                                    {{ menu.fiber }}g
                                </td>
                                <td class="text-xl whitespace-nowrap p-4">
                                    {{ menu.pro }}g
                                </td>
                                <td class="e text-xl whitespace-nowrap p-4">
                                    {{ menu.fat }}g
                                </td>
                                <td class="e text-xl whitespace-nowrap p-4">
                                    {{ menu.suger }}g
                                </td>
                                <td class="e text-xl whitespace-nowrap p-4">
                                    {{ menu.salt }}mg
                                </td>
                                <td class="e text-xl whitespace-nowrap p-4">
                                    {{ menu.trans }}g
                                </td>
                                <td class="e text-xl whitespace-nowrap p-4">
                                    {{ menu.po }}g
                                </td>
                                <td class="e text-xl whitespace-nowrap p-4">
                                    {{ menu.col }}mg
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- 合計栄養成分テーブル -->
        <div
            class="w-full xl:w-10/12 mb-12 xl:mb-0 px-4 mx-auto mt-6"
            data-theme="cupcake"
        >
            <div
                class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded"
            >
                <div class="rounded-t mb-0 px-4 py-3 border-0">
                    <div class="flex flex-wrap items-center">
                        <div
                            class="relative w-full px-4 max-w-full flex-grow flex-1"
                        >
                            <h3
                                class="font-semibold text-base text-2xl text-primary"
                            >
                                合計栄養成分
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="block w-full overflow-x-auto text-center">
                    <table class="table w-full text-center border-collapse">
                        <thead>
                            <tr>
                                <th>分類</th>
                                <th>合計</th>
                                <th>単位</th>
                                <th>1日の基準値に対する%</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <tr>
                                <th>エネルギー</th>
                                <td>{{ totalKcal }}</td>
                                <td>㎉</td>
                                <td
                                    class="bg-gray-100 align-middle text-xl whitespace-nowrap p-4"
                                >
                                    {{ KcalPer }}% [<b class="text-red-300">{{
                                        totalKcal
                                    }}</b
                                    >/2000]㎉
                                </td>
                            </tr>
                            <tr>
                                <th>タンパク質</th>
                                <td>{{ pro }}</td>
                                <td>g</td>
                                <td
                                    class="bg-gray-100 align-middle text-xl whitespace-nowrap p-4"
                                >
                                    {{ proper }}% [<b class="text-red-300">{{
                                        pro
                                    }}</b
                                    >/60]g
                                </td>
                            </tr>
                            <tr>
                                <th>脂肪</th>
                                <td>{{ fat }}</td>
                                <td>g</td>
                                <td
                                    class="bg-gray-100 align-middle text-xl whitespace-nowrap p-4"
                                >
                                    {{ fatper }}% [<b class="text-red-300">{{
                                        fat
                                    }}</b
                                    >/51]g
                                </td>
                            </tr>
                            <tr>
                                <th>炭水化物</th>
                                <td>{{ fiber }}</td>
                                <td>g</td>
                                <td
                                    class="bg-gray-100 align-middle text-xl whitespace-nowrap p-4"
                                >
                                    {{ fiberper }}% [<b class="text-red-300">{{
                                        fiber
                                    }}</b
                                    >/250]g
                                </td>
                            </tr>
                            <tr>
                                <th>糖類</th>
                                <td>{{ suger }}</td>
                                <td>g</td>
                                <td
                                    class="bg-gray-100 align-middle text-xl whitespace-nowrap p-4"
                                >
                                    {{ suger }}% [<b class="text-red-300">{{
                                        suger
                                    }}</b
                                    >/100]g
                                </td>
                            </tr>
                            <tr>
                                <th>コレステロール</th>
                                <td>{{ col }}</td>
                                <td>mg</td>
                                <td
                                    class="bg-gray-100 align-middle text-xl whitespace-nowrap p-4"
                                >
                                    {{ colper }}% [<b class="text-red-300">{{
                                        col
                                    }}</b
                                    >/300]mg
                                </td>
                            </tr>
                            <tr>
                                <th>飽和脂肪</th>
                                <td>{{ po }}</td>
                                <td>g</td>
                                <td
                                    class="bg-gray-100 align-middle text-xl whitespace-nowrap p-4"
                                >
                                    {{ poper }}% [<b class="text-red-300">{{
                                        po
                                    }}</b
                                    >/15]g
                                </td>
                            </tr>
                            <tr>
                                <th>トランス脂肪</th>
                                <td>{{ trans }}</td>
                                <td>g</td>
                                <td
                                    class="bg-gray-100 align-middle text-xl whitespace-nowrap p-4"
                                >
                                    {{ transper }}% [<b class="text-red-300">{{
                                        trans
                                    }}</b
                                    >/2]g
                                </td>
                            </tr>
                            <tr>
                                <th>ナトリウム</th>
                                <td>{{ salt }}</td>
                                <td>mg</td>
                                <td
                                    class="bg-gray-100 align-middle text-xl whitespace-nowrap p-4"
                                >
                                    {{ saltper }}% [<b class="text-red-300">{{
                                        salt
                                    }}</b
                                    >/2000]mg
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
import axios from "axios";
import AppLayout from "@/Layouts/AppLayout.vue";
import cheerio from "cheerio";
import moment from "moment";
import "v-calendar/dist/style.css";
import { Calendar, DatePicker } from "v-calendar";
export default {
    props: ["food_id", "food_name"],
    components: {
        AppLayout,
        DatePicker,
    },
    computed: {
        totalKcal: function () {
            let sum = 0;
            for (let i = 0; i < this.menus.length; i++) {
                sum += parseInt(this.menus[i].kcal);
            }
            return sum;
        },
        KcalPer: function () {
            let sum = 0;
            for (let i = 0; i < this.menus.length; i++) {
                sum += parseInt(this.menus[i].kcal_per);
            }
            return sum;
        },
        pro: function () {
            let sum = 0;
            for (let i = 0; i < this.menus.length; i++) {
                sum += parseInt(this.menus[i].pro);
            }
            return sum;
        },
        proper: function () {
            let sum = 0;
            for (let i = 0; i < this.menus.length; i++) {
                sum += parseInt(this.menus[i].pro_per);
            }
            return sum;
        },
        fat: function () {
            let sum = 0;
            for (let i = 0; i < this.menus.length; i++) {
                sum += parseInt(this.menus[i].fat);
            }
            return sum;
        },
        fatper: function () {
            let sum = 0;
            for (let i = 0; i < this.menus.length; i++) {
                sum += parseInt(this.menus[i].fat_per);
            }
            return sum;
        },
        suger: function () {
            let sum = 0;
            for (let i = 0; i < this.menus.length; i++) {
                sum += parseInt(this.menus[i].suger);
            }
            return sum;
        },
        sugerper: function () {
            let sum = 0;
            for (let i = 0; i < this.menus.length; i++) {
                sum += parseInt(this.menus[i].sugerper);
            }
            return sum;
        },
        salt: function () {
            let sum = 0;
            for (let i = 0; i < this.menus.length; i++) {
                sum += parseInt(this.menus[i].salt);
            }
            return sum;
        },
        saltper: function () {
            let sum = 0;
            for (let i = 0; i < this.menus.length; i++) {
                sum += parseInt(this.menus[i].salt_per);
            }
            return sum;
        },
        trans: function () {
            let sum = 0;
            for (let i = 0; i < this.menus.length; i++) {
                sum += parseInt(this.menus[i].trans);
            }
            return sum;
        },
        transper: function () {
            let sum = 0;
            for (let i = 0; i < this.menus.length; i++) {
                sum += parseInt(this.menus[i].trans_per);
            }
            return sum;
        },
        po: function () {
            let sum = 0;
            for (let i = 0; i < this.menus.length; i++) {
                sum += parseInt(this.menus[i].po);
            }
            return sum;
        },
        poper: function () {
            let sum = 0;
            for (let i = 0; i < this.menus.length; i++) {
                sum += parseInt(this.menus[i].po_per);
            }
            return sum;
        },
        col: function () {
            let sum = 0;
            for (let i = 0; i < this.menus.length; i++) {
                sum += parseInt(this.menus[i].col);
            }
            return sum;
        },
        colper: function () {
            let sum = 0;
            for (let i = 0; i < this.menus.length; i++) {
                sum += parseInt(this.menus[i].col_per);
            }
            return sum;
        },
        fiber: function () {
            let sum = 0;
            for (let i = 0; i < this.menus.length; i++) {
                sum += parseInt(this.menus[i].fiber);
            }
            return sum;
        },
        fiberper: function () {
            let sum = 0;
            for (let i = 0; i < this.menus.length; i++) {
                sum += parseInt(this.menus[i].fiber_per);
            }
            return sum;
        },
    },
    data() {
        return {
            image: "",
            menus: [],
            date: "",
            pack: [],
            kcal: "",
            image: "/image/noimg.gif",
            serve: "",
            kcalcalc: "",
            picked: new Date(),
        };
    },
    watch: {
        picked: function () {
            this.refresh();
        },
    },
    mounted() {
        this.date = moment(this.picked).format("yyyy-MM-DD");
        axios
            .get("/menu/show/", {
                params: {
                    date: this.date,
                },
            })
            .then((response) => {
                this.menus = response.data.menus;
            });
    },
    methods: {
        refresh() {
            this.date = moment(this.picked).format("yyyy-MM-DD");
            axios
                .get("/menu/show/", {
                    params: {
                        date: this.date,
                    },
                })
                .then((response) => {
                    this.menus = response.data.menus;
                });
        },
        deleteMenu(menu_id) {
            if (confirm("ほんとに削除しますか??") == true) {
                axios
                    .delete("/menu/delete/", {
                        params: {
                            id: menu_id,
                        },
                    })
                    .then((response) => {
                        if (response.data.status == "ture") {
                            this.refresh();
                        }
                        alert(response.data.message);
                    });
            } else {
                return;
            }
        },
        getImage() {
            axios
                .get(
                    `${this.$page.props.env.PROXY_BASE_URL}/https://openapi.naver.com/v1/search/encyc.json`,
                    {
                        params: {
                            query: this.food.식품명,
                        },
                        headers: {
                            "X-Naver-Client-Id": "7qRPkXSv04vUKHhniI_B",
                            "X-Naver-Client-Secret": "5yVDk4wVaa",
                        },
                    }
                )
                .then((response) => {
                    this.items = response.data.items;
                    this.image = response.data.items[0].thumbnail;
                    if (this.image) {
                        console.log(this.items);
                        axios
                            .get(
                                `${this.$page.props.env.PROXY_BASE_URL}` +
                                    this.items[0].link
                            )
                            .then((response) => {
                                const $ = cheerio.load(response.data);
                                var result = $(
                                    'meta[property="og:image"]'
                                ).attr("content");
                                this.image = result;
                            });
                    } else {
                        axios
                            .get(
                                `${this.$page.props.env.PROXY_BASE_URL}/https://openapi.naver.com/v1/search/shop.json`,
                                {
                                    params: {
                                        query: this.food.식품명,
                                        display: 5,
                                    },
                                    headers: {
                                        "X-Naver-Client-Id":
                                            "7qRPkXSv04vUKHhniI_B",
                                        "X-Naver-Client-Secret": "5yVDk4wVaa",
                                    },
                                }
                            )
                            .then((response) => {
                                this.image = response.data.items[0].image;
                            });
                    }
                    if (!this.image) {
                        this.image = "/image/noimg.gif";
                    }
                });
        },
    },

    clickShop() {
        window.location.href = this.items[0].link;
    },
};
</script>
