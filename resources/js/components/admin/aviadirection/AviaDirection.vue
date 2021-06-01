<template>
	<div class="aviadirection">
		<Loader v-if="laoding"/>
		<div class="card">
		  	<div class="card-header">
			    <h4 class="title_user">
			    	<i  class="peIcon fas-fa plane"></i>
				    Авиайўналишлари 
				</h4>
				<router-link class="btn btn-primary" to="/crm/aviadirection/add">
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
							<th scope="col">Йўналиш номи</th>
							<th scope="col">Рейслар йўналиши</th>
							<th scope="col">Авиақатнов тури</th>
							<th scope="col">Парвозлар сони</th>
							<th scope="col">Действия</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(avia_item,index) in getAviaDirections.data">
							<td scope="row">{{avia_item.id}}</td>
							<td>{{avia_item.name}}</td>
							<td>{{$g.findTypeAirports(avia_item.direction_type)}}</td>
							<td>{{$g.findAviaTypes(avia_item.avia_type)}}</td>
							<td>{{avia_item.flight_qty}}</td>
							<td>
								<router-link tag="button" class="btn_transparent" :to='`/crm/aviadirection/edit/${avia_item.id}`'>
									<i class="pe_icon pe-7s-edit editColor"></i>
								</router-link>
								<button class="btn_transparent" @click="deleteAviaDirection(avia_item.id)">
									<i class="pe_icon pe-7s-trash trashColor"></i>
								</button>
							</td>
						</tr>
					</tbody>
					<pagination :limit="4" :data="getAviaDirections" @pagination-change-page="getResults"></pagination>
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
			await this.actionAviaDirections(page)
			this.laoding = false
		},
		computed:{
			...mapGetters('aviadirection',['getAviaDirections','getMassage'])
		},
		methods:{
			...mapActions('aviadirection',['actionAviaDirections','actionDeleteAviaDirection']),
			async getResults(page = 1){ 
				this.laoding = true
				await this.actionAviaDirections(page)
				this.laoding = false
			},
			async deleteAviaDirection(id){
				if(confirm("Вы действительно хотите удалить?")){
					let page = 1
					this.laoding = true
					await this.actionDeleteAviaDirection(id)
					await this.actionAviaDirections(page)
					this.laoding = false
					toast.fire({
				    	type: 'success',
				    	icon: 'success',
						title: 'AviaDirection удалено!',
				    })
				}
			}
		}
	}
</script>
<style scoped>
	
</style>