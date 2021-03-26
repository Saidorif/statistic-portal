<template>
	<div class="region">
		<Loader v-if="laoding"/>
		<div class="card">
		  	<div class="card-header">
			    <h4 class="title_user">
			    	<i  class="peIcon pe-7s-box1"></i>
				    Tender 
				</h4>
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
						<!-- <tr v-for="(reg,index) in getTenders.data">
							<td scope="row">{{reg.id}}</td>
							<td>{{reg.name}}</td>
		
						</tr> -->
					</tbody>
					<!-- <pagination :limit="4" :data="getTenders" @pagination-change-page="getResults"></pagination> -->
				</table>
			  </div>
		  </div>
	  	</div>
	</div>
</template>
<script>
	import { mapGetters , mapActions } from 'vuex'
	import Loader from '../../Loader'
	import { TokenService } from "./../../../services/storage.service";
	export default{
		components:{
			Loader
		},
		data(){
			return{
				laoding: false
			}
		},
		async mounted(){
			let page = 1;
			await this.actionTenders()
			console.log(this.getTenders)
			console.log(TokenService.getTender())
		},
		computed:{
			...mapGetters('tender',['getTenders','getMassage'])
		},
		methods:{
			...mapActions('tender',['actionTenders']),
			async getResults(page = 1){ 
				this.laoding = true
				await this.actionTenders(page)
				this.laoding = false
			},
		}
	}
</script>
<style scoped>
	
</style>