<template>
	<div class="airwaysinfo">
		<Loader v-if="laoding"/>
		<div class="card">
		  	<div class="card-header">
			    <h4 class="title_user">
			    	<i class="sidebar_icon fas fa-plane"></i>
				    Информации авиакомпании 
				</h4>
				<router-link class="btn btn-primary" to="/crm/airwaysinfo/add">
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
							<th scope="col">Компания номи</th>
							<th scope="col">Очилиш йили</th>
							<th scope="col">Флот ҳажми (кемаларнинг сони)</th>
							<th scope="col">Етиб бориш манзиллар сони</th>
							<th scope="col">Чақирув номи (позывной)</th>
							<th scope="col">Манзили</th>
							<th scope="col">Действия</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(airport,index) in getAirwayss.data">
							<td scope="row">{{airport.id}}</td>
							<td>
								<router-link tag="a" class="btn_transparent" :to='`/crm/airwaysinfo/${airport.id}/airportexpect`'>
									{{airport.airways_company ? airport.airways_company.name : ''}}
								</router-link>
							</td>
							<td>{{airport.year}}</td>
							<td>{{airport.fleet_size}}</td>
							<td>{{airport.destination_qty}}</td>
							<td>{{airport.call_name}}</td>
							<td>{{airport.address}}</td>
							<td>
								<router-link tag="button" class="btn_transparent" :to='`/crm/airwaysinfo/edit/${airport.id}`'>
									<i class="pe_icon pe-7s-edit editColor"></i>
								</router-link>
								<button class="btn_transparent" @click="deleteAirways(airport.id)">
									<i class="pe_icon pe-7s-trash trashColor"></i>
								</button>
							</td>
						</tr>
					</tbody>
					<pagination :limit="4" :data="getAirwayss" @pagination-change-page="getResults"></pagination>
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
			await this.actionAirwayss(page)
			this.laoding = false
		},
		computed:{
			...mapGetters('airwaysinfo',['getAirwayss','getMassage'])
		},
		methods:{
			...mapActions('airwaysinfo',['actionAirwayss','actionDeleteAirways']),
			async getResults(page = 1){ 
				this.laoding = true
				await this.actionAirwayss(page)
				this.laoding = false
			},
			async deleteAirways(id){
				if(confirm("Вы действительно хотите удалить?")){
					let page = 1
					this.laoding = true
					await this.actionDeleteAirways(id)
					if(this.getMassage.success){
						await this.actionAirwayss(page)
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