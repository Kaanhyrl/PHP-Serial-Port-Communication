<!DOCTYPE html>
<html lang="tr">

<head>
  
  <link href="style.css" type="text/css" rel="stylesheet">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="pages/style.css">
  
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="node_modules/code.jquery.com_jquery-3.7.0.min.js"></script>

  <script>
    function pageload(page) {
      const sidPort = localStorage.getItem('ssPort');
      if (sidPort != 0 && sidPort != null) {
        connectButton.style.display = 'none';
        refreshButton.style.display = 'none';
        sselect.style.display = 'none';
        ports.style.display = 'block';
        disconnectButton.style.display = 'block';
        ports.innerHTML = "Port-" + sidPort;
        const portTooltip = document.getElementById('portTooltip');
        portTooltip.setAttribute('data-page', 'anasayfa');
        
      }
    }
  </script>
  <script>
  function logout() {
    localStorage.removeItem('ssPort');
    location.reload();
  }
</script>
<body class="container" onload="pageload('<?= $_GET['sayfa']; ?>');">
  <div class="sidebar">
    <div class="logo-details">
      <i class='bx bxl-c-plus-plus icon'></i>
      <div class="logo_name">Kaan Hayırlı</div>
      <i class='bx bx-menu' id="btn"></i>
    </div> 
 
    <ul class="nav-list">
      
        <li>
        <a id="anasayfa" href="?sayfa=anasayfa">
          <i class='bx bx-home-alt'></i>
          <span class="links_name">Anasayfa</span>
          </a>
          <span class="tooltip">Anasayfa</span>
      </li>
      <li>
        <a href="?sayfa=mesaj">
          <i class='bx bx-chat'></i>
          <span class="links_name">Haberleşme</span>
        </a>
        <span class="tooltip">Haberleşme</span>
      </li>
      <li>
        <a href="?sayfa=alarm">
          <i class='bx bx-broadcast'></i>
          <span class="links_name">Alarm</span>
        </a>
        <span class="tooltip">Alarm</span>
      </li>
      <li>
        <a href="?sayfa=maps">
          <i class='bx bx-map'></i>
          <span class="links_name">GPS</span>
        </a>
        <span class="tooltip">GPS</span>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-cog'></i>
          <span class="links_name">Setting</span>
        </a>
        <span class="tooltip">Setting</span>
      </li>
      <li class="profile">
      <div class="profile-details">
          <div class="name" id="connectedComportName"><script>  const connectedPort = localStorage.getItem('ssPort'); const id = document.getElementById('connectedComportName'); id.textContent = connectedPort; </script></div>
      </div>
        <i class='bx bx-log-out' id="log_out" onclick="logout()" title="Çıkış"></i>
        <span class="tooltip" id="portTooltip" data-page="anasayfa"></span>
      </li>
</div>

    </ul>
  </div>
  <section class="home-section">
    <div class="text">Anasayfa</div>

  <!-- Port Selection -->
  <?php
  $get = $_GET["sayfa"];

  if ($get == "maps") {

    include "maps.php";

  } else if ($get == "alarm") {

    include "alarm.php";

  } else if ($get == "mesaj") {

    include "mesaj.php";

  } else if ($get == "ayarlar") {

    include "ayarlar.php";

  } else {
    ?>
    
        <div class="container mt-3">
          
          <select id="sselect" class="form-select form-select-md mb-3 btn btn-warning"
            style="float:left;width:150px;margin-left:10px;" onchange="selected(this.value); ">
            <option value="" selected disabled>Port Seçiniz</option>
          </select>
          <div class="btn btn-success" id="ports" style="float:left;width:150px;margin-left:10px;display:none;">&nbsp;</div>
          <button class="btn btn-success" type="button" id="connect-button" style="float:left;margin-left:10px;">
            <img src="img/connect.png" height="20px" width="20px">
          </button>
          <button class="btn btn-primary" type="button" id="refresh-button" style="float:left;margin-left:10px;"
            onclick="fetchAndPopulatePorts()">
            <img src="img/update.png" height="20px" width="20px">
          </button>
          <button class="btn btn-danger" type="button" id="disconnect-button"
            style="float:left;margin-left:10px;display:none;">
            <img src="img/notconnect.png" height="20px" width="20px">
          </button>
        </div>
        
        <?php
        
      }?>
      
</section>

  <script>
    
    var sid;

    function selected(id) {
      sid = id;
    }
    
    const ports = document.querySelector('#ports');
    const sselect = document.querySelector('#sselect');
    const dropdownButton = document.querySelector('#dropdown-button');
    const dropdownItems = document.querySelectorAll('.dropdown-item');
    const connectButton = document.querySelector('#connect-button');
    const disconnectButton = document.querySelector('#disconnect-button');
    const denemeButton = document.querySelector('#deneme');
    let selectedPort = '';
    dropdownItems.forEach((item) => {
      item.addEventListener('click', (event) => {
        selectedPort = event.target.textContent;
        dropdownButton.textContent = selectedPort;
        connectButton.disabled = false;
      });
    });
    const refreshButton = document.querySelector('#refresh-button');
    refreshButton.addEventListener('click', () => {
      // Reset the port selection
      dropdownButton.textContent = 'Port Seçiniz';
      // Add your code here to search for a new port
      // ...
      
    });
    connectButton.addEventListener('click', () => {
      if (sid != "Port Seçiniz" && sid != undefined && sid != 0) {
        alert(sid + ' bağlandı!');
        localStorage.setItem('ssPort', sid);
        connectButton.style.display = 'none';
        refreshButton.style.display = 'none';
        sselect.style.display = 'none';
        ports.style.display = 'block';
        disconnectButton.style.display = 'block';
        ports.innerHTML = "Port-" + sid;
      }
      else { alert("Lütfen Port Seçiniz!"); }
    });
    disconnectButton.addEventListener('click', () => {
    const sidDC = localStorage.getItem('ssPort');
    
    logout();
  });
  function logout() {
  const connectedPort = localStorage.getItem('ssPort');
  if (connectedPort && connectedPort !== '0') {
    alert(connectedPort + ' bağlantısı kesildi!');
  } else {
    alert('Bağlantı yok!');
  }

  localStorage.removeItem('ssPort');
  const portTooltip = document.getElementById('portTooltip');
  const nextPage = portTooltip.getAttribute('data-page');
  if (nextPage === 'anasayfa') {
    window.location.href = '?sayfa=anasayfa';
  } else {
    // Add handling for other pages if needed.
  }
}
  </script>
  <script>
    
    // Function to check if a selected port exists in cookies or local storage
    function getSelectedPort() {
      return localStorage.getItem('selectedPort');
    }
    // Function to populate the dropdown with the available ports
    function populateDropdown(ports) {
      const sselect = document.querySelector('#sselect');
      ports.forEach((port) => {
        const option = document.createElement('option');
        option.textContent = port;
        sselect.appendChild(option);
      });
    }
    // Function to fetch available ports from the server and populate the dropdown
    function fetchAndPopulatePorts() {
      fetch('get_ports.php')
        .then((response) => response.json())
        .then((data) => {
          const sselect = document.querySelector('#sselect');
          sselect.innerHTML = '<option selected>Port Seçiniz</option>'; // Clear existing options
          populateDropdown(data); // Populate with the new data
        })
        .catch((error) => {
          console.error('Error fetching ports:', error);
        });
    }
    // Call the function on page load to populate the dropdown
    fetchAndPopulatePorts();
  </script>
  <script>
    let sidebar = document.querySelector(".sidebar");
    let closeBtn = document.querySelector("#btn");
    let searchBtn = document.querySelector(".bx-search");
    closeBtn.addEventListener("click", () => {
      sidebar.classList.toggle("open");
      menuBtnChange();//calling the function(optional)
    });
    searchBtn.addEventListener("click", () => { // Sidebar open when you click on the search iocn
      sidebar.classList.toggle("open");
      menuBtnChange(); //calling the function(optional)
    });
    // following are the code to change sidebar button(optional)
    function menuBtnChange() {
      if (sidebar.classList.contains("open")) {
        closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");//replacing the iocns class
      } else {
        closeBtn.classList.replace("bx-menu-alt-right", "bx-menu");//replacing the iocns class
      }
    }
  </script>
  <script>
    
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="node_modules/code.jquery.com_jquery-3.7.0.min.js">
  </script>
</body>

</html>