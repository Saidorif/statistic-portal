<template>
  <div class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand top_nav_header">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="sidebar_icon fas fa-bars" style="font-size: 30px;line-height: 21px;"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a href="#" class="logout_btn" @click.prevent="logoutProfile">Выйти <i class="fas fa-sign-out-alt"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar">
    <!-- Brand Logo -->
    <router-link  to="/crm">
      <div class="sidebar_logo">
        <img src="/img/sidebarlogo.png">
        <a href="#"><img src="/img/menuhide.png" alt=""></a>
      </div>
    </router-link>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->

      <!-- Sidebar Menu -->
      <nav>
        <ul class="nav nav-pills nav-sidebar flex-column sidebar-menu treeview" data-widget="treeview" role="menu" data-accordion="false" >
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
             <!-- v-if="$can('profile', 'UserController')" -->
            <router-link to="/crm/dashboard" class="nav-link">
              <img src="/img/home.svg" alt="">
              <p>
                Админ панель
              </p>
            </router-link>
          </li>
          <li class="nav-item">
             <!-- v-if="$can('profile', 'UserController')" -->
            <router-link to="/crm/avto" class="nav-link">
              <img src="/img/bus.svg" alt="">
              <p>
                Автомобиль транспорти
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/crm/profile">
              <i class="sidebar_icon fas fa-user"></i>
              <p>
                Мои данные
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/crm/country">
              <i class="sidebar_icon fas fa-city"></i>
              <p>
                Страны
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/crm/employee">
              <i class="sidebar_icon fas fa-users"></i>
              <p>
                Пользователи
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/crm/position">
              <i class="sidebar_icon fas fa-star"></i>
              <p>
                Должность
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/crm/vedgroup">
              <i class="sidebar_icon fas fa-file"></i>
              <p>
                ВЭД группы
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/crm/aviadirection">
              <img src="/img/airplane.svg" alt="">
              <p>
                Авиайўналишлари
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/crm/airportname">
              <img src="/img/airplane.svg" alt="">
              <p>
                Названия аэропорта
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/crm/airwayscompany">
              <img src="/img/airplane.svg" alt="">
              <p>
                Названия авиакомпании
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/crm/airwaysinfo">
              <img src="/img/airplane.svg" alt="">
              <p>
                Информации авиакомпании
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/crm/airportinfo">
              <img src="/img/airplane.svg" alt="">
              <p>
                Информации аэропорта
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/crm/customs-import-export">
              <img src="/img/truckfast.svg">
              <p>
                Таможня  (Excel)
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/crm/report-by-country">
              <img src="/img/truckfast.svg">
              <p>
                Отчет по странам
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/crm/report-by-product">
              <img src="/img/truckfast.svg">
              <p>
                Отчет по продуктам
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/crm/region">
              <i class="sidebar_icon fas fa-globe"></i>
              <p>
                Области
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/crm/area">
              <i class="sidebar_icon fas fa-building"></i>
              <p>
                Регион
              </p>
            </router-link>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <span class="sidebar_icon fas fa-users-cog" style="font-size: 20px;"></span>
              <p>
                Setting users
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link class="nav-link" to="/crm/role">
                  <p>
                    Role
                  </p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link class="nav-link" to="/crm/conts">
                  <p>
                    Controller
                  </p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link class="nav-link" to="/crm/action">
                  <p>
                    Actions
                  </p>
                </router-link>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <router-view></router-view>
            <vue-progress-bar></vue-progress-bar>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2020 <a href="#">MIRXAN </a>.</strong>
    All rights reserved.
  </footer>
</div>
</div>
</template>

<script>
  import { mapActions, mapGetters } from "vuex";
  import {TokenService} from '../../../services/storage.service'
export default {
  components: {
  },
  data(){
    return {

    }
  },
  computed: {
    ...mapGetters(['getUser']),
  },
  async mounted(){
    await this.profileUser()
  },
  methods: {
    ...mapActions(['logout','profileUser']),
    logoutProfile(){
      this.logout();
    },

  }
};
</script>

<style scoped>
    .sidebar_logo{
        padding: 13px 7px 13px 15px;
        border-bottom: 0.940711px solid #FFFFFF;
        margin-bottom: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .brand-link.active{
        border-bottom: 1px solid #3e6174;
    }
    .brand-text img{
        width: 100%;
    }
    .sidebar{
        padding-left: 0px;
        padding-right: 0px;
    }
    .sidebar_icon{
        font-size: 18px;
        color: #fff;
        margin-right: 5px;
    }
    .content-wrapper{
        background: #ebf2f6;
        padding-top: 30px;
    }
    .nav-sidebar .nav-item>.nav-link{
        color: #fff;
        margin-bottom: 0px;
        transition: .5s !important;
        display: flex;
        align-items: center;
    }
        .nav-sidebar .nav-item>.nav-link img{
            margin-right: 10px;
        }
    .nav-sidebar  .nav-item.menu-open>.nav-link,
    .nav-sidebar .nav-item>.nav-link:hover,
    .nav-pills .nav-link.active,
    .nav-pills .show > .nav-link{
        background: rgba(196, 196, 196, 0.15) !important;
        color: white !important;
        font-family: 'Inter-Medium';
        font-style: normal;
        font-weight: 500;
        font-size: 13.17px;
        line-height: 32px;
        color: #FFFFFF;
        opacity: 1;
    }
    .nav-pills .nav-link{
        border-radius: 0px;
        padding-left: 21px;
    }
    .nav-pills .nav-link{
        opacity: 0.6;
    }
    .nav-item .nav-treeview{
        padding-left: 20px;
    }
</style>
