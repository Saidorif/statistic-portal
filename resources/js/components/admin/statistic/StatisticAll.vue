<template>
	<div class="statistic">
		<Loader v-if="laoding"/>
		<div class="card">
			<div class="card-header header_filter">
		  		<div class="header_title mb-2">
				    <h4 class="title_user">
				    	<i class="peIcon fas fa-bus"></i>
					    Автомобиль транспорти асосий кўрсаткичлар 
					</h4>
	            	<div class="add_user_btn">
			            <button type="button" class="btn btn-info toggleFilter" @click.prevent="toggleFilter">
						    <i class="fas fa-filter"></i>
			            	Филтр
						</button>
						<router-link class="btn btn-primary" to="/crm/statistic/add">
							<i class="fas fa-plus"></i> 
							Добавить
						</router-link>
		            </div>
	            </div>
	            <transition name="slide">
				  	<div class="filters" v-if="filterShow">
				  		<div class="row">
  							<div class="form-group col-lg-6">
				  				<label for="year">Сортировать по году</label>
				  				<date-picker
					                lang="ru"
					                type="year" format="YYYY" valueType="format"
					                v-model="filter.year"
					                placeholder="Выберите дату!"
					                class="input_style form-date"
				              	></date-picker>
              				</div>
						  	<div class="col-lg-6 form-group filter_btn">
							<!--   	<button type="button" class="btn btn-warning clear" @click.prevent="clear">
							  		<i class="fas fa-times"></i>
								  	сброс
							  	</button> -->
							  	<button type="button" class="btn btn-primary ml-2" @click.prevent="search">
							  		<i class="fas fa-search"></i>
								  	найти
							  	</button>
					  	  	</div>
				  		</div>
				  	</div>
			  	</transition>
		  	</div>
		  	<div class="card-body">
			  	<div class="table-responsive">
					<table class="table table-bordered text-center table-hover table-striped">
						<thead>
							<tr>
								<th scope="col">№</th>
								<th scope="col">Фаолият тури</th>
								<th scope="col">Ўлчов бирлиги</th>
								<th scope="col">Йиллик</th>
								<th scope="col">Год</th>
								<th scope="col">I чорак</th>
								<th scope="col">II чорак</th>
								<th scope="col">III чорак</th>
								<th scope="col">VI чорак</th>
								<th scope="col">Действия</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(reg,index) in items" v-if="items.length > 0">
								<td scope="row">{{index+1}}</td>
								<td>{{$g.findTypeOfAvtoActivity(reg.type)}}</td>
								<td>{{$g.findUnitTypeOfAvtoActivity(reg.type)}}</td>
								<td>{{reg.summ}}</td>
								<td>{{$g.getYear(reg.year)}}</td>
								<td>{{reg.quarter_one}}</td>
								<td>{{reg.quarter_two}}</td>
								<td>{{reg.quarter_three}}</td>
								<td>{{reg.quarter_four}}</td>
								<td>
									<router-link tag="button" class="btn_transparent" :to='`/crm/statistic?type=${reg.type}&year=${$g.getYear(reg.year)}`'>
										<i class="pe_icon fas fa-eye editColor"></i>
									</router-link>
								</td>
							</tr>
							<tr v-if="items.length == 0">
								<td colspan="10">Таблица пустая!</td>
							</tr>
						</tbody>
					</table>
			  	</div>
		  </div>
	  	</div>
	</div>
</template>
<script>
	import { mapGetters , mapActions } from 'vuex'
	import Loader from '../../Loader'
	import DatePicker from "vue2-datepicker";
	export default{
		components:{
			Loader,
			DatePicker,
		},
		data(){
			return{
				laoding: true,
				items:[],
				filterShow:false,
				filter:{year:'',}
			}
		},
		async mounted(){
			await this.actionMainStatistics(this.filter)
			this.filter.year = this.getMainStatistics.getYear
			this.items = this.getMainStatistics.items
			this.laoding = false
		},
		computed:{
			...mapGetters('statistic',['getMainStatistics','getMassage'])
		},
		methods:{
			...mapActions('statistic',['actionMainStatistics']),
			getSummQuarter(item){
				return Number(item.quarter_one) + Number(item.quarter_two) + Number(item.quarter_three) + Number(item.quarter_four)
			},
			toggleFilter(){
				this.filterShow = !this.filterShow
			},
			async search(){
				let page = 1
				if(this.filter.year != ''){
					this.laoding = true
					await this.actionMainStatistics(this.filter)
					this.items = this.getMainStatistics.items
					this.laoding = false
				}
			},
			async clear(){
				let currentYear = new Date().getFullYear()
				this.filter.year = ''
                let page  = 1
                this.laoding = true
                await this.actionMainStatistics(this.filter)
                this.items = this.getMainStatistics.items
                this.laoding = false

			},
		}
	}
</script>
<style scoped>
	.filter_btn{
		margin-top:30px;
	}
</style>