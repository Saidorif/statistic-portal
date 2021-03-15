<template>
	<div class="expectation">
		<Loader v-if="laoding"/>
		<div class="card">
		  	<div class="card-header">
			    <h4 class="title_user">
			    	<i  class="peIcon pe-7s-box1"></i>
				    Expectation 
				</h4>
				<router-link class="btn btn-primary" to="/crm/expectation/add">
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
						<tr v-for="(expectation,index) in getExpectations.data">
							<td scope="row">{{expectation.id}}</td>
							<td>{{expectation.name}}</td>
							<td>
								<router-link tag="button" class="btn_transparent" :to='`/crm/expectation/edit/${expectation.id}`'>
									<i class="pe_icon pe-7s-edit editColor"></i>
								</router-link>
								<button class="btn_transparent" @click="deleteExpectation(expectation.id)">
									<i class="pe_icon pe-7s-trash trashColor"></i>
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
			await this.actionExpectations(page)
			this.laoding = false
		},
		computed:{
			...mapGetters('expectation',['getExpectations','getMassage'])
		},
		methods:{
			...mapActions('expectation',['actionExpectations','actionDeleteExpectation']),
			async getResults(page = 1){ 
				this.laoding = true
				await this.actionExpectations(page)
				this.laoding = false
			},
			async deleteExpectation(id){
				if(confirm("Вы действительно хотите удалить?")){
					let page = 1
					this.laoding = true
					await this.actionDeleteExpectation(id)
					await this.actionExpectations(page)
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