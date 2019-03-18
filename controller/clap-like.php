<?php

if ($_SESSION['logged']['state']) {

    $userId = (int)$_SESSION['logged']['user']->id;

    $req = $db->prepare('SELECT * FROM liked_entities WHERE id_entity=:entityId AND id_user=:userId AND entity_type=:entityType');

    $req->execute([
        'entityId' => $entityId,
        'userId' => $userId,
        'entityType' => $entityType
    ]);

    $isLiked = $req->fetch();

    if (!$isLiked) {
        $like = $db->prepare('INSERT INTO liked_entities (id_entity, id_user, entity_type) VALUES (:entityId, :userId, :entityType)');

        $like->execute([
            'entityId' => $entityId,
            'userId' => $userId,
            'entityType' => $entityType
        ]);
    } else {
        $unlike = $db->prepare('DELETE FROM liked_entities WHERE id_entity=:entityId AND id_user=:userId AND entity_type=:entityType');

        $unlike->execute([
            'entityId' => $entityId,
            'userId' => $userId,
            'entityType' => $entityType
        ]);
    }
}

header('Location: '.$_SERVER['HTTP_REFERER']);