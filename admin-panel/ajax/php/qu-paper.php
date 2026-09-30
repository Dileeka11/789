<?php

include '../../../class/include.php';
header('Content-Type: application/json; charset=UTF8');

if (isset($_POST['action']) && $_POST['action'] == 'SAVE_PAPER') {
    $EXAM_PERIOD = new ExamPeriod($_POST['exam_period_id']);
    $EXAM_PAPER = new ExamPaper(null);
    $EXAM_PAPER->course_id = $_POST['course_id'];
    $EXAM_PAPER->exam_period_id = $_POST['exam_period_id'];
    $EXAM_PAPER->year = $EXAM_PERIOD->year;
    $EXAM_PAPER->batch = $EXAM_PERIOD->batch;
    $EXAM_PAPER->is_submitted = 0;
    $res = $EXAM_PAPER->create();
    // dd(serialize($_POST['courses']));
    if ($res) {
        foreach ($_POST['selected_questions'] as $qu_id) {
            $EXAM_PAPER_QU = new DraftExamPaperQuestions(null);
            $EXAM_PAPER_QU->exam_paper_id = $res;
            $EXAM_PAPER_QU->qu_id = $qu_id;
            $EXAM_PAPER_QU->create();
        }
    }

    $result = [
        "status" => 'success',
        "paper_id" => $res,
    ];
    echo json_encode($result);
    exit();
}
if (isset($_POST['action']) && $_POST['action'] == 'SUBMIT_PAPER') {
    $EXAM_PERIOD = new ExamPeriod($_POST['exam_period_id']);
    $EXAM_PAPER = new ExamPaper(null);
    $EXAM_PAPER->course_id = $_POST['course_id'];
    $EXAM_PAPER->exam_period_id = $_POST['exam_period_id'];
    $EXAM_PAPER->year = $EXAM_PERIOD->year;
    $EXAM_PAPER->batch = $EXAM_PERIOD->batch;
    $EXAM_PAPER->is_submitted = 1;
    $res = $EXAM_PAPER->create();
    // dd(serialize($_POST['courses']));
    if ($res) {
        foreach ($_POST['selected_questions'] as $qu_id) {
            $EXAM_PAPER_QU = new ExamPaperQuestions(null);
            $EXAM_PAPER_QU->exam_paper_id = $res;
            $EXAM_PAPER_QU->qu_id = $qu_id;
            $EXAM_PAPER_QU->create();
        }
    }

    $result = [
        "status" => 'success',
        "paper_id" => $res,
    ];
    echo json_encode($result);
    exit();
}
if (isset($_POST['action']) && $_POST['action'] == 'SUBMIT_SAVED_PAPER') {
    $EXAM_PERIOD = new ExamPeriod($_POST['exam_period_id']);
    $EXAM_PAPER = new ExamPaper($_POST['paper_id']);
    $EXAM_PAPER->is_submitted = 1;
    $EXAM_PAPER->updatePaperStatus();
    // dd(serialize($_POST['courses']));

    foreach ($_POST['selected_questions'] as $qu_id) {
        $EXAM_PAPER_QU = new ExamPaperQuestions(null);
        $EXAM_PAPER_QU->exam_paper_id = $_POST['paper_id'];
        $EXAM_PAPER_QU->qu_id = $qu_id;
        $EXAM_PAPER_QU->create();
    }
    $PAPER_QUES = new DraftExamPaperQuestions(null);
    $PAPER_QUES->deleteQuestionsByPaperId($_POST['paper_id']);

    $result = ["status" => 'success'];
    echo json_encode($result);
    exit();
}
if (isset($_POST['action']) && $_POST['action'] == 'UPDATE_PAPER') {
    $EXAM_PERIOD = new ExamPeriod($_POST['exam_period_id']);
    $EXAM_PAPER = new ExamPaper($_POST['paper_id']);
    // dd(serialize($_POST['courses']));
    $PAPER_QUES = new ExamPaperQuestions(null);
    $selected_questions = $PAPER_QUES->getQuestionsByExamPaperId($_POST['paper_id']);
    $selected_questions_ids = $PAPER_QUES->getQuestionIdsByExamPaperId($_POST['paper_id']);
    if (count($_POST['selected_questions']) > 0) {
        foreach ($_POST['selected_questions'] as $qu_id) {
            if (!in_array($qu_id, $selected_questions_ids)) {
                $EXAM_PAPER_QU = new ExamPaperQuestions(null);
                $EXAM_PAPER_QU->exam_paper_id = $_POST['paper_id'];
                $EXAM_PAPER_QU->qu_id = $qu_id;
                $EXAM_PAPER_QU->create();
            }
        }
        foreach ($selected_questions_ids as $qu_id1) {
            if (!in_array($qu_id1, $_POST['selected_questions'])) {
                $EXAM_PAPER_QU = new ExamPaperQuestions(null);
                $result = $EXAM_PAPER_QU->deleteQuestionByExamPaperIdAndQuestionId($_POST['paper_id'], $qu_id1);
            }
        }
    }
    $result = ["status" => 'success'];
    echo json_encode($result);
    exit();
}
if (isset($_POST['action']) && $_POST['action'] == 'UPDATE_SAVED_PAPER') {
    $EXAM_PERIOD = new ExamPeriod($_POST['exam_period_id']);
    $EXAM_PAPER = new ExamPaper($_POST['paper_id']);
    // dd(serialize($_POST['courses']));
    $PAPER_QUES = new DraftExamPaperQuestions(null);
    $selected_questions = $PAPER_QUES->getQuestionsByExamPaperId($_POST['paper_id']);
    $selected_questions_ids = $PAPER_QUES->getQuestionIdsByExamPaperId($_POST['paper_id']);
    if (count($_POST['selected_questions']) > 0) {
        foreach ($_POST['selected_questions'] as $qu_id) {
            if (!in_array($qu_id, $selected_questions_ids)) {
                $EXAM_PAPER_QU = new DraftExamPaperQuestions(null);
                $EXAM_PAPER_QU->exam_paper_id = $_POST['paper_id'];
                $EXAM_PAPER_QU->qu_id = $qu_id;
                $EXAM_PAPER_QU->create();
            }
        }
        foreach ($selected_questions_ids as $qu_id1) {
            if (!in_array($qu_id1, $_POST['selected_questions'])) {
                $EXAM_PAPER_QU = new DraftExamPaperQuestions(null);
                $result = $EXAM_PAPER_QU->deleteQuestionByExamPaperIdAndQuestionId($_POST['paper_id'], $qu_id1);
            }
        }
    }
    $result = ["status" => 'success'];
    echo json_encode($result);
    exit();
}
