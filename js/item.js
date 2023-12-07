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

async function load_item() {
  const selectedOption = event.target.selectedOptions[0].value;
  console.log("update_item called with form: ", selectedOption);
  event.preventDefault();

  fetch(`/api/api-partner-load-item.php?item_id=${selectedOption}`, {
    method: "GET", // *GET, POST, PUT, DELETE, etc.
    // mode: "cors", // no-cors, *cors, same-origin
    // cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
    // credentials: "same-origin", // include, *same-origin, omit
    // headers: { "Content-Type": "application/json" }, // 'Content-Type': 'application/x-www-form-urlencoded',
    // redirect: "follow", // manual, *follow, error
    // referrerPolicy: "no-referrer",
    // body: JSON.stringify({ item_id: selectedOption }),
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
