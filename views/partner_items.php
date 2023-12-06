<?php
require_once __DIR__ . '/../_.php';
require_once __DIR__ . '/_header.php';

$db = _db();
$q = $db->prepare('
        SELECT * FROM `items`
        WHERE `item_created_by_user_fk` = :user_id
        AND `item_deleted_at` = 0');
$q->bindValue(':user_id', $_SESSION['user_id']);
$q->execute();
$items = $q->fetchAll();

?>
<div class=" mt-20 grid grid-cols-2 gap-8 mx-auto ">
  <div class="flex flex-col gap-5 ">
    <div class="flex flex-col gap-4  top-10  sticky">
      <div class="flex flex-col py-8 px-8 bg-50-shades rounded-md text-soft-white">
        <div class="font-bold">
          <h2>Add a new product</h2>
        </div>
        <form onsubmit="validate(add_item); return false" class="flex flex-col gap-6 w-full h-full pt-4">
          <label class="flex items-center gap-4 bg-soft-white px-4 py-3 rounded-2xl text-mr-grey" for="add_item_name">
            <input class="pl-2 bg-transparent placeholder:text-transparent-50 focus:outline-none w-full" type="text" name="add_item_name" placeholder="Item Name" required data-validate="str" data-min="2" data-max="60">
          </label>
          <label class="flex items-center gap-4 bg-soft-white px-4 py-3 rounded-2xl text-mr-grey" for="add_item_price">
            <input class="pl-2 bg-transparent placeholder:text-transparent-50 focus:outline-none w-full" type="number" name="add_item_price" placeholder="Item Price" required data-validate="str" data-min="1" data-max="10">
          </label>
          <button class="w-full px-4 py-3 bg-sexyred text-white font-bold rounded-2xl">Add Item</button>
        </form>
      </div>

      <div class="flex flex-col py-8 px-8 bg-50-shades rounded-md text-soft-white">
        <div class="font-bold">
          <h2>Update a product</h2>
        </div>
        <form onsubmit="validate(update_item); return false" class="flex flex-col gap-6 w-full h-full pt-4">
          <label class="f" for="item_id">
            <input class="hidden" type="text" name="item_id" value="" required data-validate="str" data-min="1" data-max="60">
          </label>
          <label class="flex items-center gap-4 bg-soft-white px-4 py-3 rounded-2xl text-mr-grey" for="item_name">
            <input class="pl-2 bg-transparent placeholder:text-transparent-50 focus:outline-none w-full" type="text" name="item_name" placeholder="Item Name" required data-validate="str" data-min="2" data-max="60">
          </label>
          <label class="flex items-center gap-4 bg-soft-white px-4 py-3 rounded-2xl text-mr-grey" for="item_price">
            <input class="pl-2 bg-transparent placeholder:text-transparent-50 focus:outline-none w-full" type="number" name="item_price" placeholder="Item Price" required data-validate="str" data-min="1" data-max="10">
          </label>
          <button class="w-full px-4 py-3 bg-sexyred text-white font-bold rounded-2xl">Update Item</button>
        </form>
      </div>
    </div>
  </div>
  <section>
    <?php if (!$items) : ?>
      <h2>No items in the system</h2>
    <?php endif ?>
    <div class="flex flex-col py-8 px-8 bg-50-shades rounded-md text-soft-white">
      <div class="font-bold">
        <h2>Items</h2>
      </div>

      <div class="pt-1 flex flex-col gap-4">
        <div class="grid grid-cols-[1fr_2fr_1fr_1fr]  items-center gap-4 border-b border-b-slate-200">
          <p class="text-lg">ID:</p>
          <p class="text-lg">Name:</p>
          <p class="text-lg">Price:</p>
          <p class="text-lg">Delete:</p>
        </div>
        <?php foreach ($items as $item) : ?>
          <div class="grid grid-cols-[1fr_2fr_1fr_1fr]  items-center gap-4 border-b border-b-slate-200">
            <p class="text-lg"><?= $item['item_id'] ?></p>
            <p class="text-lg"><?= $item['item_name'] ?></p>
            <p class="text-lg"><?= $item['item_price'] ?></p>
            <div id="actions" class="flex align-center justify-end">
              <form onsubmit=" if(confirm('You are about to permanently deleted this product from our system. Do you want to continue?')) {delete_item() ;} return false;">
                <input type="text" name="item_id" class="hidden" value="<?= $item['item_id'] ?>">
                <button class="float-right hover:cursor-pointer " type="submit" value="">
                  <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" fill="#D0D0D0" width="30" height="30" viewBox="0 0 24 24">
                    <path d="M 10.806641 2 C 10.289641 2 9.7956875 2.2043125 9.4296875 2.5703125 L 9 3 L 4 3 A 1.0001 1.0001 0 1 0 4 5 L 20 5 A 1.0001 1.0001 0 1 0 20 3 L 15 3 L 14.570312 2.5703125 C 14.205312 2.2043125 13.710359 2 13.193359 2 L 10.806641 2 z M 4.3652344 7 L 5.8925781 20.263672 C 6.0245781 21.253672 6.877 22 7.875 22 L 16.123047 22 C 17.121047 22 17.974422 21.254859 18.107422 20.255859 L 19.634766 7 L 4.3652344 7 z"></path>
                  </svg></button>
              </form>
              <form onsubmit="load_item(event); return false;">
                <input type="text" name="item_id" class="hidden" value="<?= $item['item_id'] ?>">
                <button class="float-right hover:cursor-pointer fill-soft-white" type="submit" value="">
                  <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" fill="#D0D0D0" width="30" height="30" viewBox="0 0 72 72">
                    <path d="M38.406 22.234l11.36 11.36L28.784 54.576l-12.876 4.307c-1.725.577-3.367-1.065-2.791-2.79l4.307-12.876L38.406 22.234zM41.234 19.406l5.234-5.234c1.562-1.562 4.095-1.562 5.657 0l5.703 5.703c1.562 1.562 1.562 4.095 0 5.657l-5.234 5.234L41.234 19.406z"></path>
                  </svg></button>
              </form>
            </div>
          </div>

        <?php endforeach ?>

      </div>
  </section>
</div>
<script src="../js/item.js"></script>
<?php require_once __DIR__ . '/_footer.php'  ?>