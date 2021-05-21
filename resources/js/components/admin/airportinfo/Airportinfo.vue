<template>
	<div class="region">
		<Loader v-if="laoding"/>
		<div class="card">
		  	<div class="card-header">
			    <h4 class="title_user">
			    	<i class="sidebar_icon fas fa-plane"></i>
				    Аэропорт 
				</h4>
				<router-link class="btn btn-primary" to="/crm/airportinfo/add">
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
							<th scope="col">Аэропорт номи</th>
							<th scope="col">Очилиш йили</th>
							<th scope="col">Манзили</th>
							<th scope="col">Учиш режими</th>
							<th scope="col">Ҳаво эркинлиги</th>
							<th scope="col">Действия</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(airport,index) in getAirports.data">
							<td scope="row">{{airport.id}}</td>
							<td>{{airport.name}}</td>
							<td>{{airport.year}}</td>
							<td>{{airport.address}}</td>
							<td>{{$g.findFlightMode(airport.flight_mode)}}</td>
							<td>{{$g.findFreedomAir(airport.freedom_air)}}</td>
							<td>
								<router-link tag="button" class="btn_transparent" :to='`/crm/airportinfo/edit/${airport.id}`'>
									<i class="pe_icon pe-7s-edit editColor"></i>
								</router-link>
								<button class="btn_transparent" @click="deleteAirport(airport.id)">
									<i class="pe_icon pe-7s-trash trashColor"></i>
								</button>
							</td>
						</tr>
					</tbody>
					<pagination :limit="4" :data="getAirports" @pagination-change-page="getResults"></pagination>
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
			await this.actionAirports(page)
			this.laoding = false
		},
		computed:{
			...mapGetters('airportinfo',['getAirports','getMassage'])
		},
		methods:{
			...mapActions('airportinfo',['actionAirports','actionDeleteAirport']),
			async getResults(page = 1){ 
				this.laoding = true
				await this.actionAirports(page)
				this.laoding = false
			},
			async deleteAirport(id){
				if(confirm("Вы действительно хотите удалить?")){
					let page = 1
					this.laoding = true
					await this.actionDeleteAirport(id)
					if(this.getMassage.success){
						await this.actionAirports(page)
						toast.fire({
					    	type: 'success',
					    	icon: 'success',
							title: this.getMassage.message,
					    })
					}
					this.laoding = false
				}
			}
		}
	}
</script>
<style scoped>
	
</style>