<?php
require_once __DIR__ . '/_header.php';
?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
  <div class="py-5 bg-hot-noir shadow rounded-lg">
    <div class="px-4 py-5 sm:p-6">
      <div class="flex justify-between items-center">
        <h2 class="text-lg leading-6 font-medium text-white">Browse Products</h2>
        <?php
        $frm_search_url = 'api-search-items.php';
        include_once __DIR__ . '/_form_search.php';
        ?>
      </div>
      <div id="results" class="mt-5 grid grid-cols-1 md:grid-cols-3 gap-4"></div>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/_footer.php'; ?>
<script src="../js/browse.js"></script>