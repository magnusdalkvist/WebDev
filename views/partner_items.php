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
          <label class="flex items-center gap-4 bg-soft-white px-4 py-3 rounded-2xl text-mr-grey" for="item_name">
            <input class="pl-2 bg-transparent placeholder:text-transparent-50 focus:outline-none w-full" type="text" name="item_name" placeholder="Item Name" required data-validate="str" data-min="2" data-max="60">
          </label>
          <label class="flex items-center gap-4 bg-soft-white px-4 py-3 rounded-2xl text-mr-grey" for="item_price">
            <input class="pl-2 bg-transparent placeholder:text-transparent-50 focus:outline-none w-full" type="number" name="item_price" placeholder="Item Price" required data-validate="str" data-min="1" data-max="10">
          </label>
          <button class="w-full px-4 py-3 bg-sexyred text-white font-bold rounded-2xl">Add Item</button>
        </form>
      </div>

      <div class="flex flex-col py-8 px-8 bg-50-shades rounded-md text-soft-white">
        <div class="font-bold">
          <h2>Update a product</h2>
        </div>
        <form onsubmit="validate(update_item); return false" class="flex flex-col gap-6 w-full h-full pt-4">
          <label class="flex items-center gap-4 bg-soft-white px-4 py-3 rounded-2xl text-mr-grey" for="item_id">
            <input class="pl-2 bg-transparent placeholder:text-transparent-50 focus:outline-none w-full" type="text" name="item_id" placeholder="Item ID" required data-validate="str" data-min="1" data-max="60">
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

      <div class="pt-8 flex flex-col gap-4">
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
            <form onsubmit=" if(confirm('You are about to permanently deleted this product from our system. Do you want to continue?')) {delete_item() ;} return false;">
              <input type="text" name="item_id" class="hidden" value="<?= $item['item_id'] ?>">
              <input class="text-right hover:cursor-pointer " type="submit" value="DELETE ITEM">
            </form>
          </div>

        <?php endforeach ?>

      </div>
  </section>
</div>

<?php require_once __DIR__ . '/_footer.php'  ?>