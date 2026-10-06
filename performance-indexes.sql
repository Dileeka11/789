-- =====================================================================
--  NYSC Exam System - Performance Indexes
--  Purpose : Speed up read queries during high-concurrency exams
--            (800+ students logging in / answering at once).
--
--  SAFE TO RUN: These statements ONLY add lookup indexes.
--               No data is changed, deleted, or moved.
--               Every index can be removed later (see bottom) with
--               NO effect on your data.
--
--  BEFORE RUNNING:
--    1. Take a full DB backup (phpMyAdmin -> Export).  [best practice]
--    2. Run when NO exam is in progress (students offline / night time).
--       Adding an index briefly locks the table while it builds.
--    3. Run the whole script once in phpMyAdmin -> SQL tab.
--
--  NOTE: If a statement says "Duplicate key name ..." it just means that
--        index already exists. That is harmless - ignore it and continue.
-- =====================================================================


-- ---------------------------------------------------------------------
-- 1. exam_student_questions  (the HOTTEST table during an exam)
--    Queried constantly by (student_id, exam_id) and by sort order.
-- ---------------------------------------------------------------------
ALTER TABLE `exam_student_questions`
    ADD INDEX `idx_esq_student_exam` (`student_id`, `exam_id`);

ALTER TABLE `exam_student_questions`
    ADD INDEX `idx_esq_student_exam_sort` (`student_id`, `exam_id`, `sort`);


-- ---------------------------------------------------------------------
-- 2. exam_students  (attempt / marks lookups per student & per exam)
-- ---------------------------------------------------------------------
ALTER TABLE `exam_students`
    ADD INDEX `idx_es_student_exam` (`student_id`, `exam_id`);

ALTER TABLE `exam_students`
    ADD INDEX `idx_es_exam` (`exam_id`);


-- ---------------------------------------------------------------------
-- 3. schedule_exam  (find the student's current/upcoming exam)
-- ---------------------------------------------------------------------
ALTER TABLE `schedule_exam`
    ADD INDEX `idx_se_course` (`course_id`);

ALTER TABLE `schedule_exam`
    ADD INDEX `idx_se_year_batch` (`year`, `batch`);


-- ---------------------------------------------------------------------
-- 4. questions  (random question selection is filtered by course)
-- ---------------------------------------------------------------------
ALTER TABLE `questions`
    ADD INDEX `idx_q_course` (`course`);


-- ---------------------------------------------------------------------
-- 5. exam_paper_questions  (building the paper for each student)
-- ---------------------------------------------------------------------
ALTER TABLE `exam_paper_questions`
    ADD INDEX `idx_epq_paper` (`exam_paper_id`);


-- ---------------------------------------------------------------------
-- 6. student  (reports filter heavily by center / year / batch)
--    NOTE: login & authenticate use the PRIMARY KEY (id) which is
--          already indexed, so no index is needed for login itself.
-- ---------------------------------------------------------------------
ALTER TABLE `student`
    ADD INDEX `idx_student_center_year_batch` (`centercode`, `year`, `batch`);

ALTER TABLE `student`
    ADD INDEX `idx_student_course` (`course_id`);


-- =====================================================================
--  VERIFY (optional) - see the indexes you just created:
--    SHOW INDEX FROM `exam_student_questions`;
--    SHOW INDEX FROM `exam_students`;
--    SHOW INDEX FROM `schedule_exam`;
-- =====================================================================


-- =====================================================================
--  ROLLBACK (only if ever needed) - removing an index does NOT touch
--  your data. Uncomment and run any of these to undo:
--
--  ALTER TABLE `exam_student_questions` DROP INDEX `idx_esq_student_exam`;
--  ALTER TABLE `exam_student_questions` DROP INDEX `idx_esq_student_exam_sort`;
--  ALTER TABLE `exam_students`          DROP INDEX `idx_es_student_exam`;
--  ALTER TABLE `exam_students`          DROP INDEX `idx_es_exam`;
--  ALTER TABLE `schedule_exam`          DROP INDEX `idx_se_course`;
--  ALTER TABLE `schedule_exam`          DROP INDEX `idx_se_year_batch`;
--  ALTER TABLE `questions`              DROP INDEX `idx_q_course`;
--  ALTER TABLE `exam_paper_questions`   DROP INDEX `idx_epq_paper`;
--  ALTER TABLE `student`                DROP INDEX `idx_student_center_year_batch`;
--  ALTER TABLE `student`                DROP INDEX `idx_student_course`;
-- =====================================================================
