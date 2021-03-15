<template>
  <div class="edit_employee">
    <div class="card">
      <div class="card-header">
        <div class="header_title">
          <h3 class="card-title title_user mb-0">
            <i class="sidebar_icon fas fa-file mr-1"></i>Редактировать ВЭД группу
          </h3>
          <router-link class="btn_black" to="/crm/vedgroup"><span class="peIcon fas fa-arrow-left"></span> Назад</router-link>
        </div>
      </div>
      <form role="form" @submit.prevent.enter="sendVed">
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
              <label for="code">Код ТН ВЭД</label>
              <input
                type="text"
                class="form-control input_style"
                id="code"
                :class="isRequired(form.code) ? 'isRequired' : ''"
                placeholder="Основная номенклатура экспортных грузов"
                v-model="form.code"
              />
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
        id: "",
        name: "",
        code: "",
      },
      requiredInput: false,
    };
  },
  async mounted() {
    await this.actionEditVed(this.$route.params.vedgroupId)
    this.form = this.getVed
  },
  computed: {
    ...mapGetters("vedgroup", ["getMassage",'getVed']),
  },
  methods: {
    ...mapActions("vedgroup", ["actionEditVed",'actionUpdateVed']),
    isRequired(input) {
      if (input != null) {
        return this.requiredInput && input === "";
      }
    },
    async sendVed() {
      if ( this.form.name && this.form.code ){
        await this.actionUpdateVed(this.form)
        this.$router.push("/crm/vedgroup");
        this.requiredInput = false;
        toast.fire({
          type: "success",
          icon: "success",
          title: "ВЭД группа изменена!"
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
