<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title><?= $title ?? 'Aplikasi Kasir' ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
  <?= $this->renderSection('content') ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
