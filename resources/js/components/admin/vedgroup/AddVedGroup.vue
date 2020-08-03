<template>
  <div class="add_employee">
    <div class="card">
      <div class="card-header">
        <div class="header_title">
          <h3 class="card-title title_user mb-0">
            <i class="sidebar_icon fas fa-file mr-1"></i>Добавить ВЭД группу
          </h3>
          <router-link class="btn btn-primary back_btn" to="/crm/vedgroup"><span class="peIcon pe-7s-back"></span> Назад</router-link>
        </div>
      </div>
      <form role="form" @submit.prevent.enter="sendVed" enctype="multipart/form-data">
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
          <div class="col-md-6 d-flex">
            <div class="col-md-6">
              <div class="form-group">
                <label for="code_from">Код ТН ВЭД</label>
                <input
                  type="number"
                  class="form-control input_style"
                  id="code_from"
                  :class="isRequired(form.code_from) ? 'isRequired' : ''"
                  placeholder="с"
                  v-model="form.code_from"
                />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="code_to">Код ТН ВЭД</label>
                <input
                  type="number"
                  class="form-control input_style"
                  id="code_to"
                  placeholder="по"
                  v-model="form.code_to"
                />
              </div>
            </div>
          </div>
          <div class="col-md-12 d-flex justify-content-end">
            <button type="submit" class="btn btn-success">Сохранить</button>
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
        name: "",
        code_from: '',
        code_to:'',
      },
      requiredInput: false,
    };
  },
  computed: {
    ...mapGetters("vedgroup", ["getMassage"]),
  },
  methods: {
    ...mapActions("vedgroup", ["actionAddVed"]),
    isRequired(input) {
      if (input != null) {
        return this.requiredInput && input === "";
      }
    },
    async sendVed() {
      if ( this.form.name && this.form.code_from ){
        await this.actionAddVed(this.form)
        this.$router.push("/crm/vedgroup");
        this.requiredInput = false;
        toast.fire({
          type: "success",
          icon: "success",
          title: "ВЭД группа добавлено!"
        });
      } else {
        this.requiredInput = true;
      }
    },
  }
};
</script>
<style scoped>
</style>