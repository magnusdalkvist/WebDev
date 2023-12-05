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


<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-8 mt-16">Partners</h1>
    <div class="grid grid-cols-3 gap-4">
        <?php 
        $currentPartner = '';
        foreach($items as $item) {
            if($item['partner_name'] !== $currentPartner) {
                if($currentPartner !== '') {
                   
                    echo '</div></div>';
                }
                $currentPartner = $item['partner_name'];
 
                echo "<div class='flex flex-col bg-white rounded-lg border border-gray-200 shadow-md overflow-hidden mb-5'>";
                echo "<div class='p-5 flex-grow'>";
                echo "<h5 class='text-2xl font-bold tracking-tight text-gray-900'>" . $currentPartner . "</h5>";
            }
            
            echo "<div class='mt-4 flex justify-between'>";
            echo "<p class='font-normal text-gray-700'>" . $item['item_name'] . "</p>";
            echo "<p class='font-normal text-gray-700'>" . $item['item_price'] . " $</p>";
            echo "</div>";
        }
        
        if($currentPartner !== '') {
            echo '</div></div>';
        }
        ?>
    </div>
</div>