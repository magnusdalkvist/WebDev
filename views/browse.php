<?php
require_once __DIR__ . '/_header.php';

$frm_search_url = 'api-search-items.php';
include_once __DIR__ . '/_form_search.php';
?>

<div id="results" class="container mx-auto py-8"></div>

<?php require_once __DIR__ . '/_footer.php'; ?>
<script src="../js/browse.js"></script>