<template>
  <div class="edit_employee">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title title_user mb-0">
          <i class="peIcon pe-7s-user"></i>Редактировать пользователя
        </h3>
        <router-link class="btn_black" to="/crm/employee"><span class="peIcon fas fa-arrow-left"></span> Назад</router-link>
      </div>
      <form role="form" @submit.prevent.enter="sendEmployee" enctype="multipart/form-data">
        <div class="card-body d-flex flex-wrap">
          <div class="col-md-6">
            <div class="form-group">
              <label for="name">Ф.И.О</label>
              <input
                type="text"
                class="form-control input_style"
                id="name"
                :class="isRequired(form.name) ? 'isRequired' : ''"
                placeholder="Ф.И.О"
                v-model="form.name"
              />
            </div>
            <div class="form-group">
              <label for="role">Рол</label>
              <select
                class="form-control"
                :class="isRequired(form.role_id) ? 'isRequired' : '' "
                id="countryName"
                v-model="form.role_id"
              >
                <option value selected disabled>Выберите рол</option>
                <option :value="role.id" v-for="(role,index) in getRoleList">{{role.name}}</option>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Пароль</label>
              <input
                type="password"
                class="form-control input_style"
                id="exampleInputPassword1"
                placeholder="Пароль.."
                :class="isRequired(form.password) ? 'isRequired' : ''"
                v-model="form.password"
              />
            </div>
            <div class="form-group">
              <label for="birthday">Статус</label>
              <select class="form-control" v-model="form.status">
                <option value="active" selected="selected">Активный</option>
                <option value="inactive">Неактивный</option>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group" v-if="form.role_id != 3">
              <label for="positon">Должность</label>
              <select
                class="form-control"
                :class="isRequired(form.position_id) ? 'isRequired' : '' "
                id="positon"
                v-model="form.position_id"
              >
                <option value selected disabled>Выберите Должность</option>
                <option
                  :value="position.id"
                  v-for="(position,index) in getPositionList"
                >{{position.name}}</option>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">E-mail</label>
              <input
                type="email"
                class="form-control input_style"
                :class="isRequired(form.email) ? 'isRequired' : ''"
                id="exampleInputEmail1"
                placeholder="E-mail"
                v-model="form.email"
                @blur="checkEmailInput"
              />
              <small class="redText" v-if="emailError">Email почта занят!</small>
            </div>
            <div class="form-group">
              <label for="ConfirmPassword1">Подтвердите пароль</label>
              <input
                type="password"
                class="form-control input_style"
                id="ConfirmPassword1"
                placeholder="Подтвердите пароль.."
                v-model="form.confirm_password"
                :class="isRequired(form.confirm_password) ? 'isRequired' : ''"
                @input="confirmPassword()"
              />
              <small class="redText" v-if="checkPassword">
                <b>Пароль не совпадает</b>
              </small>
            </div>
            <div  class="d-flex justify-content-end align-items-end" style="    height: 68px;">
              <button  type="submit" class="btn btn-primary">
                <i  class="fas fa-save"></i> Добавить
              </button>
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
        email: "",
        password: "",
        passwordConfirm: "",
        role_id: "",
        position_id: "",
        status: 'active',
      },
      requiredInput: false,
      checkPassword: false,
      emailError: false,
      fileFormat: "нет-файла"
    };
  },
  async mounted() {
    await this.actionRoleList();
    await this.actionPositionList();
    await this.actionEditEmployee({ id: this.$route.params.employeeId });
    this.form = this.getEmployee;
  },
  computed: {
    ...mapGetters("employee", ["getMassage", "getEmployee"]),
    ...mapGetters("role", ["getRoleList"]),
    ...mapGetters("position", ["getPositionList"])
  },
  methods: {
    ...mapActions("role", ["actionRoleList"]),
    ...mapActions("employee", [
      "actionUpdateEmployee",
      "actionCheckEmail",
      "actionEditEmployee"
    ]),
    ...mapActions("position", ["actionPositionList"]),
    confirmPassword() {
      if (this.form.password && this.form.passwordConfirm) {
        if (this.form.password != this.form.passwordConfirm) {
          this.checkPassword = true;
        } else {
          this.checkPassword = false;
        }
      }
    },
    photoImg(img) {
      if(img){
        if (img.length < 100) {
          return "/img/user.jpg";
        } else {
          return img;
        }
      }else{
        return "/img/user.jpg";
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
          this.fileFormat = event.target.files[0].name.substr(event.target.files[0].name.lastIndexOf("\\") + 1).split(".")[1];
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
      return this.requiredInput && input === "";
    },
    async sendEmployee(){
      if (
        this.form.name !='' &&
        this.form.email !='' &&
        this.form.password !='' &&
        this.form.confirm_password !='' &&
        this.form.role_id !='' &&
        this.checkPassword == false) {
        await this.actionUpdateEmployee(this.form);
        if (this.getMassage.success) {
          this.$router.push("/crm/employee");
          this.requiredInput = false;
          toast.fire({
            type: "success",
            icon: "success",
            title: "Ползователь изменено!"
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
  }
};
</script>
<style scoped>
</style>
