<template>
  <div class="form" id="bar">
    <div class="toplink">
      <h2 class="stuName">Academics</h2>
      <h4 class="stuLink">
        <router-link to="home" class="home">Home</router-link> 
        > <router-link to="/viewtimetable" class="home">Class TimeTable</router-link> > Create Class TimeTable
      </h4>
    </div>
    <hr style="margin-bottom: -0.5rem;" />

    <div class="card">
      <div class="card-header">
        <h6>Select Criteria</h6>
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
              Subject
              <strong>*</strong>
            </label>
            <select class="inputbox" name="class">
              <option selected disabled>Select Subject</option>
              <option value="English (Theory)">English (Theory)</option>
              <option value="Hindi (Theory)">Hindi (Theory)</option>
              <option value="Science (Theory)">Science (Theory)</option>
            </select>
          </div>
          <div class="col-12">
            <button class="searchButton">Search</button>
          </div>
        </div>
      </div>

      <div class="sub-header">
        <h6>Class Timetable</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover table-striped" id="studenttable">
            <thead>
              <tr>
                <th class="all" nowrap style="padding-left: 10px;">Day</th>
                <th class="all" nowrap style="padding-left: 25px;">Start Time</th>
                <th class="all" nowrap style="padding-left: 25px;">End Time</th>
                <th class="all" nowrap style="padding-left: 25px;">Room Number</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="all" nowrap>Monday</td>
                <td class="all" nowrap>
                  <div class="col-12">
                    <input type="text" class="inputbox" name="starttime" />
                  </div>
                </td>
                <td class="all" nowrap>
                  <div class="col-12">
                    <input type="text" class="inputbox" name="endtime" />
                  </div>
                </td>
                <td class="all" nowrap>
                  <div class="col-12">
                    <input type="text" class="inputbox" name="roomnumber" />
                  </div>
                </td>
              </tr>
              <tr>
                <td class="all" nowrap>Tuesday</td>
                <td class="all" nowrap>
                  <div class="col-12">
                    <input type="text" class="inputbox" name="starttime" />
                  </div>
                </td>
                <td class="all" nowrap>
                  <div class="col-12">
                    <input type="text" class="inputbox" name="endtime" />
                  </div>
                </td>
                <td class="all" nowrap>
                  <div class="col-12">
                    <input type="text" class="inputbox" name="roomnumber" />
                  </div>
                </td>
              </tr>
              <tr>
                <td class="all" nowrap>Wednesday</td>
                <td class="all" nowrap>
                  <div class="col-12">
                    <input type="text" class="inputbox" name="starttime" />
                  </div>
                </td>
                <td class="all" nowrap>
                  <div class="col-12">
                    <input type="text" class="inputbox" name="endtime" />
                  </div>
                </td>
                <td class="all" nowrap>
                  <div class="col-12">
                    <input type="text" class="inputbox" name="roomnumber" />
                  </div>
                </td>
              </tr>
              <tr>
                <td class="all" nowrap>Thursday</td>
                <td class="all" nowrap>
                  <div class="col-12">
                    <input type="text" class="inputbox" name="starttime" />
                  </div>
                </td>
                <td class="all" nowrap>
                  <div class="col-12">
                    <input type="text" class="inputbox" name="endtime" />
                  </div>
                </td>
                <td class="all" nowrap>
                  <div class="col-12">
                    <input type="text" class="inputbox" name="roomnumber" />
                  </div>
                </td>
              </tr>
              <tr>
                <td class="all" nowrap>Friday</td>
                <td class="all" nowrap>
                  <div class="col-12">
                    <input type="text" class="inputbox" name="starttime" />
                  </div>
                </td>
                <td class="all" nowrap>
                  <div class="col-12">
                    <input type="text" class="inputbox" name="endtime" />
                  </div>
                </td>
                <td class="all" nowrap>
                  <div class="col-12">
                    <input type="text" class="inputbox" name="roomnumber" />
                  </div>
                </td>
              </tr>
              <tr>
                <td class="all" nowrap>Saturday</td>
                <td class="all" nowrap>
                  <div class="col-12">
                    <input type="text" class="inputbox" name="starttime" />
                  </div>
                </td>
                <td class="all" nowrap>
                  <div class="col-12">
                    <input type="text" class="inputbox" name="endtime" />
                  </div>
                </td>
                <td class="all" nowrap>
                  <div class="col-12">
                    <input type="text" class="inputbox" name="roomnumber" />
                  </div>
                </td>
              </tr>
              <tr>
                <td class="all" nowrap>Sunday</td>
                <td class="all" nowrap>
                  <div class="col-12">
                    <input type="text" class="inputbox" name="starttime" />
                  </div>
                </td>
                <td class="all" nowrap>
                  <div class="col-12">
                    <input type="text" class="inputbox" name="endtime" />
                  </div>
                </td>
                <td class="all" nowrap>
                  <div class="col-12">
                    <input type="text" class="inputbox" name="roomnumber" />
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-12">
          <button class="save" style="margin:-1rem 0 1rem;">Save</button>
        </div>
      </div>
    </div>
  </div>
</template>