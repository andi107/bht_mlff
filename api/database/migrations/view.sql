-- Device Relay
CREATE OR REPLACE VIEW public.v_device_relay
 AS
SELECT
	dv.ftdevice_name,dv.ftasset_id,dv.ftasset_name,dv.ftasset_description,dv.fncategory, dr.*
FROM x_devices dv LEFT JOIN LATERAL
(
    select id as logs_id,ftdevice_id,fflat,fflon,fngeo_id,fngeo_chkpoint,created_at, ffaccuracy_cep,ffdirection,ffspeed,ffbattery,fnsattelite,ffaltitude from debuging_routes where fttype = 'R1' and ftdevice_id = dv.ftdevice_id order by created_at desc limit 1
) dr ON 1=1;

-- Device Ignition

CREATE OR REPLACE VIEW public.v_device_ignition
 AS
SELECT
	dv.ftdevice_name,dv.ftasset_id,dv.ftasset_name,dv.ftasset_description,dv.fncategory, dr.*
FROM x_devices dv LEFT JOIN LATERAL
(
    select id as logs_id,ftdevice_id, created_at, ffbattery,fnsattelite,fnsignal from debuging_routes where fttype = '0F' and ftdevice_id = dv.ftdevice_id order by created_at desc limit 1
) dr ON 1=1;

-- 

CREATE OR REPLACE VIEW public.v_geo_declare_adv
 AS
select
	xgdd.id,xgdd.fnchkpoint,xgdd.fnindex, xgdd.x_geo_declare_id,xgdd.fflat,xgdd.fflon
from x_geo_declare_det xgdd join x_geo_declare xgd 
	on (xgdd.x_geo_declare_id = xgd.id )

--
CREATE OR REPLACE VIEW public.v_geo_history
 AS
select 
	dr.id,dr.created_at,dr.ftdevice_id,dr.fngeo_id,dr.fngeo_declare,
	xgd.ftgeo_name,xgd.ftaddress,xgd.fntype,xgd.fnstatus 
From debuging_routes dr left join x_geo_declare xgd
	on (dr.fngeo_id = xgd.id )
where dr.fngeo_id is not NULL and dr.fttype = 'R1'
order by dr.created_at asc;