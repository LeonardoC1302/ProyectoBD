INSERT INTO type ("commentType", priority) values ('Quejas', 1);
INSERT INTO type ("commentType", priority) values ('Consulta', 1);
INSERT INTO type ("commentType", priority) values ('Recomendacion', 1);
INSERT INTO type ("commentType", priority) values ('Otro', 1);

select * from type;
select * from orders;
select * from comment;
select * from clients;

insert into orders (description, "clientId", date, total, status)
values ('', 1, '2023-11-21', 60.88, 'en camino')

delete from orders where id > 0;
ALTER SEQUENCE public.orders_id_seq RESTART WITH 1;

delete from comment where id > 0;
ALTER SEQUENCE public.comment_id_seq RESTART WITH 1;
