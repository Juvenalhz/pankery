--
-- PostgreSQL database dump
--

-- Dumped from database version 9.3beta1
-- Dumped by pg_dump version 9.3beta1
-- Started on 2021-01-09 20:54:44

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- TOC entry 190 (class 3079 OID 11750)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2079 (class 0 OID 0)
-- Dependencies: 190
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

--
-- TOC entry 212 (class 1255 OID 89642)
-- Name: sp_actpreciocosto(integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION sp_actpreciocosto(idproduct integer) RETURNS numeric
    LANGUAGE plpgsql
    AS $$

	DECLARE 
		preciomp double precision;
		r record;
         	begin
			update tbl_productos
			set precio_und = 0
			where id_producto = idproduct;

			FOR r IN select * from  tbl_recetario where id_producto=idproduct
			LOOP
			preciomp:=(select precio_materiaprima from  tbl_materiaprima where id=r.id_materiaprima);
			update tbl_productos
			set precio_und = precio_und + (r.cantidad * preciomp)
			where id_producto = idproduct;
			--RETURN NEXT r; 
			END LOOP;


		return 1;

--select * from  sp_ActPrecioCosto(6)
--select * from  tbl_productos where 
-- 
-- select * from  tbl_recetario where id_producto = 6 limit 1 offset 1
-- select count(*) from  tbl_recetario where id_producto = 3
-- select * from tbl_materiaprima where id = 8 
-- 		


End;

$$;


ALTER FUNCTION public.sp_actpreciocosto(idproduct integer) OWNER TO postgres;

--
-- TOC entry 215 (class 1255 OID 81512)
-- Name: sp_actualizarmp(integer, double precision, character varying); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION sp_actualizarmp(materiap integer, cantidadmp double precision, accioncant character varying) RETURNS numeric
    LANGUAGE plpgsql
    AS $$
	
	DECLARE consultaMP integer;
	DECLARE cant_stock_MP double precision;
         	begin
		consultaMP:= (select count(*) from tbl_inventario where id_materiaprima = materiap); --Validando si existe en stock
		-- consultaMP = 0 no existe en stock
		if consultaMP = 0 or consultaMP is null then 
		INSERT INTO tbl_inventario(cant_stock, id_materiaprima)
		VALUES (cantidadmp, materiap);
		return 1;
		else -- si existe
		--buscando cantidad en stock del producto
		cant_stock_MP:= (select cant_stock from tbl_inventario where id_materiaprima = materiap);
		--validando si se agrega a stock o se resta
		--case when accionCant = 'rest' then   
		if accionCant = 'res' then cantidadmp =  cant_stock_MP - cantidadmp; else  cantidadmp = cant_stock_MP + cantidadmp; end if;
		if cantidadmp < 0 then return 0; else
		UPDATE tbl_inventario
		SET  cant_stock=cantidadmp
		WHERE id_materiaprima=materiap;
		return 1;
		--select * from sp_actualizarMP(8,1,'res')
		--select * from tbl_inventario
		end if;
		
		end if;
		
		

		


End;

$$;


ALTER FUNCTION public.sp_actualizarmp(materiap integer, cantidadmp double precision, accioncant character varying) OWNER TO postgres;

--
-- TOC entry 217 (class 1255 OID 81514)
-- Name: sp_busquedapedido(integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION sp_busquedapedido(id integer) RETURNS TABLE(id_pedidos integer, descr character varying, precio_und double precision, total double precision, fecha date, estatus text, cantidad double precision, cliente character varying, usuario character varying, monto double precision, id_product integer)
    LANGUAGE plpgsql
    AS $$
	
	Begin

         return 	QUERY  
				
				SELECT e.id_pedidos, p.descrip, e.precio_und, e.total, e.fecha, case when e.estatus = 1 then 'PENDIENTE' when 
				e.estatus = 2 then 'PROCESO' else 'COBRANZA' end as status,
				e.cantidad, e.cliente, e.usuario, case when fi.montos is null then 0 else  fi.montos end, e.id_producto
				FROM tbl_pedidos e 
				inner join tbl_productos p on p.id_producto = e.id_producto
				left join (select f.id_pedido, sum(f.monto) as montos from tbl_finanzashist f GROUP BY id_pedido) fi on fi.id_pedido = e.id_pedidos
				where e.id_pedidos= id;
				
				
	End;
--select * from tbl_recetario
--select * from tbl_materiaprima
--select * from tbl_productos
--select * from sp_busquedaPedido(11)
$$;


ALTER FUNCTION public.sp_busquedapedido(id integer) OWNER TO postgres;

--
-- TOC entry 204 (class 1255 OID 56840)
-- Name: sp_cambioestatuspedido(integer, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION sp_cambioestatuspedido(status integer, idpedido integer) RETURNS numeric
    LANGUAGE plpgsql
    AS $$

         	begin
		UPDATE tbl_pedidos
		   SET  estatus=status
		 WHERE id_pedidos=idpedido;

		return 1;
--select * from  sp_cambioEstatusPedido(1,)
--select * from  tbl_pedidos
		


End;

$$;


ALTER FUNCTION public.sp_cambioestatuspedido(status integer, idpedido integer) OWNER TO postgres;

--
-- TOC entry 216 (class 1255 OID 81515)
-- Name: sp_consultaegresosfijos(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION sp_consultaegresosfijos() RETURNS TABLE(id_egresofijo integer, egresofijo character varying, costo double precision, fecha date, usuario character varying)
    LANGUAGE plpgsql
    AS $$
	
	Begin

         return 	QUERY  
				
				select * from tbl_egresosfijos;
				

				
				
	End;
--select * from tbl_recetario
--select * from tbl_materiaprima
--select * from tbl_productos
--select * from  sp_consultaGastos()
--select * from  tbl_inventario
$$;


ALTER FUNCTION public.sp_consultaegresosfijos() OWNER TO postgres;

--
-- TOC entry 218 (class 1255 OID 81516)
-- Name: sp_consultafinanza(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION sp_consultafinanza() RETURNS TABLE(id_finanzas integer, capital double precision)
    LANGUAGE plpgsql
    AS $$
	
	Begin

         return 	QUERY  
				
			select * from tbl_finanzas;
				
	End;
--select * from tbl_recetario
--select * from tbl_materiaprima
--select * from sp_consultahistfinanza()
$$;


ALTER FUNCTION public.sp_consultafinanza() OWNER TO postgres;

--
-- TOC entry 220 (class 1255 OID 81517)
-- Name: sp_consultagastomodif(integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION sp_consultagastomodif(idcompra integer) RETURNS TABLE(id_compra integer, gasto character varying, nro_compra character varying, fecha_compra date, cantidad_mp double precision, peso double precision, precio double precision, idgasto integer)
    LANGUAGE plpgsql
    AS $$
	
	Begin

         return 	QUERY  
				
				select c.id_compra, (case when c.id_materiaprima is null then e.egresofijo else i.materiaprima end) as gasto, 
				c.nro_compra, c.fecha_compra, c.cantidad_mp, c.peso, c.precio,
				(case when c.id_materiaprima is null then c.id_egresofijo else c.id_materiaprima end) as idgasto
				from tbl_compras c
				left join tbl_materiaprima i on c.id_materiaprima = i.id
				left join tbl_egresosfijos e on c.id_egresofijo = e.id_egresofijo
				where  c.id_compra = idCompra
				order by fecha_compra desc;	

				
			-- 8 - 55	finanzas - 560
	End;
--select * from tbl_recetario
--select * from tbl_materiaprima
--select * from tbl_finanzas
--select * from tbl_inventario
--select * from  sp_consultagastomodif()
$$;


ALTER FUNCTION public.sp_consultagastomodif(idcompra integer) OWNER TO postgres;

--
-- TOC entry 221 (class 1255 OID 81518)
-- Name: sp_consultagastos(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION sp_consultagastos() RETURNS TABLE(id_compra integer, gasto character varying, nro_compra character varying, fecha_compra date, cantidad_mp double precision, peso double precision, precio double precision, tipogasto text)
    LANGUAGE plpgsql
    AS $$
	
	Begin

         return 	QUERY  
				
				select c.id_compra, (case when c.id_materiaprima is null then egresofijo else i.materiaprima end) as gasto, 
				c.nro_compra, c.fecha_compra, c.cantidad_mp, c.peso, c.precio,
				(case when c.id_materiaprima is null then 'Egreso Fijo' else 'Materia Prima' end) as tipogasto
				from tbl_compras c
				left join tbl_materiaprima i on c.id_materiaprima = i.id
				left join tbl_egresosfijos e on c.id_egresofijo = e.id_egresofijo
				order by fecha_compra desc;	

				
				
	End;
--select * from tbl_compras
--select * from tbl_materiaprima
--select * from tbl_productos
--select * from  sp_consultaGastos()
--select * from  tbl_inventario
--select * from  tbl_egresosfijos
$$;


ALTER FUNCTION public.sp_consultagastos() OWNER TO postgres;

--
-- TOC entry 214 (class 1255 OID 81467)
-- Name: sp_consultahistfinanza(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION sp_consultahistfinanza() RETURNS TABLE(id_finanzahist integer, monto double precision, tipo text, concepto character varying, fecha date, usuario character varying, id_pedido integer, id_compra integer, descripcion text)
    LANGUAGE plpgsql
    AS $$
	
	Begin

         return 	QUERY  
				
			select hf.id_finanzahist, hf.monto, case when hf.tipo_tx = 1 then 'Ingreso' else 'Egreso' end as tipo, hf.concepto, 
			hf.fecha, hf.usuario, hf.id_pedido, hf.id_compra, case when hf.id_compra is null then concat_ws('', 'Pago pedido ', pr.descrip,' del cliente ',p.cliente) 
			else case when id_materiaprima is null then concat_ws('', 'Gasto ', ef.egresofijo) 
			 else  concat_ws('', 'Compra de ', mp.materiaprima)   end end as descripcion  from tbl_finanzashist hf
			left join tbl_pedidos p on p.id_pedidos = hf.id_pedido
			left join tbl_productos pr on p.id_producto = pr.id_producto
			left join tbl_compras c on c.id_compra = hf.id_compra
			left join tbl_materiaprima mp on mp.id = c.id_materiaprima
			left join tbl_egresosfijos ef on ef.id_egresofijo = c.id_egresofijo
			where hf.monto > 0;
				
	End;
--select * from tbl_recetario
--select * from tbl_materiaprima
--select * from sp_consultahistfinanza()
$$;


ALTER FUNCTION public.sp_consultahistfinanza() OWNER TO postgres;

--
-- TOC entry 219 (class 1255 OID 81520)
-- Name: sp_consultamp(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION sp_consultamp() RETURNS TABLE(id_mp integer, descp character varying, cant double precision)
    LANGUAGE plpgsql
    AS $$
	
	Begin

         return 	QUERY   SELECT e.id, e.materiaprima, case when i.cant_stock is null then 0 else i.cant_stock end
				FROM tbl_materiaprima e
				left join tbl_inventario i on i.id_materiaprima =  e.id;
	End;
--select * from tbl_inventario
--select * from sp_consultamp()
$$;


ALTER FUNCTION public.sp_consultamp() OWNER TO postgres;

--
-- TOC entry 222 (class 1255 OID 81521)
-- Name: sp_consultapedidos(integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION sp_consultapedidos(stats integer) RETURNS TABLE(id_pedidos integer, descr character varying, precio_und double precision, total double precision, fecha date, estatus text, cantidad double precision, cliente character varying, usuario character varying, monto double precision)
    LANGUAGE plpgsql
    AS $$
	
	Begin

         return 	QUERY  
				
				SELECT e.id_pedidos, p.descrip, e.precio_und, e.total, e.fecha, case when e.estatus = 1 then 'PENDIENTE' when e.estatus = 2 then 'PROCESO' else 'COBRANZA' end as status,
				e.cantidad, e.cliente, e.usuario, case when fi.montos is null then 0 else  fi.montos end
				FROM tbl_pedidos e 
				inner join tbl_productos p on p.id_producto = e.id_producto
				left join (select f.id_pedido, sum(f.monto) as montos from tbl_finanzashist f GROUP BY id_pedido) fi on fi.id_pedido = e.id_pedidos
				where e.estatus = stats;
				
				
	End;
--select * from tbl_recetario
--select * from tbl_materiaprima
--select * from tbl_productos
--select * from sp_consultaPedidos(1)
$$;


ALTER FUNCTION public.sp_consultapedidos(stats integer) OWNER TO postgres;

--
-- TOC entry 223 (class 1255 OID 81522)
-- Name: sp_consultaproductos(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION sp_consultaproductos() RETURNS TABLE(id_pro integer, descp character varying, precio double precision)
    LANGUAGE plpgsql
    AS $$
	
	Begin

         return 	QUERY   SELECT e.id_producto, e.descrip,e.precio_und
				FROM tbl_productos e
				where estatus =1;
	End;
--select * from tbl_productos
--select * from sp_consultaProductos()
--select * from tbl_recetario
$$;


ALTER FUNCTION public.sp_consultaproductos() OWNER TO postgres;

--
-- TOC entry 224 (class 1255 OID 81523)
-- Name: sp_consultaproductosventas(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION sp_consultaproductosventas() RETURNS TABLE(id_pro integer, descp character varying, precio double precision)
    LANGUAGE plpgsql
    AS $$
	
	Begin

         return 	QUERY   SELECT e.id_producto, e.descrip,e.precio_und
				FROM tbl_productos e
				inner join (SELECT DISTINCT id_producto FROM tbl_recetario) rec on rec.id_producto  = e.id_producto	
				where estatus =1;
	End;
--select * from tbl_productos
--select * from sp_consultaProductos()
--select * from tbl_recetario
$$;


ALTER FUNCTION public.sp_consultaproductosventas() OWNER TO postgres;

--
-- TOC entry 225 (class 1255 OID 81524)
-- Name: sp_consultareceta(integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION sp_consultareceta(id_product integer) RETURNS TABLE(id_receta integer, id_producto integer, materia_prima character varying, id_mp integer, cantidad double precision)
    LANGUAGE plpgsql
    AS $$
	
	Begin

         return 	QUERY  
				
				SELECT e.id_receta, e.id_producto, m.materiaprima, e.id_materiaprima, e.cantidad
				FROM tbl_recetario e
				inner join tbl_materiaprima m on id = id_materiaprima 
				where e.id_producto = id_product;
				
	End;
--select * from tbl_recetario
--select * from tbl_materiaprima
--select * from sp_consultaReceta(7)
$$;


ALTER FUNCTION public.sp_consultareceta(id_product integer) OWNER TO postgres;

--
-- TOC entry 208 (class 1255 OID 48626)
-- Name: sp_eliminararticulo(integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION sp_eliminararticulo(idmp integer) RETURNS numeric
    LANGUAGE plpgsql
    AS $$
	
	
         	begin
		DELETE FROM tbl_materiaprima
		WHERE id = idmp;

		DELETE FROM tbl_inventario
		WHERE id_materiaprima = idmp;

		return 1;

End;

$$;


ALTER FUNCTION public.sp_eliminararticulo(idmp integer) OWNER TO postgres;

--
-- TOC entry 205 (class 1255 OID 65032)
-- Name: sp_eliminarpedido(integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION sp_eliminarpedido(idpedido integer) RETURNS numeric
    LANGUAGE plpgsql
    AS $$
	
	declare validacionPago int;
         	begin
		validacionPago := (select count(*) from tbl_finanzashist where id_pedido = idpedido);
		if (validacionPago = 1) then
		DELETE FROM tbl_finanzashist
		WHERE id_pedido = idpedido;
		end if;
		DELETE FROM tbl_pedidos
		WHERE id_pedidos = idpedido;

		return 1;

End;

$$;


ALTER FUNCTION public.sp_eliminarpedido(idpedido integer) OWNER TO postgres;

--
-- TOC entry 203 (class 1255 OID 48603)
-- Name: sp_listamp(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION sp_listamp() RETURNS TABLE(id_mp integer, descp character varying, usuario character varying)
    LANGUAGE plpgsql
    AS $$
	
	Begin

         return 	QUERY   SELECT *  FROM tbl_materiaprima;
	End;

$$;


ALTER FUNCTION public.sp_listamp() OWNER TO postgres;

--
-- TOC entry 209 (class 1255 OID 81526)
-- Name: sp_modifgastoef(integer, date, double precision, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION sp_modifgastoef(egresofijo integer, fechacompra date, precionuevo double precision, idcompra integer) RETURNS numeric
    LANGUAGE plpgsql
    AS $$
	--select * from sp_nuevoModifGastoMP ('1', '1/1/2021', '1', '100', '200','001', '6');
	DECLARE precioanterior double precision;

         	begin
		precioanterior:=(select c.precio from tbl_compras c WHERE id_compra=idcompra);	--ubicando precio anterior en compra a editar compra
	

		UPDATE tbl_compras 
		   SET  fecha_compra=fechacompra, fecha_creacion=now(), precio=precionuevo, id_egresofijo=egresofijo
		 WHERE id_compra=idcompra;


		UPDATE tbl_finanzashist
		   SET monto=precionuevo, fecha=now()
		 WHERE id_compra=idcompra;
		
		UPDATE tbl_finanzas
		SET capital=(capital + precioanterior - precionuevo);

		return 1;

		--select * from tbl_compras
		--select * from tbl_finanzas
		--select * from tbl_finanzashist


End;

$$;


ALTER FUNCTION public.sp_modifgastoef(egresofijo integer, fechacompra date, precionuevo double precision, idcompra integer) OWNER TO postgres;

--
-- TOC entry 207 (class 1255 OID 48623)
-- Name: sp_modificararticulo(character varying, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION sp_modificararticulo(materiap character varying, idmp integer) RETURNS numeric
    LANGUAGE plpgsql
    AS $$
	
	DECLARE existe integer;
         	begin
		existe:= (select count(*) from tbl_materiaprima where upper(materiaprima) = materiap); --Validando si existe el nuevo producto
		if existe = 0 then -- si no existe, insert
		UPDATE tbl_materiaprima
		SET materiaprima=materiap
		WHERE id=idmp;

		return 1;
		else return 0; 
		end if;
--select * from  sp_nuevoarticulo('HARINA','1')
--select * from tbl_materiaprima
		


End;

$$;


ALTER FUNCTION public.sp_modificararticulo(materiap character varying, idmp integer) OWNER TO postgres;

--
-- TOC entry 210 (class 1255 OID 81528)
-- Name: sp_modificaregresofijo(character varying, double precision, character varying); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION sp_modificaregresofijo(ef character varying, gasto double precision, id character varying) RETURNS numeric
    LANGUAGE plpgsql
    AS $$
	
         	begin
		UPDATE tbl_egresosfijos
		SET egresofijo=ef, costo=gasto, fechacrea=now(), usuariocrea=''
		WHERE id_egresofijo=id::integer;

		return 1;


End;

$$;


ALTER FUNCTION public.sp_modificaregresofijo(ef character varying, gasto double precision, id character varying) OWNER TO postgres;

--
-- TOC entry 226 (class 1255 OID 81529)
-- Name: sp_modifpedido(integer, double precision, double precision, double precision, character varying, character varying, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION sp_modifpedido(producto integer, precio double precision, cant double precision, costo double precision, pago character varying, client character varying, idpedido integer) RETURNS numeric
    LANGUAGE plpgsql
    AS $$
	declare pagoanterior double precision;
	declare consultapagoanterior character varying;
	declare montosinpagoanterior double precision;
	Begin
--select * from sp_modifPedido('1','11','2','22','11','Josef','20')
--validando si pago llega vacio, setear 0
				pago = (case when pago != '' then  pago else '0' end);
				if (pago::double precision <= costo) then
					consultapagoanterior:=(select monto from tbl_finanzashist where id_pedido = idpedido); --capturando pago anterior
					pagoanterior = (case when  consultapagoanterior is null or consultapagoanterior = '' then 0 else consultapagoanterior::double precision end);
					--Validando que no sea 0, en caso afirmativo borrando registro de historico de pagos.
					if (pago::double precision = 0) then
						DELETE FROM tbl_finanzashist WHERE id_pedido = idpedido;
						UPDATE tbl_finanzas
						SET capital=(capital - pagoanterior);
					else
						UPDATE tbl_finanzashist
						SET monto=pago::double precision
						WHERE id_pedido = idpedido;

						
						UPDATE tbl_finanzas
						SET capital=(capital + pago::double precision - pagoanterior);
					end if;
					
					--actualizar pedido
					UPDATE tbl_pedidos
					   SET id_producto=producto, precio_und=precio, total=costo, cantidad=cantidad, cliente=client
					 WHERE id_pedidos = idpedido;
					 return 1;
				 else return 0;
				end if;

		

	End;
--delete from tbl_pedidos
--select * from tbl_finanzashist
$$;


ALTER FUNCTION public.sp_modifpedido(producto integer, precio double precision, cant double precision, costo double precision, pago character varying, client character varying, idpedido integer) OWNER TO postgres;

--
-- TOC entry 233 (class 1255 OID 89643)
-- Name: sp_nuevareceta(integer, integer, double precision, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION sp_nuevareceta(idproduct integer, idmp integer, cant double precision, indexx integer) RETURNS numeric
    LANGUAGE plpgsql
    AS $$

	DECLARE existe integer;
		cantmp integer;
		idrecetaanterior integer;
         	begin
		existe:= (select count(*) from tbl_recetario where id_materiaprima = idmp and id_producto=idproduct); --Validando si existe el nuevo producto
		if existe = 0 then -- si no existe, insert
			cantmp:= (select count(*) from tbl_recetario where id_producto=idproduct);
			if(indexx <= cantmp) then
				indexx=indexx-1;
				idrecetaanterior:=(select id_receta from tbl_recetario where id_producto=idproduct  order by id_receta asc limit 1 offset indexx );
				
				
				UPDATE tbl_recetario
				SET id_producto=idproduct, id_materiaprima=idmp, 
				cantidad=cant
				where id_receta = idrecetaanterior;
			else
				INSERT INTO tbl_recetario(id_producto, id_materiaprima,cantidad)
				VALUES (idproduct, idmp, cant);	
			end if;
		else 
			UPDATE tbl_recetario
			SET id_producto=idproduct, id_materiaprima=idmp, 
			cantidad=cant
			where id_materiaprima = idmp and id_producto=idproduct;
		end if;
		return 1;
--select * from  sp_nuevaReceta(3,12,100,2)
		--select * from tbl_recetario where id_producto=3 


End;

$$;


ALTER FUNCTION public.sp_nuevareceta(idproduct integer, idmp integer, cant double precision, indexx integer) OWNER TO postgres;

--
-- TOC entry 206 (class 1255 OID 48620)
-- Name: sp_nuevoarticulo(character varying); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION sp_nuevoarticulo(materiap character varying) RETURNS numeric
    LANGUAGE plpgsql
    AS $$
	
	DECLARE existe integer;
         	begin
		existe:= (select count(*) from tbl_materiaprima where upper(materiaprima) = materiap); --Validando si existe el nuevo producto
		if existe = 0 then -- si no existe, insert
		INSERT INTO tbl_materiaprima(materiaprima, usuario)
		VALUES (materiap, '');
		return 1;
		else return 0; 
		end if;
--select * from  sp_nuevoarticulo('HARINA')
		


End;

$$;


ALTER FUNCTION public.sp_nuevoarticulo(materiap character varying) OWNER TO postgres;

--
-- TOC entry 227 (class 1255 OID 81531)
-- Name: sp_nuevoegresofijo(character varying, double precision); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION sp_nuevoegresofijo(ef character varying, gasto double precision) RETURNS numeric
    LANGUAGE plpgsql
    AS $$
	
         	begin
	INSERT INTO tbl_egresosfijos(
             egresofijo, costo, fechacrea, usuariocrea)
    VALUES ( EF, gasto, now(), '');
		return 1;


End;

$$;


ALTER FUNCTION public.sp_nuevoegresofijo(ef character varying, gasto double precision) OWNER TO postgres;

--
-- TOC entry 211 (class 1255 OID 81532)
-- Name: sp_nuevogastoef(integer, date, double precision); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION sp_nuevogastoef(egresofijo integer, fechacompra date, gasto double precision) RETURNS numeric
    LANGUAGE plpgsql
    AS $$
	--select * from sp_nuevoGastoMP ('1', '001', '1/1/2021', '1', '100', '200');
	DECLARE idcompra integer;
         	begin
		INSERT INTO tbl_compras(
		 fecha_compra,usuario, fecha_creacion, precio,id_egresofijo)
		VALUES (fechacompra,'',now(),gasto,egresofijo);

		idcompra:=(select max(id_compra) from tbl_compras);	--ubicando ultimo id compra

		INSERT INTO tbl_finanzashist(
			monto, tipo_tx, fecha, id_compra)
		VALUES (gasto, 2, now(), idcompra);

		UPDATE tbl_finanzas
		SET capital=(capital - gasto);
	
		return 1;

		--select * from tbl_compras
		--select * from tbl_finanzas
		--select * from tbl_finanzashist
		--select * from tbl_inventario


End;

$$;


ALTER FUNCTION public.sp_nuevogastoef(egresofijo integer, fechacompra date, gasto double precision) OWNER TO postgres;

--
-- TOC entry 231 (class 1255 OID 81533)
-- Name: sp_nuevogastomp(integer, date, double precision, double precision, double precision, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION sp_nuevogastomp(materiap integer, fechacompra date, cant double precision, precio double precision, pesomp double precision, numcompra integer) RETURNS numeric
    LANGUAGE plpgsql
    AS $$
	--select * from sp_nuevoGastoMP ('1', '001', '1/1/2021', '1', '100', '200');
	DECLARE idcompra integer;
         	begin
		INSERT INTO tbl_compras(
		id_materiaprima, nro_compra, fecha_compra, cantidad_mp, 
		usuario, fecha_creacion, precio, peso)
		VALUES (materiap, numcompra, fechacompra,cant, '', 
		now(), precio, pesomp);

		idcompra:=(select max(id_compra) from tbl_compras);	--ubicando ultimo id compra

		INSERT INTO tbl_finanzashist(
			monto, tipo_tx, fecha, id_compra)
		VALUES (precio, 2, now(), idcompra);
		
		UPDATE tbl_inventario
		   SET cant_stock=(cant_stock + (cant * pesomp))
		 WHERE id_materiaprima = materiap;

		update tbl_materiaprima
			set precio_materiaprima = ( precio / pesomp )
		WHERE id = materiap;

		UPDATE tbl_finanzas
		SET capital=(capital - (cant * precio));
	
		return 1;

		--select * from tbl_compras
		--select * from tbl_finanzas
		--select * from tbl_finanzashist
		--select * from tbl_inventario


End;

$$;


ALTER FUNCTION public.sp_nuevogastomp(materiap integer, fechacompra date, cant double precision, precio double precision, pesomp double precision, numcompra integer) OWNER TO postgres;

--
-- TOC entry 232 (class 1255 OID 81534)
-- Name: sp_nuevomodifgastomp(integer, date, double precision, double precision, double precision, integer, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION sp_nuevomodifgastomp(materiap integer, fechacompra date, cant double precision, precionuevo double precision, pesomp double precision, numcompra integer, idcompra integer) RETURNS numeric
    LANGUAGE plpgsql
    AS $$
	--select * from sp_nuevoModifGastoMP ('1', '1/1/2021', '1', '100', '200','001', '6');
	DECLARE precioanterior double precision;
	DECLARE cantanterior double precision;
	DECLARE pesoanterior double precision;
         	begin
		precioanterior:=(select c.precio from tbl_compras c WHERE id_compra=idcompra);	--ubicando precio anterior en compra a editar compra
		cantanterior:=(select c.cantidad_mp from tbl_compras c WHERE id_compra=idcompra);	--ubicando precio anterior en compra a editar compra
		pesoanterior:=(select c.peso from tbl_compras c WHERE id_compra=idcompra);	--ubicando precio anterior en compra a editar compra

		UPDATE tbl_compras 
		   SET  id_materiaprima=materiap, nro_compra=numcompra, fecha_compra=fechacompra, 
		       cantidad_mp=cant, fecha_creacion=now(), precio=precionuevo, peso=pesomp 
		 WHERE id_compra=idcompra;

		update tbl_materiaprima
			set precio_materiaprima = ( precionuevo / pesomp )
		WHERE id = materiap; 

		UPDATE tbl_finanzashist
		   SET monto=precionuevo, fecha=now()
		 WHERE id_compra=idcompra;
		
		UPDATE tbl_inventario
		   SET cant_stock=(cant_stock - (cantanterior * pesoanterior) + (cant * pesomp))
		 WHERE id_materiaprima = materiap;
		UPDATE tbl_finanzas
		SET capital=(capital + precioanterior - precionuevo);

		return 1;

		--select * from tbl_compras
		--select * from tbl_finanzas
		--select * from tbl_finanzashist


End;

$$;


ALTER FUNCTION public.sp_nuevomodifgastomp(materiap integer, fechacompra date, cant double precision, precionuevo double precision, pesomp double precision, numcompra integer, idcompra integer) OWNER TO postgres;

--
-- TOC entry 213 (class 1255 OID 81536)
-- Name: sp_nuevopago(integer, double precision, double precision); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION sp_nuevopago(idpedido integer, nuevopago double precision, deuda double precision) RETURNS numeric
    LANGUAGE plpgsql
    AS $$
	Begin
				if nuevopago > deuda then --El pago no puede ser mayor a la deuda, retorna 0
				return 0;
				else
					if nuevopago = deuda then --el pago es igual a la deduda actual el pedido pasa a estatus COMPLETADO (4)
						UPDATE tbl_pedidos
						SET  estatus=4
						WHERE id_pedidos=idpedido;
					end if;

					INSERT INTO tbl_finanzashist(
						monto, tipo_tx, fecha, id_pedido)
					VALUES (nuevopago, 1, now(), idpedido);


					UPDATE tbl_finanzas
					SET capital=(capital + nuevopago);
 

					return 1;
				end if;
		

	End;
--select * from tbl_pedidos
--select * from tbl_finanzashist
$$;


ALTER FUNCTION public.sp_nuevopago(idpedido integer, nuevopago double precision, deuda double precision) OWNER TO postgres;

--
-- TOC entry 230 (class 1255 OID 81537)
-- Name: sp_nuevopedido(integer, double precision, double precision, double precision, character varying, character varying); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION sp_nuevopedido(producto integer, precio double precision, cantidad double precision, costo double precision, pago character varying, client character varying) RETURNS numeric
    LANGUAGE plpgsql
    AS $$
	declare idpedido integer;
	Begin
--select * from sp_nuevoPedido('5','11','2','22','21','Josef')
--select * from tbl_pedidos
			--validando si pago llega vacio, setear 0
			pago = (case when pago != '' then  pago else '0' end);
			if (pago::double precision <= costo) then
				INSERT INTO tbl_pedidos(
					    id_producto, precio_und, total, fecha,  estatus, 
					    cantidad, cliente)
				    VALUES (producto, precio, costo, now(), 1, cantidad, client);

				--Validando si hubo un pago previo
				
				idpedido:=(select max(id_pedidos) from tbl_pedidos);
				INSERT INTO tbl_finanzashist(
					     monto, tipo_tx, fecha, id_pedido)
				    VALUES (pago::double precision, 1, now(), idpedido);

				if pago != '0' then
				UPDATE tbl_finanzas
					SET capital=(capital + pago::double precision);

				end if;
				return 1;

			else return 0;
			end if;
		

	End;
--select * from tbl_pedidos
--select * from tbl_finanzashist
$$;


ALTER FUNCTION public.sp_nuevopedido(producto integer, precio double precision, cantidad double precision, costo double precision, pago character varying, client character varying) OWNER TO postgres;

--
-- TOC entry 228 (class 1255 OID 81538)
-- Name: sp_nuevoproducto(character varying, double precision); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION sp_nuevoproducto(product character varying, prec double precision) RETURNS numeric
    LANGUAGE plpgsql
    AS $$

	DECLARE existe integer;
         	begin
		existe:= (select count(*) from tbl_productos where upper(descrip) = product); --Validando si existe el nuevo producto
		if existe = 0 then -- si no existe, insert
		INSERT INTO tbl_productos(descrip, estatus,precio_und)
		VALUES (product, 1, prec);
		return 1;
		else return 0; 
		end if;
--select * from  sp_nuevoarticulo('HARINA')
		


End;

$$;


ALTER FUNCTION public.sp_nuevoproducto(product character varying, prec double precision) OWNER TO postgres;

--
-- TOC entry 229 (class 1255 OID 81539)
-- Name: sp_receta(integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION sp_receta(idproduct integer) RETURNS TABLE(descrip character varying, materiaprima character varying, cantidad double precision, idmp integer)
    LANGUAGE plpgsql
    AS $$
	
	Begin 

         return 	QUERY   select p.descrip, m.materiaprima, r.cantidad, r.id_materiaprima from tbl_recetario r 
				inner join tbl_materiaprima m on r.id_materiaprima = m.id
				inner join tbl_productos p on p.id_producto = r.id_producto
				where r.id_producto=idproduct;

	End;

$$;


ALTER FUNCTION public.sp_receta(idproduct integer) OWNER TO postgres;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 175 (class 1259 OID 47614)
-- Name: tbl_compras; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_compras (
    id_compra integer NOT NULL,
    id_materiaprima integer,
    nro_compra character varying,
    fecha_compra date,
    usuario character varying,
    fecha_creacion date,
    precio double precision,
    id_egresofijo integer,
    cantidad_mp double precision,
    peso double precision
);


ALTER TABLE public.tbl_compras OWNER TO postgres;

--
-- TOC entry 174 (class 1259 OID 47612)
-- Name: tbl_compras_id_compra_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_compras_id_compra_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_compras_id_compra_seq OWNER TO postgres;

--
-- TOC entry 2080 (class 0 OID 0)
-- Dependencies: 174
-- Name: tbl_compras_id_compra_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_compras_id_compra_seq OWNED BY tbl_compras.id_compra;


--
-- TOC entry 186 (class 1259 OID 47676)
-- Name: tbl_egresosfijos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_egresosfijos (
    id_egresofijo integer NOT NULL,
    egresofijo character varying NOT NULL,
    costo double precision,
    fechacrea date,
    usuariocrea character varying
);


ALTER TABLE public.tbl_egresosfijos OWNER TO postgres;

--
-- TOC entry 189 (class 1259 OID 81442)
-- Name: tbl_egresosfijos_id_egresofijo_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_egresosfijos_id_egresofijo_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_egresosfijos_id_egresofijo_seq OWNER TO postgres;

--
-- TOC entry 2081 (class 0 OID 0)
-- Dependencies: 189
-- Name: tbl_egresosfijos_id_egresofijo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_egresosfijos_id_egresofijo_seq OWNED BY tbl_egresosfijos.id_egresofijo;


--
-- TOC entry 188 (class 1259 OID 65038)
-- Name: tbl_estatuspedidos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_estatuspedidos (
    id_estatuspedido integer NOT NULL,
    estatuspedido character varying
);


ALTER TABLE public.tbl_estatuspedidos OWNER TO postgres;

--
-- TOC entry 187 (class 1259 OID 65036)
-- Name: tbl_estatuspedidos_id_estatuspedido_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_estatuspedidos_id_estatuspedido_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_estatuspedidos_id_estatuspedido_seq OWNER TO postgres;

--
-- TOC entry 2082 (class 0 OID 0)
-- Dependencies: 187
-- Name: tbl_estatuspedidos_id_estatuspedido_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_estatuspedidos_id_estatuspedido_seq OWNED BY tbl_estatuspedidos.id_estatuspedido;


--
-- TOC entry 179 (class 1259 OID 47636)
-- Name: tbl_finanzas; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_finanzas (
    id_finanzas integer NOT NULL,
    capital double precision
);


ALTER TABLE public.tbl_finanzas OWNER TO postgres;

--
-- TOC entry 178 (class 1259 OID 47634)
-- Name: tbl_finanzas_id_finanzas_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_finanzas_id_finanzas_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_finanzas_id_finanzas_seq OWNER TO postgres;

--
-- TOC entry 2083 (class 0 OID 0)
-- Dependencies: 178
-- Name: tbl_finanzas_id_finanzas_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_finanzas_id_finanzas_seq OWNED BY tbl_finanzas.id_finanzas;


--
-- TOC entry 177 (class 1259 OID 47625)
-- Name: tbl_finanzashist; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_finanzashist (
    id_finanzahist integer NOT NULL,
    monto double precision,
    tipo_tx integer,
    concepto character varying,
    fecha date,
    usuario character varying,
    id_pedido integer,
    id_compra integer
);


ALTER TABLE public.tbl_finanzashist OWNER TO postgres;

--
-- TOC entry 176 (class 1259 OID 47623)
-- Name: tbl_finanzashist_id_finanzahist_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_finanzashist_id_finanzahist_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_finanzashist_id_finanzahist_seq OWNER TO postgres;

--
-- TOC entry 2084 (class 0 OID 0)
-- Dependencies: 176
-- Name: tbl_finanzashist_id_finanzahist_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_finanzashist_id_finanzahist_seq OWNED BY tbl_finanzashist.id_finanzahist;


--
-- TOC entry 173 (class 1259 OID 47606)
-- Name: tbl_inventario; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_inventario (
    id integer NOT NULL,
    cant_stock double precision,
    id_materiaprima integer
);


ALTER TABLE public.tbl_inventario OWNER TO postgres;

--
-- TOC entry 172 (class 1259 OID 47604)
-- Name: tbl_inventario_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_inventario_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_inventario_id_seq OWNER TO postgres;

--
-- TOC entry 2085 (class 0 OID 0)
-- Dependencies: 172
-- Name: tbl_inventario_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_inventario_id_seq OWNED BY tbl_inventario.id;


--
-- TOC entry 171 (class 1259 OID 47598)
-- Name: tbl_materiaprima; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_materiaprima (
    id integer NOT NULL,
    materiaprima character varying(70),
    usuario character varying(70),
    precio_materiaprima double precision
);


ALTER TABLE public.tbl_materiaprima OWNER TO postgres;

--
-- TOC entry 170 (class 1259 OID 47596)
-- Name: tbl_materiaprima_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_materiaprima_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_materiaprima_id_seq OWNER TO postgres;

--
-- TOC entry 2086 (class 0 OID 0)
-- Dependencies: 170
-- Name: tbl_materiaprima_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_materiaprima_id_seq OWNED BY tbl_materiaprima.id;


--
-- TOC entry 185 (class 1259 OID 47666)
-- Name: tbl_pedidos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_pedidos (
    id_pedidos integer NOT NULL,
    id_producto integer,
    precio_und double precision,
    total double precision,
    fecha date,
    usuario character varying,
    estatus integer,
    cantidad double precision,
    cliente character varying
);


ALTER TABLE public.tbl_pedidos OWNER TO postgres;

--
-- TOC entry 184 (class 1259 OID 47664)
-- Name: tbl_pedidos_id_pedidos_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_pedidos_id_pedidos_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_pedidos_id_pedidos_seq OWNER TO postgres;

--
-- TOC entry 2087 (class 0 OID 0)
-- Dependencies: 184
-- Name: tbl_pedidos_id_pedidos_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_pedidos_id_pedidos_seq OWNED BY tbl_pedidos.id_pedidos;


--
-- TOC entry 181 (class 1259 OID 47644)
-- Name: tbl_productos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_productos (
    id_producto integer NOT NULL,
    descrip character varying,
    estatus integer,
    precio_und double precision
);


ALTER TABLE public.tbl_productos OWNER TO postgres;

--
-- TOC entry 180 (class 1259 OID 47642)
-- Name: tbl_productos_id_producto_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_productos_id_producto_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_productos_id_producto_seq OWNER TO postgres;

--
-- TOC entry 2088 (class 0 OID 0)
-- Dependencies: 180
-- Name: tbl_productos_id_producto_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_productos_id_producto_seq OWNED BY tbl_productos.id_producto;


--
-- TOC entry 183 (class 1259 OID 47655)
-- Name: tbl_recetario; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_recetario (
    id_receta integer NOT NULL,
    id_producto integer,
    materia_prima character varying,
    id_materiaprima integer,
    cantidad double precision
);


ALTER TABLE public.tbl_recetario OWNER TO postgres;

--
-- TOC entry 182 (class 1259 OID 47653)
-- Name: tbl_recetario_id_receta_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_recetario_id_receta_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_recetario_id_receta_seq OWNER TO postgres;

--
-- TOC entry 2089 (class 0 OID 0)
-- Dependencies: 182
-- Name: tbl_recetario_id_receta_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_recetario_id_receta_seq OWNED BY tbl_recetario.id_receta;


--
-- TOC entry 2024 (class 2604 OID 47617)
-- Name: id_compra; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_compras ALTER COLUMN id_compra SET DEFAULT nextval('tbl_compras_id_compra_seq'::regclass);


--
-- TOC entry 2030 (class 2604 OID 81444)
-- Name: id_egresofijo; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_egresosfijos ALTER COLUMN id_egresofijo SET DEFAULT nextval('tbl_egresosfijos_id_egresofijo_seq'::regclass);


--
-- TOC entry 2031 (class 2604 OID 65041)
-- Name: id_estatuspedido; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_estatuspedidos ALTER COLUMN id_estatuspedido SET DEFAULT nextval('tbl_estatuspedidos_id_estatuspedido_seq'::regclass);


--
-- TOC entry 2026 (class 2604 OID 47639)
-- Name: id_finanzas; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_finanzas ALTER COLUMN id_finanzas SET DEFAULT nextval('tbl_finanzas_id_finanzas_seq'::regclass);


--
-- TOC entry 2025 (class 2604 OID 47628)
-- Name: id_finanzahist; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_finanzashist ALTER COLUMN id_finanzahist SET DEFAULT nextval('tbl_finanzashist_id_finanzahist_seq'::regclass);


--
-- TOC entry 2023 (class 2604 OID 47609)
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_inventario ALTER COLUMN id SET DEFAULT nextval('tbl_inventario_id_seq'::regclass);


--
-- TOC entry 2022 (class 2604 OID 47601)
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_materiaprima ALTER COLUMN id SET DEFAULT nextval('tbl_materiaprima_id_seq'::regclass);


--
-- TOC entry 2029 (class 2604 OID 47669)
-- Name: id_pedidos; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_pedidos ALTER COLUMN id_pedidos SET DEFAULT nextval('tbl_pedidos_id_pedidos_seq'::regclass);


--
-- TOC entry 2027 (class 2604 OID 47647)
-- Name: id_producto; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_productos ALTER COLUMN id_producto SET DEFAULT nextval('tbl_productos_id_producto_seq'::regclass);


--
-- TOC entry 2028 (class 2604 OID 47658)
-- Name: id_receta; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_recetario ALTER COLUMN id_receta SET DEFAULT nextval('tbl_recetario_id_receta_seq'::regclass);


--
-- TOC entry 2057 (class 0 OID 47614)
-- Dependencies: 175
-- Data for Name: tbl_compras; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_compras (id_compra, id_materiaprima, nro_compra, fecha_compra, usuario, fecha_creacion, precio, id_egresofijo, cantidad_mp, peso) FROM stdin;
3	8	2	2020-12-02		2020-12-02	100	\N	\N	\N
4	8	2	2020-12-02		2020-12-02	100	\N	\N	\N
5	15	2	2020-12-02		2020-12-02	100	\N	\N	\N
6	1	1	2021-01-01		2020-12-04	10	\N	\N	\N
7	15	101	2020-12-04		2020-12-04	20	\N	\N	\N
8	8	1011	2020-12-04		2020-12-04	10	\N	\N	\N
2	14	1	2021-01-01		2020-12-07	100	\N	\N	\N
9	8	1010	2020-12-07		2020-12-07	20	\N	\N	\N
10	7	3656	2020-12-15		2020-12-15	10	\N	\N	\N
12	\N	\N	2020-12-16		2020-12-16	100	3	\N	\N
11	\N	\N	2020-12-16		2020-12-16	10	3	\N	\N
13	14	3252	2020-12-19		2020-12-19	32	\N	\N	\N
14	\N	\N	2020-12-19		2020-12-19	10	4	\N	\N
15	\N	\N	2020-12-19		2020-12-19	15	4	\N	\N
16	16	101	2020-12-30		2020-12-30	10.5	\N	100	200
17	10	101	2020-12-30		2020-12-30	0.5	\N	100	200
18	14	1	2021-01-06		2021-01-06	10	\N	1	10
20	9	120	2021-01-06		2021-01-06	10	\N	2	100
21	14	1010	2021-01-06		2021-01-06	35	\N	2	45000
19	14	320	2021-01-06		2021-01-06	35	\N	2	10
\.


--
-- TOC entry 2090 (class 0 OID 0)
-- Dependencies: 174
-- Name: tbl_compras_id_compra_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbl_compras_id_compra_seq', 21, true);


--
-- TOC entry 2068 (class 0 OID 47676)
-- Dependencies: 186
-- Data for Name: tbl_egresosfijos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_egresosfijos (id_egresofijo, egresofijo, costo, fechacrea, usuariocrea) FROM stdin;
3	juvenal2	\N	\N	\N
1	Juvenal	\N	\N	\N
4	alquiler	\N	\N	\N
5	maxima alquiler	\N	\N	\N
\.


--
-- TOC entry 2091 (class 0 OID 0)
-- Dependencies: 189
-- Name: tbl_egresosfijos_id_egresofijo_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbl_egresosfijos_id_egresofijo_seq', 5, true);


--
-- TOC entry 2070 (class 0 OID 65038)
-- Dependencies: 188
-- Data for Name: tbl_estatuspedidos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_estatuspedidos (id_estatuspedido, estatuspedido) FROM stdin;
1	PENDIENTE
2	PROCESO
3	COBRANZA
4	COMPLETADO
\.


--
-- TOC entry 2092 (class 0 OID 0)
-- Dependencies: 187
-- Name: tbl_estatuspedidos_id_estatuspedido_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbl_estatuspedidos_id_estatuspedido_seq', 1, false);


--
-- TOC entry 2061 (class 0 OID 47636)
-- Dependencies: 179
-- Data for Name: tbl_finanzas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_finanzas (id_finanzas, capital) FROM stdin;
1	247
\.


--
-- TOC entry 2093 (class 0 OID 0)
-- Dependencies: 178
-- Name: tbl_finanzas_id_finanzas_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbl_finanzas_id_finanzas_seq', 1, false);


--
-- TOC entry 2059 (class 0 OID 47625)
-- Dependencies: 177
-- Data for Name: tbl_finanzashist; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_finanzashist (id_finanzahist, monto, tipo_tx, concepto, fecha, usuario, id_pedido, id_compra) FROM stdin;
27	1	1	\N	2020-11-25	\N	32	\N
29	1	1	\N	2020-11-25	\N	35	\N
31	100	2	\N	2020-12-02	\N	\N	3
32	100	2	\N	2020-12-02	\N	\N	4
33	100	2	\N	2020-12-02	\N	\N	5
34	10	2	\N	2020-12-04	\N	\N	6
35	20	2	\N	2020-12-04	\N	\N	7
36	10	2	\N	2020-12-04	\N	\N	8
30	100	2	\N	2020-12-07	\N	\N	2
37	20	2	\N	2020-12-07	\N	\N	9
38	10	2	\N	2020-12-15	\N	\N	10
40	100	2	\N	2020-12-16	\N	\N	12
39	10	2	\N	2020-12-16	\N	\N	11
42	10	1	\N	2020-12-19	\N	36	\N
43	42	1	\N	2020-12-19	\N	36	\N
44	32	2	\N	2020-12-19	\N	\N	13
45	10	2	\N	2020-12-19	\N	\N	14
46	15	2	\N	2020-12-19	\N	\N	15
47	1	1	\N	2020-12-28	\N	37	\N
48	1	1	\N	2020-12-28	\N	38	\N
49	10.5	1	\N	2020-12-30	\N	41	\N
50	0.5	1	\N	2020-12-30	\N	32	\N
51	10.5	2	\N	2020-12-30	\N	\N	16
52	0.5	2	\N	2020-12-30	\N	\N	17
53	10	2	\N	2021-01-06	\N	\N	18
55	10	2	\N	2021-01-06	\N	\N	20
56	35	2	\N	2021-01-06	\N	\N	21
54	35	2	\N	2021-01-06	\N	\N	19
\.


--
-- TOC entry 2094 (class 0 OID 0)
-- Dependencies: 176
-- Name: tbl_finanzashist_id_finanzahist_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbl_finanzashist_id_finanzahist_seq', 56, true);


--
-- TOC entry 2055 (class 0 OID 47606)
-- Dependencies: 173
-- Data for Name: tbl_inventario; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_inventario (id, cant_stock, id_materiaprima) FROM stdin;
12	430	15
4	255	8
15	9.5999999999999996	17
14	22810	16
7	705	9
13	145030	14
\.


--
-- TOC entry 2095 (class 0 OID 0)
-- Dependencies: 172
-- Name: tbl_inventario_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbl_inventario_id_seq', 15, true);


--
-- TOC entry 2053 (class 0 OID 47598)
-- Dependencies: 171
-- Data for Name: tbl_materiaprima; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_materiaprima (id, materiaprima, usuario, precio_materiaprima) FROM stdin;
9	leudante		0.10000000000000001
8	cafe		0.01
10	CANELA		0.23000000000000001
12	C		0.0063
13	CANEA		0.23000000000000001
15	AZUCAR		0.0089999999999999993
16	AJONJOLí		0.25
17	ACEITUNAS		0.00040000000000000002
14	HARIN		3.5
\.


--
-- TOC entry 2096 (class 0 OID 0)
-- Dependencies: 170
-- Name: tbl_materiaprima_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbl_materiaprima_id_seq', 17, true);


--
-- TOC entry 2067 (class 0 OID 47666)
-- Dependencies: 185
-- Data for Name: tbl_pedidos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_pedidos (id_pedidos, id_producto, precio_und, total, fecha, usuario, estatus, cantidad, cliente) FROM stdin;
35	1	11	11	2020-11-25	\N	2	1	juan
32	1	11	22	2020-11-25	\N	3	2	pedrito
36	6	1	52	2020-12-19	\N	4	100	Gorditicos
37	1	11	11	2020-12-28	\N	1	1	juvenal
38	6	1	1	2020-12-28	\N	1	1	emilia
41	6	1	101	2020-12-30	\N	1	101	juan
\.


--
-- TOC entry 2097 (class 0 OID 0)
-- Dependencies: 184
-- Name: tbl_pedidos_id_pedidos_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbl_pedidos_id_pedidos_seq', 41, true);


--
-- TOC entry 2063 (class 0 OID 47644)
-- Dependencies: 181
-- Data for Name: tbl_productos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_productos (id_producto, descrip, estatus, precio_und) FROM stdin;
3	2	1	7
5	PANDEJAMON	1	175.45559999999998
4	CACHAPA	1	1.4328000000000003
2	CANILLA	1	\N
7	CATALINA	1	0.34999999999999998
1	HAMBURGUESA	1	\N
6	GORDITICOS	1	7.3986999999999998
\.


--
-- TOC entry 2098 (class 0 OID 0)
-- Dependencies: 180
-- Name: tbl_productos_id_producto_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbl_productos_id_producto_seq', 7, true);


--
-- TOC entry 2065 (class 0 OID 47655)
-- Dependencies: 183
-- Data for Name: tbl_recetario; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_recetario (id_receta, id_producto, materia_prima, id_materiaprima, cantidad) FROM stdin;
4	1	\N	7	2
2	2	\N	7	100
15	7	\N	8	10
16	7	\N	16	1
21	5	\N	14	50
6	2	\N	9	10
7	2	\N	10	25
11	2	\N	15	1
3	1	\N	14	1000
5	1	\N	14	1000
12	1	\N	8	10
22	5	\N	15	50
13	6	\N	15	10.5
10	6	\N	9	10.5
9	6	\N	16	25
14	6	\N	17	10.5
23	5	\N	17	14
17	4	\N	9	12
8	4	\N	8	12
1	4	\N	15	12
18	4	\N	17	12
19	3	\N	3	100
20	3	\N	4	100
\.


--
-- TOC entry 2099 (class 0 OID 0)
-- Dependencies: 182
-- Name: tbl_recetario_id_receta_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbl_recetario_id_receta_seq', 23, true);


--
-- TOC entry 2049 (class 2606 OID 81452)
-- Name: egresofijo_pk; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_egresosfijos
    ADD CONSTRAINT egresofijo_pk PRIMARY KEY (egresofijo);


--
-- TOC entry 2037 (class 2606 OID 47622)
-- Name: id_compra_primarykey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_compras
    ADD CONSTRAINT id_compra_primarykey PRIMARY KEY (id_compra);


--
-- TOC entry 2051 (class 2606 OID 65046)
-- Name: pk_idestatuspedido; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_estatuspedidos
    ADD CONSTRAINT pk_idestatuspedido PRIMARY KEY (id_estatuspedido);


--
-- TOC entry 2047 (class 2606 OID 47674)
-- Name: pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_pedidos
    ADD CONSTRAINT pkey PRIMARY KEY (id_pedidos);


--
-- TOC entry 2045 (class 2606 OID 47663)
-- Name: pkey_tblrecetario; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_recetario
    ADD CONSTRAINT pkey_tblrecetario PRIMARY KEY (id_receta);


--
-- TOC entry 2033 (class 2606 OID 47603)
-- Name: primarykey_idMateriaPrima; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_materiaprima
    ADD CONSTRAINT "primarykey_idMateriaPrima" PRIMARY KEY (id);


--
-- TOC entry 2035 (class 2606 OID 47611)
-- Name: primarykey_idinventario; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_inventario
    ADD CONSTRAINT primarykey_idinventario PRIMARY KEY (id);


--
-- TOC entry 2039 (class 2606 OID 47633)
-- Name: primarykey_tbl_finanzasHist; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_finanzashist
    ADD CONSTRAINT "primarykey_tbl_finanzasHist" PRIMARY KEY (id_finanzahist);


--
-- TOC entry 2041 (class 2606 OID 47641)
-- Name: primarykey_tblfinanzas; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_finanzas
    ADD CONSTRAINT primarykey_tblfinanzas PRIMARY KEY (id_finanzas);


--
-- TOC entry 2043 (class 2606 OID 47652)
-- Name: primerkey_tblproducto; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_productos
    ADD CONSTRAINT primerkey_tblproducto PRIMARY KEY (id_producto);


--
-- TOC entry 2078 (class 0 OID 0)
-- Dependencies: 5
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2021-01-09 20:54:44

--
-- PostgreSQL database dump complete
--

