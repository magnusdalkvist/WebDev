async function getItems() {
  const frm = document.querySelector("#frm_search");
  const url = frm.getAttribute("data-url");
  const conn = await fetch(`/api/${url}`, {
    method: "POST",
    body: new FormData(frm),
  });
  const data = await conn.json();
  return data;
}

document.querySelector("#frm_search").addEventListener("input", handleSearch);

var timer_search_items = "";
async function handleSearch() {
  clearTimeout(timer_search_items);
  timer_search_items = setTimeout(async function () {
    const items = await getItems();
    displayItems(items);
  }, 500);
}

function displayItems(items) {
  let currentPartner = '';
  let html = ''; 
  items.forEach((item) => {
    if(item.partner_name !== currentPartner) {
      if(currentPartner !== '') {
        html += '</div></div></div>';
      }
      currentPartner = item.partner_name;
      html += `<div class='border border-50-shades bg-50-shades rounded-lg overflow-hidden mb-5 text-center'><div class='p-5'><h2 class='text-2xl font-bold tracking-tight text-white'>${currentPartner}</h2><div class='mt-4 text-left'>`;
    }
    html += `<div class='flex justify-between'><p class='font-normal text-white'>${item.item_name}</p><p class='font-normal text-gwhite'>${item.item_price}$</p></div>`;
  });
  if(currentPartner !== '') {
    html += '</div></div></div>';
  }
  document.querySelector("#results").innerHTML = html;
}

document.addEventListener("DOMContentLoaded", async () => {
  const items = await getItems();
  displayItems(items);
});