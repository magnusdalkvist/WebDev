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

<div class="h-[500px] relative rounded-b-2xl overflow-hidden -mt-16">
    <img src="/assets/ivan-torres-MQUqbmszGGM-unsplash.jpg" alt="pizza" class="object-cover w-full h-full">
    <div class="absolute inset-0 p-4 bg-transparent-50 grid grid-rows-3 grid-cols-1 justify-between w-full">
        <div class="row-start-2 flex flex-col gap-2 justify-center items-center">
            <form method="post" action="/browse" class="flex items-center gap-4 bg-soft-white px-4 py-3 rounded-2xl text-mr-grey w-full max-w-[390px]">
                <label for="deilivery_address">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.6254 11.6185L17 17M13.4444 7.22222C13.4444 10.6587 10.6587 13.4444 7.22222 13.4444C3.78579 13.4444 1 10.6587 1 7.22222C1 3.78579 3.78579 1 7.22222 1C10.6587 1 13.4444 3.78579 13.4444 7.22222Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </label>
                <input type="text" name="deilivery_address" id="deilivery_address" placeholder="Enter delivery address" class="bg-transparent placeholder:text-transparent-50 focus:outline-none">
            </form>
            <a href=" /browse" class="underline">Use current location</a>
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