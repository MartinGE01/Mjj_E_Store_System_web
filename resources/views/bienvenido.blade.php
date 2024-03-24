<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bienvenido</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
  
  <link rel="stylesheet" href="{{ asset('css/styles2.css') }}"> 


</head>
<body>
   <div class="container">
      <aside>
           
         <div class="top">
           <div class="logo">
             <h2>Mjj<span class="danger">Store</span> </h2>
           </div>
           <div class="close" id="close_btn">
            <span class="material-symbols-sharp">
              close
              </span>
           </div>
         </div>
         <!-- end top -->
          <div class="sidebar">

        <a href="#" onclick="loadDashboard()">
              <span class="material-symbols-sharp">grid_view </span>
              <h3>Dashbord</h3>


              <a href="#" onclick="loadUsuario()">
    <span class="material-symbols-sharp">person_outline </span>
    <h3>Usuario</h3>
</a>

<a href="#" onclick="loadInventario()" class="active">
    <span class="material-symbols-sharp">insights </span>
    <h3>Inventario</h3>
</a>

       
<a href="#" onclick="loadProductos()">
    <span class="material-symbols-sharp">receipt_long </span>
    <h3>Productos</h3>
</a>

          <!--  <a href="#">
              <span class="material-symbols-sharp">report_gmailerrorred </span>
              <h3>Reports</h3>
           </a>
           <a href="#">
              <span class="material-symbols-sharp">settings </span>
              <h3>settings</h3>
           </a>
           <a href="#">
              <span class="material-symbols-sharp">add </span>
              <h3>Add Product</h3>
           </a>-->
           <a href="#">
              <span class="material-symbols-sharp">logout </span>
              <h3>Salir</h3>
           </a>
             


          </div>

      </aside>
      <!-- --------------
        end asid
      -------------------- -->

      <!-- --------------
        start main part
      --------------- -->

      <main id="main-content">
           <h1>Bienvenido!!</h1>

           <div class="date">
             <input type="date" >
           </div>

        <div class="insights">

           <!-- start seling -->
            
           <!-- end seling -->
              <!-- start expenses -->
             
            
           

      </main>
      <!------------------
         end main
        ------------------->

      <!----------------
        start right main 
      ---------------------->
    <div class="right">

<div class="top">
   <button id="menu_bar">
     <span class="material-symbols-sharp">menu</span>
   </button>

   <div class="theme-toggler">
     <span class="material-symbols-sharp active">light_mode</span>
     <span class="material-symbols-sharp">dark_mode</span>
   </div>
    <div class="profile">
       <div class="info">
           <p><b>Babar</b></p>
           <p>josue</p>
           <small class="text-muted"></small>
       </div>
       <div class="profile-photo">
         <img src="./images/profile-1.jpg" alt=""/>
       </div>
    </div>
</div>

  

<script>
      const sideMenu = document.querySelector('aside');
      const menuBtn = document.querySelector('#menu_bar');
      const closeBtn = document.querySelector('#close_btn');
      const themeToggler = document.querySelector('.theme-toggler');

      menuBtn.addEventListener('click',()=>{
             sideMenu.style.display = "block";
      });

      closeBtn.addEventListener('click',()=>{
          sideMenu.style.display = "none";
      });

      themeToggler.addEventListener('click',()=>{
           document.body.classList.toggle('dark-theme-variables');
           themeToggler.querySelector('span:nth-child(1)').classList.toggle('active');
           themeToggler.querySelector('span:nth-child(2)').classList.toggle('active');
      });

      function loadDashboard() {
          // Realizar petición AJAX a la ruta de Laravel que corresponde al dashboard
          fetch("{{ route('dashboard') }}")
            .then(response => response.text())
            .then(html => {
              // Insertar el contenido del dashboard dentro del elemento <main>
              document.getElementById('main-content').innerHTML = html;
            })
            .catch(error => console.error('Error:', error));

      }

      function loadUsuario() {
    // Realizar petición AJAX a la ruta de Laravel que corresponde a la página de usuario
    fetch("{{ route('usuario') }}")
        .then(response => response.text())
        .then(html => {
            // Insertar el contenido de la página de usuario dentro del elemento <main>
            document.getElementById('main-content').innerHTML = html;
        })
        .catch(error => console.error('Error:', error));
        
      }

      function loadInventario() {
        // Realizar petición AJAX a la ruta de Laravel que corresponde al inventario
        fetch("{{ route('inventario') }}")
            .then(response => response.text())
            .then(html => {
                // Insertar el contenido del inventario dentro del elemento <main>
                document.getElementById('main-content').innerHTML = html;
            })
            .catch(error => console.error('Error:', error));
    }
    function loadProductos() {
        // Realizar petición AJAX a la ruta de Laravel que corresponde a la página de productos
        fetch("{{ route('producto') }}")
            .then(response => response.text())
            .then(html => {
                // Insertar el contenido de la página de productos dentro del elemento <main>
                document.getElementById('main-content').innerHTML = html;
            })
            .catch(error => console.error('Error:', error));
    }

   </script>
   </div>



   <script src="script.js"></script>
</body>
</html>
