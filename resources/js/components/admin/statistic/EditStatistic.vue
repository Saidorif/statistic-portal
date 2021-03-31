<template>
	<div class="add_statistic">
		<Loader v-if="laoding"/>
		<div class="card">
		  	<div class="card-header">
			    <h4 class="title_user">
			    	<i class="peIcon fas fa-bus"></i>
				    Добавить асосий кўрсаткич
				</h4>
				<router-link class="btn_black" :to='`/crm/statistic?type=${$route.query.type}&year=${$route.query.year}`'>
					<span class="peIcon fas fa-arrow-left"></span> 
					Назад
				</router-link>
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
					    	<option :value="type.key" v-for="(type,index) in $g.typeOfAvtoActivity()">{{type.name}}</option>
					    </select>
					  </div>
					  <div class="form-group col-md-3">
					    <label for="unit">Ўлчов бирлиги</label>
					    <div class="form-control input_style">
					    	{{$g.findUnitTypeOfAvtoActivity(form.type)}}
					    </div>
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
	              	</div>
	              	<hr>
	              	<div class="row">
					  <div class="form-group col-md-3">
					    <label for="quarter_one">I чорак</label>
					    <input
					    	type="text"
					    	class="form-control input_style"
					    	id="quarter_one"
					    	placeholder="Количества"
					    	v-model="form.quarter_one"
				    	>
					  </div>
					  <div class="form-group col-md-3">
					    <label for="quarter_two">II чорак</label>
					    <input 
					    	type="text"
					    	class="form-control input_style"
					    	id="quarter_two"
					    	placeholder="Количества"
					    	v-model="form.quarter_two"
				    	>
					  </div>
					  <div class="form-group col-md-3">
					    <label for="quarter_three">III чорак</label>
					    <input
					    	type="text"
					    	class="form-control input_style"
					    	id="quarter_three"
					    	placeholder="Количества"
					    	v-model="form.quarter_three"
				    	>
					  </div>
					  <div class="form-group col-md-3">
					    <label for="quarter_four">VI чорак</label>
					    <input
					    	type="text"
					    	class="form-control input_style"
					    	id="quarter_four"
					    	placeholder="Количества"
					    	v-model="form.quarter_four"
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
					region_id:'',
					type:'',
					year:'',
					quarter_one:'',
				 	quarter_two:'',
				  	quarter_three:'',
				  	quarter_four:'',
				},
				requiredInput:false,
				laoding: true
			}
		},
		computed:{
			...mapGetters('statistic',['getMassage','getStatistic']),
			...mapGetters('region',['getRegionList']),
		},
		async mounted(){
			await this.actionEditStatistic(this.$route.params.statisticId)
			this.form = this.getStatistic
			await this.actionRegionList()
			this.laoding = false
		},
		methods:{
			...mapActions('statistic',['actionUpdateStatistic','actionEditStatistic']),
			...mapActions('region',['actionRegionList']),
			isRequired(input){
	    		return this.requiredInput && input === '';
		    },
			async saveStatistic(){
		    	if (this.form.region_id != '' && this.form.type != '' && this.form.year != ''){
					this.laoding = true
					await this.actionUpdateStatistic(this.form)
					if (this.getMassage.success){
						toast.fire({
					    	type: 'success',
					    	icon: 'success',
							title: this.getMassage.message,
					    })
						this.$router.push(`/crm/statistic?type=${this.$route.query.type}&year=${this.$route.query.year}`);
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
