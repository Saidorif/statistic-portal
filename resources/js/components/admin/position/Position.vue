<template>
	<div class="role">
		<div class="card">
		  	<div class="card-header">
				<div class="header_title">
				    <h4 class="title_user">
				    	<i  class="sidebar_icon fas fa-star"></i>
					     Должность 
					</h4>
					<div class="add_user_btn">
						<router-link class="btn btn-primary" to="/crm/position/add"><i class="fas fa-plus"></i> Добавить</router-link>
		            </div>
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
						<tr v-for="(position,index) in getPositions.data">
							<td scope="row">{{index+1}}</td>
							<td>{{position.name}}</td>
							<td>
								<router-link tag="button" class="btn_transparent" :to='`/crm/position/edit/${position.id}`'>
									<i class="fas fa-pen"></i>
								</router-link>
								<button class="btn_transparent" @click="deletePosition(position.id)">
									<i class="fas fa-trash"></i>
								</button>
							</td>
						</tr>
					</tbody>
					<pagination :limit="4" :data="getPositions" @pagination-change-page="getResults"></pagination>
				</table>
			  </div>
		  </div>
	  	</div>
	</div>
</template>
<script>
	import {mapActions, mapGetters} from 'vuex'
	export default{
		data(){
			return{

			}
		},
		async mounted(){
			let page = 1;
			await this.actionPositions()
		},
		computed:{
			...mapGetters('position',['getPositions','getMassage'])
		},
		methods:{
			...mapActions('position',['actionPositions','actionDeletePosition']),
			async getResults(page = 1){ 
				await this.actionPositions(page)
			},
			async deletePosition(id){
				if(confirm("Вы действительно хотите удалить?")){
					let page = 1
					await this.actionDeletePosition(id)
					await this.actionPositions(page)
					toast.fire({
				    	type: 'success',
				    	icon: 'success',
						title: 'Рол удалено!',
				    })
				}
			}
		}
	}
</script>
<style scoped>
	
</style>