<template>
  <div class="form systemsetting" id="bar">
    <div class="toplink">
      <h2 class="stuName">System Settings</h2>
      <h4 class="stuLink">
        <router-link to="/home" class="home">Home</router-link>> General Setting
      </h4>
    </div>
    <div
      class="modal fade"
      id="schoolDetails"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true"
    >
      <div
        class="modal-dialog modal-dialog-centered settingModal"
        style="max-width: 100%;"
        role="document"
      >
        <div
          class="modal-content"
          style="background:none;border:none;width:100% !important;padding: 1rem;"
        >
          <div class="modalCard" style="background:none;border:none;">
            <div class="card-header" id="globalcardHeader">
              <h6>System Settings</h6>
              <i
                class="fa fa-close"
                style="position:absolute;right: 45px;cursor:pointer;"
                data-dismiss="modal"
                id="close"
              ></i>
            </div>
            <div class="card-body modal-bodys" id="globalcardBody">
              <div class="row" id="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                  <div class="setting">
                    <label for="Name">
                      School Name
                      <strong>*</strong>
                    </label>
                    <input
                      type="text"
                      id="schoolid"
                      v-model="school.school_name"
                      class="inputbox"
                      @keyup="onValidate(school.school_name, 'schoolid', 'schoolmsg')"
                      v-on:blur="onValidate(school.school_name, 'schoolid', 'schoolmsg')"
                    />
                    <span id="schoolmsg" class="error_message">School Name is required</span>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                  <div class="setting">
                    <label for="Code">School Code</label>
                    <input type="text" v-model="school.school_code" class="inputbox" />
                  </div>
                </div>
                <div class="col-12">
                  <div class="setting">
                    <label for="Address">
                      Address
                      <strong>*</strong>
                    </label>
                    <textarea
                      rows="2"
                      id="addressid"
                      v-model="school.address"
                      autocomplete="off"
                      class="textareas"
                      @keyup="onValidate(school.address, 'addressid', 'addressmsg')"
                      v-on:blur="onValidate(school.address, 'addressid', 'addressmsg')"
                    ></textarea>
                    <span class="error_message" id="addressmsg">Address is required</span>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                  <div class="setting">
                    <label for="Phone">
                      Phone
                      <strong>*</strong>
                    </label>
                    <input
                      type="number"
                      id="phoneid"
                      v-model="school.phone"
                      class="inputbox"
                      @keyup="onValidate(school.phone, 'phoneid', 'phonemsg')"
                      v-on:blur="onValidate(school.phone, 'phoneid', 'phonemsg')"
                    />
                    <span class="error_message" id="phonemsg">Phone is required</span>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                  <div class="setting">
                    <label for="Email">
                      Email
                      <strong>*</strong>
                    </label>
                    <input
                      type="email"
                      id="emailid"
                      v-model="school.email"
                      class="inputbox"
                      @keyup="onValidate(school.email, 'emailid', 'emailmsg')"
                      v-on:blur="onValidate(school.email, 'emailid', 'emailmsg')"
                    />
                    <span class="error_message" id="emailmsg">Email is required</span>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                  <div class="setting">
                    <label for="Session">
                      Session
                      <strong>*</strong>
                    </label>
                    <select class="inputbox" v-model="school.session" name="class">
                      <option selected disabled>Select Session</option>
                      <option v-for="session in sessions" :key="session.id">{{session.session}}</option>
                    </select>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                  <div class="setting">
                    <label for="Month">
                      Session Start Month
                      <strong>*</strong>
                    </label>
                    <select class="inputbox" v-model="school.session_month" name="class">
                      <option selected disabled>Select Month</option>
                      <option value="June">June</option>
                      <option value="July">July</option>
                      <option value="August">August</option>
                    </select>
                  </div>
                </div>
                <div class="col-lg-6 col-md-12 col-12">
                  <div class="setting">
                    <label for="Language">
                      Language
                      <strong>*</strong>
                    </label>
                    <select class="inputbox" v-model="school.language" name="class">
                      <option selected disabled>Select Languages</option>
                      <option value="Myanmar">Myanmar</option>
                      <option value="English">English</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="Theme">
                <div class="curTheme">
                  <b>Current Theme</b>
                </div>
                <div class="row" id="ThemeColor">
                  <div class="col-md-3 col-sm-6 col-xs-6 col-12">
                    <div class="blockColor" @click="changeTheme('defaultColor')">
                      <div class="backColor" id="default" style="background:#1b5e20;">
                        <i class="fa fa-check-circle circle" id="defaultCircle"></i>
                        <p class="default" id="defaultText">Default</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3 col-sm-6 col-xs-6 col-12">
                    <div class="blockColor" @click="changeTheme('redColor')">
                      <div class="backColor" id="red" style="background:darkred;">
                        <i class="fa fa-check-circle circle" id="redCircle"></i>
                        <p class="default" id="redText">Red</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3 col-sm-6 col-xs-6 col-12">
                    <div class="blockColor" @click="changeTheme('blueColor')">
                      <div class="backColor" id="blue" style="background:darkcyan;">
                        <i class="fa fa-check-circle circle" id="blueCircle"></i>
                        <p class="default" id="blueText">Blue</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3 col-sm-6 col-xs-6 col-12">
                    <div class="blockColor" @click="changeTheme('darkColor')">
                      <div class="backColor" id="dark" style="background:currentColor;">
                        <i class="fa fa-check-circle circle" id="darkCircle"></i>
                        <p class="default" id="darkText">Dark</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3 col-sm-6 col-xs-6 col-12">
                    <div class="blockColor" @click="changeTheme('lightColor')">
                      <div class="backColor" id="light" style="background:#edeeef;">
                        <i class="fa fa-check-circle circle" id="lightCircle" style="color:black;"></i>
                        <p class="default" id="lightText" style="color:black;">Light</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-12">
                    <button
                      class="save"
                      id="globalSave"
                      @click="themeColor()"
                      style="margin:5px 0 1rem 0;"
                    >Save</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div
      class="modal fade"
      id="profileModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="width:500px !important;">
          <div class="modal-body" style="padding:0;">
            <div class="card-header" id="globalcardHeader" style="width: 100%;margin-left: 0;">
              <h6>Edit Logo</h6>
              <i
                class="fa fa-close"
                data-dismiss="modal"
                style="cursor: pointer;padding: 0 10px;position: absolute;right: 5px;"
              ></i>
            </div>
            <form @submit.prevent="Preview_image($event)">
              <div
                style="justify-content: center;padding: 20px;height: 245px;display: flex;margin: 1rem 0;"
              >
                <div style="width: 80%;height: 80%;border: 1px dotted #7c98fd;margin-top: 1rem;">
                  <i
                    class="fa fa-image"
                    v-if="noImage"
                    style="margin: 5px 0px 1px 3px;width: 90%;zoom: 5;display: flex;justify-content: center;"
                  ></i>
                  <h3 v-if="noImage" style="font-size: 13pt;text-align: center;">Pick Your Images</h3>
                  <input
                    type="file"
                    id="upload"
                    title="Profile Images"
                    @change="Preview_image($event)"
                    style="position: absolute;top: 3rem;z-index: 1;margin-top: 1rem;height: 57%;opacity: 0;cursor: auto;"
                  />
                </div>
                <img
                  :src="'SettingImages/'+school.schoollogo"
                  id="schoolLogo"
                  v-if="!noImage"
                  style="margin-top: 1.4rem;position: absolute;height: 52%;width: 70%;z-index: 0;"
                />
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <hr />

    <div class="row rowContainer" style="align-items: end !important;margin:0;margin-top: -1rem;">
      <div class="col-lg-4 col-12" style="padding:5px;">
        <div class="card" id="globalCard">
          <div class="card-header" id="globalcardHeader">
            <h6>Edit Logo</h6>
          </div>
          <div class="card-body imgCard" style="padding:1rem;" id="globalcardBody">
            <div class="col-12 img">
              <img
                accept="images/*"
                style="border-radius:5px;"
                :src="'SettingImages/'+school.schoollogo"
              />
            </div>
            <div class="col-12 button" style="display: flex;">
              <button class="edit" data-toggle="modal" data-target="#profileModal" id="globalEdit">
                <i class="fa fa-floppy-o editIcon" aria-hidden="true"></i>Edit Logo
              </button>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-8 col-12" style="padding:5px;">
        <div class="card" id="globalCard">
          <div class="card-header editCard" id="globalcardHeader">
            <h6>General Setting</h6>
            <button
              class="editSm"
              @click="getData()"
              data-toggle="modal"
              data-target="#schoolDetails"
            >Edit</button>
          </div>
          <div class="card-body tableCard" id="globalcardBody">
            <div class="table-responsive mailbox-messages">
              <table class="table table-hover">
                <tbody>
                  <tr>
                    <td class="all" nowrap>
                      <b>School Name</b>
                    </td>
                    <td class="all" nowrap>{{this.school.school_name}}</td>
                  </tr>
                  <tr>
                    <td class="all" nowrap>
                      <b>Address</b>
                    </td>
                    <td class="all" nowrap>{{this.school.address}}</td>
                  </tr>
                  <tr>
                    <td class="all" nowrap>
                      <b>Phone</b>
                    </td>
                    <td class="all" nowrap>{{this.school.phone}}</td>
                  </tr>
                  <tr>
                    <td class="all" nowrap>
                      <b>Email</b>
                    </td>
                    <td class="all" nowrap>{{this.school.email}}</td>
                  </tr>
                  <tr>
                    <td class="all" nowrap>
                      <b>School Code</b>
                    </td>
                    <td class="all" nowrap>{{this.school.school_code}}</td>
                  </tr>
                  <tr>
                    <td class="all" nowrap>
                      <b>Session</b>
                    </td>
                    <td class="all" nowrap>{{this.school.session}}</td>
                  </tr>
                  <tr>
                    <td class="all" nowrap>
                      <b>Session Start Month</b>
                    </td>
                    <td class="all" nowrap>{{this.school.session_month}}</td>
                  </tr>
                  <tr>
                    <td class="all" nowrap>
                      <b>Language</b>
                    </td>
                    <td class="all" nowrap>{{this.school.language}}</td>
                  </tr>
                  <tr>
                    <td class="all" nowrap>
                      <b>Current Theme</b>
                    </td>
                    <td class="all row" style="padding: 0;margin: 0;" nowrap>
                      <span class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="themeBlock block1" style="background:#1b5e20;"></div>
                        <label for="default">Default</label>
                      </span>
                      <span class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="themeBlock block2" style="background:darkred;"></div>
                        <label for="theme1">Theme 1</label>
                      </span>
                      <span class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="themeBlock block3" style="background:darkcyan;"></div>
                        <label for="theme2">Theme 2</label>
                      </span>
                      <span class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="themeBlock block4" style="background:black;"></div>
                        <label for="theme3">Theme 3</label>
                      </span>
                      <span class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="themeBlock block5" style="background:whitesmoke;"></div>
                        <label for="theme4">Theme 4</label>
                      </span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { EventBus } from "../../js/event-bus.js";
import { Util } from "../../js/util";
export default {
  data() {
    return {
      color: "",
      colors: [],
      passColor: [],
      sessions: [],
      school: {},
      dismiss: false,
      noImage: false
    };
  },
  mounted() {
    EventBus.$emit("ThemeClicked");
  },
  created() {
    this.axios.get("/api/color").then(response => {
      this.colors = response.data;
    });
    this.axios.get("/api/schools").then(response => {
      this.school = response.data;
    });
    this.axios.get("/api/academicyr").then(response => {
      this.sessions = response.data;
    });
  },
  methods: {
    Preview_image(event) {
      var reader = new FileReader();
      reader.readAsDataURL(event.target.files[0]);
      this.school.schoollogo = event.target.files[0];
      if (this.school.schoollogo.size > 150000) {
        alert(
          `Sorry, Your File Size ${this.school.schoollogo.size} Greater than 1.5MB`
        );
        this.noImage = true;
        this.axios.get("/api/schools").then(response => {
          this.school = response.data;
        });
      } else {
        reader.onload = function() {
          var output = document.getElementById("schoolLogo");
          output.src = reader.result;
        };
        const config = {
          headers: { "content-type": "multipart/form-data" }
        };
        let formData = new FormData();
        formData.append("schoollogo", this.school.schoollogo);
        this.axios
          .post(`/api/school/updatePhoto/${this.school.id}`, formData, config)
          .then(response => {
            this.school = response.data;
            $("#profileModal").modal("hide");
            window.location = window.location.href;
          });
        console.log(this.school.schoollogo.size);
      }
    },
    changeTheme(id) {
      if (id == "defaultColor") {
        this.color = id;
        this.defaultColor();
      } else if (id == "redColor") {
        this.color = id;
        this.redColor();
      } else if (id == "blueColor") {
        this.color = id;
        this.blueColor();
      } else if (id == "darkColor") {
        this.color = id;
        this.darkColor();
      } else if (id == "lightColor") {
        this.color = id;
        this.lightColor();
      }
    },
    focusTheme() {
      if (this.passColor.color == "defaultColor") {
        this.defaultColor();
      } else if (this.passColor.color == "redColor") {
        this.redColor();
      } else if (this.passColor.color == "blueColor") {
        this.blueColor();
      } else if (this.passColor.color == "darkColor") {
        this.darkColor();
      } else if (this.passColor.color == "lightColor") {
        this.lightColor();
      }
    },
    getColors() {
      this.axios.get("/api/color").then(response => {
        this.colors = response.data;
      });
      this.axios.get("/api/schools").then(response => {
        this.school = response.data;
      });
      this.axios.get("/api/academicyr").then(response => {
        this.sessions = response.data;
      });
    },
    themeColor() {
      if (this.checkValidate()) {
        if (this.passColor.id == "1") {
          this.axios
            .post(`api/school/update/${this.school.id}`, this.school)
            .then(response => {
              window.location = window.location.href;
            });
          this.axios.post(`api/setting/update/${this.color}`);
        }
      }
    },
    getData() {
      this.getColors();
      for (var i = 0; i < this.colors.length; i++) {
        if (this.colors[i].id == "1") {
          this.passColor = this.colors[i];
          this.focusTheme();
        }
      }
    },
    onValidate(value, inputId, megId) {
      Util.onValidate(value, inputId, megId);
    },
    checkValidate() {
      var returnValue = true;
      if (
        this.school.school_name == "" ||
        this.school.school_name == undefined
      ) {
        Util.onValidateMessage("schoolid", "schoolmsg");
        returnValue = false;
      }
      if (this.school.address == "" || this.school.address == undefined) {
        Util.onValidateMessage("addressid", "addressmsg");
        returnValue = false;
      }
      if (this.school.phone == "" || this.school.phone == undefined) {
        Util.onValidateMessage("phoneid", "phonemsg");
        returnValue = false;
      }
      if (this.school.email == "" || this.school.email == undefined) {
        Util.onValidateMessage("emailid", "emailmsg");
        returnValue = false;
      }
      return returnValue;
    },
    defaultColor() {
      document.getElementById("default").style.border =
        "3px solid rgb(105, 105, 105)";
      document.getElementById("red").style.border = "none";
      document.getElementById("blue").style.border = "none";
      document.getElementById("dark").style.border = "none";
      document.getElementById("light").style.border = "none";
      document.getElementById("defaultCircle").style.display = "block";
      document.getElementById("redCircle").style.display = "none";
      document.getElementById("blueCircle").style.display = "none";
      document.getElementById("darkCircle").style.display = "none";
      document.getElementById("lightCircle").style.display = "none";
      document.getElementById("defaultText").style.display = "none";
      document.getElementById("redText").style.display = "block";
      document.getElementById("blueText").style.display = "block";
      document.getElementById("darkText").style.display = "block";
      document.getElementById("lightText").style.display = "block";
    },
    redColor() {
      document.getElementById("red").style.border =
        "3px solid rgb(105, 105, 105)";
      document.getElementById("blue").style.border = "none";
      document.getElementById("dark").style.border = "none";
      document.getElementById("light").style.border = "none";
      document.getElementById("default").style.border = "none";
      document.getElementById("defaultCircle").style.display = "none";
      document.getElementById("redCircle").style.display = "block";
      document.getElementById("blueCircle").style.display = "none";
      document.getElementById("darkCircle").style.display = "none";
      document.getElementById("lightCircle").style.display = "none";
      document.getElementById("defaultText").style.display = "block";
      document.getElementById("redText").style.display = "none";
      document.getElementById("blueText").style.display = "block";
      document.getElementById("darkText").style.display = "block";
      document.getElementById("lightText").style.display = "block";
    },
    blueColor() {
      document.getElementById("blue").style.border =
        "3px solid rgb(105, 105, 105)";
      document.getElementById("red").style.border = "none";
      document.getElementById("default").style.border = "none";
      document.getElementById("dark").style.border = "none";
      document.getElementById("light").style.border = "none";
      document.getElementById("defaultCircle").style.display = "none";
      document.getElementById("redCircle").style.display = "none";
      document.getElementById("blueCircle").style.display = "block";
      document.getElementById("darkCircle").style.display = "none";
      document.getElementById("lightCircle").style.display = "none";
      document.getElementById("defaultText").style.display = "block";
      document.getElementById("redText").style.display = "block";
      document.getElementById("blueText").style.display = "none";
      document.getElementById("darkText").style.display = "block";
      document.getElementById("lightText").style.display = "block";
    },
    darkColor() {
      document.getElementById("dark").style.border =
        "3px solid rgb(105, 105, 105)";
      document.getElementById("default").style.border = "none";
      document.getElementById("red").style.border = "none";
      document.getElementById("light").style.border = "none";
      document.getElementById("blue").style.border = "none";
      document.getElementById("defaultCircle").style.display = "none";
      document.getElementById("redCircle").style.display = "none";
      document.getElementById("blueCircle").style.display = "none";
      document.getElementById("darkCircle").style.display = "block";
      document.getElementById("lightCircle").style.display = "none";
      document.getElementById("defaultText").style.display = "block";
      document.getElementById("redText").style.display = "block";
      document.getElementById("blueText").style.display = "block";
      document.getElementById("darkText").style.display = "none";
      document.getElementById("lightText").style.display = "block";
    },
    lightColor() {
      document.getElementById("light").style.border =
        "3px solid rgb(105, 105, 105)";
      document.getElementById("dark").style.border = "none";
      document.getElementById("default").style.border = "none";
      document.getElementById("red").style.border = "none";
      document.getElementById("blue").style.border = "none";
      document.getElementById("defaultCircle").style.display = "none";
      document.getElementById("redCircle").style.display = "none";
      document.getElementById("blueCircle").style.display = "none";
      document.getElementById("darkCircle").style.display = "none";
      document.getElementById("lightCircle").style.display = "block";
      document.getElementById("defaultText").style.display = "block";
      document.getElementById("redText").style.display = "block";
      document.getElementById("blueText").style.display = "block";
      document.getElementById("darkText").style.display = "block";
      document.getElementById("lightText").style.display = "none";
    }
  }
};
</script>