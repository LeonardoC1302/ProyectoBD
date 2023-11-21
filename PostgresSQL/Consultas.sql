INSERT INTO type ("commentType", priority) values ('Quejas', 1);
INSERT INTO type ("commentType", priority) values ('Consulta', 1);
INSERT INTO type ("commentType", priority) values ('Recomendacion', 1);
INSERT INTO type ("commentType", priority) values ('Otro', 1);

select * from type;
select * from orders;
select * from comment;
select * from clients;

delete from orders where id > 0;
ALTER SEQUENCE public.orders_id_seq RESTART WITH 1;

update clients set name = 'Leche Pinito' where id = 4

delete from clients where id > 4;
ALTER SEQUENCE public.clients_id_seq RESTART WITH 5;
