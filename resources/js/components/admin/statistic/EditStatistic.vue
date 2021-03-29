<template>
	<div class="edit_statistic">
		<Loader v-if="laoding"/>
		<div class="card">
		  	<div class="card-header">
			    <h4 class="title_user">
			    	<i class="peIcon pe-7s-id"></i>
				    Изменить асосий кўрсаткич
				</h4>
				<router-link class="btn_black" to="/crm/statistic"><span class="peIcon fas fa-arrow-left"></span> Назад</router-link>
		  	</div>
		  	<div class="card-body">
		  		<form @submit.prevent.enter="saveStatistic" >
					<div class="row">
					  <div class="form-group col-md-9">
					    <label for="name">Область</label>
					    <input
					    	type="text"
					    	class="form-control input_style"
					    	id="name"
					    	placeholder="Область"
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
			...mapGetters('statistic',['getMassage','getStatistic'])
		},
		async mounted(){
			await this.actionEditStatistic(this.$route.params.statisticId)
			this.laoding = false
			this.form = this.getStatistic
		},
		methods:{
			...mapActions('statistic',['actionUpdateStatistic','actionEditStatistic']),
			isRequired(input){
	    		return this.requiredInput && input === '';
		    },
			async savestatistic(){
		    	if (this.form.name != ''){
					this.laoding = true
					await this.actionUpdateStatistic(this.form)
					if (this.getMassage.success) {
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
