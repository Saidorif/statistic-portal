<template>
	<div class="region">
		<Loader v-if="laoding"/>
		<div class="card">
		  	<div class="card-header header_filter">
		  		<div class="header_title mb-2">
				    <h4 class="title_user">
				    	<i class="peIcon fas fa-route"></i>
					    Направления маршрутов
					</h4>
	            	<div class="add_user_btn">
		                <span class="alert alert-info" style="    margin: 0px 15px 0px auto;">
		            		Количество направления <b>{{ getTenderByRegions.total }} шт.</b>
		            	</span>
			            <button type="button" class="btn btn-info toggleFilter" @click.prevent="toggleFilter">
						    <i class="fas fa-filter"></i>
			            	Филтр
						</button>
						<router-link class="btn btn-info" to='/crm/tender'>
				            <span class="peIcon fas fa-arrow-left"></span> Назад
			          	</router-link>
		            </div>
	            </div>
	            <transition name="slide">
				  	<div class="filters" v-if="filterShow">
				  		<div class="row">
				  			<div class="form-group col-lg-3">
				  				<label for="bypass_number">Номер направления</label>
                                  <input class="form-control input_style" placeholder="Поиск по номеру" type="text" v-model="filter.pass_number" id="bypass_number">
              				</div>
				  			<div class="form-group col-lg-3">
				  				<label for="status">По статусу закрепления!</label>
			                    <select
			                      id="status"
			                      class="form-control input_style"
			                      v-model="filter.status"
			                    >
			                      <option value="" selected >Выберите статус закрепления!</option>
			                    </select>
              				</div>
				  			<div class="form-group col-lg-3">
				  				<label for="status">По статусу размещения!</label>
			                    <select
			                      id="status"
			                      class="form-control input_style"
			                      v-model="filter.status"
			                    >
			                      <option value="" selected >Выберите статус размещения!</option>
			                    </select>
              				</div>
				  			<div class="form-group col-lg-3">
				  				<label for="profitability">Сортировать по рентабельности!</label>
			                    <select
			                      id="profitability"
			                      class="form-control input_style"
			                      v-model="filter.profitability"
			                    >
			                      <option value="" selected >Выберите рентабельность!</option>
			                      <option value="profitable">Рентабельный</option>
					              <option value="unprofitable">Нерентабельный</option>
					              <option value="middle">Средный</option>
			                    </select>
              				</div>
				  			<div class="form-group col-lg-3">
				  				<label for="dir_type">Сортировать по типу маршрута!</label>
			                    <select
			                      id="dir_type"
			                      class="form-control input_style"
			                      v-model="filter.dir_type"
			                    >
			                      <option value="" selected >Выберите тип маршрута!</option>
			                      <option value="bus">Автобус йуналиши</option>
                      			  <option value="taxi">Йўналиши тахи йуналиши</option>
			                    </select>
              				</div>
  							<div class="form-group col-lg-3">
				  				<label for="year">Сортировать по году</label>
				  				<date-picker
					                lang="ru"
					                type="year" format="YYYY" valueType="format"
					                v-model="filter.year"
					                placeholder="Выберите дату!"
					                class="input_style form-date"
				              	></date-picker>
              				</div>
				<!--   			<div class="form-group col-lg-3">
				  				<label for="from_date">Сортировать по дате <em>c</em></label>
				  				<date-picker
					                lang="ru"
					                type="date" format="YYYY-MM-DD" valueType="format"
					                v-model="filter.from_date"
					                placeholder="Выберите дату!"
					                class="input_style"
				              	></date-picker>
              				</div>
				  			<div class="form-group col-lg-3">
				  				<label for="to_date">Сортировать по дате <em>по</em></label>
				  				<date-picker
					                lang="ru"
					                type="date" format="YYYY-MM-DD" valueType="format"
					                v-model="filter.to_date"
					                placeholder="Выберите дату!"
					                class="input_style"
				              	></date-picker>
              				</div> -->
						  	<div class="col-lg-6 form-group filter_btn">
							  	<button type="button" class="btn btn-warning clear" @click.prevent="clear">
							  		<i class="fas fa-times"></i>
								  	сброс
							  	</button>
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
                            <th width="10%">Регион</th>
                            <th>Номер и наименования маршрута</th>
                            <th>Наименования организации </th>
                            <th>Срок действитвия контракта </th>
                            <th width="13%">Статус</th>
                            <th>Йўналиши тури</th>
                            <th>Дата открытия</th>
                            <th>Потверждения</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(direct,index) in getTenderByRegions.data">
							<td scope="row">{{index + 1}}</td>
							<td>
								<template v-if="direct.created_by">
									{{direct.created_by.region ? direct.created_by.region.name : ''}}
								</template>
							</td>
							<td><b>{{direct.pass_number}}</b> - {{direct.name}}</td>
							<td></td>
							<td></td>
							<td>
                                <span class="alert alert-danger pt-1 pb-1" v-if="direct.status == 'active'"> Неразмещен в тендер</span>
                                <span class="alert alert-success pt-1 pb-1" v-if="direct.status == 'busy'"> Размещен в тендер</span>
                            </td>
							<td>{{direct.dir_type == 'taxi' ? 'Йўналишли тахи йуналиши' : 'Автобус йуналиши'}}</td>
							<td>{{direct.year}}</td>
							<td>{{ checkApprove(direct) }}</td>
						</tr>
					</tbody>
					<pagination :limit="4" :data="getTenderByRegions" @pagination-change-page="getResults"></pagination>
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
	import { TokenService } from "../../../../services/storage.service";
	export default{
		components:{
			Loader,
			DatePicker,
		},
		data(){
			return{
				laoding: true,
				filter:{
					dir_type:'',
					profitability:'',
                    year:'',
                    from_date:'',
                    to_date:'',
                    pass_number: '',
				},
				filterShow:false,
			}
		},
		async mounted(){
			this.filter['region_id'] = this.$route.params.tenderId
			this.filter.dir_type = this.$route.query.dir_type
			this.filter.profitability = this.$route.query.profitability
			this.filter.year = this.$route.query.year
			let data = {
				page : 1,
				items:this.filter,
			}
			await this.actionTenderByRegions(data)
			this.laoding = false
		},
		computed:{
			...mapGetters('tender',['getTenderByRegions','getMassage'])
		},
		methods:{
			...mapActions('tender',['actionTenderByRegions']),
			toggleFilter(){
				this.filterShow = !this.filterShow
			},
			async search(){
				let page = 1
				if(this.filter.pass_number != '' || this.filter.dir_type != '' || this.filter.from_date != '' || this.filter.profitability != '' || this.filter.to_date != '' || this.filter.year != ''){
					let data = {
						page:page,
						items:this.filter
                    }
					this.laoding = true
					await this.actionTenderByRegions(data)
					this.laoding = false
				}
			},
			async clear(){

					this.filter.dir_type = ''
					this.filter.from_date = ''
					this.filter.to_date = ''
					this.filter.year = ''
					this.filter.profitability = ''
					this.filter.pass_number = ''
                    let page  = 1
                    this.laoding = true
                    await this.actionTenderByRegions({page: page,items:this.filter})
                    this.laoding = false

			},
			async getResults(page = 1){
				let data = {
					page : page,
					items:this.filter
				}
				this.laoding = true
				await this.actionTenderByRegions(data)
				this.laoding = false
			},
			checkApprove(item){
                if(
                    item.xronom_status == 'completed' &&
                    item.xjadval_status == 'completed' &&
                    item.titul_status == 'completed' &&
                    item.sxema_status == 'completed'
                ){
                    return 'да'
                }else{
                    return 'нет'
                }
            }
		}
	}
</script>
<style scoped>
	.filter_btn{
		display: flex;
	    justify-content: flex-end;
	    margin-top: 29px;
	}
</style>
