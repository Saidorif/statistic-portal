<template>
	<div class="employee">
		<Loader v-if="loading" />
		<div class="card">
		  	<div class="card-header header_filter">
		  		<div class="header_title">
				    <h4 class="title_user">
				    <i class="sidebar_icon fas fa-file-excel"></i>
		                Отчет по странам
					</h4>
					<div class="add_user_btn">
			            <button type="button" class="btn btn-info toggleFilter" @click.prevent="toggleFilter">
						    <i class="fas fa-filter"></i>
			            	Филтр
						</button>
		            </div>
		  		</div>
		    	<transition name="slide">
				  	<div class="filters" v-if="filterShow">
				  		<div class="row align-items-end">
  					  		<div class="form-group col-lg-3">
	  							<label for="date">Дата</label>
  								<date-picker v-model="filter.date" placeholder="Дата..."></date-picker>
				  			</div>	
						  	<div class="col-lg-6 form-group btn_search">
							  	<button type="button" class="btn btn-primary mr-2" @click.prevent="search">
							  		<i class="fas fa-search"></i>
								  	найти
							  	</button>
							  	<button type="button" class="btn btn-warning clear" @click.prevent="clear">
							  		<i class="fas fa-times"></i>
								  	сброс
							  	</button>
					  	  	</div>	
				  		</div>
				  	</div>	
			  	</transition>
		  	</div>
		  	<div class="card-body">
			  <div class="table-responsive" >
				<table class="table table-bordered text-center table-hover table-striped">
					<thead>
						<tr class="table_tr">
							<th class="table_number" rowspan="2">№</th>
							<th rowspan="2">Выди сообщений</th>
							<th colspan="4">Транзит (тыс.тонн)</th>
							<th colspan="4">Импорт (тыс.тонн)</th>
							<th colspan="4">Экспорт (тыс.тонн)</th>
						</tr>
						<tr class="table_tr">
							<th >2019 г.</th>
							<th>2019 г. (5 мес)</th>
							<th>2020 г. (5 мес)</th>
							<th>темп роста (%)</th>
							<th >2019 г.</th>
							<th>2019 г. (5 мес)</th>
							<th>2020 г. (5 мес)</th>
							<th>темп роста (%)</th>
							<th >2019 г.</th>
							<th>2019 г. (5 мес)</th>
							<th>2020 г. (5 мес)</th>
							<th>темп роста (%)</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(item,index) in form">
							<td>{{index + 1}}</td>
							<td>{{item.city}}</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>{{item.export.lastYear}}</td>
							<td>{{item.export.currentYear}}</td>
							<td>{{item.export.year}}</td>
							<td>{{item.export.tempUp}}</td>
							<td>{{item.import.lastYear}}</td>
							<td>{{item.import.currentYear}}</td>
							<td>{{item.import.year}}</td>
							<td>{{item.import.tempUp}}</td>
						</tr>
					</tbody>
				</table>
				<!-- <pagination :limit="4" :data="getExcelList" @pagination-change-page="getResults"></pagination> -->
			  </div>
		  	</div>
	  	</div>
	</div>
</template>
<script>
	import {mapActions, mapGetters} from 'vuex'
	import XLSX from 'xlsx';
	import Loader from '../../Loader'
 	import DatePicker from 'vue2-datepicker';
	export default{
		components:{Loader, DatePicker},
		data(){
			return{
				filter:{
					date:new Date(),
				},
				filterShow:false,
				form:[],
				file: null,
				loading: false
			}
		},
		async mounted(){
			await this.ActionReportByCoutryList(this.filter);
			await this.actionCountryList();
			this.form = this.getReportByCoutryList.result ? this.getReportByCoutryList.result : [];
		},
		computed:{
			...mapGetters("report", ["getReportByCoutryList"]),
			...mapGetters("country", ["getCountries"]),
		},
		methods:{
			...mapActions("report", ["ActionReportByCoutryList"]),
			...mapActions("country", ["actionCountryList"]),
			toggleFilter(){
				this.filterShow = !this.filterShow
			},
			async search(){
				if(this.filter.date != ''){
					await this.ActionReportByCoutryList(this.filter);
					if (this.getReportByCoutryList) {
						this.form = this.getReportByCoutryList.result
					}else{
						this.form = []
					}
				}
			},
			async clear(){
				if(this.filter.date != ''){
					await this.ActionReportByCoutryList(this.filter);
					this.filter.date = ''	
					this.form = []
				}
			}
			
		}
	}
</script>
<style scoped>
</style>