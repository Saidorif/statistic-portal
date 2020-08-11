<template>
	<div class="employee">
		<Loader v-if="loading" />
		<div class="card">
		  	<div class="card-header header_filter">
		  		<div class="header_title">
				    <h4 class="title_user">
				    <i class="sidebar_icon fas fa-file-excel"></i>
		                Отчет по продуктам
					</h4>
		  		</div>
		  	</div>
		  	<div class="card-body">
			  <div class="table-responsive" >
				<table class="table table-bordered text-center table-hover table-striped">
					<thead>
						<tr class="table_tr">
							<th class="table_number">№</th>
							<th>Выд товара</th>
							<th>Действия</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(item,key, index) in form.result">
							<td>{{index + 1}}</td>
							<td>{{key}}</td>
							<td>
								<button class="btn_transparent mr-1" @click="showDetails(item, index)" >
									<i class="fas fa-eye"></i>
								</button>
							</td>
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
					mode:'',
					date:'',
					vedcode:'',
					product:'',
					country_code:'',
					country_name:'',
					transport_type:'',
					transport_country_code:'',
					weight:'',
					cost:'',
				},
				filterShow:false,
				form:[],
				file: null,
				loading: false
			}
		},
		async mounted(){
			await this.ActionReportByProductList();
			this.form = this.getReportByProductList ? this.getReportByProductList : []
		},
		computed:{
			...mapGetters("report", ["getReportByProductList"]),
		},
		methods:{
			...mapActions("report", ["ActionReportByProductList"]),
			showDetails(item, index){
				localStorage.setItem('selectedProduct', JSON.stringify(item))
				this.$router.push(`/crm/report-by-product/show/${index}`)
			}
		}
	}
</script>
<style scoped>
</style>