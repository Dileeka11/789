<?php
include_once(dirname(__FILE__) . '/Database.php');
include_once(dirname(__FILE__) . '/User.php');
include_once(dirname(__FILE__) . '/UserType.php');
include_once(dirname(__FILE__) . '/Student.php');
include_once(dirname(__FILE__) . '/Course.php');
include_once(dirname(__FILE__) . '/Courseok.php'); 
include_once(dirname(__FILE__) . '/Question.php');
include_once(dirname(__FILE__) . '/Province.php');
include_once(dirname(__FILE__) . '/CourseRequest.php');
include_once(dirname(__FILE__) . '/CenterCourses.php');
include_once(dirname(__FILE__) . '/Divisions.php');
include_once(dirname(__FILE__) . '/Positions.php');
include_once(dirname(__FILE__) . '/DivisionPositions.php');
include_once(dirname(__FILE__) . '/PositionsLevel.php');
include_once(dirname(__FILE__) . '/Documents.php');
include_once(dirname(__FILE__) . '/DocumentStatus.php');
include_once(dirname(__FILE__) . '/DocumentCopies.php');
include_once(dirname(__FILE__) . '/OtherDocumentDivision.php');
include_once(dirname(__FILE__) . '/RequestOpenClose.php');
include_once(dirname(__FILE__) . '/SmartYouth.php');
include_once(dirname(__FILE__) . '/ActionPanel.php'); 
include_once(dirname(__FILE__) . '/CourseSyllabus.php'); 
include_once(dirname(__FILE__) . '/PracticalPapers.php'); 
include_once(dirname(__FILE__) . '/TheoryPapers.php'); 

include_once(dirname(__FILE__) . '/Districts.php');
include_once(dirname(__FILE__) . '/Gndivision.php');
include_once(dirname(__FILE__) . '/Dsdivision.php');
include_once(dirname(__FILE__) . '/Applications.php');
include_once(dirname(__FILE__) . '/CourseTrade.php');
include_once(dirname(__FILE__) . '/StudentPayment.php');
include_once(dirname(__FILE__) . '/SendMessage.php'); 

include_once(dirname(__FILE__) . '/SheduleExam.php');
include_once(dirname(__FILE__) . '/QuestionType.php');
include_once(dirname(__FILE__) . '/WrittingPapers.php');
include_once(dirname(__FILE__) . '/StudentExam.php');
include_once(dirname(__FILE__) . '/Centers.php');
include_once(dirname(__FILE__) . '/ExamStudent.php');
include_once(dirname(__FILE__) . '/ExamStudentQuestion.php');
include_once(dirname(__FILE__) . '/File.php');

include_once(dirname(__FILE__) . '/InstructorCourses.php');
include_once(dirname(__FILE__) . '/CourseModule.php');
include_once(dirname(__FILE__) . '/ExamPeriod.php');
include_once(dirname(__FILE__) . '/ExamPaper.php');
include_once(dirname(__FILE__) . '/ExamPaperQuestions.php');
include_once(dirname(__FILE__) . '/DraftExamPaperQuestions.php');
include_once(dirname(__FILE__) . '/SurveyTeam.php');
include_once(dirname(__FILE__) . '/Slider.php');
include_once(dirname(__FILE__) . '/Courses.php');



include_once(dirname(__FILE__) . '/FundTypes.php');
include_once(dirname(__FILE__) . '/AnnualFund.php');
include_once(dirname(__FILE__) . '/LeagueTypes.php');
include_once(dirname(__FILE__) . '/LeagueFundAmount.php'); 
include_once(dirname(__FILE__) . '/PaymentFund.php');
include_once(dirname(__FILE__) . '/Upload.php');
include_once(dirname(__FILE__) . '/Helper.php');
include_once(dirname(__FILE__) . '/NonNvqInstructor.php');


include_once(dirname(__FILE__) . '/DefaultData.php');
  
function dd($data)
{
    var_dump($data);
    exit();
}

function redirect($url)
{
    $string = '<script type="text/javascript">';
    $string .= 'window.location = "' . $url . '"';
    $string .= '</script>';
    echo $string;
    exit();
}
function base_url()
{
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
    $host = $_SERVER['HTTP_HOST'];
    $script = $_SERVER['SCRIPT_NAME'];

    // Remove the file name and path from the script
    $path = dirname($script);

    // Combine the protocol, host, and path
    $baseURL = $protocol . $host . $path;

    return $baseURL;
}
