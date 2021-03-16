<template>
	<div class="edit_fakt">
		<Loader v-if="laoding"/>
		<div class="card">
		  	<div class="card-header">
			    <h4 class="title_user">
			    	<i class="peIcon pe-7s-id"></i>
				    Изменить Fakt
				</h4>
				<router-link class="btn_black" :to='`/crm/expec-mod/fakt/${$route.params.faktregionId}?expectId=${$route.query.expectId}`'>
					<span class="peIcon fas fa-arrow-left"></span>
					Назад
				</router-link>
		  	</div>
		  	<div class="card-body">
		  		<form @submit.prevent.enter="saveFakt">
					<div class="row">
					  <div class="form-group col-md-4">
					    <label for="bus_id">Bus</label>
					    <select
					    	class="form-control input_style"
					    	v-model="form.bus_id"
					    	:class="isRequired(form.bus_id) ? 'isRequired' : ''"
				    	>
					    	<option value="" selected disabled>Выберите bus</option>
					    	<option :value="item.id" v-for="(item,index) in getBusmodelList">{{item.name}}</option>
					    </select>
					  </div>
					  <div class="form-group col-md-4">
					    <label for="capacity">Автобус сиғими</label>
					    <input
					    	type="number"
					    	class="form-control input_style"
					    	id="capacity"
					    	placeholder="Автобус сиғими"
					    	v-model="form.capacity"
					    	:class="isRequired(form.capacity) ? 'isRequired' : ''"
				    	>
					  </div>
					  <div class="form-group col-md-4">
					    <label for="bank_credit">Молиялаштириш манбаи</label>
					    <input
					    	type="text"
					    	class="form-control input_style"
					    	id="bank_credit"
					    	placeholder="Молиялаштириш манбаи"
					    	v-model="form.bank_credit"
					    	:class="isRequired(form.bank_credit) ? 'isRequired' : ''"
				    	>
					  </div>
					  <div class="form-group col-md-4">
					    <label for="auto_price">Автобус нарҳи</label>
					    <input
					    	type="number"
					    	class="form-control input_style"
					    	id="auto_price"
					    	placeholder="Автобус нарҳи"
					    	v-model="form.auto_price"
					    	:class="isRequired(form.auto_price) ? 'isRequired' : ''"
				    	>
					  </div>
					  <div class="form-group col-md-4 d-flex flex-column">
			              <label for="purchase_date">Ҳарид қилинган сана</label>
			              <date-picker
			                lang="ru"
			                placeholder="Ҳарид қилинган сана"
			                type="date" format="YYYY-MM-DD" valueType="format"
			                v-model="form.purchase_date"
			                class="datepicker"
			                :class="isRequired(form.purchase_date) ? 'isRequired' : ''"
			              ></date-picker>
		              </div>
					  <div class="form-group col-md-4">
					    <label for="registr_cerf">Давлат рўйҳатидан ўтганлик ҳақида гувохнома рақами</label>
					    <input
					    	type="text"
					    	class="form-control input_style"
					    	id="registr_cerf"
					    	placeholder="Давлат рўйҳатидан ўтганлик ҳақида гувохнома рақами"
					    	v-model="form.registr_cerf"
					    	:class="isRequired(form.registr_cerf) ? 'isRequired' : ''"
				    	>
					  </div>
					  <div class="form-group col-lg-12 d-flex justify-content-end m-0">
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
					expect_id:'',
					bus_id:'',
					capacity:'',
					bank_credit:'',
					auto_price:'',
					purchase_date:'',
					registr_cerf:'',
				},
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
		},
		methods:{
			...mapActions('fakt',['actionUpdateFakt','actionEditFakt']),
			...mapActions('busmodel',['actionBusmodelList']),
			isRequired(input){
	    		return this.requiredInput && input === '';
		    },
			async saveFakt(){
		    	if (this.form.bus_id != '' && this.form.capacity != '' && this.form.bank_credit != '' && this.form.auto_price != '' && this.form.purchase_date != '' && this.form.registr_cerf != ''){
					this.laoding = true
					await this.actionUpdateFakt(this.form)
					if (this.getMassage.success) {
						toast.fire({
					    	type: 'success',
					    	icon: 'success',
							title: this.getMassage.message,
					    })
						this.$router.push(`/crm/expec-mod/fakt/${this.$route.params.faktregionId}?expectId=${this.$route.query.expectId}`);
						this.requiredInput = false
					}else{
						toast.fire({
					    	type: 'error',
					    	icon: 'error',
							title: this.getMassage.message,
					    })
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
	.datepicker{
		width:500px;
	}
</style>
