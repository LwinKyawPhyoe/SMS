<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
/***
 * Wai Yan Soe
 */

/**
 * Hostel
 */
Route::get('hostels', 'HostelController@index');
Route::group(['prefix' => 'hostel'], function () {
    Route::post('store', 'HostelController@store');
    Route::get('edit/{id}', 'HostelController@edit');
    Route::post('update/{id}', 'HostelController@update');
    Route::delete('delete/{id}', 'HostelController@delete');
    Route::get('search/{data}', 'HostelController@search');
});

/**
 * ROOM TYPE
 */
Route::get('roomtypes', 'RoomTypeController@index');
Route::group(['prefix' => 'roomtype'], function () {
    Route::post('store', 'RoomTypeController@store');
    Route::get('edit/{id}', 'RoomTypeController@edit');
    Route::post('update/{id}', 'RoomTypeController@update');
    Route::delete('delete/{id}', 'RoomTypeController@delete');
    Route::get('search/{data}', 'RoomTypeController@search');
});


/**
 * HOSTEL ROOM
 */
Route::get('hostelrooms', 'HostelRoomController@index');
Route::group(['prefix' => 'hostelroom'], function () {
    Route::post('store', 'HostelRoomController@store');
    Route::get('edit/{id}', 'HostelRoomController@edit');
    Route::post('update/{id}', 'HostelRoomController@update');
    Route::delete('delete/{id}', 'HostelRoomController@delete');
    Route::get('search/{data}', 'HostelRoomController@search');
});


/**
 * HRM  DESIGNATION
 */
Route::get('designations', 'DesignationController@index');
Route::group(['prefix' => 'designation'], function () {
    Route::post('store', 'DesignationController@store');
    Route::get('edit/{id}', 'DesignationController@edit');
    Route::post('update/{id}', 'DesignationController@update');
    Route::delete('delete/{id}', 'DesignationController@delete');
    Route::get('search/{data}', 'DesignationController@search');
});

/**
 * HRM  DEPARTMENT
 */
Route::get('departments', 'DepartmentController@index');
Route::group(['prefix' => 'department'], function () {
    Route::post('store', 'DepartmentController@store');
    Route::get('edit/{id}', 'DepartmentController@edit');
    Route::post('update/{id}', 'DepartmentController@update');
    Route::delete('delete/{id}', 'DepartmentController@delete');
    Route::get('search/{data}', 'DepartmentController@search');
});



/**
 * Roles Permissions
 */
Route::get('roles', 'RoleController@index');
Route::group(['prefix' => 'role'], function () {
    Route::post('store', 'RoleController@store');
    Route::get('edit/{id}', 'RoleController@edit');
    Route::post('update/{id}', 'RoleController@update');
    Route::delete('delete/{id}', 'RoleController@delete');
    Route::get('search/{data}', 'RoleController@search');
});

/**
 * Staff Directory
 */
Route::get('staffs', 'StaffDirectoryController@index');
Route::group(['prefix' => 'staffdirectory'], function () {
    Route::get('show/{id}', 'StaffDirectoryController@show');
    Route::post('store', 'StaffDirectoryController@store');
    Route::get('edit/{id}', 'StaffDirectoryController@edit');
    Route::post('update/{id}', 'StaffDirectoryController@update');
    Route::delete('delete/{id}', 'StaffDirectoryController@delete');
    Route::get('search/{data}', 'StaffDirectoryController@search');
    Route::get('search_by_role/{id}', 'StaffDirectoryController@search_by_role');
    Route::get('search_by_other/{id}', 'StaffDirectoryController@search_by_other');
});


/**
 * Staff Attendance
 */
Route::get('staffattendances', 'StaffAttendanceController@index');
Route::group(['prefix' => 'staffattendance'], function () {
    Route::get('show/{id}', 'StaffAttendanceController@show');
    Route::post('store', 'StaffAttendanceController@store');
    Route::get('edit/{id}', 'StaffAttendanceController@edit');
    Route::post('update/{id}', 'StaffAttendanceController@update');
    Route::delete('delete/{id}', 'StaffAttendanceController@delete');
});


/***
 * Staff Attendance Date/Month Grid
 */
Route::get('months', "ActivityController@month");
Route::get('searchDate/{id}/{year}', 'StaffAttendanceController@index');
Route::get('attendance_types', 'AttendanceTypeController@getTypes');


/**
 * Assign Permissions
 */
Route::get('features', 'ActivityController@index');
Route::group(['prefix' => 'assign'], function () {
    Route::get('find/{id}', 'AssignPermissionController@find');
    Route::post('store', 'StaffAttendanceController@store');
    Route::get('edit/{id}', 'StaffAttendanceController@edit');
    Route::post('update/{id}', 'StaffAttendanceController@update');
    Route::delete('delete/{id}', 'StaffAttendanceController@delete');
});


/***
 * End Code of Wai Yan Soe
 */

//  Wai Yan Moung
// ------------------------------- Wai Yan Moung ---------------------------
Route::get('attendancetypes', 'AttendanceTypeController@index');
Route::group(['prefix' => 'attendancetype'], function () {
    Route::post('add', 'AttendanceTypeController@store');
    Route::get('edit/{id}', 'AttendanceTypeController@edit');
    Route::post('update/{id}', 'AttendanceTypeController@update');
    Route::delete('delete/{id}', 'AttendanceTypeController@destroy');
});
Route::get('studentattendances', 'StudentAttendanceController@index');
Route::group(['prefix' => 'studentattendance'], function () {
    Route::post('add', 'StudentAttendanceController@store');
    Route::get('show/{para}', 'StudentAttendanceController@show');
    Route::get('edit/{id}', 'StudentAttendanceController@edit');
    Route::post('update/{id}', 'StudentAttendanceController@update');
    Route::delete('delete/{id}', 'StudentAttendanceController@destroy');
});
Route::get('student','StudentController@index');
Route::group(['prefix' => 'student'], function() {
    Route::post('add','StudentController@store');
    Route::get('show','StudentController@show');
    Route::get('edit/{id}','StudentController@edit');
    Route::post('update/{id}','StudentController@update');
    Route::delete('delete/{id}','StudentController@destroy');
    Route::get('section/{para}','StudentController@section');
    Route::get('class_section/{class_id}/{section_id}','StudentController@classSection');
    Route::get('sibling/{id}','StudentController@selectStudent');
    Route::get('siblings/{id}','StudentController@selectSibling');
    Route::get('rooms/{id}','StudentController@selectHostel');
    Route::get('selectsection/{id}','StudentController@selectClassSection');
    Route::get('hostelroom/{hostel_id}/{room_id}','StudentController@selecthostelroom');
    Route::get('keyword/{keyword}','StudentController@selectByKeyword');
    Route::get('studentReport/{class_id}/{section_id}/{gender}','StudentController@studentReport');
    Route::get('studentReport1/{class_id}/{section_id}','StudentController@studentReport1');
    Route::get('studentReport2/{class_id}/{gender}','StudentController@studentReport2');
    Route::get('studentReport3/{class_id}','StudentController@studentReport3');
    Route::get('studentReport4/{gender}','StudentController@studentReport4');
});
Route::get('studentsibling', 'StudentSiblingController@index');
Route::group(['prefix' => 'studentsiblings'], function () {
    Route::post('add', 'StudentSiblingController@store');
    Route::get('show/{para}', 'StudentSiblingController@show');
    Route::get('edit/{id}', 'StudentSiblingController@edit');
    Route::post('update/{id}', 'StudentSiblingController@update');
    Route::delete('delete/{id}', 'StudentSiblingController@destroy');
    Route::get('/siblings/{id}','StudentSiblingController@selectStudentSiblings');
});
Route::get('session', 'StudentSessionController@index');
Route::group(['prefix' => 'sessions'], function () {
    Route::post('add', 'StudentSessionController@store');
    Route::get('show/{para}', 'StudentSessionController@show');
    Route::get('edit/{id}', 'StudentSessionController@edit');
    Route::post('update/{id}', 'StudentSessionController@update');
    Route::delete('delete/{id}', 'StudentSessionController@destroy');
});
Route::get('uploaddocument', 'StudentDocumentController@index');
Route::group(['prefix' => 'uploaddocuments'], function () {
    Route::post('add', 'StudentDocumentController@store');
    Route::get('show/{para}', 'StudentDocumentController@show');
    Route::get('edit/{id}', 'StudentDocumentController@edit');
    Route::post('update/{id}', 'StudentDocumentController@update');
    Route::delete('delete/{id}', 'StudentDocumentController@destroy');
});
//---------------------------------- end of wai yan moung -----------------

// Kyaw Soe Hein
Route::get('tranRouteList', 'RouteController@index');
Route::group(['prefix' => 'TranRoute'], function () {
    Route::post('save', 'RouteController@store');
    Route::get('edit/{id}', 'RouteController@edit');
    Route::delete('delete/{id}', 'RouteController@destroy');
});

Route::get('tranVehicleList', 'VehicleController@index');
Route::group(['prefix' => 'TranVehicle'], function () {
    Route::post('save', 'VehicleController@store');
    Route::get('edit/{id}', 'VehicleController@edit');
    Route::delete('delete/{id}', 'VehicleController@destroy');
});

Route::get('vehicleroute', 'VehicleRoutesController@index');
Route::group(['prefix' => 'VehicleRoute'], function() {
    Route::post('save','VehicleRoutesController@store');
    Route::get('edit/{id}','VehicleRoutesController@edit');
    Route::delete('delete/{id}','VehicleRoutesController@destroy');
});

//Thein Htike Aung
Route::group(['prefix'=>'examResults'],function(){
    Route::post('addExamResults','ExamResultsController@store');
    Route::get('getExamResultData/{idsArray}','ExamResultsController@getExamResultData');
    Route::post('editExamResult','ExamResultsController@update');
});
Route::get('ExamList','ExamsController@index');
Route::get('ExamTest','ExamsController@getAcademicActiveId');
Route::group(['prefix' => 'exams'], function() {
    Route::post('addexam','ExamsController@store');
    Route::get('editexam/{id}','ExamsController@edit');
    Route::get('deleteexam/{id}','ExamsController@destroy');
});
Route::group(['prefix' => 'examSchadules'], function() {
    Route::post('addExamSchadule','ExamSchaduleController@store');
    Route::get('getExamData/{gettingArrays}','ExamSchaduleController@getExamData');
    Route::get('getClassName/{id}','ExamSchaduleController@getClassName');
    Route::get('getSectionName/{id}','ExamSchaduleController@getSectionName');
    Route::post('updateExamSchadule/{id}','ExamSchaduleController@update');

});
Route::group(['prefix' => 'marksGrade'], function() {
    Route::get('getMarksGrade','MarksGradeController@index');
    Route::post('addMarksGrade','MarksGradeController@store');
    Route::get('deleteMarksGrade/{id}','MarksGradeController@destroy');
    Route::get('editMarksGrade/{id}','MarksGradeController@edit');
    Route::get('getSearchData/{idsArray}','MarksGradeController@getSearchData');
    Route::get('getExamSubject/{idsArray}','MarksGradeController@getExamSubject');
    Route::get('getStudentExam/{idsArray}','MarksGradeController@GetStudentAndExam');
});
Route::get('activeacademicyr', 'AcademicYearController@activeAcademic');
Route::get('getClasses', 'ExamsController@Theinindex');
Route::get('getSections', 'ExamsController@Zheinindex');
Route::get('getClassSectionId/{arrayids}','ExamsController@getAssignSub_id');
Route::get('getClassSection/{id}', 'ExamsController@CSZTheinindex');
Route::get('searchExamSchadule/{arrayClassSectionExam}', 'ExamSchaduleController@index');
// End Thei Htike Aung Section

// Start Home work
Route::get('homework', 'HomeworkController@index');
Route::group(['prefix' => 'homework'], function() {
    Route::post('save','HomeworkController@store');
    Route::post('edit','HomeworkController@edit');
    Route::get('delete/{id}','HomeworkController@destroy');
});

// Start Content
Route::get('content', 'ContentController@index');
Route::group(['prefix' => 'content'], function() {
    Route::post('save','ContentController@store');
    Route::post('show','ContentController@show');
    Route::get('delete/{id}','ContentController@destroy');
});

//Lwin Kyaw Phyo
//Academic Year Route
Route::get('academicyr', 'AcademicYearController@index');
Route::group(['prefix' => 'AcademicYear'], function() {
    Route::post('save','AcademicYearController@store');
    Route::post('update','AcademicYearController@update');
    Route::get('edit/{id}','AcademicYearController@edit');
    Route::delete('delete/{id}','AcademicYearController@destroy');
});

//Section Route
Route::get('section', 'SectionController@index');
Route::group(['prefix' => 'Section'], function() {
    Route::post('save','SectionController@store');
    Route::get('edit/{id}','SectionController@edit');
    Route::delete('delete/{id}','SectionController@destroy');
});

//Class Route
Route::get('class', 'ClassesController@index');
Route::group(['prefix' => 'Class'], function() {
    Route::post('save','ClassesController@store');
    Route::get('edit/{id}','ClassesController@edit');
    Route::delete('delete/{id}','ClassesController@destroy');
});

//Subject Route
Route::get('subject', 'SubjectController@index');
Route::group(['prefix' => 'Subject'], function() {
    Route::post('save','SubjectController@store');
    Route::get('edit/{id}','SubjectController@edit');
    Route::delete('delete/{id}','SubjectController@destroy');
});

//Assign Class Teacher Route
Route::get('classTeacher', 'AssignclassteacherController@index');
Route::group(['prefix' => 'ClassTeacher'], function() {
    Route::post('save','AssignclassteacherController@store');
    Route::get('edit/{id}','AssignclassteacherController@edit');
    Route::delete('delete/{id}','AssignclassteacherController@destroy');
});

//Assign Subject Route
Route::get('asssubject', 'AssignSubjectController@index');
Route::group(['prefix' => 'AssSubject'], function() {
    Route::post('save','AssignSubjectController@store');
    Route::post('search','AssignSubjectController@search');
    Route::post('edit','AssignSubjectController@edit');
    Route::get('editsearch/{id}','AssignSubjectController@editsearch');    
    Route::delete('delete/{id}','AssignSubjectController@destroy');
});

//Class Time Table Route
Route::get('classtimetbl', 'ClassTimetableController@index');
Route::group(['prefix' => 'ClassTimeTable'], function() {
    Route::post('save','ClassTimetableController@store');
    Route::post('search','ClassTimetableController@search');
    Route::post('viewsearch','ClassTimetableController@viewsearch');
    Route::get('edit/{id}','ClassTimetableController@edit');
    Route::delete('delete/{id}','ClassTimetableController@destroy');
});
//Lwin Kyaw Phyo

// Sai Kaung Htet General Setting
Route::get('settings','GeneralController@index');
Route::get('color','GeneralController@getColor');
Route::group(['prefix' => 'setting'],function() {
    Route::post('store/{id}', 'GeneralController@store');
    Route::post('update/{color}', 'GeneralController@update');
    Route::delete('delete/{id}', 'GeneralController@delete');
});

// General Setting -> School Detials
Route::get('schools','SchoolDetailController@index');
Route::group(['prefix'=>'school'],function(){
    Route::post('store','SchoolDetailController@store');
    Route::post('update/{id}','SchoolDetailController@update');
    Route::delete('delete/{id}','SchoolDetailController@delete');
    Route::post('updatePhoto/{image}','SchoolDetailController@updatePhoto');
});