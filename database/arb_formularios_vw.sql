CREATE OR REPLACE VIEW public.arb_formularios_vw
AS SELECT ct.info_id,
    ct."ACEQUIA",
    ct."AGALLA_CANCROS",
    ct."ALINEACION_DEL_ARBOL",
    ct."ALTA",
    ct."ALTURA_DEL_FUSTE__M_",
    ct."ALTURA_MEDICION_DEL_CAP",
    ct."ALTURA_TOTAL__M_",
    ct."BAJAS",
    ct."BASAL",
    ct."BIFURCADO",
    ct."CIRCUNFERENCIA_ALTURA_PECHO__CM__CAP",
    ct."CLOROSIS",
    ct."CODOMINANCIA",
    ct."CODOMINANTES",
    ct."COPA__M__-_MEDIDA_1",
    ct."COPA__M__-_MEDIDA_2",
    ct."CUELLO_VISIBLE",
    ct."DEFORMACION",
    ct."DENSIDAD_DEL_FOLLAJE",
    ct."DESCOPADO_Y_BROTACION",
    ct."DESCORTEZAMIENTO",
    ct."DESCRIPCION_ESTADO_FISICO",
    ct."DESCUBIERTAS",
    ct."ENTORNO",
    ct."ESTADO_SANITARIO_GENERAL",
    ct."FRUCTIFICACIONES_FUNGICAS",
    ct."INCLINACION_MAYOR_A_45_",
    ct."INTERFIERE_CABLES",
    ct."LEVANTAMIENTO_DE_PAVIMENTO",
    ct."LEVANTAMIENTO_DE_VEREDAS",
    ct."MEDIA",
    ct."NOMBRE_COMUN___CIENTIFICO",
    ct."NO_PRESENTA_CAVIDADES",
    ct."OBSERVACIONES",
    ct."OTRO",
    ct."POSTES_CERCA",
    ct."QUEBRADAS",
    ct."SECAS",
    ct."TAPA_DE_TAZA_INSCRUSTADA",
    ct."UNICO",
    ct."VEREDA"
   FROM crosstab(' 
select f.info_id, replace(replace(replace(replace(replace(upper(norm_text_latin(f.label)),''('',''_''),'')'',''_''),''/'',''_''),'' '',''_''),''º'',''_'') ,f.valor 
	from frm_instancias_formularios f
	, utl_tablas t
	where t.tabl_id = f.tida_id 
	and f.tida_id <> 1
	order by 1,2
'::text) ct(info_id integer, "ACEQUIA" character varying, "AGALLA_CANCROS" character varying, "ALINEACION_DEL_ARBOL" character varying, "ALTA" character varying, "ALTURA_DEL_FUSTE__M_" character varying, "ALTURA_MEDICION_DEL_CAP" character varying, "ALTURA_TOTAL__M_" character varying, "BAJAS" character varying, "BASAL" character varying, "BIFURCADO" character varying, "CIRCUNFERENCIA_ALTURA_PECHO__CM__CAP" character varying, "CLOROSIS" character varying, "CODOMINANCIA" character varying, "CODOMINANTES" character varying, "COPA__M__-_MEDIDA_1" character varying, "COPA__M__-_MEDIDA_2" character varying, "CUELLO_VISIBLE" character varying, "DEFORMACION" character varying, "DENSIDAD_DEL_FOLLAJE" character varying, "DESCOPADO_Y_BROTACION" character varying, "DESCORTEZAMIENTO" character varying, "DESCRIPCION_ESTADO_FISICO" character varying, "DESCUBIERTAS" character varying, "ENTORNO" character varying, "ESTADO_SANITARIO_GENERAL" character varying, "FRUCTIFICACIONES_FUNGICAS" character varying, "INCLINACION_MAYOR_A_45_" character varying, "INTERFIERE_CABLES" character varying, "LEVANTAMIENTO_DE_PAVIMENTO" character varying, "LEVANTAMIENTO_DE_VEREDAS" character varying, "MEDIA" character varying, "NOMBRE_COMUN___CIENTIFICO" character varying, "NO_PRESENTA_CAVIDADES" character varying, "OBSERVACIONES" character varying, "OTRO" character varying, "POSTES_CERCA" character varying, "QUEBRADAS" character varying, "SECAS" character varying, "TAPA_DE_TAZA_INSCRUSTADA" character varying, "UNICO" character varying, "VEREDA" character varying);

-- Permissions

ALTER TABLE public.arb_formularios_vw OWNER TO postgres;
GRANT ALL ON TABLE public.arb_formularios_vw TO postgres;

