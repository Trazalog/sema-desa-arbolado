CREATE DEFINER=`rootremote`@`%` PROCEDURE `assetv2`.`assetv2.bulkload_equipos`(p_id_empresa int)
BEGIN
	DECLARE descripcion_aux varchar(255);
	DECLARE fecha_ingreso_aux varchar(255);
	DECLARE fecha_baja_aux varchar(255);
	DECLARE fecha_garantia_aux varchar(255);
	DECLARE marca_aux varchar(255);
	DECLARE codigo_aux varchar(255);
	DECLARE ubicacion_aux varchar(255);
	DECLARE sector_aux varchar(255);
	DECLARE grupo_aux varchar(255);
	DECLARE criticidad_aux varchar(255);
	DECLARE estado_aux varchar(255);
	DECLARE fecha_ultimalectura_aux varchar(255);
	DECLARE ultima_lectura_aux varchar(255);
	DECLARE descrip_tecnica_aux varchar(255);
	DECLARE unidad_aux varchar(255);
	DECLARE area_aux varchar(255);
	DECLARE proceso_aux varchar(255);
	DECLARE numero_serie_aux varchar(255);
	DECLARE meta_disponibilidad varchar(255);
	DECLARE id_marca_aux int(11);
	DECLARE id_sector_aux int(11);
	DECLARE id_grupo_aux int(11);
	DECLARE id_criticidad_aux int(11);
	DECLARE id_unidad_aux int(11);
	DECLARE id_area_aux int(11);
	DECLARE id_proceso_aux int(11);	
	DECLARE done INT DEFAULT FALSE;

	DECLARE cur_ots CURSOR FOR SELECT descripcion
									,fecha_ingreso
									,fecha_baja
									,fecha_garantia
									,marca
									,codigo
									,ubicacion
									,sector
									,grupo
									,criticidad
									,estado
									,fecha_ultimalectura
									,ultima_lectura
									,descrip_tecnica
									,unidad
									,area
									,proceso
									,numero_serie
									,meta_disponibilidad
                               from sta_equipos eq
			      			   WHERE procesado = 0;
 
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;                          
	DECLARE EXIT HANDLER FOR SQLEXCEPTION
	BEGIN
		    ROLLBACK;
			
		    DELETE FROM sta_equipos
 			WHERE procesado = 0;

 			SELECT 'BULKOT: error al cargar batch de equipos';

            SHOW ERRORS;
    END;
  
		SELECT 'BULKOT: Insertando registros';
		open cur_eq;
		lp: loop
			fetch cur_eq into descripcion_aux,fecha_ingreso_aux,fecha_baja_aux,fecha_garantia_aux,marca_aux,codigo_aux,ubicacion_aux,sector_aux,grupo_aux,criticidad_aux,estado_aux,fecha_ultimalectura_aux,ultima_lectura_aux
			                 ,descrip_tecnica_aux,unidad_aux,area_aux,proceso_aux,numero_serie_aux,meta_disponibilidad; 


			if done then
					SELECT 'BULKOT: No hay más registros';
                	leave lp;
    		end if;
			
    		SELECT CONCAT('BULKOT: Procesando registro descripcion, marca, numero serie',descripcion_aux,marca_aux,numero_serie_aux);


			select m2.marcaid 
			into id_marca_aux
			from marcasequipos m2 
			where m2.marcadescrip = marca_aux
			and m2.id_empresa = p_id_empresa;

			select s2.id_sector 
			into id_sector_aux
			from sector s2 
			where s2.descripcion = sector_aux
			and s2.id_empresa  = p_id_empresa;

			select g2.id_grupo 
			into id_grupo_aux
			from grupo g2 
			where g2.descripcion = grupo_aux
			and g2.id_empresa  = p_id_empresa;

			select c.id_criti 
			into id_criticidad_aux
			from criticidad c  
			where c.descripcion  = criticidad_aux
			and c.id_empresa  = p_id_empresa;
			
		    select ui.id_unidad  
			into id_unidad_aux
			from unidad_industrial ui   
			where ui.descripcion  = unidad_aux
			and ui.id_empresa  = p_id_empresa;
		
		   	select a2.id_area 
			into id_area_aux 
			from area a2 				 
			where a2.descripcion = area_aux
			and a2.id_empresa  = p_id_empresa;

			select p2.id_proceso 
			into id_proceso_aux
			from proceso p2  				 
			where p2.descripcion = proceso_aux
			and p2.id_empresa  = p_id_empresa;


			SELECT CONCAT('BULKOT: datos traducidos equipo y user_a ',id_equipo_aux,id_usuario_a_aux);

			INSERT
				INTO
				orden_trabajo (
				nro,
				fecha,
				fecha_program,
				fecha_inicio,
				fecha_entrega,
				fecha_terminada,
				fecha_aviso,
				fecha_entregada,
				descripcion,
				estado,
				id_usuario,
				id_usuario_a,
				id_usuario_e,
				id_proveedor,
				id_solicitud,
				tipo,
				id_equipo,
				id_empresa )
			VALUES(
			    id_orden_aux,
				current_timestamp,
				str_to_date(fecha_program_aux,'%d-%m-%Y %H:%i'),
				str_to_date(fecha_inicio_aux,'%d-%m-%Y %H:%i'),
				str_to_date(fecha_entrega_aux,'%d-%m-%Y %H:%i'),
				str_to_date(fecha_terminada_aux,'%d-%m-%Y %H:%i'),
				str_to_date(fecha_aviso_aux,'%d-%m-%Y %H:%i'),
				str_to_date(fecha_entregada_aux,'%d-%m-%Y %H:%i'),
				descripcion_aux,
				estado_aux,
				1,
				id_usuario_a_aux,
				1,
				1,
				0,
				10, 
				id_equipo_aux,
				p_id_empresa
			);
			

		end loop lp;
	
		CLOSE cur_ots;
		SELECT 'BULKOT: Registros cargados, marcando batch como procesado';

		UPDATE
			sta_orden_trabajo
		SET
			procesado = TRUE
			, fec_proceso = current_timestamp()
		WHERE
			procesado = FALSE;

		SELECT 'BULKOT: Carga bulk terminada exitosamente';
END