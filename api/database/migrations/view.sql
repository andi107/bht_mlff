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