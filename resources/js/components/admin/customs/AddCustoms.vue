<template>
  <div class="add_employee">
    <div class="card">
      <div class="card-header">
        <div class="header_title">
          <h3 class="card-title title_user mb-0">
            <i class="sidebar_icon fas fa-file-excel mr-2"></i>Добавить  данные
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
          <div class="col-md-6 d-flex">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Код ТН ВЭД</label>
                <input
                  type="text"
                  class="form-control input_style"
                  id="name"
                  :class="isRequired(form.name) ? 'isRequired' : ''"
                  placeholder="с"
                  v-model="form.code_from"
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
                  placeholder="до"
                  v-model="form.code_to"
                />
              </div>
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
        name: "",
        code_to:'',
        code_from: ''
      },
      fileFormat: "нет-файла",
      requiredInput: false,
      checkPassword: false,
      emailError: false
    };
  },
  async mounted() {
    await this.actionRoleList();
    await this.actionPositionList();
  },
  computed: {
    ...mapGetters("employee", ["getMassage"]),
    ...mapGetters("role", ["getRoleList"]),
    ...mapGetters("position", ["getPositionList"])
  },
  methods: {
    ...mapActions("role", ["actionRoleList"]),
    ...mapActions("employee", ["actionAddEmployee", "actionCheckEmail"]),
    ...mapActions("position", ["actionPositionList"]),
    confirmPassword() {
      if (this.form.password && this.form.confirm_password) {
        if (this.form.password != this.form.confirm_password) {
          this.checkPassword = true;
        } else {
          this.checkPassword = false;
        }
      }
    },
    photoImg(img) {
      if (img.length < 100) {
        return "/img/user.jpg";
      } else {
        return img;
      }
    },
    changeFile(event) {
      let file = event.target.files[0];
      if (file.size > 1048576) {
        swal.fire({
          type: "error",
          icon: "error",
          title: "Ошибка",
          text: "Размер файл не должно быть больше 1мб"
        });
      } else {
        let reader = new FileReader();
        reader.onload = e => {
          this.form.file = e.target.result;
          this.fileFormat = event.target.files[0].name
            .substr(event.target.files[0].name.lastIndexOf("\\") + 1)
            .split(".")[0];
        };
        reader.readAsDataURL(file);
      }
    },
    changePhoto(event) {
      let file = event.target.files[0];
      if (
        event.target.files[0]["type"] === "image/png" ||
        event.target.files[0]["type"] === "image/jpeg" ||
        event.target.files[0]["type"] === "image/jpg"
      ) {
        if (file.size > 1048576) {
          swal.fire({
            type: "error",
            title: "Ошибка",
            text: "Размер изображения больше лимита"
          });
        } else {
          let reader = new FileReader();
          reader.onload = event => {
            this.form.image = event.target.result;
          };
          reader.readAsDataURL(file);
        }
      } else {
        swal.fire({
          type: "error",
          title: "Ошибка",
          text: "Картинка должна быть только png,jpg,jpeg!"
        });
      }
    },
    isRequired(input) {
      if (input != null) {
        return this.requiredInput && input === "";
      }
    },
    async sendEmployee() {
      if (
        this.form.name &&
        this.form.email &&
        this.form.password &&
        this.form.confirm_password &&
        this.form.role_id &&
        this.form.gender &&
        this.checkPassword == false
      ) {
        if (this.form.experience && this.form.experience.length) {
          await this.actionAddEmployee(this.form);
        } else {
          delete this.form.experience;
          await this.actionAddEmployee(this.form);
        }
        if (this.getMassage.success) {
          this.$router.push("/crm/employee");
          this.requiredInput = false;
          toast.fire({
            type: "success",
            icon: "success",
            title: "Ползователь добавлено!"
          });
        }
      } else {
        this.requiredInput = true;
      }
    },
    async checkEmailInput() {
      await this.actionCheckEmail({ email: this.form.email });
      if (
        this.getMassage.error &&
        this.getMassage.message.email == "Почта уже занята."
      ) {
        this.emailError = true;
      } else {
        this.emailError = false;
      }
    },
    addExperience() {
      let item = {
        company: "",
        date_from: "",
        date_to: "",
        address: "",
        position: "",
        description: ""
      };
      this.form.experience.push(item);
    },
    removeExperience(ex, index) {
      this.form.experience.splice(index, 1);
    }
  }
};
</script>
<style scoped>
</style>