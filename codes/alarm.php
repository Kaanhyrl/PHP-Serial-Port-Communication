<style>
    body {
      background-color: gray;
    }
    .header {
      background-color: red;
      color: white;
      font-size: 24px;
      padding: 10px;
    }
    .table {
      border-collapse: collapse;
      width: 80%;
      margin: 20px auto;
    }
    .table th {
      border: 1px solid black;
      padding: 10px;
      text-align: left;
    }
    .table td {
      border: 1px solid black;
      padding: 10px;
    }
    .tabs {
      display: flex;
      justify-content: center;
      margin-top: 10px;
    }
    .tab {
      border: 1px solid black;
      padding: 10px;
      cursor: pointer;
    }
    .tab.active {
      background-color: red;
      color: white;
    }
  </style>
</head>
<body>
    
  <div class="header">Aktif Alarmlar</div>
  <table class="table">
    <tr>
      <th>Alarm ID</th>
      <th>Alarm durum</th>
    </tr>
    <!-- Buraya tablo verilerini ekleyin -->
  </table>
  
  <script>
    // Buraya JavaScript kodunuzu ekleyin
    function selectTab(tabName) {
      // Tüm sekmeleri pasif yapın
      var tabs = document.getElementsByClassName("tab");
      for (var i = 0; i < tabs.length; i++) {
        tabs[i].classList.remove("active");
      }
      // Seçilen sekmeyi aktif yapın
      var tab = document.querySelector(".tab[onclick=\"selectTab('" + tabName + "')\"]");
      tab.classList.add("active");
      // Seçilen sekmeye göre web sayfasını güncelleyin
      // Örneğin, tablo verilerini değiştirin veya farklı bir sayfaya yönlendirin
    }
  </script>