<template>
  <div class="edit_employee">
    <div class="card">
      <div class="card-header">
        <div class="header_title">
          <h3 class="card-title title_user mb-0">
            <i class="sidebar_icon fas fa-file mr-1"></i>Редактировать данные
          </h3>
          <router-link class="btn_black" to="/crm/customs-import-export"><span class="peIcon fas fa-arrow-left"></span> Назад</router-link>
        </div>
      </div>
      <form role="form" @submit.prevent.enter="sendData">
        <div class="card-body d-flex flex-wrap">
          <template v-if="errorMsg.length">
            <div class="alert alert-danger w-100" v-for="msg in errorMsg">{{msg}}</div>
          </template>
          <div class="col-md-6">
            <div class="form-group">
              <label for="mode">Режим</label>
              <input
                type="text"
                class="form-control input_style"
                id="mode"
                :class="isRequired(form.mode) ? 'isRequired' : ''"
                placeholder="Режим"
                v-model="form.mode"
              />
            </div>
            <div class="form-group">
              <label for="vedcode">Код ТН ВЭД</label>
              <input
                type="text"
                class="form-control input_style"
                id="vedcode"
                :class="isRequired(form.vedcode) ? 'isRequired' : ''"
                placeholder="Код ТН ВЭД"
                v-model="form.vedcode"
              />
            </div>
            <div class="form-group">
              <label for="country_code">Код страна</label>
              <input
                type="text"
                class="form-control input_style"
                id="country_code"
                :class="isRequired(form.country_code) ? 'isRequired' : ''"
                placeholder="Код страна"
                v-model="form.country_code"
              />
            </div>
            <div class="form-group">
              <label for="transport_type">Вид транспорта</label>
              <input
                type="text"
                class="form-control input_style"
                id="transport_type"
                :class="isRequired(form.transport_type) ? 'isRequired' : ''"
                placeholder="Вид транспорта"
                v-model="form.transport_type"
              />
            </div>
            <div class="form-group">
              <label for="weight">Вес (тн)</label>
              <input
                type="text"
                class="form-control input_style"
                id="weight"
                :class="isRequired(form.weight) ? 'isRequired' : ''"
                placeholder="Вес (тн)"
                v-model="form.weight"
              />
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="date">Дата</label>
              <input
                type="date"
                class="form-control input_style"
                id="date"
                :class="isRequired(form.date) ? 'isRequired' : ''"
                placeholder="Дата"
                v-model="form.date"
              />
            </div>
            <div class="form-group">
              <label for="product">Товар</label>
              <input
                type="text"
                class="form-control input_style"
                id="product"
                :class="isRequired(form.product) ? 'isRequired' : ''"
                placeholder="Товар"
                v-model="form.product"
              />
            </div>
            <div class="form-group">
              <label for="country_name">Страна  грузотпровитель / грузополучателя</label>
              <input
                type="text"
                class="form-control input_style"
                id="country_name"
                :class="isRequired(form.country_name) ? 'isRequired' : ''"
                placeholder="Страна  грузотпровитель / грузополучателя"
                v-model="form.country_name"
              />
            </div>
            <div class="form-group">
              <label for="transport_country_code">Страна  регстрация  транспорта</label>
              <input
                type="text"
                class="form-control input_style"
                id="transport_country_code"
                :class="isRequired(form.transport_country_code) ? 'isRequired' : ''"
                placeholder="Страна  регстрация  транспорта"
                v-model="form.transport_country_code"
              />
            </div>
            <div class="form-group">
              <label for="cost">Стоимость (тыс.долл.)</label>
              <input
                type="text"
                class="form-control input_style"
                id="cost"
                :class="isRequired(form.cost) ? 'isRequired' : ''"
                placeholder="Стоимость (тыс.долл.)"
                v-model="form.cost"
              />
            </div>
          </div>
          <div class="col-md-12 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Сохранить</button>
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
        mode: "",
        date:'',
        vedcode: '',
        product: '',
        country_code: '',
        country_name: '',
        transport_type: '',
        transport_country_code: '',
        weight: '',
        cost: '',
      },
      requiredInput: false,
      errorMsg: []
    };
  },
  async mounted() {
    await this.actionEditCustoms({ id: this.$route.params.customsId });
    this.form = this.getCustom;
  },
  computed: {
    ...mapGetters("customs", ["getMassage", "getCustom"]),
  },
  methods: {
    ...mapActions("customs", [
      "actionUpdateCustoms",
      "actionEditCustoms"
    ]),
    isRequired(input) {
      if (input != null) {
        return this.requiredInput && input === "";
      }
    },
    async sendData() {
      if (
        this.form.mode &&
        this.form.date &&
        this.form.vedcode &&
        this.form.product &&
        this.form.country_code &&
        this.form.country_name &&
        this.form.transport_type &&
        this.form.transport_country_code &&
        this.form.weight &&
        this.form.cost
      ) {
        await this.actionUpdateCustoms(this.form)
        console.log(this.getMassage)
        if (this.getMassage.success) {
          this.$router.push("/crm/customs-import-export");
          this.requiredInput = false;
          toast.fire({
            type: "success",
            icon: "success",
            title: "Успешно изменено!"
          });
        }else{
          this.errorMsg = Object.values(this.getMassage.message);
        }
      } else {
        this.requiredInput = true;
      }
    },
  }
};
</script>
<style scoped>
</style>
