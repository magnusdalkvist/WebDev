var timer_search_users = "";
function search_users() {
  clearTimeout(timer_search_users);
  timer_search_users = setTimeout(async function () {
    const frm = document.querySelector("#frm_search");
    const url = frm.getAttribute("data-url");
    console.log("URL: ", url);
    console.log("form: ", frm);
    const conn = await fetch(`/api/${url}`, {
      method: "POST",
      body: new FormData(frm),
    });
    const data = await conn.json();
    document.querySelector("#query_results").innerHTML = "";

    data.forEach((user) => {
      let div_user = `
        <div class="grid grid-cols-[100fr,100fr,50fr] p-2">
          <div class="">${user.user_name}</div>
          <div class="">${user.user_last_name}</div>
          <div class="">${user.employee_salaray}</div>
        </div>
      `;
      document.querySelector("#query_results").insertAdjacentHTML("afterbegin", div_user);
    });
  }, 500);
}

// ##############################
async function is_email_available() {
  const frm = event.target.form;
  const conn = await fetch("api/api-is-email-available.php", {
    method: "POST",
    body: new FormData(frm),
  });
  if (!conn.ok) {
    // everything that is not a 2xx
    console.log("email not available");
    document.querySelector("#msg_email_not_available").classList.remove("hidden");
    return;
  }
  console.log("email available");
}

// ##############################
async function delete_user() {
  const frm = event.target;
  console.log(frm);
  const conn = await fetch("api/api-admin-delete-user.php", {
    method: "POST",
    body: new FormData(frm),
  });
  const response = await conn.json();
  console.log(response);
  frm.parentElement.remove();
}

// ##############################
async function toggle_blocked(user_id, user_is_blocked) {
  console.log("user_id", user_id);
  console.log("user_is_blocked", user_is_blocked);

  if (user_is_blocked == 0) {
    event.target.innerHTML = "blocked";
  } else {
    event.target.innerHTML = "unblocked";
  }

  const conn = await fetch(
    `api/api-toggle-user-blocked.php?user_id=${user_id}&user_is_blocked=${user_is_blocked}`
  );
  const data = await conn.text();
  console.log(data);
}

// const system_theme = window.matchMedia("(prefers-color-scheme: dark)");
// console.log(system_theme.theme)
// if (system_theme.matches) {
//   // Theme set to dark.
//   document.documentElement.classList.remove('dark')
// } else {
//   // Theme set to light.
//   document.documentElement.classList.add('dark')
// }

function toggle_theme() {
  if (document.querySelector("html").classList.contains("dark")) {
    document.querySelector("html").classList.remove("dark");
    document.querySelector("#btn_dark_icon").classList.remove("hidden");
    document.querySelector("#btn_light_icon").classList.add("hidden");
    return;
  }
  document.querySelector("html").classList.add("dark");
  document.querySelector("#btn_dark_icon").classList.add("hidden");
  document.querySelector("#btn_light_icon").classList.remove("hidden");
}

function toogle_menu() {
  if (document.querySelector("#menu").classList.contains("left-0")) {
    document.querySelector("#menu").classList.add("-left-60");
    document.querySelector("#menu").classList.remove("left-0");
    document.querySelector("#menu").classList.remove("left-0");
    document.querySelector("#menu_background").classList.add("hidden");
    return;
  }
  document.querySelector("#menu").classList.remove("-left-60");
  document.querySelector("#menu").classList.add("left-0");
  document.querySelector("#menu_background").classList.remove("hidden");
}

function toggle_language() {
  console.log("x");
  if (document.querySelector("#box_languages").classList.contains("hidden")) {
    console.log("the box hidden");
    document.querySelector("#box_languages").classList.remove("hidden");
    return;
  }
  document.querySelector("#box_languages").classList.add("hidden");
}

async function signup() {
  const frm = event.target;
  console.log(frm);
  const conn = await fetch("/api/api-signup.php", {
    method: "POST",
    body: new FormData(frm),
  });

  const data = await conn.text();
  console.log(data);

  if (!conn.ok) {
    return;
  }

  // TODO: redirect to the login page
  location.href = "/login";
}

async function login() {
  const frm = event.target;
  event.preventDefault();
  console.log(frm);
  const conn = await fetch("/api/api-login.php", {
    method: "POST",
    body: new FormData(frm),
  });

  const data = await conn.json();
  console.log(data);

  if (!conn.ok) {
    return;
  }

  if (data.user_role_name == "admin") {
    location.href = "/admin";
    return;
  }

  location.href = "/";
}

async function update_user() {
  const frm = event.target
  event.preventDefault();
  console.log(frm)

  fetch("/api/api-update-user.php", {
    method: "POST",
    body: new FormData(frm),
   })
    .then(response => response.json())
    .then(data => {
      location.reload();
    })
    .catch(error => {
      console.error('error:', error);
    });
   
}
