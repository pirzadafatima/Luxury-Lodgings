Use Project
CREATE TABLE [Employees] 
(
  [Emp_ID] varchar(8) NOT NULL,
  [Username] varchar(20) NOT NULL UNIQUE,
  [Password] varchar(50) NOT NULL,
  [First Name] varchar(20) NOT NULL,
  [Last Name] varchar(20) NOT NULL,
  [Gender] char check ([Gender] in ('M', 'F')) NOT NULL,
  [DOB] Date NOT NULL,
  [Position] varchar(50) NOT NULL,
  [Email ID] varchar(50) NOT NULL,
  [Phone Number] char(12) NOT NULL,
  [Address] varchar(70) NOT NULL,
  [Salary] int NOT NULL,
  [Age] int NOT NULL,
  [CNIC] varchar(15) NOT NULL

  PRIMARY KEY ([Emp_ID])
);
Select * from [Employees]

CREATE TABLE [Guests] 
(
  [Guest_ID] int IDENTITY(1,1) NOT NULL,
  [Username] varchar(20) NOT NULL UNIQUE,
  [Password] varchar(50) NOT NULL,
  [First Name] varchar(20) NOT NULL,
  [Last Name] varchar(20) NOT NULL,
  [CNIC] varchar(15) NOT NULL,
  [Gender] char(1) check ([Gender] in ('M', 'F')),
  [DOB] Date,
  [Email ID] varchar(50) NOT NULL,
  [Phone Number] char(12) NOT NULL,

  PRIMARY KEY ([Guest_ID])
);

Select * from [Guests]

CREATE TABLE [Bookings] 
(
  [Booking_ID] int IDENTITY(1,1),
  [Guest_ID] int,
  [Status] varchar(20)

  PRIMARY KEY ([Booking_ID])
);

Alter Table [Bookings] add constraint FK_BOOKINGS1 foreign key (Guest_ID) references [Guests] (Guest_ID) on delete Cascade on update Cascade


CREATE TABLE [Q/A] 
(
  [Question_ID] int IDENTITY(1,1) NOT NULL,
  [Username] varchar(20) NOT NULL,
  [Question] Text NOT NULL,
  [Answer] Text,

  PRIMARY KEY ([Question_ID])
);

Select * from [Q/A] ORDER BY [Question_ID] DESC

Alter Table [Q/A] add constraint FK_QA1 foreign key (Username) references [Guests] (Username) on delete Cascade on update Cascade



CREATE TABLE [Reviews] 
(
  [Review_ID] int IDENTITY(1,1) NOT NULL,
  [Username] varchar(20) NOT NULL,
  [Review] Text NOT NULL,
  [Rating] int

  PRIMARY KEY ([Review_ID])
);

Alter Table [Reviews] add constraint FK_REVIEWS foreign key (Username) references [Guests] (Username) on delete Cascade on update Cascade

Select * from [Reviews]

Select * from [Guests] where Username = 'kamhama'
Update [Guests] set [First Name] = 'KJ', [Last Name] = 'Khan', [CNIC] = '353478844400', [DOB] = '2022-11-11', [Email ID] = 'mail@tay.com', [Phone Number] = '028938393930' where Username = 'kamhama'


CREATE TABLE [Payment] 
(
  [No] int IDENTITY(1,1) NOT NULL,
  [Guest_ID] int NOT NULL,
  [CardOwner] varchar(20) NOT NULL,
  [CardNum] int NOT NULL Unique,
  [Month] int NOT NULL,
  [Year] int NOT NULL,
  [CVV] int NOT NULL

  PRIMARY KEY ([No])
);

Alter Table [Payment] add constraint FK_Payment foreign key ([Guest_ID]) references [Guests] (Guest_ID) on delete Cascade on update Cascade

Select * from [Payment]

CREATE TABLE [Premium Packages] 
(
  [Package_ID] int NOT NULL,
  [Type] Text NOT NULL,
  [Percentage] float NOT NULL,
  [Valid_From] Date,
  [Valid_Through] Date

  PRIMARY KEY ([Package_ID])
);


Select * from [Premium Packages] 

CREATE TABLE [Premium Customers] 
(
  [PC_ID] int IDENTITY(1,1) NOT NULL,
  [Guest_ID] int NOT NULL,
  [Package] int

  PRIMARY KEY ([PC_ID])
);

Alter Table [Premium Customers]  add constraint FK_PC1 foreign key (Guest_ID) references [Guests] (Guest_ID) on delete Cascade on update Cascade
Alter Table [Premium Customers]  add constraint FK_PC2 foreign key (Package) references [Premium Packages] (Package_ID) on delete Cascade on update Cascade

Select * from [Premium Customers]

CREATE TABLE [Rooms] 
(
  [Room_ID] varchar(20) NOT NULL,
  [Type] varchar(20),
  [Price] float,
  [NoOfPeople] int,
  [NoOfRooms] int NOT NULL,
  [NoOfBookedRooms] int

  PRIMARY KEY ([Room_ID])
);


CREATE TABLE [Room Booking] 
(
  [RB_ID] int IDENTITY(1,1) NOT NULL,
  [Booking_ID] int,
  [Guest_ID] int NOT NULL, 
  [Room_ID] varchar(20) NOT NULL,
  Number int NOT NULL,
  [Booking_Date] date NOT NULL,
  [Check_In] date NOT NULL,
  [Check_Out] date NOT NULL,
  [Price] float,
  [SpecialRequest] Text

  PRIMARY KEY ([RB_ID])
);

Alter Table [Room Booking] add constraint FK_ROOMBOOKING1 foreign key (Booking_ID) references [Bookings] (Booking_ID) on delete Cascade on update Cascade
Alter Table [Room Booking] add constraint FK_ROOMBOOKING2 foreign key (Room_ID) references [Rooms] (Room_ID) on delete Cascade on update Cascade
Alter Table [Room Booking] add constraint FK_ROOMBOOKING3 foreign key (Guest_ID) references [Guests] (Guest_ID) 


CREATE TABLE [Services] 
(
  [Service_ID] int NOT NULL,
  [Type] varchar(20) NOT NULL,
  [Description] Text,
  [Start_Time] varchar(10),
  [End_time] varchar(10),
  [Price] float

  PRIMARY KEY ([Service_ID])
);

CREATE TABLE [Service Booking] 
(
  [SB_ID] int IDENTITY(1,1) NOT NULL,
  [Booking_ID] int,
  [Guest_ID] int NOT NULL,
  [Service_ID] int NOT NULL,
  [Start_Date] datetime NOT NULL,
  [End_Date] datetime NOT NULL,
  [Price] float

  PRIMARY KEY ([SB_ID])
);

Alter Table [Service Booking] add constraint FK_SERVICEBOOKING1 foreign key (Booking_ID) references [Bookings] (Booking_ID) on delete Cascade on update Cascade
Alter Table [Service Booking] add constraint FK_SERVICEBOOKING2 foreign key (Service_ID) references [Services] (Service_ID) on delete Cascade on update Cascade
Alter Table [Service Booking] add constraint FK_SERVICEBOOKING3 foreign key (Guest_ID) references [Guests] (Guest_ID)  


CREATE TABLE [Cars] 
(
  [Car_iD] int NOT NULL,
  [Type] varchar(20),
  [Brand] varchar(20),
  [Model] varchar(50),
  [Production Year] int,
  [Color] varchar(50),
  [NoOfCustomerUsage] int,
  [Rating] float,
  [Price] float,
  [NoOfCars] int NOT NULL,
  [NoOfBookedCars] int

  PRIMARY KEY ([Car_iD])
);

CREATE TABLE [Travel Guides] 
(
  [Emp_ID] varchar(8) NOT NULL UNIQUE,
  [Experience] Text,
  [Rating] float,
  [Status] varchar(15)
);

Alter Table [Travel Guides] add constraint FK_TG foreign key (Emp_ID) references [Employees] (Emp_ID) on delete Cascade on update Cascade

CREATE TABLE [Car Booking] 
(
  [CB_ID] int NOT NULL,
  [Booking_ID] int,
  [Guest_ID] int NOT NULL,
  [Car_ID] int NOT NULL,
  [TravelGuide] varchar(8),
  [Start_time] datetime NOT NULL,
  [End_time] datetime NOT NULL,
  [pickup_location] varchar(20),
  [dropoff_location] varchar(20),
  [Price] float,
  [tg_rating] int

  PRIMARY KEY ([CB_ID])
);
select * from  [Car Booking] 
ALTER table [Car Booking] add [pickup_date] date ;
ALTER table [Car Booking] add [return_date] date ;

alter table [Car Booking] alter COLUMN  [pickup_location] varchar(50);
 alter table [Car Booking] alter COLUMN [dropoff_location] varchar(50);
alter table [Car Booking] alter COLUMN [pickup_date] date;
 alter table [Car Booking] alter COLUMN [return_date] date;
 ALTER table [Car Booking] alter COLUMN [Start_time] TIME(0);
 ALTER table [Car Booking] alter COLUMN  [End_time] TIME(0);
  ALTER table [Car Booking] add Quantity int ;
Alter Table [Car Booking] add constraint FK_CARBOOKING1 foreign key (Booking_ID) references [Bookings] (Booking_ID) on delete Cascade on update Cascade
Alter Table [Car Booking] add constraint FK_CARBOOKING2 foreign key (Car_ID) references [Cars] (Car_ID) on delete Cascade on update Cascade
Alter Table [Car Booking] add constraint FK_CARBOOKING3 foreign key (TravelGuide) references [Travel Guides] (Emp_ID) on delete cascade on update cascade
Alter Table [Car Booking] add constraint FK_CARBOOKING4 foreign key (Guest_ID) references [Guests] (Guest_ID)





CREATE TABLE [Discount] 
(
  [Discount_ID] varchar(20) NOT NULL,
  [Date_start] date NOT NULL,
  [Date-end] date NOT NULL,
  [Percentage] float NOT NULL,
  [Type] varchar(15) NOT NULL,
  [Description] text

  PRIMARY KEY ([Discount_ID])
);

CREATE TABLE [Bill] 
(
  [InvoiceNo] int IDENTITY(1,1) NOT NULL,
  [Guest_ID] int NOT NULL,
  [Booking_ID] int NOT NULL,
  [RoomCharge] float,
  [NoOfServices] int,
  [ServiceCharges] float,
  [CarCharges] float,
  [PremiumPay] float,
  [Discount_ID] varchar(20),
  [PremiumDiscount] float,
  [TotalBill] float,
  [PaymentDate] date

  PRIMARY KEY ([InvoiceNo])
);

Alter Table [Bill]  add constraint FK_BILL1 foreign key (Guest_ID) references [Guests] (Guest_ID) on delete Cascade on update Cascade
Alter Table [Bill]  add constraint FK_BILL2 foreign key (Booking_ID) references [Bookings] (Booking_ID) 
Alter Table [Bill]  add constraint FK_BILL3 foreign key (Discount_ID) references [Discount] (Discount_ID) on delete Cascade on update Cascade

Select * from [Bill]
-------------------------------------------------------------------------------------------------------------------------
--------------------------------------------------Values-----------------------------------------------------------------

INSERT INTO [Q/A] VALUES ('mhamza', 'What are the check-in and check-out times at the hotel?', ' The standard check-in time is 3:00 PM and check-out time is 12:00 PM.')
INSERT INTO [Q/A] VALUES ('mhamza', 'Does the hotel offer airport shuttle service?', ' Yes, the hotel provides airport shuttle service for an additional fee. Please contact the front desk to arrange for pick-up and drop-off.')
INSERT INTO [Q/A] VALUES ('mhamza', ' Is there a fitness center on-site?', '  Yes, the hotel has a fully-equipped fitness center available to guests 24 hours a day. ')


INSERT INTO [Reviews] VALUES ('mhamza', 'The hotel was amazing, with excellent facilities and a great location. 
                        The staff were very friendly and helpful, making our stay even more enjoyable.', 5)
INSERT INTO [Reviews] VALUES ('aliahmad', 'We had a fantastic time at the resort. The rooms were spacious and comfortable, with beautiful views of the surrounding area.
                        The on-site restaurant served delicious food and the pool was a great place to relax.', 5)
INSERT INTO [Reviews] VALUES ('mhamza', 'Our stay at the hotel was perfect. The staff went above and beyond to make sure we had everything we needed and the room was clean and well-maintained.
                        The location was ideal, with plenty of nearby attractions to explore.', 5)
INSERT INTO [Reviews] VALUES ('aliahmad', 'The resort exceeded our expectations in every way. The amenities were top-notch and the staff were incredibly accommodating. 
                        We particularly enjoyed the spa services and the outdoor activities available on-site. We cant wait to return!', 4)


INSERT INTO [Rooms] values
('del_01', 'Deluxe Suite', 500, 4,  5, 0),
('gview_02', 'Garden-View Room', 350, 5,  6, 0),
('exec_03', 'Executive Room', 400, 2, 4, 0),
('fam_04', 'Family Suite', 450, 6, 6, 0),
('std_05', 'Standard Room', 250, 2, 8, 0)

select * from rooms

INSERT INTO [Room Booking] ( Guest_ID, Room_ID, Number, Booking_Date, Check_In, Check_Out) Values
 ( 1, 'gview_02',1, '2022-12-28', '2023-01-02', '2023-01-09')

 INSERT INTO [Room Booking] (Guest_ID, Room_ID, Number, Booking_Date, Check_In, Check_Out) Values
 ( 3, 'fam_04',2, '2023-04-23', '2023-04-26', '2023-04-29')

 INSERT INTO [Room Booking] ( Guest_ID, Room_ID, Number,Booking_Date, Check_In, Check_Out) Values
 ( 2, 'exec_03',1, '2023-04-22', '2023-04-25', '2023-05-01')

 INSERT INTO [Room Booking] ( Guest_ID, Room_ID, Number ,Booking_Date, Check_In, Check_Out) Values
 ( 2, 'std_05',3, '2022-12-28', '2023-01-02', '2023-01-09')

 INSERT INTO [Room Booking] ( Guest_ID, Room_ID, Number ,Booking_Date, Check_In, Check_Out) Values
 ( 1, 'std_05',1, '2022-12-28', '2023-01-02', '2023-01-09')


 Update [Room Booking] set Price = 350, SpecialRequest = 'With Lunch and Dinner Room Service' where RB_ID = 12
Update [Room Booking] set Price = 400, SpecialRequest = 'Having Sunset View' where RB_ID = 13

 Select * from [Room Booking]

 Insert into [Bill] Values(2,250,100,50,200,NULL,50,600,GETDATE(),'Card');
Insert into [Bill] Values(2,250,100,50,200,NULL,50,400,GETDATE(),'Card');

INSERT INTO [Premium Packages] values
(1, 'All', 45, '2023-05-05', '2023-06-05' ),          --all means on total bill
(2, 'Services', 35, '2023-05-05', '2023-07-05')

INSERT INTO [Services] values
(1, 'Dining', 'A luxurious on-site restaurant with the most delectable cuisine prepared by our skilled chefs. Available at breakfast, lunch and dinner times or even in between.', '10 a:m', '10 p:m', 60),
(2, 'Golf', 'Our golf course is the perfect place to unwind and practice your swing. Price is per person for a round of 18 holes.', '7 a:m', '5 p:m', 50),
(3, 'Gym', 'Our gym is equipped with the latest fitness equipment and is open 24 hours a day for your convenience. Price is per hour.', '12 a:m', '11.59 p:m', 30),
(4, 'Water Park', 'Our resort features an exciting water park with thrilling rides and slides for all ages.', '10 a:m', '6 p:m', 50)

select * from [Services]





----New--------------------------------------------------------
INSERT INTO [Rooms] values
('del_01', 'Deluxe Suite', 500, 6, 5, 0),
('gview_02', 'Garden-View Room', 350, 8, 6, 0),
('exec_03', 'Executive Room', 400, 2, 4, 0),
('fam_04', 'Family Suite', 450, 10, 6, 0),
('std_05', 'Standard Room', 250, 2, 8, 0)

select * from rooms

INSERT INTO [Services] values
(1, 'Dining', 'A luxurious on-site restaurant with the most delectable cuisine prepared by our skilled chefs. Available at breakfast, lunch and dinner times or even in between.', '10 a:m', '10 p:m', 60),
(2, 'Golf', 'Our golf course is the perfect place to unwind and practice your swing. Price is per person for a round of 18 holes.', '7 a:m', '5 p:m', 50),
(3, 'Gym', 'Our gym is equipped with the latest fitness equipment and is open 24 hours a day for your convenience. Price is per hour.', '12 a:m', '11.59 p:m', 30),
(4, 'Water Park', 'Our resort features an exciting water park with thrilling rides and slides for all ages.', '10 a:m', '6 p:m', 50)

select * from [Services]

INSERT INTO [Employees] values
('AMG_01', 'ishaq123', 'helloLeaves2002', 'Ishaq', 'Mubasir', 'M', '1992-02-14', 'Assistant Manager', 'mubasirishaq444@gmail.com', '0333-4874378', 'House # 32, Block B2, Faisal Town, Lahore)', 400, 31, '3078-6795-123-4'),
('REC_01', 'abdulbari_fareed45', 'ABDfareed909', 'Abdul Bari', 'Fareed', 'M', '1996-06-16', 'Receptionist', 'abdulbari@gmail.com', '0309-8926543', 'House # 192, Block C, Lopsi Town, Multan)', 150, 26, '7893-4398-876-3'),
('TG_01', 'sameen@pdr', 'abc1234', 'Sameen', 'Rafi', 'F', '1999-09-23', 'Travel Guide', 'sameen.rafi@gmail.com', '0300-9876432', 'House # 332, Ravi Block, Iqbal Town, Lahore)', 250, 23, '3456-7623-197-7'),
('TG_02', 'arslanBaig206','arslan_arsii', 'Arslan', 'Baig', 'M', '1995-07-19', 'Travel Guide', 'arslan.baig.1995@gmail.com', '0301-6734090', 'House # 2, Klopa Block, Rawal Town, D.G Khan)', 250, 27, '7845-3454-864-7'),
('MG_01', 'm.jabbar','MuhammadJabbar', 'Muhammad', 'Jabbar', 'M', '1978-05-06', 'Manager', 'muhammad.jabbar@gmail.com', '0345-7650934', 'House # 78, Ramsh Block, Marl Town, Lahore)', 700, 45, '9012-9087-097-0'),
('TG_03', 'michaelAnd123','helloworld', 'Michael', 'Andrews', 'M', '1996-08-20', 'Travel Guide', 'michael.andrews@gmail.com', '0308-6778090', 'House # 45, Main Str, Nashville)', 250, 26, '0675-6752-864-6'),
('TG_04', 'amandaMills','abcdeds', 'Amanda', 'Mills', 'F', '1993-05-15', 'Travel Guide', 'amanda.mills@gmail.com', '9038-5347890', 'House # 356, Main Str, NewYork)', 250, 29, '0765-5434-543-0')


INSERT INTO [Employees] values
('ADM_01', 'umar123', 'umarraza123', 'Umar', 'Raza', 'M', '1992-05-23', 'Admin', 'umar.raza@gmail.com', '0204-7864567', 'House # 323 Main Strt Lahore', 1605, 31, '9023-4323-567-9')

--salary is in dollars
select * from Employees

INSERT INTO [Guests] values
('alison_holt', 'password123', 'Alison', 'Holt', '12345-6789101-1', 'F', '1993-05-01', 'alison.holt@hotmail.com', '012-34567890'),
('usman_jameel', 'usman456', 'Usman', 'Jameel', '23456-7891011-2', 'M', '1998-02-14', 'usman.jameel@gmail.com', '098-76543210'),
('bob_johnson', 'bJohn789', 'Bob', 'Johnson', '34567-8910112-3', 'M', '1981-11-30', 'bob.johnson@example.com', '021-23456789'),
('aimen_raihan', '123_aimenn', 'Aimen', 'Raihan', '65243-7838926-9', 'F', '1992-12-03', 'raihanaimen3@yahoo.com', '709-67549002')

INSERT INTO [Guests] values
('mhamza', '123hamza', 'Muhammad', 'Hamza', '56734-7856431-0', 'M', '2002-11-30', 'm.hamza@gmail.com', '987-76545324'),
('aliahmad', '123ali', 'Ali', 'Ahmad', '09876-3412007-0', 'M', '2000-01-12', 'ali.ahmad@gmail.com', '765-45321090')

select * from Guests

INSERT INTO [Cars] Values
(1, 'Luxury Sedan', 'Toyota','Toyota Camry SE',  2022, 'Midnight Black Metallic', 7, 4.5, 80, 9,0),
(2, 'Luxury SUV', 'Land Rover','Range Rover Sport Autobiography',  2022, 'Fuji White', 12, 4.7, 250, 7,0),
(3, 'Electric Car', 'Tesla','Tesla Model 3  Long Range',  2022, 'Deep Blue Metallic', 9, 4.5, 150, 5,0),
(4, 'Sports Car', 'Lamborghini','Lamborghini Huracan Performante',  2018, 'Verde Mantis (Green)', 4, 4.3, 300, 3,0);

select * from [Cars]

INSERT INTO [Discount] values
('D1_Rholiday', '2023-04-22', '2023-04-28', 30, 'Rooms', 'Flat 30% on all rooms'),
('D2_Swater', '2023-05-02', '2023-05-05', 20, 'Services', '20% off on water park tickets')

select * from Discount

INSERT INTO [Premium Packages] values
(1, 'All', 45, '2023-05-05', '2023-06-05' ),          --all means on total bill
(2, 'Services', 35, '2023-05-05', '2023-07-05')

 select * from [Premium Packages]

 Insert into [Travel Guides] values
 ('TG_01', '5 years of working experience in this field. Specializes in cultural sites and architectural sites.', 4.3, 'available'),
 ('TG_02', '7 years of working in this field. Specializes in natural scenic points', 4.5, 'available'),
 ('TG_03', '3 years of working in this field. Specializes in food points, culture and heritage sites.', 3.9, 'available'),
 ('TG_04', '10 years of working in this field. Specializes in food points, culture and heritage sites as well as nature.', 4.8, 'available') --if status is booked NA

 select * from [Travel Guides]

INSERT INTO [Q/A] VALUES ('mhamza', 'What are the check-in and check-out times at the hotel?', ' The standard check-in time is 3:00 PM and check-out time is 12:00 PM.')
INSERT INTO [Q/A] VALUES ('mhamza', 'Does the hotel offer airport shuttle service?', ' Yes, the hotel provides airport shuttle service for an additional fee. Please contact the front desk to arrange for pick-up and drop-off.')
INSERT INTO [Q/A] VALUES ('mhamza', ' Is there a fitness center on-site?', '  Yes, the hotel has a fully-equipped fitness center available to guests 24 hours a day. ')

Select * from [Q/A] ORDER BY [Question_ID] DESC

INSERT INTO [Reviews] VALUES ('mhamza', 'The hotel was amazing, with excellent facilities and a great location. 
                        The staff were very friendly and helpful, making our stay even more enjoyable.', 5)
INSERT INTO [Reviews] VALUES ('aliahmad', 'We had a fantastic time at the resort. The rooms were spacious and comfortable, with beautiful views of the surrounding area.
                        The on-site restaurant served delicious food and the pool was a great place to relax.', 5)
INSERT INTO [Reviews] VALUES ('mhamza', 'Our stay at the hotel was perfect. The staff went above and beyond to make sure we had everything we needed and the room was clean and well-maintained.
                        The location was ideal, with plenty of nearby attractions to explore.', 5)
INSERT INTO [Reviews] VALUES ('aliahmad', 'The resort exceeded our expectations in every way. The amenities were top-notch and the staff were incredibly accommodating. 
                        We particularly enjoyed the spa services and the outdoor activities available on-site. We cant wait to return!', 4)

Select * from [Reviews]

 INSERT INTO [Bookings] (Guest_ID, Status) Values
 (1, 'Inactive')       --status will turn to inactive after check-out date and noOfbookedItem will decrement 

 select * from [Bookings]
 select * from [Car Booking]
 select * from [Room Booking]
 select * from Bill
 select * from Rooms

 INSERT INTO [Room Booking] (Guest_ID, Room_ID, Number, Booking_Date, Check_In, Check_Out) Values
 (1, 'gview_02',1, '2022-12-28', '2023-01-02', '2023-01-09')

 INSERT INTO [Room Booking] (Guest_ID, Room_ID, Number, Booking_Date, Check_In, Check_Out) Values
 (3, 'fam_04',2, '2023-04-23', '2023-04-26', '2023-04-29')

 INSERT INTO [Room Booking] (Guest_ID, Room_ID, Number,Booking_Date, Check_In, Check_Out) Values
 (2, 'exec_03',1, '2023-04-22', '2023-04-25', '2023-05-01')

 INSERT INTO [Room Booking] (Guest_ID, Room_ID, Number ,Booking_Date, Check_In, Check_Out) Values
 (2, 'std_05',3, '2022-12-28', '2023-01-02', '2023-01-09')

 INSERT INTO [Room Booking] (Guest_ID, Room_ID, Number ,Booking_Date, Check_In, Check_Out) Values
 (1, 'std_05',1, '2022-12-28', '2023-01-02', '2023-01-09')

 INSERT INTO [Guests] (Guest_ID, Username, Password, Number ,Booking_Date, Check_In, Check_Out) Values
 (1, 'std_05',1, '2022-12-28', '2023-01-02', '2023-01-09')

 update [Room Booking]
 set Check_Out = '2023-01-09' where RB_ID = 1
 --update Rooms
 --set NoOfBookedRooms = 0
 --where NoOfBookedRooms != 0

 delete from bookings where Booking_ID = 5
 delete from [Room Booking] where RB_ID =9 or rb_id = 10 or rb_id = 11 or  rb_id = 2 or RB_ID = 5
 delete from [Bill] where InvoiceNo =4 or InvoiceNo =5

select * from [Car Booking]
select * from Cars

INSERT INTO [Car Booking] (Guest_ID, Car_ID, Start_time, End_time) Values
(1, 3, '7:30', '10:30')

INSERT INTO [Car Booking] ( Guest_ID, Car_ID, Start_time, End_time) Values
(2, 1, '8:00', '13:00')

--update [Car Booking]
--set End_time = '11:30'
--where CB_ID = 1

--update Cars
--set NoOfBookedCars = 0
--where NoOfBookedCars != 0

--delete from [Car Booking] where CB_ID = 1 or CB_ID = 2

select * from [Service Booking]
select * from [Room Booking]
select * from [Car Booking]
select * from [Q/A]

Insert INTO [Service Booking] ( Guest_ID, Service_ID, Start_Date, End_Date) Values 
( 2, 2, '2023-04-25', '2023-04-27')
Insert INTO [Service Booking] (SB_ID, Guest_ID, Service_ID, Start_Date, End_Date) Values 
(3, 3, 3, '2023-04-26', '2023-04-30')

update [Service Booking]
set End_Date = '2023-04-26'
where SB_ID = 1




----------------------------------------------------------------------------------------------------------------
--Views

create view Travel_guide_info 
as
   select t.[Emp_ID] ,e.[First Name],e.[Last Name] , e.Gender, t.[Experience] , t.[Rating] from  [Travel Guides] t join  Employees e   on e.Emp_ID=t.Emp_ID;
   select * from Travel_guide_info 
Alter Table [Travel Guides] add [statuss] varchar(15)
Alter Table [Travel Guides] add constraint FK_TG2 foreign key (Emp_ID) references [Employees] (Emp_ID) on delete Cascade on update Cascade


CREATE View BookingHistory
AS
SELECT [Room Booking].Guest_ID As Guest_ID,[Room Booking].RB_ID as [Booking_No], Rooms.Type As [Room_Type], [Room Booking].Booking_Date As [Room_Booking_Date], [Room Booking].Number as [Quantity], [Room Booking].Price As [Price],[Room Booking].SpecialRequest As [Special_Request] FROM Rooms Join [Room Booking] on Rooms.Room_ID = [Room Booking].Room_ID
go

CREATE View CarBookingHistory
AS
SELECT [Car Booking].Guest_ID as Guest_ID,  Cars.Model As [Car_Type], Cars.Price As [Price], [Car Booking].Quantity as [Quantity] from [Cars] Join [Car Booking] on Cars.Car_iD = [Car Booking].Car_ID
go

Select * from CarBookingHistory
Select * from [Cars]
Select * from [Car Booking]

Select * from BookingHistory
select * from rooms
Select * from [Room Booking]

CREATE VIEW AvailableRooms
As
SELECT ([NoOfRooms] - [NoOfBookedRooms]) As [Available Room] FROM  Rooms Where [NoOfBookedRooms] < [NoOfRooms]
go
SELECT [Available Room] FROM AvailableRooms

go
CREATE view roomsprice
as
select rb.Booking_ID, rb.Check_In, rb.Check_Out, rb.Room_ID, rb.Number, r.Price, (DATEDIFF(day, rb.Check_In, rb.Check_Out) * r.Price * rb.Number) as diff from [Room Booking] as rb 
join Rooms as r on rb.Room_ID = r.Room_ID
go

go
CREATE view carsprice
as
select cb.Booking_ID, cb.Start_time,cb.End_time, cb.Car_ID, c.Price, (DATEDIFF(HOUR, cb.Start_time, cb.End_time) * c.Price) as diff from [Car Booking] as cb 
join Cars as c on cb.Car_ID = c.Car_iD
go

go
CREATE view serviceprice
as
select sb.Booking_ID, sb.Start_Date,sb.End_Date, sb.Service_ID, s.Price, (DATEDIFF(DAY, sb.Start_Date, sb.End_Date) * s.Price) as diff from [Service Booking] as sb 
join Services as s on sb.Service_ID =s.Service_ID
go

select * from roomsprice
select * from carsprice
select * from serviceprice

--Checking availability of rooms
go
CREATE VIEW AvailableRooms1
As
SELECT [Type] As [Room Type], [Price], [NoOfPeople] As [Accomodation], ([NoOfRooms] - [NoOfBookedRooms]) As [Available Rooms] FROM  Rooms Where [NoOfBookedRooms] < [NoOfRooms]
go
SELECT * FROM AvailableRooms1


--Displaying Booking History





--Checking availability of cars
go
CREATE VIEW AvailableCars
As
SELECT [Type] as [Car Type], [Brand], [Model], [Production Year],[Color], [NoOfCustomerUsage], [Rating], [Price] As [Price Per Hour], ([NoOfCars] - [NoOfBookedCars]) As [Available Cars] From [Cars] 
go
SELECT * FROM AvailableCars
drop view AvailableCars

go
CREATE VIEW AvailableCars
As
SELECT  ([NoOfCars] - [NoOfBookedCars]) As [Available Car] From [Cars] 
go
SELECT [Available Car] FROM AvailableCars

--Displaying all travel guides and checking their availability 
go
CREATE VIEW allTravelGuides
AS
select e.[First Name], e.[Last Name], e.Gender,e.Age, tg.Experience, tg.Rating from Employees e join [Travel Guides] tg 
on tg.Emp_ID = e.Emp_ID where e.Emp_ID LIKE 'TG%'
go

go
CREATE VIEW AvailableTravelGuides
AS
select e.[First Name], e.[Last Name], e.Gender,e.Age, tg.Experience, tg.Rating from Employees e join [Travel Guides] tg 
on tg.Emp_ID = e.Emp_ID where e.Emp_ID LIKE 'TG%' AND tg.status = 'available'
go

 select * from allTravelGuides
 select * from AvailableTravelGuides







--Triggers------------------------------------------------------------------------------------------------------
drop trigger trg_bookingID
go
Create TRIGGER trg_bookingID
ON [Room Booking]
AFTER INSERT
AS
BEGIN
	declare @guestID int, @bookingID int, @bkID int, @bookedRooms int, @availRooms int, @room varchar(20), @num int
	select @guestID = Guest_ID from inserted
    
    SELECT @bookingID = Booking_ID FROM Bookings WHERE Guest_ID = @guestID AND Status = 'active'
    
    IF @bookingID IS NULL
    BEGIN
        INSERT INTO Bookings(Guest_ID, status) VALUES (@guestID, 'active')
        
        SELECT @bookingID = SCOPE_IDENTITY()
    END
    
    UPDATE [Room Booking]
    SET Booking_ID = @bookingID
    WHERE Guest_ID = @guestID

	select @room = room_id from inserted
	select @num = number from inserted
	select @room as room
	select @bkID = booking_ID from [Room Booking]
	select @bkID as bhghg
	execute price
	@bID = @bkID,
	@gID = @guestID

	select @bookedRooms = NoOfBookedRooms from Rooms where Room_ID = @room
	select @availRooms = NoOfRooms from Rooms where Room_ID = @room

 if (@bookedRooms = @availRooms)
  begin
		print 'This room type is completely booked.'
  end
else
 begin
		update Rooms
		set NoOfBookedRooms = NoOfBookedRooms + @num
		where Room_ID = @room
 end
END
go

go
Alter TRIGGER update_bill
ON Bookings
AFTER UPDATE, DELETE
AS
BEGIN
declare @bookingID int, @newB_ID int 
    IF EXISTS(SELECT * FROM inserted)
    BEGIN
		IF EXISTS(SELECT * FROM deleted)
			begin
				--update 
				select @bookingID = booking_ID from inserted
				select @newB_ID = booking_Id from deleted
				update bill 
				set Booking_ID = @bookingID
				where BILL.Booking_ID = @newB_ID
			end 
    END
    IF EXISTS(SELECT * FROM deleted)
    BEGIN
		select @bookingID = booking_ID from deleted
        Delete from Bill WHERE Booking_ID = @bookingID
    END
END;
go

--Trigger for FK constraint on room, car, services bookings table to avoid error of multiple cascading paths 
go
CREATE TRIGGER update_bookings
ON Guests
AFTER UPDATE, DELETE
AS
BEGIN
declare @gID int, @newG_ID int 
    IF EXISTS(SELECT * FROM inserted)
    BEGIN
		IF EXISTS(SELECT * FROM deleted)
			begin
				--update 
				select @gID = Guest_ID from inserted
				select @newG_ID = Guest_ID from deleted

				update [Car Booking] 
				set Guest_ID = @gID
				where [Car Booking].Guest_ID = @newG_ID

				update [Service Booking] 
				set Guest_ID = @gID
				where [Service Booking].Guest_ID = @newG_ID

				update [Room Booking]
				set guest_ID = @gID
				where [Room Booking].Guest_ID = @newG_ID
			end 
    END
    IF EXISTS(SELECT * FROM deleted)
    BEGIN
		select @gID = Guest_ID from deleted
        Delete from [Car Booking] WHERE Guest_ID = @gID
		Delete from [Service Booking] WHERE Guest_ID = @gID
		Delete from [Room Booking] WHERE Guest_ID = @gID
    END
END;
go

--Trigger for updating the number of rooms and price as well as handles the bookingID 
go
alter TRIGGER trg_bookingID
ON [Room Booking]
AFTER INSERT
AS
BEGIN
	declare @guestID int, @bookingID int, @bkID int, @bookedRooms int, @availRooms int, @room varchar(20), @num int
	select @guestID = Guest_ID from inserted
    
    SELECT @bookingID = Booking_ID FROM Bookings WHERE Guest_ID = @guestID AND Status = 'active'
    
    IF @bookingID IS NULL
    BEGIN
        INSERT INTO Bookings(Guest_ID, status) VALUES (@guestID, 'active')
        
        SELECT @bookingID = SCOPE_IDENTITY()
    END
    
    UPDATE [Room Booking]
    SET Booking_ID = @bookingID
    WHERE Guest_ID = @guestID

	select @room = room_id from inserted
	select @num = number from inserted
	select @room as room
	select @bkID = booking_ID from [Room Booking]
	select @bkID as bhghg
	execute price
	@bID = @bkID,
	@gID = @guestID

	select @bookedRooms = NoOfBookedRooms from Rooms where Room_ID = @room
	select @availRooms = NoOfRooms from Rooms where Room_ID = @room

 if (@bookedRooms = @availRooms)
  begin
		print 'This room type is completely booked.'
  end
else
 begin
		update Rooms
		set NoOfBookedRooms = NoOfBookedRooms + @num
		where Room_ID = @room
 end
END
go


--Trigger for updating the number of cars and price as well as handles the bookingID 
go
Create TRIGGER trg_bookingID_Cars
ON [Car Booking]
AFTER INSERT, UPDATE 
AS
BEGIN
	declare @guestID int, @bookingID int, @cdID int, @bkID int, @bookedcars int, @availCars int, @car int
	select @guestID = Guest_ID from inserted
	select @cdID = CB_ID from inserted
    
    SELECT @bookingID = Booking_ID FROM Bookings WHERE Guest_ID = @guestID AND Status = 'active'
    
    IF @bookingID IS NULL
    BEGIN
        --no active bookingID means no room has been booked so user can not book car. So, delete the record from table and display error msg
		delete from [Car Booking] where CB_ID = @cdID
		print 'You have not booked any room yet. Confirm your stay before booking car!'
    END

	else
	begin
		UPDATE [Car Booking]
		SET Booking_ID = @bookingID
		WHERE Guest_ID = @guestID
	

	select @car = Car_ID from inserted
	select @car as car			--car type ID
	select @cdID as carbookID  --car booking ID
	select @bkID = booking_id from [Car Booking]
	execute price_car
	@bID = @bkID,
	@cID = @cdID,
	@gID = @guestID

	select @bookedcars = NoOfBookedCars from Cars where Car_iD = @car
	select @availCars = NoOfCars from Cars where Car_iD = @car

 if (@bookedcars = @availCars)
  begin
		print 'This car type is completely booked.'
  end
else
 begin
		update Cars
		set NoOfBookedCars = NoOfBookedCars + 1
		where Car_iD = @car

		update Cars
		set NoOfCustomerUsage = NoOfCustomerUsage + 1
		where Car_iD = @car
 end
 end
END
go
--Trigger for updating price of services as well as handles the bookingID
go
CREATE TRIGGER trg_bookingID_Services
ON [Service Booking]
AFTER INSERT, UPDATE 
AS
BEGIN
	declare @guestID int, @bookingID int, @sdID int, @bkID int, @service int, @cIN date, @cout DATE, @sin datetime, @sout datetime
	select @guestID = Guest_ID from inserted
	select @sdID = SB_ID from inserted
    
    SELECT @bookingID = Booking_ID FROM Bookings WHERE Guest_ID = @guestID AND Status = 'active'
    
    IF @bookingID IS NULL
    BEGIN
        --no active bookingID means no room has been booked so user can not book service. So, delete the record from table and display error msg
		delete from [Service Booking] where SB_ID = @sdID
		print 'You have not booked any room yet. Confirm your stay before booking service!'
    END
    
    UPDATE [Service Booking] 
    SET Booking_ID = @bookingID
    WHERE Guest_ID = @guestID

	select @service = Service_ID from inserted
	select @service as [service]
	select @sdID as serviceID
	select @bkID = booking_id from [Service Booking]
	execute price_services
	@bID = @bkID,
	@sID = @sdID

	select @cIN = check_in from [Room Booking] where Booking_ID = @bkID
	select @cout = Check_Out from [Room Booking] where Booking_ID = @bkID
	select @sin = Start_Date from inserted
	select @sout = End_Date from inserted
	select @sout as serviceOut 

	if (@sin < @cIN OR @sout > @cout)
		begin
			print'You can only book a service for the days you are in the resort'
			delete from [Service Booking] where SB_ID = @sdID
		end
 
END
go

--Trigger to update total price in bill table
drop trigger trg_bill
go
Create Trigger trg_bill
ON [Bill]
AFTER INSERT, UPDATE
AS
BEGIN
	declare @invo int 
	select @invo = invoiceNo from inserted 

	Update Bill 
	SET TotalBill = RoomCharge + ServiceCharges + CarCharges + PremiumPay
	where invoiceno = @invo

END
go




 --------------------------------------------------------------------------------Procedures-------------------------------------------------------------------------------------------------------------------
--Procedure for updating price and number of rooms once a booking is made
go
Create PROCEDURE price
@bID int, @gID int 
AS
BEGIN
	declare @d float, @invoice int 
	select @d = diff from roomsprice where Booking_ID = @bID
	select @d as d
	Update [Room Booking]
	SET Price = @d
	Where Booking_ID = @bID AND Price IS NULL

	SELECT @invoice = InvoiceNo from Bill where Booking_ID = @bID
	if(@invoice IS not null) 
		begin
			UPDATE Bill
			SET RoomCharge = RoomCharge + @d
			WHERE InvoiceNo = @invoice
		end
	else
		begin
			INSERT INTO Bill (Guest_ID, Booking_ID, RoomCharge, TotalBill) VALUES (@gID, @bID, @d, 1)
		end
END 
go


--Procedure for updating price and number of cars once a booking is made
go
Create PROCEDURE price_car
@bID int, @cID int, @gID int 
AS
BEGIN
	declare @d float, @invoice int 
	select @d = diff from carsprice where Booking_ID = @bID
	select @d as d

	Update [Car Booking]
	SET Price = @d
	Where CB_ID = @cID

	SELECT @invoice = InvoiceNo from Bill where Booking_ID = @bID
	if(@invoice IS not null) 
		begin
			UPDATE Bill
			SET CarCharges = CarCharges + @d
			WHERE InvoiceNo = @invoice
		end
	else
		begin
			INSERT INTO Bill (Guest_ID, Booking_ID, CarCharges, TotalBill) VALUES (@gID, @bID, @d, 0)
		end
END 
go

--Procedure for updating price of services once a booking is made
go
CREATE PROCEDURE price_services
@bID int, @sID int
AS
BEGIN
	declare @d float 
	select @d = diff from serviceprice where Booking_ID = @bID
	select @d as d

	Update [Service Booking] 
	SET Price = @d
	Where SB_ID = @sID
END 
go

 

---- Procedure for User History Display
go
CREATE View RoomDetails
AS
SELECT [Room Booking].Guest_ID As Guest_ID, Rooms.Type As [Room Type], Rooms.Price As [Room Price], Rooms.NoOfPeople [Room Adult Accomodation], [Room Booking].Booking_Date As [Room Booking Date], [Room Booking].Check_In As [Room Check In DateTime], [Room Booking].Check_Out As [Room Check Out DateTime], [Room Booking].Price As [Room Booking Price],[Room Booking].SpecialRequest As [Room Booking Special Request] FROM Rooms Join [Room Booking] on Rooms.Room_ID = [Room Booking].Room_ID
go

CREATE View ServiceDetails
As
SELECT [Service Booking].Guest_ID As Guest_ID, [Services].Type As [Services Type], [Services].Description As [Services Description], [Services].Price As [Services Price], [Services].Start_Time As [Services Start Time], [Services].End_time As [Services End Time], [Service Booking].Start_Date As [Service Booking Start DateTime], [Service Booking].End_Date As [Service Booking End DateTime], [Service Booking].Price As [Service Booking Price] FROM [Services] Join [Service Booking] on [Services].Service_ID = [Service Booking].Service_ID
go

CREATE View CarDetails
As
SELECT [Car Booking].Guest_ID As Guest_ID, [Cars].Type As [Car Type], [Cars].Brand As [Car Brand], [Cars].Model As [Car Model], [Cars].[Production Year] As [Car Production Year], [Cars].NoOfCustomerUsage As [Car Customer Usage], [Cars].Rating As [Car Rating], [Cars].Price As [Car Price Per Hour] ,[Car Booking].Start_time As [Car Booking Start Time], [Car Booking].End_time As [Car Booking End Time], [Car Booking].pickup_location As [Car PickUp Location], [Car Booking].dropoff_location As [Car DropOff Location], [Car Booking].Price As [Car Booking Price]  FROM Cars Join [Car Booking] on Cars.Car_iD = [Car Booking].Car_ID
go

CREATE PROCEDURE CarDEETS
@c_guestID int
As Begin
Select * FROM CarDetails Where CarDetails.Guest_ID = @c_guestID
END
go

CREATE PROCEDURE RoomDEETS
@r_guestID int
As Begin
Select * FROM RoomDetails Where RoomDetails.Guest_ID = @r_guestID
END
go

CREATE PROCEDURE ServiceDEETS
@s_guestID int
As Begin
Select * FROM ServiceDetails Where ServiceDetails.Guest_ID = @s_guestID
END
go

CREATE PROCEDURE [User History]
@guestID int
As Begin
Exec CarDEETS @c_guestID = @guestID
Exec RoomDEETS @r_guestID = @guestID
Exec ServiceDEETS @s_guestID = @guestID
END

Exec [User History] @guestID = 2

--Procedure to update booking status to ensure active booking updated only
USE Project ;  
GO  
EXEC dbo.sp_add_job  
    @job_name = N'Daily Booking Status Updation' ;  
GO  
EXEC sp_add_jobstep  
    @job_name = N'Daily Booking Status Updation',  
    @step_name = N'Set BookingStatus to Inactive',  
    @subsystem = N'TSQL',
	@command = N'Update Bookings Set Status = ''inactive'' Where Booking_ID IN (SELECT Booking_ID FROM [BookingStatus_CheckoutDate] where check_out = GETDATE())',
    @retry_attempts = 5,  
    @retry_interval = 5 ;  
GO  
EXEC dbo.sp_add_schedule  
    @schedule_name = N'RunOnceDaily',  
    @freq_type = 4,  
	@freq_interval = 4,
    @active_start_time = 000000 ;  

GO    
EXEC sp_attach_schedule  
   @job_name = N'Daily Booking Status Updation',  
   @schedule_name = N'RunOnceDaily';  
GO  
EXEC dbo.sp_add_jobserver  
    @job_name = N'Daily Booking Status Updation';  
GO  

CREATE VIEW [BookingStatus_CheckoutDate]
As
SELECT [Room Booking].Check_Out, Bookings.Booking_ID,[Bookings].[Status] FROM Bookings Join [Room Booking] on [Bookings].[Booking_ID] = [Room Booking].Booking_ID



-------------------Changes---------
CREATE TABLE [Cars] 
(
  [Car_iD] int NOT NULL,
  [Type] varchar(20),
  [Brand] varchar(20),
  [Model] varchar(50),
  [Production Year] int,
  [Color] varchar(50),
  [NoOfCustomerUsage] int,
  [Rating] float,
  [Price] float,
  [NoOfCars] int NOT NULL,
  [NoOfBookedCars] int

  PRIMARY KEY ([Car_iD])
);

CREATE TABLE [Travel Guides] 
(
  [Emp_ID] varchar(8) NOT NULL UNIQUE,
  [Experience] Text,
  [Rating] float,
  [Status] varchar(15)
);

Alter Table [Travel Guides] add constraint FK_TG foreign key (Emp_ID) references [Employees] (Emp_ID) on delete Cascade on update Cascade

CREATE TABLE [Car Booking] 
(
  [CB_ID] int NOT NULL,
  [Booking_ID] int,
  [Guest_ID] int NOT NULL,
  [Car_ID] int NOT NULL,
  [TravelGuide] varchar(8),
  [Start_time] datetime NOT NULL,
  [End_time] datetime NOT NULL,
  [pickup_location] varchar(20),
  [dropoff_location] varchar(20),
  [Price] float,
  [tg_rating] int

  PRIMARY KEY ([CB_ID])
);
select * from  [Car Booking] 
ALTER table [Car Booking] add [pickup_date] date ;
ALTER table [Car Booking] add [return_date] date ;

alter table [Car Booking] alter COLUMN  [pickup_location] varchar(50);
 alter table [Car Booking] alter COLUMN [dropoff_location] varchar(50);
alter table [Car Booking] alter COLUMN [pickup_date] date;
 alter table [Car Booking] alter COLUMN [return_date] date;
 ALTER table [Car Booking] alter COLUMN [Start_time] TIME(0);
 ALTER table [Car Booking] alter COLUMN  [End_time] TIME(0);
  ALTER table [Car Booking] add Quantity int ;
Alter Table [Car Booking] add constraint FK_CARBOOKING1 foreign key (Booking_ID) references [Bookings] (Booking_ID) on delete Cascade on update Cascade
Alter Table [Car Booking] add constraint FK_CARBOOKING2 foreign key (Car_ID) references [Cars] (Car_ID) on delete Cascade on update Cascade
Alter Table [Car Booking] add constraint FK_CARBOOKING3 foreign key (TravelGuide) references [Travel Guides] (Emp_ID) on delete cascade on update cascade
Alter Table [Car Booking] add constraint FK_CARBOOKING4 foreign key (Guest_ID) references [Guests] (Guest_ID)


CREATE View CarBookingHistory
AS
SELECT [Car Booking].Guest_ID as Guest_ID,  Cars.Model As [Car_Type], Cars.Price As [Price], [Car Booking].Quantity as [Quantity] from [Cars] Join [Car Booking] on Cars.Car_iD = [Car Booking].Car_ID
go



ALTER TABLE [Bill] ADD CONSTRAINT SetRCD DEFAULT 0 FOR [RoomCharge];

ALTER TABLE [Bill] ADD CONSTRAINT SetSCD DEFAULT 0 FOR [ServiceCharges];

ALTER TABLE [Bill] ADD CONSTRAINT SetCCD DEFAULT 0 FOR [CarCharges];
ALTER TABLE [Bill] ADD CONSTRAINT SetPPD DEFAULT 0 FOR [PremiumPay];

ALTER TABLE [Bill] ADD CONSTRAINT SetPTB DEFAULT 0 FOR [TotalBill];
ALTER TABLE [Bill] ADD CONSTRAINT SetPNS DEFAULT 0 FOR [NoOfServices];

