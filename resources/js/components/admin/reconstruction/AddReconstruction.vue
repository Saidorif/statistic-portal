<template>
	<div class="add-reconstruction">
		<Loader v-if="laoding"/>
		<div class="card">
		  	<div class="card-header">
			    <h4 class="title_user">
			    	<i class="peIcon pe-7s-id"></i>
				    Добавить Reconstruction
				</h4>
				<router-link class="btn_black" to="/crm/reconstruction"><span class="peIcon fas fa-arrow-left"></span> Назад</router-link>
		  	</div>
		  	<div class="card-body">
		  		<form @submit.prevent.enter="saveReconstruction" enctype="multipart/form-data">
					<div class="row">
					  <div class="form-group col-md-4">
					    <label for="company">Компании</label>
					    <multiselect
							:value="values"
							:options="findList"
							@search-change="value => findCompany(value)"
							v-model="values"
	                        placeholder="Выберите маршрут"
	                        :searchable="true"
	                        track-by="id"
	                        label="company_name"
	                        :max="3"
							:loading="isLoading"
							selectLabel="Нажмите Enter, чтобы выбрать"
							deselectLabel="Нажмите Enter, чтобы удалить"
							:option="[{company_name: 'Otash', id: 1}]"
							@select="dispatchAction"
							@remove="removeCompany"
							:class="isRequired(form.offerbuilding_id) ? 'isRequired' : ''"
							>
							<span slot="noResult">По вашему запросу ничего не найдено</span>
							<span slot="noOptions">Cписок пустой</span>
						</multiselect>
				  	  </div>
					  <div class="form-group col-md-4">
			              <label for="start_date">Дата начала</label>
			              <date-picker
			                lang="ru"
			                placeholder="Дата"
			                type="date" format="YYYY-MM-DD" valueType="format"
			                v-model="form.start_date"
			                :class="isRequired(form.start_date) ? 'isRequired' : ''"
			              ></date-picker>
		              </div>
					  <div class="form-group col-md-4">
			              <label for="end_date">Дата окончания</label>
			              <date-picker
			                lang="ru"
			                placeholder="Дата"
			                type="date" format="YYYY-MM-DD" valueType="format"
			                v-model="form.end_date"
			                :class="isRequired(form.end_date) ? 'isRequired' : ''"
			              ></date-picker>
		              </div>
					  <div class="form-group col-md-4">
					    <label for="summa">Сумма</label>
					    <input
					    	type="number"
					    	class="form-control input_style"
					    	id="summa"
					    	placeholder="Сумма"
					    	v-model="form.summa"
					    	:class="isRequired(form.summa) ? 'isRequired' : ''"
				    	>
					  </div>
					  <div class="form-group col-md-4">
					    <label for="asos">Асос</label>
					    <textarea
					    	class="form-control input_style"
					    	v-model="form.asos"
					    	:class="isRequired(form.asos) ? 'isRequired' : ''"
					    	rows="1"
					    	placeholder="Асос"
					    ></textarea>
					  </div>
					  <div class="form-group col-md-4">
					    <label for="recon_hakim">Реконструкция учун ҳокимнинг қарори</label>
					    <input
					    	type="file"
					    	class="form-control input_style"
					    	id="recon_hakim"
					    	placeholder="Реконструкция учун ҳокимнинг қарори"
				    	 	@change="changeOfferHakim($event)"
					    	:class="isRequired(form.recon_hakim) ? 'isRequired' : ''"
				    	>
					  </div>
					  <div class="form-group col-lg-12">
					  	<div class="row">
					  		<div class="form-group col-lg-4">
					  			<label for="gallery">Изображения</label>
						  		<input type="file" id="gallery" class="form-control" multiple @change="uploadImage"/>
					  	  	</div>
					  		<div class="form-group col-lg-9 d-flex align-items-center">
					  			<div v-for="(image, key) in form.gallery" :key="key" :class="'gallery_item imgb'+key">
								    <img @click="showImgScaledVersion('imgb'+key)" :src="image" class="preview"/>
                                    <a href="#" class="remove" @click.prevent="removeGallery(key)"><i class="fas fa-trash"></i></a>
								</div>
					  	  	</div>
					  	</div>
				  	  </div>
					  <div class="form-group col-lg-12 form_btn d-flex justify-content-end">
					  	<button type="submit" class="btn btn-primary btn_save_category">
					  		<i class="fas fa-save"></i>
						  	Сохранить
						</button>
				  	  </div>
					</div>
				</form>
		  	</div>
	  	</div>
	</div>
</template>
<script>
	import { mapGetters , mapActions } from 'vuex'
	import Loader from '../../Loader'
	import Multiselect from 'vue-multiselect';
	import DatePicker from "vue2-datepicker";
	export default{
		components:{
			Loader,
			DatePicker,
			Multiselect,
		},
		data(){
			return{
				form:{
					offerbuilding_id:'',
					start_date:'',
					end_date:'',
					summa:'',
					asos:'',
					recon_hakim:'',
					gallery:[],
				},
				requiredInput:false,
				laoding: true,
				isLoading: false,
				values: {},
				findList: [],
				files: [],
			}
		},
		computed:{
			...mapGetters('reconstruction',['getMassage','getReconstructionFindList']),
			checkInput(){
				if (
					this.form.offerbuilding_id != '' &&
					this.form.start_date != '' &&
					this.form.end_date != '' &&
					this.form.summa != '' &&
					this.form.asos != '' &&
					this.form.recon_hakim != ''
				) {
					return true
				}else{
					return false
				}
			}
		},
		mounted(){
			this.laoding = false
		},
		methods:{
			...mapActions('reconstruction',['actionAddReconstruction','actionReconstructionFind']),
			isRequired(input){
	    		return this.requiredInput && input === '';
		    },
		    removeGallery(index){
				if(confirm("Вы действительно хотите удалить?")){
					Vue.delete(this.form.gallery,index)
				}
			},
		    uploadImage(event) {
	            let selectedFiles = event.target.files;
				selectedFiles.forEach((file,index)=>{
			      	if (
				        file["type"] === "image/png" ||
				        file["type"] === "image/jpeg" ||
				        file["type"] === "image/jpg"
			      	) {
				        if (file.size > 1048576){
				          swal.fire({
				            type: "error",
				            title: "Ошибка",
				            text: "Размер изображения больше лимита"
				          });
			        	} else {
                            let reader = new FileReader();
                            reader.onload = event => {
                                this.form.gallery.push(event.target.result);
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
				})
	        },
            showImgScaledVersion(elem) {
                let elemDiv = document.querySelector(`.${elem}`);
                elemDiv.classList.toggle('showed')
            },
		    removeCompany(){
		    	this.form.offerbuilding_id=''
		    	this.values={}
				this.findList = []
		    },
		    async findCompany(value){
		      if(value != ''){
		        this.isLoading = true
		        await setTimeout(async ()=>{
					await this.actionReconstructionFind({name: value})
			        this.findList = this.getReconstructionFindList
		        this.isLoading = false
		        },1000)
		      }
		    },
		    async dispatchAction(data){
				this.values = data;
				this.form.offerbuilding_id = data.id
		    },
		    changeOfferHakim(event) {
		      let file = event.target.files[0];
		      if (
		        event.target.files[0]["type"] === "image/png" ||
		        event.target.files[0]["type"] === "image/jpeg" ||
		        event.target.files[0]["type"] === "image/jpg"
		      ) {
                    if (file.size > 1048576){
                        swal.fire({
                            type: "error",
                            title: "Ошибка",
                            text: "Размер изображения больше лимита"
                        });
                    } else {
                        let reader = new FileReader();
                        reader.onload = event => {
                            this.form.recon_hakim = event.target.result;
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
			async saveReconstruction(){
		    	if (this.checkInput){
					this.laoding = true
					await this.actionAddReconstruction(this.form)
					if (this.getMassage.success) {
						toast.fire({
					    	type: 'success',
					    	icon: 'success',
							title: this.getMassage.message,
					    })
						this.$router.push("/crm/reconstruction");
						this.requiredInput = false
					}
					this.laoding = false
				}else{
					this.requiredInput = true
				}
		    }
		}
	}
</script>
<style scoped>

</style>
