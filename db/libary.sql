
CREATE TABLE Authors
(
	id_author  INTEGER NOT NULL,
	name  VARCHAR(20) NULL
)
;



ALTER TABLE Authors
	ADD  PRIMARY KEY (id_author)
;



CREATE TABLE Books
(
	name_book  VARCHAR(20) NULL,
	id_book  INTEGER NOT NULL,
	number_book  VARCHAR(20) NULL,
	year_book  DATE NULL,
	isbn_book  VARCHAR(20) NULL,
	wholeprice_book  INTEGER NULL,
	regdate_book  DATE NULL,
	discount_book  INTEGER NULL,
	retailprice_book  INTEGER NULL,
	isexist_book  BLOB NULL,
	numinstore_book  INTEGER NULL,
	id_genre  CHAR(18) NOT NULL,
	id_author  INTEGER NOT NULL,
	id_publisher  CHAR(18) NOT NULL
)
;



ALTER TABLE Books
	ADD  PRIMARY KEY (id_book,id_genre,id_author,id_publisher)
;



CREATE TABLE Genres
(
	id_genre  CHAR(18) NOT NULL,
	name  VARCHAR(20) NULL
)
;



ALTER TABLE Genres
	ADD  PRIMARY KEY (id_genre)
;



CREATE TABLE Orders
(
	id_order  CHAR(18) NOT NULL,
	isOrder  BLOB NULL,
	descripion_order  VARCHAR(20) NULL,
	date_order  DATE NULL,
	id_book  INTEGER NOT NULL,
	id_genre  CHAR(18) NOT NULL,
	id_author  INTEGER NOT NULL,
	id_publisher  CHAR(18) NOT NULL
)
;



ALTER TABLE Orders
	ADD  PRIMARY KEY (id_order,id_book,id_genre,id_author,id_publisher)
;



CREATE TABLE Publishers
(
	id_publisher  CHAR(18) NOT NULL,
	name  VARCHAR(20) NULL
)
;



ALTER TABLE Publishers
	ADD  PRIMARY KEY (id_publisher)
;



ALTER TABLE Books
	ADD FOREIGN KEY R_1 (id_genre) REFERENCES Genres(id_genre)
;


ALTER TABLE Books
	ADD FOREIGN KEY R_2 (id_author) REFERENCES Authors(id_author)
;


ALTER TABLE Books
	ADD FOREIGN KEY R_3 (id_publisher) REFERENCES Publishers(id_publisher)
;



ALTER TABLE Orders
	ADD FOREIGN KEY R_6 (id_book,id_genre,id_author,id_publisher) REFERENCES Books(id_book,id_genre,id_author,id_publisher)
;


