<template>
	<div class="country">
		<div class="card">
		  	<div class="card-header header_filter">
		  		<div class="header_title">
				    <h4 class="title_user">
				    	<i  class="peIcon pe-7s-users"></i>
					     Страны 
					</h4>
					<div class="add_user_btn">
			            <button type="button" class="btn btn-info toggleFilter" @click.prevent="toggleFilter">
						    <i class="fas fa-filter"></i>
			            	Филтр
						</button>
		            </div>
		  		</div>
		    	<transition name="slide">
				  	<div class="filters" v-if="filterShow">
				  		<div class="row">
  					  		<div class="form-group col-lg-3">
	  							<label for="name">Название</label>
	  							<input 
	  								type="text" 
	  								class="form-control" 
	  								id="name" 
	  								placeholder="Название..."
	  								v-model="filter.name"
  								>
				  			</div>
  					  		<div class="form-group col-lg-3">
	  							<label for="code">Код</label>
	  							<input 
	  								type="text" 
	  								class="form-control" 
	  								id="code" 
	  								placeholder="Код..."
	  								v-model="filter.code"
  								>
				  			</div>
						  	<div class="col-lg-3 form-group btn_search">
							  	<button type="button" class="btn btn-primary mr-2" @click.prevent="search">
							  		<i class="fas fa-search"></i>
								  	найти
							  	</button>
							  	<button type="button" class="btn btn-warning clear" @click.prevent="clear">
							  		<i class="fas fa-times"></i>
								  	сброс
							  	</button>
					  	  	</div>	
				  		</div>
				  	</div>	
			  	</transition>
		  	</div>
		  	<div class="card-body">
			  <div class="table-responsive">
				<table class="table table-bordered text-center table-hover table-striped">
					<thead>
						<tr>
							<th scope="col">№</th>
							<th scope="col">Название</th>
							<th scope="col">Alfa 2</th>
							<th scope="col">Alfa 3</th>
							<th scope="col">Код</th>
							<th scope="col">Действия</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(item,index) in getCountries.data">
							<td scope="row">{{index+1}}</td>
							<td>{{item.name}}</td>
							<td>{{item.alfa2}}</td>
							<td>{{item.alfa3}}</td>
							<td>{{item.code}}</td>
							<td>
								<router-link tag="button" class="btn_transparent" :to='`/crm/country/edit/${item.id}`'>
									<i class="pe_icon pe-7s-edit editColor"></i>
								</router-link>
								<!-- <button class="btn_transparent" @click="deleteCountry(item.id)">
									<i class="pe_icon pe-7s-trash trashColor"></i>
								</button> -->
							</td>
						</tr>
					</tbody>
					<pagination :limit="4" :data="getCountries" @pagination-change-page="getResults"></pagination>
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
				filter:{
					name:'',
					alfa2:'',
					alfa3:'',
					code:'',
				},
				filterShow:false,
			}
		},
		async mounted(){
			let page = 1;
			await this.actionCountries({page:page,items:this.filter})
		},
		computed:{
			...mapGetters('country',['getCountries']),
		},
		methods:{
			...mapActions('country',['actionCountries']),
			async getResults(page = 1){ 
				await this.actionCountries({page:page,items:this.filter})
			},
			toggleFilter(){
				this.filterShow = !this.filterShow
			},
			async search(){
				let page = 1
				if(this.filter.name || this.filter.alfa2 || this.filter.alfa3 || this.filter.code){
					await this.actionCountries({page: page,items:this.filter})
				}
			},
			async clear(){
				if(this.filter.name || this.filter.alfa2 || this.filter.alfa3 || this.filter.code){
					this.filter.name = ''
					this.filter.alfa2 = ''
					this.filter.alfa3 = ''
					this.filter.code = ''
					let page  = 1
					await this.actionCountries({page: page,items:this.filter})
				}

			},
			// async deleteCountry(id){
			// 	if(confirm("Вы действительно хотите удалить?")){
			// 		let page = 1
			// 		await this.actionCountries({page: page,items:this.filter})
			// 		toast.fire({
			// 	    	type: 'success',
			// 	    	icon: 'success',
			// 			title: 'Пользователь удалено!',
			// 	    })
			// 	}
			// }
		}
	}
</script>
<style scoped>
	
</style>