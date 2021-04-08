<template>
	<div class="edit_region">
		<Loader v-if="laoding"/>
		<div class="card">
		  	<div class="card-header">
			    <h4 class="title_user">
			    	<i class="peIcon pe-7s-id"></i>
				    Изменить План
				</h4>
				<router-link class="btn_black" to="/crm/regionplan"><span class="peIcon fas fa-arrow-left"></span> Назад</router-link>
		  	</div>
		  	<div class="card-body">
		  		<form @submit.prevent.enter="saveRegion" >
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
					    <label for="number">План количества</label>
					    <input
					    	type="number"
					    	class="form-control input_style"
					    	id="number"
					    	placeholder="План количества"
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
			                v-model="form.date"
			                :class="isRequired(form.date) ? 'isRequired' : ''"
			              ></date-picker>
		              </div>
					  <div class="form-group col-lg-3 d-flex justify-content-end align-items-end">
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
	import Loader from '../../../Loader'
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
					number:'',
					date:'',
				},
				requiredInput:false,
				laoding: true
			}
		},
		computed:{
			...mapGetters('regionplan',['getMassage','getRegionPlan']),
			...mapGetters('region',['getRegionList']),
		},
		async mounted(){
			await this.actionEditRegionPlan(this.$route.params.regionplanId)
			await this.actionRegionList()
			this.laoding = false
			this.form = this.getRegionPlan
		},
		methods:{
			...mapActions('regionplan',['actionUpdateRegionPlan','actionEditRegionPlan']),
			...mapActions('region',['actionRegionList']),
			isRequired(input){
	    		return this.requiredInput && input === '';
		    },
			async saveRegion(){
		    	if (this.form.name != ''){
					this.laoding = true
					this.form['id']=this.$route.params.regionplanId
					await this.actionUpdateRegionPlan(this.form)
					if (this.getMassage.success) {
						toast.fire({
					    	type: 'success',
					    	icon: 'success',
							title: this.getMassage.message,
					    })
						this.$router.push("/crm/regionplan");
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
