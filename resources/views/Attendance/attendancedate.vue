<template>
  <div class="form" id="bar">
    <div class="toplink">
      <h2 class="stuName">Attendance</h2>
      <h4 class="stuLink">
        <router-link to="/home" class="home">Home</router-link>> Attendance By Date
      </h4>
    </div>
    <hr />

    <div class="card">
      <div class="card-header">
        <h6>Select Attendance By Date</h6>
      </div>
      <div class="card-body">
        <div class="row" id="row" style="margin: 0px;">
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
            <label for="name">
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
            <label for="name">Attendance Date</label>
            <input type="date" class="inputbox" />
          </div>
          <div class="col-12">
            <button class="searchButton" id="globalSearch">Search</button>
          </div>
        </div>
      </div>

      <div class="sub-header">
        <h6>Attendance List</h6>
      </div>
      <div class="card-body">
        <input type="text" placeholder="Search..." class="searchText" />
        <div class="copyRows">
          <div class="row" id="copyRow">                
            <div class="col-3">
              <a href="#" @click.prevent="downloadExcel('studenttable', 'name', 'Attendance_Date.xls')" title="Excel">
                <i class="fa fa-file-excel-o"></i>
              </a>
            </div>
            <div class="col-3">
              <a href="#" @click.prevent="printme('print')" title="Print">
                <i class="fa fa-print"></i>
              </a>
            </div>
            <div class="col-3">
              <a onclick="showColumns()" title="Columns">
                <i class="fa fa-columns"></i>
              </a>
              <div id="columns" class="columns">
                <p
                  onclick="showTableHeader('AdmNumber')"
                  style="border-radius: 5px 5px 0 0;"
                  id="AdmNumber"
                  class="tableLink"
                >
                  <span>Admission</span>
                </p>
                <p onclick="showTableHeader('RollNum')" id="RollNum" class="tableLink">
                  <span>RollNumber</span>
                </p>
                <p onclick="showTableHeader('Name')" id="Name" class="tableLink">
                  <span>Name</span>
                </p>
                <p onclick="showTableHeader('Attendance')" id="Attendance" class="tableLink">
                  <span>Attendance</span>
                </p>
                <p
                  class="tableLinks"
                  @click="allTableHeader('AdmNumber','RollNum','Name','Attendance')"
                  style="border-radius: 0 0 5px 5px;"
                >
                  <span>Restore visibility</span>
                </p>
              </div>
            </div>
          </div>
        </div>

        <div class="table-responsive" id="print">
          <table class="table table-hover table-striped" id="studenttable">
            <thead>
              <tr role="row">
                <th class="all" nowrap>No</th>
                <th class="all" nowrap>Admission Number</th>
                <th class="all" nowrap>Roll Number</th>
                <th class="all" nowrap>Name</th>
                <th class="all" style="text-align:right;" nowrap>Attendance</th>
              </tr>
            </thead>
            <tbody>
              <tr class="active">
                <td class="all" nowrap>1</td>
                <td class="all" nowrap>18001</td>
                <td class="all" nowrap>101</td>
                <td class="all" nowrap>Edward Thomas</td>
                <td class="all" style="text-align:right;" nowrap>
                  <a
                    href="#"
                    style="text-decoration:none;margin-right:5px;"
                    class="btn-warning btn-sm"
                  >Half Day</a>
                </td>
              </tr>
              <tr class="active">
                <td class="all" nowrap>2</td>
                <td class="all" nowrap>18002</td>
                <td class="all" nowrap>102</td>
                <td class="all" nowrap>Laura Clinton</td>
                <td class="all" style="text-align:right;" nowrap>
                  <a
                    href="#"
                    style="text-decoration:none;margin-right:5px;"
                    class="btn-danger btn-sm"
                  >Absent</a>
                </td>
              </tr>
              <tr class="active">
                <td class="all" nowrap>3</td>
                <td class="all" nowrap>18003</td>
                <td class="all" nowrap>103</td>
                <td class="all" nowrap>Robin Peterson</td>
                <td class="all" style="text-align:right;" nowrap>
                  <a
                    href="#"
                    style="text-decoration:none;margin-right:5px;"
                    class="btn-success btn-sm"
                  >Present</a>
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
  data() {
    return {
      show: null
    };
  },
  methods: {
    allTableHeader(id, id1, id2, id3) {
      document.getElementById(id).style.background = "#1b5e20";
      document.getElementById(id).style.color = "white";
      document.getElementById(id1).style.background = "#1b5e20";
      document.getElementById(id1).style.color = "white";
      document.getElementById(id2).style.background = "#1b5e20";
      document.getElementById(id2).style.color = "white";
      document.getElementById(id3).style.background = "#1b5e20";
      document.getElementById(id3).style.color = "white";
    },

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