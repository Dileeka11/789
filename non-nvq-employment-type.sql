-- Non NVQ instructor: employment type (Permanent / Contract / Allowances)
ALTER TABLE `non_nvq_course_instructor`
    ADD COLUMN `employment_type` VARCHAR(20) NULL DEFAULT NULL AFTER `instructor_name`;
