<template>
	<div class="add_statistic">
		<Loader v-if="laoding"/>
		<div class="card">
		  	<div class="card-header">
			    <h4 class="title_user">
			    	<i class="peIcon fas fa-box"></i>
					Добавить Международные автомобильные перевозки
				</h4>
				<router-link class="btn_black" to="/crm/statisticinternationalcargo/all"><span class="peIcon fas fa-arrow-left"></span> Назад</router-link>
		  	</div>
		  	<div class="card-body">
		  		<form @submit.prevent.enter="saveStatistic">
					<div class="row">
					  <div class="form-group col-md-4">
					    <label for="type">Фаолият тури</label>
					    <select name="" v-model="form.type" :class="isRequired(form.type) ? 'isRequired' : ''" class="form-control input_style">
					    	<option value="" selected disabled>Выберите фаолият тури</option>
					    	<option :value="type.key" v-for="(type,index) in $g.typeOfInternationalCargo()">{{type.name}}</option>
					    </select>
					  </div>
					  <div class="form-group col-md-4">
					    <label for="unit">Ўлчов бирлиги</label>
					    <div class="form-control input_style">
					    	минг тонна
					    </div>
					  </div>
  					  <div class="form-group col-md-4 d-flex flex-column">
			              <label for="date">Дата</label>
			              <date-picker
			                lang="ru"
			                placeholder="Дата"
			                type="year" format="YYYY" valueType="format"
			                v-model="form.year"
			                :class="isRequired(form.year) ? 'isRequired' : ''"
			              ></date-picker>
		              </div>
	              	</div>
	              	<hr>
	              	<div class="row">
					  <div class="form-group col-md-3">
					    <label for="yanvar">Январь</label>
					    <input
					    	type="text"
					    	class="form-control input_style"
					    	id="yanvar"
					    	placeholder="Январь"
					    	v-model="form.yanvar"
				    	>
					  </div>
					  <div class="form-group col-md-3">
					    <label for="fevral">Февраль</label>
					    <input 
					    	type="text"
					    	class="form-control input_style"
					    	id="fevral"
					    	placeholder="Февраль"
					    	v-model="form.fevral"
				    	>
					  </div>
					  <div class="form-group col-md-3">
					    <label for="mart">Март</label>
					    <input
					    	type="text"
					    	class="form-control input_style"
					    	id="mart"
					    	placeholder="Март"
					    	v-model="form.mart"
				    	>
					  </div>
					  <div class="form-group col-md-3">
					    <label for="aprel">Апрель</label>
					    <input
					    	type="text"
					    	class="form-control input_style"
					    	id="aprel"
					    	placeholder="Апрель"
					    	v-model="form.aprel"
				    	>
					  </div>
					  <div class="form-group col-md-3">
					    <label for="may">Май</label>
					    <input
					    	type="text"
					    	class="form-control input_style"
					    	id="may"
					    	placeholder="Май"
					    	v-model="form.may"
				    	>
					  </div>
					  <div class="form-group col-md-3">
					    <label for="iyun">Июнь</label>
					    <input
					    	type="text"
					    	class="form-control input_style"
					    	id="iyun"
					    	placeholder="Июнь"
					    	v-model="form.iyun"
				    	>
					  </div>
					  <div class="form-group col-md-3">
					    <label for="iyul">Июль</label>
					    <input
					    	type="text"
					    	class="form-control input_style"
					    	id="iyul"
					    	placeholder="Июль"
					    	v-model="form.iyul"
				    	>
					  </div>
					  <div class="form-group col-md-3">
					    <label for="avgust">Августь</label>
					    <input
					    	type="text"
					    	class="form-control input_style"
					    	id="avgust"
					    	placeholder="Августь"
					    	v-model="form.avgust"
				    	>
					  </div>
					  <div class="form-group col-md-3">
					    <label for="sentabr">Сентябрь</label>
					    <input
					    	type="text"
					    	class="form-control input_style"
					    	id="sentabr"
					    	placeholder="Сентябрь"
					    	v-model="form.sentabr"
				    	>
					  </div>
					  <div class="form-group col-md-3">
					    <label for="oktabr">Октябрь</label>
					    <input
					    	type="text"
					    	class="form-control input_style"
					    	id="oktabr"
					    	placeholder="Октябрь"
					    	v-model="form.oktabr"
				    	>
					  </div>
					  <div class="form-group col-md-3">
					    <label for="noyabr">Ноябрь</label>
					    <input
					    	type="text"
					    	class="form-control input_style"
					    	id="noyabr"
					    	placeholder="Ноябрь"
					    	v-model="form.noyabr"
				    	>
					  </div>
					  <div class="form-group col-md-3">
					    <label for="dekabr">Декабрь</label>
					    <input
					    	type="text"
					    	class="form-control input_style"
					    	id="dekabr"
					    	placeholder="Декабрь"
					    	v-model="form.dekabr"
				    	>
					  </div>
	              	</div>
	              	<div class="row">
					  <div class="form-group col-lg-12 d-flex justify-content-end align-items-end">
					  	<button type="submit" class="btn_green">
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
					id:'',
					type:'',
					year:'',
					yanvar:'',
				 	fevral:'',
				  	mart:'',
				  	aprel:'',
				  	may:'',
				  	iyun:'',
				  	iyul:'',
				  	avgust:'',
				  	sentabr:'',
				  	oktabr:'',
				  	noyabr:'',
				  	dekabr:'',
				},
				requiredInput:false,
				laoding: true
			}
		},
		computed:{
			...mapGetters('statisticinternationalcargo',['getMassage','getStatisticInternationalCargo']),
			...mapGetters('region',['getRegionList']),
		},
		async mounted(){
			await this.actionEditStatisticInternationalCargo(this.$route.params.statisticinternationalcargoId)
			await this.actionRegionList()
			this.form = this.getStatisticInternationalCargo
			this.laoding = false
		},
		methods:{
			...mapActions('statisticinternationalcargo',['actionUpdateStatisticInternationalCargo','actionEditStatisticInternationalCargo']),
			...mapActions('region',['actionRegionList']),
			isRequired(input){
	    		return this.requiredInput && input === '';
		    },
			async saveStatistic(){
				console.log(this.form)
		    	if (this.form.type != '' && this.form.year != ''){
					this.laoding = true
					await this.actionUpdateStatisticInternationalCargo(this.form)
					if (this.getMassage.success){
						toast.fire({
					    	type: 'success',
					    	icon: 'success',
							title: this.getMassage.message,
					    })
						this.$router.push("/crm/statisticinternationalcargo");
						this.requiredInput = false
					}else{
						toast.fire({
					    	type: 'error',
					    	icon: 'error',
							title: this.getMassage.message,
					    })
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
