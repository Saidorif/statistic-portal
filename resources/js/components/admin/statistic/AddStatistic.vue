<template>
	<div class="add_statistic">
		<Loader v-if="laoding"/>
		<div class="card">
		  	<div class="card-header">
			    <h4 class="title_user">
			    	<i class="peIcon pe-7s-box1"></i>
				    Добавить асосий кўрсаткич
				</h4>
				<router-link class="btn_black" to="/crm/statistic"><span class="peIcon fas fa-arrow-left"></span> Назад</router-link>
		  	</div>
		  	<div class="card-body">
		  		<form @submit.prevent.enter="saveStatistic">
					<div class="row">
					  <div class="form-group col-md-3">
					    <label for="region_id">Области</label>
					    <select
					    	class="form-control input_style"
					    	v-model="form.region_id"
					    	:class="isRequired(form.region_id) ? 'isRequired' : ''"
				    	>
					    	<option value="" selected disabled>Выберите область</option>
					    	<option :value="item.id" v-for="(item,index) in getRegionList">{{item.name}}</option>
					    </select>
					  </div>
					  <div class="form-group col-md-3">
					    <label for="type">Фаолият тури</label>
					    <select name="" v-model="form.type" :class="isRequired(form.type) ? 'isRequired' : ''" class="form-control input_style">
					    	<option value="" selected disabled>Выберите фаолият тури</option>
					    	<option value="passenger_transportation">Йўловчи ташиш</option>
					    	<option value="passenger_turnover">Йўловчи айланмаси</option>
					    	<option value="shipping">Юк ташиш</option>
					    	<option value="cargo_turnover">Юк айланмаси</option>
					    </select>
					  </div>
					  <div class="form-group col-md-3">
					    <label for="quarter">Квартал</label>
					    <select name="" v-model="form.quarter" :class="isRequired(form.quarter) ? 'isRequired' : ''" class="form-control input_style">
					    	<option value="" selected disabled>Выберите квартал</option>
					    	<option value="1">I чорак</option>
					    	<option value="2">II чорак</option>
					    	<option value="3">III чорак</option>
					    	<option value="4">IV чорак</option>
					    </select>
					  </div>
					  <div class="form-group col-md-3">
					    <label for="number">Количества</label>
					    <input
					    	type="number"
					    	class="form-control input_style"
					    	id="number"
					    	placeholder="Количества"
					    	v-model="form.number"
					    	:class="isRequired(form.number) ? 'isRequired' : ''"
				    	>
					  </div>
					  <div class="form-group col-md-3 d-flex flex-column">
			              <label for="date">Дата</label>
			              <date-picker
			                lang="ru"
			                placeholder="Дата"
			                type="year" format="YYYY" valueType="format"
			                v-model="form.year"
			                :class="isRequired(form.year) ? 'isRequired' : ''"
			              ></date-picker>
		              </div>
					  <div class="form-group col-lg-9 d-flex justify-content-end align-items-end">
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
					region_id:'',
					type:'',
					number:'',
					year:'',
					quarter:'',
				},
				requiredInput:false,
				laoding: true
			}
		},
		computed:{
			...mapGetters('statistic',['getMassage']),
			...mapGetters('region',['getRegionList']),
		},
		async mounted(){
			await this.actionRegionList()
			this.laoding = false
		},
		methods:{
			...mapActions('statistic',['actionAddStatistic']),
			...mapActions('region',['actionRegionList']),
			isRequired(input){
	    		return this.requiredInput && input === '';
		    },
			async saveStatistic(){
		    	if (this.form.region_id != '' && this.form.type != '' && this.form.number != '' && this.form.year != '' && this.form.quarter != ''){
					this.laoding = true
					await this.actionAddStatistic(this.form)
					if (this.getMassage.success){
						toast.fire({
					    	type: 'success',
					    	icon: 'success',
							title: this.getMassage.message,
					    })
						this.$router.push("/crm/statistic");
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
