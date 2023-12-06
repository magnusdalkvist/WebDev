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
<!-- <div class="flex items-center gap-4 flex-wrap justify-center px-4 py-8">
    <div class="bg-50-shades grid grid-cols-2 h-[200px] aspect-[2/1] rounded-2xl overflow-hidden">
        <div class="bg-mr-grey flex justify-center items-center p-12 rounded-2xl overflow-hidden">
            <svg viewBox="0 0 77 85" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M38.25 81C52.5938 65.6 66.9375 51.8102 66.9375 34.8C66.9375 17.7896 54.0937 4 38.25 4C22.4063 4 9.5625 17.7896 9.5625 34.8C9.5625 51.8102 23.9062 65.6 38.25 81Z" stroke="white" stroke-width="7" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M38.25 42.5C42.7769 42.5 46.4464 38.6697 46.4464 33.9444C46.4464 29.2193 42.7769 25.3889 38.25 25.3889C33.7231 25.3889 30.0536 29.2193 30.0536 33.9444C30.0536 38.6697 33.7231 42.5 38.25 42.5Z" stroke="white" stroke-width="7" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </div>
        <div class="flex flex-col gap-2 items-center justify-center text-center p-4">
            <h2 class="text-xl font-bold">Tell us where you are</h2>
            <p class="text-sm">We'll show you our stores and resturants close to you that you can order from.</p>
        </div>
    </div>
    <div class="bg-50-shades grid grid-cols-2 h-[200px] aspect-[2/1] rounded-2xl overflow-hidden">
        <div class="bg-mr-grey flex justify-center items-center p-12 rounded-2xl overflow-hidden">
            <svg viewBox="0 0 82 77" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M71.4 34.25H70.9402C69.8817 34.2498 68.8335 34.4553 67.8555 34.8549C66.8775 35.2545 65.9888 35.8402 65.2402 36.5788L52.4 49.25L43.8766 40.8387C39.6011 36.6203 33.8029 34.2503 27.757 34.25H10.6M71.4 34.25C73.4156 34.25 75.3487 35.0402 76.774 36.4467C78.1993 37.8532 79 39.7609 79 41.75C79 43.7391 78.1993 45.6468 76.774 47.0533C75.3487 48.4598 73.4156 49.25 71.4 49.25H10.6C8.58435 49.25 6.65126 48.4598 5.22599 47.0533C3.80071 45.6468 3 43.7391 3 41.75C3 39.7609 3.80071 37.8532 5.22599 36.4467C6.65126 35.0402 8.58435 34.25 10.6 34.25M71.4 34.25H10.6M71.4 34.25C73.4976 34.25 75.2304 32.5625 74.9796 30.5C73.0416 14.585 58.5674 8 41 8C23.4326 8 8.9584 14.585 7.0204 30.5C6.7696 32.5625 8.5024 34.25 10.6 34.25M52.4038 19.25H52.4M41.0038 23H41M6.8 49.25H75.2V56.75C75.2 59.7337 73.9989 62.5952 71.861 64.705C69.7231 66.8147 66.8235 68 63.8 68H18.2C15.1765 68 12.2769 66.8147 10.139 64.705C8.00107 62.5952 6.8 59.7337 6.8 56.75V49.25Z" stroke="white" stroke-width="6" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </div>
        <div class="flex flex-col gap-2 items-center justify-center text-center p-4">
            <h2 class="text-xl font-bold">Find what you want</h2>
            <p class="text-sm">Search for items or dishes, businesses or cuisines.</p>
        </div>
    </div>
    <div class="bg-50-shades grid grid-cols-2 h-[200px] aspect-[2/1] rounded-2xl overflow-hidden">
        <div class="bg-mr-grey flex justify-center items-center p-12 rounded-2xl overflow-hidden">
            <svg viewBox="0 0 77 77" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M24.8625 33.6875L22.5675 30.6075C22.0463 31.0014 21.6338 31.5228 21.369 32.1222C21.1042 32.7217 20.996 33.3792 21.0546 34.0326C21.1133 34.6859 21.3368 35.3134 21.704 35.8553C22.0712 36.3973 22.5699 36.8359 23.1527 37.1294L24.8625 33.6875ZM40.1625 41.3875L43.9492 41.9304C44.062 41.1308 43.9221 40.3159 43.5493 39.6008C43.1766 38.8857 42.5899 38.3066 41.8723 37.9456L40.1625 41.3875ZM34.4633 54.3197C34.3901 54.8213 34.416 55.3325 34.5396 55.824C34.6633 56.3155 34.8821 56.7776 35.1836 57.1837C35.4851 57.5898 35.8634 57.932 36.2966 58.1906C36.7299 58.4492 37.2096 58.6192 37.7083 58.6907C38.207 58.7621 38.7148 58.7338 39.2026 58.6072C39.6903 58.4806 40.1484 58.2583 40.5506 57.9531C40.9528 57.6478 41.2911 57.2656 41.5461 56.8284C41.8012 56.3912 41.9679 55.9076 42.0368 55.4054L34.4633 54.3197ZM40.1625 22.1375L42.8668 19.4156C42.2158 18.7603 41.3518 18.3633 40.4335 18.2976C39.5152 18.2318 38.6041 18.5016 37.8675 19.0575L40.1625 22.1375ZM49.725 31.7625L47.0207 34.4845C47.7379 35.2065 48.7106 35.6123 49.725 35.6125V31.7625ZM57.375 35.6125C58.3895 35.6125 59.3624 35.2069 60.0797 34.4849C60.797 33.7628 61.2 32.7836 61.2 31.7625C61.2 30.7414 60.797 29.7622 60.0797 29.0401C59.3624 28.3181 58.3895 27.9125 57.375 27.9125V35.6125ZM22.95 54.8625C22.95 56.9047 22.144 58.8632 20.7094 60.3072C19.2747 61.7513 17.3289 62.5625 15.3 62.5625V70.2625C19.3578 70.2625 23.2494 68.64 26.1187 65.7519C28.988 62.8639 30.6 58.9468 30.6 54.8625H22.95ZM15.3 62.5625C13.2711 62.5625 11.3253 61.7513 9.89063 60.3072C8.45598 58.8632 7.65 56.9047 7.65 54.8625H0C0 58.9468 1.61196 62.8639 4.48127 65.7519C7.35057 68.64 11.2422 70.2625 15.3 70.2625V62.5625ZM7.65 54.8625C7.65 52.8203 8.45598 50.8618 9.89063 49.4178C11.3253 47.9738 13.2711 47.1625 15.3 47.1625V39.4625C11.2422 39.4625 7.35057 41.085 4.48127 43.9731C1.61196 46.8611 0 50.7782 0 54.8625H7.65ZM15.3 47.1625C17.3289 47.1625 19.2747 47.9738 20.7094 49.4178C22.144 50.8618 22.95 52.8203 22.95 54.8625H30.6C30.6 50.7782 28.988 46.8611 26.1187 43.9731C23.2494 41.085 19.3578 39.4625 15.3 39.4625V47.1625ZM23.1527 37.1294L38.4527 44.8294L41.8723 37.9456L26.5723 30.2456L23.1527 37.1294ZM36.3758 40.8447L34.4633 54.3197L42.0368 55.4054L43.9492 41.9304L36.3758 40.8447ZM27.1575 36.7675L42.4575 25.2175L37.8675 19.0575L22.5675 30.6075L27.1575 36.7675ZM37.4582 24.8595L47.0207 34.4845L52.4293 29.0406L42.8668 19.4156L37.4582 24.8595ZM49.725 35.6125H57.375V27.9125H49.725V35.6125ZM68.85 54.8625C68.85 56.9047 68.044 58.8632 66.6094 60.3072C65.1747 61.7513 63.2289 62.5625 61.2 62.5625V70.2625C65.2578 70.2625 69.1494 68.64 72.0187 65.7519C74.888 62.8639 76.5 58.9468 76.5 54.8625H68.85ZM61.2 62.5625C59.1711 62.5625 57.2253 61.7513 55.7906 60.3072C54.356 58.8632 53.55 56.9047 53.55 54.8625H45.9C45.9 58.9468 47.512 62.8639 50.3813 65.7519C53.2506 68.64 57.1422 70.2625 61.2 70.2625V62.5625ZM53.55 54.8625C53.55 52.8203 54.356 50.8618 55.7906 49.4178C57.2253 47.9738 59.1711 47.1625 61.2 47.1625V39.4625C57.1422 39.4625 53.2506 41.085 50.3813 43.9731C47.512 46.8611 45.9 50.7782 45.9 54.8625H53.55ZM61.2 47.1625C63.2289 47.1625 65.1747 47.9738 66.6094 49.4178C68.044 50.8618 68.85 52.8203 68.85 54.8625H76.5C76.5 50.7782 74.888 46.8611 72.0187 43.9731C69.1494 41.085 65.2578 39.4625 61.2 39.4625V47.1625ZM49.725 12.5125V20.2125C51.7539 20.2125 53.6997 19.4013 55.1344 17.9572C56.569 16.5132 57.375 14.5547 57.375 12.5125H49.725ZM49.725 12.5125H42.075C42.075 14.5547 42.881 16.5132 44.3156 17.9572C45.7503 19.4013 47.6961 20.2125 49.725 20.2125V12.5125ZM49.725 12.5125V4.8125C47.6961 4.8125 45.7503 5.62375 44.3156 7.06778C42.881 8.51181 42.075 10.4703 42.075 12.5125H49.725ZM49.725 12.5125H57.375C57.375 10.4703 56.569 8.51181 55.1344 7.06778C53.6997 5.62375 51.7539 4.8125 49.725 4.8125V12.5125Z" fill="white" />
            </svg>
        </div>
        <div class="flex flex-col gap-2 items-center justify-center text-center p-4">
            <h2 class="text-xl font-bold">Order for delivery or pickup</h2>
            <p class="text-sm">We'll keep you updated on the progress of your order.</p>
        </div>
    </div>
</div> -->

<div class="grid sm:grid-cols-[repeat(auto-fit,minmax(300px,1fr))] gap-4 justify-center px-4 py-8">
    <div class="bg-50-shades flex w-full flex-wrap rounded-2xl overflow-hidden">
        <div class="bg-mr-grey flex justify-center items-center p-4 rounded-2xl overflow-hidden min-w-[200px] flex-1">
            <svg class="max-w-[64px]" viewBox="0 0 77 85" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M38.25 81C52.5938 65.6 66.9375 51.8102 66.9375 34.8C66.9375 17.7896 54.0937 4 38.25 4C22.4063 4 9.5625 17.7896 9.5625 34.8C9.5625 51.8102 23.9062 65.6 38.25 81Z" stroke="white" stroke-width="7" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M38.25 42.5C42.7769 42.5 46.4464 38.6697 46.4464 33.9444C46.4464 29.2193 42.7769 25.3889 38.25 25.3889C33.7231 25.3889 30.0536 29.2193 30.0536 33.9444C30.0536 38.6697 33.7231 42.5 38.25 42.5Z" stroke="white" stroke-width="7" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </div>
        <div class="flex flex-col gap-2 items-center justify-center text-center p-4 min-w-[200px] flex-1">
            <h2 class="text-xl font-bold">Tell us where you are</h2>
            <p class="text-sm">We'll show you our stores and resturants close to you that you can order from.</p>
        </div>
    </div>
    <div class="bg-50-shades flex w-full flex-wrap rounded-2xl overflow-hidden">
        <div class="bg-mr-grey flex justify-center items-center p-4 rounded-2xl overflow-hidden min-w-[200px] flex-1">
            <svg class="max-w-[64px]" viewBox="0 0 77 85" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M38.25 81C52.5938 65.6 66.9375 51.8102 66.9375 34.8C66.9375 17.7896 54.0937 4 38.25 4C22.4063 4 9.5625 17.7896 9.5625 34.8C9.5625 51.8102 23.9062 65.6 38.25 81Z" stroke="white" stroke-width="7" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M38.25 42.5C42.7769 42.5 46.4464 38.6697 46.4464 33.9444C46.4464 29.2193 42.7769 25.3889 38.25 25.3889C33.7231 25.3889 30.0536 29.2193 30.0536 33.9444C30.0536 38.6697 33.7231 42.5 38.25 42.5Z" stroke="white" stroke-width="7" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </div>
        <div class="flex flex-col gap-2 items-center justify-center text-center p-4 min-w-[200px] flex-1">
            <h2 class="text-xl font-bold">Tell us where you are</h2>
            <p class="text-sm">We'll show you our stores and resturants close to you that you can order from.</p>
        </div>
    </div>
    <div class="bg-50-shades flex w-full flex-wrap rounded-2xl overflow-hidden">
        <div class="bg-mr-grey flex justify-center items-center p-4 rounded-2xl overflow-hidden min-w-[200px] flex-1">
            <svg class="max-w-[64px]" viewBox="0 0 77 85" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M38.25 81C52.5938 65.6 66.9375 51.8102 66.9375 34.8C66.9375 17.7896 54.0937 4 38.25 4C22.4063 4 9.5625 17.7896 9.5625 34.8C9.5625 51.8102 23.9062 65.6 38.25 81Z" stroke="white" stroke-width="7" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M38.25 42.5C42.7769 42.5 46.4464 38.6697 46.4464 33.9444C46.4464 29.2193 42.7769 25.3889 38.25 25.3889C33.7231 25.3889 30.0536 29.2193 30.0536 33.9444C30.0536 38.6697 33.7231 42.5 38.25 42.5Z" stroke="white" stroke-width="7" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </div>
        <div class="flex flex-col gap-2 items-center justify-center text-center p-4 min-w-[200px] flex-1">
            <h2 class="text-xl font-bold">Tell us where you are</h2>
            <p class="text-sm">We'll show you our stores and resturants close to you that you can order from.</p>
        </div>
    </div>
</div>
<?php
require_once __DIR__ . '/_footer.php';
?>