# Added Procedures

## getBookById

Gets book and publisher info by the book id, reference create procedure in getBooksById.sql

### parameters

- inputId: INT (required)

### results

- book_id: INT
- title: STRING
- isbn: STRING
- isbn13: STRING
- pubyear: INT
- pubname: STRING
