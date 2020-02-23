<template>
  <div class="form" id="bar">
    <div class="toplink">
      <h2 class="stuName">Reports</h2>
      <h4 class="stuLink">
        <router-link to="/home" class="home">Home</router-link>> Student Transport Report
      </h4>
    </div>
    <hr />

    <div class="card">
      <div class="card-header">
        <h6>Select Transport Reports</h6>
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
          <div class="col-lg-3 col-md-6 col-12 textbox">
            <label for="name" class="title">
              Route Title
              <strong>*</strong>
            </label>
            <select class="inputbox" name="class">
              <option selected disabled>Select Title</option>
              <option value="Brooklyn Center">Brooklyn Center</option>
              <option value="Brooklyn East">Brooklyn East</option>
              <option value="Brooklyn West">Brooklyn West</option>
              <option value="Brooklyn North">Brooklyn North</option>
              <option value="Brooklyn South">Brooklyn South</option>
            </select>
          </div>
          <div class="col-lg-3 col-md-6 col-12 textbox">
            <label for="name" class="title">
              Vehicle Number
              <strong>*</strong>
            </label>
            <select class="inputbox" name="class">
              <option selected disabled>Select Vehicle Number</option>
              <option value="VH1001">VH1001</option>
              <option value="VH5633">VH5633</option>
              <option value="VH5949">VH5949</option>
            </select>
          </div>
          <div class="col-12">
            <button class="searchButton" style="margin-top: 1.8rem !important;">Search</button>
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
              <a href="#" @click.prevent="downloadExcel('studenttable', 'name', 'Student_Transport_Report.xls')" title="Excel">
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
                <th class="all" nowrap>Father Name</th>
                <th class="all" nowrap>Father Phone</th>
                <th class="all" nowrap>Mother Name</th>
                <th class="all" nowrap>Mother Phone</th>
                <th class="all" nowrap>Route Title</th>
                <th class="all" nowrap>Vehicle Number</th>
                <th class="all" nowrap>Driver name</th>
                <th class="all" nowrap>Driver Contact</th>
                <th class="all" nowrap>Fare ($)</th>
              </tr>
            </thead>
            <tbody>
              <tr class="active" style="border-bottom: 1px solid #ebebeb;">
                <td class="all" nowrap>Class 1 - B</td> 
                <td class="all" nowrap>18012</td>
                <td class="all" nowrap>Stephen</td>
                <td class="all" nowrap>354353534</td>
                <td class="all" nowrap>Olivier</td>
                <td class="all" nowrap>165465415</td>
                <td class="all" nowrap>Marry</td>
                <td class="all" nowrap>654654444</td>
                <td class="all" nowrap>Brooklyn Central</td>
                <td class="all" nowrap>VH5342</td>
                <td class="all" nowrap>Maximus</td>
                <td class="all" nowrap>829393</td>
                <td class="all" nowrap>50.00</td>
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
