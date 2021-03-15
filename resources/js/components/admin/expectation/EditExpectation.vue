<template>
	<div class="edit_region">
		<Loader v-if="laoding"/>
		<div class="card">
		  	<div class="card-header">
			    <h4 class="title_user">
			    	<i class="peIcon pe-7s-id"></i>
				    Изменить Expectation
				</h4>
				<router-link class="btn_black" :to='`/crm/regionplan/expectation/${$route.params.expectregionId}`'>
					<span class="peIcon fas fa-arrow-left"></span>
					Назад
				</router-link>
		  	</div>
		  	<div class="card-body">
		  		<form @submit.prevent.enter="saveExpectation" >
					<div class="row">
					  <div class="form-group col-md-4">
					    <label for="company_name">Название компании</label>
					    <input
					    	type="text"
					    	class="form-control input_style"
					    	id="company_name"
					    	placeholder="Название компании"
					    	v-model="form.company_name"
					    	:class="isRequired(form.company_name) ? 'isRequired' : ''"
				    	>
					  </div>
					  <div class="form-group col-md-4">
					    <label for="inn">ИНН</label>
					    <input
					    	type="number"
					    	class="form-control input_style"
					    	id="inn"
					    	placeholder="ИНН"
					    	v-model="form.inn"
					    	:class="isRequired(form.inn) ? 'isRequired' : ''"
				    	>
					  </div>
					  <div class="form-group col-md-4 d-flex flex-column">
			              <label for="date">Дата</label>
			              <date-picker
			                lang="ru"
			                placeholder="Дата"
			                type="date" format="YYYY-MM-DD" valueType="format"
			                v-model="form.date"
			                class="datepicker"
			                :class="isRequired(form.date) ? 'isRequired' : ''"
			              ></date-picker>
		              </div>
		            </div>
	              	<div class="row" v-for="(item,index) in buses">
	              	  <div>
	              	  	<h4>{{index+1}})</h4>
	              	  </div>
					  <div class="form-group col-md-4">
					    <label for="bus_id">Bus</label>
					    <select
					    	class="form-control input_style"
					    	v-model="item.bus_id"
					    	:class="isRequired(item.bus_id) ? 'isRequired' : ''"
				    	>
					    	<option value="" selected disabled>Выберите bus</option>
					    	<option :value="item.id" v-for="(item,index) in getBusmodelList">{{item.name}}</option>
					    </select>
					  </div>
					  <div class="form-group col-md-4">
					    <label for="bus_qty">Количество автобуса</label>
					    <input
					    	type="text"
					    	class="form-control input_style"
					    	id="bus_qty"
					    	placeholder="Количество автобуса"
					    	v-model="item.bus_qty"
					    	:class="isRequired(item.bus_qty) ? 'isRequired' : ''"
				    	>
					  </div>
					  <template v-if="item.id">
						  <div class="form-group col-md-2">
						    <button type="submit" class="btn btn-danger btn_remove_item" @click.prevent="removeItemFromServer(item.id)">
						  		<i class="fas fa-trash"></i>
							</button>
						  </div>
					  </template>
					  <template v-else>
						  <div class="form-group col-md-2" v-if="index != 0">
						    <button type="submit" class="btn btn-danger btn_remove_item" @click.prevent="removeItem(index)">
						  		<i class="fas fa-trash"></i>
							</button>
						  </div>
					  </template>
	              	</div>
	              	<div class="row">
					  <div class="form-group col-lg-12 d-flex justify-content-end align-items-center mt-4">
					  	<button type="submit" class="btn btn-info mr-3" @click.prevent="addItem">
					  		<i class="fas fa-plus"></i>
						  	Добавить
						</button>
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
	import DatePicker from "vue2-datepicker";
	import Loader from '../../Loader'
	export default{
		components:{
			Loader,
			DatePicker,
		},
		data(){
			return{
				form:{
					inn:'',
					plan_id:'',
					company_name:'',
					date:'',
				},
				buses:[
					{
						bus_id:'',
						bus_qty:'',
					},
				],
				requiredInput:false,
				laoding: true
			}
		},
		computed:{
			...mapGetters('expectation',['getMassage','getExpectation']),
			...mapGetters('busmodel',['getBusmodelList']),
			...mapGetters('region',['getRegionList']),
		},
		watch:{
			'getExpectation':{
				handler(){
					this.buses = this.getExpectation.busexpect.length > 0 ? this.getExpectation.busexpect : [{bus_id:'',bus_qty:'',},]
				}
			}
		},
		async mounted(){
			await this.actionEditExpectation(this.$route.params.expectationId)
			await this.actionBusmodelList()
			this.laoding = false
			this.form = this.getExpectation
			this.buses = this.getExpectation.busexpect.length > 0 ? this.getExpectation.busexpect : [{bus_id:'',bus_qty:'',},]
		},
		methods:{
			...mapActions('expectation',['actionUpdateExpectation','actionEditExpectation','actionDeleteExpectation']),
			...mapActions('busmodel',['actionBusmodelList']),
			...mapActions('region',['actionRegionList']),
			addItem(){
		    	this.buses.push({bus_id:'',bus_qty:''})
		    },
		    removeItem(index){
		    	if(confirm("Вы действительно хотите удалить?")){
			    	Vue.delete(this.buses,index)
		    	}
		    },
		    async removeItemFromServer(id){
		    	if(confirm("Вы действительно хотите удалить?")){
		    		await this.actionDeleteExpectation(id)
		    		if (this.getMassage.success) {
						toast.fire({
					    	type: 'success',
					    	icon: 'success',
							title: this.getMassage.message,
					    })
						await this.actionEditExpectation(this.$route.params.expectationId)
					}else{
						toast.fire({
					    	type: 'error',
					    	icon: 'error',
							title: 'Error',
					    })
					}
		    	}
		    },
			isRequired(input){
	    		return this.requiredInput && input === '';
		    },
			async saveExpectation(){
		    	if (this.form.bus_id != '' && this.form.company_name != '' && this.form.inn != '' && this.form.bus_qty != ''){
					this.laoding = true
					this.form['oldbuses'] = this.buses.filter((item,index)=>{
						if(item.id){
							return item
						}
					})
					this.form['buses'] = this.buses.filter((item,index)=>{
						if(!item.id){
							return item
						}
					})
					await this.actionUpdateExpectation(this.form)
					if (this.getMassage.success) {
						toast.fire({
					    	type: 'success',
					    	icon: 'success',
							title: this.getMassage.message,
					    })
						this.$router.push("/crm/regionplan/expectation/"+this.$route.params.expectregionId);
						this.requiredInput = false
					}else{
						toast.fire({
					    	type: 'error',
					    	icon: 'error',
							title: 'Заполните все поля',
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
	.btn_remove_item{
		margin-top:30px;
	}
</style>
