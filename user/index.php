<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="../style/style.css">
  <link rel="stylesheet" href="../style/aos.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" />
  <title>Aplikasi Pemesanan Makanan</title>
</head>
<body>
  <div class="container text-center">
    <h1>Makan ditempat atau dibawa pulang?</h1>
    <div class="grid">
      <div class="grid-item">
        <a href="dinein.php" style="text-decoration: none; color: black;">
          <div class="image-container" data-aos="zoom-in-right">
            <img src="../admin/images/dinein.jpg" alt="Dine In">
            <b class="overlay">Dine in</b>
          </div>
        </a>
      </div>
      <div class="grid-item">
        <a href="takeaway.php" style="text-decoration: none; color: black;">
          <div class="image-container tw" data-aos-delay="150" data-aos="zoom-in-left">
            <img src="../admin/images/takeaway.png" alt="Takeaway">
            <b class="overlay">Takeaway</b>
          </div>
        </a>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="../style/aos.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
</body>
</html>
