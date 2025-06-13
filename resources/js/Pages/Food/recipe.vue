<template>
    <app-layout data-theme="cupcake">
        <div
            v-if="isLoading"
            class="flex flex-col items-center justify-center py-32"
        >
            <div class="relative">
                <!-- Outer ring -->
                <div
                    class="w-20 h-20 rounded-full border-4 border-gray-200"
                ></div>
                <!-- Inner spinning ring -->
                <div
                    class="absolute top-0 left-0 w-20 h-20 rounded-full border-4 border-t-primary border-r-transparent border-b-transparent border-l-transparent animate-spin"
                ></div>
            </div>
            <p class="mt-6 text-lg font-medium text-gray-600">
                レシピを読み込み中...
            </p>
        </div>

        <template v-else>
            <div
                class="container mx-auto max-w-2xl rounded-lg overflow-hidden shadow-lg my-2 bg-white"
            >
                <div class="relative z-10">
                    <img
                        class="w-full"
                        :src="post.thumb"
                        alt="プロフィール画像"
                    />
                    <div
                        class="text-center absolute w-full"
                        style="bottom: 6rem"
                    >
                        <div class="flex justify-center">
                            <img
                                :src="post.user_profile_thumb"
                                :alt="post.user_profile_name"
                                class="rounded-full mx-auto absolute -top-100 w-32 h-32 shadow-2xl border-4 border-white"
                            />
                        </div>
                    </div>
                </div>

                <div
                    class="relative flex justify-between items-center flex-row px-6 z-50 -mt-10"
                >
                    <button class="btn bg-gray btn-sm">
                        <p>
                            <i class="far fa-eye"></i>
                            <a
                                :href="`https://www.10000recipe.com/recipe/${recipe_id}`"
                                >元のレシピを見る</a
                            >
                        </p>
                    </button>
                    <button class="btn btn-sm btn-primary">
                        <p><i class="far fa-eye"></i> {{ post.view }}</p>
                    </button>
                </div>
                <div class="mt-5 text-gray-600 text-center">
                    <br />
                    <p class="font-bold mt-3 text-xl">
                        {{ post.user_profile_name }}
                    </p>
                    <h1 class="p-4 font-bold text-3xl mt-3 tracking-wider">
                        {{ post.summary_title }}
                    </h1>
                    <h3 class="text-gray-500">{{ post.summary_content }}</h3>
                </div>
                <div class="text-gray-300 mt-4">
                    <hr />
                </div>
                <div
                    class="pt-5 pb-3 uppercase text-center tracking-wide flex justify-around"
                >
                    <div>
                        <i class="fas fa-utensil-spoon fa-lg text-gray-400"></i>
                        <p class="text-lg font-semibold text-gray-400">
                            {{ post.summary_people }}
                        </p>
                    </div>
                    <div>
                        <i class="fas fa-clock fa-lg text-gray-400"></i>
                        <p class="text-lg font-semibold text-gray-400">
                            {{ post.summary_time }}
                        </p>
                    </div>
                    <div>
                        <i class="fas fa-star fa-lg text-gray-400"></i>
                        <p class="text-lg font-semibold text-gray-400">
                            {{ post.summary_grade }}
                        </p>
                    </div>
                </div>
            </div>
            <div
                class="container mx-auto max-w-2xl rounded-lg overflow-hidden shadow-lg my-2 bg-white"
            >
                <div class="text-xl mx-6 m-2 flex">
                    <p class="font-bold">材料</p>
                    <p class="text-gray-400 text-sm">Ingredients</p>
                </div>
                <div class="flex flex-wrap">
                    <div
                        v-for="(ingredient, i) in ingredients"
                        :key="i"
                        class="w-1/4 text-center border"
                    >
                        <div class="font-bold mt-2 text-red-500">
                            <a :href="`/food/${ingredient.ingredient_title}`">{{
                                ingredient.ingredient_title
                            }}</a>
                        </div>
                        <div class="text-gray-500">
                            {{ ingredient.ingredient_unit }}
                        </div>
                        <hr />
                    </div>
                </div>
            </div>

            <div
                class="container mx-auto max-w-2xl rounded-lg overflow-hidden shadow-lg my-2 bg-white"
                v-if="post.movie"
            >
                <div class="text-xl mx-6 m-2 flex">
                    <p class="font-bold">動画</p>
                    <p class="text-gray-400 text-sm">Movie</p>
                </div>
                <hr />
                <div>
                    <iframe
                        id="ifrmRecipeVideo"
                        :src="post.movie"
                        frameborder="0"
                        width="640"
                        height="360"
                        allowfullscreen=""
                        style="width: 700px; height: 422px"
                    ></iframe>
                </div>
            </div>

            <div
                class="container mx-auto max-w-2xl rounded-lg overflow-hidden shadow-lg my-2 bg-white"
            >
                <div class="text-xl mx-6 m-2 flex">
                    <p class="font-bold">調理手順</p>
                    <p class="text-gray-400 text-sm">Steps</p>
                </div>
                <hr />
                <div class="flex flex-wrap justify-between">
                    <div class="steps-vertical">
                        <div
                            v-for="(step, i) in steps"
                            :key="i"
                            class="px-6 py-5 shadow-lg my-3 bg-white"
                        >
                            <div class="btn-circle btn btn-sm mb-3">
                                {{ i + 1 }}
                            </div>
                            <div class="text-2xl text-gray tracking-wider">
                                {{ step.step_left }}
                            </div>
                            <div
                                v-if="step.step_tip"
                                class="font-bold text-xl text-gray-400"
                            >
                                <i class="fas fa-question-circle"
                                    >&nbsp;TIP : {{ step.step_tip }}</i
                                >
                            </div>
                            <img :src="step.step_right" class="w-full mt-3" />
                        </div>

                        <div v-if="post.tip">
                            <img
                                src="https://recipe1.ezmember.co.kr/img/tit_tip.gif"
                                alt=""
                            />
                            <p class="p-8 text-xl mb-3 tracking-wider mt-3">
                                {{ post.tip }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="container mx-auto max-w-2xl rounded-lg overflow-hidden shadow-lg my-2 bg-white"
            >
                <div class="text-xl mx-6 m-2 flex">
                    <p class="font-bold">コメント</p>
                    <p class="text-gray-400 text-sm">Comments</p>
                    <p class="text-red-500">&nbsp;{{ reviews.length }}</p>
                </div>
                <hr />
                <div>
                    <div
                        v-for="(review, i) in reviews"
                        :key="i"
                        class="px-8 py-3 shadow-lg my-3 bg-white min-w-full"
                    >
                        <div class="mt-1">
                            <div class="flex">
                                <div class="flex items-center space-x-4 mb-1">
                                    <div>
                                        <img
                                            v-if="review.profile"
                                            class="w-12 h-12 rounded-full"
                                            :src="review.profile"
                                            :alt="review.nickname"
                                        />
                                        <img
                                            v-else
                                            src="https://recipe1.ezmember.co.kr/img/icon_reply3.gif"
                                        />
                                    </div>
                                    <div
                                        class="text-xl font-semibold text-red-400"
                                    >
                                        {{ review.nickname }}
                                        <span
                                            class="text-sm text-gray-400 font-normal"
                                            >{{ review.date }}</span
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex">
                            <h1
                                class="text-yellow-500 mr-1"
                                v-for="(n, i) in review.star"
                                v-bind:key="i"
                            >
                                ★
                            </h1>
                        </div>
                        <p class="text-md text-gray-600">
                            {{ review.comment }}
                        </p>
                    </div>
                </div>
                <div class="bottom-0 mx-auto">
                    <button
                        class="fixed left-3/4 mb-10 transform -translate-x-1/4 bottom-0 btn-primary text-white p-5 rounded opacity-70 hover:bg-primary-700"
                        @click="onTop"
                    >
                        <i class="fas fa-arrow-up font-3xl"></i>
                    </button>
                </div>
            </div>
        </template>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import axios from "axios";
import cheerio from "cheerio";
export default {
    props: ["recipe_id"],
    components: {
        AppLayout,
    },
    data: () => ({
        post: "",
        ingredients: [],
        steps: [],
        reviews: [],
        isLoading: true,
        error: null,
    }),
    mounted() {
        // レシピ概要を取得

        this.isLoading = true;

        axios
            .get(
                `${this.$page.props.env.PROXY_BASE_URL}/https://www.10000recipe.com/recipe/` +
                    this.recipe_id
            )
            .then((response) => {
                console.log(response.data);
                const $ = cheerio.load(response.data);
                const span = $("#contents_area_full");
                var post = [];
                span.map(function (i, elem) {
                    var thumb = $(this)
                        .find(".view2_pic .centeredcrop img")
                        .first()
                        .attr("src");
                    var view = $(this)
                        .find(".view2_pic .view_cate .view_cate_num span")
                        .text();
                    var user_profile_name = $(this)
                        .find(".view2_pic .user_info2 span")
                        .text();
                    var user_profile_thumb = $(this)
                        .find(".view2_pic .user_info2 a img")
                        .attr("src");
                    var summary_title = $(this)
                        .find(".view2_summary h3")
                        .text();
                    var summary_content = $(this).find(".st3 h3").text();
                    var summary_in = $(this).find(".view2_summary_in").text();
                    var summary_people = $(this)
                        .find(".view2_summary_info .view2_summary_info1")
                        .text();
                    var summary_time = $(this)
                        .find(".view2_summary_info .view2_summary_info2")
                        .text();
                    var summary_grade = $(this)
                        .find(".view2_summary_info .view2_summary_info3")
                        .text();
                    var movie = $(this)
                        .find(".movie_area .iframe_wrap iframe")
                        .attr("org_src");
                    var tip = $(this).find(".view_step_tip dd").text();
                    let value = {
                        view: view,
                        thumb: thumb,
                        user_profile_name: user_profile_name.trim(),
                        user_profile_thumb: user_profile_thumb,
                        summary_title: summary_title,
                        summary_in: summary_in,
                        summary_people: summary_people,
                        summary_time: summary_time,
                        summary_grade: summary_grade,
                        summary_content: summary_content,
                        tip: tip,
                        movie: movie,
                    };
                    post.push(value);
                });
                this.post = post[0];

                const span2 = $(
                    "#contents_area_full .cont_ingre2 .ready_ingre3 ul li"
                );
                var ingredients = [];

                // 各材料の要素をループして処理
                span2.each(function (i, elem) {
                    // 材料名を抽出
                    var ingredient_title = $(this)
                        .find(".ingre_list_name")
                        .text() // テキストを取得
                        .trim(); // 前後の空白を削除

                    // 材料の数量または単位を抽出
                    var ingredient_unit = $(this)
                        .find(".ingre_list_ea")
                        .text() // テキストを取得
                        .trim(); // 前後の空白を削除

                    // オブジェクトを作成し、配列に追加
                    let value = {
                        ingredient_title: ingredient_title, // 材料名
                        ingredient_unit: ingredient_unit, // 数量や単位
                    };
                    ingredients.push(value);
                });

                this.ingredients = ingredients;
                this.ifLoading = 1;
                this.posts = post;
                this.ifLoading = 1;

                // 手順情報を取得
                const step = $("#contents_area_full .view_step .media");
                var steps = [];
                step.map(function (i, elem) {
                    var i = i;
                    var step_left = $(this).find(".media-body").text();
                    var step_right = $(this)
                        .find("#stepimg" + (i + 1))
                        .children()
                        .attr("src");
                    var step_tip = $(this).find(".media-body p").text();
                    let value = {
                        index: i + 1,
                        step_left: step_left
                            .trim()
                            .slice(
                                0,
                                step_left.trim().length - step_tip.length
                            ),
                        step_right: step_right,
                        step_tip: step_tip,
                    };
                    steps.push(value);
                });
                this.steps = steps;
                this.ifLoading = 1;

                // コメント情報を取得

                const review = $("#contents_area_full .view_reply .media");
                var reviews = [];
                review.map(function (i, elem) {
                    var profile = $(this).find(".media-left a img").attr("src");
                    var nickname = $(this)
                        .find(".media-body h4 .info_name_f")
                        .text();
                    var date = $(this)
                        .find(".media-body .media-heading")
                        .first()
                        .text();
                    var star = $(this)
                        .find(".media-body .reply_list_star")
                        .children().length;
                    var comment = $(this).find(".media-body p").first().text();
                    let value = {
                        profile: profile,
                        nickname: nickname,
                        date: date.slice(nickname.length, date.length),
                        star: star,
                        comment: comment,
                    };
                    reviews.push(value);
                });
                this.reviews = reviews;
                console.log(this.reviews);
            })
            .catch((error) => {
                console.error("データの取得中にエラーが発生しました:", error);
                this.error =
                    "データの取得中にエラーが発生しました。再度お試しください。";
            })
            .finally(() => {
                this.isLoading = false;
            });
    },

    methods: {
        onTop() {
            document.documentElement.scrollTop = 0;
        },
    },
};
</script>
