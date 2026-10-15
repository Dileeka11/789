<?php
/**
 * Year / Batch selector for paper management pages.
 * Expects: $ALL_PAPERS (array of paper rows with `year` and `batch`)
 * Sets:    $FILTERED_PAPERS, $selected_year, $selected_batch
 */

$selected_year  = isset($_GET['year']) ? trim($_GET['year']) : '';
$selected_batch = isset($_GET['batch']) ? trim($_GET['batch']) : '';

$BATCH_NAMES = (new DefaultData())->CourseBatch();

// Group counts by year and batch
$year_counts  = array();
$batch_counts = array();
foreach ($ALL_PAPERS as $paper) {
    $y = (string) $paper['year'];
    $b = (string) $paper['batch'];
    $year_counts[$y] = ($year_counts[$y] ?? 0) + 1;
    if ($y === $selected_year) {
        $batch_counts[$b] = ($batch_counts[$b] ?? 0) + 1;
    }
}
krsort($year_counts);
ksort($batch_counts);

$FILTERED_PAPERS = array();
if ($selected_year !== '') {
    foreach ($ALL_PAPERS as $paper) {
        if ((string) $paper['year'] !== $selected_year) continue;
        if ($selected_batch !== '' && (string) $paper['batch'] !== $selected_batch) continue;
        $FILTERED_PAPERS[] = $paper;
    }
}

$base_params = array();
if (!empty($_GET['id'])) {
    $base_params['id'] = $_GET['id'];
}
function paper_filter_url($params)
{
    return '?' . http_build_query($params);
}
?>
<style>
    .yb-grid { display: flex; flex-wrap: wrap; gap: 12px; margin-bottom: 20px; }
    .yb-btn {
        min-width: 140px; padding: 16px 20px; text-align: center; border-radius: 6px;
        border: 1px solid #dcdfe6; background: #f5f6f8; color: #343a40;
        font-size: 18px; font-weight: 600; text-decoration: none; transition: all .15s;
    }
    .yb-btn small { display: block; font-size: 12px; font-weight: 400; color: #74788d; }
    .yb-btn:hover { background: #e9ecf3; color: #343a40; box-shadow: 0 2px 6px rgba(0,0,0,.08); }
    .yb-btn.active { background: #5b73e8; border-color: #5b73e8; color: #fff; }
    .yb-btn.active small { color: #e6e9fb; }
    .yb-batch .yb-btn { min-width: 120px; padding: 10px 16px; font-size: 15px; }
</style>

<h5 class="font-size-15 mb-3">Select Year</h5>
<?php if (empty($year_counts)) { ?>
    <p class="text-muted">No papers found.</p>
<?php } else { ?>
    <div class="yb-grid">
        <?php foreach ($year_counts as $y => $count) { ?>
            <a class="yb-btn <?= $selected_year === (string) $y ? 'active' : '' ?>"
                href="<?= paper_filter_url($base_params + array('year' => $y)) ?>">
                <?= htmlspecialchars($y) ?>
                <small><?= $count ?> paper<?= $count == 1 ? '' : 's' ?></small>
            </a>
        <?php } ?>
    </div>
<?php } ?>

<?php if ($selected_year !== '') { ?>
    <h5 class="font-size-15 mb-3">Select Batch &mdash; <?= htmlspecialchars($selected_year) ?></h5>
    <div class="yb-grid yb-batch">
        <a class="yb-btn <?= $selected_batch === '' ? 'active' : '' ?>"
            href="<?= paper_filter_url($base_params + array('year' => $selected_year)) ?>">
            All Batches
            <small><?= array_sum($batch_counts) ?> papers</small>
        </a>
        <?php foreach ($batch_counts as $b => $count) { ?>
            <a class="yb-btn <?= $selected_batch === (string) $b ? 'active' : '' ?>"
                href="<?= paper_filter_url($base_params + array('year' => $selected_year, 'batch' => $b)) ?>">
                <?= htmlspecialchars($BATCH_NAMES[$b] ?? ('Batch ' . $b)) ?>
                <small><?= $count ?> paper<?= $count == 1 ? '' : 's' ?></small>
            </a>
        <?php } ?>
    </div>
<?php } ?>
