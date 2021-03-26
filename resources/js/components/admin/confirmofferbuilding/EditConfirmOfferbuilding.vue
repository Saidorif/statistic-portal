<template>
	<div class="add-offerbuilding">
		<Loader v-if="laoding"/>
		<div class="card">
			<div class="card-header d-flex justify-content-between align-items-center">
			    <h4 class="title_user">
			    	<i class="peIcon fas fa-building"></i>
				    Измерить Offer building 
				</h4>
				<div>
					<div class="btn" :class="getStatusClass(form.status)">
						{{getStatusName(form.status)}}
					</div>
					<router-link class="btn_black" to="/crm/confirm-offerbuilding">
						<span class="peIcon fas fa-arrow-left"></span> 
						Назад
					</router-link>
				</div>
		  	</div>
		  	<div class="card-body">
		  		<form>
					<div class="row">
				      <div class="form-group col-md-3">
					    <label for="area_id">Туман/шахарлар</label>
					    <div class="form-control input_style" >
					    	{{form.area ? form.area.name : ''}}
					    </div>
					  </div>
				      <div class="form-group col-md-3">
					    <label for="station_id">Бекатлар</label>
					    <div class="form-control input_style" >
					    	{{form.area ? form.area.name : ''}}
					    </div>
					  </div>
					  <div class="form-group col-md-3">
					    <label for="name">Ф.И.О</label>
					    <div class="form-control input_style" >
					    	{{form.name}}
					    </div>
					  </div>
					  <div class="form-group col-md-3">
					    <label for="company_name">Название учреждения</label>
					    <div class="form-control input_style" >
					    	{{form.company_name}}
					    </div>
					  </div>
					  <div class="form-group col-md-3">
					    <label for="inn">ИНН</label>
					    <div class="form-control input_style" >
					    	{{form.inn}}
					    </div>
					  </div>
					  <div class="form-group col-md-3">
					    <label for="latitude">Latitude</label>
					    <div class="form-control input_style" >
					    	{{form.latitude}}
					    </div>
					  </div>
					  <div class="form-group col-md-3">
					    <label for="longitude">Longitude</label>
					    <div class="form-control input_style" >
					    	{{form.longitude}}
					    </div>
					  </div>
					  <div class="form-group col-md-3">
					    <label for="address">Адрес</label>
					    <div class="form-control input_style" >
					    	{{form.address}}
					    </div>
					  </div>
					  <div class="form-group col-md-3">
					    <label for="asos">Асос</label>
					    <div class="form-control input_style" >
					    	{{form.asos}}
					    </div>
					  </div>
					  <div class="form-group col-md-3">
					    <label for="price">Лойиҳа ва унинг қиймати</label>
					    <div class="form-control input_style" >
					    	{{form.price}}
					    </div>
					  </div>
					  <div class="form-group col-md-3">
					    <label for="offer_hakim">Ер ажратиш ва қурилиш учун ҳокимнинг қарори</label>
				       	<div class="form-control input_style" >
					    	{{form.offer_hakim}}
					    </div>
				    	<small>
				    		<a :href="photoImg(form.offer_hakim)" download="">
					    		<i class="fas fa-download"></i> 
					    		Скачать файл
					    	</a>
				    	</small>
					  </div>
					  <div class="form-group col-md-3">
					    <label for="bank_credit">Молиялаштириш манбаи</label>
					    <div class="form-control input_style" >
					    	{{form.bank_credit}}
					    </div>
					  </div>
					  <div class="form-group col-md-3">
					    <label for="land_area">Eр майдони</label>
					    <div class="form-control input_style" >
					    	{{form.land_area}}
					    </div>
					  </div>
					  <div class="form-group col-md-3">
						<label for="time_of_construction_start">Қурилиш ишлари бошланган вақти</label>
						<div class="form-control input_style" >
							{{form.time_of_construction_start}}
						</div>
		              </div>
					  <div class="form-group col-md-3">
		              	<label for="time_of_construction_end">Лойиҳани топшириш вақти</label>
		              	<div class="form-control input_style" >
							{{form.time_of_construction_end}}
						</div>
		              </div>
  					  <div class="form-group col-md-3">
					    <label for="telephon">Телефон</label>
					    <div class="form-control input_style" >
							{{form.telephon}}
						</div>
					  </div>
  					  <div class="form-group col-md-3">
					    <label for="capacity_passenger">Йўловчи сиғими</label>
					    <div class="form-control input_style" >
							{{form.capacity_passenger}}
						</div>
					  </div>
  					  <div class="form-group col-md-3">
					    <label for="work_schedule">Иш тартиби</label>
					    <div class="form-control input_style" >
							{{form.work_schedule}}
						</div>
					  </div>
  					  <div class="form-group col-md-3">
					    <label for="ustav_fond">Устав фонди</label>
					    <div class="form-control input_style" >
							{{form.ustav_fond}}
						</div>
					  </div>
  					  <div class="form-group col-md-3">
					    <label for="project_photo">Проект фото</label>
					    <div class="form-control input_style" >
							{{form.project_photo}}
						</div>
					    	<!-- :class="isRequired(form.project_photo) ? 'isRequired' : ''" -->
					  </div>
					  <div class="form-group col-lg-12 d-flex justify-content-end">
					  	<button type="button" class="btn btn-danger mr-3" @click.prevent="openModal" v-if="form.status != 'accepted'">
					  		<i class="fas fa-minus-circle"></i>
						  	Отказать
						</button>
					  	<button type="button" class="btn btn-primary btn_save_category" @click.prevent="acceptOfferbuilding" v-if="form.status != 'accepted'">
					  		<i class="fas fa-save"></i>
						  	Подтвердить
						</button>
				  	  </div>
					</div>
				</form>
		  	</div>
		  	<div style="width: 100%">
				<iframe width="100%" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" :src='`https://maps.google.com/maps?width=100%25&amp;height=300&amp;hl=en&amp;q=${form.latitude},${form.longitude}&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed`'></iframe>
				<a href="https://www.maps.ie/route-planner.htm">Road Trip Planner</a>
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
				        <button type="button" class="btn_green" @click.prevent="rejectOfferbuilding">
					        <span class="mr-1">Отправить</span>
				        	<i class="fas fa-share-square"></i>
					    </button>
				      </div>
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
					// type_of_construction:'',
					station_id:'',
			    	name:'',
			    	company_name:'',
			    	station_id:'', 
			    	longitude:'',
			    	latitude:'', 
			    	inn:'',
			    	address:'', 
			    	region_id:'',
			    	area_id:'',
			    	asos:'', 
			    	offer_hakim:'',
			    	price:'', 
			    	bank_credit:'', 
			    	land_area:'', 
			    	time_of_construction_start:'',
			    	time_of_construction_end:'',
			    	telephon:'',
			    	capacity_passenger:'', 
			    	work_schedule:'', 
			    	ustav_fond:'', 
			    	project_photo:'', 
				},
				comment:'',
				requiredInput:false,
				laoding: true
			}
		},
		computed:{
			...mapGetters('offerbuilding',['getMassage','getOfferbuilding']),
			...mapGetters('station',['getStationsList','getStationsAreaByList']),
			...mapGetters('area',['getAreaLists']),
		},
		watch:{
			'getOfferbuilding':{
				handler(){
					this.form = this.getOfferbuilding
					this.comment = this.getOfferbuilding.comment
				}
			}
		},
		async mounted(){
			await this.actionEditOfferbuilding(this.$route.params.offerbuildingId)
			this.form = this.getOfferbuilding
			await this.actionStationLists()
			await this.actionAreaList()
			this.laoding = false
		},
		methods:{
			...mapActions('offerbuilding',[
				'actionUpdateOfferbuilding',
				'actionEditOfferbuilding',
				'actionAcceptOfferbuilding',
				'actionRejectOfferbuilding',
			]),
			...mapActions('station',[
				'actionStationLists',
				'actionStationByArea',
			]),
			...mapActions('area',['actionAreaList']),
			isRequired(input){
	    		return this.requiredInput && input === '';
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
		    photoImg(img) {
		    	if (img) {
			      if (img.length > 100) {
			        return img;
			      } else {
			        return '/offer/'+img;
			      }
		    	}
		    },
		    async rejectOfferbuilding(){
		    	if(this.comment !=''){
		    		let data = {
		    			id:this.form.id,
		    			comment:this.comment,
		    		}
		    		await this.actionRejectOfferbuilding(data)
		    		if (this.getMassage.success){
		    			toast.fire({
					    	type: 'success',
					    	icon: 'success',
							title: this.getMassage.message,
					    })
					    await this.actionEditOfferbuilding(this.$route.params.offerbuildingId)
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
			async acceptOfferbuilding(){
		  		if(confirm("Вы действительно хотите подтвердить?")){
		    		let data = {
		    			id:this.form.id,
		    		}
		    		await this.actionAcceptOfferbuilding(data)
		    		if (this.getMassage.success) {
		    			toast.fire({
					    	type: 'success',
					    	icon: 'success',
							title: this.getMassage.message,
					    })
					    await this.actionEditOfferbuilding(this.$route.params.offerbuildingId)
					    this.closeModal()
		    		}
				}
		    }
		}
	}
</script>
<style scoped>

</style>
