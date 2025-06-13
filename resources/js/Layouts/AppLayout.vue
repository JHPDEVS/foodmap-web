<template>
    <div>
        <!-- ページのタイトル -->
        <Head :title="title" />

        <!-- 通知バナー -->
        <jet-banner />

        <div class="min-h-screen bg-gray-100">
            <nav class="bg-white border-b border-gray-100">
                <!-- ナビゲーションメニュー -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- ロゴ -->
                            <div class="flex-shrink-0 flex items-center">
                                <h1
                                    class="font-bold text-3xl text-primary"
                                    style="font-family: 'Jua', sans-serif"
                                >
                                    <a :href="route('dashboard')"
                                        >フードマップ</a
                                    >
                                </h1>
                            </div>

                            <!-- ナビゲーションリンク -->
                            <div
                                class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"
                            >
                                <jet-nav-link
                                    :href="route('dashboard')"
                                    :active="route().current('dashboard')"
                                >
                                    ホーム
                                </jet-nav-link>

                                <jet-nav-link
                                    :href="route('foodsearch')"
                                    :active="route().current('foodsearch')"
                                >
                                    料理検索
                                </jet-nav-link>

                                <jet-nav-link
                                    :href="route('recipesearch')"
                                    :active="route().current('recipesearch')"
                                >
                                    レシピ検索
                                </jet-nav-link>

                                <jet-nav-link
                                    :href="route('menus')"
                                    :active="route().current('menus')"
                                >
                                    私の腹の中
                                </jet-nav-link>
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <div class="ml-3 relative">
                                <!-- チームドロップダウン -->
                                <jet-dropdown
                                    align="right"
                                    width="60"
                                    v-if="$page.props.jetstream.hasTeamFeatures"
                                >
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition"
                                            >
                                                {{
                                                    $page.props.user
                                                        .current_team.name
                                                }}

                                                <svg
                                                    class="ml-2 -mr-0.5 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <div class="w-60">
                                            <!-- チーム管理 -->
                                            <template
                                                v-if="
                                                    $page.props.jetstream
                                                        .hasTeamFeatures
                                                "
                                            >
                                                <div
                                                    class="block px-4 py-2 text-xs text-gray-400"
                                                >
                                                    チーム管理
                                                </div>

                                                <!-- チーム設定 -->
                                                <jet-dropdown-link
                                                    :href="
                                                        route(
                                                            'teams.show',
                                                            $page.props.user
                                                                .current_team
                                                        )
                                                    "
                                                >
                                                    チーム設定
                                                </jet-dropdown-link>

                                                <jet-dropdown-link
                                                    :href="
                                                        route('teams.create')
                                                    "
                                                    v-if="
                                                        $page.props.jetstream
                                                            .canCreateTeams
                                                    "
                                                >
                                                    新しいチームを作成
                                                </jet-dropdown-link>

                                                <div
                                                    class="border-t border-gray-100"
                                                ></div>

                                                <!-- チーム切り替え -->
                                                <div
                                                    class="block px-4 py-2 text-xs text-gray-400"
                                                >
                                                    チームを切り替える
                                                </div>

                                                <template
                                                    v-for="team in $page.props
                                                        .user.all_teams"
                                                    :key="team.id"
                                                >
                                                    <form
                                                        @submit.prevent="
                                                            switchToTeam(team)
                                                        "
                                                    >
                                                        <jet-dropdown-link
                                                            as="button"
                                                        >
                                                            <div
                                                                class="flex items-center"
                                                            >
                                                                <svg
                                                                    v-if="
                                                                        team.id ==
                                                                        $page
                                                                            .props
                                                                            .user
                                                                            .current_team_id
                                                                    "
                                                                    class="mr-2 h-5 w-5 text-green-400"
                                                                    fill="none"
                                                                    stroke-linecap="round"
                                                                    stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    stroke="currentColor"
                                                                    viewBox="0 0 24 24"
                                                                >
                                                                    <path
                                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                                                                    ></path>
                                                                </svg>
                                                                <div>
                                                                    {{
                                                                        team.name
                                                                    }}
                                                                </div>
                                                            </div>
                                                        </jet-dropdown-link>
                                                    </form>
                                                </template>
                                            </template>
                                        </div>
                                    </template>
                                </jet-dropdown>
                            </div>

                            <!-- 設定ドロップダウン -->
                            <div class="ml-3 relative">
                                <jet-dropdown align="right" width="48">
                                    <template #trigger>
                                        <button
                                            v-if="
                                                $page.props.jetstream
                                                    .managesProfilePhotos
                                            "
                                            class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition"
                                        >
                                            <img
                                                class="h-8 w-8 rounded-full object-cover"
                                                :src="
                                                    $page.props.user
                                                        .profile_photo_url
                                                "
                                                :alt="$page.props.user.name"
                                            />
                                        </button>

                                        <span
                                            v-else
                                            class="inline-flex rounded-md"
                                        >
                                            <button
                                                type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition"
                                            >
                                                {{ $page.props.user.name }}

                                                <svg
                                                    class="ml-2 -mr-0.5 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <!-- アカウント管理 -->
                                        <div
                                            class="block px-4 py-2 text-xs text-gray-400"
                                        >
                                            アカウント管理
                                        </div>

                                        <jet-dropdown-link
                                            :href="route('api-tokens.index')"
                                            v-if="
                                                $page.props.jetstream
                                                    .hasApiFeatures
                                            "
                                        >
                                            APIトークン
                                        </jet-dropdown-link>

                                        <div
                                            class="border-t border-gray-100"
                                        ></div>

                                        <!-- ログアウト -->
                                        <form @submit.prevent="logout">
                                            <jet-dropdown-link as="button">
                                                ログアウト
                                            </jet-dropdown-link>
                                        </form>
                                    </template>
                                </jet-dropdown>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- ページのヘッダー -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header"></slot>
                </div>
            </header>

            <!-- ページコンテンツ -->
            <main>
                <slot></slot>
            </main>
        </div>
    </div>
</template>

<script>
import { defineComponent } from "vue";
import JetApplicationMark from "@/Jetstream/ApplicationMark.vue";
import JetBanner from "@/Jetstream/Banner.vue";
import JetDropdown from "@/Jetstream/Dropdown.vue";
import JetDropdownLink from "@/Jetstream/DropdownLink.vue";
import JetNavLink from "@/Jetstream/NavLink.vue";
import JetResponsiveNavLink from "@/Jetstream/ResponsiveNavLink.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
    props: {
        title: String, // ページのタイトル
    },

    components: {
        Head,
        JetApplicationMark,
        JetBanner,
        JetDropdown,
        JetDropdownLink,
        JetNavLink,
        JetResponsiveNavLink,
        Link,
    },

    data() {
        return {
            showingNavigationDropdown: false, // ナビゲーションドロップダウンの表示状態
        };
    },

    methods: {
        switchToTeam(team) {
            this.$inertia.put(
                route("current-team.update"),
                {
                    team_id: team.id,
                },
                {
                    preserveState: false,
                }
            );
        },

        logout() {
            this.$inertia.post(route("logout"));
        },
    },
});
</script>

<style>
@import url("https://fonts.googleapis.com/css2?family=Jua&display=swap");
</style>
