<?php

include '../../../class/include.php';
header('Content-Type: application/json; charset=UTF8');




//create slider
if (isset($_POST['create'])) {
    $SLIDER = new Slider(NULL);


    $SLIDER->title = $_POST['title'];
    $SLIDER->short_description = $_POST['short_description'];

    $dir_dest = '../../../upload/slider/';

    $handle = new Upload($_FILES['image_name']);
    $HELP = new Helper();
    $imgName = null;

    if ($handle->uploaded) {
        $handle->image_resize = true;
        $handle->file_new_name_ext = 'jpg';
        $handle->image_ratio_crop = 'C';
        $handle->file_new_name_body = $HELP->randamId();
        $handle->image_x = 1600;
        $handle->image_y = 820;

        $handle->Process($dir_dest);

        if ($handle->processed) {
            $info = getimagesize($handle->file_dst_pathname);
            $imgName = $handle->file_dst_name;
        }
    }

    $SLIDER->image_name = $imgName;


    $res = $SLIDER->create();

    if ($res) {
        $result = [
            "status" => 'success'
        ];
        echo json_encode($result);
        exit();
    } else {
        $result = [
            "status" => 'error'
        ];
        echo json_encode($result);
        exit();
    }
}

//update slider
if (isset($_POST['update'])) {

    $dir_dest = '../../../upload/slider/';
    
    
    $handle = new Upload($_FILES['image_name']);
    $imgName = null;

    if ($handle->uploaded) {
        $handle->image_resize = true;
        $handle->file_new_name_body = TRUE;
        $handle->file_overwrite = TRUE;
        $handle->file_new_name_ext = FALSE;
        $handle->image_ratio_crop = 'C';
        $handle->file_new_name_body = $_POST ["oldImageName"];
        $handle->image_x = 1600;
        $handle->image_y = 820;

        $handle->Process($dir_dest);

        if ($handle->processed) {
            $info = getimagesize($handle->file_dst_pathname);
            $imgName = $handle->file_dst_name;
        }
    }

    $SLIDER = new Slider($_POST['id']);
    $SLIDER->image_name = $_POST['oldImageName'];
    $SLIDER->title = $_POST['title'];
   $SLIDER->short_description = $_POST['short_description'];
   
    $result = $SLIDER->update();

    if ($result) {
        $result = [
            "status" => 'success'
        ];
        echo json_encode($result);
        exit();
    } else {
        $result = [
            "status" => 'error'
        ];
        echo json_encode($result);
        exit();
    }
}

//Arange slider
if (isset($_POST['arrange'])) {
    foreach ($_POST['sort'] as $key => $img) {
        $key = $key + 1;
        $SLIDER = Slider::arrange($key, $img);
        header('Location:../../../arrange-slider.php?message=9');
    }
}