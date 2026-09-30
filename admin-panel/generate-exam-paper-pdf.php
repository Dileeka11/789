<?php
include_once '../class/include.php';

// Load TCPDF
require_once 'plugin/tcpdf/tcpdf.php';

$paper_id = $_GET['id'] ?? '';
$period_id = $_GET['period_id'] ?? '';

$EXAM_PAPER = new ExamPaper($paper_id);
$COURSE = new Course($EXAM_PAPER->course_id);
$COURSETRADE = new CourseTrade($COURSE->tradecode);
$EXAMPERIOD = new ExamPeriod($EXAM_PAPER->exam_period_id);
$PAPER_QUES = new ExamPaperQuestions(null);
$all_selected_questions = $PAPER_QUES->getQuestionsByExamPaperId($paper_id);

// Extend TCPDF with custom Header and Footer
class MYPDF extends TCPDF {
    public $headerTitle = '';
    public $headerSubtitle = '';
    public $examPeriod = '';
    
    // Page header
    public function Header() {
        if ($this->page == 1) {
            $this->SetFont('freeserif', 'B', 16);
            $this->Cell(0, 10, $this->headerTitle, 0, true, 'C');
            $this->SetFont('freeserif', '', 12);
            $this->Cell(0, 8, $this->headerSubtitle, 0, true, 'C');
            $this->SetFont('freeserif', '', 10);
            $this->Cell(0, 6, 'Exam Period: ' . $this->examPeriod, 0, true, 'C');
            $this->Line(10, $this->GetY() + 2, $this->getPageWidth() - 10, $this->GetY() + 2);
            $this->Ln(5);
        }
    }
    
    // Page footer
    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('freeserif', 'I', 8);
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C');
    }
}

// Create new PDF document
$pdf = new MYPDF('P', 'mm', 'A4', true, 'UTF-8', false);

// Set document information
$pdf->SetCreator('NYSC Exam System');
$pdf->SetAuthor('NYSC');
$pdf->SetTitle('Exam Paper - ' . $COURSETRADE->name);
$pdf->SetSubject('Exam Paper');

// Set header data
$pdf->headerTitle = $COURSETRADE->name . ' (' . $COURSETRADE->code . ')';
$pdf->headerSubtitle = $COURSE->name;
$pdf->examPeriod = $EXAMPERIOD->title;

// Set margins
$pdf->SetMargins(15, 45, 15);
$pdf->SetHeaderMargin(10);
$pdf->SetFooterMargin(10);

// Set auto page breaks
$pdf->SetAutoPageBreak(true, 20);

// Set font - freeserif supports Unicode including Sinhala
$pdf->SetFont('freeserif', '', 11);

// Add a page
$pdf->AddPage();

// Output questions directly using MultiCell for better Unicode handling
foreach ($all_selected_questions as $key => $question) {
    $key++;
    $QUESTION = new Question($question['qu_id']);
    
    // Get question text based on language
    if ($COURSE->english_lang == 1) {
        $questionText = $QUESTION->question;
        $answer1 = $QUESTION->answer_1;
        $answer2 = $QUESTION->answer_2;
        $answer3 = $QUESTION->answer_3;
        $answer4 = $QUESTION->answer_4;
    } elseif ($COURSE->sinhala_lang == 1) {
        $questionText = $QUESTION->question_sinhala;
        $answer1 = $QUESTION->answer_1_sinhala;
        $answer2 = $QUESTION->answer_2_sinhala;
        $answer3 = $QUESTION->answer_3_sinhala;
        $answer4 = $QUESTION->answer_4_sinhala;
    } elseif ($COURSE->tamil_lang == 1) {
        $questionText = $QUESTION->question_tamil;
        $answer1 = $QUESTION->answer_1_tamil;
        $answer2 = $QUESTION->answer_2_tamil;
        $answer3 = $QUESTION->answer_3_tamil;
        $answer4 = $QUESTION->answer_4_tamil;
    }
    
    // Clean up text - remove HTML tags and decode entities
    $questionText = html_entity_decode(strip_tags($questionText), ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $answer1 = html_entity_decode(strip_tags($answer1), ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $answer2 = html_entity_decode(strip_tags($answer2), ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $answer3 = html_entity_decode(strip_tags($answer3), ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $answer4 = html_entity_decode(strip_tags($answer4), ENT_QUOTES | ENT_HTML5, 'UTF-8');
    
    // Question
    $pdf->SetFont('freeserif', 'B', 11);
    $pdf->MultiCell(0, 6, $key . '. ' . $questionText, 0, 'L', false, 1);
    
    // Answers
    $pdf->SetFont('freeserif', '', 11);
    $pdf->SetX(25);
    
    // Answer A
    if ($QUESTION->correct_answer == 1) {
        $pdf->SetTextColor(0, 128, 0);
        $pdf->SetFont('freeserif', 'B', 11);
    } else {
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('freeserif', '', 11);
    }
    $pdf->MultiCell(0, 5, 'A) ' . $answer1, 0, 'L', false, 1);
    $pdf->SetX(25);
    
    // Answer B
    if ($QUESTION->correct_answer == 2) {
        $pdf->SetTextColor(0, 128, 0);
        $pdf->SetFont('freeserif', 'B', 11);
    } else {
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('freeserif', '', 11);
    }
    $pdf->MultiCell(0, 5, 'B) ' . $answer2, 0, 'L', false, 1);
    $pdf->SetX(25);
    
    // Answer C
    if ($QUESTION->correct_answer == 3) {
        $pdf->SetTextColor(0, 128, 0);
        $pdf->SetFont('freeserif', 'B', 11);
    } else {
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('freeserif', '', 11);
    }
    $pdf->MultiCell(0, 5, 'C) ' . $answer3, 0, 'L', false, 1);
    $pdf->SetX(25);
    
    // Answer D
    if ($QUESTION->correct_answer == 4) {
        $pdf->SetTextColor(0, 128, 0);
        $pdf->SetFont('freeserif', 'B', 11);
    } else {
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('freeserif', '', 11);
    }
    $pdf->MultiCell(0, 5, 'D) ' . $answer4, 0, 'L', false, 1);
    
    // Reset color and add spacing
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Ln(5);
}

// Close and output PDF document
$pdf->Output('exam-paper.pdf', 'I');
exit;
?>
