drop table if exists members;
drop table if exists books;
drop table if exists borrow_records;

create table books (
    book_id int primary key auto_increment,
    ISBN varchar(10) not null,
    book_name varchar(50) not null,
    category varchar(20) not null
);

create table members (
    member_id int primary key auto_increment,
    first_name varchar(50) not null,
    last_name varchar(50) not null,
    phone_number varchar(55) not null
);

create table borrow_records (
    borrow_id char(10) primary key default (UUID()),
    borrower_id int not null,
    borrowed_book_id int not null,
    borrow_timestamp timestamp default current_timestamp,

    foreign key (borrower_id) references members(member_id),
    foreign key (borrowed_book_id) references books(book_id)
);

insert into members (first_name, last_name, phone_number)
values
    ("Tuan", "Nguyen", "0284629845"),
    ("Khanh", "Phan", "0914729833"),
    ("Quang", "Nguyen", "034819991"),
    ("Bach", "Trinh", "0177724810");

insert into books (ISBN, book_name, category)
values
    ("978-3-16-148410-0", "Doraemon", "manga"),
    ("978-0-545-01022-1", "Harry Potter and the Prisioner of Azkaban", "adventure"),
    ("978-1-60309-501-3", "Harry Potter and the Globet of Fire", "adventure"),
    ("978-1-4028-9462-6", "Harry Potter and the Order Of Phoenix", "advanture"),
    ("979-8-88888-000-7", "Harry Potter and the Deadly Hallows", "adventure");

insert into borrow_records (borrower_id, borrowed_book_id)
values
    (1, 2),
    (2, 3),
    (4, 5),
    (1, 4);