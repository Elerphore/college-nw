create database news;

use news;

CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    role varchar(20),
    password VARCHAR(40) NOT NULL
);

insert into
    users (username, role, password)
values
    ('admin', 'admin', 'admin'),
    ('user', 'user', 'user');

CREATE TABLE posts (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    description VARCHAR(400) NOT NULL,
    user_id int not null,

    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE comments (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id INT not null,
    post_id INT not null,
    text VARCHAR(100),

    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE
);

CREATE TABLE users_posts (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id INT not null,
    post_id INT not null,
    type varchar(10),

    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE
);

drop table comments;
drop table posts;

delete from users_posts;

select * from posts;
select * from users;
