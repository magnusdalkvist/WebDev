async function add_item() {
  const frm = event.target;
  event.preventDefault();
  console.log("add_item" + frm);

  fetch("/api/api-partner-add-item.php", {
    method: "POST",
    body: new FormData(frm),
  })
    .then((response) => response.json())
    .then((data) => {
      location.reload();
    })
    .catch((error) => {
      console.error("error:", error);
    });
}

// ##############################

async function load_item(event) {
  event.preventDefault();
  const frm = event.target;
  console.log("update_item called with form: ", frm);

  fetch("/api/api-partner-load-item.php", {
    method: "POST",
    body: new FormData(frm),
  })
    .then((response) => response.json())
    .then((data) => {
      console.log("Data received from server: ", data);
      if (data.item) {
        document.querySelector('input[name="item_id"]').value =
          data.item.item_id || "";
        document.querySelector('input[name="item_name"]').value =
          data.item.item_name || "";
        document.querySelector('input[name="item_price"]').value =
          data.item.item_price || "";
      }
    })
    .catch((error) => {
      console.error("error:", error);
    });
}

// ##############################

async function update_item() {
  const frm = event.target;
  event.preventDefault();
  console.log("update_item" + frm);

  fetch("/api/api-partner-update-item.php", {
    method: "POST",
    body: new FormData(frm),
  })
    .then((response) => response.json())
    .then((data) => {
      location.reload();
    })
    .catch((error) => {
      console.error("error:", error);
    });
}

// ##############################

async function delete_item() {
  const frm = event.target;
  event.preventDefault();
  console.log("delete_item" + frm);

  fetch("/api/api-partner-delete-item.php", {
    method: "POST",
    body: new FormData(frm),
  })
    .then((response) => response.json())
    .then((data) => {
      location.reload();
    })
    .catch((error) => {
      console.error("error:", error);
    });
}

function updateItemName() {
  const select = document.getElementById('itemSelect');
  const nameInput = document.getElementById('itemName');
  const selectedOption = select.options[select.selectedIndex];
  nameInput.value = selectedOption.getAttribute('data-name');
}