CREATE TABLE books (
 bookid int(11) PRIMARY KEY AUTO_INCREMENT,
 authorid int(11) DEFAULT NULL,
 title varchar(55) DEFAULT NULL,
 ISBN varchar(25) DEFAULT NULL,
 pub_year smallint(6) DEFAULT NULL,
 available tinyint(4) DEFAULT NULL
)

INSERT INTO books (bookid, authorid, title, ISBN, pub_year, available) VALUES
(1, 1, 'Cuoi tuoi', 'Admin54', 1993, 2),
(2, 2, 'Vo ngua', 'Ngo5a4', 1998, 3),
(3, 3, 'Yeu em', 'at411', 1987, 1),
(4, 2, 'Tinh yeu mua thu', 'td554', 2000, 1),
(5, 1, 'Nang chieu', 'A2s', 2005, 2),
(6, 3, 'Em la duy nhat', 'av6y', 2002, 1);
(6, 2, 'Mua ha nang chieu', '7g6y', 2005, 1);
