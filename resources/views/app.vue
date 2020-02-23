<template>
  <div>
    <div class="page">
      <div id="."></div>
      <header tabindex="0">
        <h5 style="font-family: 'Encode Sans Condensed', sans-serif;">School management</h5>
      </header>
      <div id="nav-container">
        <div class="bg"></div>
        <div class="menuIcon" tabindex="0">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </div>
        <div id="nav-content" tabindex="0">
          <div class="row" id="easyschool">
            <div class="row" id="container">
              <img src="/profile.png" style="width:60px;" alt />
              <div style="margin-left:20px;">
                <h5
                  style="font-weight:bold;font-family: 'Encode Sans Condensed', sans-serif;"
                >Admin name</h5>
                <label style="font-family: 'Encode Sans Condensed', sans-serif;">Admin @email.com</label>
              </div>
            </div>
            <label
              for
              style="margin-top:15px;font-family: 'Encode Sans Condensed', sans-serif;"
            >* easily manage your school</label>
          </div>
          <div class="body" onclick="showForm()">
            <div class="item">
              <router-link to class="nav-item nav-link">
                <i class="fa fa-credit-card"></i>
                <label for style="margin-left:10px;">Dashboard</label>
              </router-link>
            </div>
            <div
              class="item2"
              onclick="openAcademicC('studentC','citem','citem2','citem3','.','.','.','.','.',70,'120px','height 0.3s','height 0.3s')"
            >
              <router-link to class="nav-item nav-link">
                <i class="fa fa-user-circle"></i>
                <label for style="margin-left:10px;">Student</label>
                <i class="fa fa-angle-right" id="ii"></i>
              </router-link>
              <div id="studentC" class="col">
                <div id="citem">
                  <router-link to="/StudentInformation" id="route">
                    <label for style="margin-left:10px;">
                      <i class="fa fa-angle-double-right"></i> Student details
                    </label>
                  </router-link>
                </div>
                <div id="citem2">
                  <router-link to="/AddStudent" id="route">
                    <label for style="margin-left:10px;">
                      <i class="fa fa-angle-double-right"></i> Student Admission
                    </label>
                  </router-link>
                </div>
                <div id="citem3">
                  <router-link to="/studenthistory" id="route">
                    <label for style="margin-left:10px;">
                      <i class="fa fa-angle-double-right"></i> Student History
                    </label>
                  </router-link>
                </div>
              </div>
            </div>
            <div
              class="item2"
              onclick="openAcademicC('attendenceC','citem12','citem13','citem14','.','.','.','.','.',70,'120px','height 0.3s','height 0.3s')"
            >
              <router-link to class="nav-item nav-link">
                <i class="fa fa-calendar"></i>
                <label for style="margin-left:10px;">Attendence</label>
                <i class="fa fa-angle-right" id="ii"></i>
              </router-link>
              <div id="attendenceC" class="col">
                <div id="citem12">
                  <router-link to="/stuattendance" id="route">
                    <label for style="margin-left:10px;">
                      <i class="fa fa-angle-double-right"></i> Student Attendance
                    </label>
                  </router-link>
                </div>
                <div id="citem13">
                  <router-link to="/attendancedate" id="route">
                    <label for style="margin-left:10px;">
                      <i class="fa fa-angle-double-right"></i>Attendance By Date
                    </label>
                  </router-link>
                </div>
              </div>
            </div>
            <div
              class="item2"
              onclick="openAcademicC('examinationC','citem15','citem16','citem17','citem18','.','.','.','.',70,'160px','height 0.3s','height 0.2s')"
            >
              <router-link to="/examlist" class="nav-item nav-link">
                <i class="fa fa-clipboard"></i>
                <label for style="margin-left:10px;">Examinations</label>
                <i class="fa fa-angle-right" id="ii"></i>
              </router-link>
              <div id="examinationC" class="col">
                <div id="citem15">
                  <router-link to="#" id="route">
                    <label for style="margin-left:10px;">
                      <i class="fa fa-angle-double-right"></i> Exam List
                    </label>
                  </router-link>
                </div>
                <div id="citem16">
                  <router-link to="/examschadule" id="route">
                    <label for style="margin-left:10px;">
                      <i class="fa fa-angle-double-right"></i> Exam Schadule
                    </label>
                  </router-link>
                </div>
                <div id="citem17">
                  <router-link to="/markgrade" id="route">
                    <label for style="margin-left:10px;">
                      <i class="fa fa-angle-double-right"></i> Marks Grade
                    </label>
                  </router-link>
                </div>
                <div id="citem18">
                  <router-link to="/MarkRegister" id="route">
                    <label for style="margin-left:10px;">
                      <i class="fa fa-angle-double-right"></i> Marks Register
                    </label>
                  </router-link>
                </div>
              </div>
            </div>
            <div
              class="item2"
              onclick="openAcademicC('academicC','citem4','citem5','citem6','citem7','citem8','citem9','citem10','citem11',70,'280px','height 0.4s','height 0.2s')"
            >
              <router-link to="/examlist" class="nav-item nav-link">
                <i class="fa fa-graduation-cap"></i>
                <label for style="margin-left:10px;">Academics</label>
                <i class="fa fa-angle-right" id="ii"></i>
              </router-link>
              <div id="academicC" class="col">
                <div id="citem4">
                  <router-link to="/viewtimetable" id="route">
                    <label for style="margin-left:10px;">
                      <i class="fa fa-angle-double-right"></i> Class Timetable
                    </label>
                  </router-link>
                </div>
                <div id="citem5">
                  <router-link to="/classteacher" id="route">
                    <label for style="margin-left:10px;">
                      <i class="fa fa-angle-double-right"></i>Assign Class Teacher
                    </label>
                  </router-link>
                </div>
                <div id="citem6">
                  <router-link to="/viewasssubjects" id="route">
                    <label for style="margin-left:10px;">
                      <i class="fa fa-angle-double-right"></i>Assign Subject
                    </label>
                  </router-link>
                </div>
                <div id="citem7">
                  <router-link to="/prostudents" id="route">
                    <label for style="margin-left:10px;">
                      <i class="fa fa-angle-double-right"></i>Ptomote Student
                    </label>
                  </router-link>
                </div>
                <div id="citem8">
                  <router-link to="#" id="route">
                    <label for style="margin-left:10px;">
                      <i class="fa fa-angle-double-right"></i>Subjects
                    </label>
                  </router-link>
                </div>
                <div id="citem9">
                  <router-link to="#" id="route">
                    <label for style="margin-left:10px;">
                      <i class="fa fa-angle-double-right"></i>Class
                    </label>
                  </router-link>
                </div>
                <div id="citem10">
                  <router-link to="#" id="route">
                    <label for style="margin-left:10px;">
                      <i class="fa fa-angle-double-right"></i>Section
                    </label>
                  </router-link>
                </div>
                <div id="citem11">
                  <router-link to="#" id="route">
                    <label for style="margin-left:10px;">
                      <i class="fa fa-angle-double-right"></i>Academic Year
                    </label>
                  </router-link>
                </div>
              </div>
            </div>
            <div
              class="item2"
              onclick="openAcademicC('hrmC','citem19','citem20','citem21','citem22','.','.','.','.',70,'140px','height 0.3s','height 0.2s')"
            >
              <router-link to="/examlist" class="nav-item nav-link">
                <i class="fa fa-street-view"></i>
                <label for style="margin-left:10px;">HRM</label>
                <i class="fa fa-angle-right" id="ii"></i>
              </router-link>
              <div id="hrmC" class="col">
                <div id="citem19">
                  <router-link to="/stadirectory" id="route">
                    <label for style="margin-left:10px;">
                      <i class="fa fa-angle-double-right"></i> Staff Directory
                    </label>
                  </router-link>
                </div>
                <div id="citem20">
                  <router-link to="#" id="route">
                    <label for style="margin-left:10px;">
                      <i class="fa fa-angle-double-right"></i> Staff Attendance
                    </label>
                  </router-link>
                </div>
                <div id="citem21">
                  <router-link to="#" id="route">
                    <label for style="margin-left:10px;">
                      <i class="fa fa-angle-double-right"></i> Department
                    </label>
                  </router-link>
                </div>
                <div id="citem22">
                  <router-link to="#" id="route">
                    <label for style="margin-left:10px;">
                      <i class="fa fa-angle-double-right"></i> Designation
                    </label>
                  </router-link>
                </div>
              </div>
            </div>
            <div
              class="item2"
              onclick="openAcademicC('downloadC','citem26','citem27','citem40','citem41','citem42','.','.','.',70,'170px','height 0.3s','height 0.3s')"
            >
              <router-link to="/examlist" class="nav-item nav-link">
                <i class="fa fa-download"></i>
                <label for style="margin-left:10px;">Download Center</label>
                <i class="fa fa-angle-right" id="ii"></i>
              </router-link>
              <div id="downloadC" class="col">
                <div id="citem26">
                  <router-link to="/StudentInformation" id="route">
                    <label for style="margin-left:10px;">
                      <i class="fa fa-angle-double-right"></i> Upload Content
                    </label>
                  </router-link>
                </div>
                <div id="citem27">
                  <router-link to="/assignment" id="route">
                    <label for style="margin-left:10px;">
                      <i class="fa fa-angle-double-right"></i> Assignments
                    </label>
                  </router-link>
                </div>
                <div id="citem40">
                  <router-link to="/stumaterial" id="route">
                    <label for style="margin-left:10px;">
                      <i class="fa fa-angle-double-right"></i> Study Material
                    </label>
                  </router-link>
                </div>
                <div id="citem41">
                  <router-link to="/syllabus" id="route">
                    <label for style="margin-left:10px;">
                      <i class="fa fa-angle-double-right"></i> Syllabus
                    </label>
                  </router-link>
                </div>
                <div id="citem42">
                  <router-link to="/othdownload" id="route">
                    <label for style="margin-left:10px;">
                      <i class="fa fa-angle-double-right"></i> Other Downloads
                    </label>
                  </router-link>
                </div>
              </div>
            </div>
            <div
              class="item2"
              onclick="openAcademicC('reportC','citem28','citem29','citem30','citem31','citem32','.','.','.',70,'170px','height 0.4s','height 0.2s')"
            >
              <router-link to="/examlist" class="nav-item nav-link">
                <i class="fa fa-bar-chart"></i>
                <label for style="margin-left:10px;">Report</label>
                <i class="fa fa-angle-right" id="ii"></i>
              </router-link>
              <div id="reportC" class="col">
                <div id="citem28">
                  <router-link to="/studenthistory" id="route">
                    <label for style="margin-left:10px;">
                      <i class="fa fa-angle-double-right"></i> Student Histroy
                    </label>
                  </router-link>
                </div>
                <div id="citem29">
                  <router-link to="#" id="route">
                    <label for style="margin-left:10px;">
                      <i class="fa fa-angle-double-right"></i> Transaction Report
                    </label>
                  </router-link>
                </div>
                <div id="citem30">
                  <router-link to="/attendancereport" id="route">
                    <label for style="margin-left:10px;">
                      <i class="fa fa-angle-double-right"></i> Attendance Report
                    </label>
                  </router-link>
                </div>
                <div id="citem31">
                  <router-link to="#" id="route">
                    <label for style="margin-left:10px;">
                      <i class="fa fa-angle-double-right"></i> Exam Marks Reports
                    </label>
                  </router-link>
                </div>
                <div id="citem32">
                  <router-link to="#" id="route">
                    <label for style="margin-left:10px;">
                      <i class="fa fa-angle-double-right"></i> Staff Attendance Reports
                    </label>
                  </router-link>
                </div>
              </div>
            </div>
            <div
              class="item2"
              onclick="openAcademicC('systemC','citem36','citem37','citem38','citem39','citem43','.','.','.',70,'170px','height 0.3s','height 0.2s')"
            >
              <router-link to="/examlist" class="nav-item nav-link">
                <i class="fa fa-sliders"></i>
                <label for style="margin-left:10px;">System Setting</label>
                <i class="fa fa-angle-right" id="ii"></i>
              </router-link>
              <div id="systemC" class="col">
                <div id="citem36">
                  <router-link to="#" id="route">
                    <label for style="margin-left:10px;">
                      <i class="fa fa-angle-double-right"></i> General Setting
                    </label>
                  </router-link>
                </div>
                <div id="citem37">
                  <router-link to="#" id="route">
                    <label for style="margin-left:10px;">
                      <i class="fa fa-angle-double-right"></i> Session Setting
                    </label>
                  </router-link>
                </div>
                <div id="citem38">
                  <router-link to="#" id="route">
                    <label for style="margin-left:10px;">
                      <i class="fa fa-angle-double-right"></i> Roles Permission
                    </label>
                  </router-link>
                </div>
                <div id="citem39">
                  <router-link to="#" id="route">
                    <label for style="margin-left:10px;">
                      <i class="fa fa-angle-double-right"></i> Languages
                    </label>
                  </router-link>
                </div>
                <div id="citem43">
                  <router-link to="#" id="route">
                    <label for style="margin-left:10px;">
                      <i class="fa fa-angle-double-right"></i> Users
                    </label>
                  </router-link>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="pc" @click="getColor()" style="padding:0px;margin:0px;">
      <div class="sidebar" id="bigBar">
        <div class="expandsidebar" id="schoolName">
          <div class="header">
            <div class="row sidebar_header">
              <div class="col-12">
                <h3 style="text-align: center;padding-top: 10px;" class="projectName">SSMS</h3>
              </div>
            </div>

            <div class="body_content" id="body_content">
              <ul class="additional-menu">
                <li>
                  <a class="navList">
                    <router-link class="routerLink" id="globalLink" to>
                      <i class="fa fa-credit-card" id="sidebarIcon"></i>Dashboard
                    </router-link>
                  </a>
                </li>
                <li>
                  <a @click="dropdown('link','dropIcon')" class="navList">
                    <router-link class="routerLink" to>
                      <i class="fa fa-users" id="sidebarIcon"></i>Students
                      <i class="fa fa-angle-right dropIcon" id="dropIcon"></i>
                    </router-link>
                  </a>
                  <div class="dropdownForm">
                    <ul class="link" id="link">
                      <li class="nav-list">
                        <router-link class="nav-list" to="/StudentInformation">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Student Details
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/AddStudent" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Student Admission
                        </router-link>
                      </li>
                    </ul>
                  </div>
                </li>
                <li>
                  <a @click="dropdown('link1','dropIcon1')" class="navList">
                    <router-link class="routerLink" to>
                      <i class="fa fa-calendar" id="sidebarIcon"></i>Attendance
                      <i class="fa fa-angle-right dropIcon" id="dropIcon1"></i>
                    </router-link>
                  </a>
                  <div class="dropdownForm">
                    <ul class="link" id="link1">
                      <li class="nav-list">
                        <router-link class="nav-list" to="/stuattendance">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Student Attendance
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/attendancedate" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Attendance By Date
                        </router-link>
                      </li>
                    </ul>
                  </div>
                </li>
                <li>
                  <a @click="dropdown('link2','dropIcon2')" class="navList">
                    <router-link class="routerLink" to>
                      <i class="fa fa-clipboard" id="sidebarIcon"></i>Examinations
                      <i class="fa fa-angle-right dropIcon" id="dropIcon2"></i>
                    </router-link>
                  </a>
                  <div class="dropdownForm">
                    <ul class="link" id="link2">
                      <li class="nav-list">
                        <router-link class="nav-list" to="/ExamList">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Exam List
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/examschadule" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Exam Schedule
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/markgrade" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Marks Grade
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/MarkRegister" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Marks Register
                        </router-link>
                      </li>
                    </ul>
                  </div>
                </li>
                <li>
                  <a @click="dropdown('link3','dropIcon3')" class="navList">
                    <router-link class="routerLink" to>
                      <i
                        class="fa fa-graduation-cap"
                        style="margin:0 1.3rem !important;"
                        id="sidebarIcon"
                      ></i>Academics
                      <i class="fa fa-angle-right dropIcon" id="dropIcon3"></i>
                    </router-link>
                  </a>
                  <div class="dropdownForm">
                    <ul class="link" id="link3">
                      <li class="nav-list">
                        <router-link class="nav-list" to="/viewtimetable">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Class Timetable
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/classteacher" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Assign Class Teacher
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/viewasssubjects" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Assign Subjects
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/prostudents" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Promote Students
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/subjects" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Subjects
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/class" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Class
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/sections" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Sections
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/academicyear" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Academic-Year
                        </router-link>
                      </li>
                    </ul>
                  </div>
                </li>
                <li>
                  <a @click="dropdown('link4','dropIcon4')" class="navList">
                    <router-link class="routerLink" to>
                      <i class="fa fa-street-view" id="sidebarIcon"></i>HRM
                      <i class="fa fa-angle-right dropIcon" id="dropIcon4"></i>
                    </router-link>
                  </a>
                  <div class="dropdownForm">
                    <ul class="link" id="link4">
                      <li class="nav-list">
                        <router-link class="nav-list" to="/staffdirectory">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Staff Directory
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/staattendance" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Staff Attendance
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/department" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Department
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/designation" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Designation
                        </router-link>
                      </li>
                    </ul>
                  </div>
                </li>
                <li>
                  <a @click="dropdown('link5','dropIcon5')" class="navList">
                    <router-link class="routerLink" to>
                      <i class="fa fa-download" id="sidebarIcon"></i>Download Center
                      <i class="fa fa-angle-right dropIcon" id="dropIcon5"></i>
                    </router-link>
                  </a>
                  <div class="dropdownForm">
                    <ul class="link" id="link5">
                      <li class="nav-list">
                        <router-link class="nav-list" to="/uploadcontent">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Upload Content
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/assignment" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Assignments
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/stumaterial" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Study Material
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/syllabus" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Syllabus
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/othdownload" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Other Downloads
                        </router-link>
                      </li>
                    </ul>
                  </div>
                </li>
                <li>
                  <a @click="dropdown('link6','dropIcon6')" class="navList">
                    <router-link class="routerLink" to>
                      <i class="fa fa-flask" id="sidebarIcon"></i>Homework
                      <i class="fa fa-angle-right dropIcon" id="dropIcon6"></i>
                    </router-link>
                  </a>
                  <div class="dropdownForm">
                    <ul class="link" id="link6">
                      <li class="nav-list">
                        <router-link class="nav-list" to="/homework">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Add Homework
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/evaluation_report" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Evaluation Report
                        </router-link>
                      </li>
                    </ul>
                  </div>
                </li>
                <li>
                  <a @click="dropdown('link7','dropIcon7')" class="navList">
                    <router-link class="routerLink" to>
                      <i class="fa fa-bus" id="sidebarIcon"></i>Transport
                      <i class="fa fa-angle-right dropIcon" id="dropIcon7"></i>
                    </router-link>
                  </a>
                  <div class="dropdownForm">
                    <ul class="link" id="link7">
                      <li class="nav-list">
                        <router-link class="nav-list" to="/routes">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Routes
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/vehicle" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Vehicles
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/assvehicle" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Assign Vehicle
                        </router-link>
                      </li>
                    </ul>
                  </div>
                </li>
                <li>
                  <a @click="dropdown('link8','dropIcon8')" class="navList">
                    <router-link class="routerLink" to>
                      <i class="fa fa-building" id="sidebarIcon"></i>Hostel
                      <i class="fa fa-angle-right dropIcon" id="dropIcon8"></i>
                    </router-link>
                  </a>
                  <div class="dropdownForm">
                    <ul class="link" id="link8">
                      <li class="nav-list">
                        <router-link class="nav-list" to="/hostelroom">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Hostel Rooms
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/roomtype" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Room Type
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/hostel" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Hostel
                        </router-link>
                      </li>
                    </ul>
                  </div>
                </li>
                <li>
                  <a @click="dropdown('link9','dropIcon9')" class="navList">
                    <router-link class="routerLink" to>
                      <i
                        class="fa fa-bar-chart"
                        style="margin:0 1.3rem !important;"
                        id="sidebarIcon"
                      ></i>Reports
                      <i class="fa fa-angle-right dropIcon" id="dropIcon9"></i>
                    </router-link>
                  </a>
                  <div class="dropdownForm">
                    <ul class="link" id="link9">
                      <li class="nav-list">
                        <router-link class="nav-list" to="/stureport">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Student Report
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link class="nav-list" to>
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Student Guardian
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/studenthistory" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Student History
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/attendancereport" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Attendance Report
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/MarkRegister" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Exam Marks Report
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/staattreport" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Staff Attendance Report
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/stutransportreport" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Student Transport Report
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/stuhostelreport" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Student Hostel Report
                        </router-link>
                      </li>
                    </ul>
                  </div>
                </li>
                <li>
                  <a @click="dropdown('link10','dropIcon10')" class="navList">
                    <router-link class="routerLink" to>
                      <i class="fa fa-sliders" id="sidebarIcon"></i>System Settings
                      <i class="fa fa-angle-right dropIcon" id="dropIcon10"></i>
                    </router-link>
                  </a>
                  <div class="dropdownForm">
                    <ul class="link" id="link10">
                      <li class="nav-list">
                        <router-link class="nav-list" to="/gensetting">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>General Setting
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="role" class="nav-list">
                          <i class="fa fa-angle-double-right listItem" id="listItem"></i>Roles Permissions
                        </router-link>
                      </li>
                      <li class="nav-list">
                        <router-link to="/users" class="nav-list">
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
          <label class="bigView" onclick="changeBar()">X</label>
        </div>

        <div class="smallBar" id="smBar">
          <ul class="Links" onclick="showForm()">
            <a class="link">
              <li>
                <i class="fa fa-credit-card smallIcon"></i>
              </li>
            </a>
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
                  <router-link to class="smallLink">
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

    <div class="content" @click="getColor()">
      <div class="content_header">
        <i class="fa fa-bars" id="list" onclick="changeBar()"></i>
        <div class="sessions">
          <h5 class="session" data-toggle="modal" data-target="#exampleModalCenter1">
            Current Session
            <i class="fa fa-pencil pencil"></i>
          </h5>
          <p>2019-2020</p>
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
export default {
  data() {
    return {
      colors: []
    };
  },
  created() {
    this.axios.get("/api/settings").then(response => {
      this.colors = response.data;
      if (this.colors.color == "defaultColor") {
        document.getElementById("schoolName").style.background = "#1b5e20";
        var dark = document.getElementsByClassName("dropdownForm");
        var color;
        for (color = 0; color < dark.length; color++) {
          dark[color].style.background = "#044604";
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
        document.getElementById("schoolName").style.background = "currentColor";
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
        var dark = document.getElementsByClassName("sidebar_header");
        var color;
        for (color = 0; color < dark.length; color++) {
          dark[color].style.color = "black";
          dark[color].style.background = "white";
          dark[color].style.borderBottom = "1px solid #656565";
        }
        var dark = document.getElementsByClassName("tabTheme");
        var color;
        for (color = 0; color < dark.length; color++) {
          dark[color].style.color = "black";
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
          dark[color].style.background = "rgb(245, 245, 245)";
          dark[color].style.color = "black";
        }
        var dark = document.getElementsByClassName("Links");
        var color;
        for (color = 0; color < dark.length; color++) {
          dark[color].style.background = "rgb(245, 245, 245)";
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
  },
  methods: {
    dropdown(id, icon) {
      if (document.getElementById(id).style.display == "block") {
        document.getElementById(id).style.display = "none";
        document.getElementById(icon).style.transform = "rotate(0deg)";
      } else {
        document.getElementById(id).style.display = "block";
        document.getElementById(icon).style.transform = "rotate(90deg)";
      }
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
            dark[color].style.background = "rgb(245, 245, 245)";
            dark[color].style.color = "black";
          }
          var dark = document.getElementsByClassName("Links");
          var color;
          for (color = 0; color < dark.length; color++) {
            dark[color].style.background = "rgb(245, 245, 245)";
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