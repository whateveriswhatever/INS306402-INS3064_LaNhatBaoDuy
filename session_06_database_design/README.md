##### Part 1: Normalization

###### Task 1: Identify Violation

* These columns such as CourseID, CourseName, ProfessorName, ProfessorEmail, Grade lead to redundancy. According to normalization theory, each table should only have one functionality (3NF). In this primary table, it contains 3 types of information are student, the enrolled courses, professor who teaches that course and the grade that student got for that courses.
* Because, at professor's details, the email of each professor is unique to each others. Therefore, the ProfessorEmail column is depend on the ProfessorName column or vice versa. Moreover, a lecturer can be expected to instruct more than 1 course, so if in that situation, the CourseName column was changed, then the instructor's name at ProfessorName column would not be changed.
* Yes, there are 3 transitive dependencies:

  * StudentName column depends on StudentID column - which is primary key
  * CourseName column depends on CourseID column
  * ProfessorEmail column relies on ProfessorName column or vice versa
  * Grade column is contingent on CourseID column



###### Task 2: Decompose to 3NF

* We will transform the original table into 4 different tables, each one should only behave for one function. These tables are: Students, Courses, Professors, Enrollments.
* Students:

| Table Name | Primary Key | Foreign Key | Normal Form | Description |

| Students | StudentID | None| 3NF | Stores student information|

| Courses | CourseID | None | 3NF | Stores course details |

| Professors | ProfessorID | None | 3NF | Holds instructor's data | 

| Enrollments | EnrollmentID | StudentID, CourseID, ProfessorID | 3NF | Course enrollment of students |



##### Part 2: Relationship Drills

1. ###### Author - Book

Relationship type: Many-to-Many (A person can be the author of many books and a book can be written by more than 1 writers)

FK location: BookID, AuthorID

###### 2\. Citizen - Passport

Relationship type: One-to-Many (A person can have multiple passports due to his/her nationalities; But an passport is designed to only one person)

FK location: CitizenID in Passport table references to CitizenID in Citizen table

###### 3\. Customer - Order

Relationship type: One-to-Many (A customer goes into a supermarket to buy groceries, and he/she can go shopping multiples during the day, each time can be considered to be 1 order. Each order should only be recorded by one buyer who paid for the bill)

FK location: CustomerID in Order table references to CustomerID in Customer table

###### 4\. Student - Class

Relationship type: Many-to-Many (A student can take more than one class, and multiple students can study in that class)

FK location: Created an transitive table that is called Enrollments. It will contain 2 foreign key: StudentID refers to StudentID in Students table, and ClassID refers to ClassID in Classes table

###### 5\. Team - Player

Relationship type: One-to-Many (A team is a group of multiple players but a player can only legally play for one team at the same time)

FK location: TeamID column in table Players references to TeamID (PK) in table Teams



