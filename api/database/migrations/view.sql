-- Device Relay
CREATE OR REPLACE VIEW public.v_device_relay
 AS
SELECT
	dv.ftdevice_name,dv.ftasset_id,dv.ftasset_name,dv.ftasset_description,dv.fncategory,dv.uuid_customer_id, dr.*
FROM x_devices dv LEFT JOIN LATERAL
(
    select id as logs_id,ftdevice_id,fflat,fflon,fngeo_id,fngeo_chkpoint,created_at, ffaccuracy_cep,ffdirection,ffspeed,ffbattery,fnsattelite,ffaltitude from debuging_routes 
    where fttype = 'R1' and ftdevice_id = dv.ftdevice_id or fttype = '2F' and ftdevice_id = dv.ftdevice_id order by created_at desc limit 1
) dr ON 1=1;

-- Device Ignition

CREATE OR REPLACE VIEW public.v_device_ignition
 AS
SELECT
	dv.ftdevice_name,dv.ftasset_id,dv.ftasset_name,dv.ftasset_description,dv.fncategory,dv.uuid_customer_id, dr.*
FROM x_devices dv LEFT JOIN LATERAL
(
    select id as logs_id,ftdevice_id, created_at, ffbattery,fnsattelite,fnsignal,fncellular,fbpower,
    CASE fncellular
    	WHEN 11 THEN 'GPRS, LTE'
    	WHEN 10 THEN 'LTE'
    	WHEN 01 THEN 'GPRS'
    	ELSE 'No Cellular'
    	END AS ftcellular
    from debuging_routes where fttype = '0F' and ftdevice_id = dv.ftdevice_id order by created_at desc limit 1
) dr ON 1=1;

-- 

CREATE OR REPLACE VIEW public.v_geo_declare_adv
 AS
select
	xgdd.id,xgdd.fnchkpoint,xgdd.fnindex, xgdd.x_geo_declare_id,xgdd.fflat,xgdd.fflon,xgd.uuid_customer_id
from x_geo_declare_det xgdd join x_geo_declare xgd 
	on (xgdd.x_geo_declare_id = xgd.id );

--
CREATE OR REPLACE VIEW public.v_geo_history_route
 AS
select 
	dr.id,dr.created_at,dr.ftdevice_id,dr.fngeo_id,dr.fngeo_declare,
	xgd.ftgeo_name,xgd.ftaddress,xgd.fntype,xgd.fnstatus,dr.uuid_customer_id
From debuging_routes dr left join x_geo_declare xgd
	on (dr.fngeo_id = xgd.id )
where dr.fngeo_id is not NULL and dr.fttype = 'R1'
order by dr.created_at asc;
--

CREATE OR REPLACE VIEW public.v_geo_history
 AS
select
	b.*,xgd.uuid_customer_id
from (
	select
		a.*,xgd.ftgeo_name,xgd.ftaddress,xgd.fntype,xgd.fnstatus
	from (
		select 
			gh.id, gh.ftdevice_id,gh.fddeclaration,gh.fbdeclaration,gh.uuid_x_geo_id,gh.ftduration,
			xd.ftdevice_name,xd.ftasset_id,xd.ftasset_name,xd.fncategory as device_category,
			gh.fddeclaration_exit
		from geo_history gh left join x_devices xd
			on (gh.ftdevice_id = xd.ftdevice_id)
	) a left join x_geo_declare xgd
		on (a.uuid_x_geo_id = xgd.id)
) b left join x_geo_declare xgd
	on (b.uuid_x_geo_id = xgd.id)


-- MLFF Declaration
CREATE OR REPLACE VIEW public.v_geo_mlff_declare
 AS
select
	xgmd.id,xgmd.fntype,
	CASE xgmd.fntype
		WHEN 1 THEN 'Entry'
		WHEN 2 THEN 'Exit'
		END AS ftdeclaration_type,
	xgmd.fnstatus,xgmd.created_at,xgmd.updated_at,xgmd.uuid_x_gate_point_id,
	xgp.ftname,xgp.ftsection,xgp.fflat,xgp.fflon,xgp.fnpayment_type,
	CASE xgp.fnpayment_type
		WHEN 1 THEN 'Open'
		WHEN 2 THEN 'Close'
		ELSE 'n/a'
		END AS ftpayment_type
From x_geo_mlff_declare xgmd left join x_gate_point xgp
	ON (xgmd.uuid_x_gate_point_id = xgp.id);
--

CREATE OR REPLACE VIEW public.v_device_geo_mlff_declare
 AS
select
	mh.id,mh.ftdevice_id,mh.fddeclaration,mh.fbdeclaration,mh.uuid_x_geo_mlff_id,
	vgmd.ftdeclaration_type,vgmd.ftname as gate_name,vgmd.ftsection,vgmd.ftpayment_type,
	vgmd.fflat as gate_lat,vgmd.fflon as gate_lon
From mlff_history mh left join v_geo_mlff_declare vgmd
	on (mh.uuid_x_geo_mlff_id = vgmd.id)


--
CREATE OR REPLACE VIEW public.v_geo_declare_det
 AS
select
	xgdd.*,xgd.uuid_customer_id
From x_geo_declare_det xgdd left join x_geo_declare xgd
	on (xgdd.x_geo_declare_id = xgd.id)
--
CREATE OR REPLACE VIEW public.v_devices
 AS
select
	xd.*,us.ftfirst_name || ' ' || us.ftlast_name ::text as ownership
from x_devices xd left join users us
 on (xd.uuid_customer_id = us.uid)
 --
CREATE OR REPLACE VIEW public.v_geo_mlff_history
 AS
select
	mh.id,mh.ftdevice_id,mh.fddeclaration,mh.fbdeclaration,mh.uuid_x_geo_mlff_id,
	vgmd.ftname,vgmd.ftsection,vgmd.fflat as gate_lat,vgmd.fflon as gate_lon,vgmd.ftpayment_type
from mlff_history mh left join v_geo_mlff_declare vgmd
	on (mh.uuid_x_geo_mlff_id = vgmd.id)
