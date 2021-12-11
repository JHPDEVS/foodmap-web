<template>
    <Link :href="href" :class="classes" data-theme="cupcake" style="font-family: 'Jua', sans-serif;">
        <slot />
    </Link>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Link,
        },
        props: ['href', 'active'],

        computed: {
            classes() {
                return this.active
                    ? 'inline-flex items-center px-1 pt-1 border-b-4 border-primary text-xl font-medium leading-5 text-gray-900 focus:outline-none focus:border-primary transition'
                    : 'inline-flex items-center px-1 pt-1 border-b-4 border-transparent text-xl font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition'
            }
        }
    })
</script>
<style>
@import url('https://fonts.googleapis.com/css2?family=Jua&display=swap');
</style>