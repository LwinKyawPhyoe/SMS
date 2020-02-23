<template>
  <div class="form" id="bar">
    <div class="toplink">
      <h2 class="stuName">Reports</h2>
      <h4 class="stuLink">
        <router-link to="/home" class="home">Home</router-link>> Student Report
      </h4>
    </div>
    <hr />

    <div class="card">
      <div class="card-header">
        <h6>Select Reports</h6>
      </div>
      <div class="card-body">
        <div class="row" id="row" style="margin: 0px;">
          <div class="col-lg-3 col-md-6 col-12 textbox">
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
          <div class="col-lg-3 col-md-6 col-12 textbox">
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
          <div class="col-lg-2 col-md-3 col-12 textbox">
            <label for="name" class="title">
              Category
              <strong>*</strong>
            </label>
            <select class="inputbox" name="class">
              <option selected disabled>Select Category</option>
              <option value="General">General</option>
              <option value="OBC">OBC</option>
              <option value="Special">Special</option>
              <option value="Physically Challenged">Physically Challenged</option>
            </select>
          </div>
          <div class="col-lg-2 col-md-3 col-12 textbox">
            <label for="name" class="title">
              Gender
              <strong>*</strong>
            </label>
            <select class="inputbox" name="class">
              <option selected disabled>Select Gender</option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
            </select>
          </div>
          <div class="col-lg-2 col-md-3 col-12 textbox">
            <label for="name" class="title">
              RTE
              <strong>*</strong>
            </label>
            <select class="inputbox" name="class">
              <option selected disabled>Select RTE</option>
              <option value="Yes">Yes</option>
              <option value="No">No</option>
            </select>
          </div>
          <div class="col-lg-12 col-md-3 col-12">
            <button class="searchButton" style="margin-top: 1.8rem !important;">Search</button>
          </div>
        </div>
      </div>

      <div class="sub-header">
        <h6>Student Report</h6>
      </div>
      <div class="card-body">
        <input type="text" placeholder="Search..." class="searchText" />
        <div class="copyRows">
          <div class="row" id="copyRow">
            <div class="col-3">
              <a href="#" @click.prevent="downloadExcel('studenttable', 'name', 'Student_Report.xls')" title="Excel">
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
                <th class="all" nowrap>Section</th>
                <th class="all" nowrap>Admission Number</th>
                <th class="all" nowrap>Student Name</th>
                <th class="all" nowrap>Father Name</th>
                <th class="all" nowrap>Date Of Birth</th>
                <th class="all" nowrap>Gender</th>
                <th class="all" nowrap>Category</th>
                <th class="all" nowrap>Mobile Number</th>
                <th class="all" nowrap>National Identification Number</th>
                <th class="all" nowrap>Local Identification Number</th>
                <th class="all" nowrap>RTE</th>
              </tr>
            </thead>
            <tbody>
              <tr class="active" style="border-bottom: 1px solid #ebebeb;">
                <td class="all" nowrap>A</td>
                <td class="all" nowrap>18012</td>
                <td class="all" nowrap>Stephen</td>
                <td class="all" nowrap>Olivier</td>
                <td class="all" nowrap>2/8/2020</td>
                <td class="all" nowrap>Male</td>
                <td class="all" nowrap>General</td>
                <td class="all" nowrap>3948399</td>
                <td class="all" nowrap>50394</td>
                <td class="all" nowrap>829393</td>
                <td class="all" nowrap>No</td>
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
