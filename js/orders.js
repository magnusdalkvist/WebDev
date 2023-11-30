async function getOrders() {
  const frm = document.querySelector("#frm_search");
  const url = frm.getAttribute("data-url");
  const conn = await fetch(`/api/${url}`, {
    method: "POST",
    body: new FormData(frm),
  });
  const data = await conn.json();
  console.log(data);
  return data;
}

// document.querySelector("#sort_name").addEventListener("click", sortName);
// document.querySelector("#sort_last_name").addEventListener("click", sortLastName);
// document.querySelector("#sort_email").addEventListener("click", sortEmail);
// document.querySelector("#sort_role").addEventListener("click", sortRole);
// document.querySelector("#sort_status").addEventListener("click", sortStatus);
document.querySelector("#frm_search").addEventListener("input", handleSearch);

var timer_search_orders = "";
async function handleSearch() {
  clearTimeout(timer_search_orders);
  timer_search_orders = setTimeout(async function () {
    document.querySelectorAll("#direction").forEach((el) => {
      el.innerHTML = "";
    });
    const orders = await getOrders();
    displayorders(orders);
  }, 500);
}

let sortNameDirection = -1;
async function sortName() {
  document.querySelectorAll("#direction").forEach((el) => {
    el.innerHTML = "";
  });
  this.querySelector("#direction").innerHTML = sortNameDirection == 1 ? "▲" : "▼";
  const orders = await getOrders();
  orders.sort((a, b) => {
    return a.order_name.localeCompare(b.order_name) * sortNameDirection;
  });
  sortNameDirection *= -1;
  displayorders(orders);
}

let sortLastNameDirection = -1;
async function sortLastName() {
  document.querySelectorAll("#direction").forEach((el) => {
    el.innerHTML = "";
  });
  this.querySelector("#direction").innerHTML = sortLastNameDirection == 1 ? "▲" : "▼";
  const orders = await getOrders();
  orders.sort((a, b) => {
    return a.order_last_name.localeCompare(b.order_last_name) * sortLastNameDirection;
  });
  sortLastNameDirection *= -1;
  displayorders(orders);
}

let sortEmailDirection = -1;
async function sortEmail() {
  document.querySelectorAll("#direction").forEach((el) => {
    el.innerHTML = "";
  });
  this.querySelector("#direction").innerHTML = sortEmailDirection == 1 ? "▲" : "▼";
  const orders = await getOrders();
  orders.sort((a, b) => {
    return a.order_email.localeCompare(b.order_email) * sortEmailDirection;
  });
  sortEmailDirection *= -1;
  displayorders(orders);
}

let sortRoleDirection = -1;
async function sortRole() {
  document.querySelectorAll("#direction").forEach((el) => {
    el.innerHTML = "";
  });
  this.querySelector("#direction").innerHTML = sortRoleDirection == 1 ? "▲" : "▼";
  const orders = await getOrders();
  orders.sort((a, b) => {
    return a.order_role_name.localeCompare(b.order_role_name) * sortRoleDirection;
  });
  sortRoleDirection *= -1;
  displayorders(orders);
}

let sortStatusDirection = -1;
async function sortStatus() {
  document.querySelectorAll("#direction").forEach((el) => {
    el.innerHTML = "";
  });
  this.querySelector("#direction").innerHTML = sortStatusDirection == 1 ? "▲" : "▼";
  const orders = await getOrders();
  orders.sort((a, b) => {
    return a.order_is_blocked.localeCompare(b.order_is_blocked) * sortStatusDirection;
  });
  sortStatusDirection *= -1;
  displayorders(orders);
}

async function displayorders(orders) {
  document.querySelector("#results").innerHTML = "";
  orders.forEach((order) => {
    let div_order = `
    <div class="grid grid-cols-5 items-center gap-4 border-b border-b-slate-200 py-2">
    <div>${new Date(Number(order.order_created_at + "000")).toLocaleDateString("en-GB", {
      day: "2-digit",
      month: "short",
      year: "numeric",
      hour: "2-digit",
      minute: "2-digit",
    })}</div>
    <div>${order.order_id}</div>
    <div>${order.order_created_by_user_fk}</div>
    <div>
      
    </div>
    <div>
      
      <div></div>
    </div>
  </div>
        `;
    document.querySelector("#results").insertAdjacentHTML("afterbegin", div_order);
  });
  if (orders.length == 0) {
    document.querySelector("#results").innerHTML = `
        <div class="grid grid-cols-5 items-center gap-4 border-b border-b-slate-200 py-2">
          <div class="w-8 h-8 flex items-center justify-center text-white text-sm rounded-full"></div>
          <div class="w-full text-center">No results</div>
        `;
  }
}

document.addEventListener("DOMContentLoaded", async () => {
  const orders = await getOrders();
  displayorders(orders);
});
