<template>
	<div class="fakt">
		<Loader v-if="laoding"/>
		<div class="card">
		  	<div class="card-header">
			    <h4 class="title_user">
			    	<i class="peIcon pe-7s-box1"></i>
				    Fakt
				</h4>
				<router-link class="btn btn-primary" :to='`/crm/regionplan/fakt/${$route.params.faktregionId}/add?expectId=${$route.query.expectId}`'>
					<i class="fas fa-plus"></i>
					Добавить
				</router-link>
				<router-link class="btn_black" :to='`/crm/regionplan/expectation/${$route.query.expectId}`'>
					<span class="peIcon fas fa-arrow-left "></span>
					Назад
				</router-link>
		  	</div>
		  	<div class="card-body">
			  <div class="table-responsive">
				<table class="table table-bordered text-center table-hover table-striped">
					<thead>
						<tr>
							<th scope="col">№</th>
							<th scope="col">Название</th>
							<th scope="col">Bus</th>
							<th scope="col">Статус</th>
							<th scope="col">Автобус сиғими</th>
							<th scope="col">Молиялаштириш манбаи</th>
							<th scope="col">Автобус нарҳи</th>
							<th scope="col">Ҳарид қилинган сана</th>
							<th scope="col">Давлат рўйҳатидан ўтганлик ҳақида гувохнома рақами</th>
							<th scope="col">Действия</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(reg,index) in getFakts.data">
							<td scope="row">{{reg.id}}</td>
							<td>{{reg.expectation.company_name}}</td>
							<td>{{reg.bus.name}}</td>
							<td>
								<div class="badge" :class="getStatusClass(reg.status)">
									{{getStatusName(reg.status)}}
								</div>
							</td>
							<td>{{reg.capacity}}</td>
							<td>{{reg.bank_credit}}</td>
							<td>{{reg.auto_price}}</td>
							<td>{{reg.purchase_date}}</td>
							<td>{{reg.registr_cerf}}</td>
							<td>
								<router-link tag="button" class="btn_transparent" :to='`/crm/regionplan/fakt/${$route.params.faktregionId}/edit/${reg.id}?expectId=${$route.query.expectId}`'>
									<i class="pe_icon pe-7s-edit editColor"></i>
								</router-link>
								<router-link tag="button" class="btn_transparent" :to='`/crm/regionplan/fakt/${$route.params.faktregionId}/show/${reg.id}?expectId=${$route.query.expectId}`'>
									<i class="pe_icon fas fa-eye editColor"></i>
								</router-link>
								<button class="btn_transparent" @click="deleteFakt(reg.id)">
									<i class="pe_icon pe-7s-trash trashColor"></i>
								</button>
							</td>
						</tr>
					</tbody>
					<pagination :limit="4" :data="getFakts" @pagination-change-page="getResults"></pagination>
				</table>
			  </div>
		  </div>
	  	</div>
	</div>
</template>
<script>
	import { mapGetters , mapActions } from 'vuex'
	import Loader from '../../Loader'
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
			let data = {
				expect_id:this.$route.params.faktregionId,
				page:1,
			}
			await this.actionFakts(data)
			this.laoding = false
		},
		computed:{
			...mapGetters('fakt',['getFakts','getMassage'])
		},
		methods:{
			...mapActions('fakt',['actionFakts','actionDeleteFakt']),
			async getResults(page = 1){
				this.laoding = true
					let data = {
					expect_id:this.$route.params.faktregionId,
					page:page,
				}
				await this.actionFakts(data)
				this.laoding = false
			},
			getStatusName(status){
				if(status == 'waiting'){
					return "Тасдикланмаган"
				}else if(status == 'rejected'){
					return "Рад этилган"
				}else if(status == 'accepted'){
					return "Тасдикланган"
				}
			},
			getStatusClass(status){
				if(status == 'waiting'){
					return "badge-warning"
				}else if(status == 'rejected'){
					return "badge-danger"
				}else if(status == 'accepted'){
					return "badge-primary"
				}
			},
			async deleteFakt(id){
				if(confirm("Вы действительно хотите удалить?")){
					this.laoding = true
					await this.actionDeleteFakt(id)
					this.laoding = true
					let data = {
						expect_id:this.$route.params.faktregionId,
						page:1,
					}
					await this.actionFakts(data)
					this.laoding = false
					toast.fire({
				    	type: 'success',
				    	icon: 'success',
						title: 'Region удалено!',
				    })
				}
			}
		}
	}
</script>
<style scoped>

</style>
