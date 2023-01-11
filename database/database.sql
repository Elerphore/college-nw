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

insert into
    posts (title, description, user_id)
values
    ('Lorem ipsum dolor sit amet', 'ultricies nulla. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam eget enim nunc. Suspendisse et leo faucibus, interdum urna eget, ullamcorper dolor. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Morbi convallis arcu id purus convallis', 1),
    ('turpis, et rutrum', 'uris aliquet varius. Integer nibh eros, facilisis non placerat at, viverra non mi. Integer ut sapien finibus, ornare ex non, congue orci. Nullam venenatis elit libero, nec efficitur arcu matt', 1),
    ('turpis, et rutrum', 'amus suscipit euismod turpis, et rutrum urna maximus sed. Morbi justo est, lobortis sit amet luctus id, molestie ut ligula. Fusce egestas a mi quis finibus. Vestibulum con', 2),
    ('convallis ex vitae libero imperdiet ', 'us et magnis dis parturient montes, nascetur ridiculus mus. Nullam eget enim nunc. Suspendisse et leo faucibus, interdum urna eget, ullamcorper dolor. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Morbi convallis arcu id purus convallis semper.', 2);

CREATE TABLE comments (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id INT not null,
    post_id INT not null,
    text VARCHAR(100),

    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE
);

insert into
    comments (user_id, post_id, text)
values
    (1, 1, 'Какой отличный и замечательный пост'),
    (1, 2, 'Ну этот пост не такой крутой конечно');

CREATE TABLE users_posts (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id INT not null,
    post_id INT not null,
    type varchar(10),

    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE
);
