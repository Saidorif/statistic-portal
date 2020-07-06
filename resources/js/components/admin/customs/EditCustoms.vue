<template>
  <div class="edit_employee">
    <div class="card">
      <div class="card-header">
        <div class="header_title">
          <h3 class="card-title title_user mb-0">
            <i class="sidebar_icon fas fa-file mr-1"></i>Редактировать данные  
          </h3>
          <router-link class="btn btn-primary back_btn" to="/crm/customs-import-export"><span class="peIcon pe-7s-back"></span> Назад</router-link>
        </div>
      </div>
      <form role="form" @submit.prevent.enter="sendEmployee" enctype="multipart/form-data">
        <div class="card-body d-flex flex-wrap">
          <div class="col-md-6">
            <div class="form-group">
              <label for="name">Основная номенклатура экспортных грузов</label>
              <input
                type="text"
                class="form-control input_style"
                id="name"
                :class="isRequired(form.name) ? 'isRequired' : ''"
                placeholder="Основная номенклатура экспортных грузов"
                v-model="form.name"
              />
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="name">Код ТН ВЭД</label>
              <input
                type="text"
                class="form-control input_style"
                id="name"
                :class="isRequired(form.name) ? 'isRequired' : ''"
                placeholder="Основная номенклатура экспортных грузов"
                v-model="form.code"
              />
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>
<script>
import DatePicker from "vue2-datepicker";
import { mapActions, mapGetters } from "vuex";
export default {
  components: {
    DatePicker
  },
  data() {
    return {
      form: {
        id: "",
        name: "",
        code: "",
      },
      requiredInput: false,
    };
  },
  async mounted() {
  },
  computed: {
  },
  methods: {
    isRequired(input) {
      if (input != null) {
        return this.requiredInput && input === "";
      }
    },    
  }
};
</script>
<style scoped>
</style>