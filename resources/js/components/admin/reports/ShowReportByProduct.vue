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
					<router-link class="btn btn-primary back_btn" to="/crm/report-by-product">
						<span class="peIcon pe-7s-back"></span> Назад
					</router-link>
		  		</div>
		  	</div>
		  	<div class="card-body">
			  <div class="table-responsive" >
				<table class="table table-bordered text-center table-hover table-striped">
					<thead>
						<tr class="table_tr">
							<th class="table_number">№</th>
							<th>Страна</th>
							<th>Выд товара</th>
							<th>Вес (тонн)</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(item,key, index) in form">
							<td>{{index + 1}}</td>
							<td>{{item.c_name}}</td>
							<td>{{item.code_name}}</td>
							<td>{{item.total}}</td>
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
				form:[],
				file: null,
				loading: false
			}
		},
		async mounted(){
			this.form = JSON.parse(localStorage.getItem('selectedProduct'));
			console.log(this.form)
		},
		computed:{
		},
		methods:{
		}
	}
</script>
<style scoped>
</style>