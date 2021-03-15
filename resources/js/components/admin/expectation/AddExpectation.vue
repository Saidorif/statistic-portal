<template>
	<div class="add_expectation">
		<Loader v-if="laoding"/>
		<div class="card">
		  	<div class="card-header">
			    <h4 class="title_user">
			    	<i class="peIcon pe-7s-id"></i>
				    Добавить Expectation
				</h4>
				<router-link class="btn btn-primary back_btn" to="/crm/expectation"><span class="peIcon pe-7s-back"></span> Назад</router-link>
		  	</div>
		  	<div class="card-body">
		  		<form @submit.prevent.enter="saveExpectation" >
					<div class="row">
					  <div class="form-group col-md-9">
					    <label for="name">Expectation</label>
					    <input 
					    	type="text" 
					    	class="form-control input_style" 
					    	id="name" 
					    	placeholder="Expectation"
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
			...mapGetters('expectation',['getMassage'])
		},
		mounted(){
			this.laoding = false
		},
		methods:{
			...mapActions('expectation',['actionAddExpectation']),
			isRequired(input){
	    		return this.requiredInput && input === '';
		    },
			async saveExpectation(){
		    	if (this.form.name != ''){
					this.laoding = true
					await this.actionAddExpectation(this.form)
					if (this.getMassage.success) {
						toast.fire({
					    	type: 'success',
					    	icon: 'success',
							title: this.getMassage.message,
					    })
						this.$router.push("/crm/expectation");
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