 <?php

include '../../../class/include.php';
 
header('Content-Type: application/json');

$exam_stu_qu_id = isset($_POST['exam_stu_qu_id']) ? (int)$_POST['exam_stu_qu_id'] : 0;
$answer = isset($_POST['answer']) ? (int)$_POST['answer'] : 0;

if ($exam_stu_qu_id <= 0 || $answer <= 0) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
    exit;
}

// Load the existing exam_student_questions record
$EXAM_STUDENT_QUESTION = new ExamStudentQuestion($exam_stu_qu_id);

if (!$EXAM_STUDENT_QUESTION->id) {
    echo json_encode(['status' => 'error', 'message' => 'Record not found']);
    exit;
}

// Load the question to check the correct answer
$QUESTION = new Question($EXAM_STUDENT_QUESTION->question_id);

$is_correct = ($answer == $QUESTION->correct_answer) ? 1 : 0;
$points = $is_correct ? 1 : 0; // fixed 1 point per question


 
// Update using the model's own method
$EXAM_STUDENT_QUESTION->answer = $answer;
$EXAM_STUDENT_QUESTION->is_correct = $is_correct;
$EXAM_STUDENT_QUESTION->points = $points;



$success = $EXAM_STUDENT_QUESTION->updateStudentAnswer();

if ($success) {
    echo json_encode([
        'status' => 'success',
         
    ]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Update failed']);
}
