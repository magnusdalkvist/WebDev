<?php
require_once __DIR__ . '/_header.php';

$db = _db();
$q = $db->prepare('SELECT items.*, partners.partner_name FROM items 
                   INNER JOIN users ON items.item_created_by_user_fk = users.user_id 
                   INNER JOIN partners ON users.user_id = partners.user_partner_id 
                   ORDER BY partners.partner_name');
$q->execute();
$items = $q->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="mt-16 pb-20 mr-4 px-4 bg-white rounded-md text-slate-500">
    <?php 
    $currentPartner = '';
    foreach($items as $item) {
        if($item['partner_name'] !== $currentPartner) {
            $currentPartner = $item['partner_name'];
    ?>
            <h2 class="text-2xl font-bold mt-4 mb-2"><?= htmlspecialchars($currentPartner) ?></h2>
    <?php
        }
    ?>
        <div class="flex items-center gap-4 border-b border-b-slate-200 py-2">
            <div class="w-1/4"><?= htmlspecialchars($item['item_name']) ?></div>
        </div>
    <?php
    }
    ?>
</div>

<?php
require_once __DIR__ . '/_footer.php';
?>