<template>
  <div class="form" id="bar">
    <div class="toplink">
      <h2 class="stuName">Reports</h2>
      <h4 class="stuLink">
        <router-link to="/home" class="home">Home</router-link>> Student Hotel Report
      </h4>
    </div>
    <hr />

    <div class="card">
      <div class="card-header">
        <h6>Select Hotel Reports</h6>
      </div>
      <div class="card-body">
        <div class="row" id="row" style="margin: 0px;">
          <div class="col-lg-4 col-md-4 col-12 textbox">
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
          <div class="col-lg-4 col-md-4 col-12 textbox">
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
          <div class="col-lg-4 col-md-4 col-12 textbox">
            <label for="name" class="title">
              Hostel Name
              <strong>*</strong>
            </label>
            <select class="inputbox" name="class">
              <option selected disabled>Select Hotel Name</option>
              <option value="Boys Hostel 101">Boys Hostel 101</option>
              <option value="Girls Hostel 103">Girls Hostel 103</option>
              <option value="Boys Hostel 102">Boys Hostel 102</option>
              <option value="Girls Hostel 104">Girls Hostel 104</option>
            </select>
          </div>
          <div class="col-12">
            <button class="searchButton" id="globalSearch" style="margin-top: 1rem !important;">Search</button>
          </div>
        </div>
      </div>

      <div class="sub-header">
        <h6>Student Transport Report</h6>
      </div>
      <div class="card-body">
        <input type="text" placeholder="Search..." class="searchText" />
        <div class="copyRows">
          <div class="row" id="copyRow">
            <div class="col-3">
              <a href="#" @click.prevent="downloadExcel('studenttable', 'name', 'Student_Hostel_Report.xls')" title="Excel">
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
        
        <div class="table-responsive" id="print">
          <table class="table table-hover table-striped" id="studenttable">
            <thead>
              <tr style="font-size:14px;">
                <th class="all" nowrap>Class-Section</th>
                <th class="all" nowrap>Admission Number</th>
                <th class="all" nowrap>Student Name</th>
                <th class="all" nowrap>Mobile Number</th>
                <th class="all" nowrap>Guardian Phone</th>
                <th class="all" nowrap>Hostel Name</th>
                <th class="all" nowrap>Room Number / Name</th>
                <th class="all" nowrap>Room Type</th>
                <th class="all" nowrap>Cost Per Bed ($)</th>
              </tr>
            </thead>
            <tbody>
              <tr class="active" style="border-bottom: 1px solid #ebebeb;">
                <td class="all" nowrap>Class 1 - B</td> 
                <td class="all" nowrap>18012</td>
                <td class="all" nowrap>Stephen</td>
                <td class="all" nowrap>354353534</td>
                <td class="all" nowrap>165465415</td>
                <td class="all" nowrap>Boys Hostel 101</td>
                <td class="all" nowrap>B1</td>
                <td class="all" nowrap>Two Bed</td>
                <td class="all" nowrap>500.00</td>
              </tr>
            </tbody>
          </table>
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
