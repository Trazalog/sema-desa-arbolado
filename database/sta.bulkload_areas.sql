CREATE OR REPLACE FUNCTION sta.bulkload_areas(p_archivo character varying, p_depa_id integer, p_cens_id integer)
  RETURNS boolean
 LANGUAGE plpgsql
AS $function$
	DECLARE 
	v_area_aux varchar;
	v_depa_id_aux varchar;
	v_manzanas_aux varchar;
    v_arge_id_aux int4;
	cur_areacsv CURSOR FOR SELECT
						ltrim(rtrim(ar."AREA GEOGRAFICA"))
						, ltrim(rtrim( ar."MANZANAS"))
						FROM sta.areas ar
						WHERE ar.procesado = FALSE;

 	BEGIN
		/**
		 * Carga de un archivo csv
		 * 	con columnas "AREA GEOGRAFICA","MANZANAS"
		 * la primer fila de csv debe tener estos nombres no importa el orden
		 */
	    RAISE INFO 'BULKAG: Cargando archivo % para cens % y depa %',p_archivo,p_cens_id,p_depa_id;

		BEGIN

		   EXECUTE 
			FORMAT('COPY sta.areas ("AREA GEOGRAFICA","MANZANAS") FROM %s WITH CSV HEADER'
		    ,p_archivo);
	       
		    RAISE INFO 'BULKAG: Archivo cargado';
       

			RAISE INFO 'BULKAG: Insertando registros';
			open cur_areacsv;
			loop
				fetch cur_areacsv into v_area_aux,v_manzanas_aux;
				exit when NOT FOUND;
	    		
				RAISE INFO 'BULKAG: Procesando registro  %-%-%-%',v_area_aux,v_manzanas_aux,p_cens_id,p_depa_id;
				
				with inserted_arge as (
					insert into public.arb_areas_geograficas 
						   (nombre,
							depa_id,
							cens_id)
					values(v_area_aux,
					p_depa_id,
					p_cens_id)
				    returning arge_id		
				)

				select arge_id
				into strict v_arge_id_aux
				from inserted_arge;
			   
				RAISE INFO 'BULKAG: Insertando % manzanas',v_manzanas_aux;
			   
				for i in 1..cast(v_manzanas_aux as integer) loop
				
					insert into public.arb_manzanas 
					   (nombre,
						arge_id)
					values('Manzana '||i,
					v_arge_id_aux);
				end loop;
				
			end loop;
			CLOSE cur_areacsv;
			RAISE INFO 'BULKAG: Registros cargados, marcando batch como procesado';

			UPDATE
				sta.areas
			SET
				procesado = TRUE
				, fec_proceso = now()
			WHERE
				procesado = FALSE;

			RAISE INFO 'BULKAG: Carga bulk terminada exitosamente';
	EXCEPTION	
		when others then
			/* Borro el actual CSV con error*/
			DELETE FROM sta.areas ar 
			WHERE ar.procesado = FALSE;
			raise EXCEPTION 'BULKAG: error al cargar batch de articulos %: %', sqlstate,sqlerrm;

	END;

	RETURN TRUE;
END;
$function$
;
