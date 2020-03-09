
<template>
  <div id="bar" class="Student" style="transition:all 0.5s;">
    <div class="toplink" style="margin-top:0px">
      <h4 style="color:var(--primary);margin-bottom:5px;">Students</h4>
      <h6>
        <router-link to="/Student">Home</router-link>> Student Admission
      </h6>
    </div>
    <hr />
    <br />
      <Loading></Loading>
    
    <form @submit.prevent="save" enctype="multipart/form-data" >
    <div class="card">
      <!-- Modal start -->
      <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="exampleModalCenter">
  <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content"
        style="background:none;border:none;width:100% !important;padding: 1rem;"
        >
            <div class="card-header">
              <h6 style="width:100%">
                Add Sibling
                <i
                  class="fa fa-times"
                  style="float:right;margin-right:10px;cursor:pointer;padding:5px;"
                  data-dismiss="modal"
                ></i>
              </h6>
            </div>
            <div class="card-body">
              <div class="row">

              <div class="col-md-4 textbox">
                <label for="class">
                  Class
                  <strong>*</strong>
                </label>
                <select id="class" class="inputbox" v-model="sibling_class_id"
                @change="selectSiblingClass($event)"
                >
                  <option selected disabled>Select class</option>
              <option v-for="data in classList" :key="data.id" :value="data.id">
                {{data.class}}
              </option>
                </select>
              </div>
              <div class="col-md-4 textbox">
                <label for="section">
                  Section
                  <strong>*</strong>
                </label>
                <select id="section" class="inputbox" v-model="sibling_section_id"
                @change="selectSiblingSection($event)"
                >
                  <option selected disabled>Select section</option>
                  <option v-for="list in siblingSectionList" :key="list.id" :value="list.id">
                    {{list.section}}
                  </option>
                </select>
              </div>
              <div class="col-md-4 textbox">
                <label for="student">
                  Student
                  <strong>*</strong>
                </label>
                <select id="student" class="inputbox" v-model="sibling_id">
                  <option disabled selected>Select sibling</option>
                  <option v-for="sib in siblings" :key="sib.id" :value="sib.admission_no">
                    {{sib.name}}
                  </option>
                </select>
              </div>
              </div>
              <!-- <div class="row" v-if="siblings">
                <div class="col-md-6 showsib"  v-for="list in studentsiblings" :key="list.id">
                  {{list.name}}
                  <span class="span" @click="removeSiblings()">X</span>
                </div>
              </div> -->
              <div class="table-responsive" v-if="studentsiblings.length >0">
          <table class="table table-hover table-striped" id="studenttable" >
            <thead>
              <tr role="row">
                <th class="all" nowrap>No</th>
                <th class="all" nowrap>Admission Number</th>
                <th class="all" nowrap>Name</th>
                <th class="all" nowrap>Class</th>
                <th class="all" nowrap>Section</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(list,index) in studentsiblings" :key="list.id">
                <td nowrap>{{index+1}}</td>
                <td nowrap>{{list.admission_no}}</td>
                <td nowarp>{{list.name}}</td>
                <td nowarp>{{list.class}}</td>
                <td nowarp>{{list.section}}</td>
              </tr>
            </tbody>
          </table>
              </div>
              <div class="col-12">
                <button class="save" style="text-align:center;margin-bottom:10px;margin-top:-10px;" type="button" @click="saveSibling()" data-dismiss="modal" id="globalSave">Save</button>
              </div>
            </div>
        </div>
      </div>
    </div>
    <!-- ----------------------modal end --------------------------- -->
      <div class="card-header">
        <h6>Student Admission</h6>
      </div>
      <div class="card-body">
        <message :alertmessage="msg" id="savedmsg"/>
  
  <!-- <div v-if="student.image === null">
    <h2>Select an image</h2>
    <input type="file" @change="onFileChange($event)">
  </div>
  <div v-else>
    <img :src="student.image"/>
    <button @click="removeImage">Remove image</button>
  </div> -->
        <div class="row">
          <div class="textbox">
            <label for="admnumber">
              Admission Number
              <strong>*</strong>
            </label>
            <input type="text" id="admnumber" class="inputbox" v-model="student.admission_no"
            @keyup="onValidate(student.admission_no, 'admnumber', 'admission_no_msg')"
            v-on:blur="onValidate(student.admission_no, 'admnumber', 'admission_no_msg')"
             />
            <span id="admission_no_msg" class="error_message">Admission number is required.</span>
          </div>
          <div class="textbox">
            <label for="rollnum">Roll Number</label>
            <input type="text" id="rollnum" class="inputbox"  v-model="student.roll_no"/>
          </div>
          <div class="textbox">
            <label for="stuclass">
              Class
              <strong>*</strong>
            </label>
            <select id="stuclass" class="inputbox" v-model="class_id"
            @keyup="onValidate(class_id, 'stuclass', 'stuclass_msg')"
            v-on:blur="onValidate(class_id, 'stuclass', 'stuclass_msg')"
            @change="selectClass($event)"
            >
              <option selected="selected" disabled>Select class</option>
              <option v-for="list in classList" :key="list.id" :value="list.id">
                {{list.class}}
              </option>
            </select>
            <span id="stuclass_msg" class="error_message">Class is required</span>
          </div>
          <div class="textbox">
            <label for="stuSection">
              Section
              <strong>*</strong>
            </label>
            <select id="stuSection" class="inputbox" v-model="section_id"
            @keyup="onValidate(section_id, 'stuSection', 'section_msg')"
            v-on:blur="onValidate(section_id, 'stuSection', 'section_msg')"
            @change="selectSection($event)"
            >
              <option selected disabled>Select section</option>
              <option v-for="list in sectionList" :key="list.id" :value="list.id">
                {{list.section}}
              </option>
            </select>
            <span id="section_msg" class="error_message">Section is required</span>
          </div>
          <div class="textbox">
            <label for="stuName">
              Name
              <strong>*</strong>
            </label>
            <input type="text" class="inputbox" id="stuName" v-model="student.name"
            @keyup="onValidate(student.name, 'stuName', 'name_msg')"
            v-on:blur="onValidate(student.name, 'stuName', 'name_msg')"
             />
            <span id="name_msg" class="error_message">Name is required.</span>
          </div>
          <div class="textbox">
            <label for="stuGender">
              Gender
              <strong>*</strong>
            </label>
            <select id="stuGender" class="inputbox" v-model="student.gender"
            @keyup="onValidate(student.gender, 'stuGender', 'gender_msg')"
            v-on:blur="onValidate(student.gender, 'stuGender', 'gender_msg')"
            >
              <option value="Male">Male</option>
              <option value="Female">Female</option>
            </select>
            <span id="gender_msg" class="error_message">Gender is required</span>
          </div>
          <div class="textbox">
            <label for="stubirthday">
              Date Of Birth
              <strong>*</strong>
            </label>
                 <datepicker v-model="student.dob"
                 id="stubirthday"
                  @keyup="onValidate(student.dob, 'stubirthday', 'dob_msg')"
                  v-on:blur="onValidate(student.dob, 'stubirthday', 'dob_msg')"
                 ></datepicker>
            
            <span id="dob_msg" class="error_message">Date of birth is required.</span>
          </div>
          <div class="textbox">
            <label for="stuReligion">Religion</label>
            <input type="text" class="inputbox" id="stuReligion" v-model="student.religion"/>
          </div>
          <div class="textbox">
            <label for="stuRace">Race</label>
            <input type="text" class="inputbox" id="stuRace" v-model="student.race" />
          </div>
          <div class="textbox">
            <label for="stuMobile">Mobile Number</label>
            <input type="number" class="inputbox" id="stuMobile" v-model="student.mobileno" />
          </div>
          <div class="textbox">
            <label for="stuEmail">Email</label>
            <input type="text" class="inputbox" id="stuEmail" v-model="student.email"/>
          </div>
          <div class="textbox">
            <label for="admDate">Admission Date</label>
            <!-- <input type="date" class="inputbox" id="admDate" v-model="student.admission_date"/> -->
            <!-- <VueCtkDateTimePicker
              v-model="student.admission_date"
              :only-date="true"
              :color="'#1b5e20'"
              :button-color="'#1b5e20'"
              :auto-close="true"
              :format="'YYYY-MM-DD'"
              :formatted="'YYYY/MM/DD'"
              >
              <input
                  id="admDate"
                  class="inputbox"
                  autocomplete="off"
                />
                </VueCtkDateTimePicker> -->
                <datepicker v-model="student.admission_date" id="admDate"></datepicker>
            <!-- <datepicker v-model="student.admission_date" id="admDate" name="admission_date"></datepicker> -->
          </div>
          <div class="textbox" id="photo">
            
            <label for="stuPhoto">Student Photo</label>
            
              <input type="file" class="inputbox"   id="stuPhoto" @change="onFileChange($event,'student')" accept="image/*" v-if="!student.image">
              <div class="inputbox" v-else>
                <div style="width:100%;padding:0;">
                <img :src="student.student_image" alt="error" style="height: 25px;width: auto;">
                <span @click="removeImage($event,'student')" class="span">X</span>
                </div>
              </div>
              

          </div>
          <div class="textbox">
            <label for="blood">Blood Group</label>
            <select id="blood" class="inputbox" v-model="student.blood_group">
              <option value="A+">A+</option>
              <option value="A-">A-</option>
              <option value="B+">B+</option>
              <option value="B-">B-</option>
              <option value="O+">O+</option>
              <option value="O-">O-</option>
              <option value="AB+">AB+</option>
              <option value="AB-">AB-</option>
            </select>
          </div>
          <div class="textbox">
            <label for="height">Height</label>
            <input type="text" class="inputbox" id="height" v-model="student.height" />
          </div>
          <div class="textbox">
            <label for="weight">Weight</label>
            <input type="text" class="inputbox" id="Weight" v-model="student.weight"/>
          </div>
          <div class="textbox">
            <label for="regDate">Register Date</label>
            <!-- <input type="date" class="inputbox" id="regDate" v-model="student.register_date"/> -->
            <!-- <VueCtkDateTimePicker
                v-model="student.register_date"
                 :only-date="true"
              :color="'#1b5e20'"
              :button-color="'#1b5e20'"
              :auto-close="true"
              :format="'YYYY-MM-DD'"
              :formatted="'YYYY/MM/DD'"
              >
              <input
                  id="regDate"
                  class="inputbox"
                  autocomplete="off"
                />
                </VueCtkDateTimePicker> -->
                <datepicker v-model="student.register_date" id="regDate"></datepicker>
            <!-- <datepicker v-model="student.register_date" id="regDate" name="register_date"></datepicker> -->
          </div>
          <div class="textbox">
            <label for="addSibling" style="visibility:hidden;">Add Sibling</label>
            <button type="button" class="inputbtn" id="addSibling" data-toggle="modal" data-target="#exampleModalCenter">
              <i class="fa fa-plus"></i> Add Sibling
            </button>
          </div>
          <div  v-if="studentsiblings.length>0" class="textbox">
            <label  style="visibility:hidden;">Siblings</label>
                <div class="col-md-11 showsib">
                  {{sibling_name}}
                  <span class="span" style="margin-top:0px;" @click="removeSiblings()">X</span>
                </div>
          </div>
        </div>
      </div>

      <div class="sub-header">
        <h6>Parents Details</h6>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="textbox">
            <label for="faName">Father Name</label>
            <input type="text" class="inputbox" id="faName" v-model="student.father_name" />
          </div>
          <div class="textbox">
            <label for="faPhone">Father Phone</label>
            <input type="number" class="inputbox" id="faPhone" v-model="student.father_phone" />
          </div>
          <div class="textbox">
            <label for="faNrc">Father NRC.</label>
            <input type="text" class="inputbox" id="faNrc" v-model="student.father_nrc" />
          </div>
          <div class="textbox">
            <label for="faJob">Father Job</label>
            <input type="text" class="inputbox" id="faJob" v-model="student.father_job"/>
          </div>
          <div class="textbox">
            <label for="faPhoto">Father Photo</label>
            <input type="file" class="inputbox" @change="onFileChange($event,'father')"   id="faPhoto"  accept="image/*" v-if="!student.father_photo">
              <div class="inputbox" v-else>
                <div style="width:100%;padding:0;">
                <img :src="student.father_image" alt="error" style="height: 25px;width: auto;" v-if="!sibling_id">
                <img :src="'father_image/'+student.father_photo"  style="height: 25px;width: auto;" alt="" v-else>
                <span @click="removeImage($event,'father')" class="span">X</span>
                </div>
              </div>
          </div>
        </div>
        <div class="row">
          <div class="textbox">
            <label for="moName">Mother Name</label>
            <input type="text" class="inputbox" id="moName" v-model="student.mother_name"/>
          </div>
          <div class="textbox">
            <label for="moPhone">Mother Phone</label>
            <input type="number" class="inputbox" id="moPhone" v-model="student.mother_phone"/>
          </div>
          <div class="textbox">
            <label for="moNrc">Mother NRC.</label>
            <input type="text" class="inputbox" id="moNrc" v-model="student.mother_nrc"/>
          </div>
          <div class="textbox">
            <label for="moJob">Mother Job</label>
            <input type="text" class="inputbox" id="moJob" v-model="student.mother_job"/>
          </div>
          <div class="textbox">
            <label for="moPhoto">Mother Photo</label>
            <input type="file" class="inputbox" @change="onFileChange($event,'mother')"   id="moPhoto"  accept="image/*" v-if="!student.mother_photo">
              <div class="inputbox" v-else>
                <div style="width:100%;padding:0;">
                <img :src="student.mother_image" alt="error" style="height: 25px;width: auto;" v-if="!sibling_id">
                <img :src="'mother_image/'+student.mother_photo" alt="error" style="height: 25px;width: auto;" v-else>
                <span @click="removeImage($event,'mother')" class="span">X</span>
                </div>
              </div>
          </div>
          </div>
          <div class="row">
          <div class="col-md-12">
            <span class="span">
              If Guardian is
              <label>
                <strong>*</strong>
              </label>
              <input type="radio" id="father" name="guardian" value="Father" v-model="student.guardian_relation" @click="checkGuardian('father')" />
              <label for="father">Father</label>
              <input type="radio" id="mother" value="Mother" name="guardian" v-model="student.guardian_relation" @click="checkGuardian('mother')"/>
              <label for="mother">Mother</label>
              <input type="radio" id="other" value="Other"  name="guardian" @click="clickOther()" checked/>
              <label for="other">Other</label>
              <!-- <p class="text-danger" v-if="errors.guardian_relation"></p> -->
            </span>
          </div>
        </div>
        <div class="row">
          <div class="textbox">
            <label for="guName">
              Guardian Name
              <strong>*</strong>
            </label>
            <input type="text" class="inputbox" id="guName" v-model="student.guardian_name"
            @keyup="onValidate(student.guardian_name, 'guName', 'guName_msg')"
            v-on:blur="onValidate(student.guardian_name, 'guName', 'guName_msg')"
            />
            <span id="guName_msg" class="error_message">Guardian name is required</span>
          </div>
          <div class="textbox">
            <label for="guNrc">Guardian NRC.</label>
            <input type="text" class="inputbox" id="guNrc" v-model="student.guardian_nrc" />
          </div>
          <div class="textbox">
            <label for="guReligion">Guardian Relation
              <strong>*</strong>
            </label>
            <input type="text" class="inputbox" id="guReligion" v-model="student.guardian_relation"
            @keyup="onValidate(student.guardian_relation, 'guReligion', 'guReligion_msg')"
            v-on:blur="onValidate(student.guardian_relation, 'guReligion', 'guReligion_msg')"
             />
            <span id="guReligion_msg" class="error_message">Guardian relation is required</span>
          </div>
          <div class="textbox">
            <label for="guEmail">Guardian Email</label>
            <input type="email" class="inputbox" id="guEmail" v-model="student.guardian_email" />
          </div>
          
          <div class="textbox">
            <label for="guPhone">
              Guardian Phone
              <strong>*</strong>
            </label>
            <input type="number" class="inputbox" id="guPhone" v-model="student.guardian_phone"
            @keyup="onValidate(student.guardian_phone, 'guPhone', 'guPhone_msg')"
            v-on:blur="onValidate(student.guardian_phone, 'guPhone', 'guPhone_msg')" />
            <span id="guPhone_msg" class="error_message">Guardian phone is required.</span>
          </div>
          <div class="textbox">
            <label for="guJob">Guardian Job</label>
            <input type="text" class="inputbox" id="guJob" v-model="student.guardian_job" />
          </div>
          <div class="textarea">
            <label for="guAddress">Guardian Address</label>
            <textarea id="guAddress" class="inputbox" v-model="student.guardian_address"></textarea>
          </div>
          <div class="textbox">
            <label for="guPhoto">Guardian Photo</label>
            <input type="file" class="inputbox" @change="onFileChange($event,'guardian')"   id="guPhoto"  accept="image/*" v-if="!student.guardian_photo">
              <div class="inputbox" v-else id="showguPhoto">
                <div style="width:100%;padding:0;">
                <img :src="student.guardian_image" alt="error" style="height: 25px;width: auto;" v-if="!sibling_id">
                <img :src="guardian_src+'/'+student.guardian_photo" alt="error" style="height: 25px;width: auto;" v-else>
                <span @click="removeImage($event,'guardian')" class="span">X</span>
                </div>
              </div>
          </div>
        </div>
        </div>
        <div class="breakline"></div>
      <div class="sub-header">
        <h6>
          Add More Information
          <strong
            style="float:right;padding:2px 20px;color:white !important;cursor:pointer;"
            @click="closeOpen()"
            v-if="!addMore"
          >
            <i class="fa fa-plus"></i>
          </strong>
          <strong
            style="float:right;color:white !important;padding:2px 20px;cursor:pointer;"
            @click="closeOpen()"
            v-else-if="addMore"
          >
            <i class="fa fa-minus"></i>
          </strong>
        </h6>
      </div>
      <div class="card-body" style="padding-top: 15px;" id="addMore">
        <div class="card" style="margin: 15px;">
          <div class="card-header">
            <h6>Student Address Details</h6>
          </div>
          <div class="card-body">
            <div class="row">

              <div class="textarea">
                <input type="checkbox" value="GuardianAddress" id="ifgurAdd"  @click="currentAddress"/>
                <label for="ifgurAdd">If Guardian Address Is Current Address</label><br>
                <label for="currentAddress">Current Address</label>
                <textarea id="currentAddress" class="inputbox"  v-model="student.current_address"></textarea>
              </div>
              <div class="textarea">
                <input type="checkbox" value="GuardianAddress" id="ifparAdd"  @click="parementAddress"/>
                <label for="ifparAdd">If Permanent Address Is Current Address</label><br>
                <label for="permanentAddress">Permanent Address</label>
                <textarea id="permanentAddress" class="inputbox" v-model="student.permanent_address"></textarea>
              </div>
            </div>
          </div>
          <div class="sub-header">
            <h6>Transport Details</h6>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="textarea">
                <label for="routelist">Route List</label>
                <select id="routelist" class="inputbox" v-model="student.route_id">
                    <option disabled selected>Select route</option>
                    <option v-for="list in routeList" :key="list.id" :value="list.id" >
                      {{list.route_title}}
                    </option>
                </select>
              </div>
            </div>
          </div>
          <div class="sub-header">
            <h6>Previous School Details</h6>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="textarea">
                <label for="preSchoool">Previous School</label>
                <input type="text" class="inputbox" v-model="student.previous_school" id="preSchoool">
              </div>
              <div class="textarea">
                <label for="preNote">Note</label>
                <textarea class="inputbox" v-model="student.note" id="preNote"></textarea>
              </div>
            </div>
          </div>
          <div class="sub-header">
            <h6>Hostel Details</h6>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="textarea">
                <label for="hostel">Hostel</label>
                <select id="hostel" class="inputbox" v-model="hostel_id" @change="changeHostel($event)">
                  <option selected disabled>Select hostel</option>
                  <option v-for="hostel in hostelList" :key="hostel.id" :value="hostel.id">
                    {{hostel.hostel_name}}
                  </option>
                </select>
              </div>
              <div class="textarea">
                <label for="roomNum">Room Number</label>
                <select class="inputbox" id="roomNum" v-model="student.hostel_room_id">
                  <option selected disabled>Select room number</option>
                 <option v-for="room in rooms" :key="room.id" :value="room.id">
                   {{room.room_no}}
                 </option>
                </select>
              </div>
            </div>
          </div>
          <div class="sub-header">
            <h6>Upload Document</h6>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col1">
                <label>No.</label>
              </div>
              <div class="col2">
                <label>Title</label>
              </div>
              <div class="col3">
                <label>Upload Document</label>
              </div>
              <div class="col4">
                <label>Title</label>
              </div>
              <div class="col5">
                <label>Upload Document</label>
              </div>
            </div>
            <div class="row">
              <div class="col1">
                <label>1</label>
              </div>
              <div class="col2">
                <input type="text" class="inputbox" v-model="title1"  />
              </div>
              <div class="col3">
                <input type="file" class="inputbox" @change="onFileChange($event,'one')" id="file1" />
              </div>
              <div class="col4">
                <input type="text" class="inputbox" v-model="title2" />
              </div>
              <div class="col5">
                <input type="file" class="inputbox" @change="onFileChange($event,'two')" id="file2" />
              </div>
              <div class="col1">
                <label>2</label>
              </div>
              <div class="col2">
                <input type="text" class="inputbox" v-model="title3" />
              </div>
              <div class="col3">
                <input type="file" class="inputbox" @change="onFileChange($event,'three')" id="file3" />
              </div>
              <div class="col4">
                <input type="text" class="inputbox" v-model="title4"/>
              </div>
              <div class="col5">
                <input type="file" class="inputbox" @change="onFileChange($event,'four')" id="file4" />
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="footer" id="footer">
        <button type="submit" class="searchButton">Save</button>
      </div>
      </div>
</form>
      
      </div>
</template>

<script>
import { EventBus } from "../../js/event-bus.js";
import VueCtkDateTimePicker from "vue-ctk-date-time-picker";
import "vue-ctk-date-time-picker/dist/vue-ctk-date-time-picker.css";
import {Util} from '../../js/util';
import message from "../Alertmessage/message.vue";
import Loading from "../LoadingController.vue";
import datepicker from "../datepicker.vue";
export default {
  components: {
    VueCtkDateTimePicker,
    message,
    Loading,
    datepicker
  },
  name:'app',
  success:'',
  data() {
    return {
      sibling_name:'',
      classesList:[],
      num:0,
      guardian_src:'',
      routeList : [],
      msg: {
        text: '',
        type: ''
      },
      session:{},
      hostelList:[],
      rooms:[],
      title1:'',
      document1:'',
      file1:'',

      title2:'',
      document2:'',
      file2:'',

      title3:'',
      document3:'',
      file3:'',

      title4:'',
      document4:'',
      file4:'',
      classList:[],
      sectionList:[],
      sibling_section_id:'',
      sibling_class_id:'',
      
      sibling_id:'',
      student_document:{doObj:[]},
      siblingSectionList:[],
      current:true,
      permanent:true,
      hostel_id:'',
      room_id:'',
      class_id:'',
      section_id:'',
      sibling:{
        'sibling_admission_no':'',
          'admission_no':'',
          'is_active': '', 
          'domain': '',
          'session_id':''
      },
      siblings:[],
      studentsiblings:[],
      student: {
        religion:'',
        roll_no:'',
        height:'',
        weight:'',
        route_id:'',
        student_image:'',
        image:'',
        guardian_job:'',
        guardian_email:'',
        guardian_address:'',
        race:'',
        blood_group:'',
        father_name:'',
        father_phone:'',
        father_nrc:'',
        father_job:'',
        father_image:'',
        father_photo:'',
        mother_name:'',
        mother_phone:'',
        mother_nrc:'',
        mother_job:'',
        mother_image:'',
        mother_photo:'',
        guardian_photo:'',
        mobileno:'',
        email:'',
        // dob: new Date(),
        // admission_date: new Date(),
        // register_date: new Date(),
        dob:new Date().toISOString().slice(0, 10),
        admission_date:new Date().toISOString().slice(0, 10),
        register_date:new Date().toISOString().slice(0, 10),
        current_address:'',
        permanent_address:'',
        class_section_id:'',
        domain:'TS',
        is_active:'yes',
        session_id: '',
        session_start:'2020',
        session_end:'2021',
        disable_at:'',
        note:'',
        previous_school:''
      },
      viladition: false,
      errors: {
        admission_no: '',
        class:'',
        section:'',
        name:'',
        gender:'',
        dob:'',
        guardian_name:'',
        guardian_relation:'Other',
        guardian_phone:'',
      },
      addMore: false,
      guardianRelation: "",

    };
  },
  mounted(){
    EventBus.$emit("onLoad");
  },
  created() {
    this.allData();
    EventBus.$emit("ThemeClicked");
  },
  methods: {
    changeHostel(e){
      var id = e.target.value;
      this.axios
        .get(`/api/student/rooms/${id}`)
        .then(response=>{
          this.rooms = response.data;
        });
    },
    // changeRoomNumber(e){
    //   this.axios
    //   .get(`/api/student/hostelroom/${this.hostel_id}/${e.target.value}`)
    //   .then(response=>{
    //     console.log(JSON.stringify(response));
    //   })
    // },
    
    refreshForm(){
      
      this.title1 ='';
      this.title2 ='';
      this.title3='';
      this.title4 ='';
      this.document1 ='';
      this.document2 ='';
      this.document3='';
      this.document4='';
      this.file1='';
      this.file2='';
      this.file3='';
      this.file4='';
      this.image ='',
      this.father_photo ='',
      this.mother_photo ='',
      this.guardian_photo ='',
      this.classList =[];
      this.sectionList=[];
      this.sibling_class_id='';
      this.sibling_section_id='';
      this.student_document={};
      this.siblingSectionList=[];
      this.current=true;
      this.permanent=true;
      this.hostel_id='';
      this.room_id='';
      this.class_id='';
      this.section_id='';
      this.sibling={
        'sibling_admission_no':'',
          'admission_no':this.student.admission_no,
          'is_active': this.student.is_active, 
          'domain': this.student.domain,
          'session_id':this.student.session_id,
      };
      
      this.siblings=[];
      this.student= {
        roll_no:'',
        height:'',
        weight:'',
        route_id:'',
        student_image:'',
        image:'',
        guardian_job:'',
        guardian_email:'',
        guardian_address:'',
        race:'',
        blood_group:'',
        father_name:'',
        father_phone:'',
        father_nrc:'',
        father_job:'',
        father_image:'',
        father_photo:'',
        mother_name:'',
        mother_phone:'',
        mother_nrc:'',
        mother_job:'',
        mother_image:'',
        mother_photo:'',
        guardian_photo:'',
        // dob: new Date(),
        // admission_date: new Date(),
        // register_date: new Date(),
        dob:new Date().toISOString().slice(0, 10),
        admission_date:new Date().toISOString().slice(0, 10),
        register_date:new Date().toISOString().slice(0, 10),
        current_address:'',
        permanent_address:'',
        class_section_id:'',
        domain:'TS',
        is_active:'yes',
        session_id: '1',
        session_start:'2020-2021',
        session_end:'',
        disable_at:'',
        note:'',
        previous_school:''
      },
        document.getElementById('faName').disabled = false;
        document.getElementById('faPhone').disabled = false;
        document.getElementById('faNrc').disabled = false;
        document.getElementById('faJob').disabled = false;
        document.getElementById('moName').disabled = false;
        document.getElementById('moPhone').disabled = false;
        document.getElementById('moNrc').disabled = false;
        document.getElementById('moJob').disabled = false;
        document.getElementById('guPhone').disabled = false;
        document.getElementById('guNrc').disabled = false;
        document.getElementById('guName').disabled = false;
        document.getElementById('guReligion').disabled = false;
        document.getElementById('guJob').disabled = false;
        document.getElementById('permanentAddress').disabled = false;
        document.getElementById('currentAddress').disabled = false;
        document.getElementById('ifgurAdd').checked = false;
        document.getElementById('ifparAdd').checked = false;
        document.getElementById('other').checked = true;
        $('#file1').val('');
        $('#file2').val('');
        $('#file3').val('');
        $('#file4').val('');
    },
    saveSibling(){

      if(this.sibling_id){
        EventBus.$emit("onLoad");
        this.axios
        .get(`/api/student/addSibling/${this.sibling_id}`)
        .then(response=>{
          this.studentsiblings =response.data;
          this.sibling_name = this.studentsiblings[0].name
          EventBus.$emit("onLoadEnd");
        })
      }
      var data=[];
      if(this.sibling_id){
        this.axios
       .get(`api/student/siblings/${this.sibling_id}`)
       .then(response=>{
        this.studentsiblings = response.data;
        console.log(JSON.stringify(this.siblings));
        data = response.data;
        if(data[0].father_name || data[0].father_phone || data[0].father_nrc || data[0].father_job ||data[0].father_photo || data[0].mother_name ||data[0].mother_phone ||data[0].mother_nrc ||data[0].mother_job ||data[0].mother_photo){
        this.student.father_name = data[0].father_name;
        this.student.father_phone = data[0].father_phone;
        this.student.father_nrc = data[0].father_nrc;
        this.student.father_job = data[0].father_job;
        this.student.father_photo = data[0].father_photo;
        // this.sibling.sibling_admission_no = data[0].admission_no;
        this.student.mother_name = data[0].mother_name;
        this.student.mother_phone = data[0].mother_phone;
        this.student.mother_nrc = data[0].mother_nrc;
        this.student.mother_job = data[0].mother_job;
        this.student.mother_photo = data[0].mother_photo;

        document.getElementById('faName').disabled = true;
        document.getElementById('faPhone').disabled = true;
        document.getElementById('faNrc').disabled = true;
        document.getElementById('faJob').disabled = true;

        document.getElementById('moName').disabled = true;
        document.getElementById('moPhone').disabled = true;
        document.getElementById('moNrc').disabled = true;
        document.getElementById('moJob').disabled = true;
        alert('work');
        }
      })
      }
      
    },
    allData(){
      this.axios
        .get('/api/student')
        .then(response=>{
          this.classesList = response.data.class;
          this.classList = response.data.class;
          this.hostelList = response.data.hostel;
          this.routeList = response.data.routes;
          this.student.session_id = response.data.session[0].id;
          EventBus.$emit("onLoadEnd");
        });
       
    },
    removeSiblings(){
      this.sibling_id='';
      this.sibling_class_id ='';
      this.sibling_section_id ='';
      this.siblingSectionList =[];
      this.siblings =[]
       this.sibling =
        {};
         this.student.father_name = '';
        this.student.father_phone = '';
        this.student.father_nrc = '';
        this.student.father_job = '';
        this.student.father_photo = '';
        this.studentsiblings =[];
        // this.sibling.sibling_admission_no = data[0].admission_no;
        this.student.mother_name = '';
        this.student.mother_phone = '';
        this.student.mother_nrc = '';
        this.student.mother_job = '';
        this.student.mother_photo = '';
        document.getElementById('faName').disabled = false;
        document.getElementById('faPhone').disabled = false;
        document.getElementById('faNrc').disabled = false;
        document.getElementById('faJob').disabled = false;
        document.getElementById('moName').disabled = false;
        document.getElementById('moPhone').disabled = false;
        document.getElementById('moNrc').disabled = false;
        document.getElementById('moJob').disabled = false;
    },
    selectClass(e){
      this.sectionList =[];
      this.section_id ='';
      var id = e.target.value;
      this.sibling_class_id = id;
      this.axios
        .get(`/api/student/section/${id}`)
        .then(response=>{
          this.sectionList = response.data;
        })
    },
    selectSiblingClass(e){
      this.sibling_section_id='';
      var id = e.target.value;
      this.axios
        .get(`/api/student/section/${id}`)
        .then(response=>{
          this.siblingSectionList = response.data;
        })
    },
    selectSection(e){
      var id_section = e.target.value;
      var id_class = this.class_id;
      var array =[];
      this.axios
      .get(`/api/student/class_section/${id_class}/${id_section}`)
      .then(response=>{
        array = response.data;
        this.student.class_section_id = array[0].id;
      })
    },
    selectSiblingSection(e){
      var id_section = e.target.value;
      var id_class = this.sibling_class_id;
      this.axios
      .get(`/api/student/class_section/${id_class}/${id_section}`)
      .then(response=>{
        var array = response.data;
         this.axios
          .get(`api/student/sibling/${array[0].id}`)
          .then(response=>{
            this.siblings = response.data;
          })
      })
    },
    currentAddress(){
      if(this.current == true){
        this.current = false;
        this.student.current_address = this.student.guardian_address;
        document.getElementById('currentAddress').disabled = true;

      }else{
        this.current = true;
        this.student.current_address = '';
        document.getElementById('currentAddress').disabled = false;
      }
    },

    parementAddress(){
      if(this.permanent == true){
        this.permanent = false;
        this.student.permanent_address = this.student.current_address;
        document.getElementById('permanentAddress').disabled = true;

      }else{
        this.permanent = true;
        this.student.permanent_address = '';
        document.getElementById('permanentAddress').disabled = false;
      }
    },

    onFileChange(e,type) {
      if(type=="student"){
        this.student.image_name = e.target.files[0].name;
      }else if(type=="father"){
        this.student.father_photo_name = e.target.files[0].name;
      }else if(type=="mother"){
        this.student.mother_photo_name = e.target.files[0].name;
      }else if(type=='guardian'){
        this.student.guardian_photo_name = e.target.files[0].name;
      }else if(type=='one'){
        this.document1 = e.target.files[0].name;
      }else if(type=='two'){
        this.document2 = e.target.files[0].name;
      }else if(type=='three'){
        this.document3 = e.target.files[0].name;
      }else if(type=='four'){
        this.document4 = e.target.files[0].name;
      }
        var files = e.target.files || e.dataTransfer.files;
        if (!files.length)
        return;
      this.createImage(files[0],type);
    },
    createImage(file,type) {
      var image = new Image();
      var reader = new FileReader();
      var vm = this;

      
        if(type=="student"){
          reader.onload = (e) => {
        vm.student.image = file;
        vm.student.student_image = e.target.result;
          }
      }else if(type=="father"){
         reader.onload = (e) => {
        vm.student.father_photo = file;
        vm.student.father_image = e.target.result;
          }
      }else if(type=="mother"){
         reader.onload = (e) => {
        vm.student.mother_image = e.target.result;
        vm.student.mother_photo = file;
          }
      }else if(type=='guardian'){
         reader.onload = (e) => {
           vm.student.guardian_image = e.target.result;
        vm.student.guardian_photo = file;
          }
      }else if(type=='one'){
         reader.onload = (e) => {
        vm.file1 = file;
          }
      }else if(type=='two'){
         reader.onload = (e) => {
        vm.file2 = file;
          }
      }else if(type=='three'){
         reader.onload = (e) => {
        vm.file3 = file;
          }
      }else if(type=='four'){
         reader.onload = (e) => {
        vm.file4 = file;
          }
      }
      reader.readAsDataURL(file);
    },
    removeImage: function (e,type) {
      if(type=="student"){
       this.student.image = '';
       this.student.image_name='';
      }else if(type=="father"){
        this.student.father_photo = '';
        this.student.father_photo_name='';
      }else if(type=="mother"){
        this.student.mother_photo= '';
        this.student.mother_photo_name='';
      }else if(type=='guardian'){
        this.student.guardian_photo='';
        this.student.guardian_photo_name='';
      }
    },
    closeOpen(){
        if (this.addMore == false) {

          this.addMore = true;
          document.getElementById("footer").style.marginTop = "0";
          document.getElementById('addMore').style.display = "block";
        } else{
          this.addMore = false;
          document.getElementById("footer").style.marginTop = "10px";
          document.getElementById('addMore').style.display = "none";
        }
    },
    formViladition(){
      this.viladition = {};
      this.viladition = true;
      this.errors= {
      };
      
      if(!this.student.admission_no){
        this.onValidationMessage("admnumber", "admission_no_msg");
        this.viladition = false;
      } 
      if(!this.class_id){
        this.onValidationMessage("stuclass", "stuclass_msg");
        this.viladition = false;
      }
       if(!this.section_id){
        this.onValidationMessage("stuSection", "section_msg");
        this.viladition = false;
      }
       if(!this.student.name){
        this.onValidationMessage("stuName", "name_msg");
        this.viladition = false;
      }
       if(!this.student.gender){
        this.onValidationMessage("stuGender", "gender_msg");
        this.viladition = false;
      }
       if(!this.student.dob){
        this.onValidationMessage("stubirthday", "dob_msg");
        this.viladition = false;
      }
       if(!this.student.guardian_name){
        this.onValidationMessage("guName", "guName_msg");
        this.viladition = false;
      }
       if(!this.student.guardian_relation){
        this.onValidationMessage("guReligion", "guReligion_msg");
        this.viladition = false;
      }
       if(!this.student.guardian_phone){
        this.onValidationMessage("guPhone", "guPhone_msg");
        this.viladition = false;
      }
    },
    clickOther(){
      this.student.guardian_name = '';
      this.student.guardian_relation ='';
      this.student.guardian_job = '';
      this.student.guardian_photo = '';
      this.student.guardian_nrc='';
      this.student.guardian_phone = '';
      this.student.guardian_photo_name = '';
      document.getElementById('guPhone').disabled = false;
      document.getElementById('guNrc').disabled = false;
      document.getElementById('guName').disabled = false;
      document.getElementById('guReligion').disabled = false;
      document.getElementById('guJob').disabled = false;
    },
    checkGuardian(type){
      if(type=='mother'){
        this.student.guardian_name = this.student.mother_name;
      this.student.guardian_photo = this.student.mother_photo;
      this.student.guardian_job = this.student.mother_job;
      this.student.guardian_nrc=this.student.mother_nrc;
      this.student.guardian_phone = this.student.mother_phone;
      this.student.guardian_photo_name = this.student.mother_photo_name;
      this.student.guardian_image = this.student.mother_image;
      this.guardian_src = 'mother_image';
      document.getElementById('guPhone').disabled = true;
      document.getElementById('guNrc').disabled = true;
      document.getElementById('guName').disabled = true;
      document.getElementById('guReligion').disabled = true;
      document.getElementById('guJob').disabled = true;
      }else if(type=='father'){
      this.student.guardian_name = this.student.father_name;
      this.student.guardian_photo = this.student.father_photo;
      this.student.guardian_job = this.student.father_job;
      this.student.guardian_nrc=this.student.father_nrc;
      this.student.guardian_phone = this.student.father_phone;
      this.student.guardian_photo_name = this.student.father_photo_name;
      this.student.guardian_image = this.student.father_image;
      this.guardian_src = 'father_image';
      document.getElementById('guPhone').disabled = true;
      document.getElementById('guNrc').disabled = true;
      document.getElementById('guName').disabled = true;
      document.getElementById('guReligion').disabled = true;
      document.getElementById('guJob').disabled = true;
      }
    },
    addStudent(){
      EventBus.$emit("onLoad");
      const config = {
        headers: { "content-type": "multipart/form-data" }
      };
      this.student.hostel_room_id = this.hostel_id;
      this.student.sibling_admission_no = this.sibling_id;
      let formData = new FormData();
      formData.append('admission_no',this.student.admission_no);
      formData.append('name',this.student.name);
      formData.append('image',this.student.image);
      formData.append('image_name',this.student.image_name);
      formData.append('mobileno',this.student.mobileno);
      formData.append('email',this.student.email);
      formData.append('gender',this.student.gender);
      formData.append('dob',this.student.dob);
      formData.append('religion',this.student.religion);
      formData.append('blood_group',this.student.blood_group);
      formData.append('height',this.student.height);
      formData.append('weight',this.student.weight);
      formData.append('roll_no',this.student.roll_no);
      formData.append('class_sections_id',this.student.class_section_id);
      formData.append('admission_date',this.student.admission_date);
      formData.append('register_date',this.student.register_date);
      formData.append('father_name',this.student.father_name);
      formData.append('father_phone',this.student.father_phone);
      formData.append('father_nrc',this.student.father_nrc);
      formData.append('father_job',this.student.father_job);
      formData.append('father_photo',this.student.father_photo);
      formData.append('father_photo_name',this.student.father_photo_name);
      formData.append('mother_name',this.student.mother_name);
      formData.append('mother_phone',this.student.mother_phone);
      formData.append('mother_nrc',this.student.mother_nrc);
      formData.append('mother_job',this.student.mother_job);
      formData.append('mother_photo',this.student.mother_photo);
      formData.append('mother_photo_name',this.student.mother_photo_name);
      formData.append('guardian_name',this.student.guardian_name);
      formData.append('guardian_nrc',this.student.guardian_nrc);
      formData.append('guardian_phone',this.student.guardian_phone);
      formData.append('guardian_job',this.student.guardian_job);
      formData.append('guardian_relation',this.student.guardian_relation);
      formData.append('guardian_email',this.student.guardian_email);
      formData.append('guardian_photo',this.student.guardian_photo);
      formData.append('guardian_photo_name',this.student.guardian_photo_name);
      formData.append('guardian_address',this.student.guardian_address);
      formData.append('current_address',this.student.current_address);
      formData.append('permanent_address',this.student.permanent_address);
      formData.append('previous_school',this.student.previous_school);
      formData.append('route_id',this.student.route_id);
      formData.append('hostel_room_id',this.student.hostel_room_id);
      formData.append('session_id',this.student.session_id);
      formData.append('session_start',this.student.session_start);
      formData.append('session_end',this.student.session_end);
      formData.append('note',this.student.note);
      formData.append('disable_at',this.student.disable_at);
      formData.append('domain',this.student.domain);
      formData.append('is_active',this.student.is_active);
      formData.append('session_id',this.student.session_id);
      formData.append('race',this.student.race);
      formData.append('sibling_admission_no',this.student.sibling_admission_no);
      this.axios
          .post('/api/student/add', formData,config)
          .then(response=> {
            if(response.data =="admission_no"){
              this.msg.text = "Admission number already exists.";
              this.msg.type = 'error';
              Util.workAlert('#savedmsg');
              // Util.scrollToTop()
            }
            else if(response.data =="email"){
              this.msg.text = "Email already exists.";
              this.msg.type = 'error';
              Util.workAlert('#savedmsg');
              // Util.scrollToTop();
            }
            else if(response.data =="phone"){
               this.msg.text = "Phone number already exists.";
              this.msg.type = 'error';
              Util.workAlert('#savedmsg');
              // Util.scrollToTop();
            }
            else{
              this.addSessions();
              this.addSibling();
              this.addDocument();
              this.refreshForm();
              this.allData();
              this.msg.text = "Saved successfully.";
              this.msg.type = 'success';
              Util.workAlert('#savedmsg');
              Util.scrollToTop();
              EventBus.$emit("onLoadEnd");
            }
          })
          .catch(errors=>{
            alert(errors);
          })
          
    },
    addSibling(){
      var sibling={};
      if(this.studentsiblings.length > 0){
        for(let i =0;i<this.studentsiblings.length;i++){
         sibling ={
           'admission_no':this.student.admission_no,
            'sibling_admission_no':this.studentsiblings[i].admission_no,
            'is_active': this.student.is_active,
            'domain' :this.student.domain,
            'session_id':this.student.session_id,
         };
         this.axios
          .post(`/api/studentsiblings/add`,sibling)
          .then(response=>{
            console.log(response.data);
          })
            // console.log(JSON.stringify(this.studentsiblings[0]));
          }
      }
    },
    addSessions(){
      this.session = {
        'session_id':this.student.session_id,
        'admission_no':this.student.admission_no,
        'class_section_id':this.student.class_section_id,
        'route_id':this.student.route_id,
        'hostel_room_id':this.student.hostel_room_id,
        'is_active':this.student.is_active,
        'domain':this.student.domain,
      }
       this.axios
      .post('api/sessions/add',this.session)
      .then(response=>{
      })
      .catch(errors=>{
      })
    },
    addDocument(){
      const config = {
        headers: { "content-type": "multipart/form-data" }
      };
      var fileOne ={};
      var fileTwo ={};
      var fileThree = {};
      var fileFour = {};
      if(this.title1 || this.document1){
        fileOne={
          'admission_no':this.student.admission_no,
          'document_title':this.title1,
          'document_name':this.document1,
          'is_active':this.student.is_active,
          'domain':this.student.domain,
          'file':this.file1,
          'session_id':this.student.session_id,
        }
      }
      if(this.title2||this.document2){
        fileTwo={
          'admission_no':this.student.admission_no,
          'document_title':this.title2,
          'document_name':this.document2,
          'is_active':this.student.is_active,
          'domain':this.student.domain,
          'file':this.file2,
          'session_id':this.student.session_id,
        }
      }
      if(this.title3||this.document3){
      fileThree={
          'admission_no':this.student.admission_no,
          'document_title':this.title3,
          'document_name':this.document3,
          'is_active':this.student.is_active,
          'domain':this.student.domain,
          'file':this.file3,
          'session_id':this.student.session_id,
        }
      }
      if(this.title4||this.document4){
        fileFour={
          'admission_no':this.student.admission_no,
          'document_title':this.title4,
          'document_name':this.document4,
          'is_active':this.student.is_active,
          'domain':this.student.domain,
          'file':this.file4,
          'session_id':this.student.session_id,
        }
      }

      let dataDocument1 = new FormData();
      let dataDocument2 = new FormData();
      let dataDocument3 = new FormData();
      let dataDocument4 = new FormData();
      if(this.title1||this.document1){
        console.log("One");
        dataDocument1.append('admission_no',fileOne.admission_no);
        dataDocument1.append('document_title',fileOne.document_title);
        dataDocument1.append('document_name',fileOne.document_name);
        dataDocument1.append('is_active',fileOne.is_active);
        dataDocument1.append('domain',fileOne.domain);
        dataDocument1.append('file',fileOne.file);
        dataDocument1.append('session_id',fileOne.session_id);
        this.axios
          .post('api/uploaddocuments/add',dataDocument1,config)
          .then(response=>{
        })
      }
      if(this.title2||this.document2){
        console.log("Two");
        dataDocument2.append('admission_no',fileTwo.admission_no);
        dataDocument2.append('document_title',fileTwo.document_title);
        dataDocument2.append('document_name',fileTwo.document_name);
        dataDocument2.append('is_active',fileTwo.is_active);
        dataDocument2.append('domain',fileTwo.domain);
        dataDocument2.append('file',fileTwo.file);
        dataDocument2.append('session_id',fileTwo.session_id);
        this.axios
              .post('api/uploaddocuments/add',dataDocument2,config)
              .then(response=>{
              })
      }
      if(this.title3||this.document3){
        console.log("Three");
        dataDocument3.append('admission_no',fileThree.admission_no);
        dataDocument3.append('document_title',fileThree.document_title);
        dataDocument3.append('document_name',fileThree.document_name);
        dataDocument3.append('is_active',fileThree.is_active);
        dataDocument3.append('domain',fileThree.domain);
        dataDocument3.append('file',fileThree.file);
        dataDocument3.append('session_id',fileThree.session_id);
        this.axios
              .post('api/uploaddocuments/add',dataDocument3,config)
              .then(response=>{
              })
      }
      if(this.title4||this.document4){
        console.log("Four");
        dataDocument4.append('admission_no',fileFour.admission_no);
        dataDocument4.append('document_title',fileFour.document_title);
        dataDocument4.append('document_name',fileFour.document_name);
        dataDocument4.append('is_active',fileFour.is_active);
        dataDocument4.append('domain',fileFour.domain);
        dataDocument4.append('file',fileFour.file);
        dataDocument4.append('session_id',fileFour.session_id);
        this.axios
          .post('api/uploaddocuments/add',dataDocument4,config)
          .then(response=>{
        })
      }
    },
    save(){
      this.formViladition();
      if(this.viladition == true){
        this.addStudent();
      }

      // $('#file1').val('');
      //   $('#file2').val('');
      //   $('#file3').val('');
      //   $('#file4').val('');
      // this.addSibling();
      
    },
    onValidate(value, inputId, megId) {
      if (value == "" || value == undefined)
        document.getElementById(inputId).style.border = "solid 1px red";
      else document.getElementById(inputId).style.border = "solid 1px #d2d6de";
      document.getElementById(megId).style.display = "none";
    },
    onValidationMessage(inputId, megId) {
      document.getElementById(inputId).style.border = "solid 1px red";
      document.getElementById(megId).style.display = "block";
    },
    
   
  }

};

</script>