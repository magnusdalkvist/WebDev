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
            <a href="/browse" class="underline">Use current location</a>
        </div>
        <div class="row-start-3 flex flex-col justify-end">
            <p>Delight in every bite!</p>
            <h1 class="font-semibold text-3xl italic">YumHub</h1>
        </div>
    </div>
</div>

<div class="container mx-auto grid sm:grid-cols-[repeat(auto-fit,minmax(300px,1fr))] gap-4 justify-center px-4 py-8">
    <div class="bg-50-shades flex w-full flex-wrap rounded-2xl overflow-hidden">
        <div class="bg-mr-grey flex justify-center items-center p-4 rounded-2xl overflow-hidden min-w-[200px] flex-1">
            <svg class="max-w-[64px] max-h-[64px]" viewBox="0 0 77 85" fill="none" xmlns="http://www.w3.org/2000/svg">
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
            <svg class="max-w-[64px] max-h-[64px]" viewBox="0 0 82 77" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M71.4 34.25H70.9402C69.8817 34.2498 68.8335 34.4553 67.8555 34.8549C66.8775 35.2545 65.9888 35.8402 65.2402 36.5788L52.4 49.25L43.8766 40.8387C39.6011 36.6203 33.8029 34.2503 27.757 34.25H10.6M71.4 34.25C73.4156 34.25 75.3487 35.0402 76.774 36.4467C78.1993 37.8532 79 39.7609 79 41.75C79 43.7391 78.1993 45.6468 76.774 47.0533C75.3487 48.4598 73.4156 49.25 71.4 49.25H10.6C8.58435 49.25 6.65126 48.4598 5.22599 47.0533C3.80071 45.6468 3 43.7391 3 41.75C3 39.7609 3.80071 37.8532 5.22599 36.4467C6.65126 35.0402 8.58435 34.25 10.6 34.25M71.4 34.25H10.6M71.4 34.25C73.4976 34.25 75.2304 32.5625 74.9796 30.5C73.0416 14.585 58.5674 8 41 8C23.4326 8 8.9584 14.585 7.0204 30.5C6.7696 32.5625 8.5024 34.25 10.6 34.25M52.4038 19.25H52.4M41.0038 23H41M6.8 49.25H75.2V56.75C75.2 59.7337 73.9989 62.5952 71.861 64.705C69.7231 66.8147 66.8235 68 63.8 68H18.2C15.1765 68 12.2769 66.8147 10.139 64.705C8.00107 62.5952 6.8 59.7337 6.8 56.75V49.25Z" stroke="white" stroke-width="6" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </div>
        <div class="flex flex-col gap-2 items-center justify-center text-center p-4 min-w-[200px] flex-1">
            <h2 class="text-xl font-bold">Find what you want</h2>
            <p class="text-sm">Search for items or dishes, businesses or cuisines.</p>
        </div>
    </div>
    <div class="bg-50-shades flex w-full flex-wrap rounded-2xl overflow-hidden">
        <div class="bg-mr-grey flex justify-center items-center p-4 rounded-2xl overflow-hidden min-w-[200px] flex-1">
            <svg class="max-w-[64px] max-h-[64px]" viewBox="0 0 77 77" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M24.8625 33.6875L22.5675 30.6075C22.0463 31.0014 21.6338 31.5228 21.369 32.1222C21.1042 32.7217 20.996 33.3792 21.0546 34.0326C21.1133 34.6859 21.3368 35.3134 21.704 35.8553C22.0712 36.3973 22.5699 36.8359 23.1527 37.1294L24.8625 33.6875ZM40.1625 41.3875L43.9492 41.9304C44.062 41.1308 43.9221 40.3159 43.5493 39.6008C43.1766 38.8857 42.5899 38.3066 41.8723 37.9456L40.1625 41.3875ZM34.4633 54.3197C34.3901 54.8213 34.416 55.3325 34.5396 55.824C34.6633 56.3155 34.8821 56.7776 35.1836 57.1837C35.4851 57.5898 35.8634 57.932 36.2966 58.1906C36.7299 58.4492 37.2096 58.6192 37.7083 58.6907C38.207 58.7621 38.7148 58.7338 39.2026 58.6072C39.6903 58.4806 40.1484 58.2583 40.5506 57.9531C40.9528 57.6478 41.2911 57.2656 41.5461 56.8284C41.8012 56.3912 41.9679 55.9076 42.0368 55.4054L34.4633 54.3197ZM40.1625 22.1375L42.8668 19.4156C42.2158 18.7603 41.3518 18.3633 40.4335 18.2976C39.5152 18.2318 38.6041 18.5016 37.8675 19.0575L40.1625 22.1375ZM49.725 31.7625L47.0207 34.4845C47.7379 35.2065 48.7106 35.6123 49.725 35.6125V31.7625ZM57.375 35.6125C58.3895 35.6125 59.3624 35.2069 60.0797 34.4849C60.797 33.7628 61.2 32.7836 61.2 31.7625C61.2 30.7414 60.797 29.7622 60.0797 29.0401C59.3624 28.3181 58.3895 27.9125 57.375 27.9125V35.6125ZM22.95 54.8625C22.95 56.9047 22.144 58.8632 20.7094 60.3072C19.2747 61.7513 17.3289 62.5625 15.3 62.5625V70.2625C19.3578 70.2625 23.2494 68.64 26.1187 65.7519C28.988 62.8639 30.6 58.9468 30.6 54.8625H22.95ZM15.3 62.5625C13.2711 62.5625 11.3253 61.7513 9.89063 60.3072C8.45598 58.8632 7.65 56.9047 7.65 54.8625H0C0 58.9468 1.61196 62.8639 4.48127 65.7519C7.35057 68.64 11.2422 70.2625 15.3 70.2625V62.5625ZM7.65 54.8625C7.65 52.8203 8.45598 50.8618 9.89063 49.4178C11.3253 47.9738 13.2711 47.1625 15.3 47.1625V39.4625C11.2422 39.4625 7.35057 41.085 4.48127 43.9731C1.61196 46.8611 0 50.7782 0 54.8625H7.65ZM15.3 47.1625C17.3289 47.1625 19.2747 47.9738 20.7094 49.4178C22.144 50.8618 22.95 52.8203 22.95 54.8625H30.6C30.6 50.7782 28.988 46.8611 26.1187 43.9731C23.2494 41.085 19.3578 39.4625 15.3 39.4625V47.1625ZM23.1527 37.1294L38.4527 44.8294L41.8723 37.9456L26.5723 30.2456L23.1527 37.1294ZM36.3758 40.8447L34.4633 54.3197L42.0368 55.4054L43.9492 41.9304L36.3758 40.8447ZM27.1575 36.7675L42.4575 25.2175L37.8675 19.0575L22.5675 30.6075L27.1575 36.7675ZM37.4582 24.8595L47.0207 34.4845L52.4293 29.0406L42.8668 19.4156L37.4582 24.8595ZM49.725 35.6125H57.375V27.9125H49.725V35.6125ZM68.85 54.8625C68.85 56.9047 68.044 58.8632 66.6094 60.3072C65.1747 61.7513 63.2289 62.5625 61.2 62.5625V70.2625C65.2578 70.2625 69.1494 68.64 72.0187 65.7519C74.888 62.8639 76.5 58.9468 76.5 54.8625H68.85ZM61.2 62.5625C59.1711 62.5625 57.2253 61.7513 55.7906 60.3072C54.356 58.8632 53.55 56.9047 53.55 54.8625H45.9C45.9 58.9468 47.512 62.8639 50.3813 65.7519C53.2506 68.64 57.1422 70.2625 61.2 70.2625V62.5625ZM53.55 54.8625C53.55 52.8203 54.356 50.8618 55.7906 49.4178C57.2253 47.9738 59.1711 47.1625 61.2 47.1625V39.4625C57.1422 39.4625 53.2506 41.085 50.3813 43.9731C47.512 46.8611 45.9 50.7782 45.9 54.8625H53.55ZM61.2 47.1625C63.2289 47.1625 65.1747 47.9738 66.6094 49.4178C68.044 50.8618 68.85 52.8203 68.85 54.8625H76.5C76.5 50.7782 74.888 46.8611 72.0187 43.9731C69.1494 41.085 65.2578 39.4625 61.2 39.4625V47.1625ZM49.725 12.5125V20.2125C51.7539 20.2125 53.6997 19.4013 55.1344 17.9572C56.569 16.5132 57.375 14.5547 57.375 12.5125H49.725ZM49.725 12.5125H42.075C42.075 14.5547 42.881 16.5132 44.3156 17.9572C45.7503 19.4013 47.6961 20.2125 49.725 20.2125V12.5125ZM49.725 12.5125V4.8125C47.6961 4.8125 45.7503 5.62375 44.3156 7.06778C42.881 8.51181 42.075 10.4703 42.075 12.5125H49.725ZM49.725 12.5125H57.375C57.375 10.4703 56.569 8.51181 55.1344 7.06778C53.6997 5.62375 51.7539 4.8125 49.725 4.8125V12.5125Z" fill="white" />
            </svg>
        </div>
        <div class="flex flex-col gap-2 items-center justify-center text-center p-4 min-w-[200px] flex-1">
            <h2 class="text-xl font-bold">Order for delivery or pickup</h2>
            <p class="text-sm">We'll keep you updated on the progress of your order.</p>
        </div>
    </div>
</div>
<div class="flex flex-col gap-4 items-center text-black">
    <div class="bg-sexyred-light px-4 py-16 w-full rounded-2xl flex justify-center items-center">
        <div class="flex">
            <p class="font-semibold text-5xl italic">YumHub</p>
            <p class="text-xl">(partner)</p>
        </div>
    </div>
    <div class="px-4 w-full max-w-[400px]">
        <a href="" class="flex bg-sexyred hover:bg-sexyred-light rounded-2xl px-4 py-3 w-full justify-center font-bold">Become a partner now</a>
    </div>
</div>
<div class="container mx-auto grid sm:grid-cols-[repeat(auto-fit,minmax(300px,1fr))] gap-4 justify-center px-4 py-8">
    <div class="bg-50-shades flex w-full flex-wrap rounded-2xl overflow-hidden">
        <div class="bg-mr-grey flex justify-center items-center p-4 rounded-2xl overflow-hidden min-w-[200px] flex-1">
            <svg class="max-w-[64px] max-h-[64px]" viewBox="0 0 77 77" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M39.1761 15.479C34.3644 15.479 29.6606 16.8693 25.6598 19.4741C21.659 22.0788 18.5407 25.7811 16.6993 30.1126C14.8579 34.4441 14.3761 39.2105 15.3149 43.8088C16.2536 48.4071 18.5707 52.631 21.9731 55.9462C25.3755 59.2614 29.7105 61.5191 34.4298 62.4338C39.1491 63.3485 44.0408 62.879 48.4863 61.0848C52.9318 59.2907 56.7315 56.2523 59.4047 52.354C62.078 48.4557 63.5049 43.8726 63.5049 39.1842C63.4973 32.8994 60.9316 26.8742 56.3708 22.4303C51.8099 17.9863 45.6262 15.4864 39.1761 15.479ZM39.1761 59.5068C35.0518 59.5068 31.0201 58.3152 27.5908 56.0827C24.1615 53.8501 21.4886 50.6769 19.9101 46.9643C18.3317 43.2516 17.9185 39.1663 18.7228 35.2249C19.5272 31.2834 21.513 27.6629 24.4291 24.8211C27.3451 21.9792 31.0606 20.0437 35.1056 19.2593C39.1506 18.4749 43.3434 18.8768 47.154 20.4142C50.9646 21.9516 54.2217 24.5554 56.5136 27.8964C58.8055 31.2374 60.0291 35.1656 60.0298 39.1842C60.0232 44.5712 57.824 49.7357 53.9146 53.5448C50.0052 57.354 44.7048 59.5004 39.1761 59.5068ZM48.6652 30.9586L51.2006 33.4291L37.383 46.896L30.7342 40.4211L33.2697 37.9507L37.383 41.9551L48.6652 30.9586ZM72.7321 41.127C72.3211 40.5354 72.1014 39.8374 72.1014 39.123C72.1014 38.4086 72.3211 37.7106 72.7321 37.119L75.2317 33.5724C75.8584 32.6833 76.2668 31.6656 76.4255 30.5982C76.5841 29.5307 76.4886 28.442 76.1465 27.4162C75.8043 26.3904 75.2247 25.4551 74.4523 24.6824C73.6799 23.9098 72.7355 23.3205 71.6921 22.9603L67.5322 21.5206C66.8427 21.279 66.2439 20.8409 65.8134 20.2632C65.383 19.6855 65.1409 18.995 65.1187 18.2814L64.9967 13.9835C64.9667 12.9057 64.6828 11.8491 64.1672 10.8951C63.6515 9.94121 62.9178 9.11547 62.0226 8.48167C61.1275 7.84786 60.0948 7.42293 59.0044 7.23968C57.914 7.05642 56.7949 7.11974 55.7336 7.42474L51.5019 8.64075C50.7982 8.84176 50.0487 8.83123 49.3513 8.61054C48.6539 8.38985 48.0411 7.96927 47.5929 7.40378L44.9033 3.99337C44.198 3.18398 43.3204 2.53378 42.3315 2.08785C41.3425 1.64192 40.2658 1.41095 39.1761 1.41095C38.0864 1.41095 37.0097 1.64192 36.0208 2.08785C35.0318 2.53378 34.1543 3.18398 33.449 3.99337L30.7593 7.40378C30.3096 7.96737 29.6966 8.38654 28.9998 8.60706C28.3029 8.82758 27.5542 8.83931 26.8504 8.64075L22.6187 7.42474C21.5576 7.1198 20.4389 7.05642 19.3487 7.23949C18.2585 7.42255 17.2261 7.84717 16.331 8.48059C15.4359 9.11401 14.7021 9.9393 14.1862 10.8928C13.6703 11.8463 13.3861 12.9025 13.3555 13.98L13.2336 18.2884C13.2106 19.0014 12.9682 19.6911 12.5378 20.2681C12.1074 20.8451 11.509 21.2827 10.8201 21.5241L6.6601 22.9638C5.61671 23.324 4.67232 23.9133 3.89994 24.6859C3.12757 25.4586 2.54791 26.3939 2.20576 27.4197C1.86362 28.4455 1.76817 29.5342 1.92679 30.6017C2.08541 31.6691 2.49385 32.6868 3.12053 33.5759L5.6201 37.1225C6.03036 37.7138 6.2496 38.4111 6.2496 39.1248C6.2496 39.8384 6.03036 40.5358 5.6201 41.127L3.12053 44.6772C2.49454 45.5659 2.08667 46.583 1.92843 47.6498C1.7702 48.7166 1.86584 49.8046 2.20797 50.8297C2.55009 51.8547 3.12954 52.7894 3.90152 53.5615C4.6735 54.3335 5.61735 54.9223 6.6601 55.2823L10.8201 56.7254C11.5131 56.9615 12.1155 57.3983 12.5469 57.9771C12.9782 58.556 13.2178 59.2494 13.2336 59.9646L13.3555 64.2625C13.3849 65.3406 13.6682 66.3976 14.1837 67.3519C14.6992 68.3062 15.4329 69.1322 16.3283 69.7662C17.2236 70.4001 18.2566 70.825 19.3473 71.0079C20.438 71.1909 21.5573 71.127 22.6187 70.8213L26.8504 69.6053C27.5541 69.4062 28.303 69.4177 29 69.6383C29.697 69.8588 30.3099 70.2783 30.7593 70.8422L33.449 74.2526C34.1239 75.1074 34.9913 75.7996 35.9843 76.276C36.9773 76.7523 38.0693 77 39.1761 77C40.2829 77 41.375 76.7523 42.3679 76.276C43.3609 75.7996 44.2283 75.1074 44.9033 74.2526L47.5929 70.8422C48.0439 70.2801 48.6569 69.8621 49.3534 69.6417C50.0498 69.4213 50.798 69.4086 51.5019 69.6053L55.7336 70.8213C56.7946 71.1262 57.9134 71.1896 59.0036 71.0065C60.0937 70.8235 61.1262 70.3988 62.0213 69.7654C62.9163 69.132 63.6501 68.3067 64.166 67.3532C64.6819 66.3997 64.9661 65.3435 64.9967 64.266L65.1187 59.9646C65.1345 59.2494 65.3741 58.556 65.8054 57.9771C66.2367 57.3983 66.8392 56.9615 67.5322 56.7254L71.6921 55.2823C72.7349 54.9223 73.6787 54.3335 74.4507 53.5615C75.2227 52.7894 75.8022 51.8547 76.1443 50.8297C76.4864 49.8046 76.5821 48.7166 76.4238 47.6498C76.2656 46.583 75.8577 45.5659 75.2317 44.6772L72.7321 41.127ZM72.7321 49.7438C72.5588 50.259 72.2671 50.7288 71.8794 51.1175C71.4916 51.5063 71.0179 51.8037 70.4944 51.9872L66.3344 53.4268C64.9633 53.907 63.7722 54.778 62.9159 55.9265C62.0595 57.0749 61.5775 58.4478 61.5325 59.8667L61.4105 64.1647C61.396 64.7074 61.2536 65.2395 60.9943 65.72C60.7349 66.2005 60.3657 66.6164 59.915 66.9356C59.4643 67.2548 58.9444 67.4687 58.3953 67.5608C57.8462 67.6529 57.2827 67.6208 56.7485 67.4668L52.5168 66.2508C51.1181 65.856 49.6299 65.8794 48.245 66.318C46.8601 66.7565 45.6423 67.5901 44.7491 68.7107L42.0594 72.1176C41.7042 72.525 41.2624 72.8522 40.7645 73.0766C40.2667 73.301 39.7247 73.4172 39.1761 73.4172C38.6276 73.4172 38.0856 73.301 37.5877 73.0766C37.0898 72.8522 36.648 72.525 36.2928 72.1176L33.6032 68.7107C32.9239 67.8566 32.053 67.1654 31.0572 66.6899C30.0613 66.2145 28.967 65.9674 27.8581 65.9677C27.1736 65.9659 26.4924 66.0601 25.8355 66.2473L21.6038 67.4703C21.0692 67.6243 20.5055 67.6565 19.9561 67.5642C19.4068 67.4719 18.8866 67.2576 18.4359 66.938C17.9851 66.6185 17.6159 66.2021 17.3568 65.7212C17.0977 65.2402 16.9557 64.7077 16.9417 64.1647L16.8198 59.8667C16.7745 58.4474 16.2919 57.0742 15.4349 55.9257C14.5779 54.7772 13.386 53.9065 12.0143 53.4268L7.8543 51.9872C7.33038 51.8046 6.85644 51.5073 6.46896 51.1182C6.08149 50.7291 5.79083 50.2586 5.61935 49.7428C5.44787 49.2271 5.40015 48.6798 5.47986 48.1433C5.55958 47.6067 5.76459 47.0951 6.07914 46.6479L8.57513 43.1012C9.39365 41.9272 9.83128 40.5406 9.83128 39.1213C9.83128 37.7019 9.39365 36.3153 8.57513 35.1413L6.07555 31.5946C5.76115 31.1469 5.55644 30.6349 5.4772 30.098C5.39796 29.561 5.4463 29.0136 5.6185 28.4977C5.7907 27.9818 6.08216 27.5114 6.47042 27.1226C6.85868 26.7339 7.33336 26.4372 7.85789 26.2554L12.0179 24.8157C13.3889 24.3355 14.58 23.4645 15.4364 22.3161C16.2927 21.1676 16.7747 19.7947 16.8198 18.3758L16.9417 14.0778C16.9576 13.5354 17.1006 13.0037 17.3598 12.5234C17.619 12.0432 17.9875 11.627 18.4372 11.3069C18.8899 10.9917 19.4098 10.7802 19.9581 10.6882C20.5064 10.5963 21.069 10.6262 21.6038 10.7757L25.8355 11.9918C27.2336 12.3904 28.7226 12.3692 30.1082 11.931C31.4938 11.4928 32.7118 10.6579 33.6032 9.53528L36.2928 6.12487C36.648 5.71754 37.0898 5.39034 37.5877 5.16594C38.0856 4.94154 38.6276 4.82531 39.1761 4.82531C39.7247 4.82531 40.2667 4.94154 40.7645 5.16594C41.2624 5.39034 41.7042 5.71754 42.0594 6.12487L44.7491 9.53528C45.6418 10.6564 46.8598 11.4902 48.245 11.9282C49.6301 12.3663 51.1185 12.3884 52.5168 11.9918L56.7485 10.7757C57.2825 10.6218 57.8456 10.5896 58.3944 10.6815C58.9432 10.7734 59.463 10.987 59.9136 11.3058C60.3642 11.6246 60.7335 12.0401 60.9931 12.5202C61.2527 13.0002 61.3955 13.5319 61.4105 14.0743L61.5325 18.3723C61.5771 19.7922 62.0593 21.1662 62.9164 22.3154C63.7735 23.4646 64.9657 24.3358 66.338 24.8157L70.4979 26.2554C71.0219 26.4379 71.4958 26.7352 71.8833 27.1243C72.2708 27.5134 72.5614 27.9839 72.7329 28.4997C72.9044 29.0155 72.9521 29.5627 72.8724 30.0992C72.7927 30.6358 72.5877 31.1474 72.2731 31.5946L69.7771 35.1413C68.9586 36.3153 68.521 37.7019 68.521 39.1213C68.521 40.5406 68.9586 41.9272 69.7771 43.1012L72.2731 46.6479C72.5867 47.0958 72.7911 47.6075 72.8706 48.1441C72.9502 48.6806 72.9028 49.2278 72.7321 49.7438Z" fill="white" />
            </svg>
        </div>
        <div class="flex flex-col gap-2 items-center justify-center text-center p-4 min-w-[200px] flex-1">
            <h2 class="text-xl font-bold">We guarantee</h2>
            <ul class="text-sm text-left list-disc ml-4">
                <li>Excellent service</li>
                <li>Authentic user reviews</li>
            </ul>
        </div>
    </div>
    <div class="bg-50-shades flex w-full flex-wrap rounded-2xl overflow-hidden">
        <div class="bg-mr-grey flex justify-center items-center p-4 rounded-2xl overflow-hidden min-w-[200px] flex-1">
            <svg class="max-w-[64px] max-h-[64px]" viewBox="0 0 77 77" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M38.0905 29.5479C42.6746 29.5479 46.354 25.8706 46.354 21.289C46.354 16.7074 42.6746 13 38.0905 13C33.5064 13 29.827 16.6773 29.827 21.2589C29.827 25.8706 33.5365 29.5479 38.0905 29.5479ZM18.8794 53.4805H4.01111C-0.814286 53.4805 -1.08571 46.1259 4.10159 46.1259H16.9794L24.3683 35.2447C26.5397 32.2908 29.0429 30.8741 32.5413 30.8741H43.5492C47.0778 30.8741 49.5508 32.1702 51.7222 35.2748L59.1413 46.156H72.1095C77.2968 46.156 76.9952 53.5106 72.2905 53.5106H57.4222C56.246 53.5106 54.8286 53.0887 53.9841 51.8227L48.3143 43.7447L48.2841 64H27.9873L27.9571 43.7447L22.2873 51.8227C21.473 53.0585 20.0556 53.4805 18.8794 53.4805ZM8.74603 42.0869C13.5714 42.0869 17.4921 38.1684 17.4921 33.3457C17.4921 28.5231 13.5714 24.6046 8.74603 24.6046C3.92063 24.6046 0 28.523 0 33.3759C0 38.1986 3.92063 42.0869 8.74603 42.0869ZM8.26349 34.0993C6.66508 33.5266 5.66984 32.7128 5.66984 31.2961C5.66984 29.9699 6.54444 28.9149 8.17302 28.5833V27.1365H9.37936V28.5231C10.3746 28.5231 11.0984 28.734 11.6413 29.0053L11.1587 30.7234C10.7667 30.5727 10.1032 30.2713 9.22857 30.2713C8.35397 30.2713 7.84127 30.7234 7.84127 31.1454C7.84127 31.7482 8.41429 31.9894 9.62064 32.4716C11.2794 33.0745 12.0333 33.9184 12.0333 35.2748C12.0333 36.6312 11.1889 37.6862 9.40952 38.078V39.4645H8.20318V38.1383C7.14762 38.1383 6.09206 37.867 5.60952 37.5656L6.0619 35.7872C6.63492 36.0585 7.50952 36.3901 8.44444 36.3901C9.43968 36.3901 9.95238 35.9379 9.95238 35.3351C9.95238 34.7323 9.40952 34.5514 8.26349 34.0993ZM67.254 24.6046C62.4286 24.6046 58.5079 28.5231 58.5079 33.3457C58.5079 38.1684 62.4286 42.0869 67.254 42.0869C72.0794 42.0869 76 38.1684 76 33.3457C76 28.5231 72.0794 24.6046 67.254 24.6046ZM70.7222 38.3794L67.254 36.5709L63.8159 38.3794L64.4794 34.5514L61.6746 31.8387L65.5349 31.266L67.254 27.7695L68.973 31.266L72.8333 31.8085L70.0587 34.5213L70.7222 38.3794Z" fill="white" />
            </svg>
        </div>
        <div class="flex flex-col gap-2 items-center justify-center text-center p-4 min-w-[200px] flex-1">
            <h2 class="text-xl font-bold">Your benefits</h2>
            <ul class="text-sm text-left list-disc ml-4">
                <li>420 places to choose from</li>
                <li>Pay online or in cash</li>
                <li>Order anytime, anywhere, on any device</li>
            </ul>
        </div>
    </div>
</div>
<?php
require_once __DIR__ . '/_footer.php';
?>