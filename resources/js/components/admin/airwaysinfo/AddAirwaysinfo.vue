<template>
	<div class="add_airwaysinfo">
		<Loader v-if="laoding"/>
		<div class="card">
		  	<div class="card-header">
			    <h4 class="title_user">
			    	<i class="sidebar_icon fas fa-plane"></i>
				    Добавить Информации авиакомпании
				</h4>
				<router-link class="btn_black" to="/crm/airwaysinfo"><span class="peIcon fas fa-arrow-left"></span> Назад</router-link>
		  	</div>
		  	<div class="card-body">
		  		<form @submit.prevent.enter="saveAirport" >
					<div class="row">
					  <div class="form-group col-md-4">
					    <label for="airways_company_id">Компания номи</label>
					    <select 
					    	class="form-control input_style"
					    	id="airways_company_id"
					    	placeholder="Компания номи"
					    	v-model="form.airways_company_id"
					    	:class="isRequired(form.airways_company_id) ? 'isRequired' : ''"
				    	>
					    	<option value="" selected disabled>Выберите аеропорт</option>
					    	<option :value="name.id" v-for="(name,index) in getAirwaysCompanyList">{{name.name}}</option>
					    </select>
					  </div>
					  <div class="form-group col-md-4 d-flex flex-column">
		              	<label for="year">Очилиш йили</label>
		              	<date-picker
			                lang="ru"
			                placeholder="Очилиш йили"
			                type="year" format="YYYY" valueType="format"
			                v-model="form.year"
			                :class="isRequired(form.year) ? 'isRequired' : ''"
		              	></date-picker>
		              </div>
					  <div class="form-group col-md-4 d-flex flex-column">
		              	<label for="fleet_size">Флот ҳажми (кемаларнинг сони)</label>
		              	<input 
		              		type="number" 
		              		class="form-control input_style"
					    	id="fleet_size"
					    	placeholder="Флот ҳажми (кемаларнинг сони)"
					    	v-model="form.fleet_size"
					    	:class="isRequired(form.fleet_size) ? 'isRequired' : ''"
		              	>
		              </div>
					  <div class="form-group col-md-4 d-flex flex-column">
		              	<label for="destination_qty">Етиб бориш манзиллар сони</label>
		              	<input 
		              		type="number" 
		              		class="form-control input_style"
					    	id="destination_qty"
					    	placeholder="Етиб бориш манзиллар сони"
					    	v-model="form.destination_qty"
					    	:class="isRequired(form.destination_qty) ? 'isRequired' : ''"
		              	>
		              </div>
					  <div class="form-group col-md-4 d-flex flex-column">
		              	<label for="call_name">Чақирув номи (позывной)</label>
		              	<input 
		              		type="text" 
		              		class="form-control input_style"
					    	id="call_name"
					    	placeholder="Чақирув номи (позывной)"
					    	v-model="form.call_name"
					    	:class="isRequired(form.call_name) ? 'isRequired' : ''"
		              	>
		              </div>
		              <div class="form-group col-md-4">
					    <label for="address">Манзили</label>
					    <textarea 
					    	class="form-control input_style"
					    	id="address"
					    	placeholder="Манзили"
					    	rows="1" 
					    	v-model="form.address"
					    	:class="isRequired(form.address) ? 'isRequired' : ''"
				    	></textarea>
					  </div>
					  <hr>
					<!--   <div class="form-group col-lg-12 d-flex justify-content-between align-items-center">
					  	<h4>Қабул қиладиган самолёт турлари</h4>
			  			<button 
			  				type="button" 
			  				class="btn btn-info mt-41" 
			  				@click.prevent="addPlaneType"
		  				>
			  				<i class="fas fa-plus"></i>
			  				добавить
			  			</button>
					  </div>
					  <div class="form-group col-lg-12">
					  	<div class="row" v-for="(item,index) in planeTypes">
					  		<div class="form-group col-lg-8">
					  			<label :for="'type'+index">
				  					<div class="d-flex">
				  						<h4 class="mr-3">{{index+1}})</h4> <span class="mt-1">Самолёт тури</span>
				  					</div>
					  			</label>
							    <input
							    	type="text"
							    	class="form-control input_style"
							    	:id="'type'+index"
							    	placeholder="Самолёт тури"
							    	v-model="item.name"
							    	:class="isRequired(item.name) ? 'isRequired' : ''"
						    	>
					  		</div>
					  		<div class="form-group col-lg-4">
					  			<button 
					  				type="button" 
					  				class="btn btn-danger mt-41" 
					  				@click.prevent="removePlaneType(index)"
				  				>
					  				<i class="fas fa-trash"></i>
					  				удалить
					  			</button>
					  		</div>
					  	</div>
					  </div>	
					  <hr>
					  <div class="form-group col-lg-12 d-flex justify-content-between align-items-center">
					  	<h4>Авиақатновлар амалга ошириладиган шаҳарлар</h4>
			  			<button 
			  				type="button" 
			  				class="btn btn-info mt-41" 
			  				@click.prevent="addCity"
		  				>
			  				<i class="fas fa-plus"></i>
			  				добавить
			  			</button>
					  </div>
					  <div class="form-group col-lg-12">
					  	<div class="row" v-for="(item,index) in cities">
					  		<div class="form-group col-lg-8">
					  			<label :for="'type'+index">
				  					<div class="d-flex">
				  						<h4 class="mr-3">{{index+1}})</h4> <span class="mt-1">Шаҳар номи</span>
				  					</div>
					  			</label>
							    <input
							    	type="text"
							    	class="form-control input_style"
							    	:id="'type'+index"
							    	placeholder="Шаҳар номи"
							    	v-model="item.name"
							    	:class="isRequired(item.name) ? 'isRequired' : ''"
						    	>
					  		</div>
					  		<div class="form-group col-lg-4">
					  			<button 
					  				type="button" 
					  				class="btn btn-danger mt-41" 
					  				@click.prevent="removeCity(index)"
				  				>
					  				<i class="fas fa-trash"></i>
					  				удалить
					  			</button>
					  		</div>
					  	</div>
					  </div> -->	
					  <hr>
					  <div class="form-group col-lg-12 d-flex justify-content-between align-items-center">
					  	<h4>Авиакомпания кодлари</h4>
			  			<button 
			  				type="button" 
			  				class="btn btn-info mt-41" 
			  				@click.prevent="addCode"
		  				>
			  				<i class="fas fa-plus"></i>
			  				добавить
			  			</button>
					  </div>
					  <div class="form-group col-lg-12">
					  	<div class="row" v-for="(item,index) in codes">
					  		<div class="form-group col-lg-4">
					  			<label :for="'tas_id'+index">
				  					<div class="d-flex">
				  						<h4 class="mr-3">{{index+1}})</h4> 
				  						<span class="mt-1">Код номи</span>
				  					</div>
					  			</label>
							    <input
							    	type="text"
							    	class="form-control input_style"
							    	:id="'tas_id'+index"
							    	placeholder="Код номи"
							    	v-model="item.tas_id"
							    	:class="isRequired(item.tas_id) ? 'isRequired' : ''"
						    	>
					  		</div>
					  		<div class="form-group col-lg-4">
					  			<label :for="'code'+index">
				  					<div class="d-flex">
				  						<span class="mt-2">ID</span>
				  					</div>
					  			</label>
							    <input
							    	type="text"
							    	class="form-control input_style"
							    	:id="'code'+index"
							    	placeholder="ID"
							    	v-model="item.code"
							    	:class="isRequired(item.code) ? 'isRequired' : ''"
						    	>
					  		</div>
					  		<div class="form-group col-lg-4">
					  			<button 
					  				type="button" 
					  				class="btn btn-danger mt-41" 
					  				@click.prevent="removeCode(index)"
				  				>
					  				<i class="fas fa-trash"></i>
					  				удалить
					  			</button>
					  		</div>
					  	</div>
					  </div>	
					  <!---
					  <hr>
					  <div class="form-group col-lg-12 d-flex justify-content-between align-items-center">
					  	<h4>Учиш-қўниш йўлаклари</h4>
			  			<button 
			  				type="button" 
			  				class="btn btn-info mt-41" 
			  				@click.prevent="addWays"
		  				>
			  				<i class="fas fa-plus"></i>
			  				добавить
			  			</button>
					  </div>
					  <div class="form-group col-lg-12">
					  	<div class="row" v-for="(item,index) in ways">
					  		<div class="form-group col-lg-4">
					  			<label :for="'number'+index">
				  					<div class="d-flex">
				  						<h4 class="mr-3">{{index+1}})</h4> 
				  						<span class="mt-1">Рақами</span>
				  					</div>
					  			</label>
							    <input
							    	type="text"
							    	class="form-control input_style"
							    	:id="'number'+index"
							    	placeholder="Рақами"
							    	v-model="item.number"
							    	:class="isRequired(item.number) ? 'isRequired' : ''"
						    	>
					  		</div>
					  		<div class="form-group col-lg-4">
					  			<label :for="'height'+index">
				  					<div class="d-flex">
				  						<span class="mt-2">Узунлиги</span>
				  					</div>
					  			</label>
							    <input
							    	type="text"
							    	class="form-control input_style"
							    	:id="'height'+index"
							    	placeholder="Узунлиги"
							    	v-model="item.height"
							    	:class="isRequired(item.height) ? 'isRequired' : ''"
						    	>
					  		</div>
					  		<div class="form-group col-lg-4">
					  			<label :for="'width'+index">
				  					<div class="d-flex">
				  						<span class="mt-2">Кенглиги</span>
				  					</div>
					  			</label>
							    <input
							    	type="text"
							    	class="form-control input_style"
							    	:id="'width'+index"
							    	placeholder="Кенглиги"
							    	v-model="item.width"
							    	:class="isRequired(item.width) ? 'isRequired' : ''"
						    	>
					  		</div>
					  		<div class="form-group col-lg-4">
					  			<label :for="'coating'+index">
				  					<div class="d-flex">
				  						<span class="mt-2">Қопламаси</span>
				  					</div>
					  			</label>
							    <input
							    	type="text"
							    	class="form-control input_style"
							    	:id="'coating'+index"
							    	placeholder="Қопламаси"
							    	v-model="item.coating"
							    	:class="isRequired(item.coating) ? 'isRequired' : ''"
						    	>
					  		</div>
					  		<div class="form-group col-lg-4">
					  			<label :for="'category'+index">
				  					<div class="d-flex">
				  						<span class="mt-2">Категорияси</span>
				  					</div>
					  			</label>
							    <input
							    	type="text"
							    	class="form-control input_style"
							    	:id="'category'+index"
							    	placeholder="Категорияси"
							    	v-model="item.category"
							    	:class="isRequired(item.category) ? 'isRequired' : ''"
						    	>
					  		</div>
					  		<div class="form-group col-lg-4">
					  			<button 
					  				type="button" 
					  				class="btn btn-danger mt-41" 
					  				@click.prevent="removeWays(index)"
				  				>
					  				<i class="fas fa-trash"></i>
					  				удалить
					  			</button>
					  		</div>
					  	</div>
					  </div>	
					  <hr>
					  <div class="form-group col-lg-12 d-flex justify-content-between align-items-center">
					  	<h4>Реконструкция ва таъмирлаш ишлари</h4>
			  			<button 
			  				type="button" 
			  				class="btn btn-info mt-41" 
			  				@click.prevent="addRecons"
		  				>
			  				<i class="fas fa-plus"></i>
			  				добавить
			  			</button>
					  </div>
					  <div class="form-group col-lg-12">
					  	<div class="row" v-for="(item,index) in recons">
					  		<div class="form-group col-lg-4">
					  			<label :for="'job_type'+index">
				  					<div class="d-flex">
				  						<h4 class="mr-3">{{index+1}})</h4> 
				  						<span class="mt-1">Бажарилган ишлар тури</span>
				  					</div>
					  			</label>
					  			<select 
					  				class="form-control input_style"
							    	:id="'job_type'+index"
							    	placeholder="Бажарилган ишлар тури"
							    	v-model="item.job_type"
							    	:class="isRequired(item.job_type) ? 'isRequired' : ''"
						    	>
					  				<option value="" selected disabled>Выберите бажарилган ишлар тури</option>
					  				<option value="reconstruction">Қайта таъмирлаш</option>
					  				<option value="repair">Таъмирлаш</option>
					  				<option value="capital_repair">Капитал таъмирлаш</option>
					  				<option value="current_repair">Жорий таъмирлаш</option>
					  				<option value="storage_work">Сақлаш ишлари</option>
					  			</select>
					  		</div>
					  		<div class="form-group col-lg-4">
					  			<label :for="'height'+index">
				  					<div class="d-flex">
				  						<span class="mt-2">Бажарилган ишлар йили</span>
				  					</div>
					  			</label> 
				              	<date-picker
					                lang="ru"
					                placeholder="Бажарилган ишлар йили"
					                type="year" format="YYYY" valueType="format"
					                v-model="item.year"
					                :class="isRequired(item.year) ? 'isRequired' : ''"
				              	></date-picker>
					  		</div>
					  		<div class="form-group col-lg-4">
					  			<button 
					  				type="button" 
					  				class="btn btn-danger mt-41" 
					  				@click.prevent="removeRecons(index)"
				  				>
					  				<i class="fas fa-trash"></i>
					  				удалить
					  			</button>
					  		</div>
					  		<div class="form-group col-lg-12">
					  			<label :for="'description'+index">
				  					<div class="d-flex">
				  						<span class="mt-2">Изоҳ</span>
				  					</div>
					  			</label>
					  			<textarea 
							    	class="form-control input_style"
							    	:id="'description'+index"
							    	placeholder="Изоҳ"
							    	rows="5" 
							    	v-model="item.description"
							    	:class="isRequired(item.description) ? 'isRequired' : ''"
					  			></textarea>
					  		</div>
					  	</div>
					  </div> -->	
					  <div class="form-group col-lg-12 d-flex justify-content-end">
					  	<button type="submit" class="btn btn-primary btn_save_category">
					  		<i class="fas fa-save"></i>
						  	Сохранить
						</button>
				  	  </div>
					</div>
				</form>
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
				form:{
					airways_company_id:'',
					year:'',
					address:'',
					fleet_size:'',
					call_name:'',
					destination_qty:'',
				},
				planeTypes:[],
				cities:[],
				codes:[],
				ways:[],
				recons:[],
				requiredInput:false,
				laoding: true
			}
		},
		computed:{
			...mapGetters('airwaysinfo',['getMassage']),
			...mapGetters('airwayscompany',['getAirwaysCompanyList']),
		},
		watch:{
			'form.flight_mode':{
				handler(){
					if(this.form.flight_mode != 'clear_sky'){
						this.form.freedom_air = ''
					}
				},deep:true
			}
		},
		async mounted(){
			await this.actionAirwaysCompanyList()
			this.laoding = false
		},
		methods:{
			...mapActions('airwaysinfo',['actionAddAirways']),
			...mapActions('airwayscompany',['actionAirwaysCompanyList']),
			isRequired(input){
	    		return this.requiredInput && input === '';
		    },
		    addPlaneType(){
		    	this.planeTypes.push({name:""})
		    },
		    removePlaneType(index){
		    	if(confirm("Вы действительно хотите удалить?")){
			    	Vue.delete(this.planeTypes,index)
		    	}
		    },
		    addCity(){
		    	this.cities.push({name:""})
		    },
		    removeCity(index){
		    	if(confirm("Вы действительно хотите удалить?")){
			    	Vue.delete(this.cities,index)
		    	}
		    },
		    addCode(){
		    	this.codes.push({tas_id:"",code:""})
		    },
		    removeCode(index){
		    	if(confirm("Вы действительно хотите удалить?")){
			    	Vue.delete(this.codes,index)
		    	}
		    },
		    addWays(){
		    	this.ways.push({number:"",width:"",height:'',coating:'',category:''})
		    },
		    removeWays(index){
		    	if(confirm("Вы действительно хотите удалить?")){
			    	Vue.delete(this.ways,index)
		    	}
		    },
		    addRecons(){
		    	this.recons.push({job_type:"",year:"",description:''})
		    },
		    removeRecons(index){
		    	if(confirm("Вы действительно хотите удалить?")){
			    	Vue.delete(this.recons,index)
		    	}
		    },
			async saveAirport(){
		    	if (this.form.airways_company_id != '' && this.form.year != '' && this.form.address != '' && this.form.fleet_size != '' && this.form.call_name != '' && this.form.destination_qty != ''){
					this.laoding = true
					// if(this.planeTypes.length > 0){
					// 	this.form['plane_types'] = this.planeTypes
					// }
					// if(this.cities.length > 0){
					// 	this.form['cities'] = this.cities
					// }
					if(this.codes.length > 0){
						this.form['codes'] = this.codes
					}
					// if(this.ways.length > 0){
					// 	this.form['ways'] = this.ways
					// }
					// if(this.recons.length > 0){
					// 	this.form['recons'] = this.recons
					// }
					await this.actionAddAirways(this.form)
					if (this.getMassage.success){
						toast.fire({
					    	type: 'success',
					    	icon: 'success',
							title: this.getMassage.message,
					    })
						this.$router.push("/crm/airwaysinfo");
						this.requiredInput = false
					}
					this.laoding = false
				}else{
					this.requiredInput = true
				}
		    }
		}
	}
</script>
<style scoped>
	.mt-41{
		margin-top:41px;
	}
</style>
