CREATE OR REPLACE FUNCTION public.arbol_direccion_update(p_arbo_id integer, p_calle character varying, p_altura character varying, p_manz_id integer, p_nombre character varying, p_info_id integer, p_cens_id integer, p_lat character varying, p_long character varying, p_tipo character varying, p_imagen bytea, p_taza character varying, p_barrio character varying, p_lat_gps character varying DEFAULT NULL::character varying, p_long_gps character varying DEFAULT NULL::character varying)
 RETURNS character varying
 LANGUAGE plpgsql
AS $function$
#print_strict_params on
DECLARE
v_dire_id integer; 
v_call_id arb_calles.call_id%type; 
v_depa_id arb_departamentos.depa_id%type;
v_nombre varchar;

BEGIN
 BEGIN
  /** busco el dire_id **/
  select dire_id
  into strict
  v_dire_id
  from arb_direcciones 
  inner join arb_calles on arb_direcciones.call_id = arb_calles.call_id
  where arb_calles.nombre = p_calle 
  and arb_direcciones.altura = p_altura
  and arb_direcciones.manz_id = p_manz_id
  and arb_direcciones.barrio = coalesce(p_barrio,'');

  RAISE INFO 'v_dire_id % - p_calle % - p_altura % - p_barrio % -> En bloque 1', v_dire_id,p_calle,p_altura,p_barrio;

  exception
  when NO_DATA_FOUND then

   begin
    /** obtengo el departamento **/
    select ag.depa_id
    into strict
    v_depa_id
    from arb_manzanas ma,
    arb_areas_geograficas ag
    where ma.manz_id = p_manz_id
    and ag.arge_id = ma.arge_id;

    /** Intento conseguir la calle si existe, sino la inserto **/
    select ca.call_id
    into strict
    v_call_id
    from arb_calles ca
    where ca.nombre = p_calle
    and ca.depa_id = v_depa_id;

    exception   
    when NO_DATA_FOUND then
     /** inserto la calle  **/
     insert into arb_calles(nombre,depa_id)values(p_calle, v_depa_id);

     /** guardo el id de calle insertado en v_call_id **/
     select ca.call_id
     into v_call_id
     from arb_calles ca
     where ca.nombre = p_calle
     and ca.depa_id = v_depa_id;
   end;

   /** Intento insertar la direcciòn ya que no existe **/
   insert into arb_direcciones
(call_id, altura, manz_id, barrio)
values(v_call_id, p_altura, p_manz_id, p_barrio);

   RAISE INFO 'p_calle % - p_altura % - p_manz_id % - p_barrio % -> En bloque 2', p_calle,p_altura,p_manz_id, p_barrio;

   /** guardo id de direccion en v_dire_id **/
   select dire_id
   into strict
   v_dire_id
   from arb_direcciones
   inner join arb_manzanas on arb_manzanas.manz_id = arb_direcciones.manz_id
   where arb_direcciones.call_id = v_call_id 
   and arb_direcciones.altura = p_altura 
   and arb_direcciones.manz_id = p_manz_id
   and arb_direcciones.barrio = coalesce(p_barrio,'');

   RAISE INFO 'v_dire_id % -> En bloque 3', v_dire_id;
END;

begin
 /** obtengo el nombre del formulario adjunto*/
 select valor
 into strict v_nombre
 from frm_instancias_formularios fif 
 where fif.info_id = p_info_id
 and fif.name = 'nombre';
 exception
 when no_data_found then 
  v_nombre = 'Sin Arbol';
end;

/** finalmente actualizo la info del arbol **/
update arb_arboles set nombre = v_nombre , cens_id = p_cens_id, lat = p_lat, long = p_long, tipo = p_tipo, imagen = p_imagen, taza = p_taza ,lat_gps = p_lat_gps, long_gps = p_long_gps ,dire_id=v_dire_id where arbo_id = p_arbo_id;

return 'OK';
/** vuelve las transacciones efectuadas si alguna falla **/
exception 
when others then
 --   rollback;
 return 'ERROR: '||sqlerrm||' '|| SQLSTATE;
 --raise notice '% %', SQLERRM, SQLSTATE;

END; 
$function$
;

