<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// route to login and logout



 Route::prefix('user')->group(function() {
     //Route::get('/upload_anss', 'studentcontroller@upload_quesss')->name('student-saveanswer');
     Route::get('login', 'Auth\StudentLoginController@showLoginForm')->name('student-form');
     Route::post('login', 'Auth\StudentLoginController@attemptlogin')->name('student-login');
     Route::post('logout', 'Auth\StudentLoginController@logout')->name('student-logout');
     Route::get('/dashboard', 'studentcontroller@index')->name('student-dashboard');
     Route::get('/', 'HomeController@indexa');
     Route::get('/profile', 'studentcontroller@index')->name('student-profile');
     Route::POST('/task_status_update', 'studentcontroller@task_status_update')->name('student-task_status_update');
     Route::POST('/task_progress_update', 'studentcontroller@task_progress_update')->name('student-task_progress_update');
     Route::get('/online_tests', 'studentcontroller@onlinetest')->name('student-online_tests');
     Route::get('/online_tests_page', 'studentcontroller@onlinetest_page')->name('student-online_tests_page');
     Route::get('/test_series_list', 'studentcontroller@test_series_list')->name('student-test_series_list');
     Route::get('/test_series_list_page', 'studentcontroller@test_series_list_page')->name('student-test_series_list_page');
     Route::get('/test_series', 'studentcontroller@test_series')->name('student-test_series');
     Route::get('/test_series_page', 'studentcontroller@test_series_page')->name('student-test_series_page');
     Route::get('/papershow/', 'studentcontroller@papershow')->name('student-papershow');
     Route::get('/results/', 'studentcontroller@results')->name('student-results');
     Route::get('/results_page/', 'studentcontroller@results_page')->name('student-results_page');
     Route::get('/resultshow/', 'studentcontroller@resultshow')->name('student-resultshow');
     Route::get('/instructions', 'studentcontroller@instructions')->name('student-instructions');
     Route::get('/your_test_paper', 'studentcontroller@testpaper')->name('student-testpaper');
     Route::POST('/timeleft', 'studentcontroller@timeleft')->name('student-timeleft');
     Route::POST('/save_answer', 'studentcontroller@saveanswer')->name('student-saveanswer');
     Route::POST('/custom_save_answer', 'studentcontroller@custom_saveanswer')->name('student-custom_saveanswer');
     Route::POST('/custom_ans_img_upload', 'studentcontroller@custom_ans_img_upload')->name('student-custom_ans_img_upload');
     Route::POST('/delete_answer', 'studentcontroller@deleteanswer')->name('student-deleteanswer');
     Route::POST('/submit_result', 'studentcontroller@submit_result')->name('student-submit_result');
     Route::POST('/custom_submit_result', 'studentcontroller@custom_submit_result')->name('student-custom_submit_result');
     Route::POST('/custom_delete_answer', 'studentcontroller@custom_deleteanswer')->name('student-custom_deleteanswer');
     //Route::POST('/adv_timeleft', 'studentcontroller@adv_timeleft')->name('student-adv_timeleft');
     Route::POST('/adv_save_answer', 'studentcontroller@adv_saveanswer')->name('student-adv_saveanswer');
     Route::POST('/adv_delete_answer', 'studentcontroller@adv_deleteanswer')->name('student-adv_deleteanswer');
     Route::POST('/adv_submit_result', 'studentcontroller@adv_submit_result')->name('student-adv_submit_result');
     Route::get('/result_analysis', 'studentcontroller@result_analysis')->name('student-result_analysis');
     Route::get('/settings', 'studentcontroller@settings')->name('student-settings');
     Route::POST('/change_password/', 'studentcontroller@changepassword')->name('student-changepassword');
//---------------------------------------------------------------classroom-----------------------------------------------
    
//------------------------------------------------------------------------------------------------------------------------
//-----------------------------------------------------web sockets---------------------------------------

     Route::get('/sockets_paper_controller', 'studentcontroller@paper_sockets')->name('student-paper_sockets');

//-------------------------------------------------------------------------------------------------------
  });


  Route::prefix('/admin')->group(function() {
      Route::get('login', 'Auth\AdminLoginController@showLoginForm')->name('admin-form');
      Route::post('login', 'Auth\AdminLoginController@attemptlogin')->name('admin-login');
      Route::post('logout', 'Auth\AdminLoginController@logout')->name('admin-logout');
      Route::get('/dashboard', 'AdminController@index')->name('admin-dashboard');
      Route::get('/profile', 'AdminController@profile')->name('admin-profile');
      Route::get('/', 'HomeController@indexb');

      //-----------------------------------------Create Paper-----------------------------------
      Route::get('/create_paper', 'AdminController@createpaper')->name('admin-create_paper');
      Route::POST('/submit_normal_paper', 'AdminController@submitnormalpaper')->name('admin-submit_normal_paper');
      Route::POST('/submit_advanced_paper', 'AdminController@submitadvancedpaper')->name('admin-submit_advanced_paper');

      //-----------------------------------------Custom paper Template-----------------------------------
      Route::get('/custom_paper_templates', 'AdminCustomPaperController@custom_paper_templates')->name('admin-custom_paper_templates');
      Route::get('/create_custom_paper_templates', 'AdminCustomPaperController@create_custom_paper_templates')->name('admin-create_custom_paper_templates');
      Route::POST('/create_custom_paper_templates_submit', 'AdminCustomPaperController@create_custom_paper_templates_submit')->name('admin-create_custom_paper_templates_submit');
      Route::get('/edit_custom_paper_templates', 'AdminCustomPaperController@edit_custom_paper_templates')->name('admin-edit_custom_paper_templates');
      Route::POST('/edit_custom_paper_templates_submit', 'AdminCustomPaperController@edit_custom_paper_templates_submit')->name('admin-edit_custom_paper_templates_submit');
      Route::get('/custom_paper_list', 'AdminCustomPaperController@custom_paper_list')->name('admin-custom_paper_list');
      Route::POST('/delete_custom_paper_templates', 'AdminCustomPaperController@delete_custom_paper_templates')->name('admin-delete_custom_paper_templates'); 
      Route::POST('/create_custom_papers', 'AdminCustomPaperController@create_custom_papers')->name('admin-create_custom_papers');

      //----------------------------------------Custom Paper---------------------------------------------------
      Route::get('/custom_papers', 'AdminCustomPaperController@custom_papers')->name('admin-custom_papers');
      Route::get('/custom_paper_page/', 'AdminSimplePaperController@custom_papers_page')->name('admin-custom_paper_page');
      Route::get('/edit_custom_papers', 'AdminCustomPaperController@edit_custom_papers')->name('admin-edit_custom_papers');
      Route::POST('/edit_custom_papers_submit', 'AdminCustomPaperController@edit_custom_papers_submit')->name('admin-edit_custom_papers_submit');
      Route::POST('/delete_custom_papers', 'AdminCustomPaperController@delete_custom_papers')->name('admin-delete_custom_papers');
      //Route::get('/custom_paper_templates', 'AdminCustomPaperController@custom_paper_templates')->name('admin-custom_paper_templates');
      Route::get('/cm_ques_upload', 'AdminCustomPaperController@custompaperquesupload')->name('admin-custom_paper_ques_upload');
      Route::POST('/cm_ques_upload_submit', 'AdminCustomPaperController@custompaperquesuploadsubmit')->name('admin-custom_paper_ques_upload_submit');
      Route::POST('/cm_sol_upload_submit', 'AdminCustomPaperController@custompapersoluploadsubmit')->name('admin-custom_paper_sol_upload_submit');
      Route::get('/cm_ans_upload', 'AdminCustomPaperController@custompaperansupload')->name('admin-custom_paper_ans_upload');
      Route::POST('/cm_ans_upload_submit', 'AdminCustomPaperController@custompaperansuploadsubmit')->name('admin-custom_paper_ans_upload_submit');
      Route::get('/get_results_json', 'AdminCustomPaperController@get_results_json')->name('admin-get_results_json');
      Route::POST('/update_results_submit', 'AdminCustomPaperController@update_results_submit')->name('admin-update_results_submit');
      Route::get('/cm_update_result_page', 'AdminCustomPaperController@custompaperupdateresultpage')->name('admin-custom_paper_update_result_page');
      Route::POST('/cm_update_result', 'AdminCustomPaperController@custompaperupdateresult')->name('admin-custom_paper_update_result');
      Route::get('/cm_publish', 'AdminCustomPaperController@custompaperpublish')->name('admin-custom_paper_publish');
      Route::POST('/cm_publish_submit', 'AdminCustomPaperController@custompaperpublishsubmit')->name('admin-custom_paper_publish_submit');
      Route::get('/cm_image/', 'AdminCustomPaperController@customimage')->name('admin-cm_image');
      Route::POST('/delete_image','AdminCustomPaperController@delete_image')->name('admin-delete_image');
      Route::get('/cm_p_summary', 'AdminCustomPaperController@cm_p_summary')->name('admin-custom_paper_summary');
      Route::get('/move_to_test_series/', 'AdminCustomPaperController@move_to_test_series')->name('admin-move_to_test_series');
      Route::get('/list_of_folder/', 'AdminCustomPaperController@list_of_folder')->name('admin-list_of_folder');
      //Route::POST('/deletecmpaper', 'AdminCustomPaperController@deletecmpaper')->name('admin-delete_cm_paper');
      //Route::get('/cm_paper_downtown', 'AdminCustomPaperController@cm_paper_download')->name('admin-cm_paper_download');
      //Route::get('/cm_paper_uptown', 'AdminCustomPaperController@cm_paper_upload')->name('admin-cm_paper_upload');
      //Route::POST('/cm_paper_uptown_submit', 'AdminCustomPaperController@cm_paper_upload_submit')->name('admin-cm_paper_upload_submit');

      //----------------------------------------web sockets-------------------------------------
        Route::get('/sockets_paper_controller', 'AdminController@paper_sockets')->name('admin-paper_sockets');

      //----------------------------------------Simple Created Paper----------------------------
      Route::get('/normal_paper/', 'AdminSimplePaperController@normalpaperupload')->name('admin-normal_paper');
      Route::get('/normal_paper_page/', 'AdminSimplePaperController@normalpaperupload_page')->name('admin-normal_paper_page');
      Route::get('/nr_ques_upload', 'AdminSimplePaperController@normalpaperquesupload')->name('admin-normal_paper_ques_upload');
      Route::POST('/nr_ques_upload_submit', 'AdminSimplePaperController@normalpaperquesuploadsubmit')->name('admin-normal_paper_ques_upload_submit');
      Route::POST('/nr_sol_upload_submit', 'AdminSimplePaperController@normalpapersoluploadsubmit')->name('admin-normal_paper_sol_upload_submit');
      Route::get('/nr_ans_upload', 'AdminSimplePaperController@normalpaperansupload')->name('admin-normal_paper_ans_upload');
      Route::POST('/nr_ans_upload_submit', 'AdminSimplePaperController@normalpaperansuploadsubmit')->name('admin-normal_paper_ans_upload_submit');
      //Route::get('/get_results_json', 'AdminSimplePaperController@get_results_json')->name('admin-get_results_json');
      //Route::POST('/update_results_submit', 'AdminSimplePaperController@update_results_submit')->name('admin-update_results_submit');
      Route::get('/nr_update_result_page', 'AdminSimplePaperController@normalpaperupdateresultpage')->name('admin-normal_paper_update_result_page');
      Route::POST('/nr_update_result', 'AdminSimplePaperController@normalpaperupdateresult')->name('admin-normal_paper_update_result');
      Route::get('/nr_publish', 'AdminSimplePaperController@normalpaperpublish')->name('admin-normal_paper_publish');
      Route::POST('/nr_publish_submit', 'AdminSimplePaperController@normalpaperpublishsubmit')->name('admin-normal_paper_publish_submit');
      Route::get('/paper_pdf_download', 'AdminSimplePaperController@paper_pdf_download')->name('admin-paper_pdf_download');
      Route::get('/editnormalpaper', 'AdminSimplePaperController@editnormalpaper')->name('admin-editnormalpaper');
      Route::get('/editnormalpaperpage', 'AdminSimplePaperController@editnormalpaperpage')->name('admin-editnormalpaperpage');
      Route::get('/nr_image/', 'AdminSimplePaperController@normalimage')->name('admin-nr_image');
      //Route::POST('/delete_image','AdminSimplePaperController@delete_image');
      Route::get('/nr_p_summary', 'AdminSimplePaperController@nr_p_summary')->name('admin-normal_paper_summary');
      // Route::get('/move_to_test_series/', 'AdminSimplePaperController@move_to_test_series')->name('admin-move_to_test_series');
      // Route::get('/list_of_folder/', 'AdminSimplePaperController@list_of_folder')->name('admin-list_of_folder');
      Route::POST('/deletenrpaper', 'AdminSimplePaperController@deletenrpaper')->name('admin-delete_nr_paper');
      Route::get('/nr_paper_downtown', 'AdminSimplePaperController@nr_paper_download')->name('admin-nr_paper_download');
      Route::get('/nr_paper_uptown', 'AdminSimplePaperController@nr_paper_upload')->name('admin-nr_paper_upload');
      Route::POST('/nr_paper_uptown_submit', 'AdminSimplePaperController@nr_paper_upload_submit')->name('admin-nr_paper_upload_submit');

      //---------------------------------------Advanced Created Paper-----------------------------------------
      Route::get('/advanced_paper', 'AdminAdvancedPaperController@advancedpaperupload')->name('admin-advanced_paper');
      Route::get('/advanced_paper_page', 'AdminAdvancedPaperController@advancedpaperupload_page')->name('admin-advanced_paper_page');
      Route::get('/adv_ques_upload', 'AdminAdvancedPaperController@advancedpaperquesupload')->name('admin-advanced_paper_ques_upload');
      Route::POST('/adv_ques_upload_submit', 'AdminAdvancedPaperController@advancedpaperquesuploadsubmit')->name('admin-advanced_paper_ques_upload_submit');
      Route::POST('/adv_sol_upload_submit', 'AdminAdvancedPaperController@advancedpapersoluploadsubmit')->name('admin-advanced_paper_sol_upload_submit');
      Route::get('/adv_ans_upload', 'AdminAdvancedPaperController@advancedpaperansupload')->name('admin-advanced_paper_ans_upload');
      Route::POST('/adv_ans_upload_submit', 'AdminAdvancedPaperController@advancedpaperansuploadsubmit')->name('admin-advanced_paper_ans_upload_submit');
      Route::get('/adv_update_result_page', 'AdminAdvancedPaperController@advancedpaperupdateresultpage')->name('admin-advanced_paper_update_result_page');
      Route::POST('/adv_update_result', 'AdminAdvancedPaperController@advancedpaperupdateresult')->name('admin-advanced_paper_update_result');
      Route::get('/adv_publish', 'AdminAdvancedPaperController@advancedpaperpublish')->name('admin-advanced_paper_publish');
      Route::POST('/adv_publish_submit', 'AdminAdvancedPaperController@advancedpaperpublishsubmit')->name('admin-advanced_paper_publish_submit');
      Route::get('/editadvancedpaper', 'AdminAdvancedPaperController@editadvancedpaper')->name('admin-editadvancedpaper');
      Route::get('/editadvancedpaperpage', 'AdminAdvancedPaperController@editadvancedpaperpage')->name('admin-editadvancedpaperpage');
      Route::get('/adv_image/', 'AdminAdvancedPaperController@advancedimage')->name('admin-adv_image');
      Route::get('/adv_p_summary', 'AdminAdvancedPaperController@adv_p_summary')->name('admin-advanced_paper_summary');
      Route::POST('/deleteadvpaper', 'AdminAdvancedPaperController@deleteadvpaper')->name('admin-delete_adv_paper');
      Route::get('/adv_paper_downtown', 'AdminAdvancedPaperController@adv_paper_download')->name('admin-adv_paper_download');
      Route::get('/adv_paper_uptown', 'AdminAdvancedPaperController@adv_paper_upload')->name('admin-adv_paper_upload');
      Route::POST('/adv_paper_uptown_submit', 'AdminAdvancedPaperController@adv_paper_upload_submit')->name('admin-adv_paper_upload_submit');

      //----------------------------------------------Uploaded Papers---------------------------------------------
      Route::get('/uploaded_paper', 'AdminUploadedPaperController@uploadedpaper')->name('admin-uploaded_paper');
      Route::get('/uploaded_paper_page', 'AdminUploadedPaperController@uploadedpaper_page')->name('admin-uploaded_paper_page');
      Route::get('/paper_link_details/', 'AdminUploadedPaperController@paper_link_details')->name('admin-paper_link_details');
      Route::get('/get_ans/', 'AdminUploadedPaperController@get_ans')->name('admin-get_ans');
      Route::POST('/auto_submit_result/', 'AdminUploadedPaperController@auto_submit_result')->name('admin-auto_submit_result');
      Route::get('/uploaded_papers/', 'AdminUploadedPaperController@uploaded_paper_edit')->name('admin-uploaded_paper_edit');
      Route::POST('/uploaded_papers_submit', 'AdminUploadedPaperController@uploaded_paper_edit_submit')->name('admin-uploaded_paper_edit_submit');
      Route::POST('/deletelink', 'AdminUploadedPaperController@deletelink')->name('admin-delete_link');
      Route::get('/ques_analysis', 'AdminUploadedPaperController@ques_analysis')->name('admin-ques_analysis');
  });
