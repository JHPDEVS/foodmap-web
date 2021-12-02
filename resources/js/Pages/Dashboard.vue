<template>
<app-layout>
 <header>
    <!-- <nav class="p-6">
      <div class="flex justify-between items-center">
        <h1 class="pr-6 border-r-2 text-2xl font-bold text-gray-500">건강할시간</h1>
        <div class="flex justify-between flex-grow">
          <div class="flex ml-6 items-center">
            <span>
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-4 cursor-pointer text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
              </svg>
            </span>
              <input type="text" v-model="food_name" placeholder="음식명" class="w-full pr-16 input input-primary input-bordered"> 
          </div>
          <div class="md:flex space-x-6 hidden">
            <span class="text-gray-500 text-md">+ Add your sauna</span>
            <span class="text-gray-500 text-md">Sign up</span>
            <span class="text-gray-500 text-md">Log in</span>
          </div>
        </div>
      </div>
    </nav> -->
    <!-- Section Hero -->
    <div style="background-repeat: no-repeat" class="bg-food  mx-auto bg-gray-400 h-96 rounded-md flex items-center bg-blend-multiply">
    
      <div class="sm:ml-20 text-gray-50 text-center sm:text-left">
        <h1 class="text-5xl font-black mb-4 ">
          궁금한 음식을 <br />
          찾아보세요!
        </h1>
         <div class="pt-2  mx-auto text-gray-600">
        <div class="form-control">
  <div class="relative">
    <input type="text" v-model="food_name" placeholder="음식명" class="w-full pr-16 input input-primary input-bordered"> 
    <button @click="search" class="absolute top-0 right-0 rounded-l-none btn btn-primary">검색</button>
  </div>
</div> 
      </div>
      </div>
    </div>
  </header>
  <main class="py-16 container mx-auto px-6 md:px-0">
    <section>
      <h1 class="text-3xl font-bold text-gray-600 mb-10">건강한 레시피</h1>
      <div class="grid sm:grid-cols-3 gap-4 grid-cols-2">
        <div>
          <div class="bg-gray-300 h-44"></div>
          <h3 class="text-lg font-semibold text-gray-500 mt-2">Saunas in <span class="text-gray-700">Helsinki</span></h3>
        </div>
        <div>
          <div class="bg-gray-300 h-44"></div>
          <h3 class="text-lg font-semibold text-gray-500 mt-2">Saunas in <span class="text-gray-700">Rovaniemi</span></h3>
        </div>
        <div>
          <div class="bg-gray-300 h-44"></div>
          <h3 class="text-lg font-semibold text-gray-500 mt-2">Saunas in <span class="text-gray-700">Ruka</span></h3>
        </div>
      </div>
      <hr class="w-40 my-14 border-4 rounded-md sm:mx-0 mx-auto" />
    </section>
    <section>
      <h1 class="inline-block text-gray-600 font-bold text-3xl">
        The holy sauna ritual <br />
        (or how does Saunatime work).
      </h1>

      <div class="grid grid-cols-3 gap-4 mt-10">
        <div>
          <h3 class="text-lg font-semibold text-gray-500 mt-2">1. Browse and book</h3>
          <p class="text text-gray-400">Start by searching for a location. Once you find a sauna you like, simply check the availability, book it, and make a secure payment right away.</p>
        </div>
        <div>
          <h3 class="text-lg font-semibold text-gray-500 mt-2">2. Have a great bath</h3>
          <p class="text text-gray-400">Meet your host on the date you chose and enjoy the home sauna experience. We'll handle the payment to the host after your experience.</p>
        </div>
        <div>
          <h3 class="text-lg font-semibold text-gray-500 mt-2">3. Review the host</h3>
          <p class="text text-gray-400">If you enjoyed the experience, let others know by giving a review to your sauna host. This way others will know where to go.</p>
        </div>
      </div>
    </section>
    <div class="mt-14">
      <p>Ps. You can also become a Saunatime host in few clicks!</p>
    </div>
  </main>
  <footer class="mb-6 px-6 md:px-0">
    <div class="grid gap-5 grid-cols-5 container mx-auto space-x-6">
      <div>
        <h1 class="text-2xl font-bold text-gray-500">saunatime</h1>
        <p>The largest online community to rent saunas in Finland.</p>
        <spa>© Sharetribe 2017.</spa>
      </div>
      <div class="pt-2">
        <ul>
          <li>Add your sauna</li>
          <li>About us</li>
          <li>F.A.Q</li>
          <li>Help</li>
          <li>Contact</li>
        </ul>
      </div>
      <div class="pt-2">
        <ul>
          <li>Helsinki</li>
          <li>Espoo</li>
          <li>Ruka</li>
          <li>Tampere</li>
          <li>Turku</li>
        </ul>
      </div>
      <div class="pt-2">
        <ul>
          <li>Kuopio</li>
          <li>Mikkeli</li>
          <li>Espoo</li>
          <li>Vantaa</li>
          <li>Ahvenanmaa</li>
        </ul>
      </div>
      <div class="pt-2">
        <div>
          <div class="flex space-x-4 text-gray-500 text-center">
            <span
              ><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg
            ></span>
            <span
              ><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg
            ></span>
            <span
              ><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2M5 3a2 2 0 00-2 2v1c0 8.284 6.716 15 15 15h1a2 2 0 002-2v-3.28a1 1 0 00-.684-.948l-4.493-1.498a1 1 0 00-1.21.502l-1.13 2.257a11.042 11.042 0 01-5.516-5.517l2.257-1.128a1 1 0 00.502-1.21L9.228 3.683A1 1 0 008.279 3H5z" /></svg
            ></span>
          </div>
          <div class="flex mt-12">
            <p>Privacy & Cookies</p>
            <p>Terms of use</p>
          </div>
        </div>
      </div>
    </div>
  </footer>
</app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import Welcome from '@/Jetstream/Welcome.vue'
    import axios from 'axios'
    import cheerio from 'cheerio'
    export default defineComponent({
        components: {
            AppLayout,
            Welcome,
        },
        data: () => ({
            posts: [],
            food_name: '',
        }),
        mounted() {
          axios.get('https://www.10000recipe.com/recipe/list.html?q=%EA%B1%B4%EA%B0%95%EB%A0%88%EC%8B%9C%ED%94%BC')
          .then(response=> {
            console.log(response.data)
          })
          // axios.get('https://www.ckme.live/https://openapi.naver.com/v1/search/encyc.json', {
          //               params: {
          //                   query: "돼지국밥"   ,
          //               },
          //               headers: {
          //                   'X-Naver-Client-Id': '7qRPkXSv04vUKHhniI_B',
          //                   'X-Naver-Client-Secret': '5yVDk4wVaa'
          //               }
          //           })
          //           .then(response => {
          //             console.log(response.data)
                         
                        
          //           })
        },
         methods: {
           search() {
             if (this.food_name =='') {
              alert("음식명을 입력해주세요")
             } else {
              window.location.href = "/food/" + this.food_name
             }
           }
         }
    })
</script>
