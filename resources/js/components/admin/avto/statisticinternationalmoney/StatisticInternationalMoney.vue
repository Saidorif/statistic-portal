<template>
	<div class="statistic">
		<Loader v-if="laoding"/>
		<div class="card">
			<div class="card-header header_filter">
		  		<div class="header_title mb-2">
				    <h4 class="title_user">
				    	<i class="peIcon fas fa-box"></i>
					    Международное денежное обращение
					</h4>
	            	<div class="add_user_btn">
			            <button type="button" class="btn btn-info toggleFilter" @click.prevent="toggleFilter">
						    <i class="fas fa-filter"></i>
			            	Филтр
						</button>
						<router-link class="btn btn-primary" to="/crm/statisticinternationalmoney/add">
							<i class="fas fa-plus"></i>
							Добавить
						</router-link>
		            </div>
	            </div>
	            <transition name="slide">
				  	<div class="filters" v-if="filterShow">
				  		<div class="row">
  							<div class="form-group col-lg-6 year_range">
				  				<label for="year">Сортировать по году</label>
                                <date-picker
								    v-model="month"
								    type="month"
	                                range
	                                :editable="false"
								    format="MMMM-YYYY"
	                                default-panel="year"
								    valueType="format"
	                                @open="dateOpen()"
	                                @clear="clear"
						    	></date-picker>
              				</div>
						  	<div class="col-lg-6 form-group filter_btn">
							  	<button type="button" class="btn btn-primary ml-2" @click.prevent="search">
							  		<i class="fas fa-search"></i>
								  	найти
							  	</button>
							  	<button type="button" class="btn btn-warning ml-2" @click.prevent="clear">
							  		<i class="fas fa-search"></i>
								  	очистить
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
								<template v-for="(item,index) in $g.filterMonthTitles(allmonths)">
									<th scope="col">{{item.name}}</th>
								</template>
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
								<td v-if="reg.yanvar != undefined">{{reg.yanvar}}</td>
								<td v-if="reg.fevral != undefined">{{reg.fevral}}</td>
								<td v-if="reg.mart != undefined">{{reg.mart}}</td>
								<td v-if="reg.aprel != undefined">{{reg.aprel}}</td>
								<td v-if="reg.may != undefined">{{reg.may}}</td>
								<td v-if="reg.iyun != undefined">{{reg.iyun}}</td>
								<td v-if="reg.iyul != undefined">{{reg.iyul}}</td>
								<td v-if="reg.avgust != undefined">{{reg.avgust}}</td>
								<td v-if="reg.sentabr != undefined">{{reg.sentabr}}</td>
								<td v-if="reg.oktabr != undefined">{{reg.oktabr}}</td>
								<td v-if="reg.noyabr != undefined">{{reg.noyabr}}</td>
								<td v-if="reg.dekabr != undefined">{{reg.dekabr}}</td>
								<td>
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
	import Loader from '../../../Loader'
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
				filter:{year:'',months:[]},
				month:'',
				allmonths:[],
			}
		},
		async mounted(){
			await this.actionMainStatisticInternationalMoneys(this.filter)
			this.filter.year = this.getMainStatisticInternationalMoneys.getYear
			this.items = this.getMainStatisticInternationalMoneys.items
			this.laoding = false
		},
		computed:{
			...mapGetters('statisticinternationalmoney',['getMainStatisticInternationalMoneys','getMassage']),
		},
		methods:{
			...mapActions('statisticinternationalmoney',['actionMainStatisticInternationalMoneys','actionDeleteStatisticInternationalMoney']),
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
			removedateOpen(){
				console.log('no')
			},
            dateOpen(){
                setTimeout(()=>{
                    $('.mx-datepicker-main').addClass('myCustomCalendar')
                },10)

            },
			toggleFilter(){
				this.filterShow = !this.filterShow
			},
			async search(){
				let dates = this.month
				this.allmonths = []
				if(dates.length == 2){
					let year = dates[0].substr(-4,dates[0].indexOf('-'));
					let data1 = dates[0].substr(0,dates[0].indexOf('-'));
					let data2 = dates[1].substr(0,dates[1].indexOf('-'));

					this.$g.allMonths().forEach((item,index)=>{
						if(item.id >= this.$g.findIdOfMonth(data1) && item.id <= this.$g.findIdOfMonth(data2)){
							this.allmonths.push(item.key)
						}
					})
					this.filter.year = year
					this.filter.months = this.allmonths
					this.laoding = true
					await this.actionMainStatisticInternationalMoneys(this.filter)
					this.items = this.getMainStatisticInternationalMoneys.items
					this.laoding = false
				}
			},
			async clear(){
				this.filter = {year:'',months:[]}
				this.month = ''
				this.allmonths = []
                this.laoding = true
                await this.actionMainStatisticInternationalMoneys(this.filter)
                this.items = this.getMainStatisticInternationalMoneys.items
                this.laoding = false

			},
			async deleteStatistic(id){
				if(confirm("Вы действительно хотите удалить?")){
					this.laoding = true
					await this.actionDeleteStatisticInternationalMoney(id)
					await this.actionMainStatisticInternationalMoneys(this.filter)
					this.items = this.getMainStatisticInternationalMoneys.items
					this.laoding = false
					toast.fire({
				    	type: 'success',
				    	icon: 'success',
						title: 'Statistic удалено!',
				    })
				}
			},
		}
	}
</script>
<style scoped>
	.filter_btn{
		margin-top:30px;
	}

</style>
