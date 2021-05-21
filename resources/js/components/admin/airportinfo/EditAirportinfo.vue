<template>
	<div class="edit_airportinfo">
		<Loader v-if="laoding"/>
		<div class="card">
		  	<div class="card-header">
			    <h4 class="title_user">
			    	<i class="sidebar_icon fas fa-plane"></i>
				    Изменить Аэропорт
				</h4>
				<router-link class="btn_black" to="/crm/airportinfo"><span class="peIcon fas fa-arrow-left"></span> Назад</router-link>
		  	</div>
		  	<div class="card-body">
		  		<form @submit.prevent.enter="saveAirport" >
					<div class="row">
					  <div class="form-group col-md-4">
					    <label for="name">Аэропорт номи</label>
					    <input
					    	type="text"
					    	class="form-control input_style"
					    	id="name"
					    	placeholder="Аэропорт номи"
					    	v-model="form.name"
					    	:class="isRequired(form.name) ? 'isRequired' : ''"
				    	>
					  </div>
					  <div class="form-group col-md-3 d-flex flex-column">
		              	<label for="year">Очилиш йили</label>
		              	<date-picker
			                lang="ru"
			                placeholder="Очилиш йили"
			                type="year" format="YYYY" valueType="format"
			                v-model="form.year"
			                :class="isRequired(form.year) ? 'isRequired' : ''"
		              	></date-picker>
		              </div>
		              <div class="form-group col-md-5">
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
		              <div class="form-group col-md-6">
					    <label for="flight_mode">Учиш режими</label>
					    <select 
					    	v-model="form.flight_mode"
					    	id="flight_mode"
					    	class="form-control" 
					    	:class="isRequired(form.flight_mode) ? 'isRequired' : ''"
				    	>
					    	<option value="" selected disabled>Танланг!</option>
					    	<option :value="item.key" v-for="(item,index) in $g.getFlightModes()">{{item.value}}</option>
					    </select> 
					  </div>
		              <div class="form-group col-md-6">
					    <label for="freedom_air">Ҳаво эркинлиги</label>
					    <select 
					    	v-model="form.freedom_air"
					    	id="freedom_air"
					    	class="form-control" 
					    	:disabled="form.flight_mode != 'clear_sky'"
					    	:class="isRequired(form.freedom_air) ? 'isRequired' : ''"
				    	>
					    	<option value="" selected disabled="">Танланг!</option>
					    	<option :value="item.key" v-for="(item,index) in $g.getFreedomAirs()">{{item.value}}</option>
					    </select>
					  </div>
					  <hr>
					  <div class="form-group col-lg-12 d-flex justify-content-between align-items-center">
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
					  				v-if="item.id"
					  				@click.prevent="removePlaneTypeFromServer(item.id)"
				  				>
					  				<i class="fas fa-trash"></i>
					  				удалить
					  			</button>
					  			<button 
					  				v-else
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
				  						<h4 class="mr-3">{{index+1}})</h4> 
				  						<span class="mt-1">Шаҳар номи</span>
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
					  				v-if="item.id"
					  				@click.prevent="removeAviaCityFromServer(item.id)"
				  				>
					  				<i class="fas fa-trash"></i>
					  				удалить
					  			</button>
					  			<button 
					  				v-else
					  				type="button" 
					  				class="btn btn-danger mt-41" 
					  				@click.prevent="removeCity(index)"
				  				>
					  				<i class="fas fa-trash"></i>
					  				удалить
					  			</button>
					  		</div>
					  	</div>
					  </div>	
					  <hr>
					  <div class="form-group col-lg-12 d-flex justify-content-between align-items-center">
					  	<h4>Аэропорт кодлари</h4>
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
					  				v-if="item.id"
					  				@click.prevent="removeAirportCodeFromServer(item.id)"
				  				>
					  				<i class="fas fa-trash"></i>
					  				удалить
					  			</button>
					  			<button 
					  				v-else
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
					  				v-if="item.id"
					  				@click.prevent="removeAirportWayFromServer(item.id)"
				  				>
					  				<i class="fas fa-trash"></i>
					  				удалить
					  			</button>
					  			<button 
					  				v-else
					  				type="button" 
					  				class="btn btn-danger mt-41" 
					  				@click.prevent="removeWay(index)"
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
					  				v-if="item.id"
					  				@click.prevent="removeAirportReconFromServer(item.id)"
				  				>
					  				<i class="fas fa-trash"></i>
					  				удалить
					  			</button>
					  			<button 
					  				v-else
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
					  </div>		
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
					name:'',
					year:'',
					address:'',
					flight_mode:'',
					freedom_air:'',
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
			...mapGetters('airportinfo',['getMassage','getAirport'])
		},
		async mounted(){
			await this.actionEditAirport(this.$route.params.airportinfoId)
			this.laoding = false
			this.form = this.getAirport
			this.planeTypes = this.getAirport.plane_type
			this.cities = this.getAirport.avia_city
			this.codes = this.getAirport.airport_code
			this.ways = this.getAirport.airport_way
			this.recons = this.getAirport.airport_recon
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
		methods:{
			...mapActions('airportinfo',[
				'actionUpdateAirport',
				'actionEditAirport',
				'actionDeletePlaneType',
				'actionDeleteAviaCity',
				'actionDeleteAirportcode',
				'actionDeleteAirportway',
				'actionDeleteAirportrecon',
			]),
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
		    async removePlaneTypeFromServer(id){
		    	if(confirm("Вы действительно хотите удалить?")){
			    	await this.actionDeletePlaneType(id)
			    	if (this.getMassage.success) {
						toast.fire({
					    	type: 'success',
					    	icon: 'success',
							title: this.getMassage.message,
					    })
					    this.defaultValues()
					}
		    	}
		    },
		    async removeAviaCityFromServer(id){
		    	if(confirm("Вы действительно хотите удалить?")){
			    	await this.actionDeleteAviaCity(id)
			    	if (this.getMassage.success){
						toast.fire({
					    	type: 'success',
					    	icon: 'success',
							title: this.getMassage.message,
					    })
					    this.defaultValues()
					}
		    	}
		    },
		    async removeAirportCodeFromServer(id){
		    	if(confirm("Вы действительно хотите удалить?")){
			    	await this.actionDeleteAirportcode(id)
			    	if (this.getMassage.success){
						toast.fire({
					    	type: 'success',
					    	icon: 'success',
							title: this.getMassage.message,
					    })
					    this.defaultValues()
					}
		    	}
		    },
		    async removeAirportWayFromServer(id){
		    	if(confirm("Вы действительно хотите удалить?")){
			    	await this.actionDeleteAirportway(id)
			    	if (this.getMassage.success){
						toast.fire({
					    	type: 'success',
					    	icon: 'success',
							title: this.getMassage.message,
					    })
					    this.defaultValues()
					}
		    	}
		    },
		    async removeAirportReconFromServer(id){
		    	if(confirm("Вы действительно хотите удалить?")){
			    	await this.actionDeleteAirportrecon(id)
			    	if (this.getMassage.success){
						toast.fire({
					    	type: 'success',
					    	icon: 'success',
							title: this.getMassage.message,
					    })
					    this.defaultValues()
					}
		    	}
		    },
		    async defaultValues(){
				await this.actionEditAirport(this.$route.params.airportinfoId)
				this.planeTypes = this.getAirport.plane_type
				this.cities = this.getAirport.avia_city
				this.codes = this.getAirport.airport_code
				this.ways = this.getAirport.airport_way
				this.recons = this.getAirport.airport_recon
		    },
			async saveAirport(){
		    	if (this.form.name != '' && this.form.year != '' && this.form.address != '' && this.form.flight_mode != ''){
					this.laoding = true
					// plane_types
					let plane_types = this.planeTypes.filter((item,index)=>{
						if(item.id){
							return item
						}
					})
					this.form['plane_types'] = plane_types
					let new_plane_types = this.planeTypes.filter((item,index)=>{
						if(!item.id){
							return item
						}
					})
					this.form['new_plane_types'] = new_plane_types
					// cities
					let cities = this.cities.filter((item,index)=>{
						if(item.id){
							return item
						}
					})
					this.form['cities'] = cities
					let new_cities = this.cities.filter((item,index)=>{
						if(!item.id){
							return item
						}
					})
					this.form['new_cities'] = new_cities
					// codes
					let codes = this.codes.filter((item,index)=>{
						if(item.id){
							return item
						}
					})
					this.form['codes'] = codes
					let new_codes = this.codes.filter((item,index)=>{
						if(!item.id){
							return item
						}
					})
					this.form['new_codes'] = new_codes
					// ways
					let ways = this.ways.filter((item,index)=>{
						if(item.id){
							return item
						}
					})
					this.form['ways'] = ways
					let new_ways = this.ways.filter((item,index)=>{
						if(!item.id){
							return item
						}
					})
					this.form['new_ways'] = new_ways
					// recons
					let recons = this.recons.filter((item,index)=>{
						if(item.id){
							return item
						}
					})
					this.form['recons'] = recons
					let new_recons = this.recons.filter((item,index)=>{
						if(!item.id){
							return item
						}
					})
					this.form['new_recons'] = new_recons
					Vue.delete(this.form,'plane_type')
					Vue.delete(this.form,'avia_city')
					Vue.delete(this.form,'airport_code')
					Vue.delete(this.form,'airport_way')
					Vue.delete(this.form,'airport_recon')
					await this.actionUpdateAirport(this.form)
					if (this.getMassage.success) {
						toast.fire({
					    	type: 'success',
					    	icon: 'success',
							title: this.getMassage.message,
					    })
						this.$router.push("/crm/airportinfo");
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