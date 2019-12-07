DROP PROCEDURE IF EXISTS getBookById;
-- gets book info by its id
-- CALL getBookById(82);
delimiter $
create procedure getBookById(inputId INT)
BEGIN
    SELECT gb.book_id, gb.title,gb.isbn,gb.isbn13,gb.pubyear,gp.pubname
    FROM grbooks gb
    JOIN grpublishers gp ON (gp.publisher_id=gb.publisher_id)
    WHERE gb.book_id = inputId;
END $
delimiter ;