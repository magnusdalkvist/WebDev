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

<div class="h-[500px] relative rounded-b-2xl overflow-hidden">
    <img src="/assets/ivan-torres-MQUqbmszGGM-unsplash.jpg" alt="pizza" class="object-cover w-full h-full">
    <div class="absolute inset-0 p-4 bg-transparent-50 grid grid-rows-3 grid-cols-1 justify-between w-full">
        <div class="row-start-2 flex flex-col justify-center items-center">
            <input type="text" class="flex justify-between items-center bg- p-4 rounded-2xl">
            <div class="flex items-center gap-4">
                <svg width="16" height="18" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.33325 17V16.0588C1.33325 13.4599 3.44015 11.3529 6.03913 11.3529H9.80384C12.4028 11.3529 14.5097 13.4599 14.5097 16.0588V17M11.6862 4.76471C11.6862 6.8439 10.0006 8.52941 7.92149 8.52941C5.8423 8.52941 4.15678 6.8439 4.15678 4.76471C4.15678 2.68552 5.8423 1 7.92149 1C10.0006 1 11.6862 2.68552 11.6862 4.76471Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>

            </div>
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5 1L12 8L5 15" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </div>
        <div class="row-start-3 flex flex-col justify-end">
            <p>Delight in every bite!</p>
            <h1 class="font-semibold text-3xl italic">YumHub</h1>
        </div>
    </div>
</div>

<?php
require_once __DIR__ . '/_footer.php';
?>