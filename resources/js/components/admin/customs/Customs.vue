<template>
	<div class="employee">
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
  					  		<div class="form-group col-lg-3">
	  							<label for="name">Ф.И.О</label>
	  							<input 
	  								type="text" 
	  								class="form-control" 
	  								id="name" 
	  								placeholder="Ф.И.О..."
	  								v-model="filter.name"
  								>
				  			</div>
  					  		<div class="form-group col-lg-3">
	  							<label for="category_id">Должность</label>
  								<select name="" v-model="filter.position_id" class="form-control" >
  									<option value="">Выберите должность!</option>
  									<option :value="position.id" v-for="(position,index) in getPositionList" :key="position.id">	
  										{{position.name}}
  									</option>
  								</select>
				  			</div>	
  					  		<div class="form-group col-lg-3">
	  							<label for="category_id">Направления</label>
  								<select name="" v-model="filter.category_id" class="form-control" >
  									<option value="">Выберите направления!</option>
  									<option :value="cat.id" v-for="(cat,index) in getCategories" :key="cat.id">{{cat.name}}</option>
  								</select>
				  			</div>	
						  	<div class="col-lg-3 form-group btn_search">
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
			  <div class="table-responsive">
				<table class="table table-bordered text-center table-hover table-striped">
					<thead>
						<tr>
							<th scope="col">№</th>
							<th scope="col">Режим</th>
							<th scope="col">Дата</th>
							<th scope="col">Код ТН ВЭД</th>
							<th scope="col">Товар</th>
							<th scope="col">Код страна</th>
							<th scope="col">Страна <br> грузотпровитель / грузополучателя</th>
							<th scope="col">Вид транспорта</th>
							<th scope="col" >Страна <br> регстрация <br> транспорта</th>
							<th scope="col">Вес (тн)</th>
							<th scope="col">Стоимость <br> (тыс.долл.)</th>
							<th scope="col">Действия</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(item,index) in form">
							<td scope="row">{{index+1}}</td>
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
					<!-- <pagination :limit="4" :data="getEmployees" @pagination-change-page="getResults"></pagination> -->
				</table>
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
							<input type="file" @input="previewFiles($event)" >
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary">Save changes</button>
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
	export default{
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
				form:[
					{
						id: '1',
						mode:'ИМ',
						date:'1/1/2020',
						vedcode:'9015201000',
						product:'ТЕОДОЛИТЫ И ТАХЕОМЕТРЫ ЭЛЕКТРОННЫЕ',
						country_code:'756',
						country_name:'ШВЕЙЦАРИЯ',
						transport_type:'40',
						transport_country_code:'276',
						weight:'0.08256',
						cost:'23.24',
					}
				]
			}
		},
		async mounted(){
			let page = 1;
		},
		computed:{
		},
		methods:{
			toggleFilter(){
				this.filterShow = !this.filterShow
			},
			async search(){
				let page = 1
				if(this.filter.name || this.filter.category_id || this.filter.position_id){
				}
			},
			async clear(){
				if(this.filter.name || this.filter.category_id || this.filter.position_id){
					this.filter.name = ''
					this.filter.category_id = ''
					this.filter.position_id = ''
					let page  = 1
				}

			},
			async deleteEmployee(id){
				if(confirm("Вы действительно хотите удалить?")){
					let page = 1
					toast.fire({
				    	type: 'success',
				    	icon: 'success',
						title: 'Пользователь удалено!',
				    })
				}
			},
			previewFiles(e) {
				var files = e.target.files, f = files[0];
				var reader = new FileReader();
				reader.onload = function(e) {
					var data = new Uint8Array(e.target.result);
					var workbook = XLSX.read(data, {type: 'array'});
					let sheetName = workbook.SheetNames[0]
					/* DO SOMETHING WITH workbook HERE */
					console.log(workbook);
					let worksheet = workbook.Sheets[sheetName];
					console.log(XLSX.utils.sheet_to_json(worksheet));
				};
				reader.readAsArrayBuffer(f);
			}
		}
	}
</script>
<style scoped>
	
</style>