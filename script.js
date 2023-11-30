const filterForm = document.getElementById("filter-form");
const searchInput = document.getElementById("search-input");
filterForm.addEventListener("change", () => {
  searchInput.placeholder = "Wyszukaj po " + filterForm.value;
});
