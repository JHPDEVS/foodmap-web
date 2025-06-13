<template>
    <!-- ページタイトルを設定 -->
    <Head title="ログイン" />

    <!-- 認証カード -->
    <jet-authentication-card>
        <!-- ロゴのスロット -->
        <template #logo>
            <h1
                data-theme="cupcake"
                class="font-bold text-5xl text-primary"
                style="font-family: 'Jua', sans-serif"
            >
                <a :href="route('dashboard')">フードマップ</a>
            </h1>
        </template>

        <!-- バリデーションエラーの表示 -->
        <jet-validation-errors class="mb-4" />

        <!-- ステータスメッセージを表示 -->
        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <!-- ログインフォーム -->
        <form @submit.prevent="submit">
            <div>
                <!-- メールアドレスのラベル -->
                <jet-label for="email" value="メールアドレス" />
                <!-- メールアドレスの入力 -->
                <jet-input
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autofocus
                />
            </div>

            <div class="mt-4">
                <!-- パスワードのラベル -->
                <jet-label for="password" value="パスワード" />
                <!-- パスワードの入力 -->
                <jet-input
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                />
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <!-- パスワードを保存するチェックボックス -->
                    <jet-checkbox
                        name="remember"
                        v-model:checked="form.remember"
                    />
                    <span class="ml-2 text-sm text-gray-600"
                        >パスワードを保存</span
                    >
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <!-- ログインボタン -->
                <jet-button
                    data-theme="cupcake"
                    class="btn p-4 ml-4 bg-primary"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    ログイン
                </jet-button>
            </div>
        </form>
    </jet-authentication-card>
</template>

<script>
// Vueコンポーネントの定義
import { defineComponent } from "vue";
import JetAuthenticationCard from "@/Jetstream/AuthenticationCard.vue";
import JetAuthenticationCardLogo from "@/Jetstream/AuthenticationCardLogo.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetCheckbox from "@/Jetstream/Checkbox.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
    components: {
        // 使用するコンポーネントを登録
        Head,
        JetAuthenticationCard,
        JetAuthenticationCardLogo,
        JetButton,
        JetInput,
        JetCheckbox,
        JetLabel,
        JetValidationErrors,
        Link,
    },

    props: {
        // パスワードリセットが可能かどうかを判定
        canResetPassword: Boolean,
        // ステータスメッセージ
        status: String,
    },

    data() {
        return {
            // ログインフォームのデータ
            form: this.$inertia.form({
                email: "jhpdevs@gmail.com", // メールアドレス
                password: "wngud123", // パスワード
                remember: true, // パスワード保存のチェック
            }),
        };
    },

    methods: {
        // フォーム送信処理
        submit() {
            this.form
                .transform((data) => ({
                    ...data,
                    remember: this.form.remember ? "on" : "",
                }))
                .post(this.route("login"), {
                    onFinish: () => this.form.reset("password"), // パスワードフィールドをリセット
                });
        },
    },
});
</script>

<style>
/* フォントをGoogle Fontsからインポート */
@import url("https://fonts.googleapis.com/css2?family=Jua&display=swap");
</style>
