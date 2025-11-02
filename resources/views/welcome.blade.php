<x-layout>
  @vite(['resources/css/home.css'])

  <!-- ===== STYLE SECTION ===== -->
  <style>
    /* ===== BUTTONS ===== */
    
  </style>

  <!-- ===== MAIN CONTENT ===== -->
  <div class="container-fluid mt-3">

    <!-- ===== TOP CONTROLS ===== -->
    <div class="d-flex justify-content-between align-items-start flex-wrap">

      <!-- LEFT SIDE -->
      <div class="d-flex align-items-start gap-3 flex-wrap ms-2">
        <div>
          <h6 class="fw-bold text-dark mb-1">Order Type:</h6>
          <div class="d-flex gap-2">
            <button id="btnDineIn" class="btn order-btn active">Dine In</button>
            <button id="btnTakeOut" class="btn order-btn">Take Out</button>
          </div>
        </div>

        <!-- Accordion -->
      <!-- Accordion -->
<div>
  <div class="accordion" id="tableAccordion">
    <div class="accordion-item border-0 position-relative">
      <h2 class="accordion-header">
        <button 
          id="accordionToggle"
          class="accordion-button collapsed bg-dark text-white rounded"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#collapseTables"
          aria-expanded="false"
          aria-controls="collapseTables"
          style="font-size: 0.85rem; padding: 6px 10px;"
        >
          Select Table
        </button>
      </h2>
      <div id="collapseTables" class="accordion-collapse collapse" data-bs-parent="#tableAccordion">
        <div class="accordion-body py-2">
          <form id="tableForm">
            <!-- Dito ipapasok ng JS yung galing sa table.php -->
            <div id="tableList">Loading available tables...</div>

            <button type="button" class="btn btn-sm w-100 mt-2 btn-dark" id="confirmTable">
              Confirm
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


        <div class="d-flex align-items-center">
          <label class="me-2 fw-bold text-dark">Table #:</label>
          <input type="text" id="selectedTable" class="form-control form-control-sm" readonly style="width: 100px;">
        </div>
      </div>

      <!-- CENTER SEARCH -->
      <div class="flex-grow-1 mx-3 mt-4 mt-md-0 text-center">
        <input type="text" id="searchBar" class="form-control mx-auto" placeholder="Search item...">
      </div>

      <!-- RIGHT ORDERS BUTTON -->
      <div class="me-3 mt-4 mt-md-0">
        <button id="btnOrders" class="btn shadow-sm">
          <i class="fa fa-list me-2"></i> Orders
        </button>
      </div>
    </div>

    <!-- ===== PRODUCT GRID ===== -->
    <div class="product-container mt-5 ms-3">
      <template id="product-template">
        <div class="product-card">
          <img src="https://via.placeholder.com/300x220" alt="Product Image" class="product-img">
          <div class="product-name">Product Name</div>
          <div class="product-price">₱100.00</div>
          <button class="btn btn-order mt-2">Order</button>
        </div>
      </template>
    </div>

  </div>

  <!-- ===== SCRIPT SECTION ===== -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/js/all.min.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const dineInBtn = document.getElementById("btnDineIn");
      const takeOutBtn = document.getElementById("btnTakeOut");
      const accordionToggle = document.getElementById("accordionToggle");
      const collapseEl = document.getElementById("collapseTables");
      const collapse = new bootstrap.Collapse(collapseEl, { toggle: false });
      const radioButtons = document.querySelectorAll('input[name="table"]');
      const confirmBtn = document.getElementById("confirmTable");
      const selectedTable = document.getElementById("selectedTable");

      function setAccordionEnabled(enabled) {
        accordionToggle.disabled = !enabled;
        confirmBtn.disabled = !enabled;
        radioButtons.forEach(r => r.disabled = !enabled);
        if (enabled) {
          accordionToggle.classList.remove("disabled");
        } else {
          accordionToggle.classList.add("disabled");
          collapse.hide();
        }
      }

      dineInBtn.addEventListener("click", () => {
        dineInBtn.classList.add("active");
        takeOutBtn.classList.remove("active");
        setAccordionEnabled(true);
        selectedTable.value = "";
      });

      takeOutBtn.addEventListener("click", () => {
        takeOutBtn.classList.add("active");
        dineInBtn.classList.remove("active");
        setAccordionEnabled(false);
        selectedTable.value = "N/A";
      });

      confirmBtn.addEventListener("click", () => {
        const chosen = document.querySelector('input[name="table"]:checked');
        if (chosen) {
          selectedTable.value = chosen.value;
          collapse.hide();
        } else {
          alert("Please select a table first!");
        }
      });

      // Generate dummy products
      const productTemplate = document.getElementById("product-template").content;
      const container = document.querySelector(".product-container");
      for (let i = 1; i <= 12; i++) {
        const clone = document.importNode(productTemplate, true);
        clone.querySelector(".product-name").textContent = "Product " + i;
        clone.querySelector(".product-price").textContent = "₱" + (50 + i * 10) + ".00";
        container.appendChild(clone);
      }
    });
  </script>
  <script>
document.addEventListener("DOMContentLoaded", () => {
  // Load available tables from table.php
  fetch("/table-data")
    .then(response => response.text())
    .then(data => {
      document.getElementById("tableList").innerHTML = data;
    })
    .catch(error => {
      document.getElementById("tableList").innerHTML = 
        '<p class="text-danger small">Error loading tables.</p>';
      console.error("Error fetching tables:", error);
    });
});
</script>


</x-layout>
