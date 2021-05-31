<template>
	<div class="airportexpect">
		<Loader v-if="laoding"/>
		<div class="card">
		  	<div class="card-header">
			    <h4 class="title_user">
			    	<i class="sidebar_icon fas fa-plane"></i>
				    План аэропорта 
				</h4>
				<div class="d-flex justify-content-end">
					<router-link class="btn btn-primary" :to='`/crm/airportinfo/${$route.params.airportinfoId}/airportexpect/add`'>
						<i class="fas fa-plus"></i> 
						Добавить
					</router-link>
					<router-link class="btn_black ml-3" :to='`/crm/airportinfo`'>
						<span class="peIcon fas fa-arrow-left"></span> 
						Назад
					</router-link>
				</div>
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
						<tr v-for="(reg,index) in getAirportexpects.data">
							<td scope="row">{{reg.id}}</td>
							<td>{{reg.name}}</td>
							<td>
								<router-link tag="button" class="btn_transparent" :to='`/crm/airportexpect/edit/${reg.id}`'>
									<i class="pe_icon pe-7s-edit editColor"></i>
								</router-link>
								<button class="btn_transparent" @click="deleteRegion(reg.id)">
									<i class="pe_icon pe-7s-trash trashColor"></i>
								</button>
							</td>
						</tr>
					</tbody>
					<pagination :limit="4" :data="getAirportexpects" @pagination-change-page="getResults"></pagination>
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
			await this.actionAirportexpects(page)
			this.laoding = false
		},
		computed:{
			...mapGetters('airportexpect',['getAirportexpects','getMassage'])
		},
		methods:{
			...mapActions('airportexpect',['actionAirportexpects','actionDeleteAirportexpect']),
			async getResults(page = 1){ 
				this.laoding = true
				await this.actionAirportexpects(page)
				this.laoding = false
			},
			async deleteAirportexpect(id){
				if(confirm("Вы действительно хотите удалить?")){
					let page = 1
					this.laoding = true
					await this.actionDeleteAirportexpect(id)
					await this.actionAirportexpects(page)
					this.laoding = false
					toast.fire({
				    	type: 'success',
				    	icon: 'success',
						title: 'Airportexpect удалено!',
				    })
				}
			}
		}
	}
</script>
<style scoped>
	
</style>