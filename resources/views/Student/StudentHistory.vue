<template>
  <div class="StudentHistory" id="bar">
    <div class="toplink">
      <h4 style="color:var(--primary);margin-bottom:5px;">Students</h4>
      <h6>
        <router-link to="/Student">Home</router-link>> Student History
      </h6>
    </div>
    <hr />
    <br />
    <div class="card">
      <div class="stucard-header">
        <h6>Select Criteria</h6>
      </div>
      <div class="stucard-body">
        <div class="row">
          <div class="textarea">
            <label for="class">Class</label>
            <select id="class" class="inputbox">
              <option value="one">Grade One</option>
              <option value="two">Grade Two</option>
              <option value="three">Grade Three</option>
            </select>
          </div>
          <div class="textarea">
            <label for="section">Seciton</label>
            <select id="section" class="inputbox">
              <option value="a">Class A</option>
              <option value="b">Class B</option>
              <option value="c">Class C</option>
            </select>
            <button class="search">Search</button>
          </div>
        </div>
      </div>
      <div class="sub-header">
        <h6>Student History</h6>
      </div>
      <div class="stucard-body">
        <input type="text" placeholder="Search..." class="searchText" />
        <div class="copyRows">
          <div class="row" id="copyRow">
            <div class="col-3">
              <a href="#" @click.prevent="downloadExcel('studenttable', 'name', 'Student_History.xls')" title="Excel">
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
          <table class="table table-hover" id="studenttable">
            <thead>
              <tr class="active" nowrap>
                <th nowrap>No.</th>
                <th nowrap>Name</th>
                <th nowrap>Photo</th>
                <th nowrap>Admission Number</th>
                <th nowrap>Roll Number</th>
                <th nowrap>Class</th>
                <th nowrap>Section</th>
                <th nowrap>Blood Group</th>
                <th nowrap>Height</th>
                <th nowrap>Weight</th>
                <th nowrap>Register Date</th>
                <th nowarp>AdmissionDate</th>
                <th nowrap>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr class="active">
                <td nowrap>0</td>
                <td nowrap>Selena Gomez</td>
                <td nowrap>
                  <img
                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRq2msisQfUdioeST-5wBrwuex4ZWEEjfGIZvxoSRLKrDk4UTGseg&s"
                    alt="student photo"
                  />
                </td>
                <td nowrap>1</td>
                <td nowrap>23</td>
                <td nowrap>Grade One</td>
                <td nowrap>Section A</td>
                <td nowrap>O+</td>
                <td nowrap>5ft</td>
                <td nowrap>134p</td>
                <td nowrap>09-09-2020</td>
                <td nowarp>30-06-2019</td>
                <td>
                  <router-link onclick="showForm()" to="/viewstudent">
                    <i class="fa fa-list"></i>
                  </router-link>
                  <router-link to="#">
                    <i class="fa fa-pencil pen"></i>
                  </router-link>
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
