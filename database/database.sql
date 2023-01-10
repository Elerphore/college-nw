create database news;

use news;

CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(40) NOT NULL
);

insert into users () values ();

CREATE TABLE posts (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    description VARCHAR(400) NOT NULL,
    user_id int not null,

    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE comments (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id INT not null,
    post_id INT not null,
    text VARCHAR(100),

    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (post_id) REFERENCES posts(id)
);

drop table comments;
drop table posts;
