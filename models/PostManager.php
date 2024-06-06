<?php

include "../models/PDO.php";

function PostCommentary($userId, $content)
{
    global $PDO;
    $sql = "INSERT INTO post (id_user, content) VALUES (:id_user, :content)";
    $pdo_prepare = $PDO->prepare($sql);
    $pdo_execute = $pdo_prepare->execute(['id_user' => $userId, 'content' => $content]);
    return $pdo_execute;
}

function GetAllCommentary()
{
    global $PDO;
    $sql =  'select post.*, user.pseudo
                    from post
                    inner join user on post.id_user = user.id_user
                    ORDER BY created_at DESC';
    $pdo_prepare = $PDO->prepare($sql);
    $pdo_prepare->execute();
    return $pdo_prepare->fetchall();
}

function ModifyCommentaryByAdmin($content, $id_post)
{
    global $PDO;
    $sql = "UPDATE post SET content = :content WHERE id_post = :id_post";
    $pdo_prepare = $PDO->prepare($sql);
    $pdo_execute = $pdo_prepare->execute([':content' => $content, ':id_post' => $id_post]);

    return $pdo_execute;
}

function SuppresCommentaryByAdmin($id_post)
{
    global $PDO;
    $sql = "DELETE FROM post WHERE id_post = :id_post";
    $pdo_prepare = $PDO->prepare($sql);
    $pdo_execute = $pdo_prepare->execute([':id_post' => $id_post]);
    return $pdo_execute;
}
