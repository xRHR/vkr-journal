
    <link rel="SHORTCUT ICON" href="/bsu-logo-100px.png" type="image/x-icon">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Custom fonts for this template-->
    <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    @vite(['resources/css/app.css'])
    <!-- Custom styles for this template-->
    <link href="/css/sb-admin-2.css" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    
    <script>
      // Function to toggle class based on window size
      function toggleSidebarClass() {
          var sidebar = document.getElementById("accordionSidebar");
          if (window.innerWidth < 768) {
              sidebar.classList.add("toggled");
          } else {
              sidebar.classList.remove("toggled");
          }
      }

      // Immediately invoke the function to toggle class during initial load
      (function() {
          toggleSidebarClass();
      })();

      // Add event listener to handle window resize
      window.addEventListener("resize", toggleSidebarClass);
  </script>
    @livewireStyles