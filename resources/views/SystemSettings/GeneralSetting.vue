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
      id="exampleModalCenter"
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
                    <input type="text" class="inputbox" />
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                  <div class="setting">
                    <label for="Code">School Code</label>
                    <input type="text" class="inputbox" />
                  </div>
                </div>
                <div class="col-12">
                  <div class="setting">
                    <label for="Address">
                      Address
                      <strong>*</strong>
                    </label>
                    <textarea rows="2" class="textareas"></textarea>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                  <div class="setting">
                    <label for="Phone">
                      Phone
                      <strong>*</strong>
                    </label>
                    <input type="text" class="inputbox" />
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                  <div class="setting">
                    <label for="Email">
                      Email
                      <strong>*</strong>
                    </label>
                    <input type="text" class="inputbox" />
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                  <div class="setting">
                    <label for="Session">
                      Session
                      <strong>*</strong>
                    </label>
                    <select class="inputbox" name="class">
                      <option selected disabled>Select Session</option>
                      <option value="2011-2012">2011-2012</option>
                      <option value="2012-2013">2012-2013</option>
                      <option value="2013-2014">2013-2014</option>
                    </select>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                  <div class="setting">
                    <label for="Month">
                      Session Start Month
                      <strong>*</strong>
                    </label>
                    <select class="inputbox" name="class">
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
                    <select class="inputbox" name="class">
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
                <form>
                  <div class="row" id="ThemeColor">
                    <div class="col-md-3 col-sm-6 col-xs-6 col-12">
                      <div class="blockColor" @click="changeTheme('defaultColor')">
                        <div class="backColor" id="default" style="background:#1b5e20;">
                          <p class="default" id="defaultText">Default</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-6 col-12">
                      <div class="blockColor" @click="changeTheme('redColor')">
                        <div class="backColor" id="red" style="background:darkred;">
                          <p class="default" id="redText">Red</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-6 col-12">
                      <div class="blockColor" @click="changeTheme('blueColor')">
                        <div class="backColor" id="blue" style="background:darkcyan;">
                          <p class="default" id="blueText">Blue</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-6 col-12">
                      <div class="blockColor" @click="changeTheme('darkColor')">
                        <div class="backColor" id="dark" style="background:currentColor;">
                          <p class="default" id="darkText">Dark</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-6 col-12">
                      <div class="blockColor" @click="changeTheme('lightColor')">
                        <div class="backColor" id="light" style="background:#edeeef;">
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
                </form>
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
        <div class="modal-content" style="width:653px;">
          <div class="modal-body" style="padding:0;">
            <div class="card-header" id="globalcardHeader" style="width: 100%;margin-left: 0;">
              <h6>Edit Logo</h6>
              <i
                class="fa fa-close"
                data-dismiss="modal"
                style="cursor: pointer;padding: 0 10px;position: absolute;right: 5px;"
              ></i>
            </div>
            <div style="height: 250px;padding: 2rem;padding: 20px 4rem;">
              <div
                style="display: flex;justify-content: center;align-items: center;height: 100%;border: 1px dotted black;"
              >
                <!-- <h3
                  style="font-size: 13pt;cursor: pointer;align-items: center;padding: 2rem;display: flex;"
                >
                  <i class="fa fa-image" style="margin-right: 5px;zoom: 5;margin-left: 4px;"></i>
                  Pick Your Image
                </h3>-->
                <img
                  src="https://www.tn8.tv/media/cache/f0/4a/f04a9afb32f7d049214a165e07245229.jpg"
                  style="padding: 1rem;border-radius: 20px;cursor:pointer;height: 100%;"
                />
              </div>
            </div>
          </div>
          <div class="modal-footer" style="padding-top: 0;">
            <button type="button" id="globalSave" class="save">Save</button>
          </div>
        </div>
      </div>
    </div>
    <hr />

    <div class="row rowContainer" style="align-items: end !important;">
      <div class="col-lg-4 col-12" style="padding-left:2px;">
        <div class="card" id="globalCard">
          <div class="card-header" id="globalcardHeader">
            <h6>Edit Logo</h6>
          </div>
          <div class="card-body imgCard" style="padding:1rem;" id="globalcardBody">
            <div class="col-12 img">
              <img
                style="border-radius:5px;"
                src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRIRcKkWW7dmavwCV9BCrL1KpRsxqCObkckavwdsKbtzoZkZAPr"
              />
            </div>
            <div class="col-12 button">
              <button class="edit" data-toggle="modal" data-target="#profileModal" id="globalEdit">
                <i class="fa fa-floppy-o editIcon" aria-hidden="true"></i>Edit Logo
              </button>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-8 col-12" style="padding-left:0;">
        <div class="card" id="globalCard">
          <div class="card-header editCard" id="globalcardHeader">
            <h6>General Setting</h6>
            <button
              class="editSm"
              @click="getData()"
              data-toggle="modal"
              data-target="#exampleModalCenter"
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
                    <td class="all" nowrap>Private School</td>
                  </tr>
                  <tr>
                    <td class="all" nowrap>
                      <b>Address</b>
                    </td>
                    <td class="all" nowrap>Myanmar, Mogok</td>
                  </tr>
                  <tr>
                    <td class="all" nowrap>
                      <b>Phone</b>
                    </td>
                    <td class="all" nowrap>09-28495828421</td>
                  </tr>
                  <tr>
                    <td class="all" nowrap>
                      <b>Email</b>
                    </td>
                    <td class="all" nowrap>tastysoft1234@gmail.com</td>
                  </tr>
                  <tr>
                    <td class="all" nowrap>
                      <b>School Code</b>
                    </td>
                    <td class="all" nowrap>MM-294905</td>
                  </tr>
                  <tr>
                    <td class="all" nowrap>
                      <b>Session</b>
                    </td>
                    <td class="all" nowrap>2019-20</td>
                  </tr>
                  <tr>
                    <td class="all" nowrap>
                      <b>Session Start Month</b>
                    </td>
                    <td class="all" nowrap>June</td>
                  </tr>
                  <tr>
                    <td class="all" nowrap>
                      <b>Language</b>
                    </td>
                    <td class="all" nowrap>English</td>
                  </tr>
                  <tr>
                    <td class="all" nowrap>
                      <b>Current Theme</b>
                    </td>
                    <td class="all row" nowrap>
                      <span class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <input
                          disabled
                          name="theme"
                          class="radio rd"
                          id="default"
                          type="radio"
                          checked
                        />
                        <label for="default">Default</label>
                      </span>
                      <span class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <input disabled name="theme" class="radio rd1" id="theme1" type="radio" />
                        <label for="theme1">Theme 1</label>
                      </span>
                      <span class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <input disabled name="theme" class="radio rd2" id="theme2" type="radio" />
                        <label for="theme2">Theme 2</label>
                      </span>
                      <span class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <input disabled name="theme" class="radio rd3" id="theme3" type="radio" />
                        <label for="theme3">Theme 3</label>
                      </span>
                      <span class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <input disabled name="theme" class="radio rd4" id="theme4" type="radio" />
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
export default {
  data() {
    return {
      color: "",
      colors: [],
      passColor: []
    };
  },
  created() {
    this.axios.get("/api/color").then(response => {
      this.colors = response.data;
    });
  },
  methods: {
    changeTheme(id) {
      if (id == "defaultColor") {
        this.color = id;
        document.getElementById("default").style.border =
          "3px solid rgb(105, 105, 105)";
        document.getElementById("red").style.border = "none";
        document.getElementById("blue").style.border = "none";
        document.getElementById("dark").style.border = "none";
        document.getElementById("light").style.border = "none";
        document.getElementById("defaultText").style.filter = "opacity(1)";
        document.getElementById("redText").style.filter = "opacity(0.5)";
        document.getElementById("blueText").style.filter = "opacity(0.5)";
        document.getElementById("darkText").style.filter = "opacity(0.5)";
        document.getElementById("lightText").style.filter = "opacity(0.5)";
      } else if (id == "redColor") {
        this.color = id;
        document.getElementById("red").style.border =
          "3px solid rgb(105, 105, 105)";
        document.getElementById("blue").style.border = "none";
        document.getElementById("dark").style.border = "none";
        document.getElementById("light").style.border = "none";
        document.getElementById("default").style.border = "none";
        document.getElementById("redText").style.filter = "opacity(1)";
        document.getElementById("defaultText").style.filter = "opacity(0.5)";
        document.getElementById("blueText").style.filter = "opacity(0.5)";
        document.getElementById("darkText").style.filter = "opacity(0.5)";
        document.getElementById("lightText").style.filter = "opacity(0.5)";
      } else if (id == "blueColor") {
        this.color = id;
        document.getElementById("blue").style.border =
          "3px solid rgb(105, 105, 105)";
        document.getElementById("red").style.border = "none";
        document.getElementById("default").style.border = "none";
        document.getElementById("dark").style.border = "none";
        document.getElementById("light").style.border = "none";
        document.getElementById("blueText").style.filter = "opacity(1)";
        document.getElementById("defaultText").style.filter = "opacity(0.5)";
        document.getElementById("redText").style.filter = "opacity(0.5)";
        document.getElementById("darkText").style.filter = "opacity(0.5)";
        document.getElementById("lightText").style.filter = "opacity(0.5)";
      } else if (id == "darkColor") {
        this.color = id;
        document.getElementById("dark").style.border =
          "3px solid rgb(105, 105, 105)";
        document.getElementById("default").style.border = "none";
        document.getElementById("red").style.border = "none";
        document.getElementById("light").style.border = "none";
        document.getElementById("blue").style.border = "none";
        document.getElementById("darkText").style.filter = "opacity(1)";
        document.getElementById("defaultText").style.filter = "opacity(0.5)";
        document.getElementById("redText").style.filter = "opacity(0.5)";
        document.getElementById("blueText").style.filter = "opacity(0.5)";
        document.getElementById("lightText").style.filter = "opacity(0.5)";
      } else if (id == "lightColor") {
        this.color = id;
        document.getElementById("light").style.border =
          "3px solid rgb(105, 105, 105)";
        document.getElementById("dark").style.border = "none";
        document.getElementById("default").style.border = "none";
        document.getElementById("red").style.border = "none";
        document.getElementById("blue").style.border = "none";
        document.getElementById("lightText").style.filter = "opacity(1)";
        document.getElementById("defaultText").style.filter = "opacity(0.5)";
        document.getElementById("redText").style.filter = "opacity(0.5)";
        document.getElementById("blueText").style.filter = "opacity(0.5)";
        document.getElementById("darkText").style.filter = "opacity(0.5)";
      }
    },
    focusTheme() {
      if (this.passColor.color == "defaultColor") {
        document.getElementById("default").style.border =
          "3px solid rgb(105, 105, 105)";
        document.getElementById("red").style.border = "none";
        document.getElementById("blue").style.border = "none";
        document.getElementById("dark").style.border = "none";
        document.getElementById("light").style.border = "none";
        document.getElementById("defaultText").style.filter = "opacity(1)";
        document.getElementById("redText").style.filter = "opacity(0.5)";
        document.getElementById("blueText").style.filter = "opacity(0.5)";
        document.getElementById("darkText").style.filter = "opacity(0.5)";
        document.getElementById("lightText").style.filter = "opacity(0.5)";
      } else if (this.passColor.color == "redColor") {
        document.getElementById("red").style.border =
          "3px solid rgb(105, 105, 105)";
        document.getElementById("blue").style.border = "none";
        document.getElementById("dark").style.border = "none";
        document.getElementById("light").style.border = "none";
        document.getElementById("default").style.border = "none";
        document.getElementById("redText").style.filter = "opacity(1)";
        document.getElementById("defaultText").style.filter = "opacity(0.5)";
        document.getElementById("blueText").style.filter = "opacity(0.5)";
        document.getElementById("darkText").style.filter = "opacity(0.5)";
        document.getElementById("lightText").style.filter = "opacity(0.5)";
      } else if (this.passColor.color == "blueColor") {
        document.getElementById("blue").style.border =
          "3px solid rgb(105, 105, 105)";
        document.getElementById("red").style.border = "none";
        document.getElementById("default").style.border = "none";
        document.getElementById("dark").style.border = "none";
        document.getElementById("light").style.border = "none";
        document.getElementById("blueText").style.filter = "opacity(1)";
        document.getElementById("defaultText").style.filter = "opacity(0.5)";
        document.getElementById("redText").style.filter = "opacity(0.5)";
        document.getElementById("darkText").style.filter = "opacity(0.5)";
        document.getElementById("lightText").style.filter = "opacity(0.5)";
      } else if (this.passColor.color == "darkColor") {
        document.getElementById("dark").style.border =
          "3px solid rgb(105, 105, 105)";
        document.getElementById("default").style.border = "none";
        document.getElementById("red").style.border = "none";
        document.getElementById("light").style.border = "none";
        document.getElementById("blue").style.border = "none";
        document.getElementById("darkText").style.filter = "opacity(1)";
        document.getElementById("defaultText").style.filter = "opacity(0.5)";
        document.getElementById("redText").style.filter = "opacity(0.5)";
        document.getElementById("blueText").style.filter = "opacity(0.5)";
        document.getElementById("lightText").style.filter = "opacity(0.5)";
      } else if (this.passColor.color == "lightColor") {
        document.getElementById("light").style.border =
          "3px solid rgb(105, 105, 105)";
        document.getElementById("dark").style.border = "none";
        document.getElementById("default").style.border = "none";
        document.getElementById("red").style.border = "none";
        document.getElementById("blue").style.border = "none";
        document.getElementById("lightText").style.filter = "opacity(1)";
        document.getElementById("defaultText").style.filter = "opacity(0.5)";
        document.getElementById("redText").style.filter = "opacity(0.5)";
        document.getElementById("blueText").style.filter = "opacity(0.5)";
        document.getElementById("darkText").style.filter = "opacity(0.5)";
      }
    },
    getColors() {
      this.axios.get("/api/color").then(response => {
        this.colors = response.data;
      });
    },
    themeColor() {
      if (this.passColor.id == "1") {
        this.axios.post(`api/setting/update/${this.color}`);
      }
    },
    getData() {
      for (var i = 0; i < this.colors.length; i++) {
        this.getColors();
        if (this.colors[i].id == "1") {
          this.passColor = this.colors[i];
          this.focusTheme();
        }
      }
    }
  }
};
</script>