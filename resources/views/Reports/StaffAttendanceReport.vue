<template>
  <div class="form" id="bar">
    <div class="toplink">
      <h2 class="stuName">Reports</h2>
      <h4 class="stuLink">
        <router-link to="/home" class="home">Home</router-link>> Staff Attendance Report
      </h4>
    </div>
    <hr />

    <div class="card">
      <div class="card-header">
        <h6>Select Staff Attendance Report</h6>
      </div>
      <div class="card-body">
        <div class="row" id="row" style="margin: 0px;">
          <div class="col-lg-4 col-md-4 col-12 textbox">
            <label for="name" class="title">
              Role
              <strong>*</strong>
            </label>
            <select class="inputbox" name="class">
              <option selected disabled>Select Role</option>
              <option value="Admin">Admin</option>
              <option value="Accountant">Accountant</option>
              <option value="Super Admin">Super Admin</option>
            </select>
          </div>
          <div class="col-lg-4 col-md-4 col-12 textbox">
            <label for="name" class="title">
              Month
              <strong>*</strong>
            </label>
            <select class="inputbox" name="class">
              <option selected disabled>Select Month</option>
              <option value="June">June</option>
              <option value="July">July</option>
              <option value="August">August</option>
            </select>
          </div>
          <div class="col-lg-4 col-md-4 col-12 textbox">
            <label for="name" class="title">
              Year
              <strong>*</strong>
            </label>
            <select class="inputbox" name="class">
              <option selected disabled>Select Year</option>
              <option value="2018">2018</option>
              <option value="2019">2019</option>
              <option value="2020">2020</option>
            </select>
          </div>
          <div class="col-12">
            <button class="searchButton" id="globalSearch" style="margin-top: 1rem !important;">Search</button>
          </div>
        </div>
      </div>

      <div class="sub-header">
        <h6>Staff Attendance Report</h6>
      </div>
      <div class="card-body">
        <input type="text" placeholder="Search..." class="searchText" />
        <div class="copyRows">
          <div class="row" id="copyRow">
            <div class="col-3">
              <a href="#" @click.prevent="downloadExcel('studenttable', 'name', 'Staff_Attendance_Report.xls')" title="Excel">
                <i class="fa fa-file-excel-o"></i>
              </a>
            </div>
            <div class="col-3">
              <a href="#" @click.prevent="printme('print')" title="Print">
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
      </div>
    </div>
  </div>
</template>

<script>
import message from "../Alertmessage/message.vue";
import {Util} from '../../js/util';

export default {
    components: {
        message
    },
    data() 
    {
        return {
            msg: {
                text: "",
                type: ""
            },
            deletemsg: {
                text: "",
                type: ""
            }
        };
    },

    methods: 
    {
      printme(table)
      {
        Util.printme(table);
      },

      downloadExcel(table, name, filename) 
      {
        Util.downloadExcel(table,name,filename);
      }
    }
};
</script>
