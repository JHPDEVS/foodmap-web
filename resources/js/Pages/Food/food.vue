<template>
    <app-layout data-theme="cupcake">
        <div class="w-full p-10">
            <!-- メインカテゴリー選択 -->
            <div class="min-w-full overflow-y-auto bg-white card mx-auto">
                <div class="wrapper">
                    <input
                        type="radio"
                        name="select"
                        id="option-1"
                        checked
                        v-model="picked"
                        value="food"
                    />
                    <input
                        type="radio"
                        name="select"
                        id="option-2"
                        v-model="picked"
                        value="recipe"
                    />
                    <label for="option-1" class="option option-1">
                        <span>食品</span>
                    </label>
                    <label for="option-2" class="option option-2">
                        <span>レシピ</span>
                    </label>
                </div>
            </div>

            <!-- サブカテゴリー選択 (食品のみ) -->
            <div
                v-if="picked == 'food'"
                class="min-w-full flex overflow-y-auto bg-white card mx-auto mt-3"
            >
                <div class="wrapper">
                    <input
                        type="radio"
                        name="select2"
                        id="option-6"
                        checked
                        v-model="picked2"
                        value="all"
                        @change="refresh()"
                    />
                    <input
                        type="radio"
                        name="select2"
                        id="option-7"
                        v-model="picked2"
                        value="livestock"
                        @change="refresh()"
                    />
                    <input
                        type="radio"
                        name="select2"
                        id="option-8"
                        v-model="picked2"
                        value="seafood"
                        @change="refresh()"
                    />
                    <input
                        type="radio"
                        name="select2"
                        id="option-9"
                        v-model="picked2"
                        value="processed"
                        @change="refresh()"
                    />
                    <input
                        type="radio"
                        name="select2"
                        id="option-10"
                        v-model="picked2"
                        value="food2"
                        @change="refresh()"
                    />
                    <label for="option-6" class="option option-6">
                        <span class="flex">すべて</span>
                    </label>
                    <label for="option-7" class="option option-7">
                        <span class="flex">農畜産物</span>
                    </label>
                    <label for="option-8" class="option option-8">
                        <span>水産物</span>
                    </label>
                    <label for="option-9" class="option option-9">
                        <span>加工食品</span>
                    </label>
                    <label for="option-10" class="option option-10">
                        <span>食品</span>
                    </label>
                </div>
            </div>

            <!-- ページネーションと検索 -->
            <div class="min-w-full overflow-y-auto card mx-auto mt-3">
                <div class="container flex justify-center mx-auto">
                    <nav
                        class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px"
                        aria-label="Pagination"
                    >
                        <!-- ページリンク -->
                        <a v-for="(item, i) in page.links" v-bind:key="i">
                            <button
                                @click="refreshPage(item.label)"
                                v-if="item.active == true"
                                class="py-3 z-10 bg-primary border-primary text-white relative inline-flex items-center px-4 py-2 border text-sm font-medium"
                            >
                                {{ item.label }}
                            </button>
                            <button
                                @click="refreshPage(item.label)"
                                v-else
                                class="py-3 bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-mediums"
                            >
                                {{ item.label }}
                            </button>
                        </a>
                    </nav>
                </div>
                <!-- 検索バー -->
                <div class="min-w-full mx-auto mt-3 pb-5 h-10">
                    <div class="form-control">
                        <div class="relative">
                            <input
                                v-model="search_value"
                                type="text"
                                @keyup.enter="search"
                                placeholder="キーワードを入力してください"
                                class="w-full text-3xl pr-8 input input-primary input-bordered"
                            />
                            <button
                                @click="search"
                                class="absolute top-0 right-0 rounded-l-none btn btn-primary"
                            >
                                検索
                            </button>
                        </div>
                    </div>
                </div>

                <!-- 検索結果テーブル -->
                <section class="container mx-auto p-6 font-mono">
                    <div class="text-2xl font-bold mb-3">
                        <b class="text-3xl text-primary font-bold">{{
                            food_name
                        }}</b>
                        の検索結果&nbsp;
                        <b class="text-3xl text-primary font-bold">
                            {{ page.total }} </b
                        >件の美味しい食品があります。
                    </div>

                    <div
                        class="w-full mb-8 overflow-hidden rounded-lg shadow-lg"
                    >
                        <div class="w-full overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr
                                        class="text-xl font-bold tracking-wide text-left text-white bg-primary uppercase border-b border-gray-600"
                                    >
                                        <th class="px-4 py-3">商品名</th>
                                        <th class="px-4 py-3">調査年度</th>
                                        <th class="px-4 py-3">一回提供量</th>
                                        <th class="px-4 py-3">分類</th>
                                        <th class="px-4 py-3">
                                            一回提供量あたりカロリー
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    <tr
                                        class="text-gray-700"
                                        v-for="(food, i) in foods"
                                        v-bind:key="i"
                                    >
                                        <td class="px-4 py-3 border">
                                            <div
                                                class="flex items-center text-xl"
                                            >
                                                <div>
                                                    <a
                                                        :href="`/food/show/${food.NO}/${food.식품명}`"
                                                    >
                                                        <p
                                                            class="font-semibold text-blue-500"
                                                        >
                                                            <span
                                                                class="bg-white border text-red-600 py-1 px-3 rounded-full text-xs"
                                                                >{{
                                                                    food.지역___제조사
                                                                }}</span
                                                            >
                                                            {{ food.식품명 }}
                                                        </p>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td
                                            class="px-4 py-3 text-ms font-semibold border"
                                        >
                                            {{ food.연도 }}
                                        </td>
                                        <td
                                            class="px-4 py-3 text-ms font-semibold border"
                                        >
                                            {{ food.일회제공량 }}
                                        </td>
                                        <td class="px-4 py-3 text-xs border">
                                            <span
                                                class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-sm"
                                            >
                                                {{ food.식품대분류 }}
                                            </span>
                                        </td>
                                        <td
                                            class="px-4 py-3 text-xl font-bold border"
                                        >
                                            {{ food.에너지_kcal_ }} Kcal
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </app-layout>
</template>

<script>
import axios from "axios";
import AppLayout from "@/Layouts/AppLayout.vue";
export default {
    props: ["food_name"],
    components: {
        AppLayout,
    },
    data() {
        return {
            foods: [],
            page: [],
            search_value: "",
            picked: "food", // メインカテゴリー
            picked2: "all", // サブカテゴリー
            data: [],
        };
    },

    mounted() {
        // 初期検索結果を取得
        axios
            .get("/food/search/" + this.food_name, {
                params: {
                    kind: "all",
                },
            })
            .then((response) => {
                this.page = response.data.foods;
                this.foods = response.data.foods.data;
                this.pageLinks = response.data.foods.links;
            });
        this.search_value = this.food_name;
    },

    methods: {
        // ページネーション切り替え
        refreshPage(page) {
            if (page == "<") {
                if (this.pageLinks[0].url) {
                    page = this.pageLinks[0].url.charAt(
                        this.pageLinks[0].url.length - 1
                    );
                } else {
                    page = 1;
                }
            }
            if (page == ">") {
                if (this.pageLinks[this.page.last_page + 1].url) {
                    page = this.pageLinks[this.page.last_page + 1].url.charAt(
                        this.pageLinks[this.page.last_page + 1].url.length - 1
                    );
                } else {
                    page = this.page.last_page;
                }
            }
            axios
                .get("/food/search/" + this.food_name + "?page=" + page, {
                    params: {
                        kind: this.picked2,
                    },
                })
                .then((response) => {
                    this.page = response.data.foods;
                    this.pageId = response.data.foods.current_page;
                    this.foods = response.data.foods.data;
                    this.pageLinks = response.data.foods.links;
                });
        },
        // サブカテゴリー切り替え
        refresh() {
            axios
                .get("/food/search/" + this.food_name, {
                    params: {
                        kind: this.picked2,
                    },
                })
                .then((response) => {
                    this.data = response.data.kind;
                    this.page = response.data.foods;
                    this.foods = response.data.foods.data;
                    this.pageLinks = response.data.foods.links;
                });
        },
        // 検索ボタン or Enterで検索
        search() {
            if (this.search_value == "") {
                alert("食品名を正しく入力してください");
                return;
            }
            if (this.picked == "food") {
                window.location.href = "/food/" + this.search_value;
            } else {
                window.location.href = "/recipe/search/" + this.search_value;
            }
        },
    },
};
</script>
<style>
/* ラジオボタンスタイル */
.wrapper {
    display: inline-flex;
    height: 100px;
    align-items: center;
    justify-content: space-evenly;
    padding: 20px 15px;
}
.wrapper .option {
    background: #fff;
    height: 100%;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-evenly;
    margin: 0 10px;
    border-radius: 5px;
    cursor: pointer;
    padding: 0 10px;
    border: 2px solid lightgrey;
    transition: all 0.3s ease;
}
.wrapper .option .dot {
    height: 20px;
    width: 20px;
    background: #d9d9d9;
    border-radius: 50%;
    position: relative;
}
.wrapper .option .dot::before {
    position: absolute;
    content: "";
    top: 4px;
    left: 4px;
    width: 12px;
    height: 12px;
    background: #42b2b8;
    border-radius: 50%;
    opacity: 0;
    transform: scale(1.5);
    transition: all 0.3s ease;
}
input[type="radio"] {
    display: none;
}
#option-1:checked:checked ~ .option-1,
#option-2:checked:checked ~ .option-2,
#option-6:checked:checked ~ .option-6,
#option-7:checked:checked ~ .option-7,
#option-8:checked:checked ~ .option-8,
#option-9:checked:checked ~ .option-9,
#option-10:checked:checked ~ .option-10 {
    border-color: #42b2b8;
    background: #42b2b8;
}
#option-1:checked:checked ~ .option-1 .dot,
#option-2:checked:checked ~ .option-2 .dot,
#option-6:checked:checked ~ .option-6 .dot,
#option-7:checked:checked ~ .option-7 .dot,
#option-8:checked:checked ~ .option-8 .dot,
#option-9:checked:checked ~ .option-9 .dot,
#option-10:checked:checked ~ .option-10 .dot {
    background: #fff;
}
#option-1:checked:checked ~ .option-1 .dot::before,
#option-2:checked:checked ~ .option-2 .dot::before,
#option-6:checked:checked ~ .option-6 .dot::before,
#option-7:checked:checked ~ .option-7 .dot::before,
#option-8:checked:checked ~ .option-8 .dot::before,
#option-9:checked:checked ~ .option-9 .dot::before,
#option-10:checked:checked ~ .option-10 .dot::before {
    opacity: 1;
    transform: scale(1);
}
.wrapper .option span {
    font-size: 20px;
    color: #808080;
}
#option-1:checked:checked ~ .option-1 span,
#option-2:checked:checked ~ .option-2 span,
#option-6:checked:checked ~ .option-6 span,
#option-7:checked:checked ~ .option-7 span,
#option-8:checked:checked ~ .option-8 span,
#option-9:checked:checked ~ .option-9 span,
#option-10:checked:checked ~ .option-10 span {
    color: #fff;
}
</style>
