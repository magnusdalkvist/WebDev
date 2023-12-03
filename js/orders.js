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

document.querySelector("#sort_created_at").addEventListener("click", sortCreatedAt);
document.querySelector("#sort_id").addEventListener("click", sortId);
document.querySelector("#sort_created_by").addEventListener("click", sortCreatedBy);
document.querySelector("#sort_status").addEventListener("click", sortStatus);
document.querySelector("#sort_delivered_by").addEventListener("click", sortDeliveredBy);
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

let sortCreatedAtDirection = -1;
async function sortCreatedAt() {
  document.querySelectorAll("#direction").forEach((el) => {
    el.innerHTML = "";
  });
  this.querySelector("#direction").innerHTML = sortCreatedAtDirection == 1 ? "▲" : "▼";
  const orders = await getOrders();
  orders.sort((a, b) => {
    return a.order_created_at.localeCompare(b.order_created_at) * sortCreatedAtDirection;
  });
  sortCreatedAtDirection *= -1;
  displayorders(orders);
}

let sortIdDirection = -1;
async function sortId() {
  document.querySelectorAll("#direction").forEach((el) => {
    el.innerHTML = "";
  });
  this.querySelector("#direction").innerHTML = sortIdDirection == 1 ? "▲" : "▼";
  const orders = await getOrders();
  orders.sort((a, b) => {
    return (a.order_id - b.order_id) * sortIdDirection;
  });
  sortIdDirection *= -1;
  displayorders(orders);
}

let sortCreatedByDirection = -1;
async function sortCreatedBy() {
  document.querySelectorAll("#direction").forEach((el) => {
    el.innerHTML = "";
  });
  this.querySelector("#direction").innerHTML = sortCreatedByDirection == 1 ? "▲" : "▼";
  const orders = await getOrders();
  orders.sort((a, b) => {
    return (a.order_created_by_user_fk - b.order_created_by_user_fk) * sortCreatedByDirection;
  });
  sortCreatedByDirection *= -1;
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
    return (a.order_delivered_at - b.order_delivered_at) * sortStatusDirection;
  });
  sortStatusDirection *= -1;
  displayorders(orders);
}

let sortDeliveredByDirection = -1;
async function sortDeliveredBy() {
  document.querySelectorAll("#direction").forEach((el) => {
    el.innerHTML = "";
  });
  this.querySelector("#direction").innerHTML = sortDeliveredByDirection == 1 ? "▲" : "▼";
  const orders = await getOrders();
  orders.sort((a, b) => {
    return (a.order_delivered_by_user_fk - b.order_delivered_by_user_fk) * sortDeliveredByDirection;
  });
  sortDeliveredByDirection *= -1;
  displayorders(orders);
}

function displayorders(orders) {
  console.log(orders);
  document.querySelector("#results").innerHTML = "";
  orders.forEach(async (order) => {
    // const items = await fetch(`/api/api-get-order-details.php?id=${order.order_id}`).then((res) =>
    //   res.json()
    // );

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
    <div>${order.order_delivered_at > 0 ? "Delivered" : "Not delivered"}</div>
    <div>${order.order_delivered_by_user_fk}</div>
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
  console.log(orders);
});
