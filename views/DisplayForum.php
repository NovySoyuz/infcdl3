<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
    <link rel="stylesheet" href="../web/css/DisplayForum.css">
</head>

<?php
        
        if (isset($_SESSION['userId'])) {
        ?>
          <li class="nav-item">
            <a class="nav-link" href="?action=logout" role="button">Logout</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="?action=newMsg" role="button">Ajouter commentaire</a>
          </li>
        <?php
        } else {
        ?>
          <li class="nav-item">
            <a class="nav-link" href="?action=login" role="button">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?action=register" role="button">Sign Up</a>
          </li>
        <?php
        }
        echo "<table>";
        echo "<thead><tr><th>Pseudo</th><th>Content</th><th>Posted_at</th></tr></thead>";
        echo "<tbody>";

        foreach ($commentaries as $commentary) {
          echo "<tr>";
            echo "<td>" . $commentary['pseudo'] . "</td>";
            echo "<td>" . $commentary['content'] . "</td>";
            echo "<td>" . $commentary['created_at'] . "</td>";
          echo "</tr>";
      }
      echo "</tbody>";
      echo "</table>";

        ?>