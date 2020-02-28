<template>
  <div class="form" id="bar">
    <div class="toplink">
      <h2 class="stuName">Academics</h2>
      <h4 class="stuLink">
        <router-link class="home" to="home">Home</router-link> > 
        <router-link class="home" to="/viewasssubjects">Assign Subject</router-link> > Create Assign Subject
      </h4>
    </div>
    <hr style="margin-bottom: -0.5rem;" />

    <div class="card">
      <div class="card-header">
        <h6>Select Criteria</h6>
      </div>
      <div class="card-body">
        <div class="row" id="row" style="margin: 0px;">
          <div class="col-lg-6 col-md-6 col-12 textbox">
            <label for="name" class="title">
              Class
              <strong>*</strong>
            </label>
            <select class="inputbox" name="class">
              <option selected disabled>Select Class</option>
              <option value="Class A">Class A</option>
              <option value="Class B">Class B</option>
              <option value="Class C">Class C</option>
            </select>
          </div>
          <div class="col-lg-6 col-md-6 col-12 textbox">
            <label for="name" class="title">
              Section
              <strong>*</strong>
            </label>
            <select class="inputbox" name="class">
              <option selected disabled>Select Section</option>
              <option value="Section A">Section A</option>
              <option value="Section B">Section B</option>
              <option value="Section C">Section C</option>
            </select>
          </div>
          <div class="col-12">
            <button class="searchButton">Search</button>
          </div>
        </div>
      </div>

      <div class="sub-header">
        <h6>Assign Subject</h6>
        <button @click="AddRow()" class="add">Add</button>
      </div>
      <div class="card-body">
        <div v-for="filter in filterList" class="row" id="row" style="padding-bottom: 0;">
          <div class="col-lg-6 col-12 textbox" style="display: flex;flex-wrap: wrap;">
            <div class="col-lg-3 col-12" style="padding-left: 5px;padding-right: 5px;">
              <label for="name" class="title">{{ filter.firstcaption }}</label>
            </div>
            <div class="col-lg-7 col-12" style="padding-left: 5px;padding-right: 5px;">
              <select class="inputbox" name="class">
                <option selected disabled>Select Subject</option>
                <option value="Class 1">Class 1</option>
                <option value="Class 2">Class 2</option>
                <option value="Class 3">Class 3</option>
              </select>
            </div>
          </div>
          <div class="col-lg-6 col-12 textbox" style="display: flex;flex-wrap: wrap;">
            <div class="col-lg-3 col-12" style="padding-left: 5px;padding-right: 5px;">
              <label for="name" class="title">{{ filter.secondcaption }}</label>
            </div>
            <div
              class="col-lg-7 col-12"
              style="padding-left: 5px;padding-right: 5px; margin-bottom: 5px;"
            >
              <select class="inputbox" name="class">
                <option selected disabled>Select Teacher</option>
                <option value="Class 1">Class 1</option>
                <option value="Class 2">Class 2</option>
                <option value="Class 3">Class 3</option>
              </select>
            </div>
            <div class="col-lg-2 col-12" style="padding-left: 5px;padding-right: 5px;">
              <button @click="DeleteRow(filter.itemid)" class="btnTrash">
                <i class="fa fa-trash" aria-hidden="true"></i>
              </button>
            </div>
          </div>
        </div>
        <hr />
        <div class="col-12">
          <button class="save" style="margin:0 0 1rem;">Save</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      filterList: [
        {
          itemid: 1,
          firstcaption: "Subject",
          firstvalue: "",
          secondcaption: "Teacher",
          secondvalue: ""
        }
      ]
    };
  },
  methods: {
    AddRow() {
      this.filterList.push({
        itemid: Number(this.filterList[this.filterList.length - 1].itemid + 1),
        firstcaption: "Subject",
        firstvalue: "",
        secondcaption: "Teacher",
        secondvalue: ""
      });
    },
    DeleteRow(aValue) {
      if (this.filterList.length != 1) {
        for (let i = 0; i < this.filterList.length; i++) {
          if (aValue == this.filterList[i].itemid) {
            this.filterList.splice(i, 1);
            break;
          }
        }
      }
    }
  }
};
</script>