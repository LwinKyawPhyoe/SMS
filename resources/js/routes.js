// Attendance
import StuAttendance from '../views/Attendance/studentattendance.vue';
import AttDate from '../views/Attendance/attendancedate.vue';

// Examinations
import MarkGrade from '../views/Examinations/marksgrade.vue';
import ExamList from '../views/Examinations/ExamList.vue';
import MarkRegister from '../views/Examinations/marksregister.vue';
import SaveExamSchedule from '../views/Examinations/saveExamSchadule.vue';
import FillMarks from '../views/Examinations/fillmarks.vue';
import ExamSchedule from '../views/Examinations/ExamSchadule.vue';

// Students
import StudentInformation from '../views/Student/StudentInformation.vue';
import AddStudent from '../views/Student/AddStudent.vue';
import StudentHistory from '../views/Student/StudentHistory.vue';
import ViewStudent from '../views/Student/ViewStudent.vue';


//Academic 
import Timetable from '../views/Academics/classtimetable.vue';
import ViewTimetable from '../views/Academics/viewclasstimetable.vue';
import Teacher from '../views/Academics/assignclassteacher.vue';
import AssSubjects from '../views/Academics/assignsubjects.vue';
import ViewAssSubjects from '../views/Academics/viewassignsubjects.vue';
import ProStudents from '../views/Academics/promotestudents.vue';
import Subjects from '../views/Academics/subjects.vue';
import Class from '../views/Academics/class.vue';
import Sections from '../views/Academics/sections.vue';
import AcademicYear from '../views/Academics/academicyear.vue';

//HRM by wai yan soe
/**
 * StaffDirectory
 */
import StaDirectory from '../views/HRM/StaffDirectory/StaffDirectory.vue';
import AddStaDirectory from '../views/HRM/StaffDirectory/AddStaffDirectory.vue'; //add and update form
import ViewStaDirectory from '../views/HRM/StaffDirectory/ViewStaffDirectory.vue';

import StaAttendance from '../views/HRM/StaffAttendance.vue';
import Department from '../views/HRM/Department.vue';
import Designation from '../views/HRM/Designation.vue';


//Download Center
import UploadContent from '../views/DownloadCenter/UploadContent.vue';
import Assignments from '../views/DownloadCenter/Assignment.vue';
import StuMaterial from '../views/DownloadCenter/StudyMaterial.vue';
import Syllabus from '../views/DownloadCenter/Syllabus.vue';
import OthDownloads from '../views/DownloadCenter/OtherDownload.vue';

// Transport
import Route from '../views/Transport/TranRoutes.vue';
import Vehicle from '../views/Transport/TranVehicles.vue';
import AssVehicle from '../views/Transport/TranAssignVehicle.vue';

//Hostel
import HostelRooms from '../views/Hostel/hostel_rooms.vue';
import RoomType from '../views/Hostel/room_type.vue';
import Hostel from '../views/Hostel/hostel.vue';

// Reports
import StuReport from '../views/Reports/StudentReport.vue';
import AttReport from '../views/Reports/attendancereport.vue';
import StuTransportReport from '../views/Reports/StudentTransportReport.vue';
import StuHostelReport from '../views/Reports/StudentHostelReport.vue';
import StaffAttendanceReport from '../views/Reports/StaffAttendanceReport.vue';

//System Settings
import GeneralSetting from '../views/SystemSettings/GeneralSetting.vue';
import Role from '../views/SystemSettings/role_permission.vue';
import Assign from '../views/SystemSettings/assign_permission.vue';

//Homework
import AddHomework from '../views/Homework/AddHomework.vue';
import EvaluationReport from '../views/Homework/EvaluationReport.vue';
import editExamSchadule from '../views/Examinations/editExamSchadule.vue';

export const routes = [
    {
        name: 'stuattendance',
        path: '/stuattendance',
        component: StuAttendance
    },
    {
        name: 'attendancedate',
        path: '/attendancedate',
        component: AttDate
    },
    {
        name: 'attendancereport',
        path: '/attendancereport',
        component: AttReport
    },
    {
        name: 'markgrade',
        path: '/markgrade',
        component: MarkGrade
    },
    {
        name: 'AddStudent',
        path: '/AddStudent',
        component: AddStudent
    },
    {
        name: 'AddStudent',
        path: '/',
        component: AddStudent
    },
    {
        name: 'ExamList',
        path: '/ExamList',
        component: ExamList
    },
    {
        name: 'MarkRegister',
        path: '/MarkRegister',
        component: MarkRegister
    },
    {
        name: 'saveexamschdule',
        path: '/saveexamschdule',
        component: SaveExamSchedule
    },
    {
        name: 'StudentInformation',
        path: '/StudentInformation',
        component: StudentInformation
    },
    {
        name: 'fillmarks',
        path: '/fillmarks',
        component: FillMarks
    },
    {
        name: 'examschadule',
        path: '/examschadule',
        component: ExamSchedule
    },
    {
        name: 'timetable',
        path: '/timetable',
        component: Timetable
    },
    {
        name: 'viewtimetable',
        path: '/viewtimetable',
        component: ViewTimetable
    },
    {
        name: 'classteacher',
        path: '/classteacher',
        component: Teacher
    },
    {
        name: 'asssubjects',
        path: '/asssubjects',
        component: AssSubjects
    },
    {
        name: 'viewasssubjects',
        path: '/viewasssubjects',
        component: ViewAssSubjects
    },
    {
        name: 'prostudents',
        path: '/prostudents',
        component: ProStudents
    },
    {
        name: 'subjects',
        path: '/subjects',
        component: Subjects
    },
    {
        name: 'class',
        path: '/class',
        component: Class
    },
    {
        name: 'sections',
        path: '/sections',
        component: Sections
    },
    {
        name: 'academicyear',
        path: '/academicyear',
        component: AcademicYear
    },
    {
        name: 'staattendance',
        path: '/staattendance',
        component: StaAttendance
    },
    {
        name: 'department',
        path: '/department',
        component: Department
    },
    {
        name: 'designation',
        path: '/designation',
        component: Designation
    },

    {
        name: 'role',
        path: '/role',
        component: Role
    },
    {
        name: 'assign',
        path: '/role/assign',
        component: Assign
    },
    {
        name: 'uploadcontent',
        path: '/uploadcontent',
        component: UploadContent
    },
    {
        name: 'studenthistory',
        path: '/studenthistory',
        component: StudentHistory
    },
    {
        name: 'assignment',
        path: '/assignment',
        component: Assignments
    },
    {
        name: 'stumaterial',
        path: '/stumaterial',
        component: StuMaterial
    },
    {
        name: 'syllabus',
        path: '/syllabus',
        component: Syllabus
    },
    {
        name: 'othdownload',
        path: '/othdownload',
        component: OthDownloads
    },
    {
        name: 'routes',
        path: '/routes',
        component: Route
    },
    {
        name: 'vehicle',
        path: '/vehicle',
        component: Vehicle
    },
    {
        name: 'assvehicle',
        path: '/assvehicle',
        component: AssVehicle
    },
    {
        name: 'roomtype',
        path: '/roomtype',
        component: RoomType
    },
    {
        name: 'hostel',
        path: '/hostel',
        component: Hostel
    },
    {
        name: 'hostelroom',
        path: '/hostelroom',
        component: HostelRooms
    },
    {
        name: 'viewstudent',
        path: '/viewstudent',
        component: ViewStudent
    },
    {
        name: 'stureport',
        path: '/stureport',
        component: StuReport
    },
    {
        name: 'stutransportreport',
        path: '/stutransportreport',
        component: StuTransportReport
    },
    {
        name: 'stuhostelreport',
        path: '/stuhostelreport',
        component: StuHostelReport
    },
    {
        name: 'staattreport',
        path: '/staattreport',
        component: StaffAttendanceReport
    },
    {
        name: 'gensetting',
        path: '/gensetting',
        component: GeneralSetting
    },
    {
        name: 'homework',
        path: '/homework',
        component: AddHomework
    },
    {
        name: 'evaluation_report',
        path: '/evaluation_report',
        component: EvaluationReport
    }
    ,
    /**Staff directory */
    {
        name: 'staffdirectory',
        path: '/staffdirectory',
        component: StaDirectory
    },
    {
        name: 'addstadirectory',
        path: '/staffdirectory/add',
        component: AddStaDirectory
    },
    ,
    {
        name: 'editstadirectory',
        path: '/staffdirectory/edit/:id',
        component: AddStaDirectory
    },
    {
        name: 'viewstaffdirectory',
        path: '/staffdirectory/profile/:id',
        component: ViewStaDirectory
    },
/**end of staff directory */ {
        name: 'editExamSchadule',
        path: '/editExamSchadule',
        component: editExamSchadule
    },

];