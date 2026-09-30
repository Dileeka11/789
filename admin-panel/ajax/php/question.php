<?php
include '../../../class/include.php';
header('Content-Type: application/json; charset=UTF8');

//create fedaration
if (isset($_POST['create'])) {
    $QUESTION = new Question(NULL);
    $QUESTION->course = $_POST['course'];
    $QUESTION->module_id = $_POST['module'];
    if (isset($_POST['question'])) {
        $QUESTION->question = $_POST['question'];
    }
    if (isset($_POST['question_sinhala'])) {
        $QUESTION->question_sinhala = $_POST['question_sinhala'];
    }
    if (isset($_POST['question_tamil'])) {
        $QUESTION->question_tamil = $_POST['question_tamil'];
    }

    if (isset($_POST['answer_1'])) {
        $QUESTION->answer_1 = $_POST['answer_1'];
    }
    if (isset($_POST['answer_1_sinhala'])) {
        $QUESTION->answer_1_sinhala = $_POST['answer_1_sinhala'];
    }
    if (isset($_POST['answer_1_tamil'])) {
        $QUESTION->answer_1_tamil = $_POST['answer_1_tamil'];
    }
    if (isset($_POST['answer_2'])) {
        $QUESTION->answer_2 = $_POST['answer_2'];
    }
    if (isset($_POST['answer_2_sinhala'])) {
        $QUESTION->answer_2_sinhala = $_POST['answer_2_sinhala'];
    }
    if (isset($_POST['answer_2_tamil'])) {
        $QUESTION->answer_2_tamil = $_POST['answer_2_tamil'];
    }
    if (isset($_POST['answer_3'])) {
        $QUESTION->answer_3 = $_POST['answer_3'];
    }
    if (isset($_POST['answer_3_sinhala'])) {
        $QUESTION->answer_3_sinhala = $_POST['answer_3_sinhala'];
    }
    if (isset($_POST['answer_3_tamil'])) {
        $QUESTION->answer_3_tamil = $_POST['answer_3_tamil'];
    }
    if (isset($_POST['answer_4'])) {
        $QUESTION->answer_4 = $_POST['answer_4'];
    }
    if (isset($_POST['answer_4_sinhala'])) {
        $QUESTION->answer_4_sinhala = $_POST['answer_4_sinhala'];
    }
    if (isset($_POST['answer_4_tamil'])) {
        $QUESTION->answer_4_tamil = $_POST['answer_4_tamil'];
    }
    // $QUESTION->answer_1 = $_POST['answer_1'];
    // $QUESTION->answer_2 = $_POST['answer_2'];
    // $QUESTION->answer_3 = $_POST['answer_3'];
    // $QUESTION->answer_4 = $_POST['answer_4'];
    $QUESTION->correct_answer = $_POST['correct_answer'];

    if (isset($_FILES['image_name'])) {
        $HELPER = new Helper();
        //image question 
        $dir_dest = '../../../nc_assets/uploads/questions/';
        $handle = new Upload($_FILES['image_name']);
        $imgName = null;
        if ($handle->uploaded) {
            $handle->image_resize = true;
            $handle->file_new_name_ext = 'jpg';
            $handle->image_ratio_crop = 'C';
            $handle->file_new_name_body = $HELPER->randamId();
            $handle->image_x = 300;
            $handle->image_y = 300;
            $handle->Process($dir_dest);
            if ($handle->processed) {
                $info = getimagesize($handle->file_dst_pathname);
                $imgName = $handle->file_dst_name;
            }
        }
        $QUESTION->image_name = $imgName;
    }
    if (isset($_FILES['image_answer_1'])) {
        //imsge answer 1 
        $dir_dest_1 = '../../../nc_assets/uploads/questions/options/';
        $handle_1 = new Upload($_FILES['image_answer_1']);
        $imgName_1 = null;
        if ($handle_1->uploaded) {
            $handle_1->image_resize = true;
            $handle_1->file_new_name_ext = 'jpg';
            $handle_1->image_ratio_crop = 'C';
            $handle_1->file_new_name_body = $HELPER->randamId();
            $handle_1->image_x = 300;
            $handle_1->image_y = 300;
            $handle_1->Process($dir_dest_1);
            if ($handle_1->processed) {
                $info = getimagesize($handle_1->file_dst_pathname);
                $imgName_1 = $handle_1->file_dst_name;
            }
        }
        $QUESTION->image_answer_1 = $imgName_1;
    }
    if (isset($_FILES['image_answer_2'])) {
        //imsge answer 2 
        $dir_dest_2 = '../../../nc_assets/uploads/questions/options/';
        $handle_2 = new Upload($_FILES['image_answer_2']);
        $imgName_2 = null;
        if ($handle_2->uploaded) {
            $handle_2->image_resize = true;
            $handle_2->file_new_name_ext = 'jpg';
            $handle_2->image_ratio_crop = 'C';
            $handle_2->file_new_name_body = $HELPER->randamId();
            $handle_2->image_x = 300;
            $handle_2->image_y = 300;
            $handle_2->Process($dir_dest_2);
            if ($handle_2->processed) {
                $info = getimagesize($handle_2->file_dst_pathname);
                $imgName_2 = $handle_2->file_dst_name;
            }
        }
        $QUESTION->image_answer_2 = $imgName_2;
    }
    if (isset($_FILES['image_answer_3'])) {
        //imsge answer 3 
        $dir_dest_3 = '../../../nc_assets/uploads/questions/options/';
        $handle_3 = new Upload($_FILES['image_answer_3']);
        $imgName_3 = null;
        if ($handle_3->uploaded) {
            $handle_3->image_resize = true;
            $handle_3->file_new_name_ext = 'jpg';
            $handle_3->image_ratio_crop = 'C';
            $handle_3->file_new_name_body = $HELPER->randamId();
            $handle_3->image_x = 300;
            $handle_3->image_y = 300;
            $handle_3->Process($dir_dest_3);
            if ($handle_3->processed) {
                $info = getimagesize($handle_3->file_dst_pathname);
                $imgName_3 = $handle_3->file_dst_name;
            }
        }
        $QUESTION->image_answer_3 = $imgName_3;
    }
    if (isset($_FILES['image_answer_4'])) {
        //imsge answer 4 
        $dir_dest_4 = '../../../nc_assets/uploads/questions/options/';
        $handle_4 = new Upload($_FILES['image_answer_4']);
        $imgName_4 = null;
        if ($handle_4->uploaded) {
            $handle_4->image_resize = true;
            $handle_4->file_new_name_ext = 'jpg';
            $handle_4->image_ratio_crop = 'C';
            $handle_4->file_new_name_body = $HELPER->randamId();
            $handle_4->image_x = 300;
            $handle_4->image_y = 300;
            $handle_4->Process($dir_dest_4);
            if ($handle_4->processed) {
                $info = getimagesize($handle_4->file_dst_pathname);
                $imgName_4 = $handle_4->file_dst_name;
            }
        }
        $QUESTION->image_answer_4 = $imgName_4;
    }
    $QUESTION->create();
    $result = ["status" => 'success'];
    echo json_encode($result);
    exit();
}

//update doc
if (isset($_POST['update'])) {

    $HELPER = new Helper();
    $QUESTION = new Question($_POST['id']);
    $QUESTION->module_id = $_POST['module'];
    // $QUESTION->question = $_POST['question'];
    // $QUESTION->answer_1 = $_POST['answer_1'];
    // $QUESTION->answer_2 = $_POST['answer_2'];
    // $QUESTION->answer_3 = $_POST['answer_3'];
    // $QUESTION->answer_4 = $_POST['answer_4'];

    if (isset($_POST['question'])) {
        $QUESTION->question = $_POST['question'];
    }
    if (isset($_POST['question_sinhala'])) {
        $QUESTION->question_sinhala = $_POST['question_sinhala'];
    }
    if (isset($_POST['question_tamil'])) {
        $QUESTION->question_tamil = $_POST['question_tamil'];
    }

    if (isset($_POST['answer_1'])) {
        $QUESTION->answer_1 = $_POST['answer_1'];
    }
    if (isset($_POST['answer_1_sinhala'])) {
        $QUESTION->answer_1_sinhala = $_POST['answer_1_sinhala'];
    }
    if (isset($_POST['answer_1_tamil'])) {
        $QUESTION->answer_1_tamil = $_POST['answer_1_tamil'];
    }
    if (isset($_POST['answer_2'])) {
        $QUESTION->answer_2 = $_POST['answer_2'];
    }
    if (isset($_POST['answer_2_sinhala'])) {
        $QUESTION->answer_2_sinhala = $_POST['answer_2_sinhala'];
    }
    if (isset($_POST['answer_2_tamil'])) {
        $QUESTION->answer_2_tamil = $_POST['answer_2_tamil'];
    }
    if (isset($_POST['answer_3'])) {
        $QUESTION->answer_3 = $_POST['answer_3'];
    }
    if (isset($_POST['answer_3_sinhala'])) {
        $QUESTION->answer_3_sinhala = $_POST['answer_3_sinhala'];
    }
    if (isset($_POST['answer_3_tamil'])) {
        $QUESTION->answer_3_tamil = $_POST['answer_3_tamil'];
    }
    if (isset($_POST['answer_4'])) {
        $QUESTION->answer_4 = $_POST['answer_4'];
    }
    if (isset($_POST['answer_4_sinhala'])) {
        $QUESTION->answer_4_sinhala = $_POST['answer_4_sinhala'];
    }
    if (isset($_POST['answer_4_tamil'])) {
        $QUESTION->answer_4_tamil = $_POST['answer_4_tamil'];
    }

    $QUESTION->correct_answer = $_POST['correct_answer'];
    //edit question
    if (isset($_FILES['image_name']) && $_FILES['image_name']['name'] != '') {
        $dir_dest = '../../../nc_assets/uploads/questions/';
        $handle = new Upload($_FILES['image_name']);
        $imgName = null;
        if ($_POST["oldQuestionImage"] == '') {
            if ($handle->uploaded) {
                $handle->image_resize = true;
                $handle->file_new_name_ext = 'jpg';
                $handle->image_ratio_crop = 'C';
                $handle->file_new_name_body = $HELPER->randamId();
                $handle->image_x = 300;
                $handle->image_y = 300;
                $handle->Process($dir_dest);
                if ($handle->processed) {
                    $info = getimagesize($handle->file_dst_pathname);
                    $imgName = $handle->file_dst_name;
                }
            }
        } else {
            if ($handle->uploaded) {
                $handle->image_resize = true;
                $handle->file_new_name_body = TRUE;
                $handle->file_overwrite = TRUE;
                $handle->file_new_name_ext = FALSE;
                $handle->image_ratio_crop = 'C';
                $handle->file_new_name_body = $_POST["oldQuestionImage"];
                $handle->image_x = 300;
                $handle->image_y = 300;
                $handle->Process($dir_dest);
                if ($handle->processed) {
                    $info = getimagesize($handle->file_dst_pathname);
                    $imgName = $handle->file_dst_name;
                }
            }
        }
        $QUESTION->image_name = $imgName;
    }
    if (isset($_FILES['image_answer_1']) && $_FILES['image_answer_1']['name'] != '') {
        //edit question
        $dir_dest1 = '../../../nc_assets/uploads/questions/options/';
        $handle1 = new Upload($_FILES['image_answer_1']);
        $imgName1 = null;
        if ($_POST["oldAnswerImage1"] == '') {
            if ($handle1->uploaded) {
                $handle1->image_resize = true;
                $handle1->file_new_name_ext = 'jpg';
                $handle1->image_ratio_crop = 'C';
                $handle1->file_new_name_body = $HELPER->randamId();
                $handle1->image_x = 300;
                $handle1->image_y = 300;
                $handle1->Process($dir_dest1);
                if ($handle1->processed) {
                    $info = getimagesize($handle1->file_dst_pathname);
                    $imgName1 = $handle1->file_dst_name;
                }
            }
        } else {
            if ($handle1->uploaded) {
                $handle1->image_resize = true;
                $handle1->file_new_name_body = TRUE;
                $handle1->file_overwrite = TRUE;
                $handle1->file_new_name_ext = FALSE;
                $handle1->image_ratio_crop = 'C';
                $handle1->file_new_name_body = $_POST["oldAnswerImage1"];
                $handle1->image_x = 300;
                $handle1->image_y = 300;
                $handle1->Process($dir_dest1);
                if ($handle1->processed) {
                    $info = getimagesize($handle1->file_dst_pathname);
                    $imgName1 = $handle1->file_dst_name;
                }
            }
        }
        $QUESTION->image_answer_1 = $imgName1;
    }
    if (isset($_FILES['image_answer_2']) && $_FILES['image_answer_2']['name'] != '') {
        //edit question
        $dir_dest2 = '../../../nc_assets/uploads/questions/options/';
        $handle2 = new Upload($_FILES['image_answer_2']);
        $imgName2 = null;
        if ($_POST["oldAnswerImage2"] == '') {
            if ($handle2->uploaded) {
                $handle2->image_resize = true;
                $handle2->file_new_name_ext = 'jpg';
                $handle2->image_ratio_crop = 'C';
                $handle2->file_new_name_body = $HELPER->randamId();
                $handle2->image_x = 300;
                $handle2->image_y = 300;
                $handle2->Process($dir_dest2);
                if ($handle2->processed) {
                    $info = getimagesize($handle2->file_dst_pathname);
                    $imgName2 = $handle2->file_dst_name;
                }
            }
        } else {
            if ($handle2->uploaded) {
                $handle2->image_resize = true;
                $handle2->file_new_name_body = TRUE;
                $handle2->file_overwrite = TRUE;
                $handle2->file_new_name_ext = FALSE;
                $handle2->image_ratio_crop = 'C';
                $handle2->file_new_name_body = $_POST["oldAnswerImage2"];
                $handle2->image_x = 252;
                $handle2->image_y = 252;
                $handle2->Process($dir_dest2);
                if ($handle2->processed) {
                    $info = getimagesize($handle2->file_dst_pathname);
                    $imgName2 = $handle2->file_dst_name;
                }
            }
        }
        $QUESTION->image_answer_2 = $imgName2;
    }
    if (isset($_FILES['image_answer_3']) && $_FILES['image_answer_3']['name'] != '') {
        //edit question
        $dir_dest3 = '../../../nc_assets/uploads/questions/options/';
        $handle3 = new Upload($_FILES['image_answer_3']);
        $imgName3 = null;
        if ($_POST["oldAnswerImage3"] == '') {
            if ($handle3->uploaded) {
                $handle3->image_resize = true;
                $handle3->file_new_name_ext = 'jpg';
                $handle3->image_ratio_crop = 'C';
                $handle3->file_new_name_body = $HELPER->randamId();
                $handle3->image_x = 300;
                $handle3->image_y = 300;
                $handle3->Process($dir_dest3);
                if ($handle3->processed) {
                    $info = getimagesize($handle3->file_dst_pathname);
                    $imgName3 = $handle3->file_dst_name;
                }
            }
        } else {
            if ($handle3->uploaded) {
                $handle3->image_resize = true;
                $handle3->file_new_name_body = TRUE;
                $handle3->file_overwrite = TRUE;
                $handle3->file_new_name_ext = FALSE;
                $handle3->image_ratio_crop = 'C';
                $handle3->file_new_name_body = $_POST["oldAnswerImage3"];
                $handle3->image_x = 300;
                $handle3->image_y = 300;
                $handle3->Process($dir_dest3);
                if ($handle3->processed) {
                    $info = getimagesize($handle3->file_dst_pathname);
                    $imgName3 = $handle3->file_dst_name;
                }
            }
        }
        $QUESTION->image_answer_3 = $imgName3;
    }
    if (isset($_FILES['image_answer_4']) && $_FILES['image_answer_4']['name'] != '') {
        //edit question
        $dir_dest4 = '../../../nc_assets/uploads/questions/options/';
        $handle4 = new Upload($_FILES['image_answer_4']);
        $imgName4 = null;
        if ($_POST["oldAnswerImage4"] == '') {
            if ($handle4->uploaded) {
                $handle4->image_resize = true;
                $handle4->file_new_name_ext = 'jpg';
                $handle4->image_ratio_crop = 'C';
                $handle4->file_new_name_body = $HELPER->randamId();
                $handle4->image_x = 300;
                $handle4->image_y = 300;
                $handle4->Process($dir_dest4);
                if ($handle4->processed) {
                    $info = getimagesize($handle4->file_dst_pathname);
                    $imgName4 = $handle4->file_dst_name;
                }
            }
        } else {
            if ($handle4->uploaded) {
                $handle4->image_resize = true;
                $handle4->file_new_name_body = TRUE;
                $handle4->file_overwrite = TRUE;
                $handle4->file_new_name_ext = FALSE;
                $handle4->image_ratio_crop = 'C';
                $handle4->file_new_name_body = $_POST["oldAnswerImage4"];
                $handle4->image_x = 300;
                $handle4->image_y = 300;
                $handle4->Process($dir_dest4);
                if ($handle4->processed) {
                    $info = getimagesize($handle4->file_dst_pathname);
                    $imgName4 = $handle4->file_dst_name;
                }
            }
        }
        $QUESTION->image_answer_4 = $imgName4;
    }




    $QUESTION->update();
    $result = ["status" => 'success'];
    echo json_encode($result);
    exit();
}
