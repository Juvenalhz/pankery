CREATE TABLE tbl_caja_chica
(
  id integer NOT NULL DEFAULT nextval('caja_chica_id_seq'::regclass),
  total double precision NOT NULL,
  CONSTRAINT tbl_caja_chica_pkey PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE tbl_caja_chica
  OWNER TO postgres;


CREATE SEQUENCE caja_chica_id_seq
  INCREMENT 1
  MINVALUE 1
  MAXVALUE 9223372036854775807
  START 1
  CACHE 1;
ALTER TABLE caja_chica_id_seq
  OWNER TO postgres;

CREATE TABLE tbl_movimiestos_caja_chica
(
  id integer NOT NULL DEFAULT nextval('movimiestos_caja_chica_id_seq'::regclass),
  tipo_movimiento integer NOT NULL,
  cantidad double precision NOT NULL,
  usuario character varying(50),
  fecha_registro date NOT NULL DEFAULT now(),
  CONSTRAINT tbl_movimiestos_caja_chica_pkey PRIMARY KEY (id),
  CONSTRAINT tbl_movimiestos_caja_chica_tipo_movimiento_fkey FOREIGN KEY (tipo_movimiento)
      REFERENCES tbl_tipo_movimientos (id_movimiento) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE tbl_movimiestos_caja_chica
  OWNER TO postgres;


CREATE SEQUENCE movimiestos_caja_chica_id_seq
  INCREMENT 1
  MINVALUE 1
  MAXVALUE 9223372036854775807
  START 1
  CACHE 1;
ALTER TABLE movimiestos_caja_chica_id_seq
  OWNER TO postgres;

CREATE OR REPLACE FUNCTION sp_total_caja_chica()
  RETURNS TABLE(id_out integer,  total_out double precision) AS
$BODY$
	
	Begin

         return 	QUERY  
				
				SELECT id, total
					FROM tbl_caja_chica LIMIT 1;	

				
				
	End;

$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION sp_total_caja_chica()
  OWNER TO postgres;

CREATE TABLE tbl_tipo_movimientos
(
  id_movimiento serial NOT NULL,
  nombre character varying(50) NOT NULL,
  CONSTRAINT tbl_tipo_movimientos_pkey PRIMARY KEY (id_movimiento),
  CONSTRAINT tbl_tipo_movimientos_nombre_key UNIQUE (nombre)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE tbl_tipo_movimientos
  OWNER TO postgres;

CREATE SEQUENCE tbl_tipo_movimientos_id_movimiento_seq
  INCREMENT 1
  MINVALUE 1
  MAXVALUE 9223372036854775807
  START 1
  CACHE 1;
ALTER TABLE tbl_tipo_movimientos_id_movimiento_seq
  OWNER TO postgres;

INSERT INTO tbl_tipo_movimientos( nombre) VALUES ('INGRESO');
INSERT INTO tbl_tipo_movimientos( nombre) VALUES ('EGRESO');

