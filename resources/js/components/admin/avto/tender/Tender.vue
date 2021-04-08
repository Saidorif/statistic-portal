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
		            		Общее количество направления <b>{{ qtyTotal }} шт.</b>
		            	</span>
			            <button type="button" class="btn btn-info toggleFilter" @click.prevent="toggleFilter">
						    <i class="fas fa-filter"></i>
			            	Филтр
						</button>
		            </div>
	            </div>
	            <transition name="slide">
				  	<div class="filters" v-if="filterShow">
				  		<div class="row">
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
						  	<div class="col-lg-3 form-group filter_btn">
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
                            <th>Регион</th>
                            <th>Количество направления</th>
                            <th>Посмотреть</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(direct,index) in getTenders">
							<td scope="row">{{index + 1}}</td>
							<td>{{direct.region_name}}</td>
							<td>{{direct.count_by_region}}</td>
							<td>
								<button type="button" class="btn_transparent" @click.prevent="showDirectionByregion(direct.id)">
									<i class="pe_icon fas fa-eye"></i>
								</button>
							<!-- 	<router-link tag="button" class="btn_transparent" :to='`/crm/tender/byregion/${direct.id}`'>
								</router-link> -->
							</td>
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
                    // from_date:'',
                    // to_date:'',
				},
				filterShow:false,
			}
		},
		async mounted(){
			await this.actionTenders(this.filter)
			this.laoding = false
		},
		computed:{
			...mapGetters('tender',['getTenders','getMassage']),
			qtyTotal(){
				let count = 0;
				if(this.getTenders.length > 0){
					this.getTenders.forEach((item,index)=>{
						count += Number(item.count_by_region)
					})
				}
				return count
			},
		},
		methods:{
			...mapActions('tender',['actionTenders']),
			showDirectionByregion(id){
				this.$router.push({path:`/crm/tender/byregion/${id}`,query:this.filter})
			},
			toggleFilter(){
				this.filterShow = !this.filterShow
			},
			async search(){
				let page = 1
				if(this.filter.dir_type != '' || this.filter.profitability != '' || this.filter.year != ''){
					this.laoding = true
					await this.actionTenders(this.filter)
					this.laoding = false
				}
			},
			async clear(){
					this.filter.dir_type = ''
					this.filter.year = ''
					this.filter.profitability = ''
					// this.filter.from_date = ''
					// this.filter.to_date = ''
                    let page  = 1
                    this.laoding = true
                    await this.actionTenders(this.filter)
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
