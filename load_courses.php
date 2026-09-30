<?php
include './class/include.php';

$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;
$limit = 10;

$COURSE = new Courses(NULL);
$courses = $COURSE->getLimited($offset, $limit);
?>

<!-- Add this CSS to ensure equal height cards -->
<style>
    .course-row {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .course-card {
        display: flex;
        flex-direction: column;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 10px;
        overflow: hidden;
        flex: 1 1 calc(50% - 20px);
        max-width: calc(50% - 20px);
    }

    .course-card .thumb img {
       
        object-fit: cover;
        width: 100%;
    }

    .course-card .info {
        flex-grow: 1;
        padding: 20px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

     

    .course-card .meta {
        margin: 10px 0;
    }

    .course-card .nvq-label {
        font-size: 12px;
        color: #fff;
        background-color: #007bff;
        display: inline-block;
        padding: 2px 6px;
        border-radius: 5px;
        margin-left: 5px;
    }

    .course-card .btn {
        margin-top: 10px;
        width: fit-content;
    }

    @media (max-width: 767px) {
        .course-card {
            flex: 1 1 100%;
            max-width: 100%;
        }
    }
</style>

<div class="course-row">
    
    <?php foreach ($courses as $course): ?>
        <?php
        $encodedLink = base64_encode('q=fromcourse%center=false%course=' . $course['id']);
        
        $eventDay = date("d", strtotime($course['start_date']));
        $eventMonth = date("M", strtotime($course['start_date']));
        ?>
        <div class="course-card">
            <div class="thumb">
                <a href="https://www.nysc.lk/courses/view/<?php echo $encodedLink; ?>">
                    <img src="https://www.nysc.lk/upload/courses/<?php echo $course['image_name']; ?>" alt="<?php echo htmlspecialchars($course['name']); ?>">
                </a>
                <div class="date" style="position:absolute; top:10px; left:10px; background:#000; color:#fff; padding:5px 10px; border-radius:5px;">
                    <h4 style="margin:0;"><span><?php echo $eventDay; ?></span> <?php echo $eventMonth; ?></h4>
                </div>
            </div>
            <div class="info">
                <h4>
                    <a href="https://www.nysc.lk/courses/view/<?php echo $encodedLink; ?>">
                        <?php echo htmlspecialchars($course['name']); ?>
                    </a>
                </h4>
                <!--<div class="meta">-->
                <!--    <ul style="list-style:none; padding:0;">-->
                <!--        <li>-->
                <!--            <i class="fas fa-clock"></i>-->
                <!--            <?php echo $course["nvq"] ? "NVQ" : "NON NVQ"; ?>-->
                <!--            <?php if ($course["nvq"]): ?>-->
                <!--                <span class="nvq-label">NVQ</span>-->
                <!--            <?php endif; ?>-->
                <!--        </li>-->
                <!--        <li>-->
                <!--            <i class="fas fa-map"></i>-->
                <!--            <?php echo htmlspecialchars($course['location']); ?>-->
                <!--        </li>-->
                <!--    </ul>-->
                <!--</div>-->
                <p>
                    <?php echo substr(strip_tags($course['description']), 0, 120); ?>...
                </p>
                <a href="https://www.nysc.lk/courses/view/<?php echo $encodedLink; ?>" class="btn btn-dark btn-sm">
                    <i class="fas fa-chart-bar"></i> View More
                </a>
                
            </div>
        </div>
    <?php endforeach; ?>
</div>
