<template>
	<div class="reconstruction">
		<Loader v-if="laoding"/>
		<div class="card">
		  	<div class="card-header">
			    <h4 class="title_user">
			    	<i  class="peIcon pe-7s-box1"></i>
				    Confirm Reconstruction
				</h4>
		  	</div>
		  	<div class="card-body">
			  <div class="table-responsive">
				<table class="table table-bordered text-center table-hover table-striped">
					<thead>
						<tr>
							<th scope="col">№</th>
							<th scope="col">Туман/Шахар</th>
							<th scope="col">Станция</th>
							<th scope="col">Компании</th>
							<th scope="col">Ф.И.О</th>
							<th scope="col">ИНН</th>
							<th scope="col">Статус</th>
							<th scope="col">Дата начала</th>
							<th scope="col">Дата окончания</th>
							<th scope="col">Сумма</th>
							<th scope="col">Действия</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(reg,index) in getReconstructions.data">
							<td scope="row">{{reg.id}}</td>
							<td>{{reg.offerbuilding.area ? reg.offerbuilding.area.name : ''}}</td>
							<td>{{reg.offerbuilding.station ? reg.offerbuilding.station.name : ''}}</td>
							<td>{{reg.offerbuilding.company_name}}</td>
							<td>{{reg.offerbuilding.name}}</td>
							<td>{{reg.offerbuilding.inn}}</td>
							<td>
								<div class="badge" :class="getStatusClass(reg.status)">
									{{getStatusName(reg.status)}}
								</div>
							</td>
							<td>{{reg.start_date}}</td>
							<td>{{reg.end_date}}</td>
							<td>{{reg.summa}}</td>
							<td>
								<router-link tag="button" class="btn_transparent" :to='`/crm/confirm-reconstruction/edit/${reg.id}`'>
									<i class="pe_icon fas fa-eye editColor"></i>
								</router-link>
							</td>
						</tr>
					</tbody>
					<pagination :limit="4" :data="getReconstructions" @pagination-change-page="getResults"></pagination>
				</table>
			  </div>
		  </div>
	  	</div>
	</div>
</template>
<script>
	import { mapGetters , mapActions } from 'vuex'
	import Loader from '../../../Loader'
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
			let page = 1;
			await this.actionReconstructions(page)
			this.laoding = false
		},
		computed:{
			...mapGetters('reconstruction',['getReconstructions','getMassage'])
		},
		methods:{
			...mapActions('reconstruction',['actionReconstructions','actionDeleteReconstruction']),
			async getResults(page = 1){
				this.laoding = true
				await this.actionReconstructions(page)
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
		}
	}
</script>
<style scoped>

</style>
