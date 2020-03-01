<template>
  <div class="form" id="bar">
    <div class="toplink">
      <h2 class="stuName">HRM</h2>
      <h4 class="stuLink" v-if="checkroute == false">
        <router-link to="/home" class="home">Home</router-link>
        <router-link to="/staffdirectory" class="home">> Staff Directory</router-link>> Add Staff Directory
      </h4>
      <h4 class="stuLink" v-else>
        <router-link to="/home" class="home">Home</router-link>
        <router-link to="/staffdirectory" class="home">> Staff Directory</router-link>> Edit Staff Directory
      </h4>
    </div>
    <hr />
    <Loading></Loading>

    <div
      class="alert alert-success"
      role="alert"
    >Staff email is their login username, password is generated automatically and send to staff email. Superadmin can change staff password on their staff profile page.</div>
   
    <message :alertmessage="msg" id="alertmsg" />
   
    <div class="card">

      <form @submit.prevent="addStaffDirectory" enctype="multipart/form-data">
        <div class="card-header">
          <h6>Basic Information</h6>
        </div>
        <div class="card-body">
          <div class="row" id="row">
            <div class="textbox">
              <label for="id">
                Staff ID
                <strong>*</strong>
              </label>
              <input
                id="staff_id"
                @keyup="onValidate(staff.staff_id, 'staff_id', 'staff_idmsg')"
                v-on:blur="onValidate(staff.staff_id, 'staff_id', 'staff_idmsg')"
                v-model="staff.staff_id"
                type="text"
                class="inputbox"
              />
              <span id="staff_idmsg" class="error_message">Staff ID is required</span>
            </div>
            <div class="textbox">
              <label for="Role">
                Role
                <strong>*</strong>
              </label>
              <select
                id="role_id"
                @keyup="onValidate(staff.role_id, 'role_id', 'role_idmsg')"
                v-on:blur="onValidate(staff.role_id, 'role_id', 'role_idmsg')"
                v-model="staff.role_id"
                class="inputbox"
              >
                <option :value="null" selected disabled>Select Role</option>
                <option :value="role.id" v-for="(role) in roles" v-bind:key="role.id">{{role.name}}</option>
              </select>
              <span id="role_idmsg" class="error_message">Role is required</span>
            </div>
            <div class="textbox">
              <label for="Designation">Designation    <strong>*</strong></label>
              <select
                id="designation_id"
                @keyup="onValidate(staff.role_id, 'designation_id', 'designationmsg')"
                v-on:blur="onValidate(staff.role_id, 'designation_id', 'designationmsg')"
                v-model="staff.designation_id"
                class="inputbox"
              >
                <option selected disabled>Select Designation</option>
                <option
                  :value="designation.id"
                  v-for="(designation) in designations"
                  v-bind:key="designation.id"
                >{{designation.designation_name}}</option>
              </select>
              <span id="designationmsg" class="error_message">Designation is required</span>
            </div>
            <div class="textbox">
              <label for="Department">Department    <strong>*</strong></label>
              <select
                id="department_id"
                @keyup="onValidate(staff.department_id, 'department_id', 'departmentmsg')"
                v-on:blur="onValidate(staff.department_id, 'department_id', 'departmentmsg')"
                v-model="staff.department_id"
                class="inputbox"
              >
                <option selected disabled>Select Department</option>
                <option
                  :value="department.id"
                  v-for="(department) in departments"
                  v-bind:key="department.id"
                >{{department.department_name}}</option>
              </select>
              <span id="departmentmsg" class="error_message">Department is required</span>

            </div>
            <div class="textbox">
              <label for="name">
                Name
                <strong>*</strong>
              </label>
              <input
                id="name_id"
                @keyup="onValidate(staff.name, 'name_id', 'namemsg')"
                v-on:blur="onValidate(staff.name, 'name_id', 'namemsg')"
                v-model="staff.name"
                type="text"
                class="inputbox"
              />
              <span id="namemsg" class="error_message">Name is required</span>
            </div>
            <div class="textbox">
              <label for="Father Name">Father Name</label>
              <input v-model="staff.father_name" type="text" class="inputbox" />
            </div>
            <div class="textbox">
              <label for="Mother Name">Mother Name</label>
              <input v-model="staff.mother_name" type="text" class="inputbox" />
            </div>
            <div class="textbox">
              <label for="Email">
                Email
                <strong>*</strong>
              </label>
              <input
                id="email_id"
                @keyup="onValidate(staff.email, 'email_id', 'emailmsg')"
                v-on:blur="onValidate(staff.email, 'email_id', 'emailmsg')"
                v-model="staff.email"
                type="email"
                class="inputbox"
              />
              <span id="emailmsg" class="error_message">Email is required</span>
            </div>
            <div class="textbox">
              <label for="Gender">
                Gender
                <strong>*</strong>
              </label>
              <select
                id="gender_id"
                @keyup="onValidate(staff.gender, 'gender_id', 'gendermsg')"
                v-on:blur="onValidate(staff.gender, 'gender_id', 'gendermsg')"
                v-model="staff.gender"
                class="inputbox"
              >
                <option selected disabled>Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
              <span id="gendermsg" class="error_message">Gender is required</span>
            </div>
            <div class="textbox textbox">
              <label for="dob">
                Date Of Birth
                <strong>*</strong>
              </label>
              <VueCtkDateTimePicker
                v-model="staff.dob"
                :only-date="true"
                :color="'#1b5e20'"
                :button-color="'#1b5e20'"
                :auto-close="true"
                :format="'YYYY/MM/DD'"
                :formatted="'YYYY/MM/DD'"
              >
                <input
                  v-model="staff.dob"
                  @keyup="onValidate(staff.dob, 'dob_id', 'dobmsg')"
                  v-on:blur="onValidate(staff.dob, 'dob_id', 'dobmsg')"
                  class="inputbox"
                  autocomplete="off"
                />
              </VueCtkDateTimePicker>
              <span id="dobmsg" class="error_message">Date Of Birth is required</span>
            </div>
            <div class="textbox">
              <label for="Emergency">Date Of Joining</label>
              <VueCtkDateTimePicker
                v-model="staff.doj"
                :only-date="true"
                :color="'#1b5e20'"
                :button-color="'#1b5e20'"
                :auto-close="true"
                :format="'YYYY/MM/DD'"
               :formatted="'YYYY/MM/DD'"
              >
                <input  class="inputbox" autocomplete="off" :value="staff.doj" />
              </VueCtkDateTimePicker>
            </div>
            <div class="textbox">
              <label for="Phone">Phone</label>
              <input v-model="staff.phone" type="text" class="inputbox" />
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
              <label for="Emergency">Emergency Contact Number</label>
              <input v-model="staff.emergency_contact_no" type="text" class="inputbox" />
            </div>
            <div class="textbox">
              <label for="Marital">Marital Status</label>
              <select v-model="staff.marital_status" class="inputbox">
                <option selected disabled>Select Marital Status</option>
                <option value="Single">Single</option>
                <option value="Married">Married</option>
                <option value="Seperated">Seperated</option>
              </select>
            </div>
            <div class="textbox">
              <label for="Photo">
                Photo
                <strong>*</strong>
              </label>
              <input
                id="image_id"
                @keyup="onValidate(staff.image, 'image_id', 'imagemsg')"
                v-on:blur="onValidate(staff.image, 'image_id', 'imagemsg')"
                v-on:change="onImageChange"
                type="file"
                class="inputbox"
              />
              <span id="imagemsg" class="error_message">Photo is required</span>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
              <label for="Current">Current Address</label>
              <textarea v-model="staff.current_address" rows="2" class="textareas"></textarea>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
              <label for="Permanent">Permanent Address</label>
              <textarea v-model="staff.permanent_address" rows="2" class="textareas"></textarea>
            </div>
            <div class="textbox">
              <label for="Qualification">Qualification</label>
              <textarea v-model="staff.qualification" rows="2" class="textareas"></textarea>
            </div>
            <div class="textbox">
              <label for="Experience">Work Experience</label>
              <textarea v-model="staff.work_exp" rows="2" class="textareas"></textarea>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
              <label for="Note">Note</label>
              <textarea v-model="staff.note" rows="2" class="textareas"></textarea>
            </div>
          </div>
        </div>
        <div class="sub-header">
          <h6>
            Add More Details
            <strong
              style="float:right;padding:2px 20px;color:white !important;cursor:pointer;"
              @click="openClose()"
              v-if="!addMore"
            >
              <i class="fa fa-plus"></i>
            </strong>
            <strong
              style="float:right;color:white !important;padding:2px 20px;cursor:pointer;"
              @click="openClose()"
              v-else
            >
              <i class="fa fa-minus"></i>
            </strong>
          </h6>
        </div>
        <div class="card-body" style="padding-top: 15px;" v-if="addMore===true">
          <!-- 
          <div class="sub-header">
            <h6>Payroll</h6>
          </div>
          <div class="card-body">
            <div class="row" id="row">
              <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <label for="epf">
                  EPF No
                  <strong>*</strong>
                </label>
                <input v-model="staff.epf_no" type="text" class="inputbox" />
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <label for="Salary">
                  Basic Salary
                  <strong>*</strong>
                </label>
                <input v-model="staff.basic_salary" type="text" class="inputbox" />
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <label for="contract">Contract Type</label>
                <select v-model="staff.contract_type" class="inputbox" name="class">
                  <option selected disabled>Select Contract Type</option>
                  <option value="Permanent">Permanent</option>
                  <option value="Probation">Probation</option>
                </select>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <label for="Shift">
                  Work Shift
                  <strong>*</strong>
                </label>
                <input v-model="staff.work_shift" type="text" class="inputbox" name="name" />
              </div>
              <div class="col-lg-4 col-12">
                <label for="Location">
                  Location
                  <strong>*</strong>
                </label>
                <input v-model="staff.location" type="text" class="inputbox" name="name" />
              </div>
            </div>
          </div>
          <div class="sub-header">
            <h6>Leaves</h6>
          </div>
          <div class="card-body">
            <div class="row" id="row">
              <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <label for="medical">Medical Leave</label>
                <input v-model="staff.medical_leave" type="text" class="inputbox" name="name" />
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <label for="casual">Casual Leave</label>
                <input v-model="staff.casual_leave" type="text" class="inputbox" name="name" />
              </div>
              <div class="col-lg-4 col-12">
                <label for="maternity">Maternity Leave</label>
                <input v-model="staff.maternity_leave" type="text" class="inputbox" name="name" />
              </div>
            </div>
          </div>
          <div class="sub-header">
            <h6>Bank Account Details</h6>
          </div>
          <div class="card-body">
            <div class="row" id="row">
              <div class="textbox">
                <label for="Account">Account Title</label>
                <input v-model="staff.account_title" type="text" class="inputbox" name="name" />
              </div>
              <div class="textbox">
                <label for="bankNumber">Bank Account Number</label>
                <input v-model="staff.bank_account_no" type="text" class="inputbox" name="name" />
              </div>
              <div class="textbox">
                <label for="ifsc">IFSC Code</label>
                <input v-model="staff.ifsc_code" type="text" class="inputbox" name="name" />
              </div>
              <div class="textbox">
                <label for="branch">Bank Branch Name</label>
                <input v-model="staff.bank_branch_name" type="text" class="inputbox" name="name" />
              </div>
            </div>
          </div>
          <div class="sub-header">
            <h6>Social Media Link</h6>
          </div>
          <div class="card-body">
            <div class="row" id="row">
              <div class="textbox">
                <label for="Facebook">Facebook URL</label>
                <input v-model="staff.facebook" type="text" class="inputbox" name="name" />
              </div>
              <div class="textbox">
                <label for="Twitter">Twitter URL</label>
                <input v-model="staff.twitter" type="text" class="inputbox" name="name" />
              </div>
              <div class="textbox">
                <label for="Linkedin">Linkedin URL</label>
                <input v-model="staff.linkedin" type="text" class="inputbox" name="name" />
              </div>
              <div class="textbox">
                <label for="Instagram">Instagram URL</label>
                <input v-model="staff.instagram" type="text" class="inputbox" name="name" />
              </div>
            </div>
          </div>
          -->
          <div class="sub-header">
            <h6>Upload Documents</h6>
          </div>
          <div class="card-body" style="font-size:10pt;">
            <div class="row">
              <div class="col-lg-6 col-md-12 col-12">
                <table class="table">
                  <tbody>
                    <tr class="col-12">
                      <th class="all" nowrap style="width: 10px">#</th>
                      <th class="all" nowrap>Title</th>
                      <th class="all" nowrap>Documents</th>
                    </tr>
                    <tr>
                      <th class="all" nowrap>1</th>
                      <th class="all" nowrap>Resume</th>
                      <th class="all" nowrap>
                        <input type="file" v-on:change="onFileChange1" class="inputbox" />
                      </th>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-lg-6 col-md-12 col-12">
                <table class="table">
                  <tbody>
                    <tr class="col-12">
                      <th class="all" nowrap style="width: 10px">#</th>
                      <th class="all" nowrap>Title</th>
                      <th class="all" nowrap>Documents</th>
                    </tr>
                    <tr>
                      <th class="all" nowrap>2</th>
                      <th class="all" nowrap>Joining Letter</th>
                      <th class="all" nowrap>
                        <input v-on:change="onFileChange2" type="file" class="inputbox" />
                      </th>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-lg-6 col-md-12 col-12">
                <table class="table">
                  <tbody>
                    <tr class="col-12">
                      <th class="all" nowrap style="width: 10px">#</th>
                      <th class="all" nowrap>Title</th>
                      <th class="all" nowrap>Documents</th>
                    </tr>
                    <tr>
                      <th class="all" nowrap>3</th>
                      <th class="all" nowrap>Other Documents</th>
                      <th class="all" nowrap>
                        <input v-on:change="onFileChange3" type="file" class="inputbox" />
                      </th>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <button v-if="checkroute == false" type="submit" class="save">Save</button>
        <button v-else @click="updateStaffDirectory()" type="button" class="save">Save</button>
      </form>
      <br />
    </div>
  </div>
</template>
<script>
// import Datepicker from "vuejs-datepicker";
import VueCtkDateTimePicker from "vue-ctk-date-time-picker";
import "vue-ctk-date-time-picker/dist/vue-ctk-date-time-picker.css";
import Loading from "../../LoadingController.vue";
import { EventBus } from "../../../js/event-bus.js";
import { Util } from "../../../js/util";
import message from "../../Alertmessage/message.vue";

export default {
  components: {
    VueCtkDateTimePicker,
    Loading,
    message
  },
  data() {
    return {
      staff: {
        staff_id : '',
        role_id  : '',
        designation_id: '',
        department_id: '',
        name : '',
        father_name: '',
        mother_name: '',
        email: '',
        gender: '',
        dob: '',
        phone: '',
        energency_contact_no: '',
        marital_status: '',
        image: '',
        current_address: '',
        permanent_address: '',
        qualification: '',
        work_exp: '',
        note: '',
        password: '',
      },
    
      staffDirectorys: [],
      roles: [],
      designations: [],
      departments: [],
      addMore: false,
      checkroute: false,
         msg: {
        text: "",
        type: ""
      },
    };
  },
  mounted() {
  },
  created() {
    EventBus.$emit("ThemeClicked");
    console.log(this.$route.path);
    if (this.$route.path == "/stadirectory/edit"){
      this.checkroute = true;
    }
    this.axios
      .get(`/api/staffdirectory/edit/${this.$route.params.id}`)
      .then(response => {
        this.model = response.data;
        console.log("Staff" + JSON.stringify(response));
      });
    this.getRoles();
    this.getDesignations();
    this.getDepartments();

      
  },
  methods: {
    getRoles() {
      this.axios.get("/api/roles").then(response => {
        this.roles = response.data;
      });
    },
    getDesignations() {
      this.axios.get("/api/designations").then(response => {
        this.designations = response.data;
      });
    },
    getDepartments() {
      this.axios.get("/api/departments").then(response => {
        this.departments = response.data;
      });
    },
    openClose() {
      if (this.addMore == false) {
        this.addMore = true;
      } else {
        this.addMore = false;
      }
      console.log(this.addMore);
    },
    getStaffDirectory() {
      this.axios.get("/api/staffdirectorys").then(response => {
        this.staffDirectorys = response.data;
      });
    },
    onImageChange(e) {
      console.log(e.target.files[0]);
      this.staff.image = e.target.files[0];
    },
    onFileChange1(e) {
      this.staff.resume = e.target.files[0];
    },
    onFileChange2(e) {
      this.staff.joining_letter = e.target.files[0];
    },
    onFileChange3(e) {
      this.staff.other_document = e.target.files[0];
    },
    addStaffDirectory(e){
      alert(this.staff.mother_name);
      if (this.checkValidate()) {
        EventBus.$emit("onLoad");
        (this.staff.dob = new Date().toISOString().slice(0, 10)),
          e.preventDefault();
        let currentObj = this;
        const config = {
          headers: { "content-type": "multipart/form-data" }
        };
        
        let formData = new FormData();
        formData.append("staff_id", this.staff.staff_id);
        formData.append("role_id", this.staff.role_id);
        formData.append("designation_id", this.staff.designation_id);
        formData.append("department_id", this.staff.department_id);
        formData.append("name", this.staff.name);
        formData.append("father_name", this.staff.father_name);
        formData.append("mother_name", this.staff.mother_name);
        formData.append("email", this.staff.email);
        formData.append("gender", this.staff.gender);
        formData.append("dob", this.staff.dob);
        formData.append("phone", this.staff.phone);
        formData.append(
          "emergency_contact_no",
          this.staff.emergency_contact_no
        );
        formData.append("marital_status", this.staff.marital_status);
        formData.append("image", this.staff.image);
        formData.append("current_address", this.staff.current_address);
        formData.append("permanent_address", this.staff.permanent_address);
        formData.append("qualification", this.staff.qualification);
        formData.append("work_exp", this.staff.work_exp);
        formData.append("note", this.staff.note);
        formData.append("password", this.staff.password);
        formData.append("epf_no", this.staff.epf_no);
        formData.append("basic_salary", this.staff.basic_salary);
        formData.append("contract_type", this.staff.contract_type);
        formData.append("work_shift", this.staff.work_shift);
        formData.append("location", this.staff.location);
        formData.append("medical_leave", this.staff.medical_leave);
        formData.append("casual_leave", this.staff.casual_leave);
        formData.append("maternity_leave", this.staff.maternity_leave);
        formData.append("account_title", this.staff.account_title);
        formData.append("bank_account_no", this.staff.bank_account_no);
        formData.append("ifsc_code", this.staff.ifsc_code);
        formData.append("bank_branch_name", this.staff.bank_branch_name);
        formData.append("facebook", this.staff.facebook);
        formData.append("twitter", this.staff.twitter);
        formData.append("instagram", this.staff.instagram);
        formData.append("linkedin", this.staff.linkedin);
        formData.append("resume", this.staff.resume);
        formData.append("joining_letter", this.staff.joining_letter);
        formData.append("other_document", this.staff.other_document);
        formData.append("location", this.staff.location);
        formData.append("date_of_joining", this.staff.doj);
        this.axios
          .post("/api/staffdirectory/store", formData, config)
          .then(response => {
            this.getStaffDirectory();
            this.msg.text = response.data.text;
            this.msg.type = response.data.type;
            Util.workAlert("#alertmsg");
            EventBus.$emit("onLoadEnd");
            Util.scrollToTop();
            if (response.data) {
          
            } else {
              this.model = {};
            }
          })
          .catch(error => console.log(error));
      }
    },
    updateStaffDirectory(e) {
      if (this.checkValidate()) {
        this.staff.dob = new Date().toISOString().slice(0, 10);
        // e.preventDefault();
        let currentObj = this;
        const config = {
          headers: { "content-type": "multipart/form-data" }
        };
        let formData = new FormData();
        formData.append("staff_id", this.staff.staff_id);
        formData.append("role_id", this.staff.role_id);
        formData.append("designation_id", this.staff.designation_id);
        formData.append("department_id", this.staff.department_id);
        formData.append("name", this.staff.name);
        formData.append("father_name", this.staff.father_name);
        formData.append("mother_name", this.staff.mother_name);
        formData.append("email", this.staff.email);
        formData.append("gender", this.staff.gender);
        formData.append("dob", this.staff.dob);
        formData.append("phone", this.staff.phone);
        formData.append(
          "emergency_contact_no",
          this.staff.emergency_contact_no
        );
        formData.append("marital_status", this.staff.marital_status);
        formData.append("image", this.staff.image);
        formData.append("current_address", this.staff.current_address);
        formData.append("permanent_address", this.staff.permanent_address);
        formData.append("qualification", this.staff.qualification);
        formData.append("work_exp", this.staff.work_exp);
        formData.append("note", this.staff.note);
        formData.append("password", this.staff.password);
        formData.append("epf_no", this.staff.epf_no);
        formData.append("basic_salary", this.staff.basic_salary);
        formData.append("contract_type", this.staff.contract_type);
        formData.append("work_shift", this.staff.work_shift);
        formData.append("location", this.staff.location);
        formData.append("medical_leave", this.staff.medical_leave);
        formData.append("casual_leave", this.staff.casual_leave);
        formData.append("maternity_leave", this.staff.maternity_leave);
        formData.append("account_title", this.staff.account_title);
        formData.append("bank_account_no", this.staff.bank_account_no);
        formData.append("ifsc_code", this.staff.ifsc_code);
        formData.append("bank_branch_name", this.staff.bank_branch_name);
        formData.append("facebook", this.staff.facebook);
        formData.append("twitter", this.staff.twitter);
        formData.append("instagram", this.staff.instagram);
        formData.append("linkedin", this.staff.linkedin);
        formData.append("resume", this.staff.resume);
        formData.append("joining_letter", this.staff.joining_letter);
        formData.append("other_document", this.staff.other_document);
        formData.append("location", this.staff.location);
        formData.append("date_of_joining", this.staff.doj);
        this.axios
          .post(
            `/api/staffdirectory/update/${this.$route.params.id}`,
            formData,
            config
          )
          .then(response => {
            console.log("-->" + JSON.stringify(response));

            this.$router.push({ name: "staffdirectory" });
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
      if (!this.staff.staff_id) {
        this.onValidateMessage("staff_id", "staff_idmsg");
        return false;
      }
      if (!this.staff.role_id) {
        this.onValidateMessage("role_id", "role_idmsg");
        return false;
      }
      if (!this.staff.designation_id) {
        this.onValidateMessage("designation_id", "designationmsg");
        return false;
      }
      if (!this.staff.department_id) {
        this.onValidateMessage("department_id", "departmentmsg");
        return false;
      }
      if (!this.staff.name) {
        this.onValidateMessage("name_id", "namemsg");
        return false;
      }
      if (!this.staff.email) {
        this.onValidateMessage("email_id", "emailmsg");
        return false;
      }
      if (!this.staff.gender) {
        this.onValidateMessage("gender_id", "gendermsg");
        return false;
      }
      if (!this.staff.dob) {
        this.onValidateMessage("dob_id", "dobmsg");
        return false;
      }
      if (!this.staff.image) {
        this.onValidateMessage("image_id", "imagemsg");
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