document.addEventListener("DOMContentLoaded", () => {
      const toggleSidebar = document.getElementById("toggleSidebar");
      const sidebar = document.getElementById("sidebar");
      const overlay = document.getElementById("overlay");
      const body = document.body;

      // Open sidebar
      toggleSidebar.addEventListener("click", () => {
        sidebar.classList.add("active");
        overlay.classList.add("active");
        body.classList.add("sidebar-open");
      });

      // Close sidebar when clicking overlay
      overlay.addEventListener("click", closeSidebar);

      // Close sidebar when clicking a sidebar link
      document.querySelectorAll("#sidebar a").forEach(link => {
        link.addEventListener("click", closeSidebar);
      });

      function closeSidebar() {
        sidebar.classList.remove("active");
        overlay.classList.remove("active");
        body.classList.remove("sidebar-open");
      }
    });
