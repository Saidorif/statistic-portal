<template>
	<div class="edit-reconstruction">
		<Loader v-if="laoding"/>
		<div class="card">
		  	<div class="card-header">
			    <h4 class="title_user">
			    	<i class="peIcon pe-7s-id"></i>
				    Изменить Confirm Reconstruction
				</h4>
				<div>
					<div class="btn" :class="getStatusClass(form.status)">
						{{getStatusName(form.status)}}
					</div>
					<router-link class="btn_black" to="/crm/confirm-reconstruction">
						<span class="peIcon fas fa-arrow-left"></span> 
						Назад
					</router-link>
				</div>
		  	</div>
		  	<div class="card-body">
		  		<form @submit.prevent.enter="saveReconstruction" >
					<div class="row">
					  <div class="form-group col-md-4">
					    <label for="company">Компании</label>
					    <div class="form-control input_style">
					    	{{form.offerbuilding ? form.offerbuilding.company_name : ''}}
					    </div>
				  	  </div>
					  <div class="form-group col-md-4">
		              	<label for="start_date">Дата начала</label>
		              	<div class="form-control input_style">
					    	{{form.start_date}}
				      	</div>
		              </div>
					  <div class="form-group col-md-4">
		              	<label for="end_date">Дата окончания</label>
		              	<div class="form-control input_style">
					    	{{form.end_date}}
				      	</div>
		              </div>
					  <div class="form-group col-md-3">
					    <label for="summa">Сумма</label>
					    <div class="form-control input_style">
					    	{{form.summa}}
				      	</div>
					  </div>
					  <div class="form-group col-md-3">
					    <label for="asos">Асос</label>
					    <div class="form-control input_style">
					    	{{form.asos}}
				      	</div>
					  </div>
					  <div class="form-group col-md-3">
					    <label for="comment">Комментарии</label>
					    <div class="form-control input_style">
					    	{{form.comment}}
				      	</div>
					  </div>
					  <div class="form-group col-md-3">
					    <label for="recon_hakim">Реконструкция учун ҳокимнинг қарори</label>
					    <div class="form-control input_style">
					    	{{form.recon_hakim}}
				      	</div>
				      	<small>
				    		<a :href="photoImg(form.recon_hakim)" download="">
					    		<i class="fas fa-download"></i> 
					    		Скачать файл
					    	</a>
				    	</small>
					  </div>
					  <div class="form-group col-lg-12 d-flex justify-content-end">
					  	<button type="button" class="btn btn-danger mr-3" @click.prevent="openModal" v-if="form.status != 'accepted'">
					  		<i class="fas fa-minus-circle"></i>
						  	Отказать
						</button>
					  	<button type="button" class="btn btn-primary btn_save_category" @click.prevent="acceptReconstruction" v-if="form.status != 'accepted'">
					  		<i class="fas fa-save"></i>
						  	Подтвердить
						</button>
				  	  </div>
					</div>
				</form>
		  	</div>
	  	</div>

	  	<!-- Modal -->
	  	<div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="rejectModalTitle" aria-hidden="true">
		  	<div class="modal-dialog modal-dialog-centered" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLongTitle">Примечиние</h5>
			        <button type="button" class="close" @click="closeModal">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
					<textarea :class="isRequired(comment) ? 'isRequired' : ''"   v-model="comment" class="form-control" rows="10" placeholder="Текст..."></textarea>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn_green" @click.prevent="rejectReconstruction">
				        <span class="mr-1">Отправить</span>
			        	<i class="fas fa-share-square"></i>
				    </button>
			      </div>
			    </div>
		  	</div>
		</div>
	</div>
</template>
<script>
	import { mapGetters , mapActions } from 'vuex'
	import Loader from '../../Loader'
	import Multiselect from 'vue-multiselect';
	import DatePicker from "vue2-datepicker";
	export default{
		components:{
			Loader,
			DatePicker,
			Multiselect,
		},
		data(){
			return{
				form:{
					offerbuilding_id:'',
					start_date:'',
					end_date:'',
					summa:'',
					asos:'',
					comment:'',
					recon_hakim:'',
				},
				comment:'',
				requiredInput:false,
				laoding: true,
				isLoading: false,
				values: {},
				findList: [],
			}
		},
		computed:{
			...mapGetters('reconstruction',['getMassage','getReconstructionFindList','getReconstruction']),
			checkInput(){
				if(
					this.form.offerbuilding_id != '' && 
					this.form.start_date != '' && 
					this.form.end_date != '' && 
					this.form.summa != '' && 
					this.form.asos != '' && 
					this.form.comment != '' && 
					this.form.recon_hakim != ''
				){
					return true
				}else{
					return false
				}
			}
		},
		async mounted(){
			await this.actionEditReconstruction(this.$route.params.reconstructionId)
			this.form = this.getReconstruction
			this.values = this.getReconstruction.offerbuilding
			this.laoding = false
		},
		watch:{
			'getReconstruction':{
				handler(){
					this.form = this.getReconstruction
					this.comment = this.getReconstruction.comment
				}
			}
		},
		methods:{
			...mapActions('reconstruction',['actionEditReconstruction','actionRejectReconstruction','actionAcceptReconstruction']),
			isRequired(input){
	    		return this.requiredInput && input === '';
		    },
		    photoImg(img) {
		    	if (img) {
			      if (img.length > 100) {
			        return img;
			      } else {
			        return '/reconstruction/'+img;
			      }
		    	}
		    },
		    getStatusName(status){
				if(status == 'waiting'){
					return "Тасдикланмаган!"
				}else if(status == 'rejected'){
					return "Рад этилган!"
				}else if(status == 'accepted'){
					return "Тасдикланган!"
				}
			},
			getStatusClass(status){
				if(status == 'waiting'){
					return "alert-warning"
				}else if(status == 'rejected'){
					return "alert-danger"
				}else if(status == 'accepted'){
					return "alert-primary"
				}
			},
		    async rejectReconstruction(){
		    	if(this.comment !=''){
		    		let data = {
		    			id:this.form.id,
		    			comment:this.comment,
		    		}
		    		await this.actionRejectReconstruction(data)
		    		if (this.getMassage.success){
		    			toast.fire({
					    	type: 'success',
					    	icon: 'success',
							title: this.getMassage.message,
					    })
					    await this.actionEditReconstruction(this.$route.params.reconstructionId)
					    this.closeModal()
		    		}else{
		    			toast.fire({
					    	type: 'error',
					    	icon: 'error',
							title: this.getMassage.message,
					    })
		    		}
		    	}else{
		    		toast.fire({
				    	type: 'error',
				    	icon: 'error',
						title: 'Введите примечание!',
				    })
		    	}
		    },
		    openModal(){
		    	$('#rejectModal').modal('show')
		    },
		    closeModal(){
		    	$('#rejectModal').modal('hide')
		    },
			async acceptReconstruction(){
		  		if(confirm("Вы действительно хотите подтвердить?")){
		    		let data = {
		    			id:this.form.id,
		    		}
		    		await this.actionAcceptReconstruction(data)
		    		if (this.getMassage.success){
		    			toast.fire({
					    	type: 'success',
					    	icon: 'success',
							title: this.getMassage.message,
					    })
					    await this.actionEditReconstruction(this.$route.params.reconstructionId)
					    this.closeModal()
		    		}
				}
		    },
		}
	}
</script>
<style scoped>

</style>
