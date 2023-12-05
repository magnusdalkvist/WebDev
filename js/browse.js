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
    let html = '<div class="grid grid-cols-3 md:grid-cols-3 gap-4">'; 
    items.forEach((item) => {
      if(item.partner_name !== currentPartner) {
        if(currentPartner !== '') {
          html += '</div></div></div>';
        }
        currentPartner = item.partner_name;
        html += `<div class='max-w-sm bg-white rounded-lg border border-gray-200 shadow-md overflow-hidden mb-5'><div class='p-5'><h5 class='text-2xl font-bold tracking-tight text-gray-900'>${currentPartner}</h5><div>`;
      }
      html += `<div class='mt-4 flex justify-between'><p class='font-normal text-gray-700'>${item.item_name}</p><p class='font-normal text-gray-700'>${item.item_price}$</p></div>`;
    });
    if(currentPartner !== '') {
      html += '</div></div></div>';
    }
    html += '</div>'; 
    document.querySelector("#results").innerHTML = html;
  }
  
  document.addEventListener("DOMContentLoaded", async () => {
    const items = await getItems();
    displayItems(items);
  });