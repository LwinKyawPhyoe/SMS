<template>
  <div class="form" id="bar">
    <div class="row" style="align-items: end !important;">
      <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
        <div class="info-box" @click.prevent="getRoute('1')">
          <a href="#">
            <span class="info-box-icon bg-green">
              <i class="fa fa-user"></i>
            </span>
            <div class="info-box-content">
              <span class="info-box-text">Teacher</span>
              <span class="info-box-number">40</span>
            </div>
          </a>
        </div>
        <div id="teacherPie" style="width:100%; height:200px; margin-bottom:15px;"></div>
      </div>

      <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
        <div class="info-box" @click.prevent="getRoute('2')">
          <a href="#">
            <span class="info-box-icon bg-green">
              <i class="fa fa-user"></i>
            </span>
            <div class="info-box-content">
              <span class="info-box-text">Student</span>
              <span class="info-box-number">800</span>
            </div>
          </a>
        </div>
        <div id="studentPie" style="width:100%; height:200px; margin-bottom:15px;"></div>
      </div>

      <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
        <div class="info-box" @click.prevent="getRoute('3')">
          <a href="#">
            <span class="info-box-icon bg-green">
              <i class="fa fa-user"></i>
            </span>
            <div class="info-box-content">
              <span class="info-box-text">Super Admin</span>
              <span class="info-box-number">5</span>
            </div>
          </a>
        </div>
        <div id="adminPie" style="width:100%; height:200px; margin-bottom:15px;"></div>
      </div>

      <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
        <div class="info-box" @click.prevent="getRoute('4')">
          <a href="#">
            <span class="info-box-icon bg-green">
              <i class="fa fa-user"></i>
            </span>
            <div class="info-box-content">
              <span class="info-box-text">Staff</span>
              <span class="info-box-number">50</span>
            </div>
          </a>
        </div>
        <div id="staffPie" style="width:100%; height:200px; margin-bottom:15px;"></div>
      </div>

      <div class="col-sm-12 col-md-12">
        <div id="attendancePie" style="width:100%; height:400px; margin-bottom:15px;"></div>
      </div>
    </div>
  </div>
</template>

<script>
import { Dashboard } from "../../js/dashboard";
import { EventBus } from "../../js/event-bus.js";

export default {
  data() {
    return {
      teacher: [],
      student: [],

      admin: [],
      staff: [],

      attendance: []
    };
  },

  created() {
    EventBus.$emit("ThemeClicked");
    this.getTeacherPie();
    this.getStudentPie();
    this.getAdminPie();
    this.getStaffPie();
    this.getAttendance();
  },

  mounted() {
    this.showTeacherPie();
    this.showStudentPie();
    this.showAdminPie();
    this.showStaffPie();
    this.showAttendanceLine();
  },

  methods: {
    getTeacherPie() {
      this.teacher = [
        { name: "Teacher Male", y: 17, color: "#259FED" },
        { name: "Teacher Female", y: 23, color: "#01BC0B" }
      ];
    },

    showTeacherPie() {
      var myChart = Dashboard.generatePieChart("teacherPie", this.teacher);
      //
    },

    getStudentPie() {
      this.student = [
        { name: "Student Male", y: 379, color: "#259FED" },
        { name: "Student Female", y: 421, color: "#01BC0B" }
      ];
    },

    showStudentPie() {
      var myChart = Dashboard.generatePieChart("studentPie", this.student);
    },

    getAdminPie() {
      this.admin = [
        { name: "Admin Male", y: 2, color: "#259FED" },
        { name: "Admin Female", y: 3, color: "#01BC0B" }
      ];
    },

    showAdminPie() {
      var myChart = Dashboard.generatePieChart("adminPie", this.admin);
    },

    getStaffPie() {
      this.staff = [
        { name: "Staff Male", y: 10, color: "#259FED" },
        { name: "Staff Female", y: 40, color: "#01BC0B" }
      ];
    },

    showStaffPie() {
      var myChart = Dashboard.generatePieChart("staffPie", this.staff);
    },

    getAttendance() {
      this.attendance = [
        {
          name: "Teacher",
          data: [99, 98, 85, 90, 78, 80, 88, 90, 75, 90, 60, 70],
          color: "#259FED"
        },
        {
          name: "Student",
          data: [90, 88, 89, 95, 75, 70, 80, 97, 85, 78, 87, 100],
          color: "#01BC0B"
        },
        {
          name: "Admin",
          data: [100, 90, 99, 100, 80, 60, 75, 100, 88, 80, 90, 88],
          color: "#FF0101"
        },
        {
          name: "Staff",
          data: [89, 100, 98, 98, 100, 98, 92, 95, 100, 98, 94, 100],
          color: "#2501FF"
        }
      ];
    },

    showAttendanceLine() {
      var myChart = Dashboard.generateLineChart(
        "attendancePie",
        this.attendance
      );
    },

    getRoute(n) {
      if (n == "1") this.$router.push({ name: "designation" });
      else if (n == "2") this.$router.push({ name: "AddStudent" });
      else if (n == "3") this.$router.push({ name: "designation" });
      else if (n == "4") this.$router.push({ name: "designation" });
    }
  }
};
</script>
