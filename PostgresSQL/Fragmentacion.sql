-- Frag 1
create view Fragmento1 AS
SELECT *
FROM comment
WHERE resolved =false;

-- Frag 2
create view Fragmento2 AS
SELECT *
FROM comment
WHERE resolved =true;

-- Frag 3
create view Fragmento3 AS
SELECT "clienteId", "ordenID", description, "typeId", date
FROM comment;
