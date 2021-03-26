<template>
	<div class="add-offerbuilding">
		<Loader v-if="laoding"/>
		<div class="card">
		  	<div class="card-header">
			    <h4 class="title_user">
			    	<i class="peIcon fas fa-building"></i>
				    Добавить Offer building 
				</h4>
				<router-link class="btn_black" to="/crm/offerbuilding"><span class="peIcon fas fa-arrow-left"></span> Назад</router-link>
		  	</div>
		  	<div class="card-body">
		  		<form @submit.prevent.enter="saveOfferbuilding" enctype="multipart/form-data">
					<div class="row">
	<!-- 			      <div class="form-group col-md-3">
					    <label for="type_of_construction">Таклиф тури</label>
					    <select 
					    	class="form-control input_style" 
					    	v-model="form.type_of_construction"
					    	:class="isRequired(form.type_of_construction) ? 'isRequired' : ''"
				    	>
					    	<option value="" selected disabled>Таклиф турини танланг!</option>
					    	<option value="construction">Курилиш!</option>
					    	<option value="reconstruction">Тамирлаш ва кайта куриш!</option>
					    </select>
					  </div> -->
				      <div class="form-group col-md-3">
					    <label for="area_id">Туман/шахарлар</label>
					    <select 
					    	class="form-control input_style" 
					    	v-model="form.area_id"
					    	:class="isRequired(form.area_id) ? 'isRequired' : ''"
					    	@change="stationAreaBy"
				    	>
					    	<option value="" selected disabled>Туман/шахарни турини танланг!</option>
					    	<option :value="item.id" v-for="(item,index) in getAreaLists">{{item.name}}</option>
					    </select>
					  </div>
				      <div class="form-group col-md-3">
					    <label for="station_id">Бекатлар</label>
					    <select 
					    	class="form-control input_style" 
					    	v-model="form.station_id"
					    	:class="isRequired(form.station_id) ? 'isRequired' : ''"
				    	>
					    	<option value="" selected disabled>Бекатни турини танланг!</option>
					    	<option :value="item.id" v-for="(item,index) in getStationsAreaByList">{{item.name}}</option>
					    </select>
					  </div>
					  <div class="form-group col-md-3">
					    <label for="name">Ф.И.О</label>
					    <input
					    	type="text"
					    	class="form-control input_style"
					    	id="name"
					    	placeholder="Ф.И.О"
					    	v-model="form.name"
					    	:class="isRequired(form.name) ? 'isRequired' : ''"
				    	>
					  </div>
					  <div class="form-group col-md-3">
					    <label for="company_name">Название учреждения</label>
					    <input
					    	type="text"
					    	class="form-control input_style"
					    	id="company_name"
					    	placeholder="Название учреждения"
					    	v-model="form.company_name"
					    	:class="isRequired(form.company_name) ? 'isRequired' : ''"
				    	>
					  </div>
					  <div class="form-group col-md-3">
					    <label for="inn">ИНН</label>
					    <input
					    	type="number"
					    	class="form-control input_style"
					    	id="inn"
					    	placeholder="ИНН"
					    	v-model="form.inn"
					    	:class="isRequired(form.inn) ? 'isRequired' : ''"
				    	>
					  </div>
					  <div class="form-group col-md-3">
					    <label for="longitude">Longitude</label>
					    <input
					    	type="number"
					    	class="form-control input_style"
					    	id="longitude"
					    	placeholder="Longitude"
					    	v-model="form.longitude"
					    	:class="isRequired(form.longitude) ? 'isRequired' : ''"
				    	>
					  </div>
					  <div class="form-group col-md-3">
					    <label for="latitude">Latitude</label>
					    <input
					    	type="number"
					    	class="form-control input_style"
					    	id="latitude"
					    	placeholder="latitude"
					    	v-model="form.latitude"
					    	:class="isRequired(form.latitude) ? 'isRequired' : ''"
				    	>
					  </div>
					  <div class="form-group col-md-3">
					    <label for="address">Адрес</label>
					    <textarea
					    	class="form-control input_style"
					    	v-model="form.address"
					    	:class="isRequired(form.address) ? 'isRequired' : ''"
					    	rows="1"
					    	placeholder="Адрес"
					    ></textarea>
					  </div>
					  <div class="form-group col-md-3">
					    <label for="asos">Асос</label>
					    <textarea
					    	class="form-control input_style"
					    	v-model="form.asos"
					    	:class="isRequired(form.asos) ? 'isRequired' : ''"
					    	rows="1"
					    	placeholder="Асос"
					    ></textarea>
					  </div>
					  <div class="form-group col-md-3">
					    <label for="price">Лойиҳа ва унинг қиймати</label>
					    <input
					    	type="number"
					    	class="form-control input_style"
					    	id="price"
					    	placeholder="Лойиҳа ва унинг қиймати"
					    	v-model="form.price"
					    	:class="isRequired(form.price) ? 'isRequired' : ''"
				    	>
					  </div>
					  <div class="form-group col-md-3">
					    <label for="project_photo">Ер ажратиш ва қурилиш учун ҳокимнинг қарори</label>
					    <input
					    	type="file"
					    	class="form-control input_style"
					    	id="project_photo"
					    	placeholder="Проект фото"
				    	 	@change="changeOfferHakim($event)"
					    	:class="isRequired(form.project_photo) ? 'isRequired' : ''"
				    	>
					  </div>
					  <div class="form-group col-md-3">
					    <label for="bank_credit">Молиялаштириш манбаи</label>
					    <input
					    	type="text"
					    	class="form-control input_style"
					    	id="bank_credit"
					    	placeholder="Молиялаштириш манбаи"
					    	v-model="form.bank_credit"
					    	:class="isRequired(form.bank_credit) ? 'isRequired' : ''"
				    	>
					  </div>
					  <div class="form-group col-md-3">
					    <label for="land_area">Eр майдони</label>
					    <input
					    	type="text"
					    	class="form-control input_style"
					    	id="land_area"
					    	placeholder="Eр майдони"
					    	v-model="form.land_area"
					    	:class="isRequired(form.land_area) ? 'isRequired' : ''"
				    	>
					  </div>
					  <div class="form-group col-md-3">
			              <label for="time_of_construction_start">Қурилиш ишлари бошланган вақти</label>
			              <date-picker
			                lang="ru"
			                placeholder="Дата"
			                type="date" format="YYYY-MM-DD" valueType="format"
			                v-model="form.time_of_construction_start"
			                class="datepicker"
			                :class="isRequired(form.time_of_construction_start) ? 'isRequired' : ''"
			              ></date-picker>
		              </div>
					  <div class="form-group col-md-3">
			              <label for="time_of_construction_end">Лойиҳани топшириш вақти</label>
			              <date-picker
			                lang="ru"
			                placeholder="Дата"
			                type="date" format="YYYY-MM-DD" valueType="format"
			                v-model="form.time_of_construction_end"
			                class="datepicker"
			                :class="isRequired(form.time_of_construction_end) ? 'isRequired' : ''"
			              ></date-picker>
		              </div>
  					  <div class="form-group col-md-3">
					    <label for="telephon">Телефон</label>
					    <input
					    	type="phone"
					    	class="form-control input_style"
					    	id="telephon"
					    	placeholder="Телефон"
					    	v-model="form.telephon"
					    	:class="isRequired(form.telephon) ? 'isRequired' : ''"
				    	>
					  </div>
  					  <div class="form-group col-md-3">
					    <label for="capacity_passenger">Йўловчи сиғими</label>
					    <input
					    	type="text"
					    	class="form-control input_style"
					    	id="capacity_passenger"
					    	placeholder="Йўловчи сиғими"
					    	v-model="form.capacity_passenger"
					    	:class="isRequired(form.capacity_passenger) ? 'isRequired' : ''"
				    	>
					  </div>
  					  <div class="form-group col-md-3">
					    <label for="work_schedule">Иш тартиби</label>
					    <input
					    	type="text"
					    	class="form-control input_style"
					    	id="work_schedule"
					    	placeholder="Иш тартиби"
					    	v-model="form.work_schedule"
					    	:class="isRequired(form.work_schedule) ? 'isRequired' : ''"
				    	>
					  </div>
  					  <div class="form-group col-md-3">
					    <label for="ustav_fond">Устав фонди</label>
					    <input
					    	type="text"
					    	class="form-control input_style"
					    	id="ustav_fond"
					    	placeholder="Устав фонди"
					    	v-model="form.ustav_fond"
					    	:class="isRequired(form.ustav_fond) ? 'isRequired' : ''"
				    	>
					  </div>
  					  <div class="form-group col-md-3">
					    <label for="project_photo">Проект фото</label>
					    <input
					    	type="file"
					    	class="form-control input_style"
					    	id="project_photo"
					    	placeholder="Проект фото"
				    	 	@change="changePhoto($event)"
				    	>
					    	<!-- :class="isRequired(form.project_photo) ? 'isRequired' : ''" -->
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
					// type_of_construction:'',
					station_id:'',
			    	name:'',
			    	company_name:'',
			    	station_id:'', 
			    	longitude:'',
			    	latitude:'', 
			    	inn:'',
			    	address:'', 
			    	region_id:'',
			    	area_id:'',
			    	asos:'', 
			    	offer_hakim:'',
			    	price:'', 
			    	bank_credit:'', 
			    	land_area:'', 
			    	time_of_construction_start:'',
			    	time_of_construction_end:'',
			    	telephon:'',
			    	capacity_passenger:'', 
			    	work_schedule:'', 
			    	ustav_fond:'', 
			    	project_photo:'', 
				},
				requiredInput:false,
				laoding: true
			}
		},
		computed:{
			...mapGetters('offerbuilding',['getMassage']),
			...mapGetters('station',['getStationsList','getStationsAreaByList']),
			...mapGetters('area',['getAreaLists']),
		    checkFormInput(){
		    	if (
		    		// this.form.type_of_construction != '' &&
		    		this.form.longitude != '' &&
			    	this.form.latitude != '' && 
					this.form.station_id != '' &&
			    	this.form.name != '' &&
			    	this.form.company_name != '' &&
			    	this.form.station_id != '' && 
			    	this.form.inn != '' &&
			    	this.form.address != '' && 
			    	this.form.area_id != '' &&
			    	this.form.asos != '' && 
			    	this.form.offer_hakim != '' &&
			    	this.form.price != '' && 
			    	this.form.bank_credit != '' && 
			    	this.form.land_area != '' && 
			    	this.form.time_of_construction_start != '' &&
			    	this.form.time_of_construction_end != '' &&
			    	this.form.telephon != '' &&
			    	this.form.capacity_passenger != '' && 
			    	this.form.work_schedule != '' && 
			    	this.form.ustav_fond != ''
		    	) {
		    		return true
		    	}else{
		    		return false
		    	} 
		    },
		},
		async mounted(){
			await this.actionStationLists()
			await this.actionAreaList()
			this.laoding = false
		},
		methods:{
			...mapActions('offerbuilding',['actionAddOfferbuilding']),
			...mapActions('station',['actionStationLists','actionStationByArea']),
			...mapActions('area',['actionAreaList']),
			isRequired(input){
	    		return this.requiredInput && input === '';
		    },
		    async stationAreaBy(){
		    	let data= {
		    		area_id:this.form.area_id
		    	}
		    	await this.actionStationByArea(data)
		    },
		    changeOfferHakim(event) {
		      let file = event.target.files[0];
		      if (
		        event.target.files[0]["type"] === "image/png" ||
		        event.target.files[0]["type"] === "image/jpeg" ||
		        event.target.files[0]["type"] === "image/jpg"
		      ) {
		        if (file.size > 1048576){
		          swal.fire({
		            type: "error",
		            title: "Ошибка",
		            text: "Размер изображения больше лимита"
		          });
		        } else {
		          let reader = new FileReader();
		          reader.onload = event => {
		            this.form.offer_hakim = event.target.result;
		          };
		          reader.readAsDataURL(file);
		        }
		      } else {
		        swal.fire({
		          type: "error",
		          title: "Ошибка",
		          text: "Картинка должна быть только png,jpg,jpeg!"
		        });
		      }
		    },
		    changePhoto(event) {
		      let file = event.target.files[0];
		      if (
		        event.target.files[0]["type"] === "image/png" ||
		        event.target.files[0]["type"] === "image/jpeg" ||
		        event.target.files[0]["type"] === "image/jpg"
		      ) {
		        if (file.size > 1048576) {
		          swal.fire({
		            type: "error",
		            title: "Ошибка",
		            text: "Размер изображения больше лимита"
		          });
		        } else {
		          let reader = new FileReader();
		          reader.onload = event => {
		            this.form.project_photo = event.target.result;
		          };
		          reader.readAsDataURL(file);
		        }
		      } else {
		        swal.fire({
		          type: "error",
		          title: "Ошибка",
		          text: "Картинка должна быть только png,jpg,jpeg!"
		        });
		      }
		    },
			async saveOfferbuilding(){
		    	if (this.checkFormInput){
					this.laoding = true
					await this.actionAddOfferbuilding(this.form)
					if (this.getMassage.success){
						toast.fire({
					    	type: 'success',
					    	icon: 'success',
							title: this.getMassage.message,
					    })
						this.$router.push("/crm/offerbuilding");
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

</style>
