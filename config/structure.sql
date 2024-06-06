CREATE DATABASE infcdl3;

USE infcdl3;

CREATE TABLE user (
  id_user int PRIMARY KEY AUTO_INCREMENT,
  created_at datetime NOT NULL DEFAULT now(),
  pseudo varchar(255) NOT NULL,
  password varchar(255) NOT NULL,
  is_admin TINYINT(1) NOT NULL
);

CREATE TABLE post (
  id_post int PRIMARY KEY AUTO_INCREMENT,
  created_at datetime NOT NULL DEFAULT now(),
  id_user int NOT NULL,
  FOREIGN KEY(id_user) REFERENCES user(id_user),
  content mediumtext NOT NULL
);
