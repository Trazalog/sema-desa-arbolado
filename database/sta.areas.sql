-- sta.areas definition

-- Drop table

-- DROP TABLE sta.areas;

CREATE TABLE sta.areas (
	id serial NOT NULL,
	"AREA GEOGRAFICA" varchar NULL,
	"MANZANAS" varchar NULL,
	procesado bool NOT NULL DEFAULT false,
	fec_proceso date NULL,
	CONSTRAINT areas_pk PRIMARY KEY (id)
);

