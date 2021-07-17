<template>
	<div class="lognCard">
        <div class="login_bg_top">
            <img src="/img/logo.svg" alt="">
            <h2 class="logo_text">
                Транспорт ва йўл хўжалиги соҳасидаги ягона ахборот платформаси
            </h2>
        </div>
		<div class="form_content">
			<div class="login_alert" v-if="errorMsg"><i class="fas fa-exclamation-circle mr-2"></i> Неверный логин  или пароль </div>
            <h2>Тизимга кириш</h2>
			<p class="login_title">Электрон почта ва паролингизни киритинг</p>
			<form @submit.enter.prevent="onSubmit">
				<div class="input_group">
                    <label for="email">Электрон почта</label>
					<input type="email" id="email"  placeholder="Э-почта" v-model="form.email">
				</div>
				<div class="input_group">
                    <label for="password">Пароль</label>
					<input type="password" id="password" placeholder="Пароль" v-model="form.password">
				</div>
                <div class="input_checkbox">
                    <input type="checkbox" id="remember">
                    <label for="remember">Тизимда эслаб қолиш</label>
                </div>
				<button type="submit" class="btn_dark_blue">Кириш</button>
			</form>
		</div>
        <p class="copyright">Copyright © 2021 Ўзбекистон Республикаси Транспорт вазирлиги </p>
  	</div>
</template>
<script>
	import { mapActions, mapGetters } from "vuex";
	import { TokenService } from "./../../services/storage.service";
	export default{
		data() {
		    return {
		      form: {
		        email: "",
		        password: ""
			  },
			  errorMsg: null
		    };
	  	},
	 	computed: {
		    ...mapGetters(["authenticationErrorCode","authenticationError"])
	  	},
	  	async mounted(){

	  	},
	  	methods: {
		    ...mapActions(["login"]),
		    async onSubmit(){
		      this.$Progress.start();
		      if (this.form.email != "" && this.form.password != "") {
		        await this.login(this.form);
		        await this.authenticationErrorCode;
		        if (!this.authenticationErrorCode){
		          toast.fire({
					type: "success",
					icon: 'success',
		            title: "Вошли в систему!"
		          });
		          this.$Progress.finish();
				  window.location.href = "/crm/dashboard";
		        }else{
					this.errorMsg = this.authenticationError
				  	this.$Progress.fail();

		        }
		      }
		    }
	  	},
	}
</script>
<style scoped>

</style>
