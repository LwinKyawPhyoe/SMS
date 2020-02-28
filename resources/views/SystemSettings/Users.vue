<template>
  <div class="form" id="bar">
    <div class="toplink">
      <h2 class="stuName">System Settings</h2>
      <h4 class="stuLink">
        <router-link to="/home" class="home">Home</router-link>> Users
      </h4>
    </div>
    <hr />
    <div class="Usercard" style="padding-left:0;">
      <div class="card">
        <div class="card-header" id="globalcardHeader">
          <h6>Users</h6>
          <div class="buttonCard" style="font-size:11pt;right: 15px;position:absolute;">
            <button
              id="student"
              class="tabTheme"
              @click="toggleBtns('student','parent','staff')"
              style="padding: 6px 1rem 7px;margin-left: -5px;border: none;color:black;background:white;"
            >Stduent</button>
            <button
              id="parent"
              class="tabTheme"
              @click="toggleBtns('parent','student','staff')"
              style="padding: 6px 1rem 7px;margin-left: -5px;border: none;background: none;color:white;"
            >Parent</button>
            <button
              id="staff"
              class="tabTheme"
              @click="toggleBtns('staff','student','parent')"
              style="padding: 6px 1rem 7px;margin-left: -5px;border: none;background: none;color:white;"
            >Staff</button>
          </div>
        </div>
        <div class="card-body" v-if="student === true">
          <input type="text" placeholder="Search..." class="searchText" />
          <div class="copyRows">
            <div class="row" id="copyRow">
              <div class="col-2">
                <a href="#" title="Copy">
                  <i class="fa fa-copy"></i>
                </a>
              </div>
              <div class="col-2">
                <a href="#" title="Excel">
                  <i class="fa fa-file-excel-o"></i>
                </a>
              </div>
              <div class="col-2">
                <a href="#" title="PDF">
                  <i class="fa fa-file-pdf-o"></i>
                </a>
              </div>
              <div class="col-2">
                <a href="#" title="Print">
                  <i class="fa fa-print"></i>
                </a>
              </div>
              <div class="col-2">
                <a href="#" title="Columns">
                  <i class="fa fa-columns"></i>
                </a>
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table table-hover table-striped" id="studenttable">
              <thead>
                <tr>
                  <th class="all" nowrap>Admission Number</th>
                  <th class="all" nowrap>Student Name</th>
                  <th class="all">Username</th>
                  <th class="all">Class</th>
                  <th class="all">Father Name</th>
                  <th class="all">Mobile Number</th>
                  <th class="all">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr class="active">
                  <td class="all" nowrap>100021</td>
                  <td class="all" nowrap>Stephen</td>
                  <td class="all" nowrap>std11</td>
                  <td class="all" nowrap>Class 1 (A)</td>
                  <td class="all" nowrap>Michael Kohlar</td>
                  <td class="all" nowrap>23848393</td>
                  <td class="all" nowrap>
                    <input type="checkbox" checked data-toggle="toggle" data-size="xs" />
                  </td>
                </tr>
                <tr class="active">
                  <td class="all" nowrap>100022</td>
                  <td class="all" nowrap>John</td>
                  <td class="all" nowrap>std15</td>
                  <td class="all" nowrap>Class 1 (C)</td>
                  <td class="all" nowrap>James Stark</td>
                  <td class="all" nowrap>5345348</td>
                  <td class="all" nowrap>
                    <input type="checkbox" checked data-toggle="toggle" data-size="xs" />
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-body" v-if="parent === true">
          <input type="text" placeholder="Search..." class="searchText" />
          <div class="copyRows">
            <div class="row" id="copyRow">
              <div class="col-2">
                <a href="#" title="Copy">
                  <i class="fa fa-copy"></i>
                </a>
              </div>
              <div class="col-2">
                <a href="#" title="Excel">
                  <i class="fa fa-file-excel-o"></i>
                </a>
              </div>
              <div class="col-2">
                <a href="#" title="PDF">
                  <i class="fa fa-file-pdf-o"></i>
                </a>
              </div>
              <div class="col-2">
                <a href="#" title="Print">
                  <i class="fa fa-print"></i>
                </a>
              </div>
              <div class="col-2">
                <a href="#" title="Columns">
                  <i class="fa fa-columns"></i>
                </a>
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table table-hover table-striped" id="studenttable">
              <thead>
                <tr>
                  <th class="all" nowrap>Guardian Name</th>
                  <th class="all" nowrap>Guardian Phone</th>
                  <th class="all" nowrap>Username</th>
                  <th class="all" nowrap>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr class="active">
                  <td class="all" nowrap>Stephen</td>
                  <td class="all" nowrap>100021</td>
                  <td class="all" nowrap>std11</td>
                  <td class="all" nowrap>
                    <input type="checkbox" checked data-toggle="toggle" data-size="xs" />
                  </td>
                </tr>
                <tr class="active">
                  <td class="all" nowrap>John</td>
                  <td class="all" nowrap>100022</td>
                  <td class="all" nowrap>std15</td>
                  <td class="all" nowrap>
                    <input type="checkbox" checked data-toggle="toggle" data-size="xs" />
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-body" v-if="staff === true">
          <input type="text" placeholder="Search..." class="searchText" />
          <div class="copyRows">
            <div class="row" id="copyRow">
              <div class="col-2">
                <a href="#" title="Copy">
                  <i class="fa fa-copy"></i>
                </a>
              </div>
              <div class="col-2">
                <a href="#" title="Excel">
                  <i class="fa fa-file-excel-o"></i>
                </a>
              </div>
              <div class="col-2">
                <a href="#" title="PDF">
                  <i class="fa fa-file-pdf-o"></i>
                </a>
              </div>
              <div class="col-2">
                <a href="#" title="Print">
                  <i class="fa fa-print"></i>
                </a>
              </div>
              <div class="col-2">
                <a href="#" title="Columns">
                  <i class="fa fa-columns"></i>
                </a>
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table table-hover table-striped" id="studenttable">
              <thead>
                <tr>
                  <th class="all" nowrap>Staff ID</th>
                  <th class="all" nowrap>Name</th>
                  <th class="all" nowrap>Email</th>
                  <th class="all" nowrap>Role</th>
                  <th class="all" nowrap>Designation</th>
                  <th class="all" nowrap>Department</th>
                  <th class="all" nowrap>Phone</th>
                  <th class="all" nowrap>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr class="active">
                  <td class="all" nowrap>9000</td>
                  <td class="all" nowrap>Stephen</td>
                  <td class="all" nowrap>stephen@gmail.com</td>
                  <td class="all" nowrap>Super Admin</td>
                  <td class="all" nowrap>Admin</td>
                  <td class="all" nowrap>Admin</td>
                  <td class="all" nowrap>7865345</td>
                  <td class="all" nowrap>
                    <input type="checkbox" checked data-toggle="toggle" data-size="xs" />
                  </td>
                </tr>
                <tr class="active">
                  <td class="all" nowrap>9003</td>
                  <td class="all" nowrap>Vilaie</td>
                  <td class="all" nowrap>vaid@gmail.com</td>
                  <td class="all" nowrap>Admin</td>
                  <td class="all" nowrap>Principal</td>
                  <td class="all" nowrap>Admin</td>
                  <td class="all" nowrap>95474355</td>
                  <td class="all" nowrap>
                    <input type="checkbox" checked data-toggle="toggle" data-size="xs" />
                  </td>
                </tr>
              </tbody>
            </table>
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
      student: true,
      parent: false,
      staff: false
    };
  },
  methods: {
    toggleBtns(id, id1, id2) {
      if (id == "student") {
        this.student = true;
        this.parent = false;
        this.staff = false;
      } else if (id == "parent") {
        this.student = false;
        this.parent = true;
        this.staff = false;
      } else if (id == "staff") {
        this.student = false;
        this.parent = false;
        this.staff = true;
      }
      document.getElementById(id).style.backgroundColor = "white";
      document.getElementById(id).style.color = "Black";
      document.getElementById(id1).style.backgroundColor = "transparent";
      document.getElementById(id1).style.color = "white";
      document.getElementById(id2).style.backgroundColor = "transparent";
      document.getElementById(id2).style.color = "white";
    }
  }
};
</script>