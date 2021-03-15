<template>
	<div class="edit_fakt">
		<Loader v-if="laoding"/>
		<div class="card">
		  	<div class="card-header d-flex justify-content-between align-items-center">
			    <h4 class="title_user">
			    	<i class="peIcon pe-7s-id"></i>
				    Изменить Fakt
				</h4>
				<div>
					<div class="alert" :class="getStatusClass(form.status)">
						{{getStatusName(form.status)}}
					</div>
				</div>
				<router-link class="btn btn-primary back_btn" :to='`/crm/regionplan/fakt/${$route.params.faktregionId}?expectId=${$route.query.expectId}`'>
					<span class="peIcon pe-7s-back"></span> 
					Назад
				</router-link>
		  	</div>
		  	<div class="card-body">
		  		<form>
					<div class="row">
					  <div class="form-group col-md-4">
					    <label for="bus_id">Bus</label>
					    <div class="form-control input_style bg_disabled_color">
					    	{{form.bus_id}}
					    </div>
					  </div>
					  <div class="form-group col-md-4">
					    <label for="capacity">Автобус сиғими</label>
					    <div class="form-control input_style bg_disabled_color bg_disabled_color">
					    	{{form.capacity}}
					    </div>
					  </div>
					  <div class="form-group col-md-4">
					    <label for="bank_credit">Молиялаштириш манбаи</label>
					    <div class="form-control input_style bg_disabled_color">
					    	{{form.bank_credit}}
					    </div>
					  </div>
					  <div class="form-group col-md-4">
					    <label for="auto_price">Автобус нарҳи</label>
					    <div class="form-control input_style bg_disabled_color">
					    	{{form.auto_price}}
					    </div>
					  </div>
					  <div class="form-group col-md-4 d-flex flex-column">
			              <label for="purchase_date">Ҳарид қилинган сана</label>
			              <div class="form-control input_style bg_disabled_color">
					    	{{form.purchase_date}}
					      </div>
		              </div>
					  <div class="form-group col-md-4">
					    <label for="registr_cerf">Давлат рўйҳатидан ўтганлик ҳақида гувохнома рақами</label>
					    <div class="form-control input_style bg_disabled_color">
				    		{{form.registr_cerf}}
				      	</div>
					  </div>
					  <div class="form-group col-lg-12 d-flex justify-content-end">
					  	<button type="button" class="btn btn-danger mr-3" @click.prevent="openModal" v-if="form.status != 'accepted'">
					  		<i class="fas fa-minus-circle"></i>
						  	Отказать
						</button>	
					  	<button type="button" class="btn btn-primary btn_save_category" @click.prevent="acceptFakt" v-if="form.status != 'accepted'">
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
			        <button type="button" class="btn btn-success" @click.prevent="rejectFakt">
				        Отправить
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
	import DatePicker from "vue2-datepicker";
	export default{
		components:{
			Loader,
			DatePicker,
		},
		data(){
			return{
				form:{
					expect_id:'',
					bus_id:'',
					capacity:'',
					bank_credit:'',
					auto_price:'',
					purchase_date:'',
					registr_cerf:'',
					status:'',
				},
				comment:'',
				requiredInput:false,
				laoding: true
			}
		},
		computed:{
			...mapGetters('fakt',['getMassage','getFakt']),
			...mapGetters('busmodel',['getBusmodelList']),
		},
		async mounted(){
			await this.actionEditFakt(this.$route.params.FaktId)
			await this.actionBusmodelList()
			this.laoding = false
			this.form = this.getFakt
			this.comment = this.getFakt.comment
		},
		watch:{
			'getFakt':{
				handler(){
					this.form = this.getFakt
					this.comment = this.getFakt.comment
				}
			}
		},
		methods:{
			...mapActions('fakt',['actionAcceptFakt','actionRejectFakt','actionEditFakt']),
			...mapActions('busmodel',['actionBusmodelList']),
			isRequired(input){
	    		return this.requiredInput && input === '';
		    },
		    async rejectFakt(){
		    	if(this.comment !=''){
		    		let data = {
		    			id:this.form.id,
		    			comment:this.comment,
		    		}
		    		await this.actionRejectFakt(data)
		    		if (this.getMassage.success) {
		    			toast.fire({
					    	type: 'success',
					    	icon: 'success',
							title: this.getMassage.message,
					    })
					    await this.actionEditFakt(this.$route.params.FaktId)
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
			async acceptFakt(){
				if(confirm("Вы действительно хотите подтвердить?")){
		    		let data = {
		    			id:this.form.id,
		    		}
		    		await this.actionAcceptFakt(data)
		    		if (this.getMassage.success) {
		    			toast.fire({
					    	type: 'success',
					    	icon: 'success',
							title: this.getMassage.message,
					    })
					    await this.actionEditFakt(this.$route.params.FaktId)
					    this.closeModal()
		    		}
				}
		    }
		}
	}
</script>
<style scoped>
	.datepicker{
		width:500px;
	}
	.bg_disabled_color{
		background:#e2e2e2;
	}
</style>