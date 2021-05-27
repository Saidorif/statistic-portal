<template>
	<div class="airportname">
		<Loader v-if="laoding"/>
		<div class="card">
		  	<div class="card-header">
			    <h4 class="title_user">
			    	<i class="sidebar_icon fas fa-plane"></i>
				    Название аэропорта 
				</h4>
				<router-link class="btn btn-primary" to="/crm/airportname/add">
						<i class="fas fa-plus"></i> 
					Добавить
				</router-link>
		  	</div>
		  	<div class="card-body">
			  <div class="table-responsive">
				<table class="table table-bordered text-center table-hover table-striped">
					<thead>
						<tr>
							<th scope="col">№</th>
							<th scope="col">Название</th>
							<th scope="col">Действия</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(reg,index) in getAirportnames.data">
							<td scope="row">{{reg.id}}</td>
							<td>{{reg.name}}</td>
							<td>
								<router-link tag="button" class="btn_transparent" :to='`/crm/airportname/edit/${reg.id}`'>
									<i class="pe_icon pe-7s-edit editColor"></i>
								</router-link>
								<button class="btn_transparent" @click="deleteAirportname(reg.id)">
									<i class="pe_icon pe-7s-trash trashColor"></i>
								</button>
							</td>
						</tr>
					</tbody>
					<pagination :limit="4" :data="getAirportnames" @pagination-change-page="getResults"></pagination>
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
			let page = 1;
			await this.actionAirportnames(page)
			this.laoding = false
		},
		computed:{
			...mapGetters('airportname',['getAirportnames','getMassage'])
		},
		methods:{
			...mapActions('airportname',['actionAirportnames','actionDeleteAirportname']),
			async getResults(page = 1){ 
				this.laoding = true
				await this.actionAirportnames(page)
				this.laoding = false
			},
			async deleteAirportname(id){
				if(confirm("Вы действительно хотите удалить?")){
					let page = 1
					this.laoding = true
					await this.actionDeleteAirportname(id)
					await this.actionAirportnames(page)
					this.laoding = false
					toast.fire({
				    	type: 'success',
				    	icon: 'success',
						title: 'Airportname удалено!',
				    })
				}
			}
		}
	}
</script>
<style scoped>
	
</style>