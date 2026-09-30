<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DefaultData
 *
 * @author User™
 */
class DefaultData {

    //get userlevel
    public function ExamDuration() {
        return array(
            "1800" => "30 Min",
            "3600" => "1 hr",
            "5400" => "1.5 hrs",
            "7200" => "2 hrs",
            "9000" => "2.5 hrs",
            "10800" => "3 hrs",
            "12600" => "3.5 hrs",
            "14400" => "3.5 hrs",
        );
    }

    //document status
    public function DoumentStatus() {
        return array(
            "1" => "Not Completed",
            "2" => "Pending",
            "3" => "Recommend",
            "4" => "Not Recommend",
            "5" => "Approved",
            "6" => "Reject",
        );
    }
    
    //course Level
    public function CourseLevel() {
        return array(
            "0" => "Level 0",
            "3" => "Level 3",
            "4" => "Level 4", 
            "5" => "Level 5",
            "6" => "Level 6",
        );
    }
    
    //course Level
    public function CourseType() {
        return array(
            "1" => "Full Time",
            "2" => "Part Time", 
            "3" => "Short Time",
            "4" => "Work Shop",
        );
    
    }
    
    
    //course Level
    public function CourseDuration() {
        return array(
            "7" => "1 Week",
            "14" => "2 Weeks",
            "3" => "3 Months",
            "4" => "4 Months", 
            "6" => "6 Months",
            "8" => "8 Months",
            "12" => "12 Months",
            "24" => "24 Months",
        );
    
    }
    
    
    //course Level
    public function nvqLevel() {
        return array(
            "1" => "NVQ",
            "2" => "NON NVQ",  
        );
    
    }
    
    
    //education Level
    public function Education() {
        return array(
            "1" => "Up to O/L",
            "2" => "Up to A/L",  
            "3" => "Diploma",  
            "4" => "Degrey",  
        );
    
    }
    
      //course batch
    public function CourseBatch() {
        return array(
            "1" => "Batch 01",
            "2" => "Batch 02",  
            "3" => "Batch 03",  
            "4" => "Batch 04",  
        );
    
    }
    
    //course Year
    public function CourseYear() {
        return array(
            "2019" => "2019", 
            "2020" => "2020", 
            "2021" => "2021", 
            "2022" => "2022", 
            "2023" => "2023", 
            "2024" => "2024", 
            "2025" => "2025", 
            "2026" => "2026", 
            "2027" => "2027", 
        );
    
    }
    
    
 //exam category 
    public function ExamCategory() {
        return array(
            "non-nvq" => "Non Nvq",
            "short_time" => "Short Time",  
            "language" => "Language",  
            "agriculture" => "Agriculture",  
        );
    
    }
    
        public function FundType() {
        return array(
            "1" => "Tasher Fund",
            "2" => "Internal Fund" 
        );
    
    }
    

}
