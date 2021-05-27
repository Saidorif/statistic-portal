<template>
	<div class="edit_airportname">
		<Loader v-if="laoding"/>
		<div class="card">
		  	<div class="card-header">
			    <h4 class="title_user">
			    	<i class="sidebar_icon fas fa-plane"></i>
				    Изменить название аэропорта 
				</h4>
				<router-link class="btn_black" to="/crm/airportname"><span class="peIcon fas fa-arrow-left"></span> Назад</router-link>
		  	</div>
		  	<div class="card-body">
		  		<form @submit.prevent.enter="saveAirportname" >
					<div class="row">
					  <div class="form-group col-md-9">
					    <label for="name">Название</label>
					    <input
					    	type="text"
					    	class="form-control input_style"
					    	id="name"
					    	placeholder="Название"
					    	v-model="form.name"
					    	:class="isRequired(form.name) ? 'isRequired' : ''"
				    	>
					  </div>
					  <div class="form-group col-lg-3 form_btn">
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
					name:''
				},
				requiredInput:false,
				laoding: true
			}
		},
		computed:{
			...mapGetters('airportname',['getMassage','getAirportname'])
		},
		async mounted(){
			await this.actionEditAirportname(this.$route.params.airportnameId)
			this.laoding = false
			this.form = this.getAirportname
		},
		methods:{
			...mapActions('airportname',['actionUpdateAirportname','actionEditAirportname']),
			isRequired(input){
	    		return this.requiredInput && input === '';
		    },
			async saveAirportname(){
		    	if (this.form.name != ''){
					this.laoding = true
					await this.actionUpdateAirportname(this.form)
					if (this.getMassage.success) {
						toast.fire({
					    	type: 'success',
					    	icon: 'success',
							title: this.getMassage.message,
					    })
						this.$router.push("/crm/airportname");
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
