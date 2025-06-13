<template>
    <app-layout data-theme="cupcake">
        <header>
            <!-- ヒーローセクション -->
            <div
                style="background-repeat: no-repeat"
                class="bg-food mx-auto bg-gray-400 h-96 rounded-md flex items-center bg-blend-multiply"
            >
                <!-- ヒーローテキスト -->
                <div class="sm:ml-20 text-gray-50 text-center sm:text-left">
                    <h1 class="text-5xl font-black mb-4">
                        気になる料理を <br />
                        探してみましょう！
                    </h1>
                    <div class="pt-2 mx-auto text-gray-600">
                        <div class="form-control">
                            <div class="relative flex">
                                <!-- 検索入力 -->
                                <input
                                    type="text"
                                    v-model="food_name"
                                    placeholder="料理名を入力してください"
                                    @keyup.enter="search"
                                    class="w-full pr-16 input input-primary input-bordered border-4"
                                />
                                <!-- 検索ボタン -->
                                <button
                                    @click="search"
                                    class="absolute top-0 right-0 rounded-l-none btn btn-primary"
                                >
                                    検索
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- ラジオボタン -->
                    <div class="wrapper2">
                        <input
                            type="radio"
                            name="select"
                            id="option-1"
                            value="food"
                            checked
                            v-model="picked"
                        />
                        <input
                            type="radio"
                            name="select"
                            id="option-2"
                            value="recipe"
                            v-model="picked"
                        />
                        <label for="option-1" class="option option-1">
                            <div class="dot"></div>
                            <span>料理</span>
                        </label>
                        <label for="option-2" class="option option-2">
                            <div class="dot"></div>
                            <span>レシピ</span>
                        </label>
                    </div>
                </div>
            </div>
        </header>
        <main class="py-8 container mx-auto px-4">
            <!-- ダイエットレシピセクション -->
            <section>
                <div class="flex flex-wrap items-center">
                    <div
                        class="relative w-full px-4 max-w-full flex-grow flex-1 mt-3"
                    >
                        <h3 class="font-semibold text-2xl text-base">
                            ダイエットレシピ
                        </h3>
                    </div>
                    <div
                        class="relative w-full px-4 max-w-full flex-grow flex-1 text-right"
                    >
                        <a
                            href="/recipe/search/다이어트"
                            data-theme="cupcake"
                            class="btn btn-xl glass text-primary transform transition duration-500 hover:scale-110"
                            type="button"
                            ><i class="fas fa-sign-in-alt fa-lg"
                                >&nbsp;もっと見る</i
                            ></a
                        >
                    </div>
                </div>
                <!-- カルーセル -->
                <carousel
                    :items-to-show="5"
                    :autoplay="3000"
                    :wrapAround="true"
                >
                    <slide v-for="post in posts" :key="post">
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
                    </slide>
                    <template #addons>
                        <navigation />
                    </template>
                </carousel>
                <hr
                    class="min-w-full my-2 border-4 rounded-md sm:mx-0 mx-auto"
                />
            </section>
            <!-- ペク・ジョンウォンレシピセクション -->
            <section>
                <div class="flex flex-wrap items-center">
                    <div
                        class="relative w-full px-4 max-w-full flex-grow flex-1 mt-3"
                    >
                        <h3 class="font-semibold text-2xl text-base">
                            ペク・ジョンウォンレシピ
                        </h3>
                    </div>
                    <div
                        class="relative w-full px-4 max-w-full flex-grow flex-1 text-right"
                    >
                        <a
                            href="/recipe/search/백종원"
                            data-theme="cupcake"
                            class="btn btn-xl glass text-primary transform transition duration-500 hover:scale-110"
                            type="button"
                            ><i class="fas fa-sign-in-alt fa-lg"
                                >&nbsp;もっと見る</i
                            ></a
                        >
                    </div>
                </div>
                <!-- カルーセル -->
                <carousel
                    :items-to-show="5"
                    :autoplay="4000"
                    :wrapAround="true"
                >
                    <slide v-for="post in posts2" :key="post">
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
                    </slide>
                    <template #addons>
                        <navigation />
                    </template>
                </carousel>

                <hr class="w-40 my-4 border-4 rounded-md sm:mx-0 mx-auto" />
            </section>
            <div class="mt-14">
                <a href="https://github.com/JHPDEVS/foodmap-web"
                    >https://github.com/JHPDEVS/foodmap-web</a
                >
            </div>
        </main>
    </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Jetstream/Welcome.vue";
import axios from "axios";
import cheerio from "cheerio";
import "vue3-carousel/dist/carousel.css";
import { Carousel, Slide, Pagination, Navigation } from "vue3-carousel";

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
        posts2: [],
        food_name: "떡볶이",
        picked: "food",
    }),
    mounted() {
        // ダイエットレシピを取得
        axios
            .get(
                `${this.$page.props.env.PROXY_BASE_URL}/https://www.10000recipe.com/recipe/list.html?q=다이어트`
            )
            .then((response) => {
                const $ = cheerio.load(response.data);
                const span = $(".rcp_m_list2 .common_sp_list_li");
                var posts = [];
                span.map(function (i, elem) {
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
            });
        this.fetchBaek();
    },
    methods: {
        // ペク・ジョンウォンレシピを取得
        fetchBaek() {
            axios
                .get(
                    `${this.$page.props.env.PROXY_BASE_URL}/https://www.10000recipe.com/recipe/list.html?q=백종원`
                )
                .then((response) => {
                    const $ = cheerio.load(response.data);
                    const span = $(".rcp_m_list2 .common_sp_list_li");
                    var posts = [];
                    span.map(function (i, elem) {
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
                    this.posts2 = posts;
                });
        },
        // 検索機能
        search() {
            if (this.food_name == "") {
                alert("料理名を正しく入力してください");
                return;
            }
            if (this.picked == "food") {
                window.location.href = "/food/" + this.food_name;
            } else {
                window.location.href = "/recipe/search/" + this.food_name;
            }
        },
    },
});
</script>

<style>
.carousel__prev {
    box-sizing: content-box;
    border: 5px solid white;
    background: #42b2b8;
    margin-left: 22px;
}

.carousel__next {
    box-sizing: content-box;
    border: 5px solid white;
    background: #42b2b8;
    margin-right: 22px;
}

.wrapper2 {
    display: inline-flex;
    height: 100px;
    width: 400px;
    align-items: center;
    justify-content: space-evenly;
    padding: 20px 15px;
}

.wrapper2 .option {
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

.wrapper2 .option .dot {
    height: 20px;
    width: 20px;
    background: #d9d9d9;
    border-radius: 50%;
    position: relative;
}

.wrapper2 .option .dot::before {
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

.wrapper2 .option span {
    font-size: 20px;
    color: #808080;
}

#option-1:checked:checked ~ .option-1 span,
#option-2:checked:checked ~ .option-2 span {
    color: #fff;
}
</style>
