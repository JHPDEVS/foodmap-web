<template>
    <app-layout>
        레시피
    </app-layout>
</template>

<script>
   import AppLayout from '@/Layouts/AppLayout.vue'
    import axios from 'axios'
    import cheerio from 'cheerio'
export default {
    props: ['recipe_id'],
    components: {
            AppLayout,
        },

      mounted() {
          // 요약내용 불러오기
            axios.get(
                    "https://www.ckme.live/https://www.10000recipe.com/recipe/" + this.recipe_id
                )
                .then(response => {
                    const $ = cheerio.load(response.data);
                    const span = $('#contents_area');
                    var posts = []
                    span.map(function (i, elem) {
                        var thumb = $(this).find('.view2_pic .centeredcrop img').first().attr("src")
                        var view = $(this).find('.view2_pic .view_cate .view_cate_num span').text()
                        var user_profile_name = $(this).find('.view2_pic .user_info2 span').text()
                        var user_profile_thumb = $(this).find('.view2_pic .user_info2 a').attr('href')
                        var summary_title = $(this).find('.view2_summary h3').text()
                        var summary_in = $(this).find('.view2_summary_in').text()
                        var summary_people = $(this).find('.view2_summary_info .view2_summary_info1').text()
                        var summary_time = $(this).find('.view2_summary_info .view2_summary_info2').text()
                        var summary_grade = $(this).find('.view2_summary_info .view2_summary_info3').text()
                        var tip = $(this).find('.view_step_tip dd').text()
                        let value = {
                           view:view,
                           thumb:thumb,
                           user_profile_name:user_profile_name.trim(),
                           user_profile_thumb: "https://www.10000recipe.com"+user_profile_thumb,
                           summary_title:summary_title,
                           summary_in:summary_in,
                           summary_people:summary_people,
                           summary_time:summary_time,
                           summary_grade:summary_grade,
                           tip : tip,
                        }
                        posts.push(value);
                        console.log(value)
                    })

                    //재료 내용 불러오기
                    const span2 = $('#contents_area .cont_ingre2 .ready_ingre3 ul a');
                    var ingredients = []
                    span2.map(function (i, elem) {
                        var ingredient_title = $(this).find('li').text()
                        var ingredient_unit = $(this).find('li .ingre_unit').text()
                        
                        let value = {
                            ingredient_title:ingredient_title,
                            ingredient_unit,ingredient_unit
                        }
                        ingredients.push(value);
                    })
                    this.ingredients = ingredients;
                    console.log(ingredients)
                    this.ifLoading = 1;
                    this.posts = posts;
                    this.ifLoading = 1;

                    //스텝 불러오기
                    const step = $('#contents_area .view_step .media');
                    var steps = []
                    step.map(function (i, elem) {
                        var i = i
                        var step_left = $(this).find('.media-body').text()
                        var step_right = $(this).find('#stepimg' + (i+1)).children().attr("src")
                        var step_tip = $(this).find('.media-body p').text()
                        let value = {
                            index : i+1,
                            step_left:step_left,
                            step_right,step_right,
                            step_tip:step_tip
                        }
                        steps.push(value);
                    })
                    console.log(steps)
                    this.steps = steps;
                    this.ifLoading = 1;

                    //후기 불러오기

                    const review = $('#contents_area .view_reply .media');
                    var reviews = []
                    review.map(function (i, elem) {
                        var profile = $(this).find('.media-left a img').attr("src")
                        var nickname = $(this).find('.media-body h4 b').text()
                        var date = $(this).find('.media-body h4').text()
                        var star = $(this).find('.media-body .reply_list_star').children().length
                        let value = {
                            profile: profile,
                            nickname: nickname,
                            date: date.substr(nickname.length,date.length),
                            star: star,
                        }
                        reviews.push(value);
                    })
                    this.reviews = reviews;
                    console.log(reviews)

                })
                   
                
        },

}
</script>