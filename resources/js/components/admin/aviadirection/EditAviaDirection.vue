<template>
	<div class="edit_aviadirection">
		<Loader v-if="laoding"/>
		<div class="card">
		  	<div class="card-header">
			    <h4 class="title_user">
			    	<i  class="peIcon fas-fa plane"></i>
				    Изменить Авиайўналишлари
				</h4>
				<router-link class="btn_black" to="/crm/aviadirection"><span class="peIcon fas fa-arrow-left"></span> Назад</router-link>
		  	</div>
		  	<div class="card-body">
		  		<form @submit.prevent.enter="saveAviaDirection" >
					<div class="row">
					  <div class="form-group col-md-3">
					    <label for="name">Йўналиш номи</label>
					    <input
					    	type="text"
					    	class="form-control input_style"
					    	id="name"
					    	placeholder="Йўналиш номи"
					    	v-model="form.name"
					    	:class="isRequired(form.name) ? 'isRequired' : ''"
				    	>
					  </div>
					  <div class="form-group col-md-3">
					    <label for="direction_type">Рейслар йўналиши</label>
					    <select 
					    	class="form-control input_style"
					    	id="direction_type"
					    	placeholder="Аэропорт номи"
					    	v-model="form.direction_type"
					    	:class="isRequired(form.direction_type) ? 'isRequired' : ''"
					    >
					    	<option value="" selected diabled>Рейс йўналишини танланг!</option>
					    	<option :value="item.key" v-for="(item,index) in $g.getTypeAirports()">{{item.value}}</option>
					    </select>
				  	  </div>
					  <div class="form-group col-md-3">
					    <label for="avia_type">Авиақатнов тури</label>
					    <select 
					    	class="form-control input_style"
					    	id="avia_type"
					    	placeholder="Аэропорт номи"
					    	v-model="form.avia_type"
					    	:class="isRequired(form.avia_type) ? 'isRequired' : ''"
					    >
					    	<option value="" selected diabled>Авиақатнов турини танланг!</option>
					    	<option :value="item.key" v-for="(item,index) in $g.getAviaTypes()">{{item.value}}</option>
					    </select>
				  	  </div>
					  <div class="form-group col-md-3">
					    <label for="flight_qty">Парвозлар сони (хафтасига) </label>
					    <input
					    	type="number"
					    	class="form-control input_style"
					    	id="flight_qty"
					    	placeholder="Парвозлар сони"
					    	v-model="form.flight_qty"
					    	:class="isRequired(form.flight_qty) ? 'isRequired' : ''"
				    	>
					  </div>
					  <div class="form-group col-lg-12 d-flex justify-content-end align-items-center">
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
	export default{
		components:{
			Loader
		},
		data(){
			return{
				form:{
					name:'',
					direction_type:'', 
					avia_type:'',
					flight_qty:'',
				},
				requiredInput:false,
				laoding: true
			}
		},
		computed:{
			...mapGetters('aviadirection',['getMassage','getAviaDirection'])
		},
		async mounted(){
			await this.actionEditAviaDirection(this.$route.params.aviadirectionId)
			this.laoding = false
			this.form = this.getAviaDirection
		},
		methods:{
			...mapActions('aviadirection',['actionUpdateAviaDirection','actionEditAviaDirection']),
			isRequired(input){
	    		return this.requiredInput && input === '';
		    },
			async saveAviaDirection(){
		    	if (this.form.name != ''){
					this.laoding = true
					await this.actionUpdateAviaDirection(this.form)
					if (this.getMassage.success) {
						toast.fire({
					    	type: 'success',
					    	icon: 'success',
							title: this.getMassage.message,
					    })
						this.$router.push("/crm/aviadirection");
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
