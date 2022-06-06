<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\account\AccountSalaryController;
use App\Http\Controllers\Backend\account\OtherCostController;
use App\Http\Controllers\Backend\account\StudentFeeController;
use App\Http\Controllers\Backend\DefaultController;
use App\Http\Controllers\Backend\employee\EmployeeAttendanceController;
use App\Http\Controllers\Backend\employee\EmployeeLeaveController;
use App\Http\Controllers\Backend\employee\EmployeeRegController;
use App\Http\Controllers\Backend\employee\EmployeeSalaryController;
use App\Http\Controllers\Backend\employee\EmplyMonthlySalaryCOntroller;
use App\Http\Controllers\Backend\marks\GradeController;
use App\Http\Controllers\backend\marks\MarksController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\profit\AttendReportController;
use App\Http\Controllers\Backend\profit\MarksheetController;
use App\Http\Controllers\Backend\profit\ProfitController;
use App\Http\Controllers\Backend\profit\ResultReportController;
use App\Http\Controllers\Backend\setup\AssignSubjectController;
use App\Http\Controllers\Backend\setup\DesignationController;
use App\Http\Controllers\Backend\setup\ExamTypeController;
use App\Http\Controllers\Backend\setup\FeeCategoryAmountController;
use App\Http\Controllers\Backend\setup\SchoolSubjectController;
use App\Http\Controllers\Backend\setup\StudentClassController;
use App\Http\Controllers\Backend\setup\StudentGroupController;
use App\Http\Controllers\Backend\setup\StudentShiftController;
use App\Http\Controllers\Backend\setup\StudentYearController;
use App\Http\Controllers\Backend\student\RegistrationFeeController;
use App\Http\Controllers\Backend\student\StudentRegController;
use App\Http\Controllers\Backend\student\StudentRollController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\FeeCategoryController;
use Illuminate\Support\Facades\Route;





Route::group(['middleware' => 'prevent-back-history'],function(){

 

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');
});


Route::get('/admin/logout',[AdminController::class,'Logout'])->name('admin.logout');

Route::group(['middleware' => 'auth'],function(){



// User manage all route
Route::prefix('user')->group(function(){
    Route::get('/view',[UserController::class,'UserView'])->name('user.view');
    Route::get('/add',[UserController::class,'UserAdd'])->name('users.add');
    Route::post('/store',[UserController::class,'UserStore'])->name('users.store');
    Route::get('/edit/{id}',[UserController::class,'UserEdit'])->name('users.edit');
    Route::post('/update/{id}',[UserController::class,'UpdateStore'])->name('users.update');
    Route::get('/delete/{id}',[UserController::class,'DeleteUser'])->name('users.delete');
});


// User profile manage all route
Route::prefix('profile')->group(function(){
    Route::get('/view',[ProfileController::class,'ProfileView'])->name('profile.view');
    Route::get('/edit',[ProfileController::class,'ProfileEdit'])->name('profile.edit');
    Route::post('/update',[ProfileController::class,'ProfileUpdate'])->name('profile.update');
    Route::get('/password/view',[ProfileController::class,'PasswordView'])->name('password.view');
    Route::post('/password/update',[ProfileController::class,'PasswordUpdate'])->name('password.update');
});


// Setup management all route
Route::prefix('setup')->group(function(){
    //student class route
    Route::get('student/class/view',[StudentClassController::class,'ViewStudentClass'])->name('student.class.view');
    Route::get('student/class/add',[StudentClassController::class,'AddStudentClass'])->name('student.class.add');
    Route::post('student/class/store',[StudentClassController::class,'StoreStudentClass'])->name('store.student.class');
    Route::get('student/class/edit/{id}',[StudentClassController::class,'EditStudentClass'])->name('student.class.edit'); 
    Route::post('student/class/update/{id}',[StudentClassController::class,'UpdateStudentClass'])->name('update.student.class');
    Route::get('student/class/delete/{id}',[StudentClassController::class,'DeleteStudentClass'])->name('student.class.delete');  
    
    
    //student year route
    Route::get('student/year/view',[StudentYearController::class,'ViewStudentYear'])->name('student.year.view');
    Route::get('student/year/add',[StudentYearController::class,'AddStudentYear'])->name('student.year.add');
    Route::post('student/year/store',[StudentYearController::class,'StoreStudentYear'])->name('store.student.year');
    Route::get('student/year/edit/{id}',[StudentYearController::class,'EditStudentYear'])->name('student.year.edit'); 
    Route::post('student/year/update/{id}',[StudentYearController::class,'UpdateStudentYear'])->name('update.student.year');
    Route::get('student/year/delete/{id}',[StudentYearController::class,'DeleteStudentYear'])->name('student.year.delete');


    //student group route
    Route::get('student/group/view',[StudentGroupController::class,'ViewStudentGroup'])->name('student.group.view');
    Route::get('student/group/add',[StudentGroupController::class,'AddStudentGroup'])->name('student.group.add');
    Route::post('student/group/store',[StudentGroupController::class,'StoreStudentGroup'])->name('store.student.group');
    Route::get('student/group/edit/{id}',[StudentGroupController::class,'EditStudentGroup'])->name('student.group.edit');
    Route::post('student/group/update/{id}',[StudentGroupController::class,'UpdateStudentGroup'])->name('update.student.group');
    Route::get('student/group/delete/{id}',[StudentGroupController::class,'DeleteStudentGroup'])->name('student.group.delete');


    //student shift route
    Route::get('student/shift/view',[StudentShiftController::class,'ViewStudentShift'])->name('student.shift.view');
    Route::get('student/shift/add',[StudentShiftController::class,'AddStudentShift'])->name('student.shift.add');
    Route::post('student/shift/store',[StudentShiftController::class,'StoreStudentYear'])->name('store.student.shift');
    Route::get('student/shift/edit/{id}',[StudentShiftController::class,'EditStudentShift'])->name('student.shift.edit');
    Route::post('student/shift/update/{id}',[StudentShiftController::class,'UpdateStudentShift'])->name('update.student.shift');
    Route::get('student/shift/delete/{id}',[StudentShiftController::class,'DeleteStudentShift'])->name('student.shift.delete');

    
    //fee category route
    Route::get('fee/category/view',[FeeCategoryController::class,'ViewFeeCat'])->name('fee.category.view');
    Route::get('add/fee/category',[FeeCategoryController::class,'AddFeeCategory'])->name('fee.category.add');
    Route::post('store/fee/category',[FeeCategoryController::class,'StoreFeeCategory'])->name('store.fee.category');
    Route::get('fee/category/edit/{id}',[FeeCategoryController::class,'EditFeeCategory'])->name('fee.category.edit');
    Route::post('update/fee/category/{id}',[FeeCategoryController::class,'UpdateFeeCategory'])->name('update.fee.category');
    Route::get('delete/fee/category/{id}',[FeeCategoryController::class,'DeleteFeeCategory'])->name('fee.category.delete');
    
    
    //fee category amount route
    Route::get('fee/amount/view',[FeeCategoryAmountController::class,'ViewFeeAmount'])->name('fee.amount.view');
    Route::get('add/fee/amount',[FeeCategoryAmountController::class,'AddFeeAmount'])->name('fee.amount.add');
    Route::post('store/fee/amount',[FeeCategoryAmountController::class,'StoreFeeAmount'])->name('store.fee.amount');
    Route::get('fee/amount/edit/{fee_category_id}',[FeeCategoryAmountController::class,'EditFeeAmount'])->name('fee.amount.edit');
    Route::post('update/fee/amount/{fee_category_id}',[FeeCategoryAmountController::class,'UpdateFeeAmount'])->name('update.fee.amount');
    Route::get('details/fee/category/{fee_category_id}',[FeeCategoryAmountController::class,'DetailsFeeCategory'])->name('fee.amount.details');


    
    //exam type  route
    Route::get('exam/type/view',[ExamTypeController::class,'ViewExamType'])->name('exam.type.view');
    Route::get('add/exam/type',[ExamTypeController::class,'AddExamType'])->name('exam.type.add');
    Route::post('store/exam/type',[ExamTypeController::class,'StoreExamType'])->name('store.exam.type');
    Route::get('exam/type/edit/{id}',[ExamTypeController::class,'EditExamType'])->name('exam.type.edit');
    Route::post('update/exam/type/{id}',[ExamTypeController::class,'UpdateExamType'])->name('update.exam.type');
    Route::get('delete/exam/type/{id}',[ExamTypeController::class,'DeleteExamType'])->name('exam.type.delete');


    //school subject route
    Route::get('school/subject/view',[SchoolSubjectController::class,'ViewExamType'])->name('school.subject.view');
    Route::get('add/school/subject',[SchoolSubjectController::class,'AddSchoolSubject'])->name('school.subject.add');
    Route::post('store/school/subject',[SchoolSubjectController::class,'StoreSchoolSubject'])->name('store.school.subject');
    Route::get('school/subject/edit/{id}',[SchoolSubjectController::class,'EditSchoolSubject'])->name('school.subject.edit');
    Route::post('update/school/subject/{id}',[SchoolSubjectController::class,'UpdateSchoolSubject'])->name('update.schoo.subject');
    Route::get('delete/school/subject/{id}',[SchoolSubjectController::class,'DeleteSchoolSubject'])->name('school.subject.delete');


    
    //fee category amount route
    Route::get('assign/subject/view',[AssignSubjectController::class,'ViewAssignSubject'])->name('assign.subject.view');
    Route::get('add/assign/subject',[AssignSubjectController::class,'AddAssignSubject'])->name('assign.subject.add');
    Route::post('store/assign/subject',[AssignSubjectController::class,'StoreAssignSubject'])->name('store.assign.subject');
    Route::get('assign/subject/edit/{class_id}',[AssignSubjectController::class,'EditAssignSubject'])->name('edit.assign.subject');
    Route::post('update/assign/subject/{class_id}',[AssignSubjectController::class,'UpdateAssignSubject'])->name('update.assign.subject');
    Route::get('details/assign/subject/{class_id}',[AssignSubjectController::class,'DetailsAssignSubject'])->name('assign.subject.details');


    
    //designation  route
    Route::get('designation/view',[DesignationController::class,'ViewDesignation'])->name('designation.view');
    Route::get('add/designation',[DesignationController::class,'AddDesignation'])->name('designation.add');
    Route::post('store/designation',[DesignationController::class,'StoreDesignation'])->name('store.designation');
    Route::get('exam/designation/{id}',[DesignationController::class,'EditDesignation'])->name('edit.designation');
    Route::post('update/designation/{id}',[DesignationController::class,'UpdateDesignation'])->name('update.designation');
    Route::get('delete/designation/{id}',[DesignationController::class,'DeleteDesignation'])->name('designation.delete');

});



// Student manage all route
Route::prefix('students')->group(function(){
    //student registration route
    Route::get('/reg/view',[StudentRegController::class,'StudentRegView'])->name('student.registration.view');
    Route::get('/reg/add',[StudentRegController::class,'StudentRegAdd'])->name('student.registration.add');
    Route::post('/reg/store',[StudentRegController::class,'StudentRegStore'])->name('store.student.registration');
    Route::get('/class/year/wise',[StudentRegController::class,'StudentClassYearWise'])->name('student.class.year.wise');
    Route::get('/reg/edit/{student_id}',[StudentRegController::class,'StudentRegEdit'])->name('student.registration.edit');
    Route::post('/reg/update/{student_id}',[StudentRegController::class,'StudentRegUpdate'])->name('update.student.registration');
    Route::get('/reg/promotion/{student_id}',[StudentRegController::class,'StudentRegPromotion'])->name('student.registration.promotion');
    Route::post('/reg/update/promotion/{student_id}',[StudentRegController::class,'StudentUpdatePromotion'])->name('promotion.student.registration');
    Route::get('/reg/details/{student_id}',[StudentRegController::class,'StudentRegDetails'])->name('student.registration.details');

    
    //roll generate route
    Route::get('/roll/generate/view',[StudentRollController::class,'StudentRollView'])->name('roll.generate.view');
    Route::get('/reg/getstudents',[StudentRollController::class,'GetStudents'])->name('student.registration.getstudents');
    Route::post('/roll/store',[StudentRollController::class,'StudentsRollStore'])->name('roll.genrate.store');


    //Registration Fee rotue
    Route::get('/reg/fee/view',[RegistrationFeeController::class,'RegFeeView'])->name('registration.fee.view');
    Route::get('/reg/fee/classwisedata', [RegistrationFeeController::class,'RegFeeClassData'])->name('student.registration.fee.classwise.get');
    Route::get('/reg/fee/payslip', [RegistrationFeeController::class,'RegFeePayslip'])->name('student.registration.fee.payslip');
    
    
});


    // Employee manage all route
Route::prefix('employees')->group(function(){
    //employee registration route
    Route::get('/reg/employee/view',[EmployeeRegController::class,'EmployeeView'])->name('employee.registration.view');
    Route::get('/reg/employee/add',[EmployeeRegController::class,'EmployeeAdd'])->name('employee.registration.add');
    Route::post('/reg/employee/store',[EmployeeRegController::class,'EmployeeStore'])->name('store.employee.registration');
    Route::get('/reg/employee/edit/{id}',[EmployeeRegController::class,'EmployeeEdit'])->name('employee.registration.edit');
    Route::post('/reg/employee/update/{id}',[EmployeeRegController::class,'EmployeeUpdate'])->name('update.employee.registration');
    Route::get('/reg/employee/details/{id}',[EmployeeRegController::class,'EmployeeDetails'])->name('employee.registration.details');
    
   
    //employee salary route
    Route::get('/salary/view',[EmployeeSalaryController::class,'EmployeeView'])->name('employee.salary.view');
    Route::get('/salary/increment/{id}',[EmployeeSalaryController::class,'EmployeeSalaryIncrement'])->name('employee.salary.increment');
    Route::post('/update/increment/salary/{id}',[EmployeeSalaryController::class,'UpdateEmployeeSalaryIncrement'])->name('update.increment.salary.store');
    Route::get('/salary/details/{id}',[EmployeeSalaryController::class,'EmployeeSalaryDetails'])->name('employee.salary.details');

    
    //employee salary route
    Route::get('/leave/view',[EmployeeLeaveController::class,'EmployeeLeaveView'])->name('employee.leave.view');
    Route::get('/leave/add',[EmployeeLeaveController::class,'EmployeeLeaveAdd'])->name('employee.leave.add');
    Route::post('/leave/store',[EmployeeLeaveController::class,'EmployeeLeaveStore'])->name('store.employee.leave');

    
    //employee attendance route
    Route::get('/attendance/view',[EmployeeAttendanceController::class,'EmployeeAttendanceView'])->name('employee.attendence.view');
    Route::get('/attendance/add',[EmployeeAttendanceController::class,'EmployeeAttendanceAdd'])->name('employee.attendace.add');
    Route::post('/attendance/store',[EmployeeAttendanceController::class,'EmployeeAttendanceStore'])->name('store.employee.attendace');
    Route::get('/attendance/edit/{date}',[EmployeeAttendanceController::class,'EmployeeAttendanceEdit'])->name('employee.attendance.edit');
    Route::post('/attendance/update/{date}',[EmployeeAttendanceController::class,'EmployeeAttendanceUpdate'])->name('update.employee.attendace');
    Route::get('/attendance/details/{date}',[EmployeeAttendanceController::class,'EmployeeAttendanceDetails'])->name('employee.attendance.details');

    
    //employee monthly salary route
    Route::get('/monthly/salary',[EmplyMonthlySalaryCOntroller::class,'MonthlySalaryView'])->name('employee.monthly.salary');
    Route::get('/monthly/salary/get',[EmplyMonthlySalaryCOntroller::class,'MonthlySalaryGet'])->name('employee.monthly.salary.get');
    Route::get('/monthly/salary/payslip/{employee_id}',[EmplyMonthlySalaryCOntroller::class,'MonthlySalaryPayslip'])->name('employee.monthly.salary.payslip');
});



    // marks manage all route 
    Route::prefix('marks')->group(function(){
        //mark related route
        Route::get('/marks/emntry/view',[MarksController::class,'MarksView'])->name('marks.emntry.view');
        Route::post('/marks/emntry/store',[MarksController::class,'MarksStore'])->name('marks.entry.store');
        Route::get('/entry/edit',[MarksController::class,'MarksEdit'])->name('marks.entry.edit');
        Route::get('/getstudent/edit',[MarksController::class,'MarksEditGetStudent'])->name('student.edit.getstudents');
        Route::post('/entry/update',[MarksController::class,'MarksUpdate'])->name('marks.entry.update');
        
        
        //grade related route
        Route::get('/marks/grade/view',[GradeController::class,'MarksGradeView'])->name('marks.entry.grade');
        Route::get('/marks/grade/add',[GradeController::class,'MarksGradeAdd'])->name('marks.grade.add');
        Route::post('/marks/grade/store',[GradeController::class,'MarksGradeStore'])->name('store.marks.grade');
        Route::get('/marks/grade/edit/{id}',[GradeController::class,'MarksGradeEdit'])->name('marks.grade.edit');
        Route::post('/marks/grade/update/{id}',[GradeController::class,'MarksGradeUpdate'])->name('update.marks.grade');
        Route::get('/marks/grade/delete/{id}',[GradeController::class,'MarksGradeDelete'])->name('marks.grade.delete');
    });
    Route::get('/marks/getsubject',[DefaultController::class,'GetSubject'])->name('marks.getsubject');
    Route::get('/student/marks/getstudent',[DefaultController::class,'GetStudent'])->name('student.marks.getstudents');


    
    // accoutns manage all route 
    Route::prefix('accounts')->group(function(){
        //student fee related route
        Route::get('/student/fee/view',[StudentFeeController::class,'StudentFeeView'])->name('student.fee.view');
        Route::get('/student/fee/add',[StudentFeeController::class,'StudentFeeAdd'])->name('student.fee.add');
        Route::get('/student/fee/getstudent',[StudentFeeController::class,'StudentFeeGetStudent'])->name('account.fee.getstudent');
        Route::post('/student/fee/store',[StudentFeeController::class,'StudentFeeStore'])->name('account.fee.store');
        
        
        //employee salary related route
        Route::get('/employee/salary/view',[AccountSalaryController::class,'AccountSalaryView'])->name('employee.salary.view');
        Route::get('/employee/salary/add',[AccountSalaryController::class,'AccountSalaryAdd'])->name('account.salary.add');
        Route::get('/employee/salary/getemployee',[AccountSalaryController::class,'AccountSalaryGetEmployee'])->name('account.salary.getemployee');
        Route::post('/employee/salary/store',[AccountSalaryController::class,'AccountSalaryStore'])->name('account.salary.store');
        
        
        //others cost related route
        Route::get('/other/cost/view',[OtherCostController::class,'OtherCostView'])->name('other.cost.view');
        Route::get('/other/cost/add',[OtherCostController::class,'OtherCostAdd'])->name('other.cost.add');
        Route::post('/other/cost/store',[OtherCostController::class,'OtherCostStore'])->name('store.other.cost');
        Route::get('/other/cost/edit/{id}',[OtherCostController::class,'OtherCostEdit'])->name('edit.other.cost');
        Route::post('/other/cost/update/{id}',[OtherCostController::class,'OtherCostUpdate'])->name('update.other.cost');
    });


    
    // Report management all route 
    Route::prefix('reports')->group(function(){
        //student fee related route
        Route::get('/monthly/profit/view',[ProfitController::class,'MonthlyProfitView'])->name('monthly.profit.view');
        Route::get('/monthly/profit/datewise',[ProfitController::class,'MonthlyProfitDateWise'])->name('report.profit.datewais.get');
        Route::get('/monthly/profit/pdf',[ProfitController::class,'MonthlyProfitPdf'])->name('report.profit.pdf');

        
        //marksheet generate related route
        Route::get('/marksheet/generate/view',[MarksheetController::class,'MarksheetView'])->name('marksheet.generate.view');
        Route::get('/marksheet/generate/get',[MarksheetController::class,'MarksheetGet'])->name('report.marksheet.get');

        
        //attendance report related route
        Route::get('/attendance/report/view',[AttendReportController::class,'AttendReportView'])->name('attendance.report.view');
        Route::get('/attendance/report/get',[AttendReportController::class,'AttendReportGet'])->name('report.attendance.get');

        
        //student result & ID card  related route
        Route::get('/student/result/view',[ResultReportController::class,'StudentResultView'])->name('student.result.view');
        Route::get('/student/result/get',[ResultReportController::class,'StudentResultGet'])->name('report.student.result.get');
        Route::get('/student/id_card/view',[ResultReportController::class,'StudentIDCardView'])->name('student.id_card.view');
        Route::get('/student/id_card/get',[ResultReportController::class,'StudentIDCardGet'])->name('report.student.idcard.get');
    });



});


}); //prevent back after log out middleware

