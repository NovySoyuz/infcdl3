<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tableau de bord</title>
  <link rel="stylesheet" href="../web/css/DisplayForum.css">
  <script src="../web/js/scripts.js"></script>
</head>

<body>

  <nav>
    <ul>
      <?php if (isset($_SESSION['userId'])) : ?>
        <li class="nav-item">
          <a class="nav-link" href="?action=logout" role="button">Logout</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?action=newMsg" role="button">Ajouter commentaire</a>
        </li>
      <?php else : ?>
        <li class="nav-item">
          <a class="nav-link" href="?action=login" role="button">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?action=register" role="button">Sign Up</a>
        </li>
      <?php endif; ?>
    </ul>
  </nav>

  <table>
    <thead>
      <tr>
        <th>Pseudo</th>
        <th>Content</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($commentaries as $commentary) : ?>
        <tr>
          <td><?php
              echo htmlspecialchars($commentary['pseudo']); ?></td> <!-- Prevenir attaque sql -->
          <td><?php echo htmlspecialchars($commentary['content']); ?></td>
          <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1 || isset($_SESSION['userId']) && $_SESSION['userId'] == $commentary['id_user']) : ?>
            <td><a class="nav-link" href="?action=modifyMsg&id_post=<?php echo urlencode($commentary['id_post']); ?>&content=<?php echo urlencode($commentary['content']); ?>" role="button">modify</a></td>
            <td><a class="nav-link" href="?action=deleteMsg&id_post=<?php echo urlencode($commentary['id_post']); ?>" onclick="return confirmDeletion();" role="button">supprimer</a></td>
          <?php endif; ?>
        </tr>
      <?php endforeach; ?>
      <?php
      if (isset($errorMsg)) {
        echo "<div class='alert-warning'>$errorMsg</div>";
      }
      ?>
    </tbody>
  </table>

</body>

</html>