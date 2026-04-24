create table books (
    id int auto_increment primary key,
    title varchar(55) not null,
    author varchar(55) not null,
    public_year date not null default current_date,
    copies int default 0 not null
);

insert into books (title, author, public_year, copies)
values
    ("The Alchemist", "Paulo Coelho", "1988-01-01", 5),
    ("The Little Prince", "Antoine de Saint-Exupery", "1943-04-06", 3),
    ("The Da Vinci Code", "Dan Brown", "2003-03-18", 7),
    ("Harry Potter and the Philosopher's Stone", "J. K. Rowling", "1997-06-26", 10),
    ("And Then There Were None", "Agatha Christie", "1939-11-06", 4),
    ("The Hobbit", "J. R. R. Tolkien", "1937-09-21", 6),
    ("To Kill a Mockingbrid", "Harper Lee", "1960-07-11", 8),
    ("The Catcher in the Rye", "J. D. Salinger", "1951-07-16", 5),
    ("The Great Gatsby", "F. Scott Fitzgerald", "1925-04-10", 3),
    ("One Hundred Years of Solitude", "Gabriel Garcia Marquez", "1967-05-30", 4);