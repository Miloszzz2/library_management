const authorCheckbox = document.getElementById("authorCheckbox");
const wCheckbox = document.getElementById("wCheckbox");
const copiesCheckbox = document.getElementById("copiesCheckbox");
const titlegroup = document.getElementById("titlegroup");
const authorgroup = document.getElementById("authorgroup");
const wgroup = document.getElementById("wgroup");
const copiesgroup = document.getElementById("copiesgroup");
const idInput = document.getElementById("id_book");
const idUserInput = document.getElementById("user_id");
function saveLastTab(event) {
  const lastTab = event.target.getAttribute("aria-controls");
  sessionStorage.setItem("lastTab", lastTab);
}

document.addEventListener("DOMContentLoaded", function () {
  const lastTab = sessionStorage.getItem("lastTab");
  const tab = document.querySelector(
    `#v-pills-tab [aria-controls="${lastTab}"]`
  );

  if (lastTab && tab) {
    const tabContent = document.querySelector(`#${lastTab}`);
    new bootstrap.Tab(tab).show();
    tabContent.classList.add("show", "active");
  }

  const tabs = document.querySelectorAll('[data-bs-toggle="pill"]');
  tabs.forEach((tab) => {
    tab.addEventListener("shown.bs.tab", saveLastTab);
  });
});

function changeVisibility(el, group, el2) {
  el.addEventListener("change", () => {
    if (el.checked) {
      group.innerHTML = el2;
    } else group.innerHTML = "";
  });
}
changeVisibility(
  titleCheckbox,
  titlegroup,
  '<label for="title" class="mb-1">Tytuł:</label> <input type="text" class="form-control" id="title" placeholder="Wprowadź tytuł" name="tytul">'
);
changeVisibility(
  authorCheckbox,
  authorgroup,
  ' <label for="author" class="mb-1">Autor:</label><input type="text" class="form-control" id="author" placeholder="Wprowadź autora" name="autor">'
);
changeVisibility(
  wCheckbox,
  wgroup,
  '<label for="publisher" class="mb-1">Wydawnictwo:</label><input type="text" class="form-control" id="publisher" placeholder="Wprowadź wydawnictwo" name="wydawnictwo">'
);
changeVisibility(
  copiesCheckbox,
  copiesgroup,
  '<label for="copies" class="mb-1">Liczba egzemplarzy:</label><input type="number" min=0 class="form-control" id="copies" placeholder="Wprowadź liczbę egzemplarzy" name="liczbasztuk">'
);
function changeIdFormValue(arg) {
  idInput.setAttribute("value", arg);
}
function changeIdFormValue2(arg) {
  idUserInput.setAttribute("value", arg);
}
function changeElementToInput(el, id) {
  const element_name = el.id;
  const prev_value = el.innerHTML;
  el.onclick = "";
  el.innerHTML = `<form method='POST' action='logic/modifyUser.php'><input type='submit' value="${id}" name='id' style='display:none;'/><input type='text' name="${element_name}" value='${prev_value}' id="${element_name}1"/></form>`;
  document.getElementById(`${element_name}1`).focus();
  document.getElementById(`${element_name}1`).onblur = () => {
    el.innerHTML = prev_value;
    el.onclick = () => {
      changeElementToInput(el, id);
    };
  };
}
