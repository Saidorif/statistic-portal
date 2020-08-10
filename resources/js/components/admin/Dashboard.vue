<template>
	<div class="dashboard">
		<div class="card">
		  	<div class="card-header">
			    <h4 class="title_user">
			    	<i class="sidebar_icon fas fa-desktop"></i>
				    Админ панель
				</h4>
		  	</div>
		  	<div class="card-body">
	  			<div class="row">
					<div class="col-md-6" v-if="loaded">
						<Bar :propchartdata="this.vedGroupChartData"  :propSettings="this.vedGroupChartDataSettings"/>
					</div>
					<div class="col-md-6" v-if="loaded">
						<Bar :propchartdata="this.vedGroupChartDataByCountry" :propSettings="this.vedGroupChartDataByCountrySettings"/>
					</div> 
					<div class="col-md-12 overauto" v-if="loaded">
						<!-- <div class="mw_5000"> -->
							<Bar :propchartdata="this.countryChartData" :propSettings="this.countryChartDataSettings"/>
						<!-- </div> -->
					</div> 
	  			</div>
		  	</div>
	  	</div>
	</div>
</template>
<script>
	import Bar from './chart/Bar'
	import Line from './chart/Line'
	import Pie from './chart/Pie'
	import {mapActions, mapGetters} from 'vuex'
	export default{
		components:{
			Bar,
			// Line,
			Pie,
		},
		data(){
			return{
				loaded: false,
				vedGroupChartData: {labels: [], datas_ex: [], data_im: [], data_total: []},
				vedGroupChartDataSettings: [
					{label: 'Экспорт', backgroundColor: '#01163880', borderWidth: 1, borderColor: '#011638', data: 'datas_ex', chartTitle: 'Отчет по продуктам (тонн)'},
					{label: 'Импорт', backgroundColor: '#2C423F80', borderWidth: 1, borderColor: '#2C423F', data: 'data_im'},
					{label: 'Общий', backgroundColor: '#7F95D180', borderWidth: 1, borderColor: '#7F95D1', data: 'data_total'}
				],
				vedGroupChartDataByCountry: {labels: [], datas_ex: [], data_im: [], data_total: []},
				vedGroupChartDataByCountrySettings: [
					{label: 'Экспорт', backgroundColor: '#FF842780', borderWidth: 1, borderColor: '#FF8427', data: 'datas_ex', chartTitle: 'Отчет по продуктам (сумма)'},
					{label: 'Импорт', backgroundColor: '#4D8B3180', borderWidth: 1, borderColor: '#4D8B31', data: 'data_im'},
					{label: 'Общий', backgroundColor: '#7F95D180', borderWidth: 1, borderColor: '#7F95D1', data: 'data_total'}
				],

				countryChartData: {labels: [], datas_ex: [], data_im: [], data_total: []},
				countryChartDataSettings: [
					{label: 'Экспорт', backgroundColor: '#01163880', borderWidth: 1, borderColor: '#011638', data: 'datas_ex', chartTitle: 'Отчет по странам (тонн)'},
					{label: 'Импорт', backgroundColor: '#2C423F80', borderWidth: 1, borderColor: '#2C423F', data: 'data_im'},
					{label: 'Общий', backgroundColor: '#7F95D180', borderWidth: 1, borderColor: '#7F95D1', data: 'data_total'}
				],
				countryChartDataByCountry: {labels: [], datas_ex: [], data_im: [], data_total: []},
				countryChartDataByCountrySettings: [
					{label: 'Экспорт', backgroundColor: '#FF842780', borderWidth: 1, borderColor: '#FF8427', data: 'datas_ex', chartTitle: 'Отчет по странам (сумма)'},
					{label: 'Импорт', backgroundColor: '#4D8B3180', borderWidth: 1, borderColor: '#4D8B31', data: 'data_im'},
					{label: 'Общий', backgroundColor: '#7F95D180', borderWidth: 1, borderColor: '#7F95D1', data: 'data_total'}
				],
			}
		},
		computed:{
			...mapGetters('dashboard',['getDashboard'])
		},
		methods:{
			...mapActions('dashboard',['actionDashboard'])
		},
		async mounted(){
			await this.actionDashboard()
			//  console.log(this.getDashboard)
			this.getDashboard.data_vedcode.forEach(element => {
				if(!this.vedGroupChartData.labels.includes(element.name)){
					this.vedGroupChartData.labels.push(element.name)
					this.vedGroupChartData.data_im.push(element.im_total_weight)
					this.vedGroupChartData.datas_ex.push(element.ek_total_weight)
					this.vedGroupChartData.data_total.push(element.total_weight)
					this.vedGroupChartDataByCountry.labels.push(element.name)
					this.vedGroupChartDataByCountry.data_im.push(element.im_total_cost)
					this.vedGroupChartDataByCountry.datas_ex.push(element.im_eks_total_cost)
					this.vedGroupChartDataByCountry.data_total.push(element.total_cost)
				}
			});

			this.getDashboard.data_country.forEach(element => {
				if(!this.countryChartData.labels.includes(element.name)){
					if(element.total_weight){
						this.countryChartData.labels.push(element.name)
						this.countryChartData.data_im.push(element.im_total_weight)
						this.countryChartData.datas_ex.push(element.ek_total_weight)
						this.countryChartData.data_total.push(element.total_weight)
						this.countryChartDataByCountry.labels.push(element.name)
						this.countryChartDataByCountry.data_im.push(element.im_total_cost)
						this.countryChartDataByCountry.datas_ex.push(element.im_eks_total_cost)
						this.countryChartDataByCountry.data_total.push(element.total_cost)
					}
				}
			});
			console.log(this.countryChartData.data_total)
			this.loaded = true
		},
	}
</script>
<style scoped>
	.mw_5000{
		min-width: 5000px;
	}
	.overauto{
		overflow: auto;
	}
</style>