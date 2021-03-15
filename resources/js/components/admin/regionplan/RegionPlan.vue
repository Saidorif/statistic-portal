<template>
	<div class="region">
		<Loader v-if="laoding"/>
		<div class="card">
		  	<div class="card-header">
			    <h4 class="title_user">
			    	<i  class="peIcon pe-7s-box1"></i>
				    План
				</h4>
				<router-link class="btn_green" to="/crm/regionplan/add">
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
							<th scope="col">Область</th>
							<th scope="col">Дата</th>
							<th scope="col">План</th>
							<th scope="col">Действия</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(reg,index) in getRegionPlans.data">
							<td scope="row">{{reg.id}}</td>
							<td>
								<router-link tag="a" class="btn-link" :to='`/crm/regionplan/expectation/${reg.id}`'>
									{{reg.region.name}}
								</router-link>
							</td>
							<td>{{reg.date}}</td>
							<td>{{reg.number}}</td>
							<td>
								<router-link tag="button" class="btn_blue mr-1" :to='`/crm/regionplan/edit/${reg.id}`'>
									<i class="pe_icon fas fa-pen editColor"></i>
								</router-link>
								<button class="btn_blue" @click="deleteRegion(reg.id)">
									<i class="pe_icon fas fa-trash trashColor"></i>
								</button>
							</td>
						</tr>
					</tbody>
					<pagination :limit="4" :data="getRegionPlans" @pagination-change-page="getResults"></pagination>
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
			await this.actionRegionPlans(page)
			console.log(this.getRegionPlans)
			this.laoding = false
		},
		computed:{
			...mapGetters('regionplan',['getRegionPlans','getMassage'])
		},
		methods:{
			...mapActions('regionplan',['actionRegionPlans','actionDeleteRegionPlan']),
			async getResults(page = 1){
				this.laoding = true
				await this.actionRegionPlans(page)
				this.laoding = false
			},
			async deleteRegion(id){
				if(confirm("Вы действительно хотите удалить?")){
					let page = 1
					this.laoding = true
					await this.actionDeleteRegionPlan(id)
					await this.actionRegionPlans(page)
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
