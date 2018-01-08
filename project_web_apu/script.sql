#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: HOTEL
#------------------------------------------------------------

CREATE TABLE HOTEL(
        id_hotel      int (11) Auto_increment  NOT NULL ,
        nom_hotel     Varchar (255) NOT NULL ,
        address_hotel Varchar (255) NOT NULL ,
        city_hotel    Varchar (255) NOT NULL ,
        country_hotel Varchar (255) NOT NULL ,
        PRIMARY KEY (id_hotel )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: ROOM
#------------------------------------------------------------

CREATE TABLE ROOM(
        id_room     int (11) Auto_increment  NOT NULL ,
        phone_room  Varchar (25) NOT NULL ,
        id_hotel    Int NOT NULL ,
        id_category Int NOT NULL ,
        PRIMARY KEY (id_room )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: CATEGORY
#------------------------------------------------------------

CREATE TABLE CATEGORY(
        id_category         int (11) Auto_increment  NOT NULL ,
        name_category       Varchar (255) NOT NULL ,
        floor_category      Int NOT NULL ,
        max_people_category Int NOT NULL ,
        smoking_category    Bool NOT NULL ,
        price_category      Float NOT NULL ,
        PRIMARY KEY (id_category )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: BOOKING
#------------------------------------------------------------

CREATE TABLE BOOKING(
        id_booking           int (11) Auto_increment  NOT NULL ,
        booking_date_booking Date NOT NULL ,
        check_in_booking     Date NOT NULL ,
        check_out_booking    Date NOT NULL ,
        people_booking       Int NOT NULL ,
        id_customer          Int NOT NULL ,
        PRIMARY KEY (id_booking )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: CUSTOMER
#------------------------------------------------------------

CREATE TABLE CUSTOMER(
        id_customer         int (11) Auto_increment  NOT NULL ,
        first_name_customer Varchar (255) NOT NULL ,
        last_name_customer  Varchar (255) NOT NULL ,
        e_mail_customer     Varchar (255) NOT NULL ,
        phone_customer      Varchar (255) NOT NULL ,
        address_customer    Varchar (255) NOT NULL ,
        city_customer       Varchar (255) NOT NULL ,
        country_customer    Varchar (255) NOT NULL ,
        passport_customer   Varchar (255) NOT NULL ,
        PRIMARY KEY (id_customer )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: EXTRAS
#------------------------------------------------------------

CREATE TABLE EXTRAS(
        id_extras    int (11) Auto_increment  NOT NULL ,
        name_extras  Varchar (255) NOT NULL ,
        price_extras Float NOT NULL ,
        PRIMARY KEY (id_extras )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: EMPLOYEE
#------------------------------------------------------------

CREATE TABLE EMPLOYEE(
        id_employee         int (11) Auto_increment  NOT NULL ,
        first_name_employee Varchar (255) NOT NULL ,
        last_name_employee  Varchar (255) NOT NULL ,
        e_mail_employee     Varchar (255) NOT NULL ,
        phone_employee      Varchar (255) NOT NULL ,
        job_employee        Varchar (255) NOT NULL ,
        password            Varchar (255) NOT NULL ,
        id_hotel            Int NOT NULL ,
        PRIMARY KEY (id_employee )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: BILL
#------------------------------------------------------------

CREATE TABLE BILL(
        id_bill          int (11) Auto_increment  NOT NULL ,
        price_bill       Float NOT NULL ,
        discount_bill    Float NOT NULL ,
        final_price_bill Float NOT NULL ,
        id_booking       Int NOT NULL ,
        PRIMARY KEY (id_bill )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: to concern
#------------------------------------------------------------

CREATE TABLE to_concern(
        id_booking Int NOT NULL ,
        id_room    Int NOT NULL ,
        PRIMARY KEY (id_booking ,id_room )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: to use
#------------------------------------------------------------

CREATE TABLE to_use(
        id_extras  Int NOT NULL ,
        id_booking Int NOT NULL ,
        PRIMARY KEY (id_extras ,id_booking )
)ENGINE=InnoDB;

ALTER TABLE ROOM ADD CONSTRAINT FK_ROOM_id_hotel FOREIGN KEY (id_hotel) REFERENCES HOTEL(id_hotel);
ALTER TABLE ROOM ADD CONSTRAINT FK_ROOM_id_category FOREIGN KEY (id_category) REFERENCES CATEGORY(id_category);
ALTER TABLE BOOKING ADD CONSTRAINT FK_BOOKING_id_customer FOREIGN KEY (id_customer) REFERENCES CUSTOMER(id_customer);
ALTER TABLE EMPLOYEE ADD CONSTRAINT FK_EMPLOYEE_id_hotel FOREIGN KEY (id_hotel) REFERENCES HOTEL(id_hotel);
ALTER TABLE BILL ADD CONSTRAINT FK_BILL_id_booking FOREIGN KEY (id_booking) REFERENCES BOOKING(id_booking);
ALTER TABLE to_concern ADD CONSTRAINT FK_to_concern_id_booking FOREIGN KEY (id_booking) REFERENCES BOOKING(id_booking);
ALTER TABLE to_concern ADD CONSTRAINT FK_to_concern_id_room FOREIGN KEY (id_room) REFERENCES ROOM(id_room);
ALTER TABLE to_use ADD CONSTRAINT FK_to_use_id_extras FOREIGN KEY (id_extras) REFERENCES EXTRAS(id_extras);
ALTER TABLE to_use ADD CONSTRAINT FK_to_use_id_booking FOREIGN KEY (id_booking) REFERENCES BOOKING(id_booking);
