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
	  			<div class="col-md-12" v-if="loaded">
	  					<Bar :propchartdata="this.vedGroupChartData" :propLabel="this.vedGroupChartData.labels" propColor="#f87979"/>
	  				</div>
	  				<div class="col-md-12" v-if="loaded">
	  					<Pie :propchartdata="this.vedGroupChartData" propLabel="Product" propColor="['red', 'yellow']"/>
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
			Line,
			Pie,
		},
		data(){
			return{
				loaded: false,
				vedGroupChartData: {labels: [], datas: []},
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
			console.log(this.getDashboard)
			this.getDashboard.data_vedcode.forEach(element => {
				if(!this.vedGroupChartData.labels.includes(element.name)){
					this.vedGroupChartData.labels.push(element.name)
					this.vedGroupChartData.datas.push(element.total_weight)
				}
			});
			console.log(this.vedGroupChartData)
			this.loaded = true
		}
	}
</script>