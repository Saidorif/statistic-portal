<template>
	<div class="edit_role">
		<div class="card">
		  	<div class="card-header">
				  <div class="header_title">

			    <h4 class="title_user">
			    	<i class="peIcon pe-7s-id"></i>
				    Редактировать Должность
				</h4>
				<router-link class="btn_black" to="/crm/position"><span class="peIcon fas fa-arrow-left"></span> Назад</router-link>
				  </div>

		  	</div>
		  	<div class="card-body">
		  		<form @submit.prevent.enter="savePosition" >
					<div class="row align-items-end">
					  <div class="form-group col-md-9">
					    <label for="positionName">Должность</label>
					    <input
					    	type="text"
					    	class="form-control input_style"
					    	id="positionName"
					    	placeholder="Должность"
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
	import {mapActions, mapGetters} from 'vuex'
	export default{
		data(){
			return{
				form:{
					name:'',
				},
				requiredInput:false
			}
		},
		computed:{
			...mapGetters('position',['getMassage','getPosition'])
		},
		async mounted(){
			await this.actionEditPosition({id:this.$route.params.positionId})
			this.form = this.getPosition
			console.log(this.getPosition)
		},
		methods:{
			...mapActions('position',['actionEditPosition','actionUpdatePosition']),
			isRequired(input){
	    		return this.requiredInput && input === '';
		    },
		    async savePosition(){
		    	if (this.form.name != '' && this.form.name != null){
					await this.actionUpdatePosition(this.form)
					this.$router.push("/crm/position");
					this.requiredInput =false
				}else{
					this.requiredInput =true
				}
		    }
		}
	}
</script>
<style scoped>

</style>
