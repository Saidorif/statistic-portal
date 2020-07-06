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
						<tr v-for="(item,index) in form">
							<td scope="row">{{index+1}}</td>
							<td>группа {{item.code}}</td>
							<td>{{item.name}}</td>
							<td>
								<router-link tag="button" class="btn_transparent mr-1" :to='`/crm/vedgroup/edit/${item.id}`'>
									<i class="fas fa-pen"></i>
								</router-link>
								<button class="btn_transparent" @click="deleteEmployee(item.id)">
									<i class="fas fa-trash"></i>
								</button>
							</td>
						</tr>
					</tbody>
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
      form: [{
        id: 1,
        name: 'Живые животные; продукты животного происхождения',
        code: '01-05'
      }],
      requiredInput: false,
    };
  },
  computed: {
  },
  async mounted() {

  },
  methods: {
  }
};
</script>
<style scoped>
</style>