Create Table Supplier(
    SupplierID int not null,
    Organization varchar(255),
    Sname varchar(255),
    Primary Key (SupplierID)
);
CREATE TABLE Books(
    ISBN varchar(255) not null,
    Title varchar(255) not null,
    PublicationDate date,
    UserReviews varchar(255),
    Price decimal(10,2) not null, 
    SupplierID int not null,
    Primary Key(ISBN),
    Foreign Key(SupplierID) 
	references Supplier(SupplierID)
	on delete cascade
);
Create Table Book_Categories(
    CategoryCode int,
    CategoryDescription varchar(255),
    Primary Key(CategoryCode)
);
Create Table Supplier_Rep(
    ID int not null,
    FirstName varchar(255),
    LastName varchar(255),
    WorkNumber int(10),
    CellNumber int(10),
    Email varchar(255),
    SupplierID int,
    Primary Key (ID),
    Foreign Key (SupplierID) 
	references Supplier(SupplierID)
	on delete cascade
);
Create Table Author(
    AuthorID int not null AUTO_INCREMENT,
    DateOfBirth date,
    Gender varchar(1),
    FirstName varchar(255),
    LastName varchar(255),
    ContactID int not null,
    Primary Key (AuthorID),
    Foreign Key (ContactID) 
	references Contact_Details(ContactID)
	on delete cascade
);
Create Table Contact_Details(
    ContactID int not null AUTO_INCREMENT,
    Primary Key (ContactID)
);
Create Table CAddress(
    PhysicalAddress varchar(255),
    ContactID int not null,
    Primary Key (ContactID, PhysicalAddress),
    Foreign Key (ContactID) 
	references Contact_Details(ContactID) 
	on delete cascade
);
Create Table Email(
    EmailAddress varchar(255),
    ContactID int not null,
    Primary Key (ContactID, EmailAddress),
    Foreign Key (ContactID) 
	references Contact_Details(ContactID)
	on delete cascade
);
Create Table Phone(
    PhoneNumber int(10),
    ContactID int not null,
    Primary Key (ContactID, PhoneNumber),
    Foreign Key (ContactID) 
	references Contact_Details(ContactID)
	on delete cascade
);
Create Table Customers(
    CustomerID int not null AUTO_INCREMENT,
    FirstName varchar(255),
    LastName varchar(255),
    ContactID int not null,
    CPassword varchar(255) not null,
    IfAdmin boolean,
    Primary Key(CustomerID),
    Foreign Key (ContactID) 
	references Contact_Details(ContactID)
	on delete cascade
);
Create Table Orders(
    OrderID int not null AUTO_INCREMENT,
    OrderValue decimal(10,2),
    OrderDate date, 
    CustomerID int not null,
    Primary Key (OrderID),
    Foreign Key (CustomerID) 
	references Customers(CustomerID)
	on delete cascade
);
Create Table Order_Items(
    ItemNumber int not null AUTO_INCREMENT,
    ItemPrice decimal(10,2),
    ISBN varchar(255) not null,
    OrderID int,
    Primary Key(ItemNumber, OrderID),
    Foreign Key (ISBN) references Books(ISBN) 
	on delete cascade,
    Foreign Key (OrderID) references Orders(OrderID)
	on delete cascade
);
Create Table Assigned_To(
    ISBN varchar(255) not null,
    CategoryCode int,
    Primary Key(ISBN, CategoryCode),
    Foreign Key (ISBN) 
	references Books(ISBN)
	on delete cascade,
    Foreign Key (CategoryCode) 
	references Book_Categories(CategoryCode)
	on delete cascade
);
Create Table Written_By(
    ISBN varchar(255) not null,
    AuthorID int not null,
    Primary Key (ISBN, AuthorID),
    Foreign Key (ISBN) 
	references Books(ISBN)
	on delete cascade,
    Foreign Key (AuthorID) 
	references Author(AuthorID)
	on delete cascade
);



insert into Supplier(SupplierID, Organization, Sname)
values(1, "Big Book Organization", "American West Books");
/* Fiction Supplier */
insert into Supplier(SupplierID, Organization, Sname)
values(2, "Big Book Organization", "Ingram Contact Books");
/* Fiction Supplier*/
insert into Supplier(SupplierID, Organization, Sname)
values(3, "Organization of Many Books", "Bella Distribution");
/* Educational Supplier */
insert into Supplier(SupplierID, Organization, Sname)
values(4, "Great Books Org.", "Casemate Group");
/* Non-Fiction Supplier */
insert into Supplier(SupplierID, Organization, Sname)
values(5, "Books Books Books Org.", "Legato Publishers Group");
/* Other */



insert into Books(ISBN, Title, PublicationDate, UserReviews, Price, SupplierID)
values("6452472079", "The Two Towers", '1954-06-29', "Sub-par entry in a sub-par fantasy series. Who can take a book seriously when the main character is named Frodo Baggins?", 14.99, 1);

insert into Books(ISBN, Title, PublicationDate, UserReviews, Price, SupplierID)
values("4484160343", "The Name of the Wind", '2007-03-27', "Pretty good fantasy series. It's like if Harry Potter was a musician and bad with money.", 29.99, 1);

insert into Books(ISBN, Title, PublicationDate, UserReviews, Price, SupplierID)
values("1540065456", "Brisingr", '2008-09-20', "An excellent installment in the Eragon series. A guide on how to raise pets.", 10.99, 1);

insert into Books(ISBN, Title, PublicationDate, UserReviews, Price, SupplierID)
values("6729318672", "The Complete Fiction of H.P. Lovecraft", '2016-06-01', "A great look into the world of the Cosmic Horror genre. Just don't think about the Author's questionable morals.", 34.95, 2);

insert into Books(ISBN, Title, PublicationDate, UserReviews, Price, SupplierID)
values("3482519521", "The King in Yellow", '1895-12-16', "A collection of short stories about a play that causes madness when seen or read. 9/10", 12.99, 2);

insert into Books(ISBN, Title, PublicationDate, UserReviews, Price, SupplierID)
values("0961019814", "Martin the Warrior", '1993-07-14', "Who doesn't like Redwall? C'mon...", 16.00, 1);

insert into Books(ISBN, Title, PublicationDate, UserReviews, Price, SupplierID)
values("5290361905", "The Dragonbone Chair", '1988-10-25', "A bit slow at first but really picks up. This series is what inspired George RR Martin's, A Song of Ice and Fire. Must read.", 15.99, 1);

insert into Books(ISBN, Title, PublicationDate, UserReviews, Price, SupplierID)
values("6783768751", "A Dream of Spring", '2020-01-06', "No reviews available yet.", 399.99, 1);

insert into Books(ISBN, Title, PublicationDate, UserReviews, Price, SupplierID)
values("0133360020", "An Inhabitant of Carcosa", '1886-12-25', "Spooky scary short story. Simply sensational.", 5.99, 2);

insert into Books(ISBN, Title, PublicationDate, UserReviews, Price, SupplierID)
values("0737579297", "50 Shades of Grey", '2011-05-20', "Gross...", 19.99, 2);

insert into Books(ISBN, Title, PublicationDate, UserReviews, Price, SupplierID)
values("9483969299", "Thus Spoke Zarathustra", '1883-10-31', "I feel like I have read this many times before. 8/10.", 39.95, 4);

insert into Books(ISBN, Title, PublicationDate, UserReviews, Price, SupplierID)
values("1146866603", "Never Cry Wolf", '2016-12-31', "Believe me I won't. 4/10", 20.99, 4);

insert into Books(ISBN, Title, PublicationDate, UserReviews, Price, SupplierID)
values("1033009966", "Hatchet", '1987-09-30', "This guy is straight up crazy yall. 10/10", 14.99, 4);

insert into Books(ISBN, Title, PublicationDate, UserReviews, Price, SupplierID)
values("9295235740", "A Hundred Pages of Dogs Barking: Don't Worry You Can't Hear It.", '1492-03-25', "Couldn't hear a thing. Great book!", 5.99, 5);

insert into Books(ISBN, Title, PublicationDate, UserReviews, Price, SupplierID)
values("1798800393", "Coffee Table Book About Coffee Tables", '1995-03-16', "Where's my coffee table? - Regis Phillbin", 14.99, 5);

insert into Books(ISBN, Title, PublicationDate, UserReviews, Price, SupplierID)
values("6916235723", "8th Edition Calculus", '2018-11-15', "I mean it's calculus no complaints here. e^x/derivative of e^x", 999.99, 3);

insert into Books(ISBN, Title, PublicationDate, UserReviews, Price, SupplierID)
values("4195143566", "Fundamentals of Database Systems", '2018-10-18', "Wow what a fantastic book. However it was a little pricy.", 12999.99, 3);

insert into Books(ISBN, Title, PublicationDate, UserReviews, Price, SupplierID)
values("9437575159", "12th Edition Botany", '2018-12-11', "Awful. 0/10.", 1.99, 3);



insert into Book_Categories(CategoryCode, CategoryDescription)
values(1, "Fiction");

insert into Book_Categories(CategoryCode, CategoryDescription)
values(3, "Education");

insert into Book_Categories(CategoryCode, CategoryDescription)
values(4, "Non-Fiction");

insert into Book_Categories(CategoryCode, CategoryDescription)
values(5, "Other");



insert into Supplier_Rep(ID, FirstName, LastName, WorkNumber, CellNumber, Email, SupplierID)
values(1, "Julia", "Stevens", '5472324062', '6519533278', "jstevens@amerwesbooks.com", 1);

insert into Supplier_Rep(ID, FirstName, LastName, WorkNumber, CellNumber, Email, SupplierID)
values(2, "Virgil", "Gonzales", '9478901532', '9990690551', "vgonzales@ingram.com", 2);

insert into Supplier_Rep(ID, FirstName, LastName, WorkNumber, CellNumber, Email, SupplierID)
values(3, "Robert", "Baratheon", '5714272126', '5173948646', "rbaratheon@belladis.com", 3);

insert into Supplier_Rep(ID, FirstName, LastName, WorkNumber, CellNumber, Email, SupplierID)
values(4, "Charlen", "Fox", '9804469335', '8574320233', "cfox@legato.com", 4);

insert into Supplier_Rep(ID, FirstName, LastName, WorkNumber, CellNumber, Email, SupplierID)
values(5, "Bryan", "Weaver", '4063538279', '8568723458', "bweaver@hotmail.com", 5);



insert into Contact_Details(ContactID)
values(1);

insert into Contact_Details(ContactID)
values(2);

insert into Contact_Details(ContactID)
values(3);

insert into Contact_Details(ContactID)
values(4);

insert into Contact_Details(ContactID)
values(5);

insert into Contact_Details(ContactID)
values(6);

insert into Contact_Details(ContactID)
values(7);

insert into Contact_Details(ContactID)
values(8);

insert into Contact_Details(ContactID)
values(9);

insert into Contact_Details(ContactID)
values(10);

insert into Contact_Details(ContactID)
values(11);



insert into Author(AuthorID, DateOfBirth, Gender, FirstName, LastName, ContactID)
values(1, '1972-12-14', "M", "Patrick", "Rothfuss", 1);

insert into Author(AuthorID, DateOfBirth, Gender, FirstName, LastName, ContactID)
values(2, '1865-08-12', "M", "Howard", "Lovecraft", 2);

insert into Author(AuthorID, DateOfBirth, Gender, FirstName, LastName, ContactID)
values(3, '1850-05-07', "F", "Betty", "White", 3);

insert into Author(AuthorID, DateOfBirth, Gender, FirstName, LastName, ContactID)
values(4, '1954-01-22', "M", "Brian", "Jaques", 4);

insert into Author(AuthorID, DateOfBirth, Gender, FirstName, LastName, ContactID)
values(5, '1990-09-14', "F", "Christina", "Paolini", 5);

insert into Author(AuthorID, DateOfBirth, Gender, FirstName, LastName, ContactID)
values(6, '1988-04-19', "F", "Jane", "Smith", 6);


insert into CAddress(PhysicalAddress, ContactID)
values("514 Galvin Road Matawan, NJ 07747", 1);

insert into CAddress(PhysicalAddress, ContactID)
values("9466 Green Hill St. Southington, CT 06489", 2);

insert into CAddress(PhysicalAddress, ContactID)
values("9498 E. Devonshire St. Mcdonough, GA 30252", 3);

insert into CAddress(PhysicalAddress, ContactID)
values("9324 Franklin Ave. Hickory, NC 28601", 4);

insert into CAddress(PhysicalAddress, ContactID)
values("53 Summit Drive Southgate, MI 48195", 5);

insert into CAddress(PhysicalAddress, ContactID)
values("38 Peg Shop Street Lakeland, FL 33801", 6);

insert into CAddress(PhysicalAddress, ContactID)
values("8829 Tanglewood St. Utica, NY 13501", 7);

insert into CAddress(PhysicalAddress, ContactID)
values("655 North Saxton Avenue Ossining, NY 10562", 8);

insert into CAddress(PhysicalAddress, ContactID)
values("9349 Brickell Street Staten Island, NY 10301", 9);

insert into CAddress(PhysicalAddress, ContactID)
values("62 W. St Margarets St. Brunswick, GA 31525", 10);

insert into CAddress(PhysicalAddress, ContactID)
values("760 South Delaware St. Lakeland, FL 33801", 11);




insert into Email(EmailAddress, ContactID)
values("proth@yahoo.com", 1);

insert into Email(EmailAddress, ContactID)
values("cxxzsdfcvluluf@yahoo.com", 2);

insert into Email(EmailAddress, ContactID)
values("bwhite@yahoo.com", 3);

insert into Email(EmailAddress, ContactID)
values("bjaques@yahoo.com", 4);

insert into Email(EmailAddress, ContactID)
values("cpaolini@yahoo.com", 5);

insert into Email(EmailAddress, ContactID)
values("jsmith@yahoo.com", 6);

insert into Email(EmailAddress, ContactID)
values("anunez@yahoo.com", 7);

insert into Email(EmailAddress, ContactID)
values("ecarter@yahoo.com", 8);

insert into Email(EmailAddress, ContactID)
values("meggbert@yahoo.com", 9);

insert into Email(EmailAddress, ContactID)
values("ppoole@yahoo.com", 10);

insert into Email(EmailAddress, ContactID)
values("cmills@yahoo.com", 11);



insert into Phone(PhoneNumber, ContactID)
values(2181969971, 1);

insert into Phone(PhoneNumber, ContactID)
values(1563296915, 2);

insert into Phone(PhoneNumber, ContactID)
values(3231692281, 3);

insert into Phone(PhoneNumber, ContactID)
values(5869105141, 4);

insert into Phone(PhoneNumber, ContactID)
values(5278572319, 5);

insert into Phone(PhoneNumber, ContactID)
values(1846905048, 6);

insert into Phone(PhoneNumber, ContactID)
values(3414704161, 7);

insert into Phone(PhoneNumber, ContactID)
values(1098160145, 8);

insert into Phone(PhoneNumber, ContactID)
values(6898951636, 9);

insert into Phone(PhoneNumber, ContactID)
values(1308395207, 10);

insert into Phone(PhoneNumber, ContactID)
values(9935587732, 11);



insert into Customers(CustomerID, FirstName, LastName, ContactID, CPassword, IfAdmin)
values(1, "Annette", "Nunez", 7, "password", FALSE);

insert into Customers(CustomerID, FirstName, LastName, ContactID, CPassword, IfAdmin)
values(2, "Elber", "Carter", 8, "12345", FALSE);

insert into Customers(CustomerID, FirstName, LastName, ContactID, CPassword, IfAdmin)
values(3, "Megan", "Eggbert", 9, "notpassword", FALSE);

insert into Customers(CustomerID, FirstName, LastName, ContactID, CPassword, IfAdmin)
values(4, "Perry", "Poole", 10, "admin1", TRUE);

insert into Customers(CustomerID, FirstName, LastName, ContactID, CPassword, IfAdmin)
values(5, "Carla", "Mills", 11, "admin2", TRUE);





insert into Orders(OrderID, OrderValue, OrderDate, CustomerID)
values(1, 14.99, '2019-10-24', 1);

insert into Orders(OrderID, OrderValue, OrderDate, CustomerID)
values(2, 29.99, '2019-09-28', 2);

insert into Orders(OrderID, OrderValue, OrderDate, CustomerID)
values(3, 10.99, '2019-11-01', 3);




insert into Order_Items(ItemNumber, ItemPrice, ISBN, OrderID)
values(1, 14.99, "1033009966", 1);

insert into Order_Items(ItemNumber, ItemPrice, ISBN, OrderID)
values(2, 29.99, "4484160343", 2);

insert into Order_Items(ItemNumber, ItemPrice, ISBN, OrderID)
values(3, 10.99, "1540065456", 3);




insert into Assigned_To(ISBN, CategoryCode)
values("6452472079", 1);

insert into Assigned_To(ISBN, CategoryCode)
values("4484160343", 1);

insert into Assigned_To(ISBN, CategoryCode)
values("1540065456", 1);

insert into Assigned_To(ISBN, CategoryCode)
values("6729318672", 1);

insert into Assigned_To(ISBN, CategoryCode)
values("3482519521", 1);

insert into Assigned_To(ISBN, CategoryCode)
values("0961019814", 1);

insert into Assigned_To(ISBN, CategoryCode)
values("5290361905", 1);

insert into Assigned_To(ISBN, CategoryCode)
values("6783768751", 1);

insert into Assigned_To(ISBN, CategoryCode)
values("0133360020", 1);

insert into Assigned_To(ISBN, CategoryCode)
values("0737579297", 1);

insert into Assigned_To(ISBN, CategoryCode)
values("9483969299", 4);

insert into Assigned_To(ISBN, CategoryCode)
values("1146866603", 4);

insert into Assigned_To(ISBN, CategoryCode)
values("1033009966", 4);

insert into Assigned_To(ISBN, CategoryCode)
values("9295235740", 5);

insert into Assigned_To(ISBN, CategoryCode)
values("1798800393", 5);

insert into Assigned_To(ISBN, CategoryCode)
values("6916235723", 3);

insert into Assigned_To(ISBN, CategoryCode)
values("4195143566", 3);

insert into Assigned_To(ISBN, CategoryCode)
values("9437575159", 3);




insert into Written_By(ISBN, AuthorID)
values("6452472079", 1);

insert into Written_By(ISBN, AuthorID)
values("4484160343", 1);

insert into Written_By(ISBN, AuthorID)
values("1540065456", 5);

insert into Written_By(ISBN, AuthorID)
values("6729318672", 2);

insert into Written_By(ISBN, AuthorID)
values("3482519521", 2);

insert into Written_By(ISBN, AuthorID)
values("0961019814", 4);

insert into Written_By(ISBN, AuthorID)
values("5290361905", 5);

insert into Written_By(ISBN, AuthorID)
values("6783768751", 5);

insert into Written_By(ISBN, AuthorID)
values("0133360020", 2);

insert into Written_By(ISBN, AuthorID)
values("0737579297", 3);

insert into Written_By(ISBN, AuthorID)
values("9483969299", 6);

insert into Written_By(ISBN, AuthorID)
values("1146866603", 3);

insert into Written_By(ISBN, AuthorID)
values("1033009966", 3);

insert into Written_By(ISBN, AuthorID)
values("9295235740", 6);

insert into Written_By(ISBN, AuthorID)
values("1798800393", 6);

insert into Written_By(ISBN, AuthorID)
values("6916235723", 4);

insert into Written_By(ISBN, AuthorID)
values("4195143566", 4);

insert into Written_By(ISBN, AuthorID)
values("9437575159", 4);