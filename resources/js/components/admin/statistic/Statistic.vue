<template>
	<div class="statistic">
		<Loader v-if="laoding"/>
		<div class="card">
		  	<div class="card-header">
			    <h4 class="title_user">
			    	<i class="peIcon fas fa-bus"></i>
				    Автомобиль транспорти асосий кўрсаткичлар 
				</h4>
				<div>
	<!-- 				<router-link class="btn btn-primary" to="/crm/statistic/add">
						<i class="fas fa-plus"></i> 
						Добавить
					</router-link> -->
					<router-link class="btn btn_black" to="/crm/statistic/all">
						<span class="peIcon fas fa-arrow-left"></span> 
						Назад
					</router-link>
				</div>
		  	</div>
		  	<div class="card-body">
			  	<div class="table-responsive">
					<table class="table table-bordered text-center table-hover table-striped">
						<thead>
							<tr>
								<th scope="col">№</th>
								<th scope="col">Области</th>
								<th scope="col">Год</th>
								<th scope="col">Фаолият тури</th>
								<th scope="col">Ўлчов бирлиги</th>
								<th scope="col">Йиллик</th>
								<th scope="col">Ўтган йилганисбатан, %</th>
								<th scope="col">I чорак</th>
								<th scope="col">Ўтган йил I чоракга нисбатан, %</th>
								<th scope="col">II чорак</th>
								<th scope="col">Ўтган йил II чоракга нисбатан, %</th>
								<th scope="col">III чорак</th>
								<th scope="col">Ўтган йил III чоракга нисбатан, %</th>
								<th scope="col">VI чорак</th>
								<th scope="col">Ўтган йил VI чоракга нисбатан, %</th>
								<th scope="col">Действия</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(reg,index) in getStatistics.data">
								<td scope="row">{{index+1}}</td>
								<td>{{reg.region_name}}</td>
								<td>{{$g.getYear(reg.year)}}</td>
								<td>{{$g.findTypeOfAvtoActivity(reg.type)}}</td>
								<td>{{$g.findUnitTypeOfAvtoActivity(reg.type)}}</td>
								<td>{{reg.total_last}}</td>
								<td>{{reg.total_percentage}} %</td>
								<td>{{reg.quarter_one}}</td>
								<td>{{reg.quarter_one_percentage}} %</td>
								<td>{{reg.quarter_two}}</td>
								<td>{{reg.quarter_two_percentage}} %</td>
								<td>{{reg.quarter_three}}</td>
								<td>{{reg.quarter_three_percentage}} %</td>
								<td>{{reg.quarter_four}}</td>
								<td>{{reg.quarter_four_percentage}} %</td>
								<td>
									<router-link tag="button" class="btn_transparent" :to='`/crm/statistic/edit/${reg.id}?type=${reg.type}&year=${$g.getYear(reg.year)}`'>
										<i class="pe_icon pe-7s-edit editColor"></i>
									</router-link>
									<button class="btn_transparent" @click="deleteStatistic(reg.id)">
										<i class="pe_icon pe-7s-trash trashColor"></i>
									</button>
								</td>
							</tr>
						</tbody>
						<pagination :limit="4" :data="getStatistics" @pagination-change-page="getResults"></pagination>
					</table>
			  	</div>
		  </div>
	  	</div>
	</div>
</template>
<script>
	import { mapGetters , mapActions } from 'vuex'
	import Loader from '../../Loader'
	export default{
		components:{
			Loader
		},
		data(){
			return{
				laoding: true,
				filter:{type:'',year:''}
			}
		},
		async mounted(){
			let page = 1;
			this.filter.type = this.$route.query.type
			this.filter.year = this.$route.query.year
			let data = {
				page:page,
				items:this.filter
			}
			await this.actionStatistics(data)
			this.laoding = false
		},
		computed:{
			...mapGetters('statistic',['getStatistics','getMassage'])
		},
		methods:{
			...mapActions('statistic',['actionStatistics','actionDeleteStatistic']),
			async getResults(page = 1){ 
				this.laoding = true
				let data = {
					page:page,
					items:this.filter
				}
				await this.actionStatistics(data)
				this.laoding = false
			},
			getSummQuarter(item){
				return Number(item.quarter_one) + Number(item.quarter_two) + Number(item.quarter_three) + Number(item.quarter_four)
			},
			async deleteStatistic(id){
				if(confirm("Вы действительно хотите удалить?")){
					let page = 1
					let data = {
						page:page,
						items:this.filter
					}
					this.laoding = true
					await this.actionDeleteStatistic(id)
					await this.actionStatistics(data)
					this.laoding = false
					toast.fire({
				    	type: 'success',
				    	icon: 'success',
						title: 'Statistic удалено!',
				    })
				}
			}
		}
	}
</script>
<style scoped>
	
</style>