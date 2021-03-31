<template>
	<div class="statistic">
		<Loader v-if="laoding"/>
		<div class="card">
			<div class="card-header header_filter">
		  		<div class="header_title mb-2">
				    <h4 class="title_user">
				    	<i class="peIcon fas fa-box"></i>
					    Международные автомобильные перевозки
					</h4>
	            	<div class="add_user_btn">
			            <button type="button" class="btn btn-info toggleFilter" @click.prevent="toggleFilter">
						    <i class="fas fa-filter"></i>
			            	Филтр
						</button>
						<router-link class="btn btn-primary" to="/crm/statisticinternationalcargo/add">
							<i class="fas fa-plus"></i> 
							Добавить
						</router-link>
		            </div>
	            </div>
	            <transition name="slide">
				  	<div class="filters" v-if="filterShow">
				  		<div class="row">
  							<div class="form-group col-lg-6">
				  				<label for="year">Сортировать по году</label>
				  				<date-picker
					                lang="ru"
					                type="year" format="YYYY" valueType="format"
					                v-model="filter.year"
					                placeholder="Выберите дату!"
					                class="input_style form-date"
				              	></date-picker>

				              	<date-picker
							    v-model="filter.month"
							    range
							    type="month"
							    format="MMMM"
							    valueType="format"
							    :not-before="disabledBefore"
							    :not-after="disabledAfter"></date-picker>
              				</div>
						  	<div class="col-lg-6 form-group filter_btn">
							  	<button type="button" class="btn btn-primary ml-2" @click.prevent="search">
							  		<i class="fas fa-search"></i>
								  	найти
							  	</button>
					  	  	</div>
				  		</div>
				  	</div>
			  	</transition>
		  	</div>
		  	<div class="card-body">
			  	<div class="table-responsive">
					<table class="table table-bordered text-center table-hover table-striped">
						<thead>
							<tr>
								<th scope="col">№</th>
								<th scope="col">Фаолият тури</th>
								<th scope="col">Ўлчов бирлиги</th>
								<th scope="col">Год</th>
								<th scope="col">Йиллик</th>
								<th scope="col">Ўтган йилги мос даврга нисбатан, %</th>
								<th scope="col">Январь</th>
								<th scope="col">Февраль</th>
								<th scope="col">Март</th>
								<th scope="col">Апрель</th>
								<th scope="col">Май</th>
								<th scope="col">Июнь</th>
								<th scope="col">Июль</th>
								<th scope="col">Августь</th>
								<th scope="col">Сентябрь</th>
								<th scope="col">Октябрь</th>
								<th scope="col">Ноябрь</th>
								<th scope="col">Декабрь</th>
								<th scope="col">Действия</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(reg,index) in items" v-if="items.length > 0">
								<td scope="row">{{index+1}}</td>
								<td>{{$g.findTypeOfInternationalCargo(reg.type)}}</td>
								<td>минг тонна</td>
								<td>{{$g.getYear(reg.year)}}</td>
								<td>{{reg.total}}</td>
								<td>{{calPercentage(reg)}}</td>
								<td>{{reg.yanvar}}</td>
								<td>{{reg.fevral}}</td>
								<td>{{reg.mart}}</td>
								<td>{{reg.aprel}}</td>
								<td>{{reg.may}}</td>
								<td>{{reg.iyun}}</td>
								<td>{{reg.iyul}}</td>
								<td>{{reg.avgust}}</td>
								<td>{{reg.sentabr}}</td>
								<td>{{reg.oktabr}}</td>
								<td>{{reg.noyabr}}</td>
								<td>{{reg.dekabr}}</td>
								<td>
									<!-- ?year=${$g.getYear(reg.year)} -->
									<template v-if="reg.id">
										<router-link tag="button" class="btn_transparent" :to='`/crm/statisticinternationalcargo/edit/${reg.id}`'>
											<i class="pe_icon pe-7s-edit editColor"></i>
										</router-link>
										<button class="btn_transparent" @click="deleteStatistic(reg.id)">
											<i class="pe_icon pe-7s-trash trashColor"></i>
										</button>
									</template>
								</td>
							</tr>
							<tr v-if="items.length == 0">
								<td colspan="19">Таблица пустая!</td>
							</tr>
						</tbody>
					</table>
			  	</div>
		  </div>
	  	</div>
	</div>
</template>
<script>
	import { mapGetters , mapActions } from 'vuex'
	import Loader from '../../Loader'
	import DatePicker from "vue2-datepicker";
	import 'vue2-datepicker/locale/ru';
	export default{
		components:{
			Loader,
			DatePicker,
		},
		data(){
			return{
				laoding: true,
				items:[],
				filterShow:false,
				filter:{year:'',month:''}
			}
		},
		async mounted(){
			await this.actionMainStatisticInternationalCargos(this.filter)
			this.filter.year = this.getMainStatisticInternationalCargos.getYear
			this.items = this.getMainStatisticInternationalCargos.items
			this.laoding = false
		},
		computed:{
			...mapGetters('statisticinternationalcargo',['getMainStatisticInternationalCargos','getMassage']),
			disabledBefore(){return new Date(2021, 10, 2)},
			disabledAfter(){return new Date(2021, 10, 6)},
		},
		methods:{
			...mapActions('statisticinternationalcargo',['actionMainStatisticInternationalCargos','actionDeleteStatisticInternationalCargo']),
			calPercentage(item){
				if(item.id){
					return item.total_percentage ? item.total_percentage + ' %' : '0 %'
				}else{
					let count = 0;
					if(item.last_total){
						count = Math.round((item.total/item.last_total)*100)
					}
					return count + ' %'
				}
			},
			toggleFilter(){
				this.filterShow = !this.filterShow
			},
			async search(){
				let page = 1
				if(this.filter.year != ''){
					this.laoding = true
					await this.actionMainStatisticInternationalCargos(this.filter)
					this.items = this.getMainStatisticInternationalCargos.items
					this.laoding = false
				}
			},
			async clear(){
				let currentYear = new Date().getFullYear()
				this.filter.year = ''
                let page  = 1
                this.laoding = true
                await this.actionMainStatisticInternationalCargos(this.filter)
                this.items = this.getMainStatisticInternationalCargos.items
                this.laoding = false

			},
			async deleteStatistic(id){
				if(confirm("Вы действительно хотите удалить?")){
					this.laoding = true
					await this.actionDeleteStatisticInternationalCargo(id)
					await this.actionMainStatisticInternationalCargos(this.filter)
					this.items = this.getMainStatisticInternationalCargos.items
					this.laoding = false
					toast.fire({
				    	type: 'success',
				    	icon: 'success',
						title: 'Statistic удалено!',
				    })
				}
			}
		}
	}
</script>
<style scoped>
	.filter_btn{
		margin-top:30px;
	}
</style>