<?php
/* 首先建立表： */
CREATE TABLE posts (
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(50),
text TEXT,
modified DATETIME DEFAULT NULL
);
/* 添加一些简单文章 */
INSERT INTO posts (title,text , modified)
VALUES ('The title', 'This is the post body.', NOW());
INSERT INTO posts (title, text, modified)
VALUES ('A title once again', 'And the post body follows.', NOW());
INSERT INTO posts (title, text, modified)
VALUES ('Title strikes back', 'This is really exciting! Not.', NOW());
?>