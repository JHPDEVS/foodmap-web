<template>
    <app-layout data-theme="cupcake">
        <div class="w-full p-10">
            <!-- メインセクション -->
            <div class="min-w-full overflow-y-auto bg-white card mx-auto">
                <!-- レシピ/料理選択ラジオボタン -->
                <div class="wrapper">
                    <input
                        type="radio"
                        name="select"
                        id="option-1"
                        checked
                        v-model="picked"
                        value="recipe"
                    />
                    <input
                        type="radio"
                        name="select"
                        id="option-2"
                        v-model="picked"
                        value="food"
                    />
                    <label for="option-1" class="option option-1">
                        <span>レシピ</span>
                    </label>
                    <label for="option-2" class="option option-2">
                        <span>料理</span>
                    </label>
                </div>
            </div>

            <!-- 推奨検索語 -->
            <div class="min-w-full mx-auto mt-2 bg-white card">
                <div class="px-5 py-3">
                    <h3 class="font-bold text-2xl">おすすめ検索語</h3>
                    <!-- タグコンテナ -->
                    <div class="my-3 flex flex-wrap -m-1">
                        <div v-for="(item, i) in recommends" :key="i">
                            <span
                                v-if="item.recommend"
                                class="m-1 bg-gray-200 hover:bg-gray-300 rounded-full px-2 font-bold text-xl leading-loose cursor-pointer"
                                ><a
                                    :href="`/recipe/search/${item.recommend}`"
                                    >{{ item.recommend }}</a
                                ></span
                            >
                        </div>
                        <span
                            v-if="recommends.length == 0"
                            class="m-1 bg-gray-200 hover:bg-gray-300 rounded-full px-2 font-bold text-xl leading-loose cursor-pointer"
                            >おすすめ検索語が見つかりません</span
                        >
                    </div>
                </div>
            </div>

            <!-- ページネーション -->
            <div class="min-w-full mx-auto mt-5 card flex items-center">
                <div class="flex">
                    <nav
                        class="relative z-0 flex-nowrap rounded-md shadow-sm -space-x-px lg:inline-flex"
                        aria-label="Pagination"
                    >
                        <!-- 現在のページ -->
                        <a v-for="(item, i) in pagination" v-bind:key="i">
                            <button
                                @click="refreshPage(item.page)"
                                v-if="item.page == current_page"
                                class="py-3 z-10 bg-primary border-primary text-white relative inline-flex items-center px-4 py-2 border text-sm font-medium"
                            >
                                {{ item.page }}
                            </button>
                            <button
                                @click="refreshPage(item.page)"
                                v-else
                                class="py-3 bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-mediums"
                            >
                                {{ item.page }}
                            </button>
                        </a>
                    </nav>
                </div>
                <div></div>
            </div>

            <!-- 検索バー -->
            <div class="min-w-full mx-auto mt-5 pb-5 h-10">
                <div class="form-control">
                    <div class="relative">
                        <input
                            :value="recipe_name"
                            @input="
                                $emit('update:recipe_name', $event.target.value)
                            "
                            type="text"
                            @keyup.enter="search"
                            placeholder="検索語を入力してください"
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

            <!-- レシピ結果セクション -->
            <div class="bg-gray-100 min-h-screen py-10 px-10">
                <div v-if="count != ''" class="text-2xl font-bold mb-3">
                    合計
                    <b class="text-3xl text-primary font-bold">{{ count }} </b
                    >件の美味しいレシピが見つかりました。
                </div>
                <div v-else class="text-2xl font-bold mb-3">
                    合計 <b class="text-3xl text-primary font-bold">0 </b>件の
                    美味しいレシピが見つかりました。
                </div>
                <div
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 md:gap-x-10 xl-grid-cols-4 gap-y-10 gap-x-6"
                >
                    <!-- レシピカード -->
                    <div
                        v-for="(post, i) in posts"
                        :key="i"
                        class="container mx-auto shadow-lg rounded-lg max-w-md hover:shadow-2xl transition duration-300"
                    >
                        <div class="carousel__item">
                            <div class="card bordered compact mx-3">
                                <a :href="post.href">
                                    <figure>
                                        <img
                                            :src="post.thumb"
                                            alt="post.title"
                                            class="object-cover w-96 h-48 w-full"
                                        />
                                    </figure>
                                    <div class="card-body">
                                        <h4 class="font-bold">
                                            {{ post.title }}
                                        </h4>
                                        <div class="flex mt-2">
                                            <img
                                                :src="post.rvimg"
                                                :alt="post.rvtext"
                                                class="inline object-cover w-8 h-8 mr-2 rounded-full"
                                            />
                                            <a :href="post.rvhref">
                                                <p class="mt-1.5">
                                                    {{ post.rvtext }}
                                                </p>
                                            </a>
                                        </div>
                                        <p class="text-left">{{ post.view }}</p>
                                        <div class="flex mt-2">
                                            <h1
                                                class="text-yellow-500 mr-1"
                                                v-for="(n, i) in post.star"
                                                v-bind:key="i"
                                            >
                                                ★
                                            </h1>
                                            {{ post.staruser }}
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="bottom-0 mx-auto">
                        <button
                            class="fixed left-2/4 mb-10 transform opacity-70 -translate-x-2/4 bottom-0 btn-primary text-white p-5 rounded hover:bg-primary-700"
                            @click="onTop"
                        >
                            <i class="fas fa-arrow-up font-3xl"></i>
                        </button>
                    </div>
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
    props: {
        recipe_name: {
            type: String,
            required: true,
        },
    },
    components: {
        AppLayout,
    },
    data: () => ({
        recommends: [], // 推奨検索語
        posts: [], // レシピ投稿
        count: "", // レシピ合計数
        pagination: [], // ページネーション情報
        search_value: "", // 検索値
        current_page: 1, // 現在のページ
        picked: "recipe", // 選択されたカテゴリー
    }),

    mounted() {
        // 推奨検索語を取得
        this.search_value = this.recipe_name;
        axios
            .get(
                `${this.$page.props.env.PROXY_BASE_URL}/https://www.10000recipe.com/recipe/list.html?q=` +
                    this.recipe_name
            )
            .then((response) => {
                const $ = cheerio.load(response.data);
                const span = $("#contents_area_full .s_category_tag ul li");
                var recommends = [];
                span.map(function (i, elem) {
                    var recommend = $(this).find("a").text();
                    let value = {
                        recommend: recommend,
                    };
                    recommends.push(value);
                });
                this.recommends = recommends;

                // レシピ合計数を取得
                const count = $(".rcp_m_list2 .m_list_tit");
                var countvalue = $(count).find("b").first().text();
                this.count = countvalue;

                // レシピ投稿を取得
                const post = $(".rcp_m_list2 .common_sp_list_li");
                var posts = [];
                post.map(function (i, elem) {
                    var thumb = $(this)
                        .find(".common_sp_thumb img")
                        .last()
                        .attr("src");
                    var title = $(this)
                        .find(".common_sp_caption .line2")
                        .first()
                        .text();
                    var rvhref = $(this)
                        .find(".common_sp_caption_rv_name a")
                        .attr("href");
                    var href = $(this).find(".common_sp_thumb a").attr("href");
                    var rvtext = $(this)
                        .find(".common_sp_caption_rv_name a")
                        .text();
                    var rvimg = $(this)
                        .find(".common_sp_caption_rv_name a img")
                        .attr("src");
                    var view = $(this)
                        .find(".common_sp_caption_rv span")
                        .last()
                        .text();
                    var star = $(this)
                        .find(
                            ".common_sp_caption_rv .common_sp_caption_rv_star"
                        )
                        .children().length;
                    var staruser = $(this)
                        .find(".common_sp_caption_rv .common_sp_caption_rv_ea")
                        .text();
                    let value = {
                        thumb: thumb,
                        title: title,
                        rvhref: "https://www.10000recipe.com" + rvhref,
                        href: href,
                        rvtext: rvtext,
                        rvimg: rvimg,
                        view: view,
                        star,
                        staruser,
                    };
                    posts.push(value);
                });
                this.posts = posts;

                // ページネーション
                const pagination = $("nav .pagination li");
                var paginations = [];
                pagination.map(function (i, elem) {
                    var pagehref = $(this).find("a").text();
                    let value = {
                        page: pagehref,
                    };
                    paginations.push(value);
                });
                this.pagination = paginations;
            });
    },

    methods: {
        // ページをリフレッシュ
        refreshPage(page) {
            if (page == "<") {
                this.current_page = parseInt(this.current_page) - 1;
            } else if (page == ">") {
                this.current_page = parseInt(this.current_page) + 1;
            } else {
                this.current_page = page;
            }
            axios
                .get(
                    `${this.$page.props.env.PROXY_BASE_URL}/https://www.10000recipe.com/recipe/list.html?q=` +
                        this.search_value +
                        "&order=reco&page=" +
                        this.current_page
                )
                .then((response) => {
                    const $ = cheerio.load(response.data);
                    // レシピ投稿を取得
                    const post = $(".rcp_m_list2 .common_sp_list_li");
                    var posts = [];
                    post.map(function (i, elem) {
                        var thumb = $(this)
                            .find(".common_sp_thumb img")
                            .last()
                            .attr("src");
                        var title = $(this)
                            .find(".common_sp_caption .line2")
                            .first()
                            .text();
                        var rvhref = $(this)
                            .find(".common_sp_caption_rv_name a")
                            .attr("href");
                        var href = $(this)
                            .find(".common_sp_thumb a")
                            .attr("href");
                        var rvtext = $(this)
                            .find(".common_sp_caption_rv_name a")
                            .text();
                        var rvimg = $(this)
                            .find(".common_sp_caption_rv_name a img")
                            .attr("src");
                        var view = $(this)
                            .find(".common_sp_caption_rv span")
                            .last()
                            .text();
                        var star = $(this)
                            .find(
                                ".common_sp_caption_rv .common_sp_caption_rv_star"
                            )
                            .children().length;
                        var staruser = $(this)
                            .find(
                                ".common_sp_caption_rv .common_sp_caption_rv_ea"
                            )
                            .text();
                        let value = {
                            thumb: thumb,
                            title: title,
                            rvhref: "https://www.10000recipe.com" + rvhref,
                            href: href,
                            rvtext: rvtext,
                            rvimg: rvimg,
                            view: view,
                            star,
                            staruser,
                        };
                        posts.push(value);
                    });
                    this.posts = posts;

                    // ページネーション
                    const pagination = $("nav .pagination li");
                    var paginations = [];
                    pagination.map(function (i, elem) {
                        var pagehref = $(this).find("a").text();
                        let value = {
                            page: pagehref,
                        };
                        paginations.push(value);
                    });
                    this.pagination = paginations;
                });
        },

        // 検索機能
        search() {
            if (this.recipe_name == "") {
                alert("料理名を正しく入力してください");
                return;
            }
            if (this.picked == "food") {
                window.location.href = "/food/" + this.recipe_name;
            } else {
                window.location.href = "/recipe/search/" + this.recipe_name;
            }
        },

        // ページの一番上に移動
        onTop() {
            document.documentElement.scrollTop = 0;
        },
    },
};
</script>

<style>
/* ラジオボタンデザイン */
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
#option-2:checked:checked ~ .option-2 {
    border-color: #42b2b8;
    background: #42b2b8;
}

#option-1:checked:checked ~ .option-1 .dot,
#option-2:checked:checked ~ .option-2 .dot {
    background: #fff;
}

#option-1:checked:checked ~ .option-1 .dot::before,
#option-2:checked:checked ~ .option-2 .dot::before {
    opacity: 1;
    transform: scale(1);
}

.wrapper .option span {
    font-size: 20px;
    color: #808080;
}

#option-1:checked:checked ~ .option-1 span,
#option-2:checked:checked ~ .option-2 span {
    color: #fff;
}
</style>
