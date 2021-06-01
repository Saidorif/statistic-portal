<template>
	<div class="add_airportexpect">
		<Loader v-if="laoding"/>
		<div class="card">
		  	<div class="card-header">
			    <h4 class="title_user">
			    	<i class="sidebar_icon fas fa-plane"></i>
				    Добавить План аэропорта 
				</h4>
				<router-link class="btn_black" :to='`/crm/airportinfo/${$route.params.airportinfoId}/airportexpect`'>
					<span class="peIcon fas fa-arrow-left"></span> 
					Назад
				</router-link>
		  	</div>
		  	<div class="card-body">
		  		<form @submit.prevent.enter="saveAirportExpect" >
					<div class="row">
					  	<div class="form-group col-md-4">
						    <label for="type">Кутилиш даври</label>
						    <date-picker
				                lang="ru"
				                placeholder="Кутилиш даври"
				                type="date" format="YYYY-MM-DD" valueType="format"
				                v-model="form.expect_date"
				                :class="isRequired(form.expect_date) ? 'isRequired' : ''"
			              	></date-picker>
					  	</div>
					  	<div class="form-group col-md-4">
						    <label for="type">Рейслар йўналиши</label>
						    <select 
						    	class="form-control input_style"
						    	id="type"
						    	placeholder="Аэропорт номи"
						    	v-model="form.type"
						    	:class="isRequired(form.type) ? 'isRequired' : ''"
						    >
						    	<option value="" selected diabled>Рейс йўналишини танланг!</option>
						    	<option :value="item.key" v-for="(item,index) in $g.getTypeAirports()">{{item.value}}</option>
						    </select>
					  	</div>
					  	<div class="form-group col-md-4">
						    <label for="reys_qty">Рейслар сони (кутилиши)</label>
						    <input
						    	type="text"
						    	class="form-control input_style"
						    	id="reys_qty"
						    	placeholder="Рейслар сони (кутилиши)"
						    	v-model="form.reys_qty"
						    	:class="isRequired(form.reys_qty) ? 'isRequired' : ''"
					    	>
					  	</div>
					  	<div class="form-group col-md-3">
						    <label for="seats_qty">Рейслардаги ўриндиқлар сони (кутилиши)</label>
						    <input
						    	type="text"
						    	class="form-control input_style"
						    	id="seats_qty"
						    	placeholder="Рейслардаги ўриндиқлар сони (кутилиши)"
						    	v-model="form.seats_qty"
						    	:class="isRequired(form.seats_qty) ? 'isRequired' : ''"
					    	>
					  	</div>
					  	<div class="form-group col-md-3">
						    <label for="passengers_qty">Йўловчилар сони (Кутилиши)</label>
						    <input
						    	type="text"
						    	class="form-control input_style"
						    	id="passengers_qty"
						    	placeholder="Йўловчилар сони (Кутилиши)"
						    	v-model="form.passengers_qty"
						    	:class="isRequired(form.passengers_qty) ? 'isRequired' : ''"
					    	>
					  	</div>
					  	<div class="form-group col-md-3">
						    <label for="load_capacity">Юк ҳажми (Кутилиши)</label>
						    <input
						    	type="text"
						    	class="form-control input_style"
						    	id="load_capacity"
						    	placeholder="Юк ҳажми (Кутилиши)"
						    	v-model="form.load_capacity"
						    	:class="isRequired(form.load_capacity) ? 'isRequired' : ''"
					    	>
					  	</div>
					  	<div class="form-group col-lg-3 d-flex justify-content-end align-items-center">
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
	import DatePicker from "vue2-datepicker";
	export default{
		components:{
			Loader,
			DatePicker,
		},
		data(){
			return{
				form:{
					airport_id:this.$route.params.airportinfoId,
					expect_date:'',
					type:'',
					reys_qty:'',
					seats_qty:'',
					passengers_qty:'',
					load_capacity:'',
				},
				requiredInput:false,
				laoding: true
			}
		},
		computed:{
			...mapGetters('airportexpect',['getMassage'])
		},
		mounted(){
			this.laoding = false
		},
		methods:{
			...mapActions('airportexpect',['actionAddAirportexpect']),
			isRequired(input){
	    		return this.requiredInput && input === '';
		    },
			async saveAirportExpect(){
		    	if (this.form.expect_date != '' && this.form.type != '' && this.form.reys_qty != '' && this.form.seats_qty != '' && this.form.passengers_qty != '' && this.form.load_capacity != ''){
					this.laoding = true
					await this.actionAddAirportexpect(this.form)
					if (this.getMassage.success) {
						toast.fire({
					    	type: 'success',
					    	icon: 'success',
							title: this.getMassage.message,
					    })
						this.$router.push(`/crm/airportinfo/${this.$route.params.airportinfoId}/airportexpect`);
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
