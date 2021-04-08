<template>
    <div class="dashboard_inner">
        <router-link  v-for="(munu, index) in menulist" class="jv_item_inner" :to="'/crm'+munu.url" :key="index">
            <i :class="'sidebar_icon fas ' + munu.icon"></i>
            <p>{{munu.name}}</p>
        </router-link>
    </div>
</template>
<style scoped>
    .dashboard_inner{
        display: flex;
        align-items: stretch;
        flex-wrap: wrap;
        margin-right: -10px;
    }
    .jv_item_inner{
        width: calc(100% / 5 - 10px);
        padding: 30px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        box-shadow: 0 0.46875rem 2.1875rem rgb(4 9 20 / 3%), 0 0.9375rem 1.40625rem rgb(4 9 20 / 3%), 0 0.25rem 0.53125rem rgb(4 9 20 / 5%), 0 0.125rem 0.1875rem rgb(4 9 20 / 3%);
        border: 1px solid rgba(26,54,126,0.125);
        border-radius: .25rem;
        margin-right: 10px;
        margin-bottom: 13px;
        transition: .7s;
    }
    .jv_item_inner:hover{
        text-decoration: none;
        background: #0c1427;
        color: white;
    }
    .jv_item_inner:hover p,
    .jv_item_inner:hover i{
        color: white;
    }
    .jv_item_inner i{
        color: #6c757d;
        font-size: 50px;
    }
    .jv_item_inner p{
        color: #6c757d;
        margin-bottom: 0;
        margin-top: 5px;
        font-size: 20px;
        text-align: center;
        line-height: 24px;
    }
</style>
<script>

export default {
  components: {
  },
  data(){
    return {
        menulist:[
            {name:'Автобус', icon:'fa-bus', url:'/bus'},
            {name:'Region Plan', icon:'fa-bus', url:'/regionplan'},
            {name:'Автомобиль транспорти асосий кўрсаткичлар', icon:'fa-bus', url:'/statistic/all'},
            {name:'Международные автомобильные перевозки', icon:'fa-box', url:'/statisticinternationalcargo'},
            {name:'Международное денежные обращения', icon:'fa-money-check-alt', url:'/statisticinternationalmoney'},
            {name:'Направления маршрутов', icon:'fa-route', url:'/tender'},
            {name:'Offer building', icon:'fa-city', url:'/offerbuilding'},
            {name:'Reconstruction', icon:'fa-building', url:'/reconstruction'},
            {name:'Confirm Offer building', icon:'fa-city', url:'/confirm-offerbuilding'},
            {name:'Confirm Reconstruction', icon:'fa-building', url:'/confirm-reconstruction'},
            {name:'Expectation Moderator', icon:'fa-bus', url:'/expec-mod/1'},
            {name:'Confirmfakt', icon:'fa-file', url:'/confirmfakt'},
            {name:'Station', icon:'fa-file', url:'/station'},
        ]
    }
  },
}
</script>
