<template>
  <div class="form" id="bar">
    <div class="toplink">
      <h2 class="stuName">Academics</h2>
      <h4 class="stuLink">
        <a href style="text-decoration:none;color:#1b5e20;">Home</a> > Class TimeTable
      </h4>
    </div>
    <hr style="margin-bottom: -0.5rem;" />

    <div class="card">
      <div class="card-header">
        <h6>Select Criteria</h6>
        <router-link to="/timetable" onclick="showForm()" class="add">Add</router-link>
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
    </div>

    <div class="card">
      <div class="card-header">
        <h6>Class Timetable</h6>
      </div>
      <div class="card-body">
        <input type="text" placeholder="Search..." class="searchText" />
        <div class="copyRows">
          <div class="row" id="copyRow">                
            <div class="col-3">
              <a href="#" @click.prevent="downloadExcel('studenttable', 'name', 'Tran_Route.xls')" title="Excel">
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
              <tr>
                <th class="all" nowrap>Subject</th>
                <th class="all" nowrap>Monday</th>
                <th class="all" nowrap>Tuesday</th>
                <th class="all" nowrap>Wednesday</th>
                <th class="all" nowrap>Thursday</th>
                <th class="all" nowrap>Friday</th>
                <th class="all" nowrap>Saturday</th>
                <th class="all" nowrap>Sunday</th>
              </tr>
            </thead>
            <tbody>
              <tr class="active">
                <td class="all" nowrap>English</td>
                <td class="all" nowrap>
                  <label style="display: block; margin: 0px;">09:00 AM - 09:45 AM</label>
                  <label style="display: block; margin: 0px;">Room Number: 101</label>
                </td>
                <td class="all" nowrap>
                  <label style="display: block; margin: 0px;">09:00 AM - 09:45 AM</label>
                  <label style="display: block; margin: 0px;">Room Number: 101</label>
                </td>
                <td class="all" nowrap>
                  <label style="display: block; margin: 0px;">09:00 AM - 09:45 AM</label>
                  <label style="display: block; margin: 0px;">Room Number: 101</label>
                </td>
                <td class="all" nowrap>
                  <label style="display: block; margin: 0px;">09:00 AM - 09:45 AM</label>
                  <label style="display: block; margin: 0px;">Room Number: 101</label>
                </td>
                <td class="all" nowrap>
                  <label style="display: block; margin: 0px;">09:00 AM - 09:45 AM</label>
                  <label style="display: block; margin: 0px;">Room Number: 101</label>
                </td>
                <td class="all" nowrap>
                  <label style="display: block; margin: 0px;">09:00 AM - 09:45 AM</label>
                  <label style="display: block; margin: 0px;">Room Number: 101</label>
                </td>
                <td class="all" nowrap>
                  <label style="display: block; margin: 0px;">09:00 AM - 09:45 AM</label>
                  <label style="display: block; margin: 0px;">Room Number: 101</label>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>