<template>
    <app-layout data-theme="cupcake">
        <div class="py-20 bg-primary flex justify-center items-center">
            <div
                class="md:px-4 md:grid md:grid-cols-3 lg:grid-cols-3 gap-10 space-y-4 md:space-y-0"
            >
                <!-- 食品名と画像パネル -->
                <div
                    class="max-w-sm bg-white px-6 pt-6 pb-2 rounded-xl shadow-lg"
                >
                    <h3 class="mb-3 text-2xl font-bold text-primary">
                        {{ food.식품명 }} ({{ food.일회제공량
                        }}{{ food.내용량_단위 }})
                    </h3>
                    <div class="relative">
                        <img
                            class="w-full rounded-xl"
                            :src="image"
                            referrerpolicy="no-referrer"
                            alt="Colors"
                        />
                        <p
                            class="absolute top-0 bg-yellow-300 text-gray-800 font-semibold py-1 px-3 rounded-br-lg rounded-tl-lg"
                        >
                            {{ food.식품상세분류 }}
                        </p>
                    </div>
                </div>
                <!-- 栄養情報ボックス -->
                <div
                    class="max-w-sm bg-white px-6 pt-6 pb-2 rounded-xl shadow-lg"
                >
                    <div
                        class="p-1 border-4 border-black font-sans justify-center"
                    >
                        <div
                            class="text-4xl p-2 font-extrabold leading-none bg-black text-white"
                        >
                            栄養情報
                        </div>
                        <div
                            class="flex justify-between font-bold border-b-8 border-black"
                        >
                            <div>1回提供量</div>
                            <div>
                                {{ food.일회제공량 }}{{ food.내용량_단위 }}
                            </div>
                        </div>
                        <div
                            class="flex justify-between items-end font-extrabold"
                        >
                            <div>
                                <div class="font-bold">1回提供量あたり</div>
                                <div class="text-4xl">{{ kcal }}</div>
                            </div>
                            <div class="text-3 xl">カロリー</div>
                        </div>
                        <div class="border-t-4 border-black text-sm pb-1">
                            <div class="text-right font-bold pt-1 pb-1">
                                1日栄養成分基準値
                            </div>
                            <hr class="border-gray-500" />
                            <!-- 各成分 -->
                            <div class="flex justify-between">
                                <div>
                                    <span class="font-bold">ナトリウム</span>
                                    {{ 나트륨 }}mg
                                </div>
                                <div class="font-bold">{{ dailySalt }}%</div>
                            </div>
                            <hr class="border-gray-500" />
                            <div class="flex justify-between">
                                <div>
                                    <span class="font-bold">炭水化物</span>
                                    {{ 탄수화물 }}g
                                </div>
                                <div class="font-bold">{{ dailyFiber }}%</div>
                            </div>
                            <hr class="border-gray-500" />
                            <div class="flex justify-between">
                                <div>
                                    <span class="font-bold pl-4">糖類</span>
                                    {{ 당류 }}g
                                </div>
                                <div class="font-bold">{{ dailySuger }}%</div>
                            </div>
                            <hr class="border-gray-500" />
                            <div class="flex justify-between">
                                <div>
                                    <span class="font-bold">脂肪</span>
                                    {{ 지방 }}g
                                </div>
                                <div class="font-bold">{{ dailyFat }}%</div>
                            </div>
                            <hr class="border-gray-500" />
                            <div class="flex justify-between">
                                <div>
                                    <span class="font-bold pl-4"
                                        >トランス脂肪</span
                                    >
                                    {{ 트랜스지방 }}g
                                </div>
                                <div class="font-bold">
                                    {{ dailyTransFat }}%
                                </div>
                            </div>
                            <hr class="border-gray-500" />
                            <div class="flex justify-between">
                                <div>
                                    <span class="font-bold pl-4">飽和脂肪</span>
                                    {{ 포화지방 }}g
                                </div>
                                <div class="font-bold">{{ dailypoFat }}%</div>
                            </div>
                            <hr class="border-gray-500" />
                            <div class="flex justify-between">
                                <div>
                                    <span class="font-bold"
                                        >コレステロール</span
                                    >
                                    {{ 콜레스테롤 }}mg
                                </div>
                                <div class="font-bold">{{ dailyCole }}%</div>
                            </div>
                            <hr class="border-gray-500" />
                            <div class="flex justify-between">
                                <div>
                                    <span class="font-bold">タンパク質</span>
                                    {{ 단백질 }}mg
                                </div>
                                <div class="font-bold">{{ dailyProtein }}%</div>
                            </div>
                        </div>
                        <!-- 栄養基準値注記 -->
                        <div class="pt-1 text-sm">
                            <div
                                class="border-t-4 border-black flex leading-none text-ms pt-2 pb-1"
                            >
                                <div class="pr-1">*</div>
                                <div>
                                    <span class="font-bold"
                                        >1日栄養成分基準値に対する割合(%)</span
                                    >
                                    は2000kcalを基準としており、個人の必要カロリーによって異なる場合があります。
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- グラフィカルな1日基準バー -->
                <div class="max-w-sm bg-white px-6 pt-6 rounded-xl shadow-lg">
                    <div class="w-80 h-auto p-3 rounded-full">
                        <div>
                            <h1 class="font-bold text-2xl">
                                1日栄養摂取基準（％）
                            </h1>
                        </div>
                        <div class="inline-block font-bold">エネルギー</div>
                        <div
                            class="w-full bg-gray-200 rounded-full h-6 dark:bg-gray-700"
                        >
                            <div
                                class="bg-red-400 h-6 rounded-full dark:bg-gray-300"
                                style="max-width: 100%"
                                :style="`width: ${kcalper}%`"
                            >
                                <p class="px-3 text-right font-bold">
                                    {{ kcalper }}%
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
                                :style="`width: ${dailySalt}%`"
                            >
                                <p class="px-3 text-right font-bold">
                                    {{ dailySalt }}%
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
                                :style="`width: ${dailyFiber}%`"
                            >
                                <p class="px-3 text-right font-bold">
                                    {{ dailyFiber }}%
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
                                :style="`width: ${dailySuger}%`"
                            >
                                <p class="px-3 text-right font-bold">
                                    {{ dailySuger }}%
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
                                :style="`width: ${dailyFat}%;`"
                            >
                                <p class="px-3 text-right font-bold">
                                    {{ dailyFat }}%
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
                                :style="`width: ${dailyTransFat}%`"
                            >
                                <p class="px-3 text-right font-bold">
                                    {{ dailyTransFat }}%
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
                                :style="`width: ${dailypoFat}%`"
                            >
                                <p class="px-3 text-right font-bold">
                                    {{ dailypoFat }}%
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
                                :style="`width: ${dailyCole}%`"
                            >
                                <p class="px-3 text-right font-bold">
                                    {{ dailyCole }}%
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
                                :style="`width: ${dailyProtein}%`"
                            >
                                <p class="px-3 text-right font-bold">
                                    {{ dailyProtein }}%
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 詳細成分テーブル -->
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
                            <h3 class="font-semibold text-2xl text-primary">
                                栄養情報
                            </h3>
                        </div>
                        <div
                            class="relative w-full px-4 max-w-full flex-grow flex-1 text-right"
                        >
                            <button
                                @click="save"
                                data-theme="cupcake"
                                class="btn btn-xl text-primary transform transition duration-500 hover:scale-110"
                                type="button"
                            >
                                <i class="fas fa-utensils fa-lg"
                                    >&nbsp; {{ food_name }} {{ serve
                                    }}{{ food.내용량_단위 }} お腹に保存</i
                                >
                            </button>
                        </div>
                    </div>
                </div>

                <div class="block w-full overflow-x-auto text-center">
                    <table class="w-full text-center border-collapse">
                        <thead>
                            <tr>
                                <th
                                    class="text-center bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xl uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                                >
                                    分類
                                </th>
                                <th
                                    class="text-center bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xl uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                                >
                                    {{ food.일회제공량
                                    }}{{ food.내용량_단위 }} あたり
                                </th>
                                <th
                                    class="text-center bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xl uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold"
                                >
                                    単位
                                </th>
                                <th
                                    class="flex items-center justify-center bg-gray-200 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xl uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold"
                                >
                                    <div
                                        class="tooltip tooltip-open mt-5"
                                        data-tip="数値は修正可"
                                    >
                                        <input
                                            type="text"
                                            v-model="serve"
                                            size="4"
                                            class="input input-bordered font-bold text-2xl border-4 tooltip tooltip-open"
                                        />
                                        <span class="btn lowercase">{{
                                            food.내용량_단위
                                        }}</span>
                                    </div>
                                </th>
                                <th
                                    class="text-center bg-gray-200 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xl uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                                >
                                    1日栄養成分基準値に対する%
                                </th>
                            </tr>
                        </thead>

                        <tbody class="text-center">
                            <tr>
                                <th
                                    class="whitespace-nowrap p-4 text-blueGray-700"
                                >
                                    エネルギー
                                </th>
                                <td class="text-xl whitespace-nowrap p-4">
                                    {{ kcal }}
                                </td>
                                <td class="text-xl whitespace-nowrap p-4">
                                    ㎉
                                </td>
                                <td
                                    class="bg-gray-100 align-middle text-xl whitespace-nowrap p-4"
                                >
                                    {{ kcalcal }}&nbsp;㎉
                                </td>
                                <td
                                    class="bg-gray-100 align-middle text-xl whitespace-nowrap p-4"
                                >
                                    {{ kcalper }}% [<b class="text-red-300">{{
                                        kcalcal
                                    }}</b
                                    >/2000]㎉
                                </td>
                            </tr>

                            <tr>
                                <th
                                    class="whitespace-nowrap p-4 text-blueGray-700"
                                >
                                    タンパク質
                                </th>
                                <td class="text-xl whitespace-nowrap p-4">
                                    {{ 단백질 }}
                                </td>
                                <td class="text-xl whitespace-nowrap p-4">g</td>
                                <td
                                    class="bg-gray-100 align-middle text-xl whitespace-nowrap p-4"
                                >
                                    {{ proteincal }}g
                                </td>
                                <td
                                    class="bg-gray-100 align-middle text-xl whitespace-nowrap p-4"
                                >
                                    {{ proteinper }}% [<b
                                        class="text-red-300"
                                        >{{ proteincal }}</b
                                    >/60]g
                                </td>
                            </tr>

                            <tr>
                                <th
                                    class="whitespace-nowrap p-4 text-blueGray-700"
                                >
                                    脂肪
                                </th>
                                <td class="text-xl whitespace-nowrap p-4">
                                    {{ 지방 }}
                                </td>
                                <td class="text-xl whitespace-nowrap p-4">g</td>
                                <td
                                    class="bg-gray-100 align-middle text-xl whitespace-nowrap p-4"
                                >
                                    {{ fatcal }}g
                                </td>
                                <td
                                    class="bg-gray-100 align-middle text-xl whitespace-nowrap p-4"
                                >
                                    {{ fatper }}% [<b class="text-red-300">{{
                                        fatcal
                                    }}</b
                                    >/51]g
                                </td>
                            </tr>

                            <tr>
                                <th
                                    class="whitespace-nowrap p-4 text-blueGray-700"
                                >
                                    炭水化物
                                </th>
                                <td class="text-xl whitespace-nowrap p-4">
                                    {{ 탄수화물 }}
                                </td>
                                <td class="text-xl whitespace-nowrap p-4">g</td>
                                <td
                                    class="bg-gray-100 align-middle text-xl whitespace-nowrap p-4"
                                >
                                    {{ fibercal }}g
                                </td>
                                <td
                                    class="bg-gray-100 align-middle text-xl whitespace-nowrap p-4"
                                >
                                    {{ fiberper }}% [<b class="text-red-300">{{
                                        fibercal
                                    }}</b
                                    >/250]g
                                </td>
                            </tr>

                            <tr>
                                <th
                                    class="whitespace-nowrap p-4 text-blueGray-700"
                                >
                                    糖類
                                </th>
                                <td class="text-xl whitespace-nowrap p-4">
                                    {{ 당류 }}
                                </td>
                                <td class="text-xl whitespace-nowrap p-4">g</td>
                                <td
                                    class="bg-gray-100 align-middle text-xl whitespace-nowrap p-4"
                                >
                                    {{ sugercal }}g
                                </td>
                                <td
                                    class="bg-gray-100 align-middle text-xl whitespace-nowrap p-4"
                                >
                                    {{ sugercal }}% [<b class="text-red-300">{{
                                        sugercal
                                    }}</b
                                    >/100]g
                                </td>
                            </tr>

                            <tr>
                                <th
                                    class="whitespace-nowrap p-4 text-blueGray-700"
                                >
                                    コレステロール
                                </th>
                                <td class="text-xl whitespace-nowrap p-4">
                                    {{ 콜레스테롤 }}
                                </td>
                                <td class="text-xl whitespace-nowrap p-4">
                                    mg
                                </td>
                                <td
                                    class="bg-gray-100 align-middle text-xl whitespace-nowrap p-4"
                                >
                                    {{ colcal }}mg
                                </td>
                                <td
                                    class="bg-gray-100 align-middle text-xl whitespace-nowrap p-4"
                                >
                                    {{ colper }}% [<b class="text-red-300">{{
                                        colcal
                                    }}</b
                                    >/300]mg
                                </td>
                            </tr>

                            <tr>
                                <th
                                    class="whitespace-nowrap p-4 text-blueGray-700"
                                >
                                    飽和脂肪
                                </th>
                                <td class="text-xl whitespace-nowrap p-4">
                                    {{ 포화지방 }}
                                </td>
                                <td class="text-xl whitespace-nowrap p-4">g</td>
                                <td
                                    class="bg-gray-100 align-middle text-xl whitespace-nowrap p-4"
                                >
                                    {{ pofatcal }}g
                                </td>
                                <td
                                    class="bg-gray-100 align-middle text-xl whitespace-nowrap p-4"
                                >
                                    {{ pofatper }}% [<b class="text-red-300">{{
                                        pofatcal
                                    }}</b
                                    >/15]g
                                </td>
                            </tr>

                            <tr>
                                <th
                                    class="whitespace-nowrap p-4 text-blueGray-700"
                                >
                                    トランス脂肪
                                </th>
                                <td class="text-xl whitespace-nowrap p-4">
                                    {{ 트랜스지방 }}
                                </td>
                                <td class="text-xl whitespace-nowrap p-4">g</td>
                                <td
                                    class="bg-gray-100 align-middle text-xl whitespace-nowrap p-4"
                                >
                                    {{ transfatcal }}g
                                </td>
                                <td
                                    class="bg-gray-100 align-middle text-xl whitespace-nowrap p-4"
                                >
                                    {{ transfatper }}% [<b
                                        class="text-red-300"
                                        >{{ transfatcal }}</b
                                    >/2]g
                                </td>
                            </tr>

                            <tr>
                                <th
                                    class="whitespace-nowrap p-4 text-blueGray-700"
                                >
                                    ナトリウム
                                </th>
                                <td class="text-xl whitespace-nowrap p-4">
                                    {{ 나트륨 }}
                                </td>
                                <td class="text-xl whitespace-nowrap p-4">
                                    mg
                                </td>
                                <td
                                    class="bg-gray-100 align-middle text-xl whitespace-nowrap p-4"
                                >
                                    {{ saltcal }}mg
                                </td>
                                <td
                                    class="bg-gray-100 align-middle text-xl whitespace-nowrap p-4"
                                >
                                    {{ saltper }}% [<b class="text-red-300">{{
                                        saltcal
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
export default {
    props: ["food_id", "food_name"],
    components: {
        AppLayout,
    },
    computed: {
        kcalcal: function () {
            return ((this.kcal / this.food.일회제공량) * this.serve).toFixed(0);
        },
        proteincal: function () {
            return ((this.단백질 / this.food.일회제공량) * this.serve).toFixed(
                0
            );
        },
        fatcal: function () {
            return ((this.지방 / this.food.일회제공량) * this.serve).toFixed(0);
        },
        fatper: function () {
            return ((this.fatcal / 51) * 100).toFixed(0);
        },
        fiberper: function () {
            return ((this.fibercal / 250) * 100).toFixed(0);
        },
        fibercal: function () {
            return (
                (this.탄수화물 / this.food.일회제공량) *
                this.serve
            ).toFixed(0);
        },
        sugercal: function () {
            return ((this.당류 / this.food.일회제공량) * this.serve).toFixed(0);
        },
        proteinper: function () {
            return ((this.proteincal / 60) * 100).toFixed(0);
        },
        kcalper: function () {
            return ((this.kcalcal / 2000) * 100).toFixed(0);
        },
        colcal: function () {
            return (
                (this.콜레스테롤 / this.food.일회제공량) *
                this.serve
            ).toFixed(0);
        },
        colper: function () {
            return ((this.colcal / 300) * 100).toFixed(0);
        },
        pofatcal: function () {
            return (
                (this.포화지방 / this.food.일회제공량) *
                this.serve
            ).toFixed(0);
        },
        pofatper: function () {
            return ((this.pofatcal / 15) * 100).toFixed(0);
        },
        transfatcal: function () {
            return (
                (this.트랜스지방 / this.food.일회제공량) *
                this.serve
            ).toFixed(0);
        },
        transfatper: function () {
            return ((this.transfatcal / 2.2) * 100).toFixed(0);
        },
        saltcal: function () {
            return ((this.나트륨 / this.food.일회제공량) * this.serve).toFixed(
                0
            );
        },
        saltper: function () {
            return ((this.saltcal / 2000) * 100).toFixed(0);
        },
    },
    data() {
        return {
            food: "",
            items: [],
            image: "",
            post: [],
            data: [],
            pack: [],
            kcal: "",
            image: "/image/noimg.gif",
            serve: "",
            kcalcalc: "",
        };
    },

    mounted() {
        axios
            .get("/food/index/" + this.food_id + "/" + this.food_name)
            .then((response) => {
                this.food = response.data.food;
                this.getImage();
                this.kcal = parseInt(this.food.에너지_kcal_);
                this.나트륨 = parseInt(this.food.나트륨_mg_);
                this.탄수화물 = parseInt(this.food.탄수화물_g_);
                this.당류 = parseInt(this.food.총당류_g_);
                this.지방 = parseInt(this.food.지방_g_);
                this.트랜스지방 = parseInt(this.food.트랜스_지방산_g_);
                this.포화지방 = parseInt(this.food.총_포화_지방산_g_);
                this.콜레스테롤 = parseInt(this.food.콜레스테롤_mg_);
                this.단백질 = parseInt(this.food.단백질_g_);
                this.dailySalt = ((this.나트륨 / 2000) * 100).toFixed(1);
                this.dailyFiber = ((this.탄수화물 / 250) * 100).toFixed(1);
                this.dailySuger = this.당류;
                this.dailyFat = ((this.지방 / 51) * 100).toFixed(1);
                this.dailyTransFat = ((this.트랜스지방 / 2.2) * 100).toFixed(1);
                this.dailypoFat = ((this.포화지방 / 15) * 100).toFixed(1);
                this.dailyCole = (
                    (this.food.콜레스테롤_mg_ / 300) *
                    100
                ).toFixed(1);
                this.dailyProtein = ((this.food.단백질_g_ / 60) * 100).toFixed(
                    1
                );
                this.serve = this.food.일회제공량;
            });
    },
    methods: {
        save() {
            const bodyFormData = new FormData();
            bodyFormData.append("user_id", this.$page.props.user.id);
            bodyFormData.append("kcal", this.kcalcal);
            bodyFormData.append("kcal_per", this.kcalper);
            bodyFormData.append("pro", this.proteincal);
            bodyFormData.append("pro_per", this.proteinper);
            bodyFormData.append("fat", this.fatcal);
            bodyFormData.append("fat_per", this.fatper);
            bodyFormData.append("fiber", this.fibercal);
            bodyFormData.append("fiber_per", this.fiberper);
            bodyFormData.append("suger", this.sugercal);
            bodyFormData.append("suger_per", this.sugercal);
            bodyFormData.append("col", this.colcal);
            bodyFormData.append("col_per", this.colper);
            bodyFormData.append("po", this.pofatcal);
            bodyFormData.append("po_per", this.pofatper);
            bodyFormData.append("trans", this.transfatcal);
            bodyFormData.append("trans_per", this.transfatper);
            bodyFormData.append("salt", this.saltcal);
            bodyFormData.append("salt_per", this.saltper);
            bodyFormData.append("product_title", this.food_name);
            bodyFormData.append("product_id", this.food_id);
            bodyFormData.append("serve", this.serve + this.food.내용량_단위);
            axios
                .post("/menu/save", bodyFormData)
                .then((response) => {
                    if (response.data.status == "success") {
                        alert(
                            `${this.food_name}  ${this.serve}${this.food.내용량_단위} 저장완료`
                        );
                    }
                })
                .catch((error) => {
                    alert("에러");
                });
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
