drop table if exists users;
drop table if exists categories;
drop table if exists posts;
drop table if exists comments;

create table users (
    user_id char(36) primary key default (UUID()),
    username varchar(100) unique not null,
    email varchar(100) unique not null,
    role enum('user', 'admin'),
    created_at timestamp default current_timestamp
);

create table categories (
    category_id char(36) primary key default (UUID()),
    name varchar(50) unique
);

create table posts (
    post_id char(36) primary key default (UUID()),
    author_id char(36) not null,
    category_id char(36) not null,
    content varchar(100) not null,

    foreign key (author_id) references users(user_id),
    foreign key (category_id) references categories(category_id)
);

create table comments (
    comment_id char(36) primary key default (UUID()),
    content text,
    post_id char(36) not null,
    user_id char(36) not null,
    parent_comment_id char(36),

    foreign key (post_id) references posts(post_id) on delete cascade,
    foreign key (user_id) references users(user_id) on delete cascade,
    foreign key (parent_comment_id) references comments(comment_id) on delete cascade 
);

insert into users (username, email, role)
values
    ("dcm1", "dcm1@gmail.com", "user"),
    ("vcl1", "vcl1@gmail.com", "admin"),
    ("dkm", "dkmvlkl@yahoo.com", "admin"),
    ("cc", "cc@icloud.com", "user");

insert into categories (name) 
values 
    ("angehao"),
    ("bdsm"),
    ("ntr"),
    ("blowjob");

insert into posts (author_id, category_id, content)
values 
    ("0dc72020-1b92-11f1-a66a-00155d33a1fb", "0dcbc5be-1b92-11f1-a66a-00155d33a1fb", "vcl mup rup");

insert into comments (content, post_id, user_id)
values 
    ("3=D", "8cde0d07-1b92-11f1-a66a-00155d33a1fb", "0dc721a7-1b92-11f1-a66a-00155d33a1fb");

insert into comments (content, post_id, user_id, parent_comment_id)
values 
    ("sdasdad", "8cde0d07-1b92-11f1-a66a-00155d33a1fb", "0dc72020-1b92-11f1-a66a-00155d33a1fb", "d528e750-1b93-11f1-a66a-00155d33a1fb");