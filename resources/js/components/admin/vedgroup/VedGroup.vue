<template>
  <div class="card">
    <div class="card-header">
      <div class="header_title">
        <h3 class="card-title title_user mb-0">
          <i class="sidebar_icon fas fa-file mr-1"></i>ВЭД группы
        </h3>
						<router-link class="btn btn-primary" to="/crm/vedgroup/add"><i class="fas fa-plus"></i> Добавить</router-link>
      </div>
    </div>
    <div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered text-center table-hover table-striped">
					<thead>
						<tr>
							<th scope="col">№</th>
							<th scope="col">Код ТН ВЭД</th>
							<th scope="col">Основная номенклатура экспортных грузов</th>
              <th scope="col">Действия</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(item,index) in getVedList.data">
							<td scope="row">{{index+1}}</td>
							<td>группа {{item.code}}</td>
							<td>{{item.name}}</td>
							<td>
								<router-link tag="button" class="btn_transparent mr-1" :to='`/crm/vedgroup/edit/${item.id}`'>
									<i class="fas fa-pen"></i>
								</router-link>
								<button class="btn_transparent" @click="deleteVed(item.id)">
									<i class="fas fa-trash"></i>
								</button>
							</td>
						</tr>
					</tbody>
          <pagination :limit="4" :data="getVedList" @pagination-change-page="getResults"></pagination>
				</table>
			  </div>
    </div>
  </div>
</template>	
<script>
import { mapActions, mapGetters } from "vuex";
export default {
  data() {
    return {
      form: {
        name: '',
        code: ''
      },
      requiredInput: false,
    };
  },
  computed: {
    ...mapGetters('vedgroup',['getVedList'])
  },
  async mounted() {
    let page = 1;
    await this.actionVedList({page:page})
  },
  methods: {
    ...mapActions('vedgroup',['actionVedList','actionDeleteVed']),
    async deleteVed(id){
      if(confirm("Вы действительно хотите удалить?")){
        let page = 1
        await this.actionDeleteVed(id)
        await this.actionVedList({page: page})
        toast.fire({
            type: 'success',
            icon: 'success',
          title: 'ВЭД группа удалена!',
          })
      }
    },
    async getResults(page = 1){ 
      await this.actionVedList({page:page})
    },
  }
};
</script>
<style scoped>
</style>