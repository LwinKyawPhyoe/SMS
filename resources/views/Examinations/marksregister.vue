<template>
  <div class="form" id="bar">
    <div class="toplink">
      <h2 class="stuName">Examinations</h2>
      <h4 class="stuLink">
        <router-link to="/home" class="home">Home</router-link>> Marks Register
      </h4>
    </div>
    <hr />

    <div class="card">
      <div class="card-header">
        <h6>Select Marks Register</h6>
        <router-link to="/fillmarks" onclick="showForm()" class="add">Add</router-link>
      </div>
      <div class="card-body">
        <div class="row" id="row" style="margin: 0px;">
          <div class="col-lg-4 col-md-4 col-12 textbox">
            <label for="name">
              Exam Name
              <strong>*</strong>
            </label>
            <select class="inputbox" name="class">
              <option selected disabled>Select Test-Month</option>
              <option value="Unit Test-January">Unit Test-January</option>
              <option value="Unit Test-February">Unit Test-February</option>
              <option value="Unit Test-March">Unit Test-March</option>
            </select>
          </div>
          <div class="col-lg-4 col-md-4 col-12 textbox">
            <label for="name">
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
            <label for="name">Section</label>
            <select class="inputbox" name="class">
              <option selected disabled>Select Section</option>
              <option value="Section A">Section A</option>
              <option value="Section B">Section B</option>
              <option value="Section C">Section C</option>
            </select>
          </div>
          <div class="col-12">
            <button class="searchButton" id="globalSearch">Search</button>
          </div>
        </div>
      </div>

      <div class="sub-header">
        <h6>Marks Register</h6>
      </div>
      <div class="card-body">
        <input type="text" placeholder="Search..." class="searchText" />
        <div class="copyRows">
          <div class="row" id="copyRow">
            <div class="col-3">
              <a href="#" @click.prevent="downloadExcel('studenttable', 'name', 'Exam_Mark_Report.xls')" title="Excel">
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
                <th class="all" nowrap>Adminission Number</th>
                <th class="all" nowrap>Roll Number</th>
                <th class="all" nowrap>Student</th>
                <th class="all" nowrap>Father Name</th>
                <th class="all" nowrap>Myanmar (TH:4/10)</th>
                <th class="all" nowrap>English (TH:8/15)</th>
                <th class="all" nowrap>Mathematics (TH:8/15)</th>
                <th class="all" nowrap>Chemistry (TH:8/15)</th>
                <th class="all" nowrap>Grade Total</th>
                <th class="all" nowrap>Percent(%)</th>
                <th class="all" nowrap>Result</th>
              </tr>
            </thead>
            <tbody>
              <tr class="active">
                <td class="all" nowrap>18012</td>
                <td class="all" nowrap>113</td>
                <td class="all" nowrap>Gates</td>
                <td class="all" nowrap>Bill Gates</td>
                <td class="all" nowrap>9.00</td>
                <td class="all" nowrap>12.00</td>
                <td class="all" nowrap>9.00</td>
                <td class="all" nowrap>13.00</td>
                <td class="all" nowrap>48/55</td>
                <td class="all" nowrap>83.23</td>
                <td class="all" nowrap>
                  <a href="#" style="text-decoration:none;" class="btn-success btn-sm">Pass</a>
                </td>
              </tr>
              <tr class="active">
                <td class="all" nowrap>18013</td>
                <td class="all" nowrap>114</td>
                <td class="all" nowrap>Din</td>
                <td class="all" nowrap>Dinkin</td>
                <td class="all" nowrap>0.00</td>
                <td class="all" nowrap>2.00</td>
                <td class="all" nowrap>1.00</td>
                <td class="all" nowrap>0.00</td>
                <td class="all" nowrap>3/55</td>
                <td class="all" nowrap>5.23</td>
                <td class="all" nowrap>
                  <a href="#" style="text-decoration:none;" class="btn-danger btn-sm">Fail</a>
                </td>
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
