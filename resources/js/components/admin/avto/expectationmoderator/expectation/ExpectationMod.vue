<template>
	<div class="expectation">
		<Loader v-if="laoding"/>
        <div class="exp_header">
            <div class="exp_header_item">
                <span class="circle"><i class="fas fa-globe-asia"></i></span>
                <div class="content_item">
                    <h6>Region</h6>
                    <h3>{{regionName}}</h3>
                </div>
            </div>
            <div class="exp_header_item">
                <span class="circle"><i class="fas fa-chart-line"></i></span>
                <div class="content_item">
                    <h6>Plan</h6>
                    <h3>{{planQty}}</h3>
                </div>
            </div>
            <div class="exp_header_item">
                <span class="circle"><i class="fas fa-chart-area"></i></span>
                <div class="content_item">
                    <h6>Кутилиши</h6>
                    <h3>{{expectationQty}}</h3>
                </div>
            </div>
            <div class="exp_header_item">
                <span class="circle"><i class="fas fa-vote-yea"></i></span>
                <div class="content_item">
                    <h6>Тасдикланганлар</h6>
                    <h3>{{faktQty}}</h3>
                </div>
            </div>
        </div>
		<div class="card">
		  	<div class="card-header d-flex justify-content-between">
			    <h4 class="title_user">
			    	<i  class="peIcon pe-7s-box1"></i>
				    Expectation
				</h4>
				<div class="d-flex justify-content-end">
				    <router-link class="btn_green" :to='`/crm/expec-mod/${$route.params.expId}/add`'>
						<i class="fas fa-plus"></i>
						Добавить
					</router-link>
					<!-- <router-link class="btn_black" to='/crm/regionplan'>
						<span class="peIcon fas fa-arrow-left "></span>
						Назад
					</router-link> -->
				</div>
		  	</div>
		  	<div class="card-body">
			  <div class="table-responsive">
				<table class="table table-bordered text-center table-hover table-striped">
					<thead>
						<tr>
							<th scope="col">№</th>
							<th scope="col">Название компании</th>
							<th scope="col">ИНН</th>
							<th scope="col">Количество автобуса (шт)</th>
							<th scope="col">Кол. подтвержденных автобусов (шт)</th>
							<th scope="col">Кол. неподтвержденных автобусов (шт)</th>
							<th scope="col">Кол. отказанных автобусов (шт)</th>
							<th scope="col">Buses</th>
							<th scope="col">Дата</th>
							<th scope="col">Действия</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(expectation,index) in getExpectations.data">
							<td scope="row">{{expectation.id}}</td>
							<td>
								<router-link tag="a" class="btn-link" :to='`/crm/expec-mod/fakt/${expectation.id}?expectId=${$route.params.expId}`'>
									{{expectation.company_name}}
								</router-link>
							</td>
							<td>
								{{expectation.inn}}
							</td>
							<td>{{countBus(expectation.busexpect)}}</td>
							<td>{{countAcceptedFakt(expectation.accepted_fakt)}}</td>
							<td>{{countWaitingFakt(expectation.waiting_fakt)}}</td>
							<td>{{countRejectedFakt(expectation.rejected_fakt)}}</td>
							<td>
								<ul v-if="expectation.busexpect.length > 0" class="list-inline m-0">
								    <li v-for="(exp,key) in expectation.busexpect">{{exp.bus ? exp.bus.name : ''}}</li>
								</ul>
								<ul v-else class="list-inline">
								    <li>EMPTY</li>
								</ul>
							</td>
							<td>{{expectation.date}}</td>
							<td>
								<router-link tag="button" class="btn_blue mr-1" :to='`/crm/expec-mod/${$route.params.expId}/edit/${expectation.id}`'>
									<i class="pe_icon fas fa-pen editColor"></i>
								</router-link>
								<button class="btn_blue" @click="deleteExpectation(expectation.id)">
									<i class="pe_icon fas fa-trash trashColor"></i>
								</button>
							</td>
						</tr>
					</tbody>
					<pagination :limit="4" :data="getExpectations" @pagination-change-page="getResults"></pagination>
				</table>
			  </div>
		  </div>
	  	</div>
	</div>
</template>
<script>
	import { mapGetters , mapActions } from 'vuex'
	import Loader from '../../../../Loader'
	export default{
		components:{
			Loader
		},
		data(){
			return{
				laoding: true
			}
		},
		async mounted(){
			await this.actionEditRegionPlan(this.$route.params.expId)
			let data = {
				plan_id:this.$route.params.expId,
				page:1
			}
			await this.actionExpectations(data)
			this.laoding = false
		},
		computed:{
			...mapGetters('expectationmod',['getExpectations','getMassage']),
			...mapGetters('regionplan',['getRegionPlan']),
			regionName(){
				if(this.getRegionPlan){
					let name = this.getRegionPlan.region
					if(name){
						return name.name
					}
				}
			},
			planQty(){
				if(this.getRegionPlan){
					let name = this.getRegionPlan
					if(name){
						return name.number
					}
				}
			},
			expectationQty(){
				let count = 0
				if(this.getExpectations.data && this.getExpectations.data.length > 0){
					let items = this.getExpectations.data
					items.forEach((item,index)=>{
						count += this.countBus(item.busexpect)
					})
				}
				return count
			},
			faktQty(){
				let count = 0
				if(this.getExpectations.data && this.getExpectations.data.length > 0){
					let items = this.getExpectations.data
					items.forEach((item,index)=>{
						count += this.countAcceptedFakt(item.accepted_fakt)
					})
				}
				return count
			},
		},
		methods:{
			...mapActions('expectation',['actionExpectations','actionDeleteExpectationAll']),
			...mapActions('regionplan',['actionEditRegionPlan']),
			countBus(items){
				let count = 0
				if(items.length > 0){
					items.forEach((item,index)=>{
						count += Number(item.bus_qty)
					})
				}
				return count
			},
			countAcceptedFakt(items){
				let count = 0
				if(items.length > 0){
					return items.length
				}
				return count
			},
			countWaitingFakt(items){
				let count = 0
				if(items.length > 0){
					return items.length
				}
				return count
			},
			countRejectedFakt(items){
				let count = 0
				if(items.length > 0){
					return items.length
				}
				return count
			},
			async getResults(page = 1){
				this.laoding = true
				let data = {
					plan_id:this.$route.params.expId,
					page:page
				}
				await this.actionExpectations(data)
				this.laoding = false
			},
			async deleteExpectation(id){
				if(confirm("Вы действительно хотите удалить?")){
					let data = {
						plan_id:this.$route.params.expId,
						page:1
					}
					this.laoding = true
					await this.actionDeleteExpectationAll(id)
					await this.actionExpectations(data)
					this.laoding = false
					toast.fire({
				    	type: 'success',
				    	icon: 'success',
						title: 'Expectation удалено!',
				    })
				}
			}
		}
	}
</script>
<style scoped>

</style>
