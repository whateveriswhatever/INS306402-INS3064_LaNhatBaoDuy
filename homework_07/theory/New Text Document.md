##### Part 1: Theory Warmup

1. When a record in the left table has no matching record in the right table:
   - LEFT-JOIN: will leave the data column at the unmatched column with null value
   - INNER-JOIN: only selects data rows that are matched between two tables via primary key and foreign key

2\. The primary utilization of HAVING clause is only being used as a data-filter with combination of using aggregated functions such as COUNT, SUM,... The main idea of using WHERE for querying data at row-level, but using HAVING can query data at group-level after the computer having grouped data via conditions with typical aggregated functions like COUNT, SUM,...

3\. PDO (PHP Data Object) is a database access layer in PHP that provides a consistent interface for interacting with different databases. MySQLi stands for MySQL Improved, it's a PHP extension designed and geared toward interaction with MySQL databases (and compatible with MariaDB). Two advantages that PDO has over MySQLi are: database flexibility (PDO can work with many databases but MySQLi only works with MySQL), consistent API (PDO provides a uniform interface regardless of the database, but MySQLi is tied to MySQL-specific feature and syntax), portability \& scalability (PDO is better in building frameworks, writing reusable libraries, planning for future database changes)

| Feature             | PDO                | MySQLi          |
| ------------------- | ------------------ | --------------- |
| Database support    | Multiple DBs       | MySQL only      |
| Prepared statements | Named + positional | Positional only |
| API style           | Consistent         | MySQL-oriented  |
| Flexibility         | High               | Medium          |
| Error handling      | Exception based    | Medium          |

4\. Prepared statements ensure that user input never gets interpreted as SQL code. Thinking of SQL like a form template, prepared statement is "fill in the blank", string concatenation -> "let user rewrite the form". Prepared statements do not protect against logical flaws in the query nor poor authorization checks, but they do protect against SQL injection via user input because: SQL structure is fixed first, user input is bound later, and input is always treated as data, never executable SQL.

5\. In a SQL query contains WHERE, GROUP BY, and HAVING clause such as:

SELECT

&#x09;SUM(accolades) as "total accolades"

FROM students

WHERE gender = "female"

GROUP BY subject

ORDER BY SUM(accolades) DESC

HAVING COUNT(\*) >= 5;

- Firstly, the query will select data, specifically the total number of accolades via "accolades" column from the "students" table
- Secondly, the query only looks for data rows that the "gender" field points to female student
- Thirdly, it turns queried data rows into each distinct groups, each group contains multiple records with differently unique values of "subject" field
- After that, in each data group, data rows will be sorted and displayed in descending order. The location of each group in the data table are being docked arbitrarily, normally they are displayed in alphabetical order.
- Lastly, in each data group, we only want see top 5 students whom have the highest academic records.

##### Part 2: SQL Lab - The Data Detective

###### 2.1. Task 1: Product Catalog with Categories

###### SELECT

###### &#x09;p.\*

###### &#x09;c.category_name

###### FROM products p

###### LEFT JOIN categories c ON p.category_id = c.id;

######

###### 2.2. Task 2: Revenue Analysis by Category

SELECT

&#x09;ot.id,

&#x09;p.name,

&#x09;c.category_name,

&#x09;o.order_date,

&#x09;ot.quantity,

&#x09;(p.price \* ot.quantity) as revenue

FROM order_items ot

LEFT JOIN products p ON ot.product_id = p.id

LEFT JOIN orders o ON ot.order_id = o.id

LEFT JOIN categories c ON p.category_id = c.id

GROUP BY c.name;

###### 2.23. Task 3: VIP Customers

SELECT

&#x09;u.name,

&#x09;u.email,

&#x09;o.id,

&#x09;ot.quantity \* ot.unit_price

FROM users

INNER JOIN orders o ON u.id = o.user_id

LEFT JOIN order_items ot ON u.id = ot.user_id

GROUP BY u.email

HAVING COUNT(\*) >= 3;

&#x09;
