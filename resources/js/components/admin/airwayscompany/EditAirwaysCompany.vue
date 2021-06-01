<template>
	<div class="add_airwayscompany">
		<Loader v-if="laoding"/>
		<div class="card">
		  	<div class="card-header">
			    <h4 class="title_user">
			    	<i class="peIcon pe-7s-id"></i>
				    Изменить Название авиакомпании
				</h4>
				<router-link class="btn_black" to="/crm/airwayscompany"><span class="peIcon fas fa-arrow-left"></span> Назад</router-link>
		  	</div>
		  	<div class="card-body">
		  		<form @submit.prevent.enter="saveAirwaysCompany" >
					<div class="row">
					  <div class="form-group col-md-9">
					    <label for="name">Название авиакомпании</label>
					    <input
					    	type="text"
					    	class="form-control input_style"
					    	id="name"
					    	placeholder="Название авиакомпании"
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
			...mapGetters('airwayscompany',['getMassage','getAirwaysCompany'])
		},
		async mounted(){
			await this.actionEditAirwaysCompany(this.$route.params.airwayscompanyId)
			this.form = this.getAirwaysCompany
			this.laoding = false
		},
		methods:{
			...mapActions('airwayscompany',['actionEditAirwaysCompany','actionUpdateAirwaysCompany',]),
			isRequired(input){
	    		return this.requiredInput && input === '';
		    },
			async saveAirwaysCompany(){
		    	if (this.form.name != ''){
					this.laoding = true
					await this.actionUpdateAirwaysCompany(this.form)
					if (this.getMassage.success) {
						toast.fire({
					    	type: 'success',
					    	icon: 'success',
							title: this.getMassage.message,
					    })
						this.$router.push("/crm/airwayscompany");
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
