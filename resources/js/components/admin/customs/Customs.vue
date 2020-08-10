<template>
	<div class="employee">
		<Loader v-if="loading" />
		<div class="card">
		  	<div class="card-header header_filter">
		  		<div class="header_title">
				    <h4 class="title_user">
				    <i class="sidebar_icon fas fa-file-excel"></i>
					     Таможня  (Excel) 
					</h4>
					<div class="add_user_btn">
			            <button type="button" class="btn btn-info toggleFilter" data-toggle="modal" data-target="#exampleModalLong">
						    <i class="sidebar_icon fas fa-file-excel"></i>
			            	Excel
						</button>
			            <button type="button" class="btn btn-info toggleFilter" @click.prevent="toggleFilter">
						    <i class="fas fa-filter"></i>
			            	Филтр
						</button>
						<router-link class="btn btn-primary" to="/crm/customs-import-export/add"><i class="fas fa-plus"></i> Добавить</router-link>
		            </div>
		  		</div>
		    	<transition name="slide">
				  	<div class="filters" v-if="filterShow">
				  		<div class="row">
  					  		<div class="form-group col-lg-2">
	  							<label for="name">Режим</label>
								  <select v-model="filter.mode" class="form-control">
									  <option value="">Все</option>
									  <option value="ИМ">Импорт</option>
									  <option value="ЭК">Экспорт</option>
									  <option value="ТР">Транзит</option>
								  </select>
				  			</div>
  					  		<div class="form-group col-lg-2">
	  							<label for="category_id">Дата c</label>
  								<date-picker v-model="filter.date_from" format="DD-MM-YYYY"  ></date-picker>
				  			</div>	
  					  		<div class="form-group col-lg-2">
	  							<label for="category_id">Дата по</label>
  								<date-picker v-model="filter.date_to" format="DD-MM-YYYY"  ></date-picker>
				  			</div>	
  					  		<div class="form-group col-lg-2">
	  							<label for="category_id">Вид транспорта</label>
								<select  class="form-control" v-model="filter.transport_type">
									<option value="">Все</option>
									<option value="20">Железнодорожная</option>
									<option value="30">Авто</option>
									<option value="40">Авиа</option>
								</select>
				  			</div>	
  					  		<div class="form-group col-lg-2">
	  							<label for="category_id">Страна</label>
								<multiselect v-model="country_idArray" :options="getCountries"  :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" placeholder="Выберите страну" label="name" track-by="id" :searchable="true"  :preselect-first="false" @input="save">
									<template slot="singleLabel" slot-scope="{ option }"><strong>{{ option.name }}</strong></template>
								</multiselect>
				  			</div>	
						  	<div class="col-lg-2 form-group btn_search">
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
							<th class="table_number">№</th>
							<th>Режим</th>
							<th width="100px"> Дата</th>
							<th>Код ТН ВЭД</th>
							<th>Товар</th>
							<th>Код страна</th>
							<th width="150px">Страна <br> грузотпровитель / грузополучателя</th>
							<th>Вид транспорта</th>
							<th >Страна <br> регстрация <br> транспорта</th>
							<th>Вес (тн)</th>
							<th>Стоимость <br> (тыс.долл.)</th>
							<th width="100px">Действия</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(item,index) in getExcelList.data">
							<td>{{item.id}}</td>
							<td>{{item.mode}}</td>
							<td>{{item.date}}</td>
							<td>{{item.vedcode}}</td>
							<td>{{item.product}}</td>
							<td>{{item.country_code}} </td>
							<td>{{item.country_name}}</td>
							<td>{{item.transport_type}}</td>
							<td>{{item.transport_country_code}}</td>
							<td>{{item.weight}}</td>
							<td>{{item.cost}}</td>
							<td>
								<router-link tag="button" class="btn_transparent mr-1" :to='`/crm/customs-import-export/edit/${item.id}`'>
									<i class="fas fa-pen"></i>
								</router-link>
								<button class="btn_transparent" @click="deleteEmployee(item.id)">
									<i class="fas fa-trash"></i>
								</button>
							</td>
						</tr>
					</tbody>
				</table>
					<pagination :limit="4" :data="getExcelList" @pagination-change-page="getResults"></pagination>

			  </div>
			  <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLongTitle">UPLOAD EXCEL</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<input type="file" @change="previewFiles($event)"  accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-primary" @click="sendExelData()">Импортировать</button>
						</div>
						</div>
					</div>
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
	  import Multiselect from 'vue-multiselect'
	export default{
		components:{Loader, DatePicker, Multiselect},
		data(){
			return{
				filter:{
					date_from:'',
					date_to:'',
					mode:'',
					transport_type:'',
					country_id:[],
					code_group_id:'',
				},
				country_idArray: [],
				filterShow:false,
				form:[],
				file: null,
				loading: false,
				options: ['list', 'of', 'options']
			}
		},
		async mounted(){
			let page = 1;
			await this.actionImportExcelList({page: page, filter: this.filter});
			await this.actionCountryList();
		},
		computed:{
			...mapGetters("customs", ["getMassage", "getExcelList"]),
			...mapGetters('country',['getCountries']),
		},
		methods:{
			...mapActions("customs", ["actionImportExcel", "actionImportExcelList"]),
			...mapActions('country',['actionCountryList']),
			toggleFilter(){
				this.filter.date_from = ''
				this.filter.date_to = ''
				this.filter.mode = ''
				this.filter.transport_type = ''
				this.filter.country_id = ''
				this.filter.code_group_id = ''
				this.country_idArray = []
				this.filterShow = !this.filterShow
			},
			save (plan_start) {
				// console.log(plan_start)
			},
			formatDate (d) {
				// you could also provide your own month names array
				const months = this.$refs.datePicker.translation.months
				return `${d.getDate().toString().padStart(2, 0)} ${months[d.getMonth()]} ${d.getFullYear()}`
				},
			async search(){
				this.filter.country_id = this.country_idArray.map(item => {
					return item.id
				})
				let page = 1;
				await this.actionImportExcelList({page: page, filter: this.filter});
			},
			async clear(){
				this.filter.date_from = ''
				this.filter.date_to = ''
				this.filter.mode = ''
				this.filter.transport_type = ''
				this.filter.country_id = ''
				this.filter.code_group_id = ''
				this.country_idArray = []
				let page  = 1
				await this.actionImportExcelList({page: page, filter: this.filter});
			},
			async deleteEmployee(id){
				if(confirm("Вы действительно хотите удалить?")){
					let page = 1
					toast.fire({type: 'success',icon: 'success',title: 'Пользователь удалено!', })
				}
			},
			async getResults(page = 1){ 
				await this.actionImportExcelList({page:page})
			},
			ExcelDateToJSDate(serial) {
				var utc_days  = Math.floor(serial - 25569);
				var utc_value = utc_days * 86400;                                        
				var date_info = new Date(utc_value * 1000);

				var fractional_day = serial - Math.floor(serial) + 0.0000001;

				var total_seconds = Math.floor(86400 * fractional_day);

				var seconds = total_seconds % 60;

				total_seconds -= seconds;

				var hours = Math.floor(total_seconds / (60 * 60));
				var minutes = Math.floor(total_seconds / 60) % 60;

				return new Date(date_info.getFullYear(), date_info.getMonth(), date_info.getDate(), hours, minutes, seconds);
			},
			async sendExelData() {
				if(this.file){
					this.loading = true
					let formData = new FormData();
					formData.append('file', this.file);
					await this.actionImportExcel(formData);
					this.loading = false
					$('#exampleModalLong').modal('hide')
					if(this.getMassage.success){
						toast.fire({
							type: "success",
							icon: "success",
							title: this.getMassage.message
						});
					}else{
						toast.fire({
							type: "error",
							icon: "error",
							title: this.getMassage.message
						});
					}

				}

				// if(this.form.length){
				// 	$('#exampleModalLong').modal('hide')
				// 	this.loading = true
				// 	console.log(this.form)
				// 	await this.actionImportExcel(this.form)
				// 	this.loading = false
				// 	if(this.getMassage.success){
				// 		toast.fire({
				// 			type: "success",
				// 			icon: "success",
				// 			title: this.getMassage.message
				// 		});
				// 	}else{
				// 		toast.fire({
				// 			type: "error",
				// 			icon: "error",
				// 			title: this.getMassage.message
				// 		});
				// 	}
				// }
			},
			previewFiles(e) {
				this.loading = true
				this.file = e.target.files[0];
				this.loading = false
				// var files = e.target.files, f = files[0];
				// var reader = new FileReader();
				// let xlsxReader = this.$xlsx;
				// let parentThis = this;
				// reader.onload = function(e) {
				// 	var data = new Uint8Array(e.target.result);
				// 	var workbook = XLSX.read(data, {type: 'array'});
				// 	let sheetName = workbook.SheetNames[0]
				// 	/* DO SOMETHING WITH workbook HERE */
				// 	let worksheet = workbook.Sheets[sheetName];
				// 	parentThis.form = XLSX.utils.sheet_to_json(worksheet)
				// 	console.log(parentThis.form)
				// 	parentThis.loading = false
				// };
				// reader.readAsArrayBuffer(f);

			},
		}
	}
</script>
<style scoped>
	.table_number{
	}
	.mx-input{
		height: 37px;
	}
</style>