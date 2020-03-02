<template>
  <div>
    <div class="navbar mobile colour" @click="openSidebar()">
      <div class="btnsidebar">
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
      </div>
      <!-- <h3>School Name</h3> -->
      <!-- <span>Haha</span> -->
    </div>

    <div class="shadow" id="shadow" @click="closeSidebar()"></div>
    <div class="sidebarM" id="sidebar">
      <div class="top-section">
        <div class="academic mobile">
          <label
            for
            class="fontColour"
            style="font-size:16px;color:white"
          >Current Session: 2020_2021</label>
          <i class="fa fa-pencil pen fontColour" style="margin-left:10px;color:white"></i>
        </div>
        <div class="row profile">
          <img src="/account.jpg" alt class="image" />
          <div class="aboutAdmin">
            <label for>Admin name</label>
            <br />
            <label for>Gmail@.com</label>
          </div>
        </div>
      </div>
      <div class="nav-content">
        <div class="item" @click="closeSidebar()">
          <router-link to="dashboard">
            <i class="fa fa-credit-card" id="Icons"></i>Dashboard
          </router-link>
        </div>
        <div class="item" id="StudentItem">
          <div @click="openDropDown('Student','StudentItem')">
            <router-link to class="router">
              <i class="fa fa-users" id="Icons"></i>Student
            </router-link>
          </div>
          <div class="item-body" id="Student">
            <div class="item-content" @click="closeSidebar()">
              <router-link to="StudentInformation">
                <i class="fa fa-angle-double-right" id="Icons"></i>Student Details
              </router-link>
            </div>
            <div class="item-content" @click="closeSidebar()">
              <router-link to="AddStudent">
                <i class="fa fa-angle-double-right" id="Icons"></i>Student Admission
              </router-link>
            </div>
          </div>
        </div>

        <div class="item" id="AttendenceItem">
          <div @click="openDropDown('Attendance','AttendenceItem')">
            <router-link to class="router">
              <i class="fa fa-calendar" id="Icons"></i>Attendance
            </router-link>
          </div>
          <div class="item-body" id="Attendance">
            <div class="item-content" @click="closeSidebar()">
              <router-link to="stuattendance">
                <i class="fa fa-angle-double-right" id="Icons"></i>Student Attendance
              </router-link>
            </div>
            <div class="item-content" @click="closeSidebar()">
              <router-link to="attendancedate">
                <i class="fa fa-angle-double-right" id="Icons"></i>Attendance By Date
              </router-link>
            </div>
          </div>
        </div>

        <div class="item" id="ExaminationItem">
          <div @click="openDropDown('Examination','ExaminationItem')">
            <router-link to class="router">
              <i class="fa fa-clipboard" id="Icons"></i>Examination
            </router-link>
          </div>
          <div class="item-body" id="Examination">
            <div class="item-content" @click="closeSidebar()">
              <router-link to="ExamList">
                <i class="fa fa-angle-double-right" id="Icons"></i>ExamList
              </router-link>
            </div>
            <div class="item-content" @click="closeSidebar()">
              <router-link to="examschadule">
                <i class="fa fa-angle-double-right" id="Icons"></i>Exam Schadule
              </router-link>
            </div>
            <div class="item-content" @click="closeSidebar()">
              <router-link to="markgrade">
                <i class="fa fa-angle-double-right" id="Icons"></i>Marks Grade
              </router-link>
            </div>
            <div class="item-content" @click="closeSidebar()">
              <router-link to="MarkRegister">
                <i class="fa fa-angle-double-right" id="Icons"></i>Marks Register
              </router-link>
            </div>
          </div>
        </div>

        <div class="item" id="AcademicsItem">
          <div @click="openDropDown('Academics','AcademicsItem')">
            <router-link to class="router">
              <i class="fa fa-graduation-cap" id="Icons"></i>Academics
            </router-link>
          </div>
          <div class="item-body" id="Academics">
            <div class="item-content" @click="closeSidebar()">
              <router-link to="viewtimetable">
                <i class="fa fa-angle-double-right" id="Icons"></i>Class TimeTable
              </router-link>
            </div>
            <div class="item-content" @click="closeSidebar()">
              <router-link to="classteacher">
                <i class="fa fa-angle-double-right" id="Icons"></i>Assign Class Teacher
              </router-link>
            </div>
            <div class="item-content" @click="closeSidebar()">
              <router-link to="viewasssubjects">
                <i class="fa fa-angle-double-right" id="Icons"></i>Assign Subjects
              </router-link>
            </div>
            <div class="item-content" @click="closeSidebar()">
              <router-link to="prostudents">
                <i class="fa fa-angle-double-right" id="Icons"></i>Promote Student
              </router-link>
            </div>
            <div class="item-content" @click="closeSidebar()">
              <router-link to="subjects">
                <i class="fa fa-angle-double-right" id="Icons"></i>Subjects
              </router-link>
            </div>
            <div class="item-content" @click="closeSidebar()">
              <router-link to="class">
                <i class="fa fa-angle-double-right" id="Icons"></i>Class
              </router-link>
            </div>
            <div class="item-content" @click="closeSidebar()">
              <router-link to="sections">
                <i class="fa fa-angle-double-right" id="Icons"></i>Sections
              </router-link>
            </div>
            <div class="item-content" @click="closeSidebar()">
              <router-link to="academicyear">
                <i class="fa fa-angle-double-right" id="Icons"></i>Academic Year
              </router-link>
            </div>
          </div>
        </div>

        <div class="item" id="HRMItem">
          <div @click="openDropDown('HRM','HRMItem')">
            <router-link to class="router">
              <i class="fa fa-street-view" id="Icons"></i>HRM
            </router-link>
          </div>
          <div class="item-body" id="HRM">
            <div class="item-content" @click="closeSidebar()">
              <router-link to="staffdirectory">
                <i class="fa fa-angle-double-right" id="Icons"></i>Staff Directory
              </router-link>
            </div>
            <div class="item-content" @click="closeSidebar()">
              <router-link to="staattendance">
                <i class="fa fa-angle-double-right" id="Icons"></i>Staff Attendence
              </router-link>
            </div>
            <div class="item-content" @click="closeSidebar()">
              <router-link to="department">
                <i class="fa fa-angle-double-right" id="Icons"></i>Department
              </router-link>
            </div>
            <div class="item-content" @click="closeSidebar()">
              <router-link to="designation">
                <i class="fa fa-angle-double-right" id="Icons"></i> Designation
              </router-link>
            </div>
          </div>
        </div>

        <div class="item" id="DownloadItem">
          <div @click="openDropDown('Download','DownloadItem')">
            <router-link to class="router">
              <i class="fa fa-download" id="Icons"></i>Download Center
            </router-link>
          </div>
          <div class="item-body" id="Download">
            <div class="item-content" @click="closeSidebar()">
              <router-link to="uploadcontent">
                <i class="fa fa-angle-double-right" id="Icons"></i>Upload Content
              </router-link>
            </div>
            <div class="item-content" @click="closeSidebar()">
              <router-link to="assignment">
                <i class="fa fa-angle-double-right" id="Icons"></i>Assignments
              </router-link>
            </div>
            <div class="item-content" @click="closeSidebar()">
              <router-link to="stumaterial">
                <i class="fa fa-angle-double-right" id="Icons"></i>Study Material
              </router-link>
            </div>
            <div class="item-content" @click="closeSidebar()">
              <router-link to="syllabus">
                <i class="fa fa-angle-double-right" id="Icons"></i> Syllabus
              </router-link>
            </div>
            <div class="item-content" @click="closeSidebar()">
              <router-link to="othdownload">
                <i class="fa fa-angle-double-right" id="Icons"></i> Other Downloads
              </router-link>
            </div>
          </div>
        </div>

        <div class="item" id="HomeWorkItem">
          <div @click="openDropDown('HomeWork','HomeWorkItem')">
            <router-link to class="router">
              <i class="fa fa-flask" id="Icons"></i> HomeWork
            </router-link>
          </div>
          <div class="item-body" id="HomeWork">
            <div class="item-content" @click="closeSidebar()">
              <router-link to="homework">
                <i class="fa fa-angle-double-right" id="Icons"></i>Add HomeWork
              </router-link>
            </div>
            <div class="item-content" @click="closeSidebar()">
              <router-link to="evaluation_report">
                <i class="fa fa-angle-double-right" id="Icons"></i>Evaluation Report
              </router-link>
            </div>
          </div>
        </div>

        <div class="item" id="TransportItem">
          <div @click="openDropDown('Transport','TransportItem')">
            <router-link to class="router">
              <i class="fa fa-bus" id="Icons"></i> Transport
            </router-link>
          </div>
          <div class="item-body" id="Transport">
            <div class="item-content" @click="closeSidebar()">
              <router-link to="routes">
                <i class="fa fa-angle-double-right" id="Icons"></i> Routes
              </router-link>
            </div>
            <div class="item-content" @click="closeSidebar()">
              <router-link to="vehicle">
                <i class="fa fa-angle-double-right" id="Icons"></i>Vehicles
              </router-link>
            </div>
            <div class="item-content" @click="closeSidebar()">
              <router-link to="assvehicle">
                <i class="fa fa-angle-double-right" id="Icons"></i>Assign Vehicles
              </router-link>
            </div>
          </div>
        </div>

        <div class="item" id="HostelItem">
          <div @click="openDropDown('Hostel','HostelItem')">
            <router-link to class="router">
              <i class="fa fa-building" id="Icons"></i> Hostel
            </router-link>
          </div>
          <div class="item-body" id="Hostel">
            <div class="item-content" @click="closeSidebar()">
              <router-link to="hostelroom">
                <i class="fa fa-angle-double-right" id="Icons"></i> Hostel Rooms
              </router-link>
            </div>
            <div class="item-content" @click="closeSidebar()">
              <router-link to="roomtype">
                <i class="fa fa-angle-double-right" id="Icons"></i>Room Types
              </router-link>
            </div>
            <div class="item-content" @click="closeSidebar()">
              <router-link to="hostel">
                <i class="fa fa-angle-double-right" id="Icons"></i>Hostel
              </router-link>
            </div>
          </div>
        </div>

        <div class="item" id="ReportsItem">
          <div @click="openDropDown('Reports','ReportsItem')">
            <router-link to class="router">
              <i class="fa fa-bar-chart" id="Icons"></i> Reports
            </router-link>
          </div>
          <div class="item-body" id="Reports">
            <div class="item-content" @click="closeSidebar()">
              <router-link to="stureport">
                <i class="fa fa-angle-double-right" id="Icons"></i> Student Reports
              </router-link>
            </div>
            <div class="item-content" @click="closeSidebar()">
              <router-link to>
                <i class="fa fa-angle-double-right" id="Icons"></i>Student Guardians
              </router-link>
            </div>
            <div class="item-content" @click="closeSidebar()">
              <router-link to="studenthistory">
                <i class="fa fa-angle-double-right" id="Icons"></i>Student History
              </router-link>
            </div>
            <div class="item-content" @click="closeSidebar()">
              <router-link to="attendancereport">
                <i class="fa fa-angle-double-right" id="Icons"></i>Attendence Reports
              </router-link>
            </div>
            <div class="item-content" @click="closeSidebar()">
              <router-link to="MarkRegister">
                <i class="fa fa-angle-double-right" id="Icons"></i>Exam Marks Reports
              </router-link>
            </div>
            <div class="item-content" @click="closeSidebar()">
              <router-link to>
                <i class="fa fa-angle-double-right" id="Icons"></i>Close Academic
              </router-link>
            </div>
            <div class="item-content" @click="closeSidebar()">
              <router-link to="staattreport">
                <i class="fa fa-angle-double-right" id="Icons"></i>Stuff Attendence Report
              </router-link>
            </div>
            <div class="item-content" @click="closeSidebar()">
              <router-link to="stutransportreport">
                <i class="fa fa-angle-double-right" id="Icons"></i>Student Transport Report
              </router-link>
            </div>
            <div class="item-content" @click="closeSidebar()">
              <router-link to="stuhostelreport">
                <i class="fa fa-angle-double-right" id="Icons"></i>Student Hostel Reports
              </router-link>
            </div>
          </div>
        </div>

        <div class="item" id="SystemSettingItem">
          <div @click="openDropDown('SystemSetting','SystemSettingItem')">
            <router-link to class="router">
              <i class="fa fa-sliders" id="Icons"></i> System Setting
            </router-link>
          </div>
          <div class="item-body" id="SystemSetting">
            <div class="item-content" @click="closeSidebar()">
              <router-link to="gensetting">
                <i class="fa fa-angle-double-right" id="Icons"></i> General Setting
              </router-link>
            </div>
            <div class="item-content" @click="closeSidebar()">
              <router-link to="role">
                <i class="fa fa-angle-double-right" id="Icons"></i>Roles Permissions
              </router-link>
            </div>
            <div class="item-content" @click="closeSidebar()">
              <router-link to="users">
                <i class="fa fa-angle-double-right" id="Icons"></i>Users
              </router-link>
            </div>
          </div>
        </div>

        <div id="."></div>
      </div>
    </div>

    <div class="pc" style="padding:0px;margin:0px;">
      <div class="sidebar" id="bigBar">
        <div class="expandsidebar" id="schoolName">
          <div class="header">
            <div class="row sidebar_header">
              <div class="col-12">
                <h5 style="font-size: 18pt;" class="projectName">{{this.school.school_name}}</h5>
              </div>
            </div>

            <div class="body_content" id="body_content">
              <ul class="additional-menu">
                <li class="dashboardLink">
                    <router-link class="routerLink navList" id="globalLink globalList" to="/dashboard">
                      <i class="fa fa-credit-card" id="sidebarIcon"></i>Dashboard
                    </router-link>
                </li>
                <li>
                  <a @click="dropdown('link','dropIcon')" class="navList" id="globalList">
                    <router-link class="routerLink" id="globalLink" to>
                      <i class="fa fa-users" id="sidebarIcon"></i>Students
                      <i class="fa fa-angle-right dropIcon" id="dropIcon"></i>
                    </router-link>
                  </a>
                  <div class="dropdownForm" id="dropdownForm">
                    <ul class="link" id="link">
                      <li class="nav-list">
                        <router-link class="nav-list" id="nav-list" to="/StudentInformation">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Student Details
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/AddStudent" id="nav-list" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Student Admission
                        </router-link>
                      </li>
                    </ul>
                  </div>
                </li>
                <li>
                  <a @click="dropdown('link1','dropIcon1')" class="navList" id="globalList">
                    <router-link class="routerLink" id="globalLink" to>
                      <i class="fa fa-calendar" id="sidebarIcon"></i>Attendance
                      <i class="fa fa-angle-right dropIcon" id="dropIcon1"></i>
                    </router-link>
                  </a>
                  <div class="dropdownForm" id="dropdownForm">
                    <ul class="link" id="link1">
                      <li class="nav-list">
                        <router-link class="nav-list" id="nav-list" to="/stuattendance">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Student Attendance
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/attendancedate" id="nav-list" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Attendance By Date
                        </router-link>
                      </li>
                    </ul>
                  </div>
                </li>
                <li>
                  <a @click="dropdown('link2','dropIcon2')" class="navList" id="globalList">
                    <router-link class="routerLink" id="globalLink" to>
                      <i class="fa fa-clipboard" id="sidebarIcon"></i>Examinations
                      <i class="fa fa-angle-right dropIcon" id="dropIcon2"></i>
                    </router-link>
                  </a>
                  <div class="dropdownForm" id="dropdownForm">
                    <ul class="link" id="link2">
                      <li class="nav-list">
                        <router-link class="nav-list" id="nav-list" to="/ExamList">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Exam List
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/examschadule" id="nav-list" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Exam Schedule
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/markgrade" id="nav-list" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Marks Grade
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/MarkRegister" id="nav-list" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Marks Register
                        </router-link>
                      </li>
                    </ul>
                  </div>
                </li>
                <li>
                  <a @click="dropdown('link3','dropIcon3')" class="navList" id="globalList">
                    <router-link class="routerLink" id="globalLink" to>
                      <i
                        class="fa fa-graduation-cap"
                        style="margin:0 1.3rem !important;"
                        id="sidebarIcon"
                      ></i>Academics
                      <i class="fa fa-angle-right dropIcon" id="dropIcon3"></i>
                    </router-link>
                  </a>
                  <div class="dropdownForm" id="dropdownForm">
                    <ul class="link" id="link3">
                      <li class="nav-list">
                        <router-link class="nav-list" id="nav-list" to="/viewtimetable">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Class Timetable
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/classteacher" id="nav-list" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Assign Class Teacher
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/viewasssubjects" id="nav-list" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Assign Subjects
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/prostudents" id="nav-list" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Promote Students
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/subjects" id="nav-list" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Subjects
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/class" id="nav-list" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Class
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/sections" id="nav-list" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Sections
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/academicyear" id="nav-list" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Academic-Year
                        </router-link>
                      </li>
                    </ul>
                  </div>
                </li>
                <li>
                  <a @click="dropdown('link4','dropIcon4')" class="navList" id="globalList">
                    <router-link class="routerLink" id="globalLink" to>
                      <i class="fa fa-street-view" id="sidebarIcon"></i>HRM
                      <i class="fa fa-angle-right dropIcon" id="dropIcon4"></i>
                    </router-link>
                  </a>
                  <div class="dropdownForm" id="dropdownForm">
                    <ul class="link" id="link4">
                      <li class="nav-list">
                        <router-link class="nav-list" id="nav-list" to="/staffdirectory">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Staff Directory
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/staattendance" id="nav-list" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Staff Attendance
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/department" id="nav-list" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Department
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/designation" id="nav-list" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Designation
                        </router-link>
                      </li>
                    </ul>
                  </div>
                </li>
                <li>
                  <a @click="dropdown('link5','dropIcon5')" class="navList" id="globalList">
                    <router-link class="routerLink" id="globalLink" to>
                      <i class="fa fa-download" id="sidebarIcon"></i>Download Center
                      <i class="fa fa-angle-right dropIcon" id="dropIcon5"></i>
                    </router-link>
                  </a>
                  <div class="dropdownForm" id="dropdownForm">
                    <ul class="link" id="link5">
                      <li class="nav-list">
                        <router-link class="nav-list" id="nav-list" to="/uploadcontent">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Upload Content
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/assignment" id="nav-list" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Assignments
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/stumaterial" id="nav-list" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Study Material
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/syllabus" id="nav-list" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Syllabus
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/othdownload" id="nav-list" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Other Downloads
                        </router-link>
                      </li>
                    </ul>
                  </div>
                </li>
                <li>
                  <a @click="dropdown('link6','dropIcon6')" class="navList" id="globalList">
                    <router-link class="routerLink" id="globalLink" to>
                      <i class="fa fa-flask" id="sidebarIcon"></i>Homework
                      <i class="fa fa-angle-right dropIcon" id="dropIcon6"></i>
                    </router-link>
                  </a>
                  <div class="dropdownForm" id="dropdownForm">
                    <ul class="link" id="link6">
                      <li class="nav-list">
                        <router-link class="nav-list" id="nav-list" to="/homework">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Add Homework
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/evaluation_report" class="nav-list" id="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Evaluation Report
                        </router-link>
                      </li>
                    </ul>
                  </div>
                </li>
                <li>
                  <a @click="dropdown('link7','dropIcon7')" class="navList" id="globalList">
                    <router-link class="routerLink" id="globalLink" to>
                      <i class="fa fa-bus" id="sidebarIcon"></i>Transport
                      <i class="fa fa-angle-right dropIcon" id="dropIcon7"></i>
                    </router-link>
                  </a>
                  <div class="dropdownForm" id="dropdownForm">
                    <ul class="link" id="link7">
                      <li class="nav-list">
                        <router-link class="nav-list" id="nav-list" to="/routes">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Routes
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/vehicle" id="nav-list" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Vehicles
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/assvehicle" id="nav-list" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Assign Vehicle
                        </router-link>
                      </li>
                    </ul>
                  </div>
                </li>
                <li>
                  <a @click="dropdown('link8','dropIcon8')" class="navList" id="globalList">
                    <router-link class="routerLink" id="globalLink" to>
                      <i class="fa fa-building" id="sidebarIcon"></i>Hostel
                      <i class="fa fa-angle-right dropIcon" id="dropIcon8"></i>
                    </router-link>
                  </a>
                  <div class="dropdownForm" id="dropdownForm">
                    <ul class="link" id="link8">
                      <li class="nav-list">
                        <router-link class="nav-list" id="nav-list" to="/hostelroom">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Hostel Rooms
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/roomtype" id="nav-list" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Room Type
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/hostel" id="nav-list" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Hostel
                        </router-link>
                      </li>
                    </ul>
                  </div>
                </li>
                <li>
                  <a @click="dropdown('link9','dropIcon9')" class="navList" id="globalList">
                    <router-link class="routerLink" id="globalLink" to>
                      <i
                        class="fa fa-bar-chart"
                        style="margin:0 1.3rem !important;"
                        id="sidebarIcon"
                      ></i>Reports
                      <i class="fa fa-angle-right dropIcon" id="dropIcon9"></i>
                    </router-link>
                  </a>
                  <div class="dropdownForm" id="dropdownForm">
                    <ul class="link" id="link9">
                      <li class="nav-list">
                        <router-link class="nav-list" id="nav-list" to="/stureport">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Student Report
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link class="nav-list" id="nav-list" to>
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Student Guardian
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/studenthistory" id="nav-list" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Student History
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/attendancereport" id="nav-list" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Attendance Report
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/MarkRegister" id="nav-list" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Exam Marks Report
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link class="nav-list" id="nav-list" to>
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Close Academics
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/staattreport" id="nav-list" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Staff Attendance Report
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/stutransportreport" id="nav-list" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Student Transport Report
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/stuhostelreport" id="nav-list" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Student Hostel Report
                        </router-link>
                      </li>
                    </ul>
                  </div>
                </li>
                <li>
                  <a @click="dropdown('link10','dropIcon10')" class="navList" id="globalList">
                    <router-link class="routerLink" id="globalLink" to>
                      <i class="fa fa-sliders" id="sidebarIcon"></i>System Settings
                      <i class="fa fa-angle-right dropIcon" id="dropIcon10"></i>
                    </router-link>
                  </a>
                  <div class="dropdownForm" id="dropdownForm">
                    <ul class="link" id="link10">
                      <li class="nav-list">
                        <router-link class="nav-list" id="nav-list" to="/gensetting">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>General Setting
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="role" class="nav-list" id="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Roles Permissions
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/users" class="nav-list" id="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Users
                        </router-link>
                      </li>
                    </ul>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div class="smallView" id="smallBar">
        <div class="exit">
          <label class="bigView" id="bigView" onclick="changeBar()">X</label>
        </div>

        <div class="smallBar" id="smBar">
          <ul class="Links" id="Links" onclick="showForm()">
            <router-link class="link" to="/dashboard">
              <li>
                <i class="fa fa-credit-card smallIcon"></i>
              </li>
            </router-link>
            <a class="link">
              <li>
                <i class="fa fa-group smallIcon"></i>
                <ul class="smallLists">
                  <router-link to="/StudentInformation" class="smallLink">
                    <li class="smLink">
                      <i class="fa fa-angle-double-right smIcon"></i>
                      Student Details
                    </li>
                  </router-link>
                  <router-link to="/AddStudent" class="smallLink">
                    <li class="smLink">
                      <i class="fa fa-angle-double-right smIcon"></i>
                      Student Admission
                    </li>
                  </router-link>
                </ul>
              </li>
            </a>
            <a class="link">
              <li>
                <i class="fa fa-calendar smallIcon" style="zoom:1.3 !important;"></i>
                <ul class="smallLists">
                  <router-link to="/stuattendance" class="smallLink">
                    <li class="smLink">
                      <i class="fa fa-angle-double-right smIcon"></i>
                      Student Attendance
                    </li>
                  </router-link>
                  <router-link to="/attendancedate" class="smallLink">
                    <li class="smLink">
                      <i class="fa fa-angle-double-right smIcon"></i>
                      Attendance By Date
                    </li>
                  </router-link>
                </ul>
              </li>
            </a>
            <a class="link">
              <li>
                <i class="fa fa-clipboard smallIcon" style="zoom:1.2 !important;"></i>
                <ul class="smallLists">
                  <router-link to="/attendancedate" class="smallLink">
                    <li class="smLink">
                      <i class="fa fa-angle-double-right smIcon"></i>
                      Exam List
                    </li>
                  </router-link>
                  <router-link to="/examschadule" class="smallLink">
                    <li class="smLink">
                      <i class="fa fa-angle-double-right smIcon"></i>
                      Exam Schedule
                    </li>
                  </router-link>
                  <router-link to="/markgrade" class="smallLink">
                    <li class="smLink">
                      <i class="fa fa-angle-double-right smIcon"></i>
                      Marks Grade
                    </li>
                  </router-link>
                  <router-link to="/MarkRegister" class="smallLink">
                    <li class="smLink">
                      <i class="fa fa-angle-double-right smIcon"></i>
                      Marks Register
                    </li>
                  </router-link>
                </ul>
              </li>
            </a>
            <a class="link">
              <li>
                <i class="fa fa-graduation-cap smallIcon" style="zoom: 0.9 !important;"></i>
                <ul class="smallLists">
                  <router-link to="/viewtimetable" class="smallLink">
                    <li class="smLink">
                      <i class="fa fa-angle-double-right smIcon"></i>
                      Class Timetable
                    </li>
                  </router-link>
                  <router-link to="/classteacher" class="smallLink">
                    <li class="smLink">
                      <i class="fa fa-angle-double-right smIcon"></i>
                      Assign Class Teacher
                    </li>
                  </router-link>
                  <router-link to="/viewasssubjects" class="smallLink">
                    <li class="smLink">
                      <i class="fa fa-angle-double-right smIcon"></i>
                      Assign Subjects
                    </li>
                  </router-link>
                  <router-link to="prostudents" class="smallLink">
                    <li class="smLink">
                      <i class="fa fa-angle-double-right smIcon"></i>
                      Promote Students
                    </li>
                  </router-link>
                  <router-link to="/subjects" class="smallLink">
                    <li class="smLink">
                      <i class="fa fa-angle-double-right smIcon"></i>
                      Subjects
                    </li>
                  </router-link>
                  <router-link to="/class" class="smallLink">
                    <li class="smLink">
                      <i class="fa fa-angle-double-right smIcon"></i>
                      Class
                    </li>
                  </router-link>
                  <router-link to="/sections" class="smallLink">
                    <li class="smLink">
                      <i class="fa fa-angle-double-right smIcon"></i>
                      Sections
                    </li>
                  </router-link>
                  <router-link to="/academicyear" class="smallLink">
                    <li class="smLink">
                      <i class="fa fa-angle-double-right smIcon"></i>
                      Academic-Year
                    </li>
                  </router-link>
                </ul>
              </li>
            </a>
            <a class="link">
              <li>
                <i class="fa fa-street-view smallIcon" style="zoom: 1.4 !important;"></i>
                <ul class="smallLists">
                  <router-link to="/staffdirectory" class="smallLink">
                    <li class="smLink">
                      <i class="fa fa-angle-double-right smIcon"></i>
                      Staff Directory
                    </li>
                  </router-link>
                  <router-link to="/staattendance" class="smallLink">
                    <li class="smLink">
                      <i class="fa fa-angle-double-right smIcon"></i>
                      Staff Attendance
                    </li>
                  </router-link>
                  <router-link to="/department" class="smallLink">
                    <li class="smLink">
                      <i class="fa fa-angle-double-right smIcon"></i>
                      Department
                    </li>
                  </router-link>
                  <router-link to="designation" class="smallLink">
                    <li class="smLink">
                      <i class="fa fa-angle-double-right smIcon"></i>
                      Designation
                    </li>
                  </router-link>
                </ul>
              </li>
            </a>
            <a class="link">
              <li>
                <i class="fa fa-download smallIcon" style="zoom:1.3 !important;"></i>
                <ul class="smallLists">
                  <router-link to="/uploadcontent" class="smallLink">
                    <li class="smLink">
                      <i class="fa fa-angle-double-right smIcon"></i>
                      Upload Content
                    </li>
                  </router-link>
                  <router-link to="/assignment" class="smallLink">
                    <li class="smLink">
                      <i class="fa fa-angle-double-right smIcon"></i>
                      Assignments
                    </li>
                  </router-link>
                  <router-link to="/stumaterial" class="smallLink">
                    <li class="smLink">
                      <i class="fa fa-angle-double-right smIcon"></i>
                      Study Material
                    </li>
                  </router-link>
                  <router-link to="/syllabus" class="smallLink">
                    <li class="smLink">
                      <i class="fa fa-angle-double-right smIcon"></i>
                      Syllabus
                    </li>
                  </router-link>
                  <router-link to="/othdownload" class="smallLink">
                    <li class="smLink">
                      <i class="fa fa-angle-double-right smIcon"></i>
                      Other Downloads
                    </li>
                  </router-link>
                </ul>
              </li>
            </a>
            <a class="link">
              <li>
                <i class="fa fa-flask smallIcon" style="zoom:1.3 !important;"></i>
                <ul class="smallLists">
                  <router-link to="/homework" class="smallLink">
                    <li class="smLink">
                      <i class="fa fa-angle-double-right smIcon"></i>
                      Add Homework
                    </li>
                  </router-link>
                  <router-link to="/evaluation_report" class="smallLink">
                    <li class="smLink">
                      <i class="fa fa-angle-double-right smIcon"></i>
                      Evaluation Report
                    </li>
                  </router-link>
                </ul>
              </li>
            </a>
            <a class="link">
              <li>
                <i class="fa fa-bus smallIcon" style="zoom:1.3 !important;"></i>
                <ul class="smallLists">
                  <router-link to="/routes" class="smallLink">
                    <li class="smLink">
                      <i class="fa fa-angle-double-right smIcon"></i>
                      Routes
                    </li>
                  </router-link>
                  <router-link to="/vehicle" class="smallLink">
                    <li class="smLink">
                      <i class="fa fa-angle-double-right smIcon"></i>
                      Vehicles
                    </li>
                  </router-link>
                  <router-link to="/assvehicle" class="smallLink">
                    <li class="smLink">
                      <i class="fa fa-angle-double-right smIcon"></i>
                      Assign Vehicle
                    </li>
                  </router-link>
                </ul>
              </li>
            </a>
            <a class="link">
              <li>
                <i class="fa fa-building smallIcon" style="zoom:1.3 !important;"></i>
                <ul class="smallLists">
                  <router-link to="/hostelroom" class="smallLink">
                    <li class="smLink">
                      <i class="fa fa-angle-double-right smIcon"></i>
                      Hostel Rooms
                    </li>
                  </router-link>
                  <router-link to="/roomtype" class="smallLink">
                    <li class="smLink">
                      <i class="fa fa-angle-double-right smIcon"></i>
                      Room Type
                    </li>
                  </router-link>
                  <router-link to="/hostel" class="smallLink">
                    <li class="smLink">
                      <i class="fa fa-angle-double-right smIcon"></i>
                      Hostel
                    </li>
                  </router-link>
                </ul>
              </li>
            </a>
            <a class="link">
              <li>
                <i class="fa fa-bar-chart smallIcon"></i>
                <ul class="smallLists">
                  <router-link to="/stureport" class="smallLink">
                    <li class="smLink">
                      <i class="fa fa-angle-double-right smIcon"></i>
                      Student Report
                    </li>
                  </router-link>
                  <router-link to class="smallLink">
                    <li class="smLink">
                      <i class="fa fa-angle-double-right smIcon"></i>
                      Guardian Report
                    </li>
                  </router-link>
                  <router-link to="/studenthistory" class="smallLink">
                    <li class="smLink">
                      <i class="fa fa-angle-double-right smIcon"></i>
                      Student History
                    </li>
                  </router-link>
                  <router-link to="/studenthistory" class="smallLink">
                    <li class="smLink">
                      <i class="fa fa-angle-double-right smIcon"></i>
                      Attendance Report
                    </li>
                  </router-link>
                  <router-link to="/MarkRegister" class="smallLink">
                    <li class="smLink">
                      <i class="fa fa-angle-double-right smIcon"></i>
                      Exam Marks Report
                    </li>
                  </router-link>
                  <router-link to class="smallLink">
                    <li class="smLink">
                      <i class="fa fa-angle-double-right smIcon"></i>
                      Close Academics
                    </li>
                  </router-link>
                  <router-link to="/staattreport" class="smallLink">
                    <li class="smLink">
                      <i class="fa fa-angle-double-right smIcon"></i>
                      Staff Attendance Report
                    </li>
                  </router-link>
                  <router-link to="/stutransportreport" class="smallLink">
                    <li class="smLink">
                      <i class="fa fa-angle-double-right smIcon"></i>
                      Student Transport Report
                    </li>
                  </router-link>
                  <router-link to="/stuhostelreport" class="smallLink">
                    <li class="smLink">
                      <i class="fa fa-angle-double-right smIcon"></i>
                      Student Hostel Report
                    </li>
                  </router-link>
                </ul>
              </li>
            </a>
            <a class="link">
              <li>
                <i class="fa fa-sliders smallIcon" style="zoom:1.3 !important;"></i>
                <ul class="smallLists">
                  <router-link to="/gensetting" class="smallLink">
                    <li class="smLink">
                      <i class="fa fa-angle-double-right smIcon"></i>
                      General Setting
                    </li>
                  </router-link>
                  <router-link to="role" class="smallLink">
                    <li class="smLink">
                      <i class="fa fa-angle-double-right smIcon"></i>
                      Roles Permission
                    </li>
                  </router-link>
                  <router-link to="/users" class="smallLink">
                    <li class="smLink">
                      <i class="fa fa-angle-double-right smIcon"></i>
                      Users
                    </li>
                  </router-link>
                </ul>
              </li>
            </a>
          </ul>
        </div>
      </div>
    </div>    

    <div
      class="modal fade"
      id="exampleModalCenter1"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="width:653px !important;">
          <div class="modal-body" style="padding:0;">
            <div class="card-header" id="globalcardHeader" style="width: 100%;margin-left: 0;">
              <h6>Session</h6>
              <i
                class="fa fa-close"
                data-dismiss="modal"
                style="cursor: pointer;padding: 0 10px;position: absolute;right: 5px;"
              ></i>
            </div>
            <div class="textbox" style="width: 100% !important;padding: 1rem 1rem;">
              <label>Session</label>              
              <select class="inputbox" v-model="session_id">                              
                  <option v-for="session in sessionList" :key="session.id" :value="session.id">{{session.session}}</option>                
              </select>
            </div>
          </div>
          <div class="modal-footer" style="padding-top: 0;">
            <button type="button" @click="goSave()" id="globalSave" class="save">Save</button>
          </div>
        </div>
      </div>
    </div>

    <div class="content">
      <div class="content_header pc">
        <i class="fa fa-bars" id="list" onclick="changeBar()"></i>
        <div class="sessions row" id="sessions" style="margin-top: 5px;">
          <h5 class="session" data-toggle="modal" data-target="#exampleModalCenter1">
            Current Session : {{session}}
          </h5>          
        </div>
        <div class="Items">
          <div class="userTitle">
            <h5 class="userName">Technotrust</h5>
            <p>Admin</p>
          </div>
        </div>
        <div class="profile">
          <img src="/account.jpg" class="user" />
          <!-- <i class="fa fa-user-circle user"></i> -->
        </div>
        <div class="notific">
          <span class="badge">7</span>
          <i class="fa fa-bell bell"></i>
        </div>
        <div class="message">
          <span class="badge">7</span>
          <i class="fa fa-envelope mail"></i>
        </div>
        <div class="language">
          <i class="fa fa-globe lan"></i>
          EN
        </div>
      </div>
      <br />
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
import { EventBus } from "../js/event-bus.js";
export default {
  data() {
    return {
      colors: [],
      school: {},
      oldElemtnt: ".",
      oldItemId: ".",

      sessionList: [],
      session_id: "",
      session: ""
    };
  },
  created() {
    EventBus.$on("ThemeClicked", response => {
      this.getColor();
    });
    this.getColor();
    this.getAllSession();
    this.axios.get("/api/schools").then(response => {
      this.school = response.data;
    });    
  },
  methods: {
    getAllSession() {      
        this.sessionList = [];
        this.axios.get("/api/academicyr").then(response => {                        
            for(let i=0; i<response.data.length; i++){
              if(response.data[i].is_active != 'delete'){
                this.sessionList.push(response.data[i]);
              }
            }

            const found = this.sessionList.find(element => element.is_active == "yes");            
            this.session_id = found.id;
            this.session = found.session;
            console.log("session >>"+ this.session + "id >>>"+ this.session_id);
        });
    },

    goSave(){
      const found = this.sessionList.find(element => element.is_active == "yes");            
      var oldid = found.id;
      var AcademicYr = {"updateid": this.session_id, "oldid": oldid};
      this.axios
        .post("/api/AcademicYear/update", AcademicYr)
        .then(response => {           
           this.getAllSession();
           $('#exampleModalCenter1').modal('hide');
           window.location = window.location.href;
        })
        .catch(error => {
            console.log("err->" + JSON.stringify(this.error.response));
        });
    },

    dropdown(id, icon) {
      if (document.getElementById(id).style.display == "block") {
        document.getElementById(id).style.display = "none";
        document.getElementById(icon).style.transform = "rotate(0deg)";
      } else {
        document.getElementById(id).style.display = "block";
        document.getElementById(icon).style.transform = "rotate(90deg)";
      }
    },
    openSidebar() {
      document.getElementById("sidebar").style.marginLeft = "0";
      document.getElementById("sidebar").style.boxShadow = "0px 0px 10px black";
      document.getElementById("shadow").style.display = "block";
    },
    closeSidebar() {
      document.getElementById("sidebar").style.marginLeft = "-300px";
      document.getElementById("sidebar").style.boxShadow = "none";
      document.getElementById("shadow").style.display = "none";
    },
    openDropDown(contentID, ItemID) {
      var boxShhadow = "";
      if (this.colors.color == "defaultColor") {
        boxShhadow = "1px 1px 5px #1b5e20";
      } else if (this.colors.color == "redColor") {
        boxShhadow = "1px 1px 5px darkred";
      } else if (this.colors.color == "blueColor") {
        boxShhadow = "1px 1px 5px darkcyan";
      } else if (this.colors.color == "darkColor") {
        boxShhadow = "1px 1px 5px currentColor";
      } else if (this.colors.color == "lightColor") {
        boxShhadow = "1px 1px 5px rgb(156, 158, 156)";
      }

      if (document.getElementById(contentID).style.display == "block") {
        document.getElementById(contentID).style.display = "none";
        document.getElementById(ItemID).style.boxShadow = boxShhadow;
      } else {
        document.getElementById(contentID).style.display = "block";
        document.getElementById(ItemID).style.boxShadow = boxShhadow;
      }
      if (this.oldElemtnt != contentID) {
        if (document.getElementById(this.oldElemtnt).style.display == "block") {
          document.getElementById(this.oldElemtnt).style.display = "none";
        }
      }
      if (this.oldItemId != ItemID) {
        document.getElementById(this.oldItemId).style.boxShadow = "none";
      }
      this.oldElemtnt = contentID;
      this.oldItemId = ItemID;
    },
    getColor() {
      this.axios.get("/api/settings").then(response => {
        this.colors = response.data;
        if (this.colors.color == "defaultColor") {
          document.getElementById("schoolName").style.background = "#1b5e20";
          var dark = document.getElementsByClassName("dropdownForm");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "#044604";
          }
          var dark = document.getElementsByClassName("item-body");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.borderTop = "solid #1b5e20 1px";
          }
          var dark = document.getElementsByClassName("item");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.color = "#1b5e20";
          }
          var dark = document.getElementsByClassName("router");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.color = "#1b5e20";
          }
          var dark = document.getElementsByClassName("mobile");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "#1b5e20";
          }
          var dark = document.getElementsByClassName("block1");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.border = "2px solid rgb(252, 239, 44)";
          }
          var dark = document.getElementsByClassName("content");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "#1b5e20";
          }
          var dark = document.getElementsByClassName("card");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "khaki";
          }
          var dark = document.getElementsByClassName("card-header");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "#1b5e20";
          }
          var dark = document.getElementsByClassName("sub-header");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "#1b5e20";
          }
          var dark = document.getElementsByClassName("save");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "#1b5e20";
          }
          var dark = document.getElementsByClassName("searchButton");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "#1b5e20";
          }
          var dark = document.getElementsByClassName("viewButton");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "#1b5e20";
          }
          var dark = document.getElementsByClassName("edit");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "#1b5e20";
          }
          var dark = document.getElementsByClassName("editSm");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "#d8d8d8";
          }
          var dark = document.getElementsByClassName("bigView");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "#1b5e20";
          }
          var dark = document.getElementsByClassName("Links");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "#1b5e20";
          }
          var dark = document.getElementsByClassName("smLink");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "#1b5e20";
          }
        } else if (this.colors.color == "redColor") {
          var dark = document.getElementsByClassName("block2");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.border = "2px solid rgb(252, 239, 44)";
          }
          var dark = document.getElementsByClassName("item-body");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.borderTop = "solid darkred 1px";
          }
          var dark = document.getElementsByClassName("router");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.color = "darkred";
          }
          var dark = document.getElementsByClassName("mobile");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "darkred";
          }
          var dark = document.getElementsByClassName("item");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.color = "darkred";
          }
          var dark = document.getElementsByClassName("content");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "darkred";
          }
          document.getElementById("schoolName").style.background = "darkred";
          var dark = document.getElementsByClassName("dropdownForm");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "#670404";
          }
          var dark = document.getElementsByClassName("card");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "darkgrey";
          }
          var dark = document.getElementsByClassName("card-header");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "#5e1b1b";
          }
          var dark = document.getElementsByClassName("sub-header");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "#5e1b1b";
          }
          var dark = document.getElementsByClassName("save");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "#5e1b1b";
          }
          var dark = document.getElementsByClassName("searchButton");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "#5e1b1b";
          }
          var dark = document.getElementsByClassName("viewButton");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "#5e1b1b";
          }
          var dark = document.getElementsByClassName("edit");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "#5e1b1b";
          }
          var dark = document.getElementsByClassName("editSm");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "#d8d8d8";
          }
          var dark = document.getElementsByClassName("bigView");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "rgb(139, 0, 0)";
          }
          var dark = document.getElementsByClassName("Links");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "rgb(139, 0, 0)";
          }
          var dark = document.getElementsByClassName("smLink");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "#5e1b1b";
          }
        } else if (this.colors.color == "blueColor") {
          var dark = document.getElementsByClassName("block3");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.border = "2px solid rgb(252, 239, 44)";
          }
          var dark = document.getElementsByClassName("item-body");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.borderTop = "solid darkcyan 1px";
          }
          var dark = document.getElementsByClassName("router");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.color = "darkcyan";
          }
          var dark = document.getElementsByClassName("mobile");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "darkcyan";
          }
          var dark = document.getElementsByClassName("item");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.color = "darkcyan";
          }
          var dark = document.getElementsByClassName("content");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "darkcyan";
          }
          document.getElementById("schoolName").style.background = "darkcyan";
          var dark = document.getElementsByClassName("dropdownForm");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "#016868";
          }
          var dark = document.getElementsByClassName("card");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "powderblue";
          }
          var dark = document.getElementsByClassName("card-header");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "#1b5e5e";
          }
          var dark = document.getElementsByClassName("sub-header");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "#1b5e5e";
          }
          var dark = document.getElementsByClassName("save");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "#1b5e5e";
          }
          var dark = document.getElementsByClassName("searchButton");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "#1b5e5e";
          }
          var dark = document.getElementsByClassName("viewButton");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "#1b5e5e";
          }
          var dark = document.getElementsByClassName("edit");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "#1b5e5e";
          }
          var dark = document.getElementsByClassName("editSm");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "#d8d8d8";
          }
          var dark = document.getElementsByClassName("bigView");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "darkcyan";
          }
          var dark = document.getElementsByClassName("Links");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "darkcyan";
          }
          var dark = document.getElementsByClassName("smLink");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "#1b5e5e";
          }
        } else if (this.colors.color == "darkColor") {
          var dark = document.getElementsByClassName("block4");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.border = "2px solid rgb(252, 239, 44)";
          }
          var dark = document.getElementsByClassName("item-body");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.borderTop = "solid currentColor 1px";
          }
          var dark = document.getElementsByClassName("router");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.color = "currentColor";
          }
          var dark = document.getElementsByClassName("item");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.color = "currentColor";
          }
          var dark = document.getElementsByClassName("mobile");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "currentColor";
          }
          var dark = document.getElementsByClassName("content");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "currentColor";
          }
          document.getElementById("schoolName").style.background =
            "currentColor";
          var dark = document.getElementsByClassName("dropdownForm");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "#383c40";
          }
          var dark = document.getElementsByClassName("card");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "gainsboro";
          }
          var dark = document.getElementsByClassName("card-header");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "black";
          }
          var dark = document.getElementsByClassName("sub-header");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "black";
          }
          var dark = document.getElementsByClassName("save");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "black";
          }
          var dark = document.getElementsByClassName("searchButton");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "black";
          }
          var dark = document.getElementsByClassName("viewButton");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "black";
          }
          var dark = document.getElementsByClassName("edit");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "black";
          }
          var dark = document.getElementsByClassName("editSm");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "#d8d8d8";
          }
          var dark = document.getElementsByClassName("bigView");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "#212529";
          }
          var dark = document.getElementsByClassName("Links");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "#212529";
          }
          var dark = document.getElementsByClassName("smLink");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "black";
          }
        } else if (this.colors.color == "lightColor") {
          var dark = document.getElementsByClassName("block5");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.border = "2px solid rgb(252, 239, 44)";
          }
          var dark = document.getElementsByClassName("router");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.color = "black";
          }
          var dark = document.getElementsByClassName("item-body");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.borderTop = "solid black 1px";
          }
          var dark = document.getElementsByClassName("item");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.color = "black";
          }
          var dark = document.getElementsByClassName("line");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "black";
          }
          var dark = document.getElementsByClassName("mobile");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.backgroundColor = "#dee3de";
          }
          var dark = document.getElementsByClassName("fontColour");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.color = "black";
          }
          var dark = document.getElementsByClassName("moreInformation");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.color = "black";
          }
          var dark = document.getElementsByClassName("content");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "white";
          }
          var dark = document.getElementsByClassName("tabTheme");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.color = "black";
          }
          var dark = document.getElementsByClassName("sidebar_header");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.color = "black";
            dark[color].style.background = "white";
            dark[color].style.borderBottom = "1px solid #656565";
          }
          var dark = document.getElementsByClassName("smallIcon");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.color = "black";
          }
          var dark = document.getElementsByClassName("expandsidebar");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "white";
          }
          var dark = document.getElementsByClassName("dropdownForm");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "#dee3de";
          }
          var dark = document.getElementsByClassName("card");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "#eef1ea";
          }
          var dark = document.getElementsByClassName("card-header");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "#dee3de";
            dark[color].style.color = "black";
          }
          var dark = document.getElementsByClassName("sub-header");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "#dee3de";
            dark[color].style.color = "black";
          }
          var dark = document.getElementsByClassName("save");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "#dee3de";
            dark[color].style.color = "black";
          }
          var dark = document.getElementsByClassName("searchButton");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "#dee3de";
            dark[color].style.color = "black";
          }
          var dark = document.getElementsByClassName("viewButton");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "#dee3de";
            dark[color].style.color = "black";
          }
          var dark = document.getElementsByClassName("edit");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.color = "black";
            dark[color].style.background = "#dee3de";
          }
          var dark = document.getElementsByClassName("editSm");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.color = "black";
            dark[color].style.background = "white";
          }
          var dark = document.getElementsByClassName("bigView");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "white";
            dark[color].style.color = "black";
          }
          var dark = document.getElementsByClassName("Links");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "white";
          }
          var dark = document.getElementsByClassName("smLink");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "#dee3de";
            dark[color].style.color = "black";
          }
          var dark = document.getElementsByClassName("navList");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.borderBottom =
              "1px solid rgba(199, 199, 199, 0.75)";
          }
          var dark = document.getElementsByClassName("additional-menu");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.color = "#000000d4";
          }
          var dark = document.getElementsByClassName("link");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.color = "#000000d4";
          }
        }
      });
    }
  }
};
</script>