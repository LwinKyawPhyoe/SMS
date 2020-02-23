<template>
    <div class="form" id="bar">
        <div class="toplink">
            <h2 class="stuName">
                HRM
            </h2>
            <h4 class="stuLink">
                <router-link to="/home" class="home">Home </router-link> > Staff Attendance
            </h4>
        </div>
        <hr>

        <div class="card">
            <div class="card-header">
                <h6>Select Attendance</h6>
            </div>
            <div class="card-body">
                <div class="row" id="row" style="margin: 0px;">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 textbox">
                        <label for="name" class="title">Role
                            <strong>*</strong>
                        </label>
                        <select class="inputbox" name="class">
                            <option selected disabled>Select</option>
                            <option value="Admin">Admin</option>
                            <option value="Teacher">Teacher</option>
                            <option value="Accountant">Accountant</option>
                        </select>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 textbox">
                        <label for="name">Attendance Date</label>
                        <input type="date" class="inputbox" id="attendanceDate">
                    </div>
                    <div class="col-12">
                        <button class="searchButton" id="globalSearch">Search</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h6>Staff List</h6>
            </div>
            <div class="card-body">
                    <label class="btn btn-dark smallButton">
                        <input type="checkbox" style="margin-right:5px;" /> Mark as holiday
                    </label>
                    <a href="#" style="outline:none;float:right;" class="btn btn-dark smallButton">
                        Save Attendance
                    </a>
                <div class="row" id="row" style="width:100%;">
                    <div class="table-responsive">            
                        <table class="table table-hover table-striped" id="studenttable">
                            <thead>
                                <tr>
                                    <th class="all" nowrap>No</th>
                                    <th class="all" nowrap>Staff ID</th>
                                    <th class="all" nowrap>Name</th>
                                    <th class="all" nowrap>Role</th>
                                    <th class="all" colspan="4" nowrap>Attendance</th>
                                    <th class="all" nowrap>Note</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="active">
                                    <td class="all" nowrap>1</td>
                                    <td class="all" nowrap>9001</td>
                                    <td class="all" nowrap>David Beckham</td>
                                    <td class="all" nowrap>Super Admin</td>
                                    <td>
                                        <label class="radio-inline">
                                            <input type="radio" name="subjectType" checked value="Present" /> Present
                                        </label>
                                    </td>
                                    <!-- <td>
                                        <label class="radio-inline">
                                            <input type="radio" name="subjectType" value="Late with excuse" /> Late with excuse
                                        </label>
                                    </td> -->
                                    <td>
                                        <label class="radio-inline">
                                            <input type="radio" name="subjectType" value="Late" /> Late
                                        </label>
                                    </td>
                                    <td>
                                        <label class="radio-inline">
                                            <input type="radio" name="subjectType" value="Absent" /> Absent
                                        </label>
                                    </td>
                                    <td>
                                        <label class="radio-inline">
                                            <input type="radio" name="subjectType" value="Holiday" /> Holiday
                                        </label>
                                    </td>
                                    <td>
                                        <input type="text" name="note" class="note">
                                    </td>
                                </tr>
                                <tr class="active">
                                    <td class="all" nowrap>2</td>
                                    <td class="all" nowrap>9002</td>
                                    <td class="all" nowrap>Lional Messi</td>
                                    <td class="all" nowrap>Teacher</td>
                                    <td>
                                        <label class="radio-inline">
                                            <input type="radio" name="subjectTypes" checked value="Present" /> Present
                                        </label>
                                    </td>
                                    <!-- <td>
                                        <label class="radio-inline">
                                            <input type="radio" name="subjectTypes" value="Late with excuse" /> Late with excuse
                                        </label>
                                    </td> -->
                                    <td>
                                        <label class="radio-inline">
                                            <input type="radio" name="subjectTypes" value="Late" /> Late
                                        </label>
                                    </td>
                                    <td>
                                        <label class="radio-inline">
                                            <input type="radio" name="subjectTypes" value="Absent" /> Absent
                                        </label>
                                    </td>
                                    <td>
                                        <label class="radio-inline">
                                            <input type="radio" name="subjectTypes" value="Holiday" /> Holiday
                                        </label>
                                    </td>
                                    <td>
                                        <input type="text" name="note" class="note">
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