<template>
	<!-- 'company_name','bus_qty','bus_id','date','region_id' -->
	<div class="add_expectation">
		<Loader v-if="laoding"/>
		<div class="card">
		  	<div class="card-header">
			    <h4 class="title_user">
			    	<i class="peIcon pe-7s-id"></i>
				    Добавить Expectation
				</h4>
				<router-link class="btn btn-primary back_btn" :to='`/crm/regionplan/expectation/${$route.params.expectregionId}`'>
					<span class="peIcon pe-7s-back"></span> 
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
					  <div class="form-group col-md-2" v-if="index != 0">
					    <button type="submit" class="btn btn-danger btn_remove_item" @click.prevent="removeItem(index)">
					  		<i class="fas fa-trash"></i>
						</button>
					  </div>
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
			...mapGetters('expectation',['getMassage']),
			...mapGetters('busmodel',['getBusmodelList']),
			...mapGetters('region',['getRegionList']),
		},
		async mounted(){
			await this.actionBusmodelList()
			// await this.actionRegionList()
			this.laoding = false
		},
		methods:{
			...mapActions('expectation',['actionAddExpectation']),
			...mapActions('busmodel',['actionBusmodelList']),
			...mapActions('region',['actionRegionList']),
			isRequired(input){
	    		return this.requiredInput && input === '';
		    },
		    addItem(){
		    	this.buses.push({bus_id:'',bus_qty:''})
		    },
		    removeItem(index){
		    	if(confirm("Вы действительно хотите удалить?")){
			    	Vue.delete(this.buses,index)
		    	}
		    },
			async saveExpectation(){
		    	if (this.form.bus_id != '' && this.form.company_name != '' && this.form.inn != '' && this.form.bus_qty != ''){
					this.laoding = true
					this.form.plan_id = Number(this.$route.params.expectregionId);
					this.form['buses'] = this.buses;
					await this.actionAddExpectation(this.form)
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