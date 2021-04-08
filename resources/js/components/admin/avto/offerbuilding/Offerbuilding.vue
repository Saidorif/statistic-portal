<template>
	<div class="offerbuilding">
		<Loader v-if="laoding"/>
		<div class="card">
		  	<div class="card-header">
			    <h4 class="title_user">
			    	<i class="peIcon fas fa-building"></i>
				    Offer building
				</h4>
				<router-link class="btn btn-primary" to="/crm/offerbuilding/add">
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
							<!-- <th scope="col">Таклиф тури</th> -->
							<!-- <th scope="col">Вилоят/Шахар</th> -->
							<th scope="col">Туман/Шахар</th>
							<th scope="col">Автовокзал (автостанция) номи</th>
							<th scope="col">Корхона номи</th>
							<th scope="col">Юридик шахс номи</th>
							<th scope="col">Статус</th>
							<th scope="col">ИНН</th>
							<th scope="col">жойлашган жойи</th>
							<th scope="col">Асос</th>
							<th scope="col">Лойиҳа ва унинг қиймати</th>
							<th scope="col">Молиялаштириш манбаи</th>
							<th scope="col">Ер майдони</th>
							<th scope="col">Қурилиш ишлари бошланган вақти</th>
							<th scope="col">Қурилиш ишлари топшириш вақти</th>
							<th scope="col">Бир вақтдаги йўловчи сиғими</th>
							<th scope="col">Устав фонди</th>
							<th scope="col">Действия</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(offer,index) in getOfferbuildings.data">
							<td scope="row" width="4%">
								<a href="#" class="text-decoration-none">
									<i class="fas fa-list"></i>
									{{offer.id}}
								</a>
							</td>
							<!-- <td>{{offer.type_of_construction}}</td> -->
							<!-- <td>{{offer.region ? offer.region.name : ''}}</td> -->
							<td>{{offer.area ? offer.area.name : ''}}</td>
							<td>{{offer.station ? offer.station.name : ''}}</td>
							<td>{{offer.company_name}}</td>
							<td>{{offer.name}}</td>
							<td>
								<div class="badge" :class="getStatusClass(offer.status)">
									{{getStatusName(offer.status)}}
								</div>
							</td>
							<td>{{offer.inn}}</td>
							<td>{{offer.address}}</td>
							<td>{{offer.asos}}</td>
							<td>{{offer.price}}</td>
							<td>{{offer.bank_credit}}</td>
							<td>{{offer.land_area}}</td>
							<td>{{offer.time_of_construction_start}}</td>
							<td>{{offer.time_of_construction_end}}</td>
							<td>{{offer.capacity_passenger}}</td>
							<td>{{offer.ustav_fond}}</td>
							<td>
								<router-link tag="button" class="btn_transparent" :to='`/crm/offerbuilding/edit/${offer.id}`'>
									<i class="pe_icon pe-7s-edit editColor"></i>
								</router-link>
								<button class="btn_transparent" @click="deleteOfferbuilding(offer.id)">
									<i class="pe_icon pe-7s-trash trashColor"></i>
								</button>
							</td>
						</tr>
					</tbody>
					<pagination :limit="4" :data="getOfferbuildings" @pagination-change-page="getResults"></pagination>
				</table>
			  </div>
		  </div>
	  	</div>
	</div>
</template>
<script>
	import { mapGetters , mapActions } from 'vuex'
	import Loader from '../../../Loader'
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
			await this.actionOfferbuildings(page)
			this.laoding = false
		},
		computed:{
			...mapGetters('offerbuilding',['getOfferbuildings','getMassage']),
		},
		methods:{
			...mapActions('offerbuilding',['actionOfferbuildings','actionDeleteOfferbuilding']),
			async getResults(page = 1){
				this.laoding = true
				await this.actionOfferbuildings(page)
				this.laoding = false
			},
			getStatusName(status){
				if(status == 'waiting'){
					return "Тасдикланмаган"
				}else if(status == 'rejected'){
					return "Рад этилган"
				}else if(status == 'accepted'){
					return "Тасдикланган"
				}
			},
			getStatusClass(status){
				if(status == 'waiting'){
					return "badge-warning"
				}else if(status == 'rejected'){
					return "badge-danger"
				}else if(status == 'accepted'){
					return "badge-primary"
				}
			},
			async deleteOfferbuilding(id){
				if(confirm("Вы действительно хотите удалить?")){
					let page = 1
					this.laoding = true
					await this.actionDeleteOfferbuilding(id)
					await this.actionOfferbuildings(page)
					this.laoding = false
					toast.fire({
				    	type: 'success',
				    	icon: 'success',
						title: 'Offer building удалено!',
				    })
				}
			}
		}
	}
</script>
<style scoped>

</style>
