drop table if exists employee;

create table employee (
    employee_id char(20) primary key default (UUID()),
    first_name varchar(55) not null,
    last_name varchar(55) not null,
    age int not null,
    address varchar(100) not null,
    phone_number varchar(55) not null,
    department enum("IT", "Operation", "Engineering", "Marketing"),
    hired_date date not null,
    salary decimal(15, 2)
);

insert into employee (first_name, last_name, age, address, phone_number, department, hired_date, salary)
values
    ("Tuan", "Nguyen", 22, "Hanoi", "0913289881", "Engineering", "2026-09-03", 18000000),
    ("Khanh", "Phan", 21, "Hanoi", "0248873234", "Engineering", "2026-11-04", 17900000),
    ("Quang", "Le", 22, "Hanoi", "0912114566", "Operation", "2026-12-01", 16900000);