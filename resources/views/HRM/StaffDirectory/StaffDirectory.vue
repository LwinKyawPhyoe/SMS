<template>
  <div class="StaffInformation form" id="bar">
    <div class="toplink">
      <h4 style="color:var(--primary);margin-bottom:5px;">HRM</h4>
      <h6>
        <router-link class="home" to="/Student">Home</router-link>> Staff Directory
      </h6>
    </div>
    <hr />
    <Loading></Loading>
    <div class="card">
      <div class="card-header">
        <h6>Select Criteria</h6>
        <router-link to="/staffdirectory/add" class="add">Add Staff</router-link>
      </div>
      <div class="stucard-body">
        <div class="row">
          <div class="textarea">
            <form @submit.prevent="searchByRole()">
              <label for="class">
                Role
                <strong>*</strong>
              </label>
              <select
                id="search_role_id"
                @keyup="onValidate(search_by_role, 'search_role_id', 'search_rolemsg')"
                v-on:blur="onValidate(search_by_role, 'search_role_id', 'search_rolemsg')"
                v-model="search_by_role"
                class="inputbox"
              >
                <option value>Select</option>
                <option :value="role.id" v-for="(role) in roles" :key="role.id">{{role.name}}</option>
              </select>
              <span id="search_rolemsg" class="error_message">Role is required</span>
              <button type="submit" id="globalSearch" class="searchButton">Search</button>
            </form>
          </div>
          <div class="textarea">
            <label for="other">Search By Other Option</label>
            <form @submit.prevent="searchByOther()">
              <input
                v-model="search_by_other"
                class="inputbox"
                placeholder="Search By staff id,name,..etc."
              />
              <button type="submit" id="globalSearch" class="searchButton">Search</button>
            </form>
          </div>
        </div>
      </div>
      <div class="sub-header" style="padding: 0;">
        <button
          class="metaBtn tabTheme"
          id="listView"
          onclick="changeMega('listView','detailsView')"
          style="background:white;color:black;"
          @click="listView()"
        >
          <i class="fa fa-list"></i> List View
        </button>
        <button
          class="metaBtn tabTheme"
          id="detailsView"
          onclick="changeMega('detailsView','listView')"
          @click="detailsView()"
        >
          <i class="fa fa-id-card"></i> Details View
        </button>
      </div>

      <div class="stucard-body" v-if="view === true">
        <div v-if="isEmpty == true" class="NoData">
          No Data
        </div>
        <div v-else>
           <input type="text" placeholder="Search..." class="searchText" />
            <div  class="copyRows">
            <div class="row" id="copyRow">
            <div class="col-3">
              <a href="#" title="Excel">
                <i class="fa fa-file-excel-o"></i>
              </a>
            </div>
            <div class="col-3">
              <a href="#" title="Print">
                <i class="fa fa-print"></i>
              </a>
            </div>
            <div class="col-3">
              <a href="#" title="Columns">
                <i class="fa fa-columns"></i>
              </a>
            </div>
           </div>
         </div>
        <div class="table-responsive">
          <table class="table table-hover table-striped">
            <thead>
              <tr class="active" nowrap>
                <th nowrap>Staff ID</th>
                <th nowrap>Name</th>
                <th nowrap>Role</th>
                <th nowrap>Department</th>
                <th nowrap>Designation</th>
                <th nowrap>Mobile Number</th>
                <th nowrap>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr class="active" v-for="(staff) in staffs" :key="staff.id">
                <td nowrap>{{staff.staff_id}}</td>
                <td nowrap>{{staff.name}}</td>
                <td nowrap>{{staff.role.name}}</td>
                <td nowrap>{{staff.department.department_name}}</td>
                <td nowrap>{{staff.designation.designation_name}}</td>
                <td nowarp>{{staff.phone}}</td>
                <td>
                  <router-link :to="{name: 'viewstaffdirectory', params: { id: staff.id }}">
                    <i class="fa fa-list"></i>
                  </router-link>
                  <router-link :to="{name: 'editstadirectory', params: { id: staff.id }}">
                    <i class="fa fa-pencil pen"></i>
                  </router-link>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        </div>
      </div>
      <div class="stucard-body view" v-else>
        <div v-if="isEmpty == true" class="NoData">No Data</div>
          <div v-else class="row main">
            <div class="imgcard" v-for="(staff) in staffs" :key="staff.id">
              <div class="staffinfo-box">
                <div class="staffleft-box">
                  <img :src="'/staff_images/'+ staff.image" alt v-if="staff.image" />
                  <img v-else src="/noimage.jpg" />
                </div>
                <div class="staffleft-content">
                  <h5>
                    <span
                      data-toggle="tooltip"
                      title="Name"
                      data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"
                    >{{staff.name | truncate(15)}}</span>
                  </h5>
                  <p>{{staff.staff_id}}</p>
                  <p>{{staff.phone}}</p>
                  <p>{{staff.department.department_name | truncate(20)}}</p>
                  <p class="staffsub">
                    <span
                      data-toggle="tooltip"
                      title="Role"
                      data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"
                    >{{staff.role.name | truncate(15)}}</span>
                    <span
                      data-toggle="tooltip"
                      title="Designation"
                      data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"
                    >{{staff.designation.designation_name | truncate(10)}}</span>
                  </p>
                </div>
                <div class="overlay3">
                  <div class="stafficons">
                    <router-link :to="{name: 'viewstaffdirectory', params: { id: staff.id }}">
                      <a title="Show">
                        <i class="fa fa-navicon"></i>
                      </a>
                    </router-link>
                    <router-link :to="{name: 'editstadirectory', params: { id: staff.id }}">
                      <a title="Edit">
                        <i @click="editStaff(staff)" class="fa fa-pencil"></i>
                      </a>
                    </router-link>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { EventBus } from "../../../js/event-bus.js";
import Loading from "../../LoadingController.vue";
export default {
  components: {
    Loading
  },
  data() {
    return {
      view: true,
      search_by_role: "",
      search_by_other: "",
      staffs: [],
      roles: [],
      isEmpty: false
    };
  },
  filters:{
    truncate(value, limit){
      if (value.length > limit) {
      value = value.substring(0, (limit - 3)) + '...';
     }
     return value;
    }
  },
  mounted(){
   EventBus.$emit('onLoad');
  },
  created() {
    EventBus.$emit("ThemeClicked");

    EventBus.$emit("clicked");
    this.getStaffs();
    this.getRoles();
  },
  methods: {
    getStaffs() {
      this.axios.get("/api/staffs").then(response => {
        console.log(JSON.stringify(response.data));
        this.staffs = response.data;
        if(this.staffs.length > 0){
          this.isEmpty = false;
        }
        else{
          this.isEmpty = true;
        }
        EventBus.$emit('onLoadEnd');
      });
    },
    getRoles() {
      this.axios.get("/api/roles").then(response => {
        this.roles = response.data;
      });
    },
    listView() {
      this.view = true;
    },
    detailsView() {
      this.view = false;
    },
    editStaff(data) {},
    searchByRole() {
      if (this.checkValidate()) {
        EventBus.$emit("onLoad");
        this.axios
          .get(`/api/staffdirectory/search_by_role/${this.search_by_role}`)
          .then(response => {
            console.log("-->" + JSON.stringify(response));
            this.staffs = response.data;
            this.isEmpty = false;
            EventBus.$emit("onLoadEnd");
          });
      }
    },
    searchByOther() {
      if (!this.search_by_other) {
        // this.getStaffs();
      } else {
        EventBus.$emit("onLoad");
        this.axios
          .get(`/api/staffdirectory/search_by_other/${this.search_by_other}`)
          .then(response => {
            console.log("-->" + JSON.stringify(response));
            this.staffs = response.data;
            if (response.data.length > 0) {
              this.isEmpty = false;
            } else {
              alert('isempty')
              this.isEmpty = true;
            }
            EventBus.$emit('onLoadEnd');
            this.search_by_other = "";
          });
      }
    },
    /***
     * FORM VALIDATION
     */
    onValidate(value, inputId, megId) {
      if (value == "" || value == undefined)
        document.getElementById(inputId).style.border = "solid 1px red";
      else {
        document.getElementById(inputId).style.border = "solid 1px #d2d6de";
        document.getElementById(megId).style.display = "none";
      }
    },

    onValidateMessage(inputId, megId) {
      document.getElementById(inputId).style.border = "solid 1px red";
      document.getElementById(megId).style.display = "block";
    },
    checkValidate() {
      if (!this.search_by_role) {
        this.onValidateMessage("search_role_id", "search_rolemsg");
        return false;
      } else {
        return true;
      }
      return false;
    },
    goAlertClose() {
      $(".alert").css("display", "none");
    }
  }
};
</script>