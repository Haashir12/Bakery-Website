

CREATE TABLE Branch (
Branch_ID char(3) primary key not null,
Branch_Location varchar (30),
Email varchar (30),
Phone_no  varchar(15),
Opening_Time time,
Closing_Time time); 

CREATE TABLE Customer(
Customer_ID VARCHAR(15) primary key not null,
Customer_Name varchar(20),
Phone_Number varchar(20),
Address varchar(20)
);

CREATE TABLE Category (
Category_ID char(5) Primary Key Not Null,
Category_Name Varchar(25) 
);

CREATE TABLE Product (
    product_id varchar(15) Primary key not null,
    Product_Name varchar(30) not null,
    Picture_URL Varchar(300),
    Serving varchar(5) not null,
    product_description text,
    Category_ID CHAR(5) NOT NULL,
    product_price DECIMAL(5,2),
    calorie_min int,
    calorie_max int,
    FOREIGN KEY (Category_ID) REFERENCES Category(Category_ID)
);


CREATE TABLE Ingredient (
    Ingredient_id varchar(20) Primary key not null,
    ingredient_name VARCHAR(20) NOT NULL,
    Allergy Varchar(5) 
);

Create Table Product_Ingredient (
Product_ID varchar (10)  Not null,
Ingredient_ID varchar(20)  Not null,
quantity varchar(10), 
Primary key (Product_ID, Ingredient_ID),
Foreign Key (Product_ID) References Product(Product_ID),
Foreign Key (Ingredient_ID) References Ingredient(Ingredient_ID) );


CREATE TABLE _ORDER_(
ORDER_ID VARCHAR(15) NOT NULL,
Customer_ID VARCHAR(15),
Order_Date DATE,
Order_Time TIME,
Total DECIMAL(10,2), 
PRIMARY KEY (ORDER_ID),
FOREIGN KEY (Customer_ID) REFERENCES Customer(Customer_ID));

Create Table Baked_Item (
Baked_Item_ID VARCHAR(10) Primary key Not Null,
Production_Date Date,
BestBefore_Date DATE, 
Branch_ID CHAR(3),
Order_ID VARCHAR(10),
Product_ID Varchar(10),
Foreign key (Branch_ID) References Branch(Branch_ID),
FOREIGN KEY (Order_ID) REFERENCES  _order_(Order_ID) ,
Foreign key (Product_ID) References product(Product_ID));

CREATE TABLE Delivery_Company(
DELIVERY_COMPANY_ID VARCHAR(15) NOT NULL,
DELIVERY_COMPANY_NAME VARCHAR (25),
EMAIL VARCHAR(25),
PHONE_NO VARCHAR(10),
COMPANY_RATINGS decimal(3,2),
PRIMARY KEY (DELIVERY_COMPANY_ID)
);

CREATE TABLE DELIVERY(
ORDER_ID VARCHAR(15)  NOT NULL,
DELIVERY_COMPANY_ID VARCHAR(15)  NOT NULL,
RIDER_NAME VARCHAR(20),
DELIVERY_STATUS VARCHAR(10),
DELIVERY_DATE DATE,
DELIVERY_TIME TIME, 
Primary key (Order_ID,Delivery_Company_ID),
FOREIGN KEY (ORDER_ID) REFERENCES _ORDER_(ORDER_ID),
FOREIGN KEY (DELIVERY_COMPANY_ID) REFERENCES DELIVERY_COMPANY(DELIVERY_COMPANY_ID)
);

CREATE TABLE Credit_Card(
CreditCard_ID varchar(10) primary key not null,
Card_Number varchar(3),
Expirtion_Date Date,
Carholder_Name varchar(15),
Customer_ID varchar(15) not null,
FOREIGN KEY (Customer_ID) REFERENCES Customer(Customer_ID)
);

CREATE TABLE Payment(
Payment_ID varchar(10) primary key not null,
Method varchar(20),
Payment_Status varchar(10),
Payment_Date date,
Creditcard_ID varchar(10) not null, 
Order_ID varchar(10) not null,
FOREIGN KEY (Creditcard_ID) REFERENCES Credit_Card(Creditcard_ID), 
FOREIGN KEY (Order_ID) REFERENCES _Order_(Order_ID)
);

 CREATE TABLE Allergy_List (
    allergy_id char(5) PRIMARY KEY not null,
    customer_id varchar(20) not null,
    ingredient_id varchar(20) not null,
    Foreign Key (customer_id) REFERENCES Customer(Customer_id),
    Foreign Key (ingredient_id) REFERENCES Ingredient(Ingredient_id)
);

     
INSERT INTO Branch VALUES     
('101','Al Quoz','DD_Quoz@gmail.com','05567867','08:00:00','08:00:00'),  
('102','Barsha', 'DD_Barsha@gmail.com','05546788','08:00:00','08:00:00'),  
('103','Deira','DD_Deira@gmail.com','05582567','08:00:00','08:00:00'),  
('104','Corniche','DD_Karama@gmail.com','05577847','09:00:00','09:00:00'),
('105','Al Ras','DD_Karama@gmail.com','05543547','08:00:00','08:00:00'),
('106','Al Safa','DD_Karama@gmail.com','05577234','08:00:00','08:00:00'),
('107','Jebel Ali','DD_Karama@gmail.com','05535427','09:00','09:00'),
('108','Palm Jumeirah','DD_Palm_Jumeirah@gmail.com','05512378','08:00','08:00'),
('109','Bur Dubai','DD_Bur_Dubai@gmail.com','05567564','08:00','08:00'),
('110','Dubai Hills','DD_Karama@gmail.com','05577231','09:00','09:00');

 
-- Insert values for Customer table
INSERT INTO Customer VALUES 
    ('Cust101', 'Alice Johnson', '1234567890', '123 Maple St'),
    ('Cust102', 'Sarah Ahmad', '9876543210', '456 Pine St'),
    ('Cust103', 'Charlie Davis', '5678901234', '789 Oak St'),
    ('Cust104', 'David Smith', '8765432109', '101 Cedar St'),
    ('Cust105', 'Eva Brown', '2345678901', '543 Elm St'),
    ('Cust106', 'Frank Miller', '7890123456', '876 Birch St'),
    ('Cust107', 'Grace Wilson', '3456789012', '234 Walnut St'),
    ('Cust108', 'Henry Jones', '9012345678', '678 Spruce St'),
    ('Cust109', 'Ivy Martin', '2109876543', '432 Fir St'),
    ('Cust110', 'Jack Taylor', '6789012345', '901 Redwood St');
  
  
-- Insert values for ORDER table
INSERT INTO _ORDER_ VALUES 
    ('ORD101', 'Cust101', '2023-03-01', '12:30:00', 35.00),
    ('ORD102', 'Cust102', '2023-06-07', '16:00:00', 28.00),
    ('A3474', 'Cust103', '2023-07-03', '11:00:00', 18.50),
    ('ORD104', 'Cust104', '2023-07-04', '09:30:00', 22.00),
    ('ORD105', 'Cust105', '2023-03-05', '15:00:00', 40.00),
    ('ORD106', 'Cust106', '2023-01-06', '13:45:00', 15.75),
    ('ORD107', 'Cust107', '2023-06-07', '10:15:00', 31.50),
    ('ORD108', 'Cust108', '2023-09-08', '14:00:00', 25.00),
    ('ORD109', 'Cust109', '2023-09-09', '16:30:00', 30.50),
    ('ORD110', 'Cust110', '2023-06-01', '12:00:00', 20.00),
    ('ORD111', 'Cust106', '2023-04-06', '13:05:00', 35.95),
    ('ORD112', 'Cust108', '2023-10-09', '19:00:00', 50.00),
    ('ORD113', 'Cust105', '2023-05-05', '13:00:00', 20.00),
    ('A3779', 'Cust101', '2023-07-07', '10:30:00', 38.00),
    ('ORD115', 'Cust109', '2023-11-09', '14:30:00', 20.50);
   


-- Insert values for Category table
INSERT INTO Category Values
("CT01", 'Bread'),
("CT02", 'Cake'),
("CT03", 'Cookies'),
("CT04", 'Muffin'),
("CT05", 'Cupcake'),
("CT06", 'Pastries'),
("CT07", 'Scone'),
("CT08", 'Cheesecake'),
("CT09", 'Brownie'),
("CT10", 'Pie');

-- Insert values for Product table
INSERT INTO Product Values
(1, 'Banana Bread',"https://www.simplyrecipes.com/thmb/tR-5eHAZ3lgNR6Yvu3yxdHMNpk8=/1500x0/filters:no_
upscale():max_bytes(150000):strip_icc()/Simply-Recipes-Easy-Banana-Bread-LEAD-2-2-63dd39af009945d58f5
bf4c2ae8d6070.jpg","2", 'Freshly baked banana bread',"CT01", 2.50, 100, 200),

(2, 'Milk Bread',"https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.epicurious.com%2Frecipes%2Ffood%2Fv
iews%2Fmilk-bread&psig=AOvVaw1egeFhjK1BP_KjKihrGLaq&ust=1702141684364000&source=images&cd=vfe&opi=89978449&
ved=0CBIQjRxqFwoTCOjOloeqgIMDFQAAAAAdAAAAABAI","2", 'Freshly baked Milk bread',"CT01", 2.50, 100, 200),

(3, 'Red Velvet Cake',"https://www.google.com/url?sa=i&url=https%3A%2F%2Fhandletheheat.com%2Fred-velvet-ca
ke%2F&psig=AOvVaw2-xEL8j2cAyLoLHDcm4me-&ust=1702141841212000&source=images&cd=vfe&opi=89978449&ved=0CBIQjRx
qFwoTCLCrudCqgIMDFQAAAAAdAAAAABAE","2", 'Delicious red velvet cake',"CT02", 20.00, 300, 500),

(4, 'Chocolate Cake',"https://www.google.com/url?sa=i&url=https%3A%2F%2Fcooking.nytimes.com%2Frecipes%2F102
4760-chocolate-layer-cake&psig=AOvVaw2B_NilsxiU2AB7O3JMhdnW&ust=1702141880037000&source=images&cd=vfe&opi=89978
449&ved=0CBIQjRxqFwoTCIiM8-KqgIMDFQAAAAAdAAAAABAG","2", 'Delicious Chocolate cake',"CT02", 20.00, 300, 500),

(5, 'Chocolate Cookies',"https://www.google.com/url?sa=i&url=https%3A%2F%2Flovingitvegan.com%2Fvegan-chocola
te-cookies%2F&psig=AOvVaw3pWTltj17pUgkBdO1H3uzb&ust=1702141925748000&source=images&cd=vfe&opi=89978449&ved=0
CBIQjRxqFwoTCPiZufmqgIMDFQAAAAAdAAAAABAD","5", 'Assorted cookies',"CT03", 5.00, 150, 250),

(6, 'Vanilla Cookies',"https://www.google.com/url?sa=i&url=https%3A%2F%2Fenchartedcook.com%2Fvanilla-sugar-
cookies%2F&psig=AOvVaw2BACTuhydZy05TlxYRGKAV&ust=1702141965316000&source=images&cd=vfe&opi=89978449&ved=0CB
IQjRxqFwoTCLC1z42rgIMDFQAAAAAdAAAAABAD","5", 'Assorted cookies',"CT03", 5.00, 150, 250),

(7, 'Blue Berry Muffin',"https://www.google.com/url?sa=i&url=https%3A%2F%2Fsallysbakingaddiction.com%2Fblue
berry-muffins%2F&psig=AOvVaw0C2wqW7x8128rLq1io4RWm&ust=1702142038090000&source=images&cd=vfe&opi=89978449&ve
d=0CBIQjRxqFwoTCNC4mbCrgIMDFQAAAAAdAAAAABAD","3", 'Blueberry muffin',"CT04", 2.00, 120, 180),

(8, 'Strawberry Jam Muffin',"https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.lemongrovelane.com%2Fst
rawberry-jam-muffins-6%2F&psig=AOvVaw012FwiTQzDN_qiEZmj154v&ust=1702142064982000&source=images&cd=vfe&opi=89
978449&ved=0CBIQjRxqFwoTCODJs7yrgIMDFQAAAAAdAAAAABAD","3", 'Blueberry muffin',"CT04", 2.00, 120, 180),

(9, 'Vanilla Cupcake',"https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.allrecipes.com%2Frecipe%2F1578
77%2Fvanilla-cupcake%2F&psig=AOvVaw2p8qHZ6lqecpmwrEe5xHFh&ust=1702142096966000&source=images&cd=vfe&opi=89
978449&ved=0CBIQjRxqFwoTCPjX1cqrgIMDFQAAAAAdAAAAABAD","3", 'Vanilla cupcake',"CT05", 1.75, 80, 150),

(10, 'Chocolate Cupcake',"https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.allrecipes.com%2Frecipe%2F
17377%2Fchocolate-cupcakes%2F&psig=AOvVaw1cI06JIssy3sUmIdkh389H&ust=1702142120327000&source=images&cd=vfe&op
i=89978449&ved=0CBIQjRxqFwoTCNCAitergIMDFQAAAAAdAAAAABAD","3", 'Vanilla cupcake',"CT05", 1.75, 80, 150),

(11, 'Filo Pastries',"https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.olivemagazine.com%2Frecipes%2Fco
llection%2Fbest-filo-pastry-recipes%2F&psig=AOvVaw2BV74O2AgbmUf6RyDRR8BB&ust=1702142160196000&source=images&
cd=vfe&opi=89978449&ved=0CBIQjRxqFwoTCJDgxumrgIMDFQAAAAAdAAAAABAD","4", 'Soft pastries',"CT06", 2.50, 200, 300),

(12, 'Fudge Pastries',"https://www.google.com/url?sa=i&url=https%3A%2F%2Fjuliemarieeats.com%2Fchocolate-fud
ge-cake%2F&psig=AOvVaw1mKT4LERt8u3iC7nuUc62I&ust=1702142188013000&source=images&cd=vfe&opi=89978449&ved=0CBI
QjRxqFwoTCMimuvargIMDFQAAAAAdAAAAABAD","4", 'Soft fudge pastries',"CT06", 2.50, 200, 300),

(13, 'Cinnamon Scone',"https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.errenskitchen.com%2Fcinnamon-s
wirl-scones%2F&psig=AOvVaw12SLjsCoVo2m6AwFRJ2-iu&ust=1702142211122000&source=images&cd=vfe&opi=89978449&ved=
0CBIQjRxqFwoTCOiyxoKsgIMDFQAAAAAdAAAAABAI","4", 'Cinnamon scone',"CT07", 2.25, 180, 250),

(14, 'Butter Scone',"https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.plumdeluxe.com%2Fblogs%2Fblog%2F
maple-brown-butter-scone-with-graham-cracker-streusel&psig=AOvVaw0IE4W5zBqGCRknP8aAyzaY&ust=1702142245036000
&source=images&cd=vfe&opi=89978449&ved=0CBIQjRxqFwoTCMCa2pKsgIMDFQAAAAAdAAAAABAD","4", 'butter scone',"CT07", 2.25, 180, 250),

(15, 'Strawberry Cheesecake',"https://www.google.com/url?sa=i&url=https%3A%2F%2Fdrivemehungry.com%2Fstrawbe
rry-cheesecake%2F&psig=AOvVaw1of5DvxvLp0ipLdfzrpJ1O&ust=1702142278716000&source=images&cd=vfe&opi=89978449&
ved=0CBIQjRxqFwoTCJC2qaGsgIMDFQAAAAAdAAAAABAD","2", 'Classic cheesecake',"CT08", 15.00, 250, 400),

(16, 'Blueberry Cheesecake',"https://www.google.com/url?sa=i&url=https%3A%2F%2Fsugarspunrun.com%2Fblueberry
-cheesecake-recipe%2F&psig=AOvVaw0gZ9ZbXDhVsIBzWyVDu4jl&ust=1702142301358000&source=images&cd=vfe&opi=89978
449&ved=0CBIQjRxqFwoTCJiC06usgIMDFQAAAAAdAAAAABAF","2", 'Classic Blueberry cheesecake',"CT08", 15.00, 250, 400),

(17, 'Fudge Brownie',"https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.theflavorbender.com%2Fthe-best-
fudgy-chocolate-brownies-cocoa%2F&psig=AOvVaw0tpjyhcgCiH6yzYc5-lAvw&ust=1702142348455000&source=images&cd=vf
e&opi=89978449&ved=0CBIQjRxqFwoTCPDa08OsgIMDFQAAAAAdAAAAABAD","3", 'Delicious Fudge brownie',"CT09", 2.50, 200, 300),

(18, 'Chocolate Brownie',"https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.sainsburysmagazine.co.uk%2F
recipes%2Fbaking%2Fchocolate-brownie-pudding&psig=AOvVaw1USGbOH7CP04ivsJfEGhN9&ust=1702142371711000&source=
images&cd=vfe&opi=89978449&ved=0CBIQjRxqFwoTCPC16M6sgIMDFQAAAAAdAAAAABAD","4", 'Melting Chocolate brownie',"CT09",2.50, 200, 300),

(19, 'Apple Pie',"https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.inspiredtaste.net%2F43362%2Fapple
-pie%2F&psig=AOvVaw1Q3HUCftKK7OvvMItXuxsW&ust=1702142402340000&source=images&cd=vfe&opi=89978449&ved=0CBIQjR
xqFwoTCPCJo9ysgIMDFQAAAAAdAAAAABAD","1", 'Delightful Apple pie',"CT10", 18.00, 300, 400) ,

(20, 'CranBerry Pie',"https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.bakedbyanintrovert.com%2Fcran
berry-pie%2F&psig=AOvVaw0paomJoU6cqwQRuwuQi2tw&ust=1702142429299000&source=images&cd=vfe&opi=89978449&ved=0
CBIQjRxqFwoTCOjyxuqsgIMDFQAAAAAdAAAAABAD","1", 'Delightful CranBerry pie',"CT10",18.00, 300, 400);
    

INSERT INTO baked_Item VALUES 
('BI01','2023-02-28','2023-12-05','101','ORD101','4'),
('BI02','2023-02-28','2023-12-03','108','ORD110','11'),
('BI03','2023-01-02','2023-12-07','103','ORD106','15'),
('BI04','2023-03-01','2023-12-08','104','ORD105','2'),
('BI05','2023-09-02','2023-12-06','105','ORD108','18'),
('BI06','2023-06-03','2023-12-10','106','ORD102','5'),
('BI07','2023-09-03','2023-12-04','107','ORD109','16'),
('BI08','2023-03-01','2023-12-08','109','ORD105','12'),
('BI09','2023-06-04','2023-12-09','102','ORD107','1'),
('BI10','2023-07-01','2023-12-15','110','ORD104','20'),
('BI011','2023-07-01','2023-12-24','107','A3474','9'),
('BI012','2023-01-02','2023-12-07','107','ORD106','17'),
('BI013','2023-06-03','2023-12-09','102','ORD107','3'),
('BI014','2023-02-25','2023-12-03','109','ORD110','19'),
('BI015','2023-02-27','2023-12-05','101','ORD101','13');
    
-- Insert values for Ingredient table
INSERT INTO Ingredient VALUES 
    ('I1', 'Banana', 'No'),
    ('I2', 'Sugar', 'Yes'),
    ('I3', 'Chocolate', 'Yes'),
    ('I4', 'Blueberries', 'Yes'),
    ('I5', 'Vanilla', 'Yes'),
    ('I6', 'Butter', 'No'),
    ('I7', 'Cranberries', 'Yes'),
    ('I8', 'Cream Cheese', 'Yes'),
    ('I9', 'Cocoa Powder', 'No'),
    ('I10', 'Apples', 'No');
    

-- Insert values for Product_Ingredient table
INSERT INTO Product_Ingredient VALUES 
    ('1', 'I1', 200),
    ('3', 'I2', 100),
    ('4', 'I2', 150),
    ('5', 'I2', 170),
    ('10', 'I3', 150),
    ('16', 'I4', 200),
    ('7', 'I4', 200),
    ('9', 'I5', 120),
    ('6', 'I5', 200),
    ('14', 'I6', 80),
    ('20', 'I7', 180),
    ('15', 'I8', 250),
    ('17', 'I9', 130),
    ('5', 'I9', 130),
    ('19', 'I10', 160),
    ('2', 'I2', 100);


-- Insert values for DELIVERY_COMPANY table
INSERT INTO DELIVERY_COMPANY VALUES 
    ('DC101', 'Speedy', 'speedy@example.com', '1234567890', 4),
    ('DC102', 'Swift Shipping', 'swift@example.com', '9876543210', 5),
    ('DC103', 'Talabat', 'Talabat@example.com', '8765432109', 3),
    ('DC104', 'Quick Couriers', 'quick@example.com', '5678901234', 4),
    ('DC105', 'Rapid Logistics', 'rapid@example.com', '4321098765', 5),
    ('DC106', 'Fast Freight', 'fast@example.com', '6789012345', 4),
    ('DC107', 'Zippy Transport', 'zippy@example.com', '3456789012', 3),
    ('DC108', 'Blitz Delivery', 'blitz@example.com', '7890123456', 5),
    ('DC109', 'Pace Couriers', 'pace@example.com', '2109876543', 4),
    ('DC110', 'Swiftline Express', 'swiftline@example.com', '9012345678', 3);

-- Insert values for DELIVERY table
INSERT INTO DELIVERY VALUES 
    ('ORD101', 'DC101', 'Alex Rider', 'Delivered', '2023-03-02', '15:00:00'),
    ('ORD102', 'DC102', 'Emily Courier', 'Pending', '2023-06-08', '10:30:00'),
    ('A3474', 'DC103', 'Chris Mover', 'Shipped', '2023-07-04', '14:45:00'),
    ('ORD104', 'DC104', 'David Quick', 'Delivered', '2023-07-05', '11:00:00'),
    ('ORD105', 'DC105', 'Sophie Rapid', 'Pending', '2023-03-06', '13:30:00'),
    ('ORD106', 'DC106', 'John Fast', 'Shipped', '2023-01-07', '12:15:00'),
    ('ORD107', 'DC107', 'Emma Zippy', 'Delivered', '2023-06-08', '16:00:00'),
    ('ORD108', 'DC108', 'Michael Blitz', 'Pending', '2023-09-09', '09:45:00'),
    ('ORD109', 'DC109', 'Olivia Pace', 'Shipped', '2023-09-10', '17:30:00'),
    ('ORD110', 'DC101', 'Daniel Swiftline', 'Delivered', '2023-03-02', '10:00:00'),
    ('ORD111', 'DC108', 'Michael Blitz', 'Delivered', '2023-04-07', '10:00:00'),
    ('ORD112', 'DC104', 'David Quick', 'Delivered', '2023-10-10', '10:00:00'),
    ('ORD113', 'DC102', 'Henry Lee', 'Delivered', '2023-05-06', '10:00:00'),
    ('A3779', 'DC107', 'Jack Swagger', 'Delivered', '2023-07-08', '10:00:00'),
    ('ORD115', 'DC109', 'Daniel Mike', 'Delivered', '2023-11-10', '10:00:00');


-- Insert values for Credit_Card table
INSERT INTO Credit_Card VALUES 
("C45657",1,"2025-06-07","Sarah Ahmad","Cust102"),
("C45658",1,"2026-09-09","Ivy Martin","Cust109"),
("C45659",1,"2024-05-05","Alice Johnson","Cust101"),
("C45660",1,"2024-09-09","Eva Brown","Cust105"),
("C45661",1,"2025-01-01","Charlie Davis","Cust103"),
("C45662",2,"2025-04-04","Sarah Ahmad","Cust102"),
("C45663",1,"2027-02-02","Grace Wilson","Cust107"),
("C45664",2,"2025-08-08","Eva Brown","Cust105"),
("C45665",3,"2026-11-11","Eva Brown","Cust105"),
("C45666",1,"2024-01-01","Henry Jones","Cust106"),
("C45667",1,"2024-05-05","Frank Miller","Cust108"),
("C45668",1,"2025-06-06","Jack Taylor","Cust110"),
("C45669",2,"2024-12-12","Jack Taylor","Cust110"),
("C45670",1,"2024-05-05","Charlie Davis","Cust103"),
("C45671",1,"2024-07-07","Alice Johnson","Cust101"),
("C45672",1,"2024-07-07","David Smith","Cust104");


-- Insert values for Payment table
INSERT INTO Payment VALUES 
    (1, 'Credit Card', 'Paid', '2023-03-01', 'C45657','ORD102'),
    (2, 'Credit Card', 'Pending', NULL, "C45662",'ORD102'),
    (3, 'Credit Card', 'Paid', '2023-07-03',"C45661", 'A3474'),
    (4, 'Credit Card', 'Paid', '2023-07-04',"C45657", 'ORD104'),
    (5, 'Credit Card', 'Pending', NULL,"C45660", 'ORD105'),
    (6, 'Credit Card', 'Paid', NULL,"C45666", 'ORD106'),
    (7, 'Credit Card', 'Paid', '2023-06-07',"C45663", 'ORD107'),
    (8, 'Credit Card', 'Pending', NULL,"C45667", 'ORD108'),
    (9, 'Credit Card', 'Paid', '2023-09-09',"C45658", 'ORD109'),
    (10, 'Credit Card', 'Paid', '2023-03-01',"C45669", 'ORD110'),
    (11, 'Credit Card', 'Paid', '2023-04-06',"C45666", 'ORD111'),
    (12, 'Credit Card', 'Paid', '2023-10-09',"C45667", 'ORD112'),
    (13, 'Credit Card', 'Paid', '2023-05-05',"C45665", 'ORD113'),
    (14, 'Credit Card', 'Paid', '2023-07-07',"C45662", 'A3779'),
    (15, 'Credit Card', 'Paid', '2023-11-09',"C45658", 'ORD115');


-- Insert values for Allergy_List table
INSERT INTO Allergy_List VALUES
    ('A1', 'Cust101', 'I1'),
    ('A2', 'Cust102', 'I2'),
    ('A3', 'Cust103', 'I3'),
    ('A4', 'Cust104', 'I4'),
    ('A5', 'Cust105', 'I5'),
    ('A6',  'Cust106', 'I6'),
    ('A7',  'Cust107', 'I7'),
    ('A8',  'Cust108', 'I8'),
    ('A9', 'Cust109', 'I9'),
    ('A10', 'Cust110', 'I10'),
    ('A11','Cust109','I3');
    
    
/* DROP TABLE allergy_list, baked_item, branch,category, credit_card, customer, delivery, Delivery_Company,
ingredient, _order_, payment, product, product_ingredient; */





/* 01. list the customer details for the customers who are allergic to chocolate   */
Select c.*
from customer c
inner join allergy_list a
on c.customer_ID = a.customer_ID
inner join ingredient i
on a.ingredient_ID = i.ingredient_ID
where ingredient_name = "chocolate"; 


/* Q2. list all the customers details who have placed orders and have their payment status as pending*/
Select c.*, o.order_ID
from customer c 
inner join _order_ o
on c.customer_ID = o.customer_ID
inner join payment p
on o.order_ID = p.order_ID
where payment_status = "pending";

/* Q3: Subquery */
/* list the product name and price where product price is  more than the  average price of 
products in store */
Select product_name, product_price
from product 
where product_price >= (select avg(product_price)
from product)
order by product_name; 


/* Q4: self join 
Find pairs of deliveries that were made on the same date by the same delivery company,
 For each pair found, show the names of 
 the riders who made these deliveries along with the date of delivery */
SELECT 
  A.Order_ID, 
  B.Order_ID,
  A.Delivery_Company_ID,
  A.Rider_Name AS RiderName1,
  B.Rider_Name AS RiderName2,
  A.delivery_date, 
  DC.Delivery_Company_Name
FROM 
  Delivery A
INNER JOIN 
  Delivery B 
  ON A.Delivery_Company_ID = B.Delivery_Company_ID 
  AND A.delivery_date = B.delivery_date
  AND A.Order_ID != B.Order_ID
INNER JOIN 
  Delivery_Company DC 
  ON A.Delivery_Company_ID = DC.Delivery_Company_ID;


/*C5. */    
/* List the customer details who has an "i" in their names, and have paid more than $25 for each total order */
select c.* , sum(total) as total_Amount
from customer c
inner join _order_ o 
on c.customer_ID = o.customer_ID 
where customer_name like "%i%"
group by order_ID
having sum(total) > 25; 


/*C6.*/
/* Union */
/* Retrieve the names of customers and their corresponding order IDs for orders with pending deliveries. 
Additionally, retrieve the names of delivery companies and their respective company IDs for deliveries that
 have already been shipped. Combine the results, ensuring that the columns 'Name_of_Customer' and 'ID' are
 used in both parts of the result set and in asecnding order of their names. */

SELECT Customer.Customer_ID,Customer.Customer_Name
FROM Customer
JOIN _Order_ ON Customer.Customer_ID = _Order_.Customer_ID
JOIN Delivery ON _Order_.Order_ID = Delivery.Order_ID
WHERE Delivery_Status = 'Pending'
UNION
SELECT Customer.Customer_ID,Customer.Customer_Name
FROM Customer
JOIN _Order_ ON Customer.Customer_ID = _Order_.Customer_ID
JOIN Delivery ON _Order_.Order_ID = Delivery.Order_ID
WHERE Delivery_Status = 'Shipped'
Order by customer_name;


/*Correlated sub-query*/
/*C9.*/
/* */


